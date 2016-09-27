<?php

use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class StringEnsuranceTest extends TestCase
{
    public function testIsEqualTo()
    {
        ensure('foo')->isString()->isEqualTo('foo');
    }

    public function testIsNotEqualTo()
    {
        ensure('foo')->isString()->isNotEqualTo('bar');
    }

    public function testMatch()
    {
        ensure('test@foo')->isString()->match('#^[a-z]+@\w{3}$#i');
    }

    public function testHasLengthOf()
    {
        ensure('foo')->isString()->hasLengthOf(3);
    }

    public function testIsShorterThan()
    {
        ensure('foo')->isString()->isShorterThan(4);
    }

    public function testIsShorterOrEqualTo()
    {
        ensure('foo')->isString()->isShorterOrEqualTo(3);
    }

    public function testIsLongerThan()
    {
        ensure('foo')->isString()->isLongerThan(2);
    }

    public function testIsLongerorEqualTo()
    {
        ensure('foo')->isString()->isLongerOrEqualTo(2);
        ensure('foo')->isString()->isLongerOrEqualTo(3);
    }

    public function testBeginsWith()
    {
        ensure('FooBar')->isString()->beginsWith('Fo');

        $this->expectException(EnsuranceException::class);

        ensure('Foo')->isString()->beginsWith('fo');
    }

    public function testEndsWith()
    {
        ensure('FooBar')->isString()->endsWith('ar');

        $this->expectException(EnsuranceException::class);

        ensure('Bar')->isString()->endsWith('R');
    }

    public function testIsCallable()
    {
        ensure('trim')->isString()->isCallable();

        $this->expectException(EnsuranceException::class);

        ensure('foo')->isString()->isCallable();
    }

    public function testIsClass()
    {
        ensure(static::class)->isString()->isClass();

        $this->expectException(EnsuranceException::class);

        ensure(uniqid())->isString()->isClass();
    }
}