<?php

namespace Dgame\Ensurance;

use Dgame\Ensurance\Exception\EnsuranceException;
use Dgame\Type\Type;
use Dgame\Type\TypeFactory;
use Throwable;

/**
 * Trait EnsuranceTrait
 * @package Dgame\Ensurance
 */
trait EnsuranceTrait
{
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var bool
     */
    private $ensured = true;
    /**
     * @var Throwable
     */
    private $throwable;

    /**
     *
     */
    public function __destruct()
    {
        if ($this->hasThrowable()) {
            throw $this->throwable;
        }
    }

    /**
     * @param callable $callback
     *
     * @return self
     */
    final public function is(callable $callback): self
    {
        try {
            $result = (bool) $callback($this->value);
        } catch (Throwable $t) {
            $result = false;
        }

        return $this->ensure($result);
    }

    /**
     * @param string $type
     *
     * @return EnsuranceTrait
     * @throws \Exception
     */
    final public function isTypeOf(string $type): self
    {
        $type = Type::import($type);

        return $this->ensure(TypeFactory::expression($this->value)->isSame($type));
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    final public function then($value)
    {
        return $this->disregardThrowable()->isEnsured() ? $value : $this->value;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    final public function else($value)
    {
        return $this->disregardThrowable()->isEnsured() ? $this->value : $value;
    }

    /**
     * @param $value
     *
     * @return Either
     */
    final public function either($value): Either
    {
        return new Either($value, $this->disregardThrowable()->isEnsured());
    }

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    final public function get($default = null)
    {
        return $this->value ?? $default;
    }

    /**
     * @param bool $condition
     *
     * @return self
     */
    final protected function ensure(bool $condition): self
    {
        $this->ensured = $condition;

        return $this;
    }

    /**
     * @return bool
     */
    final public function isEnsured(): bool
    {
        return $this->ensured;
    }

    /**
     * @return self
     */
    final public function disregardThrowable(): self
    {
        $this->throwable = null;

        return $this;
    }

    /**
     * @return Throwable
     */
    final public function releaseThrowable(): Throwable
    {
        try {
            return $this->throwable;
        } finally {
            $this->disregardThrowable();
        }
    }

    /**
     * @param EnsuranceInterface $ensurance
     *
     * @return self
     */
    final public function transferEnsurance(EnsuranceInterface $ensurance): self
    {
        $this->value = $ensurance->get();
        $this->ensure($ensurance->isEnsured());
        if ($ensurance->hasThrowable()) {
            $this->setThrowable($ensurance->releaseThrowable());
        }

        return $this;
    }

    /**
     * @param string $message
     * @param mixed  ...$args
     *
     * @return self
     */
    final public function orThrow(string $message, ...$args): self
    {
        if (!$this->isEnsured()) {
            $this->setThrowable(new EnsuranceException(format($message, ...$args), $this->throwable));
        }

        return $this;
    }

    /**
     * @return bool
     */
    final public function hasThrowable(): bool
    {
        return $this->throwable !== null;
    }

    /**
     * @param Throwable $throwable
     *
     * @return self
     */
    final public function setThrowable(Throwable $throwable): self
    {
        if (!$this->isEnsured()) {
            $this->throwable = $throwable;
        }

        return $this;
    }

    /**
     * @return Throwable
     */
    final public function getThrowable(): Throwable
    {
        return $this->throwable;
    }
}
