<?php

namespace Dgame\Ensurance;

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
 * @param bool $condition
 *
 * @return Enforcement
 */
function enforce(bool $condition): Enforcement
{
    return new Enforcement($condition);
}
