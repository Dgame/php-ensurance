<?php

namespace Dgame\Ensurance;

/**
 * Class ArrayEnsurance
 * @package Dgame\Ensurance
 */
final class ArrayEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * ArrayEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
        $this->value = $ensurance->else([]);
    }

    /**
     * @param $key
     *
     * @return ArrayEnsurance
     */
    public function hasKey($key): self
    {
        $this->ensure(array_key_exists($key, $this->value))
             ->orThrow('Key "%s" is not contained in %s', $key, $this->value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return ArrayEnsurance
     */
    public function hasValue($value): self
    {
        $this->ensure(in_array($value, $this->value))
             ->orThrow('Value "%s" is not contained in ', $value, $this->value);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function hasLengthOf(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count === $length)->orThrow('array has not the length %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterThan(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count < $length)->orThrow('array is not shorter than %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterOrEqualsTo(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count <= $length)->orThrow('array is not shorter or equal to %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerThan(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count > $length)->orThrow('array is longer than %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerOrEqualTo(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count >= $length)->orThrow('array is not longer or equal to %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isAssociative(): self
    {
        $count = count($this->value);
        $this->ensure(array_keys($this->value) !== range(0, $count - 1))
             ->orThrow('array %s is not associative', $this->value);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isNotAssociative(): self
    {
        $count = count($this->value);
        $this->ensure(array_keys($this->value) === range(0, $count - 1))
             ->orThrow('array %s is associative', $this->value);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isCallable(): self
    {
        $this->ensure(is_callable($this->value))->orThrow('Value is not a callable');

        return $this;
    }
}