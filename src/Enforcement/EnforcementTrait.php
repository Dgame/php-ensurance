<?php

namespace Dgame\Ensurance\Enforcement;

use Throwable;

/**
 * Trait EnforcementTrait
 * @package Dgame\Ensurance\Enforcement
 */
trait EnforcementTrait
{
    /**
     * @var Enforcement|null
     */
    private $enforcement;

    /**
     * @param string|Throwable $throwable
     * @param array            ...$args
     *
     * @return $this
     */
    final public function orThrow($throwable, ...$args)
    {
        if ($this->hasEnforcement()) {
            $this->enforcement->orThrow($throwable, ...$args);
        }

        return $this;
    }

    /**
     * @return bool
     */
    final public function verify(): bool
    {
        if (!$this->isEnforcementFulfilled()) {
            $this->approveEnforcement();

            return false;
        }

        return true;
    }

    /**
     * @param bool $condition
     *
     * @return $this
     */
    final protected function enforce(bool $condition)
    {
        $this->enforcement = new Enforcement($condition);

        return $this;
    }

    /**
     *
     */
    private function approveEnforcement()
    {
        if ($this->hasEnforcement()) {
            $this->enforcement->approve();
        }
    }

    /**
     * @return bool
     */
    final protected function isEnforcementFulfilled(): bool
    {
        return $this->hasEnforcement() && $this->enforcement->isFulfilled();
    }

    /**
     * @return bool
     */
    private function hasEnforcement(): bool
    {
        return $this->enforcement !== null;
    }
}