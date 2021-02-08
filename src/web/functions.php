<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param array $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports)
{
    foreach ($airports as $airport) {
        $firstLetter[] = mb_substr($airport['name'], 0, 1);
    }
    $airports = array_unique($firstLetter);
    sort($airports);

    return $airports;
}

function getUniqueFilterFirstLetter(array $airports)
{
    $filterAirports = [];
    foreach ($airports as $airport) {
        if ($_GET ['filter_by_first_letter'] == $airport['name'][0]) {
            $filterAirports[] = $airport;
        }
    }
    $lastpage = count($airports);
    var_dump($lastpage);
    return $filterAirports;
}

function getFilterBySstate(array $airports)
{
    $filterState = [];
    foreach ($airports as $airport) {
        if ($_GET ['filter_by_state'] == $airport['state']) {
            $filterState[] = $airport;
        }
    }

    return $filterState;
}

function getSort(array $airports)
{
    $sort = array_column($airports, $_GET['sort']);
    array_multisort($sort, SORT_ASC, $airports);

    return $airports;
}

function getPagination($airports, $pageSize = 5, $page = 1)
{
    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 5;
    $startpoint = ($page * $limit) - $limit;
    $total = count($airports);
    $lastpage = ceil($total / $pageSize);
    var_dump($page);
    return array_slice($airports, $startpoint, $pageSize);
}

function pagination($airports, $name, $state, $per_page = 5, $page = 1)
{
    $total = count($airports);
    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $lastpage = ceil($total / $per_page);
    $pagination = "";

    for ($counter = 1; $counter <= $lastpage; $counter++):
        if ($counter == $page) {
            $pagination .= "<li class='page-item active'><a class='current page-link page-item'>$counter</a></li>";
        } else if (isset($name) && isset($state)) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&filter_by_first_letter=$name&filter_by_state=$state'>$counter</a></li>";
        } else if (isset($state)) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&filter_by_state=$state'>$counter</a></li>";
        } else if (isset($name)) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&filter_by_first_letter=$name'>$counter</a></li>";
        } else {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter'>$counter</a></li>";
        }
    endfor;

    return $pagination;
}

