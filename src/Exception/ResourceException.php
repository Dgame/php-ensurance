<?php

namespace Dgame\Ensurance\Exception;

use Dgame\Ensurance\ResourceEnsurance;

/**
 * Class ResourceException
 * @package Dgame\Ensurance\Exception
 */
final class ResourceException extends FormatException
{
    const MESSAGE = '"%s" is not a resource';

    /**
     * ResourceException constructor.
     *
     * @param ResourceEnsurance $ensurance
     */
    public function __construct(ResourceEnsurance $ensurance)
    {
        parent::__construct(self::MESSAGE, $ensurance->getValue());
    }
}