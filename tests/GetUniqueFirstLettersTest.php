<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($airports, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($airports));
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
                    "name" => "Nashville Metropolitan Airport 1",
                    "code" => "BNA",
                    "city" => "Nashville",
                    "state" => "Tennessee",
                    "address" => "1 Terminal Dr, Nashville, TN 37214, USA",
                    "timezone" => "America/Chicago",
                ],
                [
                    "name" => "Boise Airport",
                    "code" => "BOI",
                    "city" => "Boise",
                    "state" => "Idaho",
                    "address" => "3201 W Airport Way #1000, Boise, ID 83705, USA",
                    "timezone" => "America/Denver",
                ]
                ],
                ['A', 'B', 'N']
                ]
            ];
    }
}

