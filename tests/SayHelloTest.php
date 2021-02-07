<?php

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
    /*
       public function testNegative($expected)
    {
        $this->assertEquals($expected, sayHello());
    }
      public function NegativeDataProvider()
    {
        return [
            ["Hello", "Hello"]
				];

    }
	
    */
	public function positiveDataProvider()
    {
        return [
            ["Hello", "Hello"],
				];

    }
}
