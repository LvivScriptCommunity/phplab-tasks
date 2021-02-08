<?php

namespace web\tests;

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     * @param $airports
     * @param $expected
     */
    public function testPositive($airports, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($airports));
    }

    public function positiveDataProvider()
    {
        return [
            [
                [
                    ['name' => 'Bois', 'surname' => 'Fedotov'],
                    ['name' => 'Alex', 'surname' => 'Ivanov'],
                    ['name' => 'Gleb', 'surname' => 'Petrov'],
                ],
                [
                    0 => 'A',
                    1 => 'B',
                    2 => 'G',
                ]
            ],
        ];
    }
}
