<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\EnforcementTrait;

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

    use EnforcementTrait;

    /**
     * ClassEnsurance constructor.
     *
     * @param string $class
     */
    public function __construct(string $class)
    {
        if (!class_exists($class)) {
            throw new EnsuranceException('"%s" is not a class', $class);
        }

        $this->class = $class;
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
    public function extends (string $class): ClassEnsurance
    {
        $this->enforce(is_subclass_of($this->class, $class))->orThrow('"%s" did not extend "%s"', $this->class, $class);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ClassEnsurance
     */
    public function implements (string $interface): ClassEnsurance
    {
        $this->enforce(array_key_exists($interface, class_implements($this->class)))
             ->orThrow('"%s" does not implements interface "%s"', $this->class, $interface);

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
     * @param string $trait
     *
     * @return ClassEnsurance
     */
    public function uses(string $trait): ClassEnsurance
    {
        $this->enforce(array_key_exists($trait, class_uses($this->class)))
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
        $this->enforce(property_exists($this->class, $property))
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
        $this->enforce(method_exists($this->class, $method))
             ->orThrow('"%s" does not have a method "%s"', $this->class, $method);

        return $this;
    }
}