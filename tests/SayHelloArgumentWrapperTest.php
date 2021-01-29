<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg)
    {
         $this->expectException(InvalidArgumentException::class);

        sayHelloArgumentWrapper($arg);
    }

    public function positiveDataProvider()
    {
        return [
            [NULL],
            [[1,2,3,4]],
            [['Hello', 'world']],          
        ];
    }
}


