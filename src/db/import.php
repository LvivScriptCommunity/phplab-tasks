<?php
/**
 * TODO
 *  Open web/airports.php file
 *  Go through all airports in a loop and INSERT airports/cities/states to equivalent DB tables
 *  (make sure, that you do not INSERT the same values to the cities and states i.e. name should be unique i.e. before INSERTing check if record exists)
 */

/** @var \PDO $pdo */
require_once './pdo_ini.php';

foreach (require_once('../web/airports.php') as $item) {
    $sth = $pdo->prepare('SELECT id FROM cities WHERE name = :name');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['name' => $item['city']]);
    $city = $sth->fetch();

    if (!$city) {
        $sth = $pdo->prepare('INSERT INTO cities (name) VALUES (:name)');
        $sth->execute(['name' => $item['city']]);
        $cityId = $pdo->lastInsertId();
    } else {
        $cityId = $city['id'];
    }

    $sth = $pdo->prepare('SELECT id FROM states WHERE name = :name');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['name' => $item['state']]);
    $state = $sth->fetch();

    if (!$state) {
        $sth = $pdo->prepare('INSERT INTO states (name) VALUES (:name)');
        $sth->execute(['name' => $item['state']]);
        $stateId = $pdo->lastInsertId();
    } else {
        $stateId = $state['id'];
    }

    $sth = $pdo->prepare('SELECT id FROM airports WHERE name = :name AND code = :code AND address = :address AND timezone = : timezone AND state_id = : state_id AND city_id = : city_id');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['name' => $item['name'], 'code' => $item['code'], 'address' => $item['address'], 'timezone' => $item['timezone'], 'state_id' => $stateId, 'city_id'=> $cityId]);
    $airport = $sth->fetch();

    if (!$airport) {
        $sth = $pdo->prepare('INSERT INTO airports (name, code, address,  timezone, state_id, city_id) VALUES (:name, :code, :address, :timezone, :state_id, :city_id)');
        $sth->execute(['name' => $item['name'], 'code' => $item['code'], 'address' => $item['address'], 'timezone' => $item['timezone'], 'state_id' => $stateId, 'city_id'=> $cityId]);
    }
}