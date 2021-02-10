<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        sayHelloArgumentWrapper(null);
    }


    public function positiveDataProvider()
    {
        return [
            ["anas", "Hello anas"],
                ];
    }
}
