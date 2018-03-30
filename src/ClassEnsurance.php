<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceFormatException;
use ReflectionClass;

/**
 * Class ClassEnsurance
 * @package Dgame\Ensurance
 */
class ClassEnsurance implements EnsuranceInterface
{
    /**
     * @var ReflectionClass
     */
    private $reflection;

    use EnsuranceTrait;

    /**
     * ClassEnsurance constructor.
     *
     * @param string $class
     *
     * @throws \ReflectionException
     */
    public function __construct(string $class)
    {
        enforce(class_exists($class))->setThrowable(new EnsuranceFormatException('"%s" is not a class', $class));

        $this->value      = $class;
        $this->reflection = new ReflectionClass($class);
    }

    /**
     * @return ReflectionClass
     */
    final protected function getReflection(): ReflectionClass
    {
        return $this->reflection;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function is(string $class): self
    {
        $this->ensure($this->value === $class)->orThrow('"%s" is not "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function isNot(string $class): self
    {
        $this->ensure($this->value !== $class)->orThrow('"%s" is "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function extends(string $class): self
    {
        $this->ensure($this->reflection->isSubclassOf($class))->orThrow('"%s" did not extend "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function extendsNot(string $class): self
    {
        $this->ensure(!$this->reflection->isSubclassOf($class))->orThrow('"%s" did extend "%s"', $this->value, $class);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ClassEnsurance
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
     * @return ClassEnsurance
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
     * @return ClassEnsurance
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
     * @return ClassEnsurance
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
     * @return ClassEnsurance
     */
    public function uses(string $trait): self
    {
        $this->ensure(array_key_exists($trait, class_uses($this->value, true)))
             ->orThrow('"%s" does not use trait "%s"', $this->value, $trait);

        return $this;
    }

    /**
     * @param string $property
     *
     * @return ClassEnsurance
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
     * @return ClassEnsurance
     */
    public function hasMethod(string $method): self
    {
        $this->ensure($this->reflection->hasMethod($method))
             ->orThrow('"%s" does not have a method "%s"', $this->value, $method);

        return $this;
    }
}