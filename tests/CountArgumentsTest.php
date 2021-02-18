<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, countArguments($input));
    }

    public function testEmpty()
    {
        $this->assertEquals(
            [
                'argument_count' => 0,
                'argument_values' => [],
            ],
            countArguments()
        );
    }

    public function testTwoParameters()
    {
        $this->assertEquals(
            [
                'argument_count' => 2,
                'argument_values' => ["Hello World!", "Some Text"],
            ],
            countArguments("Hello World!", "Some Text")
        );
    }

    public function positiveDataProvider()
    {
        return [
            [
                'Hello World!',
                [
                    'argument_count' => 1,
                    'argument_values' => ['Hello World!'],
                ]
            ]
        ];
    }

}
