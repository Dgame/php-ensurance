<?php

namespace Dgame\Ensurance\Exception;

use Exception;

/**
 * Class EnsuranceException
 * @package Dgame\Ensurance\Exception
 */
class EnsuranceException extends Exception
{
    /**
     * EnsuranceException constructor.
     *
     * @param string $message
     * @param array  ...$args
     */
    public function __construct(string $message, ...$args)
    {
        parent::__construct(vsprintf($message, $args));
    }
}