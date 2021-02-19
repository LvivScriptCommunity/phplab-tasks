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
    // Cities
    // To check if city with this name exists in the DB we need to SELECT it first
    $sth = $pdo->prepare('SELECT id FROM cities WHERE name = :name');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['name' => $item['city']]);
    $city = $sth->fetch();

    // If result is empty - we need to INSERT city
    if (!$city) {
        $sth = $pdo->prepare('INSERT INTO cities (name) VALUES (:name)');
        $sth->execute(['name' => $item['city']]);

        // We will use this variable to INSERT airport
        $cityId = $pdo->lastInsertId();
    } else {
        // We will use this variable to INSERT airport
        $cityId = $city['id'];
    }

    // TODO States
    // States
    // To check if states with this name exists in the DB we need to SELECT it first
    $sthStates = $pdo->prepare('SELECT id FROM state WHERE name = :name');
    $sthStates->setFetchMode(\PDO::FETCH_ASSOC);
    $sthStates->execute(['name' => $item['state']]);
    $state = $sthStates->fetch();

    // If result is empty - we need to INSERT city
    if (!$state) {
        $sth = $pdo->prepare('INSERT INTO state (name) VALUES (:name)');
        $sth->execute(['name' => $item['state']]);

        // We will use this variable to INSERT airport
        $stateId = $pdo->lastInsertId();
    } else {
        // We will use this variable to INSERT airport
        $stateId = $state['id'];
    }

    // TODO Airports
    // Airports
    // To check if airports with this name exists in the DB we need to SELECT it first
    $sthAirports = $pdo->prepare('SELECT id FROM airports WHERE name = :name');
    $sthAirports->setFetchMode(\PDO::FETCH_ASSOC);
    $sthAirports->execute(['name' => $item['name']]);
    $airports = $sthAirports->fetch();

    if (!$airports) {
        $sthAirports = $pdo->prepare(
            'INSERT INTO airports (name,state_id,city_id,code,address,timezone) VALUES (:name, :state_id, :city_id, :code, :address, :timezone)'
        );
        $answer = $sthAirports->execute(
            [
                'name' => $item['name'],
                'state_id' => $stateId,
                'city_id' => $cityId,
                "code" => $item['code'],
                "address" => $item['address'],
                "timezone" => $item['timezone']
            ]
        );
        $airportsId = $pdo->lastInsertId();
    } else {
        $airportsId = $airports['id'];
    }
}
