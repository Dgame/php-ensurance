<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Exception\InvalidLengthException;
use Dgame\Ensurance\Exception\StringException;
use Dgame\Ensurance\Traits\ArrayEnsuranceTrait;

/**
 * Class StringEnsurance
 * @package Dgame\Ensurance
 */
final class StringEnsurance
{
    use ArrayEnsuranceTrait;

    /**
     * StringEnsurance constructor.
     *
     * @param ScalarEnsurance $ensurance
     */
    public function __construct(ScalarEnsurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_string($this->value)) {
            throw new StringException($this);
        }
    }

    /**
     * @return int
     */
    private function length() : int
    {
        static $length = null;
        if ($length === null) {
            $length = strlen($this->value);
        }

        return $length;
    }

    /**
     * @param string $value
     *
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function isEqualTo(string $value) : StringEnsurance
    {
        if ($this->value !== $value) {
            throw new EnsuranceException('"%s" is not equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function isNotEqualTo(string $value) : StringEnsurance
    {
        if ($this->value === $value) {
            throw new EnsuranceException('"%s" is equal to "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param string $pattern
     *
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function matches(string $pattern) : StringEnsurance
    {
        if (!preg_match($pattern, $this->value)) {
            throw new EnsuranceException('"%s" does not match "%s"', $this->value, $pattern);
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     * @throws InvalidLengthException
     */
    public function haslengthOf(int $length) : StringEnsurance
    {
        if ($this->length() !== $length) {
            throw new InvalidLengthException('"%s" (%d) has not the length of %d', $this->value, $this->length(), $length);
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     * @throws InvalidLengthException
     */
    public function isShorterThan(int $length) : StringEnsurance
    {
        if ($this->length() >= $length) {
            throw new InvalidLengthException('"%s" (%d) is not shorter than %d', $this->value, $this->length(), $length);
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     * @throws InvalidLengthException
     */
    public function isShortOrEqualsTo(int $length) : StringEnsurance
    {
        if ($this->length() > $length) {
            throw new InvalidLengthException('"%s" (%d) is not shorter or equal to %d', $this->value, $this->length(), $length);
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     * @throws InvalidLengthException
     */
    public function isLongerThan(int $length) : StringEnsurance
    {
        if ($this->length() <= $length) {
            throw new InvalidLengthException('"%s" (%d) is longer than %d', $this->value, $this->length(), $length);
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     * @throws InvalidLengthException
     */
    public function isLongerOrEqualTo(int $length) : StringEnsurance
    {
        if ($this->length() < $length) {
            throw new InvalidLengthException('"%s" (%d) is not longer or equal to %d', $this->value, $this->length(), $length);
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function beginsWith(string $value) : StringEnsurance
    {
        if (substr($this->value, 0, strlen($value)) !== $value) {
            throw new EnsuranceException('"%s" did not begin with "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function endsWith(string $value) : StringEnsurance
    {
        if (substr($this->value, strlen($value) * -1) !== $value) {
            throw new EnsuranceException('"%s" did not end with "%s"', $this->value, $value);
        }

        return $this;
    }

    /**
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function isCallable() : StringEnsurance
    {
        if (!is_callable($this->value, true)) {
            throw new EnsuranceException('"%s" is not a callable', $this->value);
        }

        return $this;
    }

    /**
     * @return StringEnsurance
     * @throws EnsuranceException
     */
    public function isClassName() : StringEnsurance
    {
        if (!class_exists($this->value, true)) {
            throw new EnsuranceException('"%s" is not an existing class', $this->value);
        }

        return $this;
    }
}