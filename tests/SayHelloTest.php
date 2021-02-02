<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    public function testHello()
    {
        $this->assertEquals('Hello', SayHello());
    }
}
