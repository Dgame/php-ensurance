<?php

namespace Dgame\Ensurance;

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
     * @param EnsuranceInterface $ensurance
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
    }

    /**
     * @return StringEnsurance
     */
    public function isString(): StringEnsurance
    {
        $this->ensure(is_string($this->value))->orThrow('That is not a string');

        return new StringEnsurance($this);
    }

    /**
     * @return NumericEnsurance
     */
    public function isNumeric(): NumericEnsurance
    {
        $this->ensure(is_numeric($this->value))->orThrow('That is not numeric');

        return new NumericEnsurance($this);
    }

    /**
     * @return BooleanEnsurance
     */
    public function isBool(): BooleanEnsurance
    {
        $this->ensure(is_bool($this->value))->orThrow('That is not a bool');

        return new BooleanEnsurance($this);
    }
}