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
    $firstLetters = [];
    foreach ($airports as $airport) {
        $firstLetters[] = $airport['name'][0];
    }
    sort($firstLetters);

    return array_unique($firstLetters);
}

/**
 * The $airports variable contains array of arrays of airports (see airports.php). It may be changed by
 * 'filterByState' function.
 *
 * The function returns an array of arrays, in each of which the 'name' field starts with a letter equal to
 * $_GET['filter_by_first_letter']
 *
 * @param array $airports
 * @return array
 */
function filterByFirstLetter($airports)
{
    $airportsByLetter = [];
    foreach ($airports as $key => $airport) {
        if ($airport['name'][0] == $_GET['filter_by_first_letter']) {
            $airportsByLetter[] = $airport;
        }
    }

    return $airportsByLetter;
}

/**
 * The $airports variable contains array of arrays of airports (see airports.php). It may be changed by
 * 'filterByFirstLetter' function.
 *
 * The function returns an array of arrays, in each of which the 'state' field starts with a letter equal to
 * $_GET['filter_by_state']
 *
 * @param array $airports
 * @return array
 */
function filterByState($airports)
{
    $airportsByState = [];
    foreach ($airports as $key => $airport) {
        if ($airport['state'][0] == $_GET['filter_by_state']) {
            $airportsByState[] = $airport;
        }
    }

    return $airportsByState;
}

/**
 * The $airports variable contains array of arrays of airports (see airports.php). It may be changed by
 * 'filterByFirstLetter' or (and) 'filterByState' functions.
 *
 * The function returns an array of arrays sorted according to $_GET['sort']
 *
 * @param  array  $airports
 * @return array
 */
function sortAirports($airports)
{
    $airportsSorting = [];
    foreach ($airports as $key => $airport) {
        $airportsSorting[$key] = $airport[$_GET['sort']];
    }
    if (!empty($airportsSorting)) {
        array_multisort($airportsSorting, SORT_ASC, $airports);
    }

    return $airports;
}

/**
 * The function checks $_GET and adds into it new parameters
 *
 * The function returns string which includes new parameters
 *
 * @param array $get parameters from $_GET
 * @param array $link new parameters
 * @return string
 */
function getLink($get, array $link = [])
{
    $getParameter = [];
    if (isset($get['filter_by_first_letter'])) {
        $getParameter['filter_by_first_letter'] = $get['filter_by_first_letter'];
    }
    if (isset($get['filter_by_state'])) {
        $getParameter['filter_by_state'] = $get['filter_by_state'];
    }
    if (isset($get['sort'])) {
        $getParameter['sort'] = $get['sort'];
    }

    $getParameter = array_replace($getParameter, $link);
    $link = '';
    foreach ($getParameter as $key => $param) {
        $link .= "&$key=$param";
    }

    return $link;
}

/**
 * The $airports variable contains array of arrays of airports (see airports.php). It may be changed by
 * 'filterByFirstLetter' or (and) 'filterByState' functions.
 *
 * The function returns an array of arrays separated on groups according to $airportsPerPage
 *
 * @param array $airports
 * @return array
 */
function realizationPagination(array $airports, int $airportsPerPage, int $numberPages, int $page)
{
    if ($numberPages >= 1 && $numberPages <= $page) {
        $from = ($numberPages - 1) * $airportsPerPage;
        $airports = array_slice($airports, $from, $airportsPerPage);

    } else {
        $airports = [];
    }

    return $airports;
}