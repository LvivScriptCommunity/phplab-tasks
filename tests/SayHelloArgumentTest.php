<?php

use PHPUnit\Framework\TestCase;

class sayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, sayHelloArgument($arg));
    }
    /*
       public function testNegative ($arg, $expected)
    {
         $this->expectException(InvalidArgumentException::class);

        getMinuteQuarter(75);
    }
      public function negativeDataProvider()
    {
        return [
            ["Hello", "Hello"]
				];

    }
	
    */
	public function positiveDataProvider()
    {
        return [
            ["anas", "Hello anas"],
            [33, "Hello anas"],
            [false, "Hello anas"],
				];

    }
}
