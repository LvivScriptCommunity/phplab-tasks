<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg)
    {
        $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper($arg);
    }

    public function positiveDataProvider()
    {
        return [
            [NULL],
            [[1,2,3,4]],
            [1234],
            [['Hello', 'world']],  
            [true],
            [false]
            ];
    }
}