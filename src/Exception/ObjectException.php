<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\ObjectEnsurance;

/**
 * Class ObjectException
 * @package Dgame\Ensurance\Exception
 */
final class ObjectException extends FormatException
{
    const MESSAGE = '"%s" is not an object';

    /**
     * ObjectException constructor.
     *
     * @param ObjectEnsurance $ensurance
     */
    public function __construct(ObjectEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}