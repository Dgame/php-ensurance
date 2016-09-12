<?php

namespace Dgame\Ensurance\Traits;

use Dgame\Ensurance\Enforcement;

/**
 * Class EnforcementTrait
 * @package Dgame\Ensurance\Traits
 */
trait EnforcementTrait
{
    /**
     * @var null|Enforcement
     */
    private $enforcement = null;

    /**
     * @param string $message
     * @param array  ...$args
     *
     * @return $this
     */
    final public function orThrow(string $message, ...$args)
    {
        if ($this->enforcement !== null) {
            $this->enforcement->orThrow($message, ...$args);
        }

        return $this;
    }

    /**
     * @return bool
     */
    final public function verify(): bool
    {
        if ($this->enforcement !== null && !$this->enforcement->isValid()) {
            $this->enforcement->deny();

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
}