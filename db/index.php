<?php
/**
 * Connect to DB
 */

$func = require_once './function.php';
$filter = [];
$chank = 5;

    /**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */

$uniqueFirstLetters = $func['uniqFL'];

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
if (isset($_GET['filter_name'])) {
    $filter['filter_name'] = $_GET['filter_name'];
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
if (isset($_GET['sort'])) {
    $filter['sort'] = $_GET['sort'];
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
// Establish the $pageNum variable
$pageNum = 1;
// Get pageNum from URL vars if it is present, else it is = 1
if (isset($_GET['page'])) {
    $pageNum = preg_replace('#[^0-9]#', '', $_GET['page']);
}

if (empty($_GET['page']) || $pageNum == 1) {
    $start_val = 0;
} else {
    $start_val = ($pageNum * $chank) - $chank;
}

$filter['start'] = $start_val;
$filter['limit'] = $chank;

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */
$airports = $func['query']($filter);

$page = $_GET['page'] ?: 1;

$result = $func['count']($filter);

$page = intval($page);

$total_data = floor($result / $chank);

$last = ceil($total_data / $chank);

if ($last < 1) {
    $last = 1;
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pageNum < 1) {
    $pageNum = 1;
} elseif ($pageNum > $last) {
    $pageNum = $last;
}
// Establish the $paginationCtrls variable
$paginationCtrls = '';

if ($last != 1) {
    $url = $func['getUrl']($_GET, 'page');

    if ($pageNum > 1) {
        $previous = $pageNum - 1;
        $paginationCtrls .= '<li class="page-item"><a class="page-link" href="?' . $url . 'page=' . $previous . '">Previous</a> </li>&nbsp; &nbsp; ';
        for ($i = $pageNum - 4; $i < $pageNum; $i++) {
            if ($i > 0) {
                $paginationCtrls .= '<li class="page-item"><a class="page-link" href="?' . $url . 'page=' . $i . '">' . $i . '</a> </li>&nbsp; ';
            }
        }
    }

    $paginationCtrls .= '<li class="page-item active"><a class="page-link" href="#">' . $pageNum . '</a></li>';

    for ($i = $pageNum + 1; $i <= $last; $i++) {
        $paginationCtrls .= '<li class="page-item"><a class="page-link" href="?' . $url . 'page=' . $i . '">' . $i . '</a> </li>&nbsp; ';
        if ($i >= $pageNum + 4) {
            break;
        }
    }

    if ($pageNum != $last) {
        $next = $pageNum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp;  <li class="page-item"><a class="page-link" href="?' . $url . 'page=' . $next . '">Next</a></li>';
    }
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
            <?php if (!empty($_GET)) : ?>
                <a href="?<?= $func['getUrl']($_GET, "filter_name"); ?>filter_name=<?= $letter ?>"><?= $letter ?></a>
            <?php else: ?>
                <a href="?filter_name=<?= $letter ?>"><?= $letter ?></a>
            <?php endif; ?>
        <?php endforeach; ?>

        <a href="/src/db/" class="float-right">Reset all filters</a>
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
            <?php if (!empty($_GET)) : ?>
                <th scope="col"><a href="?<?= $func['getUrl']($_GET, "sort"); ?>sort=a.name">Name</a></th>
                <th scope="col"><a href="?<?= $func['getUrl']($_GET, "sort"); ?>sort=a.code">Code</a></th>
                <th scope="col"><a href="?<?= $func['getUrl']($_GET, "sort"); ?>sort=s.name">State</a></th>
                <th scope="col"><a href="?<?= $func['getUrl']($_GET, "sort"); ?>sort=c.name">City</a></th>
            <?php else: ?>
                <th scope="col"><a href="?sort=a.name">Name</a></th>
                <th scope="col"><a href="?sort=a.code">Code</a></th>
                <th scope="col"><a href="?sort=s.name">State</a></th>
                <th scope="col"><a href="?sort=c.name">City</a></th>
            <?php endif; ?>
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
            <td><?= $airport['state_name'] ?></td>
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
        <ul class="pagination justify-content-center">
            <?= $paginationCtrls; ?>
        </ul>
    </nav>

</main>
</html>
