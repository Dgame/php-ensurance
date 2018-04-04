<?php

namespace Dgame\Ensurance\Exception;

use Exception;
use Throwable;

/**
 * Class EnsuranceException
 * @package Dgame\Ensurance\Exception
 */
class EnsuranceException extends Exception
{
    /**
     * EnsuranceException constructor.
     *
     * @param string    $message
     * @param Throwable $previous
     */
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}