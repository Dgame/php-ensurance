<?php

use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class EnsuranceTest extends TestCase
{
    public function testIsNull(): void
    {
        ensure(null)->isNull();
    }

    public function testIsNotNull(): void
    {
        ensure('')->isNotNull();
    }

    public function testIsEmpty(): void
    {
        ensure('')->isEmpty();
    }

    public function testIsNotEmpty(): void
    {
        ensure(42)->isNotEmpty();
        ensure(' ')->isNotEmpty();
    }

    public function testIsEqual(): void
    {
        ensure(42)->isEqualTo('42');
    }

    public function testIsNotEqual(): void
    {
        ensure('42')->isNotEqualTo(4.2);
    }

    public function testIsSame(): void
    {
        ensure('foo')->isIdenticalTo('foo');
        ensure(42)->isIdenticalTo(2 * 21);
    }

    public function testIsNotSame(): void
    {
        ensure('foo')->isNotIdenticalTo('bar');
        ensure('foo')->isNotIdenticalTo(42);
    }

    public function testIsResource(): void
    {
        $ch = curl_init();
        ensure($ch)->isResource();
        curl_close($ch);

        $this->expectException(EnsuranceException::class);

        ensure(null)->isResource();
    }

    public function testArray(): void
    {
        ensure('foo')->isIn(['foo', 'bar']);
        ensure('foo')->isKeyOf(['foo' => 'bar']);
    }

    public function testEnsurance(): void
    {
        $this->assertTrue(ensure('foo')->isIn(['foo', 'bar'])->isEnsured());
        $this->assertTrue(ensure('foo')->isKeyOf(['foo' => 'bar'])->isEnsured());
        $this->assertFalse(ensure('foo')->isIn(['bar'])->disregardThrowable()->isEnsured());
        $this->assertFalse(ensure('foo')->isKeyOf(['foo', 'bar'])->disregardThrowable()->isEnsured());
    }
}