<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\BooleanEnsurance;

/**
 * Class BooleanException
 * @package Dgame\Ensurance\Exception
 */
final class BooleanException extends FormatException
{
    const MESSAGE = '"%s" is not a boolean value';

    /**
     * BooleanException constructor.
     *
     * @param BooleanEnsurance $ensurance
     */
    public function __construct(BooleanEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}