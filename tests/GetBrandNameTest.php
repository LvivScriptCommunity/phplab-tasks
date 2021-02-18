<?php

use PHPUnit\Framework\TestCase;

class GetBrandNameTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getBrandName($input));
    }

    public function positiveDataProvider()
    {
        return [
            ['dolphin', 'The Dolphin'],
            ['alaska', 'Alaskalaska'],
            ['europe', 'Europeurope'],
            ['php', 'Phphp'],
            ['the', 'The The'],
        ];
    }
}