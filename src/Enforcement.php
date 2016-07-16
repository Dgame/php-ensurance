<?php

namespace Dgame\Ensurance;
use Dgame\Ensurance\Exception\EnsuranceException;

/**
 * Class Enforcement
 * @package Dgame\Ensurance
 */
final class Enforcement
{
    /**
     * Enforcement constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        set_exception_handler(function(EnsuranceException $exception) use ($message) {
            \Dgame\Conditional\condition(true)->output($message . PHP_EOL . $exception . PHP_EOL);
        });
    }

    /**
     *
     */
    public function __destruct()
    {
        restore_exception_handler();
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function ensure($value) : Ensurance
    {
        return new Ensurance($value);
    }
}

/**
 * @param string $message
 * @param array  ...$args
 *
 * @return Enforcement
 */
function enforce(string $message, ...$args) : Enforcement
{
    if (!empty($args)) {
        $message = sprintf($message, ...$args);
    }

    return new Enforcement($message);
}