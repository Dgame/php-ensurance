<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;

/**
 * Class ScalarEnsurance
 * @package Dgame\Ensurance
 */
final class ScalarEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * ScalarEnsurance constructor.
     *
     * @param $scalar
     */
    public function __construct($scalar)
    {
        enforce(is_scalar($scalar))->setThrowable(new EnsuranceException('That is not a scalar value'));

        $this->value = $scalar;
    }

    /**
     * @return StringEnsurance
     */
    public function isString(): StringEnsurance
    {
        $this->ensure(is_string($this->value))->orThrow('That is not a string');

        return new StringEnsurance($this->value);
    }

    /**
     * @return NumericEnsurance
     */
    public function isNumeric(): NumericEnsurance
    {
        $this->ensure(is_numeric($this->value))->orThrow('That is not numeric');

        return new NumericEnsurance($this->value);
    }

    /**
     * @return BooleanEnsurance
     */
    public function isBool(): BooleanEnsurance
    {
        $this->ensure(is_bool($this->value))->orThrow('That is not a bool');

        return new BooleanEnsurance($this->value);
    }
}