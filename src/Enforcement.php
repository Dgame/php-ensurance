<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Exception;

/**
 * Class Enforcement
 * @package Dgame\Ensurance
 */
final class Enforcement
{
    /**
     * @var bool
     */
    private $condition;
    /**
     * @var null|Exception
     */
    private $exception;

    /**
     * Enforcement constructor.
     *
     * @param bool $condition
     */
    public function __construct(bool $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @throws EnsuranceException
     */
    public function __destruct()
    {
        if (!$this->isFulfilled()) {
            if ($this->hasException()) {
                throw $this->exception;
            }

            throw new EnsuranceException('Assertion failed');
        }
    }

    /**
     * Enforce approvement of the Enforcement
     */
    public function approve()
    {
        $this->condition = true;
    }

    /**
     * @return boolean
     */
    public function isFulfilled(): bool
    {
        return $this->condition;
    }

    /**
     * @return bool
     */
    public function hasException(): bool
    {
        return $this->exception !== null;
    }

    /**
     * @return Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception|string $exception
     * @param array            ...$args
     */
    public function orThrow($exception, ...$args)
    {
        if ($exception instanceof Exception) {
            $this->setException($exception);
        } else {
            $this->setExceptionMessage((string) $exception, ...$args);
        }
    }

    /**
     * @param string $message
     * @param array  ...$args
     */
    public function setExceptionMessage(string $message, ...$args)
    {
        if (!empty($args)) {
            $args    = array_map(function ($arg) {
                return !is_string($arg) ? var_export($arg, true) : $arg;
            }, $args);
            $message = sprintf($message, ...$args);
        }

        $this->setException(new EnsuranceException($message, 0, $this->exception));
    }

    /**
     * @param Exception $exception
     */
    public function setException(Exception $exception)
    {
        $this->exception = $exception;
    }
}
