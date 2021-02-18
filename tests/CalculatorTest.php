<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use src\oop\Calculator;
use src\oop\Commands\CommandInterface;

class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    private $calc;

    /**
     * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
     */
    public function setUp(): void
    {
        $this->calc = new Calculator();
    }

    /**
     * @see https://phpunit.readthedocs.io/en/9.5/test-doubles.html
     *
     * @return MockObject
     */
    public function getCommandMock(): MockObject
    {
        return $this->getMockBuilder(CommandInterface::class)
            ->getMock();
    }

    /**
     * TODO: Check whether intents = []
     * TODO: Check whether value = 0.0
     *
     * @see PHPUnit::assertAttributeEquals
     */
    public function testInitialCalcState()
    {
    }

    /**
     * TODO: Check name exception
     *
     * @covers Calculator::addCommand()
     */
    public function testAddCommandNegative()
    {
    }

    /**
     * TODO: Check whether command is in the commands array
     *
     * @covers Calculator::addCommand()
     */
    public function testAddCommandPositive()
    {
    }

    /**
     * TODO: Check whether intents = []
     * TODO: Check whether value = expected
     *
     * @see PHPUnit :: assertAttributeEquals
     */
    public function testInit()
    {
    }

    /**
     * TODO: Check hasCommand exception
     *
     * @see PHPUnit :: dataProvider
     */
    public function testComputeNegative()
    {
    }

    /**
     * TODO: Check whether command and arguments have appeared in the intents array
     *
     * @see PHPUnit :: assertAttributeEquals
     */
    public function testComputePositive()
    {
    }

    /**
     * TODO: Check that command was executed
     *
     * Mock command`s execute method and check whether it was called at least once with the correct arguments
     *
     * @see https://phpunit.readthedocs.io/en/9.5/test-doubles.html
     *
     * @covers Calculator::getResult()
     */
    public function testGetResultPositive()
    {
    }

    /**
     * TODO: Check that command was executed with exception
     *
     * Mock command`s execute method so that it returns exception and check whether it was thrown
     *
     * @see https://phpunit.readthedocs.io/en/9.5/test-doubles.html
     *
     * @covers Calculator::getResult()
     */
    public function testGetResultNegative()
    {
    }

    /**
     * TODO: Check whether the last item in the intents array was duplicated
     */
    public function testReplay()
    {
    }

    /**
     * TODO: Check whether the last item was removed from intents array
     */
    public function testUndo()
    {
    }

    /**
     * TODO: what difference between tearDown() and tearDownAfterClass()
     *
     * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
     */
    public function tearDown(): void
    {
        unset($this->calc);
    }
}