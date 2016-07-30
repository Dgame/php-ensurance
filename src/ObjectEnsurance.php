<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Exception\ObjectException;
use Dgame\Ensurance\Traits\EnsuranceTrait;
use Dgame\Ensurance\Traits\ExceptionCascadeTrait;

/**
 * Class ObjectEnsurance
 * @package Dgame\Ensurance
 */
final class ObjectEnsurance
{
    use EnsuranceTrait, ExceptionCascadeTrait;

    /**
     * ObjectEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_object($this->value)) {
            $this->triggerCascade(new ObjectException($this));
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
     */
    public function is(string $class) : ObjectEnsurance
    {
        if (!is_a($this->value, $class)) {
            $this->triggerCascade(new EnsuranceException('"%s" is not "%s"', $this->className(), $class));
        }

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function extends (string $class) : ObjectEnsurance
    {
        if (!is_subclass_of($this->value, $class)) {
            $this->triggerCascade(new EnsuranceException('"%s" did not extend "%s"', $this->className(), $class));
        }

        return $this;
    }

    /**
     * @param string $interface
     *
     * @return ObjectEnsurance
     */
    public function implements (string $interface) : ObjectEnsurance
    {
        if (!array_key_exists($interface, class_implements($this->value))) {
            $this->triggerCascade(new EnsuranceException('"%s" does not implements interface "%s"', $this->className(), $interface));
        }

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isParentOf(string $class) : ObjectEnsurance
    {
        if (!array_key_exists($this->className(), class_parents($class, true))) {
            $this->triggerCascade(new EnsuranceException('"%s" is not a parent of class "%s"', $this->className(), $class));
        }

        return $this;
    }

    /**
     * @param string $trait
     *
     * @return ObjectEnsurance
     */
    public function useTrait(string $trait) : ObjectEnsurance
    {
        if (!array_key_exists($trait, class_uses($this->value))) {
            $this->triggerCascade(new EnsuranceException('"%s" does not use trait "%s"', $this->className(), $trait));
        }

        return $this;
    }

    /**
     * @param string $property
     *
     * @return ObjectEnsurance
     */
    public function hasProperty(string $property) : ObjectEnsurance
    {
        if (!property_exists($this->value, $property)) {
            $this->triggerCascade(new EnsuranceException('"%s" does not have a property "%s"', $this->className(), $property));
        }

        return $this;
    }

    /**
     * @param string $method
     *
     * @return ObjectEnsurance
     */
    public function hasMethod(string $method) : ObjectEnsurance
    {
        if (!property_exists($this->value, $method)) {
            $this->triggerCascade(new EnsuranceException('"%s" does not have a method "%s"', $this->className(), $method));
        }

        return $this;
    }
}