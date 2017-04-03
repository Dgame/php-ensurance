<?php

namespace Dgame\Ensurance;

use Prophecy\Exception\Exception;

/**
 * Class EnforcementTrait
 * @package Dgame\Ensurance
 */
trait EnforcementTrait
{
    /**
     * @var Enforcement|null
     */
    private $enforcement;

    /**
     * @param string|Exception $exception
     * @param array            ...$args
     *
     * @return $this
     */
    final public function orThrow($exception, ...$args)
    {
        if ($this->hasEnforcement()) {
            $this->enforcement->orThrow($exception, ...$args);
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
        $enforcement = new Enforcement($condition);
        if (!$this->isEnforcementFulfilled() && !$enforcement->isFulfilled()) {
            $this->approveEnforcementWith($enforcement);
        }

        $this->enforcement = $enforcement;

        return $this;
    }

    /**
     * @param Enforcement $enforcement
     */
    private function approveEnforcementWith(Enforcement $enforcement)
    {
        if ($this->hasEnforcement()) {
            if ($this->enforcement->hasException()) {
                $enforcement->setException($this->enforcement->getException());
            }

            $this->enforcement->approve();
        }
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