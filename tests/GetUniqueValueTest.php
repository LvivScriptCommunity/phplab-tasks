<?php

use PHPUnit\Framework\TestCase;

class GetUniqueValueTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueValue($input));
    }

    public function positiveDataProvider()
    {
        return [
            [[], 0],
            [[1, 2, 3, 2, 1, 5, 6], 3],
            [[1, 1, 2, 3, 3], 2],
            [[1, 1, 2, 2, 3, 3], 0],
        ];
    }
}
