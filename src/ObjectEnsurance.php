<?php

namespace Dgame\Ensurance;

/**
 * Class ObjectEnsurance
 * @package Dgame\Ensurance
 */
final class ObjectEnsurance extends ClassEnsurance
{
    /**
     * @var string
     */
    private $object;

    /**
     * ObjectEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     *
     * @throws \ReflectionException
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        parent::__construct($ensurance);
        $this->object = $ensurance->else(null);
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isSome(string $class): self
    {
        $this->ensure(is_a($this->object, $class))->orThrow('"%s" is not "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isNotSome(string $class): self
    {
        $this->ensure(!is_a($this->object, $class))->orThrow('"%s" is "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param $class
     *
     * @return ObjectEnsurance
     */
    public function isInstanceOf($class): self
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->ensure($this->object instanceof $class)->orThrow('"%s" is not an instance of "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param $class
     *
     * @return ObjectEnsurance
     */
    public function isNotInstanceOf($class): self
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->ensure(!($this->object instanceof $class))->orThrow('"%s" is an instance of "%s"', get_class($this->object), $class);

        return $this;
    }
}