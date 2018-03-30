<?php

namespace Dgame\Ensurance;

use AssertionError;

/**
 * @param $value
 *
 * @return Ensurance
 */
function ensure($value): Ensurance
{
    return new Ensurance($value);
}

/**
 * @param bool        $condition
 * @param string|null $message
 *
 * @return BooleanEnsurance
 */
function enforce(bool $condition, string $message = null): BooleanEnsurance
{
    $error     = new AssertionError($message ?? 'Assertion failed');
    $ensurance = new BooleanEnsurance($condition);
    $ensurance->setThrowable($error);

    return $ensurance;
}

/**
 * @param string $message
 * @param mixed  ...$args
 *
 * @return string
 */
function format(string $message, ...$args): string
{
    if (empty($args)) {
        return $message;
    }

    foreach ($args as &$arg) {
        if (is_array($arg) || is_object($arg)) {
            $arg = print_r($arg, true);
        }
    }

    return sprintf($message, ...$args);
}
