<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Traits\EnforcementTrait;

/**
 * Class BooleanEnsurance
 * @package Dgame\Ensurance
 */
final class BooleanEnsurance
{
    /**
     * @var bool
     */
    private $condition;

    use EnforcementTrait;

    /**
     * BooleanEnsurance constructor.
     *
     * @param bool $condition
     */
    public function __construct(bool $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return BooleanEnsurance
     */
    public function isTrue(): BooleanEnsurance
    {
        $this->enforce($this->condition === true)->orThrow('The value is not true');

        return $this;
    }

    /**
     * @return BooleanEnsurance
     */
    public function isFalse(): BooleanEnsurance
    {
        $this->enforce($this->condition === false)->orThrow('The value is true');

        return $this;
    }
}