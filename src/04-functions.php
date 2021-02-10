<?php

/**
 * Create a PhpUnit test (SayHelloTest) which will check that function below returns a correct result
 * i.e. returns 'Hello'
 *
 * @return string
 */

function sayHello()
{
    return 'Hello';
}

/**
 * Create a PhpUnit test (SayHelloArgumentTest) which will check that function below returns a correct result
 * Check how it works with: number, string, bool value
 *
 * @param $arg
 * @return string
 */
function sayHelloArgument($arg)
{
    return "Hello $arg";
}

/**
 * What can be put instead of placeholder
 * so that function throws an InvalidArgumentException if $arg is not: number, string or bool
 *
 * Create a PhpUnit test (SayHelloArgumentWrapperTest) which will check this behavior
 * !!! you need to test only exceptional case, since the behavior of sayHelloArgument was already tested in the task above
 *
 * @param $arg
 * @return string
 * @throws InvalidArgumentException
 */
function sayHelloArgumentWrapper($arg)
{
    if (is_int($arg) || is_bool($arg) || is_string($arg)) {
        return sayHelloArgument($arg);
    } else {
        throw new InvalidArgumentException("type error");
    }
}

/**
 * Create a PhpUnit test (CountArgumentsTest) which will check that function below returns correct result
 * Check how it works with: no arguments, one string argument, a couple of string arguments
 *
 * @return array
 */
function countArguments()
{
    return [
        'argument_count'  => func_num_args(),
        'argument_values' => func_get_args(),
    ];
}

/**
 * Fulfill a function countArgumentsWrapper so that it will call the original function (countArguments)
 * but check if all arguments are strings and throws an InvalidArgumentException otherwise
 *
 * Create a PhpUnit test (CountArgumentsWrapperTest) which will check this behavior
 * !!! you need to test only exceptional case, since the behavior of countArguments was already tested in the task above
 *
 * You will need to use "Argument unpacking via ..." to pass the parameters to wrapped function:
 * @see https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.splat
 *
 * @return array
 * @throws InvalidArgumentException
 */
function countArgumentsWrapper()
{
    $args = func_get_args();
    foreach ($args as $values) {
        if (!is_string($values)) {
            throw new InvalidArgumentException("arg not string");
            exit();
        }
    }
    countArguments(...$args);
    // put your code here
}
