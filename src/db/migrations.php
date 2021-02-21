<?php
/**
 * TODO
 *  Write DPO statements to create following tables:
 *
 *  # airports
 *   - id (unsigned int, autoincrement)
 *   - name (varchar)
 *   - code (varchar)
 *   - city_id (relation to the cities table)
 *   - state_id (relation to the states table)
 *   - address (varchar)
 *   - timezone (varchar)
 *
 *  # cities
 *   - id (unsigned int, autoincrement)
 *   - name (varchar)
 *
 *  # states
 *   - id (unsigned int, autoincrement)
 *   - name (varchar)
 */

/** @var \PDO $pdo */
require_once './pdo_ini.php';

// cities
$sql = <<<'SQL'
CREATE TABLE IF NOT EXISTS `cities` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`)
);
SQL;
$pdo->exec($sql);

$sql = <<<'SQL'
CREATE TABLE IF NOT EXISTS `states` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',	
	PRIMARY KEY (`id`)
);
SQL;
$pdo->exec($sql);

$sql = <<<'SQL'
CREATE TABLE IF NOT EXISTS `airports` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`code` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`address` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`timezone` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`city_id` INT(10) NOT NULL,
	`state_id` INT(10) NOT NULL,
	PRIMARY KEY (`id`)
);
SQL;
$pdo->exec($sql);