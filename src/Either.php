<?php

namespace Dgame\Ensurance;

/**
 * Class Either
 * @package Dgame\Ensurance
 */
final class Either
{
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var bool
     */
    private $ensured;

    /**
     * Either constructor.
     *
     * @param mixed $value
     * @param bool  $ensured
     */
    public function __construct($value, bool $ensured)
    {
        $this->value   = $value;
        $this->ensured = $ensured;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function or($value)
    {
        return $this->ensured ? $this->value : $value;
    }
}
