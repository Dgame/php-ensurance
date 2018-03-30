<?php

namespace Dgame\Ensurance;

use Throwable;

/**
 * Interface EnsuranceInterface
 * @package Dgame\Ensurance
 */
interface EnsuranceInterface
{
    /**
     * @return bool
     */
    public function isEnsured(): bool;

    /**
     * @param string $message
     * @param mixed  ...$args
     */
    public function orThrow(string $message, ...$args);

    /**
     * @return bool
     */
    public function hasThrowable(): bool;

    /**
     * @param Throwable $throwable
     *
     * @return self
     */
    public function setThrowable(Throwable $throwable): self;

    /**
     * @return Throwable
     */
    public function getThrowable(): Throwable;

    /**
     * @return EnsuranceInterface
     */
    public function disregardThrowable(): self;
}