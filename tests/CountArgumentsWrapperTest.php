<?php


use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    /**
     * @dataProvider exceptionDataProvider
     * @param $input
     * @param $expectedException
     */
    public function testException($expectedException, $input)
    {
        $this->expectException($expectedException);
        countArgumentsWrapper(...$input);
    }

    public function exceptionDataProvider()
    {
        return [
            ['\InvalidArgumentException', ['1', null, 25]]
        ];
    }
}
