<?php

namespace Dgame\Ensurance;

use DOMDocument;

/**
 * Class StringEnsurance
 * @package Dgame\Ensurance
 */
final class StringEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * StringEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function isEqualTo(string $str): self
    {
        $this->ensure($this->value === $str)->orThrow('"%s" is not equal to "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function isNotEqualTo(string $str): self
    {
        $this->ensure($this->value !== $str)->orThrow('"%s" is equal to "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @param string $pattern
     *
     * @return StringEnsurance
     */
    public function matches(string $pattern): self
    {
        $this->ensure((bool) preg_match($pattern, $this->value))->orThrow('"%s" does not match pattern "%s"', $this->value, $pattern);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function hasLengthOf(int $length): self
    {
        $len = strlen($this->value);
        $this->ensure($len === $length)->orThrow('"%s" (%d) has not the length of %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isShorterThan(int $length): self
    {
        $len = strlen($this->value);
        $this->ensure($len < $length)->orThrow('"%s" (%d) is not shorter than %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isShorterOrEqualTo(int $length): self
    {
        $len = strlen($this->value);
        $this->ensure($len <= $length)->orThrow('"%s" (%d) is not shorter or equal to %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isLongerThan(int $length): self
    {
        $len = strlen($this->value);
        $this->ensure($len > $length)->orThrow('"%s" (%d) is longer than %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return StringEnsurance
     */
    public function isLongerOrEqualTo(int $length): self
    {
        $len = strlen($this->value);
        $this->ensure($len >= $length)->orThrow('"%s" (%d) is not longer or equal to %d', $this->value, $len, $length);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function beginsWith(string $str): self
    {
        $this->ensure(strpos($this->value, $str) === 0)->orThrow('"%s" did not begin with "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @param string $str
     *
     * @return StringEnsurance
     */
    public function endsWith(string $str): self
    {
        $len = strlen($str);
        $this->ensure(substr($this->value, $len * -1) === $str)->orThrow('"%s" did not end with "%s"', $this->value, $str);

        return $this;
    }

    /**
     * @return StringEnsurance
     */
    public function isCallable(): self
    {
        $this->ensure(is_callable($this->value))->orThrow('"%s" is not a callable', $this->value);

        return $this;
    }

    /**
     * @return ReflectionEnsurance
     * @throws \ReflectionException
     */
    public function isClass(): ReflectionEnsurance
    {
        $this->ensure(class_exists($this->value))->orThrow('"%s" is not a callable', $this->value);

        return new ReflectionEnsurance($this);
    }

    /**
     * @return StringEnsurance
     */
    public function isJson(): self
    {
        json_decode($this->value, true);

        $this->ensure(json_last_error() === JSON_ERROR_NONE);

        return $this;
    }

    /**
     * @return StringEnsurance
     */
    public function isXml(): self
    {
        libxml_use_internal_errors(false);

        try {
            $doc = new DOMDocument();
            $this->ensure(@$doc->loadXML($this->value));
        } finally {
            libxml_clear_errors();
        }

        return $this;
    }
}
