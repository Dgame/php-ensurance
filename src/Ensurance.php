<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class Ensurance
 * @package Dgame\Ensurance
 */
final class Ensurance
{
    /**
     * @var null|mixed
     */
    private $value = null;

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
     * @return ArrayEnsurance
     */
    public function isArray() : ArrayEnsurance
    {
        $this->enforce(is_array($this->value))->orThrow('Value is not an array');

        return new ArrayEnsurance($this->value);
    }

    /**
     * @return ObjectEnsurance
     */
    public function isObject() : ObjectEnsurance
    {
        $this->enforce(is_object($this->value))->orThrow('Value is not an object');

        return new ObjectEnsurance($this->value);
    }

    /**
     * @return ResourceEnsurance
     */
    public function isResource() : ResourceEnsurance
    {
        $this->enforce(is_resource($this->value))->orThrow('Value is not a resource');

        return new ResourceEnsurance($this->value);
    }

    /**
     * @return ScalarEnsurance
     */
    public function isScalar() : ScalarEnsurance
    {
        $this->enforce(is_scalar($this->value))->orThrow('Value is not a scalar');

        return new ScalarEnsurance($this->value);
    }

    /**
     * @return StringEnsurance
     */
    public function isString() : StringEnsurance
    {
        return $this->isScalar()->isString();
    }

    /**
     * @return NumericEnsurance
     */
    public function isNumeric() : NumericEnsurance
    {
        return $this->isScalar()->isNumeric();
    }

    /**
     * @return BooleanEnsurance
     */
    public function isBool() : BooleanEnsurance
    {
        return $this->isScalar()->isBool();
    }

    /**
     * @return NumericEnsurance
     */
    public function isInt() : NumericEnsurance
    {
        return $this->isNumeric()->isInt();
    }

    /**
     * @return NumericEnsurance
     */
    public function isFloat() : NumericEnsurance
    {
        return $this->isNumeric()->isFloat();
    }

    /**
     * @return BooleanEnsurance
     */
    public function isTrue() : BooleanEnsurance
    {
        return $this->isBool()->isTrue();
    }

    /**
     * @return BooleanEnsurance
     */
    public function isFalse() : BooleanEnsurance
    {
        return $this->isBool()->isFalse();
    }

    /**
     * @return NumericEnsurance
     */
    public function isPositive() : NumericEnsurance
    {
        return $this->isNumeric()->isPositive();
    }

    /**
     * @return NumericEnsurance
     */
    public function isNegative() : NumericEnsurance
    {
        return $this->isNumeric()->isNegative();
    }

    /**
     * @return NumericEnsurance
     */
    public function isEven() : NumericEnsurance
    {
        return $this->isNumeric()->isEven();
    }

    /**
     * @return NumericEnsurance
     */
    public function isOdd() : NumericEnsurance
    {
        return $this->isNumeric()->isOdd();
    }

    /**
     * @param string $pattern
     *
     * @return StringEnsurance
     */
    public function matches(string $pattern) : StringEnsurance
    {
        return $this->isString()->match($pattern);
    }

    /**
     * @return Ensurance
     */
    public function isNull() : Ensurance
    {
        $this->enforce($this->value === null)->orThrow('Value is not null');

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isNotNull() : Ensurance
    {
        $this->enforce($this->value !== null)->orThrow('Value is null');

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isEmpty() : Ensurance
    {
        $this->enforce(empty($this->value))->orThrow('Value is not empty');

        return $this;
    }

    /**
     * @return Ensurance
     */
    public function isNotEmpty() : Ensurance
    {
        $this->enforce(!empty($this->value))->orThrow('Value is empty');

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isEqualTo($value) : Ensurance
    {
        $this->enforce($this->value == $value)->orThrow('"%s" is not equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isNotEqualTo($value) : Ensurance
    {
        $this->enforce($this->value != $value)->orThrow('"%s" is equal to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isIdenticalTo($value) : Ensurance
    {
        $this->enforce($this->value === $value)->orThrow('"%s" is not identical to "%s"', $this->value, $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     */
    public function isNotIdenticalTo($value) : Ensurance
    {
        $this->enforce($this->value !== $value)->orThrow('"%s" is identical to "%s"', $this->value, $value);

        return $this;
    }
}

/**
 * @param $value
 *
 * @return Ensurance
 */
function ensure($value) : Ensurance
{
    return new Ensurance($value);
}
