<?php

namespace Dgame\Ensurance\Traits;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\ExceptionCascade;

/**
 * Class ExceptionCascadeTrait
 * @package Dgame\Ensurance
 */
trait ExceptionCascadeTrait
{
    /**
     * @var null|ExceptionCascade
     */
    private $cascade = null;

    /**
     * @param string $message
     *
     * @return $this
     */
    final public function orThrow(string $message)
    {
        if ($this->cascade !== null) {
            $this->cascade->setExceptionMessage($message);
        }

        return $this;
    }

    /**
     * @param EnsuranceException $exception
     */
    final protected function triggerCascade(EnsuranceException $exception)
    {
        if ($this->cascade === null) {
            $this->cascade = new ExceptionCascade();
        }

        $this->cascade->activate()->setException($exception);
    }
}
