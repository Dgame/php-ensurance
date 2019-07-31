<?php

use function Dgame\Ensurance\ensure;
use PHPUnit\Framework\TestCase;

/**
 * Class ExpectationTest
 */
final class ExpectationTest extends TestCase
{
    public function testIsInt(): void
    {
        $this->assertEquals(42, ensure(42)->isInt()->else(23));
        $this->assertEquals(1337, ensure('foo')->isInt()->else(1337));
    }

    public function testIsFloat(): void
    {
        $this->assertEquals(4.2, ensure(4.2)->isFloat()->else(2.3));
        $this->assertEquals(13.37, ensure('foo')->isFloat()->else(13.37));
    }

    public function testIsScalar(): void
    {
        $this->assertEquals('bar', ensure('bar')->isScalar()->else('foo'));
        $this->assertEquals(42, ensure(42)->isScalar()->else('bar'));
    }

    public function testIsNumeric(): void
    {
        $this->assertEquals(42, ensure(42)->isNumeric()->else('foo'));
        $this->assertEquals('1337', ensure('1337')->isNumeric()->else('bar'));
    }

    public function testIsString(): void
    {
        $this->assertEquals('foo', ensure('foo')->isString()->else('bar'));
        $this->assertEquals('bar', ensure(42)->isString()->else('bar'));
    }

    public function testIsBool(): void
    {
        $this->assertTrue(ensure(true)->isBool()->else(false));
        $this->assertFalse(ensure(1)->isBool()->else(false));
    }

    public function testIsArray(): void
    {
        $this->assertEquals([1, 2, 3], ensure([1, 2, 3])->isArray()->else([]));
        $this->assertEquals([2], ensure('abc')->isArray()->else([2]));
        $this->assertEquals([], ensure(null)->isArray()->else([]));
    }

    public function testIsObject(): void
    {
        $this->assertEquals($this, ensure($this)->isObject()->else(null));
        $this->assertEquals(null, ensure(null)->isObject()->else(null));
        $this->assertEquals(23, ensure(42)->isObject()->else(23));
    }

    public function testIsEmpty(): void
    {
        $this->assertEmpty(ensure(null)->isEmpty()->else('abc'));
        $this->assertNull(ensure('abc')->isEmpty()->else(null));
    }

    public function testIsNotEmpty(): void
    {
        $this->assertNotEmpty(ensure(null)->isNotEmpty()->else('abc'));
        $this->assertNotNull(ensure('abc')->isNotEmpty()->else(null));
    }

    public function testIsNull(): void
    {
        $this->assertNull(ensure(null)->isNull()->else('abc'));
        $this->assertEquals('foobar', ensure('abc')->isNull()->else('foobar'));
    }

    public function testIsNotNull(): void
    {
        $this->assertNotNull(ensure(null)->isNotNull()->else('abc'));
        $this->assertNull(ensure(null)->isNotNull()->else(null));
    }

    public function testIsTrue(): void
    {
        $this->assertTrue(ensure(false)->isTrue()->else(true));
        $this->assertTrue(ensure(true)->isTrue()->else(false));
        $this->assertFalse(ensure(false)->isTrue()->else(false));
    }

    public function testIsFalse(): void
    {
        $this->assertFalse(ensure(false)->isFalse()->else(true));
        $this->assertFalse(ensure(true)->isFalse()->else(false));
        $this->assertTrue(ensure(true)->isFalse()->else(true));
    }

    public function testIsEqual(): void
    {
        $this->assertEquals('abc', ensure('abc')->isEqualTo('abc')->else('foo'));
        $this->assertEquals('42', ensure('42')->isEqualTo('42')->else(null));
        $this->assertEquals(42, ensure('42')->isEqualTo(42)->else(null));
    }

    public function testIsNotEqual(): void
    {
        $this->assertEquals('foo', ensure('abc')->isNotEqualTo('abc')->else('foo'));
        $this->assertEquals(null, ensure('42')->isNotEqualTo('42')->else(null));
        $this->assertEquals(42, ensure('42')->isEqualTo(42)->else(null));
    }

