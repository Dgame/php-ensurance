<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\ArrayException;
use Dgame\Ensurance\Exception\ArrayKeyException;
use Dgame\Ensurance\Exception\ArrayValueException;
use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Exception\InvalidLengthException;
use Dgame\Ensurance\Traits\EnsuranceTrait;

/**
 * Class ArrayEnsurance
 * @package Dgame\Ensurance
 */
final class ArrayEnsurance
{
    use EnsuranceTrait;

    /**
     * ArrayEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_array($this->value)) {
            throw new ArrayException($this);
        }
    }

    /**
     * @return int
     */
    private function count() : int
    {
        static $count = null;
        if ($count === null) {
            $count = count($this->value);
        }

        return $count;
    }

    /**
     * @param $key
     *
     * @return ArrayEnsurance
     * @throws ArrayKeyException
     */
    public function hasKey($key) : ArrayEnsurance
    {
        if (!array_key_exists($key, $this->value)) {
            throw new ArrayKeyException('%s is not a key', $key);
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return ArrayEnsurance
     * @throws ArrayValueException
     */
    public function hasValue($value) : ArrayEnsurance
    {
        if (!in_array($value, $this->value)) {
            throw new ArrayValueException('%s is not a value', $value);
        }

        return $this;
    }

    /**
     * @param array $data
     *
     * @return ArrayEnsurance
     * @throws ArrayKeyException
     * @throws ArrayValueException
     */
    public function contains(array $data) : ArrayEnsurance
    {
        foreach ($data as $key => $value) {
            if (!array_key_exists($key, $this->value)) {
                throw new ArrayKeyException('%s is not a key', $key);
            }

            if ($this->value[$key] !== $value) {
                throw new ArrayValueException('%s is not the value of key %s', $value, $key);
            }
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     * @throws InvalidLengthException
     */
    public function haslengthOf(int $length) : ArrayEnsurance
    {
        if ($this->count() !== $length) {
            throw new InvalidLengthException('array has not the length %d (%d)', $length, $this->count());
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     * @throws InvalidLengthException
     */
    public function isShorterThan(int $length) : ArrayEnsurance
    {
        if ($this->count() >= $length) {
            throw new InvalidLengthException('array is not shorter than %d (%d)', $length, $this->count());
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     * @throws InvalidLengthException
     */
    public function isShortOrEqualsTo(int $length) : ArrayEnsurance
    {
        if ($this->count() > $length) {
            throw new InvalidLengthException('array is not shorter or equal to %d (%d)', $length, $this->count());
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     * @throws InvalidLengthException
     */
    public function isLongerThan(int $length) : ArrayEnsurance
    {
        if ($this->count() <= $length) {
            throw new InvalidLengthException('array is longer than %d (%d)', $length, $this->count());
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     * @throws InvalidLengthException
     */
    public function isLongerOrEqualTo(int $length) : ArrayEnsurance
    {
        if ($this->count() < $length) {
            throw new InvalidLengthException('array is not longer or equal to %d (%d)', $length, $this->count());
        }

        return $this;
    }

    /**
     * @return ArrayEnsurance
     * @throws EnsuranceException
     */
    public function isAssociative() : ArrayEnsurance
    {
        if (array_keys($this->value) === range(0, $this->count() - 1)) {
            throw new EnsuranceException('array is not associative');
        }

        return $this;
    }

    /**
     * @return ArrayEnsurance
     * @throws EnsuranceException
     */
    public function isNotAssociative() : ArrayEnsurance
    {
        if (array_keys($this->value) !== range(0, $this->count() - 1)) {
            throw new EnsuranceException('array is associative');
        }

        return $this;
    }
}