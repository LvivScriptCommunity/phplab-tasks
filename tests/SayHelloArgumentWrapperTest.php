<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, sayHelloArgumentWrapper($input));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        sayHelloArgumentWrapper(array('some text'));
    }

    public function positiveDataProvider()
    {
        return [
            ['World!','Hello World!'],
            ['Nick', 'Hello Nick']
        ];
    }
}
