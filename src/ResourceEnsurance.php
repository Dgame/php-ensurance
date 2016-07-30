<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\ResourceException;
use Dgame\Ensurance\Traits\EnsuranceTrait;
use Dgame\Ensurance\Traits\ExceptionCascadeTrait;

/**
 * Class ResourceEnsurance
 * @package Dgame\Ensurance
 */
final class ResourceEnsurance
{
    use EnsuranceTrait, ExceptionCascadeTrait;

    /**
     * ResourceEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_resource($this->value)) {
            $this->triggerCascade(new ResourceException($this));
        }
    }
}