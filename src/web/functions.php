<?php

/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array $airports
 * @return string[]
 * array $airports
 */
function getUniqueFirstLetters(array $airports): array
{
    // Put your logic here.
    $retunarray = [];
    foreach ($airports as $airport) {
        array_push($retunarray, substr($airport['name'], 0, 1));
    }

    $retunarray = array_unique($retunarray);
    asort($retunarray);
    return $retunarray;
}
//end getUniqueFirstLetters()

function filterByBirstLetter($firstletter, array $airports): array
{
    $retunarray = [];
    foreach ($airports as $airport) {
        if (substr($airport['name'], 0, 1) == $firstletter) {
            array_push($retunarray, $airport);
        }
    }

    asort($retunarray);
    return($retunarray);
}
//end filterByBirstLetter()

// filter_by_state
function filterByState($state, array $airports): array
{
    $retunarray = [];
    foreach ($airports as $airport) {
        if ($airport['state'] == $state) {
            array_push($retunarray, $airport);
        }
    }

    asort($retunarray);
    return($retunarray);
}
//end filterByState()

function updateUrl($url, $param = ''): string
{
    $url_parts = parse_url($url);
    if (isset($url_parts['query'])) {
        // Avoid 'Undefined index: query'
        parse_str($url_parts['query'], $params);
    } else {
        $params = [];
    }

    if ($param != '' && $param != 'page') {
        unset($params[$param]);
        $params['page'] = '0';
    } elseif ($param == 'page') {
        unset($params[$param]);
    }

    $url_parts['query'] = http_build_query($params);
    $url                = $url_parts['path'] . '?' . $url_parts['query'];
    return $url;
}
//end updateUrl()

function sort_By($sort, array $airports): array
{
    usort(
        $airports,
        function ($item1, $item2) use ($sort) {
            return ($item2[$sort] <=> $item1[$sort]);
        }
    );
    return $airports;
}
//end sort_By()
