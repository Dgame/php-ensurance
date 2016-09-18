<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class ObjectEnsurance
 * @package Dgame\Ensurance
 */
final class ObjectEnsurance
{
    /**
     * @var object
     */
    private $object;

    use EnforcementTrait;

    /**
     * ObjectEnsurance constructor.
     *
     * @param $object
     *
     * @throws EnsuranceException
     */
    public function __construct($object)
    {
        if (!is_object($object)) {
            throw new EnsuranceException('That is not an object');
        }

        $this->object = $object;
    }

    /**
     * @param object $object
     *
     * @return ObjectEnsurance
     */
    public function isInstanceOf($object): ObjectEnsurance
    {
        $class = is_object($object) ? get_class($object): $object;
        $this->enforce($this->object instanceof $object)->orThrow('"%s" is not an instance of "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function is(string $class): ObjectEnsurance
    {
        $this->enforce(is_a($this->object, $class))->orThrow('"%s" is not "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function extends (string $class): ObjectEnsurance
    {
        $this->enforce(is_subclass_of($this->object, $class))->orThrow('"%s" did not extend "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ObjectEnsurance
     */
    public function implements (string $interface): ObjectEnsurance
    {
        $this->enforce(array_key_exists($interface, class_implements($this->object)))
             ->orThrow('"%s" does not implements interface "%s"', get_class($this->object), $interface);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isParentOf(string $class): ObjectEnsurance
    {
        $object_class_name = get_class($this->object);
        $this->enforce(array_key_exists($object_class_name, class_parents($class, true)))
             ->orThrow('"%s" is not a parent of "%s"', $object_class_name, $class);

        return $this;
    }

    /**
     * @param string $trait
     *
     * @return ObjectEnsurance
     */
    public function uses(string $trait): ObjectEnsurance
    {
        $this->enforce(array_key_exists($trait, class_uses($this->object)))
             ->orThrow('"%s" does not use trait "%s"', get_class($this->object), $trait);

        return $this;
    }

    /**
     * @param string $property
     *
     * @return ObjectEnsurance
     */
    public function hasProperty(string $property): ObjectEnsurance
    {
        $this->enforce(property_exists($this->object, $property))
             ->orThrow('"%s" does not have a property "%s"', get_class($this->object), $property);

        return $this;
    }

    /**
     * @param string $method
     *
     * @return ObjectEnsurance
     */
    public function hasMethod(string $method): ObjectEnsurance
    {
        $this->enforce(method_exists($this->object, $method))
             ->orThrow('"%s" does not have a method "%s"', get_class($this->object), $method);

        return $this;
    }
}