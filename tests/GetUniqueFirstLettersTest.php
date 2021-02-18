<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($minute, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($minute));
    }

    public function positiveDataProvider()
    {
        return [
            [[
                [
                    "name" => "Austin Bergstrom International Airport",
                    "code" => "AUS",
                    "city" => "Austin",
                    "state" => "Texas",
                    "address" => "3600 Presidential Blvd, Austin, TX 78719, USA",
                    "timezone" => "America/Los_Angeles",
                ],
                [
                    "name" => "Boise Airport",
                    "code" => "BOI",
                    "city" => "Boise",
                    "state" => "Idaho",
                    "address" => "3201 W Airport Way #1000, Boise, ID 83705, USA",
                    "timezone" => "America/Denver",
                ]
            ], ['A','B']
            ]
        ];
    }
}
