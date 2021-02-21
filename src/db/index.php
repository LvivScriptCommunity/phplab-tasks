<?php
/**
 * Connect to DB
 */
require_once './pdo_ini.php';
require_once './pagination.php';

/**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */

$sth = $pdo->prepare('SELECT DISTINCT LEFT(name, 1)  FROM airports ORDER BY name ASC');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $uniqueFirstLetters = $sth->fetchAll();

//$uniqueFirstLetters = ['A', 'B', 'C'];

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

$state = NULL;
$name = NULL;

if (!isset ($_GET['sort'])){
    $sort = 'id';
} else {
    $sort = $_GET['sort'];
}

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 5;
    $startpoint = ($page * $limit) - $limit;

$sth = $pdo->prepare("SELECT airports.*, cities.`name` as `city_name`, states.`name` as `state_name`
FROM airports INNER JOIN cities ON (airports.`city_id`= cities.`id`) INNER JOIN states ON (airports.`state_id`= states.`id`) ORDER BY " . $sort . " ASC LIMIT {$startpoint} , {$limit}");
$sthp = $pdo->prepare("SELECT * FROM airports");


if (isset($_GET['filter_by_first_letter'])) {
    $name = $_GET['filter_by_first_letter'];
    $sth = $pdo->prepare("SELECT airports.*, cities.`name` as `city_name`, states.`name` as `state_name` FROM airports INNER JOIN cities ON (airports.`city_id`= cities.`id`) INNER JOIN states ON (airports.`state_id`= states.`id`) WHERE LEFT(airports.`name`, 1)='" . $name . "' ORDER BY " . $sort . " ASC LIMIT {$startpoint} , {$limit}");
    
    $sthp = $pdo->prepare("SELECT * FROM airports WHERE LEFT(airports.`name`, 1)='" . $name . "'");
}

if (isset($_GET['filter_by_state']) ) {
    $state = $_GET['filter_by_state'];
    $sth = $pdo->prepare("SELECT airports.*, cities.`name` as `city_name`, states.`name` as `state_name` FROM airports INNER JOIN cities ON (airports.`city_id`= cities.`id`) INNER JOIN states ON (airports.`state_id`= states.`id`) WHERE states.`name`='" . $state . "' ORDER BY " . $sort . " ASC LIMIT {$startpoint} , {$limit}");
    
    $sthp = $pdo->prepare("SELECT airports.*, states.`name` as `state_name` FROM airports INNER JOIN states ON (airports.`state_id`= states.`id`) WHERE states.`name`='" . $state . "'");
}

if (isset($_GET['filter_by_first_letter']) AND isset($_GET['filter_by_state']) ) {
    $name = $_GET['filter_by_first_letter'];
    $state = $_GET['filter_by_state'];
    $sth = $pdo->prepare("SELECT airports.*, cities.`name` as `city_name`, states.`name` as `state_name` FROM airports INNER JOIN cities ON (airports.`city_id`= cities.`id`) INNER JOIN states ON (airports.`state_id`= states.`id`) WHERE LEFT(airports.`name`, 1)='" . $name . "' AND states.`name`='" . $state . "' ORDER BY " . $sort . " ASC LIMIT {$startpoint} , {$limit}");
    
    $sthp = $pdo->prepare("SELECT airports.*, cities.`name` as `city_name`, states.`name` as `state_name` FROM airports INNER JOIN cities ON (airports.`city_id`= cities.`id`) INNER JOIN states ON (airports.`state_id`= states.`id`) WHERE LEFT(airports.`name`, 1)='" . $name . "' AND states.`name`='" . $state . "'");
}

$sth->setFetchMode(\PDO::FETCH_ASSOC);
$sth->execute();
$airports = $sth->fetchAll();

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 *
 * For sorting use ORDER BY A
 * where A - requested filter value
 */

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 *
 * For pagination use LIMIT
 * To get the number of all airports matched by filter use COUNT(*) in the SELECT statement with all filters applied
 */

$sthp->setFetchMode(\PDO::FETCH_ASSOC);
$sthp->execute();
$airport = $sthp->fetchAll();

$paginate = pagination($airport, $name, $state, $sort);

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */
//$airports = [];
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
            <a href="/?filter_by_first_letter=<?= implode ($letter);
                if (isset($state)) { ?>&filter_by_state=<?= $state;
            }?>"><?= implode ($letter);?></a>
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
            <th scope="col"><a href="/?sort=name<?php if (isset($name)) { ?>&filter_by_first_letter=<?= $name;
                };
                if (isset($state)) { ?>&filter_by_state=<?= $state;
                } ?>">Name</a></th>
            <th scope="col"><a href="/?sort=code<?php if (isset($name)) { ?>&filter_by_first_letter=<?= $name;
                };
                if (isset($state)) { ?>&filter_by_state=<?= $state;
                } ?>">Code</a></th>
            <th scope="col"><a href="/?sort=state_name<?php if (isset($name)) { ?>&filter_by_first_letter=<?= $name;
                };
                if (isset($state)) { ?>&filter_by_state=<?= $state;
                } ?>">State</a></th>
            <th scope="col"><a href="/?sort=city_name<?php if (isset($name)) { ?>&filter_by_first_letter=<?= $name;
                };
                if (isset($state)) { ?>&filter_by_state=<?= $state;
                } ?>">City</a></th>
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
            <td><a href="/?filter_by_state=<?= $airport['state_name'];
                    if (isset($name)) { ?>&filter_by_first_letter=<?= $name;
                    } ?>"><?= $airport['state_name'] ?></a></td>
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
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center flex-wrap">
            <?php echo $paginate; ?>
        </ul>
    </nav>
</main>
</html>
