<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Enforcement\EnforcementTrait;

/**
 * Class StringEnsurance
 * @package Dgame\Ensurance
 */
final class StringEnsurance
{
    /**
     * @var string
     */
    private $value;

    use EnforcementTrait;

    /**
     * StringEnsurance constructor.
     *
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->value = $str;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function isEqualTo(string $str): StringEnsurance
    {
        $this->enforce($this->value === $str)->orThrow('"%s" is not equal to "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function isNotEqualTo(string $str): StringEnsurance
    {
        $this->enforce($this->value !== $str)->orThrow('"%s" is equal to "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @param string $pattern
     *
     * @return StringEnsurance
     */
    public function match(string $pattern): StringEnsurance
    {
        $this->enforce((bool) preg_match($pattern, $this->value))->orThrow('"%s" does not match pattern "%s"', $this->value, $pattern);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function hasLengthOf(int $length): StringEnsurance
    {
        $len = strlen($this->value);
        $this->enforce($len === $length)->orThrow('"%s" (%d) has not the length of %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isShorterThan(int $length): StringEnsurance
    {
        $len = strlen($this->value);
        $this->enforce($len < $length)->orThrow('"%s" (%d) is not shorter than %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isShorterOrEqualTo(int $length): StringEnsurance
    {
        $len = strlen($this->value);
        $this->enforce($len <= $length)->orThrow('"%s" (%d) is not shorter or equal to %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isLongerThan(int $length): StringEnsurance
    {
        $len = strlen($this->value);
        $this->enforce($len > $length)->orThrow('"%s" (%d) is longer than %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isLongerOrEqualTo(int $length): StringEnsurance
    {
        $len = strlen($this->value);
        $this->enforce($len >= $length)->orThrow('"%s" (%d) is not longer or equal to %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function beginsWith(string $str): StringEnsurance
    {
        $len = strlen($str);
        $this->enforce(substr($this->value, 0, $len) === $str)->orThrow('"%s" did not begin with "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function endsWith(string $str): StringEnsurance
    {
        $len = strlen($str);
        $this->enforce(substr($this->value, $len * -1) === $str)->orThrow('"%s" did not end with "%s"', $this->value, $str);

        return $this;
    }

    /**
     *
     */
    public function isCallable()
    {
        $this->enforce(is_callable($this->value))->orThrow('"%s" is not a callable', $this->value);
    }

    /**
     * @return ClassEnsurance
     */
    public function isClass(): ClassEnsurance
    {
        $this->enforce(class_exists($this->value))->orThrow('"%s" is not a callable', $this->value);

        return new ClassEnsurance($this->value);
    }
}