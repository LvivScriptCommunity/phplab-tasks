<?php
include '../../vendor/autoload.php';

use src\oop\Calculator;
use src\oop\Commands\SubCommand;
use src\oop\Commands\SumCommand;
use src\oop\Commands\MultiplicationCommand;
use src\oop\Commands\DivisionCommand;
use src\oop\Commands\ExponentiationCommand;

$calc = new Calculator();
$calc->addCommand('+', new SumCommand());
$calc->addCommand('-', new SubCommand());
$calc->addCommand('*', new MultiplicationCommand());
$calc->addCommand('/', new DivisionCommand());
$calc->addCommand('**', new ExponentiationCommand());

// You can use any operation for computing
// will output 2
echo $calc->init(1)
    ->compute('+', 1)
    ->getResult();

echo PHP_EOL;

// Multiply operations
// will output 10
echo $calc->init(15)
    ->compute('+', 5)
    ->compute('-', 10)
    ->getResult();

echo PHP_EOL;

// TODO implement replay method
// should output 4
echo $calc->init(1)
    ->compute('+', 1)
    ->replay()
    ->replay()
    ->getResult();

echo PHP_EOL;

// TODO implement undo method
// should output 1
echo $calc->init(1)
    ->compute('+', 5)
    ->compute('+', 5)
    ->undo()
    ->undo()
    ->getResult();

echo PHP_EOL;

// will output 15
echo $calc->init(3)
    ->compute('*', 5)
    ->getResult();
echo PHP_EOL;

// will output 6
echo $calc->init(30)
    ->compute('/', 5)
    ->getResult();
echo PHP_EOL;

// will output 32
echo $calc->init(2)
    ->compute('**', 5)
    ->getResult();
echo PHP_EOL;

