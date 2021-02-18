<?php

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
    // To check if State with this name exists in the DB we need to SELECT it first
    $sth = $pdo->prepare('SELECT id FROM states WHERE name = :name');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['name' => $item['state']]);
    $state = $sth->fetch();
    // If result is empty - we need to INSERT city
    if (!$state) {
        $sth = $pdo->prepare('INSERT INTO states (name) VALUES (:name)');
        $sth->execute(['name' => $item['state']]);
    // We will use this variable to INSERT airport
        $stateId = $pdo->lastInsertId();
    } else {
    // We will use this variable to INSERT airport
        $stateId = $state['id'];
    }

    // TODO Airports
    $sql = <<<'SQL'
    INSERT INTO airports 
        (name,code,city_id,state_id,address,timezone) 
        VALUES (:name,:code,:city_id,:state_id,:address,:timezone)
    SQL;
    $sth = $pdo->prepare($sql);
    $sth->execute(['name' => $item['name'],'code' => $item['code'],'city_id' => $cityId,'state_id' => $stateId,
        'address' => $item['address'], 'timezone' => $item['timezone']]);
}
