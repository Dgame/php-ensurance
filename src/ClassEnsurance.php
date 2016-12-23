<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\EnforcementTrait;
use ReflectionClass;

/**
 * Class ClassEnsurance
 * @package Dgame\Ensurance
 */
class ClassEnsurance
{
    /**
     * @var string
     */
    private $class;
    /**
     * @var ReflectionClass
     */
    private $reflection;

    use EnforcementTrait;

    /**
     * ClassEnsurance constructor.
     *
     * @param string $class
     *
     * @throws EnsuranceException
     */
    public function __construct(string $class)
    {
        if (!class_exists($class)) {
            throw new EnsuranceException('"%s" is not a class', $class);
        }

        $this->class      = $class;
        $this->reflection = new ReflectionClass($class);
    }

    /**
     * @return string
     */
    final protected function getClass(): string
    {
        return $this->class;
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
    public function is(string $class): ClassEnsurance
    {
        $this->enforce($this->class === $class)->orThrow('"%s" is not "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function isNot(string $class): ClassEnsurance
    {
        $this->enforce($this->class !== $class)->orThrow('"%s" is "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function extends (string $class): ClassEnsurance
    {
        $this->enforce($this->reflection->isSubclassOf($class))->orThrow('"%s" did not extend "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function extendsNot(string $class): ClassEnsurance
    {
        $this->enforce(!$this->reflection->isSubclassOf($class))->orThrow('"%s" did extend "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ClassEnsurance
     */
    public function implements (string $interface): ClassEnsurance
    {

        $this->enforce($this->reflection->implementsInterface($interface))
             ->orThrow('"%s" does not implements interface "%s"', $this->class, $interface);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ClassEnsurance
     */
    public function implementsNot(string $interface): ClassEnsurance
    {
        $this->enforce(!$this->reflection->implementsInterface($interface))
             ->orThrow('"%s" does implements interface "%s"', $this->class, $interface);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function isParentOf(string $class): ClassEnsurance
    {
        $this->enforce(array_key_exists($this->class, class_parents($class, true)))
             ->orThrow('"%s" is not a parent of "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ClassEnsurance
     */
    public function isNotParentOf(string $class): ClassEnsurance
    {
        $this->enforce(!array_key_exists($this->class, class_parents($class, true)))
             ->orThrow('"%s" is a parent of "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $trait
     *
     * @return ClassEnsurance
     */
    public function uses(string $trait): ClassEnsurance
    {
        $this->enforce(array_key_exists($trait, $this->reflection->getTraitNames()))
             ->orThrow('"%s" does not use trait "%s"', $this->class, $trait);

        return $this;
    }

    /**
     * @param string $property
     *
     * @return ClassEnsurance
     */
    public function hasProperty(string $property): ClassEnsurance
    {
        $this->enforce($this->reflection->hasProperty($property))
             ->orThrow('"%s" does not have a property "%s"', $this->class, $property);

        return $this;
    }

    /**
     * @param string $method
     *
     * @return ClassEnsurance
     */
    public function hasMethod(string $method): ClassEnsurance
    {
        $this->enforce($this->reflection->hasMethod($method))
             ->orThrow('"%s" does not have a method "%s"', $this->class, $method);

        return $this;
    }
}