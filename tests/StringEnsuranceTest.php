<?php

use function Dgame\Ensurance\ensure;
use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;

class StringEnsuranceTest extends TestCase
{
    public function testIsEqualTo(): void
    {
        ensure('foo')->isString()->isEqualTo('foo');
    }

    public function testIsNotEqualTo(): void
    {
        ensure('foo')->isString()->isNotEqualTo('bar');
    }

    public function testMatches(): void
    {
        ensure('test@foo')->isString()->matches('#^[a-z]+@\w{3}$#i');
    }

    public function testHasLengthOf(): void
    {
        ensure('foo')->isString()->hasLengthOf(3);
    }

    public function testIsShorterThan(): void
    {
        ensure('foo')->isString()->isShorterThan(4);
    }

    public function testIsShorterOrEqualTo(): void
    {
        ensure('foo')->isString()->isShorterOrEqualTo(3);
    }

    public function testIsLongerThan(): void
    {
        ensure('foo')->isString()->isLongerThan(2);
    }

    public function testIsLongerorEqualTo(): void
    {
        ensure('foo')->isString()->isLongerOrEqualTo(2);
        ensure('foo')->isString()->isLongerOrEqualTo(3);
    }

    public function testBeginsWith(): void
    {
        ensure('FooBar')->isString()->beginsWith('Fo');

        $this->expectException(EnsuranceException::class);

        ensure('Foo')->isString()->beginsWith('fo');
    }

    public function testEndsWith(): void
    {
        ensure('FooBar')->isString()->endsWith('ar');

        $this->expectException(EnsuranceException::class);

        ensure('Bar')->isString()->endsWith('R');
    }

    public function testIsCallable(): void
    {
        ensure('trim')->isString()->isCallable();

        $this->expectException(EnsuranceException::class);

        ensure('foo')->isString()->isCallable();
    }

    public function testIsClass(): void
    {
        ensure(static::class)->isString()->isClass();

        $this->expectException(EnsuranceException::class);

        ensure(uniqid())->isString()->isClass();
    }
}