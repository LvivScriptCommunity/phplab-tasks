<?php
use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    public function testFailure()
    {
        $arg =true;
        $this->assertIsString(SayHelloArgument($arg));
    }
}
