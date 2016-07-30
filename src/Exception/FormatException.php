<?php

namespace Dgame\Ensurance\Exception;

/**
 * Class FormatException
 * @package Dgame\Ensurance\Exception
 */
class FormatException extends EnsuranceException
{
    /**
     * FormatException constructor.
     *
     * @param string $message
     * @param array  ...$args
     */
    public function __construct(string $message, ...$args)
    {
        parent::__construct(sprintf($message, ...$args));
    }
}