<?php

use function Dgame\Ensurance\ensure;
use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;

class BooleanEnsuranceTest extends TestCase
{
    public function testIsTrue(): void
    {
        ensure((2 * 3) === (3 * 2))->isTrue();

        $this->expectException(EnsuranceException::class);

        ensure((2 * 2) === (3 * 2))->isTrue();
    }

    public function testIsFalse(): void
    {
        ensure((2 * 3) === (3 * 3))->isFalse();

        $this->expectException(EnsuranceException::class);

        ensure((2 * 3) === (3 * 2))->isFalse();
    }
}