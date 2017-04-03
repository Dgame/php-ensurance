<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;

/**
 * Class ScalarEnsurance
 * @package Dgame\Ensurance
 */
final class ScalarEnsurance
{
    /**
     * @var bool|float|int|string
     */
    private $scalar;

    use EnforcementTrait;

    /**
     * ScalarEnsurance constructor.
     *
     * @param $scalar
     *
     * @throws EnsuranceException
     */
    public function __construct($scalar)
    {
        if (!is_scalar($scalar)) {
            throw new EnsuranceException('That is not a scalar value');
        }

        $this->scalar = $scalar;
    }

    /**
     * @return StringEnsurance
     */
    public function isString(): StringEnsurance
    {
        $this->enforce(is_string($this->scalar))->orThrow('That is not a string');

        return new StringEnsurance($this->scalar);
    }

    /**
     * @return NumericEnsurance
     */
    public function isNumeric(): NumericEnsurance
    {
        $this->enforce(is_numeric($this->scalar))->orThrow('That is not numeric');

        return new NumericEnsurance($this->scalar);
    }

    /**
     * @return BooleanEnsurance
     */
    public function isBool(): BooleanEnsurance
    {
        $this->enforce(is_bool($this->scalar))->orThrow('That is not a bool');

        return new BooleanEnsurance($this->scalar);
    }
}