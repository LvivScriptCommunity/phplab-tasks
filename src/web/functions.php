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
    // put your logic here
    $firstLetters = [];

    foreach ($airports as $airport) {
        $firstLetters[] = substr($airport['name'], 0, 1);
    }

    $uniqLetters = array_unique($firstLetters);
    sort($uniqLetters);
    return $uniqLetters;
}

function getUrl($getParametr, $parametr)
{
    $res = '';
//    if (isset($_GET['page']) && $parametr == 'filter_name') $_GET['page'] = 1;
    foreach ($getParametr as $key => $value) {
        if ($key == $parametr) continue;

        if ($parametr == 'filter_name' && $key == 'page') {
            $res .= "$key=1&";
        } else {
            $res .= "$key=$value&";
        }
    }

    return $res;
}
