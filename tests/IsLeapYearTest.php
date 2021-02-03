<?php

use PHPUnit\Framework\TestCase;

class IsLeapYearTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($year, $expected)
    {
        $this->assertEquals($expected, isLeapYear($year));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        isLeapYear(1500);
    }

    public function positiveDataProvider()
    {
        return [
            [1904, true],
            [1905, false],
            [1932, true],
            [1933, false],
            [1948, true],
            [1964, true],
            [1965, false],
            [2000, true],
            [2008, true],
            [2016, true],
            [2017, false],
            [2020, true],
            [2021, false],
            [2024, true],
            [2028, true],
            [2100, false],
            [2200, false],
            [2300, false],
        ];
    }
}