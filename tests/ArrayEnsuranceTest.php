<?php

use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class ArrayEnsuranceTest extends TestCase
{
    public function testHasKey(): void
    {
        ensure(['a' => 'b'])->isArray()->hasKey('a');

        $this->expectException(EnsuranceException::class);

        ensure(['a' => 'b'])->isArray()->hasKey('b');
    }

    public function testHasValue(): void
    {
        ensure(['a', 'b'])->isArray()->hasValue('a');
        ensure(['a', 'b'])->isArray()->hasValue('b');

        $this->expectException(EnsuranceException::class);

        ensure(['a', 'b'])->isArray()->hasValue('c');
    }

    public function testHasLengthOf(): void
    {
        ensure([])->isArray()->hasLengthOf(0);
        ensure(range(0, 99))->isArray()->hasLengthOf(100);
    }

    public function testIsShorterThan(): void
    {
        ensure([1, 2, 3])->isArray()->isShorterThan(4);
    }

    public function testIsShorterOrEqualsTo(): void
    {
        ensure([1, 2, 3])->isArray()->isShorterOrEqualsTo(4);
        ensure([1, 2, 3])->isArray()->isShorterOrEqualsTo(3);
    }

    public function testIsLongerThan(): void
    {
        ensure([1, 2, 3])->isArray()->isLongerThan(2);
    }

    public function testIsLongerOrEqualTo(): void
    {
        ensure([1, 2, 3])->isArray()->isLongerOrEqualTo(3);
        ensure([1, 2, 3])->isArray()->isLongerOrEqualTo(2);
    }

    public function testIsAssociative(): void
    {
        ensure(['a' => 'b'])->isArray()->isAssociative();

        $this->expectException(EnsuranceException::class);

        ensure(['a', 'b'])->isArray()->isAssociative();
    }

    public function testIsNotAssociative(): void
    {
        ensure(['a', 'b'])->isArray()->isNotAssociative();

        $this->expectException(EnsuranceException::class);

        ensure(['a' => 'b'])->isArray()->isNotAssociative();
    }
}