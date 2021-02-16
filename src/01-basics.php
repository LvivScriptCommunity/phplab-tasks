<?php
/**
 * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
 * Determine in which quarter of an hour the number falls.
 * Return one of the values: "first", "second", "third" and "fourth".
 * Throw InvalidArgumentException if $minute is negative of greater then 60.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $minute
 * @return string
 * @throws InvalidArgumentException
 */
function getMinuteQuarter(int $minute)
{
    $time = ceil($minute / 15);

    if ($time == 1) {
        return 'first';
    } elseif ($time == 2) {
        return 'second';
    } elseif ($time == 3) {
        return 'third';
    } elseif ($time == 4 || $time == 0) {
        return 'fourth';
    }
        throw new InvalidArgumentException('Exception is: '.$minute);
}

/**
 * The $year variable contains a year (i.e. 1995 or 2020 etc).
 * Return true if the year is Leap or false otherwise.
 * Throw InvalidArgumentException if $year is lower then 1900.
 * @see https://en.wikipedia.org/wiki/Leap_year
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $year
 * @return boolean
 * @throws InvalidArgumentException
 */
function isLeapYear(int $year)
{
    if ($year < 1900) {
        throw new InvalidArgumentException('The year is lower then 1900' . $year);
    }
    return $year % 4 == 0;
}

/**
 * The $input variable contains a string of six digits (like '123456' or '385934').
 * Return true if the sum of the first three digits is equal with the sum of last three ones
 * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
 * Throw InvalidArgumentException if $input contains more then 6 digits.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  string  $input
 * @return boolean
 * @throws InvalidArgumentException
 */
function isSumEqual(string $input)
{
    $strLength = strlen($input);

    if ($strLength !== 6) {
        throw new InvalidArgumentException('The length of the string contains more or less then 6 digits' . $input);
    }

    $firstCase = substr($input, 0, 3);
    $secondCase = substr($input, 3, 3);

    $sumFirst = [];
    $sumSecond = [];

    for ($i = 0; $i < strlen($firstCase); $i++) {
        $sumFirst[] = substr($firstCase, $i, 1);
    }
    for ($i = 0; $i < strlen($secondCase); $i++) {
        $sumSecond[] = substr($secondCase, $i, 1);
    }

    return array_sum($sumFirst) == array_sum($sumSecond);
}