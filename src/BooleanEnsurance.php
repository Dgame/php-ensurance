<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\BooleanException;
use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\ArrayEnsuranceTrait;

/**
 * Class BooleanEnsurance
 * @package Dgame\Ensurance
 */
final class BooleanEnsurance
{
    use ArrayEnsuranceTrait;

    /**
     * BooleanEnsurance constructor.
     *
     * @param ScalarEnsurance $ensurance
     */
    public function __construct(ScalarEnsurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_bool($this->value)) {
            $this->triggerCascade(new BooleanException($this));
        }
    }

    /**
     * @return BooleanEnsurance
     */
    public function isTrue() : BooleanEnsurance
    {
        if (!$this->value) {
            $this->triggerCascade(new EnsuranceException('The value is not true'));
        }

        return $this;
    }

    /**
     * @return BooleanEnsurance
     */
    public function isFalse() : BooleanEnsurance
    {
        if ($this->value) {
            $this->triggerCascade(new EnsuranceException('The value is true'));
        }

        return $this;
    }
}