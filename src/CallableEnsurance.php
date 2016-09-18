<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class CallableEnsurance
 * @package Dgame\Ensurance
 */
final class CallableEnsurance
{
    /**
     * @var callable
     */
    private $callback;

    use EnforcementTrait;

    /**
     * CallableEnsurance constructor.
     *
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }
}