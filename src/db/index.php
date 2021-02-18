<?php

/** @var \PDO $pdo */
require_once './pdo_ini.php';

function updateUrl($url, $param): string
{
    $url_parts = parse_url($url);
    if (isset($url_parts['query'])) {
        // Avoid 'Undefined index: query'
        parse_str($url_parts['query'], $params);
    } else {
        $params = [];
    }
    unset($params[$param]);
    if ($param != 'page') {
        $params['page'] = '1' ;
    }
    $url_parts['query'] = http_build_query($params);
    $url                = $url_parts['path'] . '?' . $url_parts['query'];
    return $url;
}

$reset_url =  $_SERVER['REQUEST_URI'];
$url_parts1 = parse_url($reset_url);
$reset_url = $url_parts1['path'];
$url = $_SERVER['REQUEST_URI'];
$airports = [];
$where = "";
$order_by = '';
$limit = '';
$sql = <<<'SQL'
    SELECT a.name,a.code,s.name as state_name,c.name as city_name,a.address,a.timezone,a.state_id 
    from airports AS a 
    INNER JOIN states AS s ON a.state_id  = s.id
    INNER JOIN cities AS c ON a.city_id  = c.id
SQL ;

$uniqueFirstLetters = [];
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("select DISTINCT left(name,1) as firstletter from airports order by firstletter asc");
    $stmt->execute();
    $uniqueFirstLetters = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Filtering
if (isset($_GET["filter_by_first_letter"])) {
    if (isset($_GET["filter_by_state"])) {
        $where = " WHERE (a.name LIKE '" . $_GET["filter_by_first_letter"] . "%' AND s.id="
            . $_GET["filter_by_state"] . ")" ;
    } else {
        $where = " WHERE (a.name LIKE '" . $_GET["filter_by_first_letter"] . "%')" ;
    }
} elseif (isset($_GET["filter_by_state"])) {
    $where = " WHERE (s.id=" . $_GET["filter_by_state"] . ")" ;
}

// Sorting
if (isset($_GET["sort_by"])) {
    $order_by = " order by " . $_GET["sort_by"] . " asc";
} else {
    $url = updateUrl($url, "page") ;
}

// Pagination
$sql2 = <<<'SQL'
    SELECT COUNT(*)
    from airports AS a 
    INNER JOIN states AS s ON a.state_id  = s.id
    INNER JOIN cities AS c ON a.city_id  = c.id
SQL ;
$pageCount = 1;
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql2 = $sql2 . $where . $order_by;
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
    $pageCount = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pageCount = $pageCount / 20 ;
$currentPage = 1 ;
if (isset($_GET["page"])) {
    $currentPage = (int)$_GET["page"];
    $offset = ($currentPage * 20) - 20;
    $limit = ' limit ' . $offset . ', 20';
} else {
    $limit = ' limit 0, 20';
}

//Final Array
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $sql . $where . $order_by . $limit;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $airports = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach ($uniqueFirstLetters as $letter) :
            ?>
            <a href="<?= (updateUrl($url, "filter_by_first_letter") . "&filter_by_first_letter=" . $letter[0]) ?>"><?= $letter[0] ?></a>
            <?php
        endforeach; ?>

        <a href="<?= $reset_url ?>" class="float-right">Reset all filters</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="<?= (updateUrl($url, "sort_by") . "&sort_by=a.name" )?>">Name</a></th>
            <th scope="col"><a href="<?= (updateUrl($url, "sort_by") . "&sort_by=a.code" )?>">Code</a></th>
            <th scope="col"><a href="<?= (updateUrl($url, "sort_by") . "&sort_by=s.name" )?>">State</a></th>
            <th scope="col"><a href="<?= (updateUrl($url, "sort_by") . "&sort_by=c.name" )?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($airports as $airport) :
            ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="<?= (updateUrl($url, "filter_by_state") . "&filter_by_state=" .
                    $airport['state_id']) ?>"><?= $airport['state_name'] ?></a></td>
            <td><?= $airport['city_name'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
            <?php
        endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $pageCount; $i++) :?>
                <li class="<?=($i == $currentPage ? "page-item active" : "page-item") ?>">
                    <a class="page-link" href="<?= (updateUrl($url, "page") . "&page=" . $i) ?>"><?=$i ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

</main>
</html>
