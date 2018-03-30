<?php

namespace Dgame\Ensurance;

/**
 * Class BooleanEnsurance
 * @package Dgame\Ensurance
 */
final class BooleanEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * BooleanEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
    }

    /**
     * @return BooleanEnsurance
     */
    public function isTrue(): self
    {
        $this->ensure($this->value)->orThrow('The value is not true');

        return $this;
    }

    /**
     * @return BooleanEnsurance
     */
    public function isFalse(): self
    {
        $this->ensure(!$this->value)->orThrow('The value is true');

        return $this;
    }
}