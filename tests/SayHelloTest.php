<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($expected)
    {
        $this->assertEquals($expected, sayHello());
    }

    public function positiveDataProvider()
    {
        return [
            ['Hello']
        ];
    }
}
