<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\NumericEnsurance;

/**
 * Class NumericException
 * @package Dgame\Ensurance\Exception
 */
final class NumericException extends FormatException
{
    const MESSAGE = '"%s" is not a numeric value';

    /**
     * NumericException constructor.
     *
     * @param NumericEnsurance $ensurance
     */
    public function __construct(NumericEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}