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
     * @param mixed $value
     *
     * @return mixed
     */
    public function then($value);

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function else($value);

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function get($default = null);

    /**
     * @return bool
     */
    public function isEnsured(): bool;

    /**
     * @param string $message
     * @param mixed  ...$args
     *
     * @return mixed
     */
    public function orThrow(string $message, ...$args);

    /**
     * @return bool
     */
    public function hasThrowable(): bool;

    /**
     * @param Throwable $throwable
     *
     * @return mixed
     */
    public function setThrowable(Throwable $throwable);

    /**
     * @return Throwable|null
     */
    public function getThrowable(): ?Throwable;

    /**
     * @return mixed
     */
    public function disregardThrowable();

    /**
     * @return Throwable|null
     */
    public function releaseThrowable(): ?Throwable;

    /**
     * @param self $ensurance
     *
     * @return mixed
     */
    public function transferEnsurance(self $ensurance);
}
