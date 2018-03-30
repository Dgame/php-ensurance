<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Throwable;

/**
 * Trait EnsuranceTrait
 * @package Dgame\Ensurance
 */
trait EnsuranceTrait
{
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var bool
     */
    private $ensured = true;
    /**
     * @var Throwable
     */
    private $throwable;

    /**
     *
     */
    public function __destruct()
    {
        if ($this->hasThrowable()) {
            throw $this->throwable;
        }
    }

    /**
     * @param bool $condition
     *
     * @return self
     */
    final protected function ensure(bool $condition): self
    {
        $this->ensured = $condition;

        return $this;
    }

    /**
     * @return bool
     */
    final public function isEnsured(): bool
    {
        return $this->ensured;
    }

    /**
     * @return EnsuranceInterface
     */
    final public function disregardThrowable(): EnsuranceInterface
    {
        $this->throwable = null;

        return $this;
    }

    /**
     * @param string $message
     * @param mixed  ...$args
     *
     * @return self
     */
    final public function orThrow(string $message, ...$args): self
    {
        if (!$this->isEnsured()) {
            $this->setThrowable(new EnsuranceException(format($message, ...$args), $this->throwable));
        }

        return $this;
    }

    /**
     * @return bool
     */
    final public function hasThrowable(): bool
    {
        return $this->throwable !== null;
    }

    /**
     * @param Throwable $throwable
     *
     * @return EnsuranceInterface
     */
    final public function setThrowable(Throwable $throwable): EnsuranceInterface
    {
        if (!$this->isEnsured()) {
            $this->throwable = $throwable;
        }

        return $this;
    }

    /**
     * @return Throwable
     */
    final public function getThrowable(): Throwable
    {
        return $this->throwable;
    }
}