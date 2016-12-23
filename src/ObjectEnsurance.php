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
     * @var object
     */
    private $object;

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

        parent::__construct(get_class($object));

        $this->object = $object;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isSome(string $class): ObjectEnsurance
    {
        $this->enforce(is_a($this->object, $class))->orThrow('"%s" is not "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param string $class
     *
     * @return ObjectEnsurance
     */
    public function isNotSome(string $class): ObjectEnsurance
    {
        $this->enforce(!is_a($this->object, $class))->orThrow('"%s" is "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param $class
     *
     * @return ObjectEnsurance
     */
    public function isInstanceOf($class): ObjectEnsurance
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->enforce($this->object instanceof $class)->orThrow('"%s" is not an instance of "%s"', get_class($this->object), $class);

        return $this;
    }

    /**
     * @param $class
     *
     * @return ObjectEnsurance
     */
    public function isNotInstanceOf($class): ObjectEnsurance
    {
        $class = is_object($class) ? get_class($class) : $class;
        $this->enforce(!($this->object instanceof $class))->orThrow('"%s" is an instance of "%s"', get_class($this->object), $class);

        return $this;
    }
}