<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\ScalarEnsurance;

/**
 * Class ScalarException
 * @package Dgame\Ensurance\Exception
 */
final class ScalarException extends EnsuranceException
{
    const MESSAGE = '"%s" is not a scalar value';

    /**
     * ScalarException constructor.
     *
     * @param ScalarEnsurance $ensurance
     */
    public function __construct(ScalarEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}