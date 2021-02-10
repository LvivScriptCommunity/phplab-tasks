<?php

use PHPUnit\Framework\TestCase;

class sayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, sayHelloArgument($arg));
    }
    public function positiveDataProvider()
    {
        return [
            ["anas", "Hello anas"],
            [33, "Hello anas"],
            [false, "Hello anas"],
                ];
    }
}
