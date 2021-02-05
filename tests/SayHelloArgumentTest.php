<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, sayHelloArgument($input));
    }

    public function positiveDataProvider()
    {
        return [
            ['dolphin', 'Hello dolphin'],
            [true, 'Hello 1'],
            [2, 'Hello 2']
        ];
    }

}
