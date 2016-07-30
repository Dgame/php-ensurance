<?php

namespace Dgame\Ensurance\Traits;

use Dgame\Ensurance\Exception\ArrayKeyException;
use Dgame\Ensurance\Exception\ArrayValueException;

/**
 * Class ArrayEnsuranceTrait
 * @package Dgame\Ensurance\Traits
 */
trait ArrayEnsuranceTrait
{
    use EnsuranceTrait, ExceptionCascadeTrait;

    /**
     * @param array $values
     *
     * @return $this
     */
    final public function isValueOf(array $values)
    {
        if (!in_array($this->value, $values)) {
            $this->triggerCascade(new ArrayValueException('"%s" is not a value of the given array', $this->value));
        }

        return $this;
    }

    /**
     * @param array $values
     *
     * @return $this
     */
    final public function isNotValueOf(array $values)
    {
        if (in_array($this->value, $values)) {
            $this->triggerCascade(new ArrayValueException('"%s" is a value of the given array', $this->value));
        }

        return $this;
    }

    /**
     * @param array $values
     *
     * @return $this
     */
    final public function isKeyOf(array $values)
    {
        if (!array_key_exists($this->value, $values)) {
            $this->triggerCascade(new ArrayKeyException('"%s" is not a key of the given array', $this->value));
        }

        return $this;
    }

    /**
     * @param array $values
     *
     * @return $this
     */
    final public function isNotKeyOf(array $values)
    {
        if (array_key_exists($this->value, $values)) {
            $this->triggerCascade(new ArrayKeyException('"%s" is a key of the given array', $this->value));
        }

        return $this;
    }
}