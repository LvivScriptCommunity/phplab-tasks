<?php
/**
 * Connect to DB
 */
include 'pdo_ini.php';
define( 'ITEMS_PER_PAGE', 10 );
/**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */
$uniqueFirstLetters = getFirstLettersSql($pdo);;

function getFirstLettersSql($pdo){
    $sth = $pdo->prepare("SELECT DISTINCT LEFT(name, 1) AS letter FROM airports ORDER BY LEFT(name, 1)");
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $items = $sth->fetchAll();
    $letters = [];
    foreach ($items as $item){
        $letters[] = $item['letter'];
    }

    return $letters;
}

function addQueryArgs( $key, $value){
    $get_args = $_GET;
    $get_args[$key] = $value;
    $i = 0;
    $ulr_params = '';
    foreach ($get_args as $k => $v){
        if($i === 0){
            $ulr_params .= "?{$k}={$v}";
        }else{
            $ulr_params .= "&{$k}={$v}";
        }
        $i++;
    }

    return $ulr_params;
}
// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 *
 * For filtering by first_letter use LIKE 'A%' in WHERE statement
 * For filtering by state you will need to JOIN states table and check if states.name = A
 * where A - requested filter value
 */
function getOrderParams(){
    $order_by = '';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    if($filter === 'name'){
        $order_by = " ORDER BY a.name";
    }elseif ($filter === 'code'){
        $order_by = " ORDER BY a.code";
    }elseif ($filter === 'state'){
        $order_by = " ORDER BY s.name";
    }elseif ($filter === 'city'){
        $order_by = " ORDER BY c.name";
    }
    return $order_by;
}


// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 *
 * For sorting use ORDER BY A
 * where A - requested filter value
 */
function getWhereParams(){
    $where = '';
    $filter_by_first_letter = isset($_GET['filter_by_first_letter']) ? $_GET['filter_by_first_letter'] : false;
    $filter_by_state = isset($_GET['filter_by_state']) ? $_GET['filter_by_state'] : false;
    if($filter_by_first_letter || $filter_by_state){
        $where = ' WHERE';
    }
    if($filter_by_first_letter) {
        $where .= " a.name LIKE '{$filter_by_first_letter}%'";
    }
    if($filter_by_state) {
        if($filter_by_first_letter) {
            $where .= ' AND';
        }
        $where .= " s.name LIKE '{$filter_by_state}%'";
    }
    return $where;
}

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 *
 * For pagination use LIMIT
 * To get the number of all airports matched by filter use COUNT(*) in the SELECT statement with all filters applied
 */
function getPagination($pdo){
    $where = getWhereParams();
    $order_by = '';
    $sth = $pdo->prepare("SELECT COUNT(*) FROM airports AS a JOIN states AS s ON a.state_id = s.id  {$where} {$order_by}");
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $items = $sth->fetchColumn();
    return ceil($items/ITEMS_PER_PAGE);
}

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */
function getAirports($pdo){
    $where = getWhereParams();
    $order_by = getOrderParams();
    $end = getLimitsAndOffset();
    $paginate = getPagination($pdo);
    if($end['page'] > $paginate){
        $end['offset'] = ' OFFSET 0';
    }
    $sth = $pdo->prepare("SELECT a.*, s.name AS state_name, LEFT(s.name, 1) AS state_first, c.name AS city_name  
                            FROM airports AS a JOIN states AS s ON a.state_id = s.id 
                            JOIN cities AS c ON a.city_id = c.id {$where} {$order_by} {$end['limit']} {$end['offset']}");
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $items = $sth->fetchAll();
    return $items;
}

function getLimitsAndOffset(){
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $ofset = $page - 1;
    $limit = ITEMS_PER_PAGE;
    return [
        'limit' => " LIMIT {$limit}",
        'offset' => " OFFSET {$ofset}",
        'page' => floatval($page)
    ];
}

$airports = getAirports($pdo);
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

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B
        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach ($uniqueFirstLetters as $letter): ?>
            <a href="<?= addQueryArgs('filter_by_first_letter', $letter) ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="/" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc
        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="<?= addQueryArgs('filter', 'name') ?>">Name</a></th>
            <th scope="col"><a href="<?= addQueryArgs('filter', 'code') ?>">Code</a></th>
            <th scope="col"><a href="<?= addQueryArgs('filter', 'state') ?>">State</a></th>
            <th scope="col"><a href="<?= addQueryArgs('filter', 'city') ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B
            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="<?= addQueryArgs('filter_by_state', $airport['state_first']) ?>"><?= $airport['state_name'] ?></a></td>
            <td><?= $airport['city_name'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied
        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <?php $page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1; ?>
    <?php $page_count = getPagination($pdo); ?>
    <?php if($page_count > 1){ ?>
        <nav aria-label="Navigation">
            <ul class="pagination justify-content-center">
                <?php for( $i=1; $i <= $page_count; $i++ ) { ?>
                    <?php if( $page == $i) { ?>
                        <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="<?= addQueryArgs('page', $i ) ?>"><?= $i ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>

</main>
</html>