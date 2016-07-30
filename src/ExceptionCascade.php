<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;

/**
 * Class ExceptionCascade
 * @package Dgame\Ensurance
 */
final class ExceptionCascade
{
    /**
     * @var bool
     */
    private $active = false;
    /**
     * @var null|EnsuranceException
     */
    private $exception = null;

    /**
     *
     */
    public function __destruct()
    {
        if ($this->exception !== null && $this->active) {
            throw $this->exception;
        }
    }

    /**
     * @return ExceptionCascade
     */
    public function activate() : ExceptionCascade
    {
        $this->active = true;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return ExceptionCascade
     */
    public function setExceptionMessage(string $message) : ExceptionCascade
    {
        return $this->setException(new EnsuranceException($message, $this->exception));
    }

    /**
     * @param EnsuranceException $exception
     *
     * @return ExceptionCascade
     */
    public function setException(EnsuranceException $exception) : ExceptionCascade
    {
        $this->exception = $exception;

        return $this;
    }
}