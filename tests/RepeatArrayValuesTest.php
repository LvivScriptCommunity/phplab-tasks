<?php

use PHPUnit\Framework\TestCase;

class RepeatArrayValuesTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, repeatArrayValues($input));
    }

    public function positiveDataProvider()
    {
        return [
            [[], []],
            [[1, 2], [1, 2, 2]],
            [[3, 1, 2], [3, 3, 3, 1, 2, 2]],
            [[4], [4, 4, 4, 4]],
        ];
    }
}