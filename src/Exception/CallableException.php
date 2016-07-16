<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\CallableEnsurance;

/**
 * Class CallableException
 * @package Dgame\Ensurance\Exception
 */
final class CallableException extends EnsuranceException
{
    const MESSAGE = '"%s" is not a callable';

    /**
     * CallableException constructor.
     *
     * @param CallableEnsurance $ensurance
     */
    public function __construct(CallableEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}