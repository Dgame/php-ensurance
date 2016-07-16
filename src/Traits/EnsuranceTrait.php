<?php

namespace Dgame\Ensurance\Traits;

/**
 * Class EnsuranceTrait
 * @package Dgame\Ensurance\Traits
 */
trait EnsuranceTrait
{
    /**
     * @var null|mixed
     */
    private $value = null;

    /**
     * @return mixed|null
     */
    final public function getValue()
    {
        return $this->value;
    }
}