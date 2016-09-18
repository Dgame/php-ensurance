<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class NumericEnsurance
 * @package Dgame\Ensurance
 */
final class NumericEnsurance
{
    const EPSILON = 0.00001;

    /**
     * @var int|float
     */
    private $number;

    use EnforcementTrait;

    /**
     * NumericEnsurance constructor.
     *
     * @param $number
     *
     * @throws EnsuranceException
     */
    public function __construct($number)
    {
        if (!is_numeric($number)) {
            throw new EnsuranceException('That is not a numerical value');
        }

        $this->number = $number + 0; // PHP converts a numerical string to a float/int by adding another numerical value
    }

    /**
     * @return NumericEnsurance
     */
    public function isInt(): NumericEnsurance
    {
        $this->enforce(is_int($this->number))->orThrow('"%s" is not an int', $this->number);

        return $this;
    }

    /**
     * @return NumericEnsurance
     */
    public function isFloat(): NumericEnsurance
    {
        $this->enforce(is_float($this->number))->orThrow('"%s" is not a float', $this->number);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isGreaterThan(float $value): NumericEnsurance
    {
        $this->enforce($this->number > $value)->orThrow('"%s" is not greater than "%s"', $this->number, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isGreaterOrEqualTo(float $value): NumericEnsurance
    {
        $this->enforce($this->number >= $value)->orThrow('"%s" is not greater or equal than "%s"', $this->number, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isLessThan(float $value): NumericEnsurance
    {
        $this->enforce($this->number < $value)->orThrow('"%s" is greater or equal to "%s"', $this->number, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isLessOrEqualTo(float $value): NumericEnsurance
    {
        $this->enforce($this->number <= $value)->orThrow('"%s" is greater than "%s"', $this->number, $value);

        return $this;
    }

    /**
     * @return NumericEnsurance
     */
    public function isPositive(): NumericEnsurance
    {
        return $this->isGreaterOrEqualTo(0);
    }

    /**
     * @return NumericEnsurance
     */
    public function isNegative(): NumericEnsurance
    {
        return $this->isLessThan(0);
    }

    /**
     * @return NumericEnsurance
     */
    public function isEven(): NumericEnsurance
    {
        $this->enforce(($this->number & 1) === 0)->orThrow('"%s is not even"', $this->number);

        return $this;
    }

    /**
     * @return NumericEnsurance
     */
    public function isOdd(): NumericEnsurance
    {
        $this->enforce(($this->number & 1) === 1)->orThrow('"%s is not odd"', $this->number);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isEqualTo(float $value): NumericEnsurance
    {
        $this->enforce(abs($this->number - $value) < self::EPSILON)->orThrow('"%s" is not equal to "%s"', $this->number, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isNotEqualTo(float $value): NumericEnsurance
    {
        $this->enforce(abs($this->number - $value) > self::EPSILON)->orThrow('"%s" is equal to "%s"', $this->number, $value);

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     */
    public function isBetween(float $lhs, float $rhs): NumericEnsurance
    {
        $this->enforce($lhs <= $this->number && $rhs >= $this->number)
             ->orThrow('"%s" is not between "%s" and "%s"', $this->number, $lhs, $rhs);

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     */
    public function isNotBetween(float $lhs, float $rhs): NumericEnsurance
    {
        $this->enforce($lhs > $this->number || $rhs < $this->number)
             ->orThrow('"%s" is between "%s" and "%s"', $this->number, $lhs, $rhs);

        return $this;
    }
}