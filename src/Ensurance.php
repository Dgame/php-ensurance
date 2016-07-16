<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\ArrayEnsuranceTrait;

/**
 * Class Ensurance
 * @package Dgame\Ensurance
 */
final class Ensurance
{
    use ArrayEnsuranceTrait;

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
        return new ArrayEnsurance($this);
    }

    /**
     * @return CallableEnsurance
     */
    public function isCallable() : CallableEnsurance
    {
        return new CallableEnsurance($this);
    }

    /**
     * @return ObjectEnsurance
     */
    public function isObject() : ObjectEnsurance
    {
        return new ObjectEnsurance($this);
    }

    /**
     * @return ResourceEnsurance
     */
    public function isResource() : ResourceEnsurance
    {
        return new ResourceEnsurance($this);
    }

    /**
     * @return ScalarEnsurance
     */
    public function isScalar() : ScalarEnsurance
    {
        return new ScalarEnsurance($this);
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
     * @throws EnsuranceException
     */
    public function isInt() : NumericEnsurance
    {
        return $this->isNumeric()->isInt();
    }

    /**
     * @return NumericEnsurance
     * @throws Exception\NumericalException
     */
    public function isFloat() : NumericEnsurance
    {
        return $this->isNumeric()->isFloat();
    }

    /**
     * @return BooleanEnsurance
     * @throws EnsuranceException
     */
    public function isTrue() : BooleanEnsurance
    {
        return $this->isBool()->isTrue();
    }

    /**
     * @return BooleanEnsurance
     * @throws EnsuranceException
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
     * @param string $pattern
     *
     * @return StringEnsurance
     */
    public function matches(string $pattern) : StringEnsurance
    {
        return $this->isString()->matches($pattern);
    }

    /**
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isNull() : Ensurance
    {
        if ($this->value !== null) {
            throw new EnsuranceException('"%s" is not null', $this->value);
        }

        return $this;
    }

    /**
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isNotNull() : Ensurance
    {
        if ($this->value === null) {
            throw new EnsuranceException('The given value is null');
        }

        return $this;
    }

    /**
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isEmpty() : Ensurance
    {
        if (!empty($this->value)) {
            throw new EnsuranceException('"%s" is not empty', $this->value);
        }

        return $this;
    }

    /**
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isNotEmpty() : Ensurance
    {
        if (empty($this->value)) {
            throw new EnsuranceException('The given value is empty');
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isEqualTo($value) : Ensurance
    {
        if ($this->value != $value) {
            throw new EnsuranceException('"%s" is not equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isNotEqualTo($value) : Ensurance
    {
        if ($this->value == $value) {
            throw new EnsuranceException('"%s" is equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isIdenticalTo($value) : Ensurance
    {
        if ($this->value !== $value) {
            throw new EnsuranceException('"%s" is not identical to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return Ensurance
     * @throws EnsuranceException
     */
    public function isNotIdenticalTo($value) : Ensurance
    {
        if ($this->value === $value) {
            throw new EnsuranceException('"%s" is identical to "%s"', $this->value, $value);
        }

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
