<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\ArrayEnsurance;

/**
 * Class ArrayException
 * @package Dgame\Ensurance\Exception
 */
final class ArrayException extends EnsuranceException
{
    const MESSAGE = '"%s" is not an array';

    /**
     * ArrayException constructor.
     *
     * @param ArrayEnsurance $ensurance
     */
    public function __construct(ArrayEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}