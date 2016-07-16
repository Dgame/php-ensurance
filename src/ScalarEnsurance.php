<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\ScalarException;
use Dgame\Ensurance\Traits\ArrayEnsuranceTrait;

/**
 * Class ScalarEnsurance
 * @package Dgame\Ensurance
 */
final class ScalarEnsurance
{
    use ArrayEnsuranceTrait;

    /**
     * ScalarEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_scalar($this->value)) {
            throw new ScalarException($this);
        }
    }

    /**
     * @return StringEnsurance
     */
    public function isString() : StringEnsurance
    {
        return new StringEnsurance($this);
    }

    /**
     * @return NumericEnsurance
     */
    public function isNumeric() : NumericEnsurance
    {
        return new NumericEnsurance($this);
    }

    /**
     * @return BooleanEnsurance
     */
    public function isBool() : BooleanEnsurance
    {
        return new BooleanEnsurance($this);
    }
}