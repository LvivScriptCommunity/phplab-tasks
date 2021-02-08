<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
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

// Формируем массив $airports в зависимости от GET-параметра filter_by_first_letter
function filterByFirstLetter($airports)
{
    $airports_by_letter = [];

    // Записываем в массив те элементы массива, у которых первая буква значения ключа 'name' равна значению
    //get-параметра 'filter_by_first_letter'
    foreach ($airports as $key => $airport) {
        if ($airport['name'][0] == $_GET['filter_by_first_letter']) {
            $airports_by_letter[] = $airport;
        }
    }

    return $airports_by_letter;
}

// Формируем массив $airports в зависимости от GET-параметра filter_by_state
function filterByState($airports)
{
    $airports_by_state = [];

    // Записываем в массив те элементы массива, у которых первая буква значения ключа 'state' равна значению
    //get-параметра 'filter_by_state'
    foreach ($airports as $key => $airport) {
        if ($airport['state'][0] == $_GET['filter_by_state']) {
            $airports_by_state[] = $airport;
        }
    }

    return $airports_by_state;
}

// Сортируем массив $airports в зависимости от GET-параметра sort
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

// Функция формирования ссылки с учётом существующих GET-параметров
function getLink($get, array $link = [])
{
    # Массив с GET-параметрами
    $get_params = [];

    // Проверка наличия get-параметра filter_by_first_letter
    if (isset($get['filter_by_first_letter'])) {
        $get_params['filter_by_first_letter'] = $get['filter_by_first_letter'];
    }

    // Проверка наличия get-параметра filter_by_state
    if (isset($get['filter_by_state'])) {
        $get_params['filter_by_state'] = $get['filter_by_state'];
    }

    // Проверка наличия get-параметра sort
    if (isset($get['sort'])) {
        $get_params['sort'] = $get['sort'];
    }

    // Объединение существующего массива с get-параметрами и новыми
    $get_params = array_replace($get_params, $link);

    # Преобразование массива в строку с GET-параметрами
    $url = '';
    foreach ($get_params as $key => $param) {
        $url .= "&$key=$param";
    }

    return $url;
}

// Формирование списка аэропортов для пагинации
function pagination(array $airports, int $airportsPerPage, int $currentPage, int $pageQty)
{
    // Распределяем массив airports на общее количество страниц
    if ($currentPage >= 1 && $currentPage <= $pageQty) {
        $from = ($currentPage - 1) * $airportsPerPage;
        $airports = array_slice($airports, $from, $airportsPerPage);

    } else {
        $airports = [];
    }

    return $airports;
}