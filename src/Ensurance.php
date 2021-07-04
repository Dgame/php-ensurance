<?php

namespace Dgame\Ensurance;

/**
 * Class Ensurance
 * @package Dgame\Ensurance
 */
final class Ensurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * Ensurance constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
        $this->ensure($value !== null && $value !== false);
    }

    /**
     * @return ArrayEnsurance
     */
    public function isArray(): ArrayEnsurance
    {
        $this->ensure(is_array($this->value))->orThrow('Value "%s" is not an array', $this->value);

        return new ArrayEnsurance($this);
    }

    /**
     * @return ReflectionEnsurance
     * @throws \ReflectionException
     */
    public function isObject(): ReflectionEnsurance
    {
        $this->ensure(is_object($this->value))->orThrow('Value "%s" is not an object', $this->value);

        return new ReflectionEnsurance($this);
    }

    /**
     * @return Ensurance
     */
    public function isResource(): self
    {
        $this->ensure(is_resource($this->value))->orThrow('Value "%s" is not a resource', $this->value);

        return $this;
    }

    /**
     * @return ScalarEnsurance
     */
    public function isScalar(): ScalarEnsurance
    {
        $this->ensure(is_scalar($this->value))->orThrow('Value "%s" is not a scalar', $this->value);

        return new ScalarEnsurance($this);
    }

    /**
     * @return StringEnsurance
     */
    public function isString(): StringEnsurance
    {
        return $this->isScalar()->isString();
    }

    /**
     * @return NumericEnsurance
     */
    public function isNumeric(): NumericEnsurance
    {
        return $this->isScalar()->isNumeric();
    }

    /**
     * @return BooleanEnsurance
     */
    public function isBool(): BooleanEnsurance
    {
        return $this->isScalar()->isBool();
    }

    /**
     * @return NumericEnsurance
     */
    public function isInt(): NumericEnsurance
    {
        return $this->isNumeric()->isInt();
    }

    /**
     * @return NumericEnsurance
     */
    public function isFloat(): NumericEnsurance
    {
        return $this->isNumeric()->isFloat();
    }

    /**
     * @return BooleanEnsurance
     */
    public function isTrue(): BooleanEnsurance
    {
        return $this->isBool()->isTrue();
    }

    /**
     * @return BooleanEnsurance
     */
    public function isFalse(): BooleanEnsurance
    {
        return $this->isBool()->isFalse();
    }

    /**
     * @return NumericEnsurance
     */
    public function isPositive(): NumericEnsurance
    {
        return $this->isNumeric()->isPositive();
    }

    /**
     * @return NumericEnsurance
     */
    public function isNegative(): NumericEnsurance
    {
        return $this->isNumeric()->isNegative();
    }

    /**
     * @return NumericEnsurance
     */
    public function isEven(): NumericEnsurance
    {
        return $this->isNumeric()->isEven();
    }

    /**
     * @return NumericEnsurance
     */
    public function isOdd(): NumericEnsurance
    {
        return $this->isNumeric()->isOdd();
    }

    /**
     * @param string $pattern
     *
     * @return StringEnsurance
     */
    public function matches(string $pattern): StringEnsurance
    {
        return $this->isString()->matches($pattern);
    }

    /**
     * @return Ensurance
     */
    public function isNull(): self
    {
        $this->ensure($this->value === null)->orThrow('Value "%s" is not null', $this->value);

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isNotNull(): self
    {
        $this->ensure($this->value !== null)->orThrow('Value is null', $this->value);

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isEmpty(): self
    {
        $this->ensure(empty($this->value))->orThrow('Value "%s" is not empty', $this->value);

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isNotEmpty(): self
    {
        $this->ensure(!empty($this->value))->orThrow('Value "%s" is empty', $this->value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return Ensurance
     */
    public function isEqualTo($value): self
    {
        $this->ensure($this->value == $value)->orThrow('"%s" is not equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return Ensurance
     */
    public function isNotEqualTo($value): self
    {
        $this->ensure($this->value != $value)->orThrow('"%s" is equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return Ensurance
     */
    public function isIdenticalTo($value): self
    {
        $this->ensure($this->value === $value)->orThrow('"%s" is not the same as "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return Ensurance
     */
    public function isNotIdenticalTo($value): self
    {
        $this->ensure($this->value !== $value)->orThrow('"%s" is the same as "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Ensurance
     */
    public function isIn(array $data): self
    {
        $this->ensure(in_array($this->value, $data, true))->orThrow('"%s" is not a value of %s', $this->value, $data);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Ensurance
     */
    public function isKeyOf(array $data): self
    {
        $this->ensure(array_key_exists($this->value, $data))->orThrow('"%s" is not a key of %s', $this->value, $data);

        return $this;
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isGreaterThan(float $value): NumericEnsurance
    {
        return $this->isNumeric()->isGreaterThan($value);
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isLessThan(float $value): NumericEnsurance
    {
        return $this->isNumeric()->isLessThan($value);
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isGreaterThanOrEqualTo(float $value): NumericEnsurance
    {
        return $this->isNumeric()->isGreaterThanOrEqualTo($value);
    }

    /**
     * @param float $value
     *
     * @return NumericEnsurance
     */
    public function isLessThanOrEqualTo(float $value): NumericEnsurance
    {
        return $this->isNumeric()->isLessThanOrEqualTo($value);
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     */
    public function isBetween(float $lhs, float $rhs): NumericEnsurance
    {
        return $this->isNumeric()->isBetween($lhs, $rhs);
    }

    /**
     * @param float $lhs
     * @param float $rhs
     *
     * @return NumericEnsurance
     */
    public function isNotBetween(float $lhs, float $rhs): NumericEnsurance
    {
        return $this->isNumeric()->isNotBetween($lhs, $rhs);
    }
}
