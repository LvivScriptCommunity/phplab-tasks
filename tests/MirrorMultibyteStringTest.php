<?php

use PHPUnit\Framework\TestCase;

class MirrorMultibyteStringTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, mirrorMultibyteString($input));
    }

    public function positiveDataProvider()
    {
        return [
            ['ФЫВА олдж', 'АВЫФ ждло'],
            ['ПривеТ Мир', 'ТевирП риМ'],
            ['Я узнал что у меня есть огромная семья', 'Я ланзу отч у янем ьтсе яанморго яьмес'],
            ['ПХП', 'ПХП'],
        ];
    }
}