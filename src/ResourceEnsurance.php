<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\ResourceException;
use Dgame\Ensurance\Traits\EnsuranceTrait;

/**
 * Class ResourceEnsurance
 * @package Dgame\Ensurance
 */
final class ResourceEnsurance
{
    use EnsuranceTrait;

    /**
     * ResourceEnsurance constructor.
     *
     * @param Ensurance $ensurance
     */
    public function __construct(Ensurance $ensurance)
    {
        $this->value = $ensurance->getValue();

        if (!is_resource($this->value)) {
            throw new ResourceException($this);
        }
    }
}