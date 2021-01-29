<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, SayHelloArgument($arg));
    }

    public function positiveDataProvider()
    {
        return [
            ['world', "Hello world"],
            [2021, "Hello 2021"],
            [false, "Hello "],
        ];
    }
}