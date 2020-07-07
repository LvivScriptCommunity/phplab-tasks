<?php

use PHPUnit\Framework\TestCase;

class SnakeCaseToCamelCaseTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, snakeCaseToCamelCase($input));
    }

    public function positiveDataProvider()
    {
        return [
            ['hello_world', 'helloWorld'],
            ['this_is_home_task', 'thisIsHomeTask'],
            ['string', 'string'],
        ];
    }
}