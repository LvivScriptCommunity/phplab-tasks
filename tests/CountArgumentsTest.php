<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     * @param $input
     * @param $expected
     */
    public function testPositive($expected, $input)
    {
        $this->assertEquals($expected, countArguments(...$input));
    }

    public function positiveDataProvider()
    {
        return [
            [
                ['argument_count' => 2, 'argument_values' => ['String 1', 'String 2']], ['String 1', 'String 2']
            ],

            [
                ['argument_count' => 1, 'argument_values' => ['String 1']], ['String 1']
            ],

            [
                ['argument_count' => 0, 'argument_values' => []], []
            ]
        ];
    }
}
