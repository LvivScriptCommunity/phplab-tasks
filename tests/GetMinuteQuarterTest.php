<?php

use PHPUnit\Framework\TestCase;

class GetMinuteQuarterTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($minute, $expected)
    {
        $this->assertEquals($expected, getMinuteQuarter($minute));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        getMinuteQuarter(75);
    }

    public function positiveDataProvider()
    {
        return [
            [1, 'first'],
            [5, 'first'],
            [15, 'first'],
            [16, 'second'],
            [20, 'second'],
            [30, 'second'],
            [31, 'third'],
            [40, 'third'],
            [45, 'third'],
            [46, 'fourth'],
            [50, 'fourth'],
            [0, 'fourth'],
        ];
    }
}
