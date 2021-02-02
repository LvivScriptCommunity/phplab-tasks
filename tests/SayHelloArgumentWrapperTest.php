<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider exceptionDataProvider
     * @param $arg
     * @param $expectedException
     */
    public function testException($arg, $expectedException)
    {
        $this->expectException($expectedException);
        sayHelloArgumentWrapper($arg);
    }

    public function exceptionDataProvider()
    {
        return [
            [[], '\InvalidArgumentException'],
            [null, '\InvalidArgumentException'],
            [new stdClass(), '\InvalidArgumentException'],
            [fopen('test.file', 'w'), '\InvalidArgumentException']
        ];
    }
}
