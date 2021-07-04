<?php

use function Dgame\Ensurance\ensure;
use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;

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
        if (version_compare(PHP_VERSION, '8.0.0') >= 0) {
            $this->markTestSkipped();
        }

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

    public function testIsEven(): void
    {
        $this->assertEquals('foo', ensure(42)->isEven()->then('foo'));
    }

    public function testIsOdd(): void
    {
        $this->assertEquals(23, ensure(42)->isOdd()->else(23));
    }

    public function tessEither(): void
    {
        $this->assertTrue(ensure(42)->isOdd()->either(false)->or(true));
        $this->assertFalse(ensure(23)->isOdd()->either(false)->or(true));
    }

    public function testIs(): void
    {
        $callback = function (int $i): bool {
            return $i === 42;
        };

        $this->assertTrue(ensure(42)->is($callback)->isEnsured());
        $this->assertFalse(ensure(23)->is($callback)->isEnsured());
    }

    public function testIsTypeOf(): void
    {
        $this->assertTrue(ensure(42)->isTypeOf('int')->isEnsured());
        $this->assertFalse(ensure(42)->isTypeOf('string')->isEnsured());
        $this->assertTrue(ensure('0' + 0)->isTypeOf('int')->isEnsured());
        $this->assertTrue(ensure(0.0)->isTypeOf('float')->isEnsured());
        $this->assertTrue(ensure('0')->isTypeOf('numeric')->isEnsured());
        $this->assertFalse(ensure('0')->isTypeOf('int')->isEnsured());
        $this->assertTrue(ensure('a')->isTypeOf('string')->isEnsured());
    }
}
