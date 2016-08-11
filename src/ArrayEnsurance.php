<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class ArrayEnsurance
 * @package Dgame\Ensurance
 */
final class ArrayEnsurance
{
    /**
     * @var array
     */
    private $values = [];
    
    use EnforcementTrait;

    /**
     * ArrayEnsurance constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param $key
     *
     * @return ArrayEnsurance
     */
    public function hasKey($key) : ArrayEnsurance
    {
        $this->enforce(array_key_exists($key, $this->values))->orThrow('Key "%s" is not contained', $key);

        return $this;
    }

    /**
     * @param $value
     *
     * @return ArrayEnsurance
     */
    public function hasValue($value) : ArrayEnsurance
    {
        $this->enforce(in_array($value, $this->values))->orThrow('Value "%s" is not contained', $value);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function haslengthOf(int $length) : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce($c === $length)->orThrow('array has not the length %d (%d)', $length, $c);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterThan(int $length) : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce($c < $length)->orThrow('array is not shorter than %d (%d)', $length, $c);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterOrEqualsTo(int $length) : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce($c <= $length)->orThrow('array is not shorter or equal to %d (%d)', $length, $c);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerThan(int $length) : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce($c > $length)->orThrow('array is longer than %d (%d)', $length, $c);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerOrEqualTo(int $length) : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce($c >= $length)->orThrow('array is not longer or equal to %d (%d)', $length, $c);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isAssociative() : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce(array_keys($this->values) !== range(0, $c - 1))->orThrow('array is not associative');

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isNotAssociative() : ArrayEnsurance
    {
        $c = count($this->values);
        $this->enforce(array_keys($this->values) === range(0, $c - 1))->orThrow('array is associative');

        return $this;
    }
}