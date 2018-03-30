<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;

/**
 * Class ObjectEnsurance
 * @package Dgame\Ensurance
 */
final class ObjectEnsurance extends ClassEnsurance
{
    /**
     * @var string
     */
    private $class;

    /**
     * ObjectEnsurance constructor.
     *
     * @param $object
     *
     * @throws \ReflectionException
     */
    public function __construct($object)
    {
        enforce(is_object($object))->setThrowable(new EnsuranceException('That is not an object'));

        parent::__construct(get_class($object));

        $this->class = $object;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isSome(string $class): self
    {
        $this->ensure(is_a($this->class, $class))->orThrow('"%s" is not "%s"', get_class($this->class), $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isNotSome(string $class): self
    {
        $this->ensure(!is_a($this->class, $class))->orThrow('"%s" is "%s"', get_class($this->class), $class);

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
        $this->ensure($this->class instanceof $class)->orThrow('"%s" is not an instance of "%s"', get_class($this->class), $class);

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
        $this->ensure(!($this->class instanceof $class))->orThrow('"%s" is an instance of "%s"', get_class($this->class), $class);

        return $this;
    }
}