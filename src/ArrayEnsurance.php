<?php

namespace Dgame\Ensurance;

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
    public function hasKey($key): ArrayEnsurance
    {
        $this->enforce(array_key_exists($key, $this->values))->orThrow('Key "%s" is not contained in %s', $key, $this->values);

        return $this;
    }

    /**
     * @param $value
     *
     * @return ArrayEnsurance
     */
    public function hasValue($value): ArrayEnsurance
    {
        $this->enforce(in_array($value, $this->values))->orThrow('Value "%s" is not contained in ', $value, $this->values);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function hasLengthOf(int $length): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce($count === $length)->orThrow('array has not the length %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterThan(int $length): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce($count < $length)->orThrow('array is not shorter than %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterOrEqualsTo(int $length): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce($count <= $length)->orThrow('array is not shorter or equal to %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerThan(int $length): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce($count > $length)->orThrow('array is longer than %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerOrEqualTo(int $length): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce($count >= $length)->orThrow('array is not longer or equal to %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isAssociative(): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce(array_keys($this->values) !== range(0, $count - 1))->orThrow('array is not associative');

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isNotAssociative(): ArrayEnsurance
    {
        $count = count($this->values);
        $this->enforce(array_keys($this->values) === range(0, $count - 1))->orThrow('array is associative');

        return $this;
    }

    /**
     *
     */
    public function isCallable()
    {
        $this->enforce(is_callable($this->values))->orThrow('Value is not a callable');
    }
}