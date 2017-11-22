<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Enforcement\Enforcement;

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
 * @return Enforcement
 */
function enforce(bool $condition, string $message = null): Enforcement
{
    return new Enforcement($condition, $message);
}

/**
 * @param bool        $condition
 * @param string|null $message
 *
 * @throws \AssertionError
 */
function assure(bool $condition, string $message = null)
{
    if (!$condition) {
        throw new \AssertionError($message ?? 'Assertion failed');
    }
}