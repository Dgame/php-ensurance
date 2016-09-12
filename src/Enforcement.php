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
    private $condition = true;
    /**
     * @var null|Exception
     */
    private $exception = null;

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
        if (!$this->isValid()) {
            if ($this->exception === null) {
                throw new EnsuranceException('Assertion failed');
            }

            throw $this->exception;
        }
    }

    /**
     *
     */
    public function deny()
    {
        $this->condition = true;
    }

    /**
     * @return boolean
     */
    public function isValid(): bool
    {
        return $this->condition;
    }

    /**
     * @return Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     */
    private function setException(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @param string $message
     * @param array  ...$args
     */
    private function setExceptionMessage(string $message, ...$args)
    {
        if (!empty($args)) {
            $message = sprintf($message, ...$args);
        }

        $this->setException(new EnsuranceException($message));
    }

    /**
     * @param Exception|string $exception
     * @param array            ...$args
     */
    public function orThrow($exception, ...$args)
    {
        if (!$this->isValid()) {
            if ($exception instanceof Exception) {
                $this->setException($exception);
            } else {
                $this->setExceptionMessage($exception, ...$args);
            }
        }
    }
}

/**
 * @param bool $condition
 *
 * @return Enforcement
 */
function enforce(bool $condition) : Enforcement
{
    return new Enforcement($condition);
}