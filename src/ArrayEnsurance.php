<?php

namespace Dgame\Ensurance;

use Dgame\Type\TypeOf;
use Dgame\Type\TypeOfFactory;

/**
 * Class ArrayEnsurance
 * @package Dgame\Ensurance
 */
final class ArrayEnsurance implements EnsuranceInterface
{
    use EnsuranceTrait;

    /**
     * ArrayEnsurance constructor.
     *
     * @param EnsuranceInterface $ensurance
     */
    public function __construct(EnsuranceInterface $ensurance)
    {
        $this->transferEnsurance($ensurance);
        $this->value = $ensurance->else([]);
    }

    /**
     * @param callable $callback
     *
     * @return array
     */
    private function filterBy(callable $callback): array
    {
        return array_filter(array_map($callback, $this->value));
    }

    /**
     * @param callable $callback
     *
     * @return ArrayEnsurance
     */
    public function all(callable $callback): self
    {
        $this->ensure(count($this->filterBy($callback)) === count($this->value));

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return ArrayEnsurance
     */
    public function any(callable $callback): self
    {
        $this->ensure(!empty($this->filterBy($callback)));

        return $this;
    }

    /**
     * @param string $type
     *
     * @return ArrayEnsurance
     * @throws \Exception
     */
    public function allTypeOf(string $type): self
    {
        $type = TypeOf::import($type);

        return $this->all(static function ($value) use ($type): bool {
            return TypeOfFactory::expression($value)->isSame($type);
        });
    }

    /**
     * @param string $type
     *
     * @return ArrayEnsurance
     * @throws \Exception
     */
    public function anyTypeOf(string $type): self
    {
        $type = TypeOf::import($type);

        return $this->any(static function ($value) use ($type): bool {
            return TypeOfFactory::expression($value)->isSame($type);
        });
    }

    /**
     * @param mixed $key
     *
     * @return ArrayEnsurance
     */
    public function hasKey($key): self
    {
        $this->ensure(array_key_exists($key, $this->value))
             ->orThrow('Key "%s" is not contained in %s', $key, $this->value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return ArrayEnsurance
     */
    public function hasValue($value): self
    {
        $this->ensure(in_array($value, $this->value, true))
             ->orThrow('Value "%s" is not contained in ', $value, $this->value);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function hasLengthOf(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count === $length)->orThrow('array has not the length %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterThan(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count < $length)->orThrow('array is not shorter than %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isShorterOrEqualsTo(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count <= $length)->orThrow('array is not shorter or equal to %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerThan(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count > $length)->orThrow('array is longer than %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @param int $length
     *
     * @return ArrayEnsurance
     */
    public function isLongerOrEqualTo(int $length): self
    {
        $count = count($this->value);
        $this->ensure($count >= $length)->orThrow('array is not longer or equal to %d (%d)', $length, $count);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isAssociative(): self
    {
        $count = count($this->value);
        $this->ensure(array_keys($this->value) !== range(0, $count - 1))
             ->orThrow('array %s is not associative', $this->value);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isNotAssociative(): self
    {
        $count = count($this->value);
        $this->ensure(array_keys($this->value) === range(0, $count - 1))
             ->orThrow('array %s is associative', $this->value);

        return $this;
    }

    /**
     * @return ArrayEnsurance
     */
    public function isCallable(): self
    {
        $this->ensure(is_callable($this->value))->orThrow('Value is not a callable');

        return $this;
    }
}
