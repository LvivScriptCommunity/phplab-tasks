<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, countArgumentsWrapper(...$arg));
    }
    */
        public function testNegative()
    {
         $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper(NULL);
	}
	
	public function positiveDataProvider()
    {
        return [
            [null ,[
        'argument_count'  => 0,
        'argument_values' =>[],
				],
			],
            [["arg"],[
        'argument_count'  => 1,
        'argument_values' => ["arg"],
				],
			],
            [["arg1","arg2"],[
        'argument_count'  => 2,
        'argument_values' => ["arg1","arg2"],
				],
			],
		];

    }
}
