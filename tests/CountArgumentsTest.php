<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, countArguments(...$arg));
    }

    public function positiveDataProvider()
    {
        return [
            [[], ['argument_count' => 0, 'argument_values' => []]],
            [['arg'], ['argument_count' => 1, 'argument_values' => ['arg']]],
            [['arg','count'], ['argument_count' => 2, 'argument_values' => ['arg','count']]],
            ];
    }
}