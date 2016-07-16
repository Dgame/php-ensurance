<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Exception\ObjectException;
use Dgame\Ensurance\Traits\EnsuranceTrait;

/**
 * Class ObjectEnsurance
 * @package Dgame\Ensurance
 */
final class ObjectEnsurance
{
    use EnsuranceTrait;

    /**
     * ObjectEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_object($this->value)) {
            throw new ObjectException($this);
        }
    }

    /**
     * @return string
     */
    private function className() : string
    {
        static $class = null;
        if ($class === null) {
            $class = get_class($this->value);
        }

        return $class;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function is(string $class) : ObjectEnsurance
    {
        if (!is_a($this->value, $class)) {
            throw new EnsuranceException('"%s" is not "%s"', $this->className(), $class);
        }

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function extends(string $class) : ObjectEnsurance
    {
        if (!is_subclass_of($this->value, $class)) {
            throw new EnsuranceException('"%s" did not extend "%s"', $this->className(), $class);
        }

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function implements(string $interface) : ObjectEnsurance
    {
        if (!array_key_exists($interface, class_implements($this->value))) {
            throw new EnsuranceException('"%s" does not implements interface "%s"', $this->className(), $interface);
        }

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function isParentOf(string $class) : ObjectEnsurance
    {
        if (!array_key_exists($this->className(), class_parents($class, true))) {
            throw new EnsuranceException('"%s" is not a parent of class "%s"', $this->className(), $class);
        }

        return $this;
    }

    /**
     * @param string $trait
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function useTrait(string $trait) : ObjectEnsurance
    {
        if (!array_key_exists($trait, class_uses($this->value))) {
            throw new EnsuranceException('"%s" does not use trait "%s"', $this->className(), $trait);
        }

        return $this;
    }

    /**
     * @param string $property
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function hasProperty(string $property) : ObjectEnsurance
    {
        if (!property_exists($this->value, $property)) {
            throw new EnsuranceException('"%s" does not have a property "%s"', $this->className(), $property);
        }

        return $this;
    }

    /**
     * @param string $method
     *
     * @return ObjectEnsurance
     * @throws EnsuranceException
     */
    public function hasMethod(string $method) : ObjectEnsurance
    {
        if (!property_exists($this->value, $method)) {
            throw new EnsuranceException('"%s" does not have a method "%s"', $this->className(), $method);
        }

        return $this;
    }
}