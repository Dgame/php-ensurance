<?php

namespace Dgame\Ensurance\Exception;

use function Dgame\Ensurance\format;

/**
 * Class EnsuranceFormatException
 * @package Dgame\Ensurance\Exception
 */
class EnsuranceFormatException extends EnsuranceException
{
    /**
     * EnsuranceFormatException constructor.
     *
     * @param string $message
     * @param mixed  ...$args
     */
    public function __construct(string $message, ...$args)
    {
        parent::__construct(format($message, ...$args));
    }
}