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
     * @param string         $message
     * @param Exception|null $previous
     */
    public function __construct(string $message, Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}