    public function testIsIdenticalTo(): void
    {
        $this->assertEquals('abc', ensure('abc')->isIdenticalTo('abc')->else('foo'));
        $this->assertEquals('42', ensure('42')->isIdenticalTo('42')->else(null));
        $this->assertEquals(null, ensure('42')->isIdenticalTo(42)->else(null));
        $this->assertEquals(42, ensure(42)->isIdenticalTo(42)->else(null));
    }

    public function testIsNotIdenticalTo(): void
    {
        $this->assertEquals('foo', ensure('abc')->isNotIdenticalTo('abc')->else('foo'));
        $this->assertEquals(null, ensure('42')->isNotIdenticalTo('42')->else(null));
        $this->assertEquals('42', ensure('42')->isNotIdenticalTo(42)->else(null));
        $this->assertEquals(null, ensure(42)->isNotIdenticalTo(42)->else(null));
    }

    public function testIsBetween(): void
    {
        $this->assertEquals(7, ensure(7)->isBetween(0, 8)->else(null));
        $this->assertEquals(7, ensure(7)->isBetween(0, 7)->else(null));
        $this->assertEquals(0, ensure(0)->isBetween(0, 7)->else(null));
        $this->assertEquals('nope', ensure(12)->isBetween(15, 20)->else('nope'));
    }

    public function testIsIn(): void
    {
        $this->assertEquals(42, ensure(42)->isIn([1, 2, 23, 36, 42, 44, 48])->else(null));
        $this->assertEquals(42, ensure(42)->isIn([1, 2, 23, 36, 42])->else(null));
        $this->assertEquals(null, ensure(42)->isIn([1, 2, 23, 36])->else(null));
    }

    public function testIsKeyOf(): void
    {
        $this->assertEquals('foo', ensure('foo')->isKeyOf(['a' => 23, 'foo' => 42])->else(null));
        $this->assertEquals(null, ensure('foo')->isKeyOf(['a' => 23])->else(null));
    }

    public function testIsGreaterThan(): void
    {
        $this->assertEquals(42, ensure(3)->isGreaterThan(4)->else(42));
        $this->assertEquals(6, ensure(6)->isGreaterThan(4)->else(42));
    }

    public function testIsLessThan(): void
    {
        $this->assertEquals(3, ensure(3)->isLessThan(4)->else(42));
        $this->assertEquals(42, ensure(6)->isLessThan(4)->else(42));
    }

    public function testIsLessThanOrEqualTo(): void
    {
        $this->assertEquals(23, ensure(23)->isLessThanOrEqualTo(23)->else(null));
        $this->assertEquals(23, ensure(23)->isLessThanOrEqualTo(42)->else(null));
        $this->assertEquals(null, ensure(23)->isLessThanOrEqualTo(22)->else(null));
    }

    public function testIsGreaterThanOrEqualTo(): void
    {
        $this->assertEquals(42, ensure(42)->isGreaterThanOrEqualTo(42)->else(null));
        $this->assertEquals(42, ensure(42)->isGreaterThanOrEqualTo(23)->else(null));
        $this->assertEquals(null, ensure(42)->isGreaterThanOrEqualTo(256)->else(null));
    }

    public function testIsPositive(): void
    {
        $this->assertEquals(42, ensure(-1)->isPositive()->else(42));
        $this->assertEquals(0, ensure(0)->isPositive()->else(42));
    }

    public function testIsNegative(): void
    {
        $this->assertEquals(-1, ensure(-1)->isNegative()->else(42));
        $this->assertEquals(42, ensure(0)->isNegative()->else(42));
    }

    public function testIsEven(): void
    {
        $this->assertEquals(42, ensure(42)->isEven()->else(23));
        $this->assertEquals(42, ensure(23)->isEven()->else(42));
    }

    public function testIsOdd(): void
    {
        $this->assertEquals(23, ensure(42)->isOdd()->else(23));
        $this->assertEquals(23, ensure(23)->isOdd()->else(42));
    }

    public function testMatch(): void
    {
        $this->assertEquals('abc', ensure('abc')->matches('/a*b{1}c?d?/')->else('foo'));
        $this->assertEquals('foo', ensure('ac')->matches('/a*b{1}c?d?/')->else('foo'));
    }

    public function testThen(): void
    {
        $this->assertEquals('foo', ensure(42)->isEven()->then('foo'));
        $this->assertEquals(42, ensure(42)->isOdd()->then('foo'));
    }
}