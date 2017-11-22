<?php

namespace Dgame\Ensurance\Enforcement;

use Dgame\Ensurance\Exception\EnsuranceException;
use Throwable;

/**
 * Class Enforcement
 * @package Dgame\Ensurance\Enforcement
 */
final class Enforcement
{
    /**
     * @var bool
     */
    private $condition;
    /**
     * @var null|Throwable
     */
    private $throwable;

    /**
     * Enforcement constructor.
     *
     * @param bool        $condition
     * @param string|null $message
     */
    public function __construct(bool $condition, string $message = null)
    {
        $this->condition = $condition;
        if ($message !== null) {
            $this->setThrowMessage($message);
        }
    }

    /**
     * @throws Throwable
     */
    public function __destruct()
    {
        if (!$this->isFulfilled()) {
            throw $this->getThrowable();
        }
    }

    /**
     * Enforce approvement of the Enforcement
     */
    final public function approve()
    {
        $this->condition = true;
    }

    /**
     * @return bool
     */
    final public function isFulfilled(): bool
    {
        return $this->condition;
    }

    /**
     * @return bool
     */
    final public function hasThrowable(): bool
    {
        return $this->throwable !== null;
    }

    /**
     * @return Throwable
     */
    private function getThrowable(): Throwable
    {
        return $this->throwable ?? $this->emplaceThrowable('Assertion failed');
    }

    /**
     * @param string $message
     *
     * @return Throwable
     */
    private function emplaceThrowable(string $message): Throwable
    {
        return new EnsuranceException($message);
    }

    /**
     * @param string|Throwable $throwable
     * @param array            ...$args
     */
    final public function orThrow($throwable, ...$args)
    {
        if ($throwable instanceof Throwable) {
            $this->setThrowable($throwable);
        } else {
            $this->setThrowMessage((string) $throwable, ...$args);
        }
    }

    /**
     * @param string $message
     * @param array  ...$args
     */
    final public function setThrowMessage(string $message, ...$args)
    {
        if (!empty($args)) {
            $args    = array_map(function ($arg) {
                return !is_string($arg) ? var_export($arg, true) : $arg;
            }, $args);
            $message = sprintf($message, ...$args);
        }

        $throwable = $this->emplaceThrowable($message);

        $this->setThrowable($throwable);
    }

    /**
     * @param Throwable $throwable
     */
    final public function setThrowable(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }
}