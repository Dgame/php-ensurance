<?php

use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class EnsuranceTest extends TestCase
{
    public function testIsNull()
    {
        ensure(null)->isNull();
    }

    public function testIsNotNull()
    {
        ensure('')->isNotNull();
    }

    public function testIsEmpty()
    {
        ensure('')->isEmpty();
    }

    public function testIsNotEmpty()
    {
        ensure(42)->isNotEmpty();
        ensure(' ')->isNotEmpty();
    }

    public function testIsEqual()
    {
        ensure(42)->isEqualTo('42');
    }

    public function testIsNotEqual()
    {
        ensure('42')->isNotEqualTo(4.2);
    }

    public function testIsSame()
    {
        ensure('foo')->isSameAs('foo');
        ensure(42)->isSameAs(2 * 21);
    }

    public function testIsNotSame()
    {
        ensure('foo')->isNotSameAs('bar');
        ensure('foo')->isNotSameAs(42);
    }

    public function testIsResource()
    {
        $ch = curl_init();
        ensure($ch)->isResource();
        curl_close($ch);

        $this->expectException(EnsuranceException::class);

        ensure(null)->isResource();
    }

    public function testArray()
    {
        ensure('foo')->isValueOf(['foo', 'bar']);
        ensure('foo')->isKeyOf(['foo' => 'bar']);
    }

    public function testVerify()
    {
        $this->assertTrue(ensure('foo')->isValueOf(['foo', 'bar'])->verify());
        $this->assertFalse(ensure('foo')->isValueOf(['bar'])->verify());
        $this->assertTrue(ensure('foo')->isKeyOf(['foo' => 'bar'])->verify());
        $this->assertFalse(ensure('foo')->isKeyOf(['foo', 'bar'])->verify());
    }
}