<?php

namespace Dgame\Ensurance;

defined('PHP_FLOAT_EPSILON') or define('PHP_FLOAT_EPSILON', 2.2204460492503e-16);

/**
 * Class NumericEnsurance
 * @package Dgame\Ensurance
 */
final class NumericEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * NumericEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
    }

    /**
     * @return NumericEnsurance
     */
    public function isInt(): self
    {
        $this->ensure(is_int($this->value))->orThrow('"%s" is not an int', $this->value);

        return $this;
    }

    /**
     * @return NumericEnsurance
     */
    public function isFloat(): self
    {
        $this->ensure(is_float($this->value))->orThrow('"%s" is not a float', $this->value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isGreaterThan(float $value): self
    {
        $this->ensure($this->value > $value)->orThrow('"%s" is not greater than "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isGreaterThanOrEqualTo(float $value): self
    {
        $this->ensure($this->value >= $value)->orThrow('"%s" is not greater or equal than "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isLessThan(float $value): self
    {
        $this->ensure($this->value < $value)->orThrow('"%s" is greater or equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isLessThanOrEqualTo(float $value): self
    {
        $this->ensure($this->value <= $value)->orThrow('"%s" is greater than "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @return NumericEnsurance
     */
    public function isPositive(): self
    {
        return $this->isGreaterThanOrEqualTo(0);
    }

    /**
     * @return NumericEnsurance
     */
    public function isNegative(): self
    {
        return $this->isLessThan(0);
    }

    /**
     * @return NumericEnsurance
     */
    public function isEven(): self
    {
        $this->ensure(($this->value & 1) === 0)->orThrow('"%s is not even"', $this->value);

        return $this;
    }

    /**
     * @return NumericEnsurance
     */
    public function isOdd(): self
    {
        $this->ensure(($this->value & 1) === 1)->orThrow('"%s is not odd"', $this->value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isEqualTo(float $value): self
    {
        $this->ensure(abs($this->value - $value) < PHP_FLOAT_EPSILON)->orThrow('"%s" is not equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isNotEqualTo(float $value): self
    {
        $this->ensure(abs($this->value - $value) > PHP_FLOAT_EPSILON)->orThrow('"%s" is equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     */
    public function isBetween(float $lhs, float $rhs): self
    {
        $this->ensure($lhs <= $this->value && $rhs >= $this->value)
             ->orThrow('"%s" is not between "%s" and "%s"', $this->value, $lhs, $rhs);

        return $this;
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     */
    public function isNotBetween(float $lhs, float $rhs): self
    {
        $this->ensure($lhs > $this->value || $rhs < $this->value)
             ->orThrow('"%s" is between "%s" and "%s"', $this->value, $lhs, $rhs);

        return $this;
    }
}