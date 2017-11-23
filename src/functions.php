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
function assertion(bool $condition, string $message = null)
{
    if (!$condition) {
        throw new \AssertionError($message ?? 'Assertion failed');
    }
}

/**
 * @param bool        $condition
 * @param string|null $message
 *
 * @throws \AssertionError
 * @deprecated Use assertion instead. `assure` is just an alias for `assertion`, since `assertion` is a more meaningful name.
 */
function assure(bool $condition, string $message = null)
{
    assertion($condition, $message);
}