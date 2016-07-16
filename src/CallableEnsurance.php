<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\CallableException;
use Dgame\Ensurance\Traits\EnsuranceTrait;

/**
 * Class CallableEnsurance
 * @package Dgame\Ensurance
 */
final class CallableEnsurance
{
    use EnsuranceTrait;

    /**
     * CallableEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_callable($this->value)) {
            throw new CallableException($this);
        }
    }
}