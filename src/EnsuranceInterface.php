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
     * @param $value
     *
     * @return mixed
     */
    public function then($value);

    /**
     * @param $value
     *
     * @return mixed
     */
    public function else($value);

    /**
     * @param null $default
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
     * @return Throwable
     */
    public function getThrowable(): Throwable;

    /**
     * @return mixed
     */
    public function disregardThrowable();

    /**
     * @return Throwable
     */
    public function releaseThrowable(): Throwable;

    /**
     * @param self $ensurance
     *
     * @return mixed
     */
    public function transferEnsurance(self $ensurance);
}