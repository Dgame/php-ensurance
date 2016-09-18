<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class StringEnsurance
 * @package Dgame\Ensurance
 */
final class StringEnsurance
{
    /**
     * @var string
     */
    private $str;

    use EnforcementTrait;

    /**
     * StringEnsurance constructor.
     *
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function isEqualTo(string $str): StringEnsurance
    {
        $this->enforce($this->str === $str)->orThrow('"%s" is not equal to "%s"', $this->str, $str);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function isNotEqualTo(string $str): StringEnsurance
    {
        $this->enforce($this->str !== $str)->orThrow('"%s" is equal to "%s"', $this->str, $str);

        return $this;
    }

    /**
     * @param string $pattern
     *
     * @return StringEnsurance
     */
    public function match(string $pattern): StringEnsurance
    {
        $this->enforce((bool) preg_match($pattern, $this->str))->orThrow('"%s" does not match pattern "%s"', $this->str, $pattern);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function hasLengthOf(int $length): StringEnsurance
    {
        $len = strlen($this->str);
        $this->enforce($len === $length)->orThrow('"%s" (%d) has not the length of %d', $this->str, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isShorterThan(int $length): StringEnsurance
    {
        $len = strlen($this->str);
        $this->enforce($len < $length)->orThrow('"%s" (%d) is not shorter than %d', $this->str, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isShorterOrEqualTo(int $length): StringEnsurance
    {
        $len = strlen($this->str);
        $this->enforce($len <= $length)->orThrow('"%s" (%d) is not shorter or equal to %d', $this->str, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isLongerThan(int $length): StringEnsurance
    {
        $len = strlen($this->str);
        $this->enforce($len > $length)->orThrow('"%s" (%d) is longer than %d', $this->str, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isLongerOrEqualTo(int $length): StringEnsurance
    {
        $len = strlen($this->str);
        $this->enforce($len >= $length)->orThrow('"%s" (%d) is not longer or equal to %d', $this->str, $len, $length);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function beginsWith(string $str): StringEnsurance
    {
        $this->enforce(substr($this->str, 0, strlen($str)) === $str)->orThrow('"%s" did not begin with "%s"', $this->str, $str);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function endsWith(string $str): StringEnsurance
    {
        $this->enforce(substr($this->str, strlen($str) * -1) === $str)->orThrow('"%s" did not end with "%s"', $this->str, $str);

        return $this;
    }

    /**
     * @return CallableEnsurance
     */
    public function isCallable(): CallableEnsurance
    {
        $this->enforce(is_callable($this->str))->orThrow('Value is not a callable');

        return new CallableEnsurance($this->str);
    }

    /**
     * @return StringEnsurance
     */
    public function isClassName(): StringEnsurance
    {
        $this->enforce(class_exists($this->str, true))->orThrow('"%s" is not an existing class', $this->str);

        return $this;
    }
}