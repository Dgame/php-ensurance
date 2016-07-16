<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\StringEnsurance;

/**
 * Class StringException
 * @package Dgame\Ensurance\Exception
 */
final class StringException extends EnsuranceException
{
    const MESSAGE = '"%s" is not a string';

    /**
     * StringException constructor.
     *
     * @param StringEnsurance $ensurance
     */
    public function __construct(StringEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}