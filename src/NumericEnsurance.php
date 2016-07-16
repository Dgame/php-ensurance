<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\ArrayValueException;
use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Exception\NumericalException;
use Dgame\Ensurance\Exception\NumericException;
use Dgame\Ensurance\Traits\ArrayEnsuranceTrait;

/**
 * Class NumericEnsurance
 * @package Dgame\Ensurance
 */
final class NumericEnsurance
{
    const EPSILON = 0.00001;

    use ArrayEnsuranceTrait;

    /**
     * NumericEnsurance constructor.
     *
     * @param ScalarEnsurance $ensurance
     */
    public function __construct(ScalarEnsurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_numeric($this->value)) {
            throw new NumericException($this);
        }
    }

    /**
     * @return NumericEnsurance
     * @throws EnsuranceException
     */
    public function isInt() : NumericEnsurance
    {
        if (!is_int($this->value)) {
            throw new EnsuranceException('"%s" is not an int', $this->value);
        }

        return $this;
    }

    /**
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isFloat() : NumericEnsurance
    {
        if (!is_float($this->value)) {
            throw new NumericalException('"%s" is not a float', $this->value);
        }

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isGreaterThan(float $value) : NumericEnsurance
    {
        if ($this->value <= $value) {
            throw new NumericalException('"%s" is not greater than "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isGreaterOrEqualTo(float $value) : NumericEnsurance
    {
        if ($this->value < $value) {
            throw new NumericalException('"%s" is not greater or equal than "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isLessThan(float $value) : NumericEnsurance
    {
        if ($this->value >= $value) {
            throw new NumericalException('"%s" is greater or equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isLessOrEqualTo(float $value) : NumericEnsurance
    {
        if ($this->value > $value) {
            throw new NumericalException('"%s" is greater than "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isPositive() : NumericEnsurance
    {
        return $this->isGreaterOrEqualTo(0);
    }

    /**
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isNegative() : NumericEnsurance
    {
        return $this->isLessThan(0);
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isEqualTo(float $value) : NumericEnsurance
    {
        if (abs($this->value - $value) < self::EPSILON) {
            throw new NumericalException('"%s" is not equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isNotEqualTo(float $value) : NumericEnsurance
    {
        if (abs($this->value - $value) >= self::EPSILON) {
            throw new NumericalException('"%s" is equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isBetween(float $lhs, float $rhs) : NumericEnsurance
    {
        if ($lhs > $this->value || $rhs < $this->value) {
            throw new NumericalException('"%s" is not between "%s" and "%s"', $this->value, $lhs, $rhs);
        }

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isNotBetween(float $lhs, float $rhs) : NumericEnsurance
    {
        if ($lhs <= $this->value || $rhs >= $this->value) {
            throw new NumericalException('"%s" is between "%s" and "%s"', $this->value, $lhs, $rhs);
        }

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isInRange(float $lhs, float $rhs) : NumericEnsurance
    {
        try {
            return $this->isValueOf(range($lhs, $rhs));
        } catch (ArrayValueException $e) {
            throw new NumericalException('"%s" is not in range of "%s" and "%s"', $this->value, $lhs, $rhs);
        }
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     * @throws NumericalException
     */
    public function isNotInRange(float $lhs, float $rhs) : NumericEnsurance
    {
        try {
            return $this->isNotValueOf(range($lhs, $rhs));
        } catch (ArrayValueException $e) {
            throw new NumericalException('"%s" is in range of "%s" and "%s"', $this->value, $lhs, $rhs);
        }
    }
}