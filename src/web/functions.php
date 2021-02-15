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
    $FirstLetters = [];

    foreach ($airports as $airport) {
        $FirstLetters[] = $airport['name'][0];
    }

    sort($FirstLetters);

    return array_unique($FirstLetters);
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
    $airports_by_letter = [];

    foreach ($airports as $key => $airport) {
        if ($airport['name'][0] == $_GET['filter_by_first_letter']) {
            $airports_by_letter[] = $airport;
        }
    }

    return $airports_by_letter;
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
    $airports_by_state = [];

    foreach ($airports as $key => $airport) {
        if ($airport['state'][0] == $_GET['filter_by_state']) {
            $airports_by_state[] = $airport;
        }
    }

    return $airports_by_state;
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
    $airports_sort = [];

    foreach ($airports as $key => $airport) {
        $airports_sort[$key] = $airport[$_GET['sort']];
    }

    if (!empty($airports_sort)) {
        array_multisort($airports_sort, SORT_ASC, $airports);
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
    $get_params = [];

    if (isset($get['filter_by_first_letter'])) {
        $get_params['filter_by_first_letter'] = $get['filter_by_first_letter'];
    }

    if (isset($get['filter_by_state'])) {
        $get_params['filter_by_state'] = $get['filter_by_state'];
    }

    if (isset($get['sort'])) {
        $get_params['sort'] = $get['sort'];
    }

    $get_params = array_replace($get_params, $link);

    $url = '';
    foreach ($get_params as $key => $param) {
        $url .= "&$key=$param";
    }

    return $url;
}

/**
 * The $airports variable contains array of arrays of airports (see airports.php). It may be changed by
 * 'filterByFirstLetter' or (and) 'filterByState' functions.
 *
 * The function returns an array of arrays separated on groups according to $airportsPerPage
 *
 * @param array $airports
 * @param int $airportsPerPage
 * @param int $currentPage
 * @param int $pageQty
 * @return array
 */
function pagination(array $airports, int $airportsPerPage, int $currentPage, int $pageQty)
{
    if ($currentPage >= 1 && $currentPage <= $pageQty) {
        $from = ($currentPage - 1) * $airportsPerPage;
        $airports = array_slice($airports, $from, $airportsPerPage);

    } else {
        $airports = [];
    }

    return $airports;
}