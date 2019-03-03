<?php

namespace Dgame\Ensurance;

use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use stdClass;

/**
 * Class ReflectionEnsurance
 * @package Dgame\Ensurance
 */
final class ReflectionEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * @var ReflectionClass
     */
    private $reflection;

    /**
     * ReflectionEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     *
     * @throws ReflectionException
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
        if ($this->isEnsured()) {
            $this->reflection = self::getReflection($this->value);
        } else {
            $this->reflection = self::getEmptyReflection();
        }
    }

    /**
     * @param mixed $value
     *
     * @return ReflectionClass
     * @throws ReflectionException
     */
    private static function getReflection($value): ReflectionClass
    {
        if (is_object($value)) {
            return new ReflectionObject($value);
        }

        if (is_string($value)) {
            return new ReflectionClass($value);
        }

        return self::getEmptyReflection();
    }

    /**
     * @return ReflectionClass
     * @throws ReflectionException
     */
    private static function getEmptyReflection(): ReflectionClass
    {
        return new ReflectionClass(new stdClass());
    }

    /**
     * @param string $property
     *
     * @return ReflectionEnsurance
     */
    public function hasProperty(string $property): self
    {
        $this->ensure($this->reflection->hasProperty($property))
             ->orThrow('"%s" does not have a property "%s"', $this->value, $property);

        return $this;
    }

    /**
     * @param string $method
     *
     * @return ReflectionEnsurance
     */
    public function hasMethod(string $method): self
    {
        $this->ensure($this->reflection->hasMethod($method))
             ->orThrow('"%s" does not have a method "%s"', $this->value, $method);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function is(string $class): self
    {
        $this->ensure($this->value === $class)->orThrow('"%s" is not "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function isNot(string $class): self
    {
        $this->ensure($this->value !== $class)->orThrow('"%s" is "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function extends(string $class): self
    {
        $this->ensure($this->reflection->isSubclassOf($class))->orThrow('"%s" did not extend "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function extendsNot(string $class): self
    {
        $this->ensure(!$this->reflection->isSubclassOf($class))->orThrow('"%s" did extend "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ReflectionEnsurance
     */
    public function implements(string $interface): self
    {
        $this->ensure(array_key_exists($interface, class_implements($this->value, true)))
             ->orThrow('"%s" does not implements interface "%s"', $this->value, $interface);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ReflectionEnsurance
     */
    public function implementsNot(string $interface): self
    {
        $this->ensure(!array_key_exists($interface, class_implements($this->value, true)))
             ->orThrow('"%s" does implements interface "%s"', $this->value, $interface);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function isParentOf(string $class): self
    {
        $this->ensure(array_key_exists($this->value, class_parents($class, true)))
             ->orThrow('"%s" is not a parent of "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function isNotParentOf(string $class): self
    {
        $this->ensure(!array_key_exists($this->value, class_parents($class, true)))
             ->orThrow('"%s" is a parent of "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $trait
     *
     * @return ReflectionEnsurance
     */
    public function uses(string $trait): self
    {
        $this->ensure(array_key_exists($trait, class_uses($this->value, true)))
             ->orThrow('"%s" does not use trait "%s"', $this->value, $trait);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function isSome(string $class): self
    {
        $this->ensure(is_a($this->value, $class))->orThrow('"%s" is not "%s"', get_class($this->value), $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ReflectionEnsurance
     */
    public function isNotSome(string $class): self
    {
        $this->ensure(!is_a($this->value, $class))->orThrow('"%s" is "%s"', get_class($this->value), $class);

        return $this;
    }

    /**
     * @param mixed $class
     *
     * @return ReflectionEnsurance
     */
    public function isInstanceOf($class): self
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->ensure($this->value instanceof $class)->orThrow('"%s" is not an instance of "%s"', get_class($this->value), $class);

        return $this;
    }

    /**
     * @param mixed $class
     *
     * @return ReflectionEnsurance
     */
    public function isNotInstanceOf($class): self
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->ensure(!($this->value instanceof $class))->orThrow('"%s" is an instance of "%s"', get_class($this->value), $class);

        return $this;
    }
}
