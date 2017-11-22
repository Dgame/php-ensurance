<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Enforcement\EnforcementTrait;

/**
 * Class Ensurance
 * @package Dgame\Ensurance
 */
final class Ensurance
{
    /**
     * @var mixed
     */
    private $value;

    use EnforcementTrait;

    /**
     * Ensurance constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isArray(): ArrayEnsurance
    {
        $this->enforce(is_array($this->value))->orThrow('Value is not an array: %s', $this->value);

        return new ArrayEnsurance($this->value);
    }

    /**
     * @return ObjectEnsurance
     */
    public function isObject(): ObjectEnsurance
    {
        $this->enforce(is_object($this->value))->orThrow('Value is not an object: %s', $this->value);

        return new ObjectEnsurance($this->value);
    }

    /**
     *
     */
    public function isResource()
    {
        $this->enforce(is_resource($this->value))->orThrow('Value is not a resource: %s', $this->value);
    }

    /**
     * @return ScalarEnsurance
     */
    public function isScalar(): ScalarEnsurance
    {
        $this->enforce(is_scalar($this->value))->orThrow('Value is not a scalar: %s', $this->value);

        return new ScalarEnsurance($this->value);
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
    public function match(string $pattern): StringEnsurance
    {
        return $this->isString()->match($pattern);
    }

    /**
     * @return Ensurance
     */
    public function isNull(): self
    {
        $this->enforce($this->value === null)->orThrow('Value is not null: %s', $this->value);

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isNotNull(): self
    {
        $this->enforce($this->value !== null)->orThrow('Value is null: %s', $this->value);

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isEmpty(): self
    {
        $this->enforce(empty($this->value))->orThrow('Value is not empty: %s', $this->value);

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isNotEmpty(): self
    {
        $this->enforce(!empty($this->value))->orThrow('Value is empty: %s', $this->value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isEqualTo($value): self
    {
        $this->enforce($this->value == $value)->orThrow('"%s" is not equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isNotEqualTo($value): self
    {
        $this->enforce($this->value != $value)->orThrow('"%s" is equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isSameAs($value): self
    {
        $this->enforce($this->value === $value)->orThrow('"%s" is not the same as "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isNotSameAs($value): self
    {
        $this->enforce($this->value !== $value)->orThrow('"%s" is the same as "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Ensurance
     */
    public function isIn(array $data): self
    {
        $this->enforce(in_array($this->value, $data))->orThrow('"%s" is not a value of %s', $this->value, $data);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Ensurance
     */
    public function isKeyOf(array $data): self
    {
        $this->enforce(array_key_exists($this->value, $data))->orThrow('"%s" is not a key of %s', $this->value, $data);

        return $this;
    }
}