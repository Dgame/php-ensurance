<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\CallableException;
use Dgame\Ensurance\Traits\EnsuranceTrait;
use Dgame\Ensurance\Traits\ExceptionCascadeTrait;

/**
 * Class CallableEnsurance
 * @package Dgame\Ensurance
 */
final class CallableEnsurance
{
    use EnsuranceTrait, ExceptionCascadeTrait;

    /**
     * CallableEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_callable($this->value)) {
            $this->triggerCascade(new CallableException($this));
        }
    }
}