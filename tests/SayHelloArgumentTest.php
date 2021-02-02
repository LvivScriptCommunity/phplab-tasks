<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     * @param $arg
     * @param $expected
     */

    public function testPositive($arg, $expected)
    {
        $this->assertIsString($expected, SayHelloArgument($arg));
    }

    public function positiveDataProvider()
    {
        return [
            [5, 'Hello 5'],
            ['Alex', 'Hello Alex'],
            [true, 'Hello true']
        ];
    }

}
