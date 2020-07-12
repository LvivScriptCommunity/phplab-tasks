<?php

use PHPUnit\Framework\TestCase;

class IsSumEqualTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, isSumEqual($input));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        isSumEqual('1234');
    }

    public function positiveDataProvider()
    {
        return [
            ['123456', false],
            ['385934', true],
            ['456366', true],
            ['789564', false],
        ];
    }
}