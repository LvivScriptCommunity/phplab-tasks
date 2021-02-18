<?php
require "../../vendor/autoload.php";

use src\oop\Calculator;
use src\oop\Commands\DivisionCommand;
use src\oop\Commands\ExpoCommand;
use src\oop\Commands\MultiCommand;
use src\oop\Commands\SubCommand;
use src\oop\Commands\SumCommand;


$calc = new Calculator();
$calc->addCommand('+', new SumCommand());
$calc->addCommand('-', new SubCommand());
$calc->addCommand('*', new MultiCommand());
$calc->addCommand('**', new ExpoCommand());
$calc->addCommand('/', new DivisionCommand());

// You can use any operation for computing
// will output 2
echo $calc->init(1)
    ->compute('+', 1)
    ->getResult();

echo "<br/>".PHP_EOL;

// Multiply operations
// will output 10
echo $calc->init(15)
    ->compute('+', 5)
    ->compute('-', 10)
    ->getResult();

echo "<br/>".PHP_EOL;

// Expo operations
// will output 8
echo $calc->init(2)
    ->compute('**', 3)
    ->getResult();

echo "<br/>".PHP_EOL;

// Multiplication operations
// will output 6
echo $calc->init(2)
    ->compute('*', 3)
    ->getResult();

echo "<br/>".PHP_EOL;

// division operations
// will output 2
echo $calc->init(6)
    ->compute('/', 3)
    ->getResult();

echo "<br/>".PHP_EOL;

// TODO implement replay method
// should output 4
echo $calc->init(1)
    ->compute('+', 1)
    ->replay()
    ->replay()
    ->getResult();

echo "<br/>".PHP_EOL;

// TODO implement undo method
// should output 1
echo $calc->init(1)
    ->compute('+', 5)
    ->compute('+', 5)
    ->undo()
    ->undo()
    ->getResult();

echo "<br/>".PHP_EOL;
