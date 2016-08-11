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
     * @var bool
     */
    private $condition = true;
    /**
     * @var string
     */
    private $message = 'Assertion failed';

    /**
     * Enforcement constructor.
     *
     * @param bool $condition
     */
    public function __construct(bool $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @throws EnsuranceException
     */
    public function __destruct()
    {
        if ($this->condition === false) {
            throw new EnsuranceException($this->message);
        }
    }

    /**
     * @param string $message
     * @param array  ...$args
     */
    public function orThrow(string $message, ...$args)
    {
        if ($this->condition === false) {
            if (!empty($args)) {
                $message = sprintf($message, ...$args);
            }

            $this->message = $message;
        }
    }
}

/**
 * @param bool $condition
 *
 * @return Enforcement
 */
function enforce(bool $condition) : Enforcement
{
    return new Enforcement($condition);
}