<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class ResourceEnsurance
 * @package Dgame\Ensurance
 */
final class ResourceEnsurance
{
    /**
     * @var null|resource
     */
    private $resource = null;

    use EnforcementTrait;

    /**
     * ResourceEnsurance constructor.
     *
     * @param $resource
     *
     * @throws EnsuranceException
     */
    public function __construct($resource)
    {
        if (!is_resource($resource)) {
            throw new EnsuranceException('That is not a resource');
        }

        $this->resource = $resource;
    }
}