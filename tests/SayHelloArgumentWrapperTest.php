<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, sayHelloArgument($arg));
    }
   */
       public function testNegative()
    {
         $this->expectException(InvalidArgumentException::class);

        sayHelloArgumentWrapper(NULL);
	}
   
   
	public function positiveDataProvider()
    {
        return [
            ["anas", "Hello anas"],
     			];

    }
    
}
