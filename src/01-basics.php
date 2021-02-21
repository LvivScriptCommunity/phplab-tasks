<?php
/**
 * The $minute variable contains a number from 0 to 59 ( i.e. 10 or 25 or 60 etc ).
 * Determine in which quarter of an hour the number falls.
 * Return one of the values: "first", "second", "third" and "fourth".
 * Throw InvalidArgumentException if $minute is negative of greater than 60.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param int $minute
 * @return string
 * @throws InvalidArgumentException
 */

function getMinuteQuarter(int $minute)
{
    if ($minute > 0 && $minute <= 15) {
        return "first";
    }
    if ($minute > 15 && $minute <= 30) {
        return "second";
    }
    if ($minute > 30 && $minute <= 45) {
        return "third";
    }
    if ($minute <= 59 || $minute == 0) {
        return "fourth";
    }
    throw new InvalidArgumentException("Time is not valide");
}

/**
 * The $year variable contains a year ( i.e. 1995 or 2020 etc ).
 * Return true if the year is Leap or false otherwise.
 * Throw InvalidArgumentException if $year is lower than 1900.
 * @see https://en.wikipedia.org/wiki/Leap_year
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param int $year
 * @return boolean
 * @throws InvalidArgumentException
 */

function isLeapYear(int $year)
{
    if ($year < 1900) {
        throw new InvalidArgumentException("Year is lower then 1900");
    }

    return $year % 4 == 0 && $year % 100 != 0 || $year%400 == 0;
    
}

/**
 * The $input variable contains a string of six digits ( like '123456' or '385934' ).
 * Return true if the sum of the first three digits is equal with the sum of last three ones
 * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
 * Throw InvalidArgumentException if $input contains more or less than 6 digits.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param string $input
 * @return boolean
 * @throws InvalidArgumentException
 */

function isSumEqual(string $input)
{
    $arr1 = str_split(substr($input, 0, 3));
    $arr2 = str_split(substr($input, -3));

    if (mb_strlen($input) <> 6) {
        throw new InvalidArgumentException("Input contains more then 6 digits");
    }
    return array_sum($arr1) == array_sum($arr2);
}