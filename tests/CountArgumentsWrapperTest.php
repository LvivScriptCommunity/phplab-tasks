<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper(null);
    }

    public function positiveDataProvider()
    {
        return [
            [null ,[
        'argument_count'  => 0,
        'argument_values' => [],
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
