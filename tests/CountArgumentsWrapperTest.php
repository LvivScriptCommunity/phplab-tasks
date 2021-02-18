<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, countArgumentsWrapper($input));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper(array('some text'));
    }

    public function positiveDataProvider()
    {
        return [
            ['Hello World!',[
                'argument_count'  => 1,
                'argument_values' => ['Hello World!'],
            ]],
            ['Miracle',[
                'argument_count'  => 1,
                'argument_values' => ["Miracle"],
            ]],
            ["Some Text",[
                'argument_count'  => 1,
                'argument_values' => ["Some Text"],
            ]]
        ];
    }
}
