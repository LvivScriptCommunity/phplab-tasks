<?php

/** @var \PDO $pdo */

require_once './pdo_ini.php';


/**
 * @return array
 */
$uniqLetters = function () use ($pdo) {

    $firstLetters = [];
    $sth = $pdo->prepare('SELECT DISTINCT LEFT(name,1) as L  FROM airports');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $letters = $sth->fetchAll();

    foreach ($letters as $letter) {
        $firstLetters[] = $letter["L"];
    }
    $uniq = array_unique($firstLetters);
    sort($uniq);

    return $uniq;
};

/**
 * @param  string  $letter
 * @param $sort_param
 * @return array
 */
$count = function ($data = array()) use ($pdo) {
    $sql = 'SELECT
  COUNT(*) as counts
FROM
  airports AS a
  LEFT JOIN state AS s ON s.id = a.state_id
  LEFT JOIN cities AS c ON c.id = a.city_id';


    if (!empty($data['filter_name'])) {
        $sql .= " WHERE a.name LIKE '" . $data['filter_name'] . "%'";
    }

    if (isset($data['sort'])) {
        $sql .= " ORDER BY LCASE(".$data['sort'].")";

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC, LCASE(a.name) DESC";
        } else {
            $sql .= " ASC, LCASE(a.name) ASC";
        }
    }

    $sth = $pdo->prepare($sql);

    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();

    $result = $sth->fetch();

    return $result['counts'];
};

/**
 * @param $getParametr
 * @param $parametr
 * @return string
 */
$url = function ($getParametr, $parametr)
{
    $result = '';
//    if (isset($_GET['page']) && $parametr == 'filter_name') $_GET['page'] = 1;
    foreach ($getParametr as $key => $value) {
        if ($key == $parametr) continue;

        if ($parametr == 'filter_name' && $key == 'page') {
            $result .= "$key=1&";
        } else {
            $result .= "$key=$value&";
        }
    }

    return $result;
};
/**
 * @param  array  $data
 * @return array
 */
$query = function ($data = array()) use ($pdo){
    $sql = 'SELECT
  a.name,
  a.code,
  a.address,
  a.timezone,
  s.name AS state_name,
  c.name AS city_name
FROM
  airports AS a
  LEFT JOIN state AS s ON s.id = a.state_id
  LEFT JOIN cities AS c ON c.id = a.city_id';

    $limit = 5;

    if (!empty($data['filter_name'])) {
        $sql .= " WHERE a.name LIKE '" . $data['filter_name'] . "%'";
    }

    if (isset($data['sort'])) {
        $sql .= " ORDER BY LCASE(".$data['sort'].")";

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC, LCASE(a.name) DESC";
        } else {
            $sql .= " ASC, LCASE(a.name) ASC";
        }
    }

    if (isset($data['start']) || isset($data['limit'])) {
        if ($data['start'] < 0) {
            $data['start'] = 0;
        }

        if ($data['limit'] < 1) {
            $data['limit'] = 5;
        }

        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    }

    $sth = $pdo->prepare($sql);

    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();

    $result = $sth->fetchAll();

    return $result;
};

return [
    "uniqFL" => $uniqLeterrs(),
    "getUrl" => $url,
    'count' => $count,
    "query" => $query
];
