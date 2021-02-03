# Simple programmable calculator

Type in Google "online calculator"

You should see the simple calculator on the top of results.

This calculator is the same. It has an initial value of 0 (by default, you can use the method "init" to specify initial value) and method "getResult" for getting calculation results.

The Calculator class itself is not able to do any calculations. It requires additional Commands that can be attached on a fly and will perform calculations.

For example, SubCommand - knows how to do subtraction, SumCommand - how to do addition etc.

### How to use Calculator

```php
<?php

use src\oop\Calculator;
use src\oop\Commands\SubCommand;
use src\oop\Commands\SumCommand;

$calc = new Calculator(); // the calculator itself
$calc->addCommand('+', new SumCommand()); // here we teach calculator how to do Addition
$calc->addCommand('-', new SubCommand()); // here we teach calculator how to do Subtraction

echo $calc->init(1) // set initial value = 1
    ->compute('+', 5)
    ->compute('-', 3)
    ->getResult(); 
```

More examples can be found in the `./example.php`

## !!!
!!! This Calculator is simple and should not cover operations priorities. I.e. 2+3*5 should return 25 like simple "Google calculator" does

!!! CalculatorTest class is for the additional workshop. Do not touch it for now.

## Tasks testing

* Create unit tests for `src\oop\Commands\SubCommand`
* Create at least 3 new commands (multiplication, division, exponentiation) and cover them with unit tests
* Read more about Unit testing (like https://www.youtube.com/watch?v=k9ak_rv9X0Y&list=PLfdtiltiRHWGXSggf05W-pJbD47-_d8bJ&index=1)

## Tasks programming

* Implement UNDO method in the Calculator (see example.php)
* Implement REPLAY method in the Calculator (see example.php)
