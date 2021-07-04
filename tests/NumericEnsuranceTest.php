<?php

use function Dgame\Ensurance\ensure;
use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;

class NumericEnsuranceTest extends TestCase
{
    public function testIsInt(): void
    {
        ensure(42)->isInt();
    }

    public function testIsNotInt(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('"42" is not an int');

        ensure('42')->isInt();
    }

    public function testIsNotIntThrow(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('"42" ist nicht die Antwort');

        ensure('42')->isInt()->orThrow('"42" ist nicht die Antwort');
    }

    public function testIsFloat(): void
    {
        ensure(4.2)->isFloat();
    }

    public function testIsNotFloat(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('"4.2" is not a float');

        ensure('4.2')->isFloat();
    }

    public function testIsGraterThan(): void
    {
        ensure(42)->isNumeric()->isGreaterThan(23);
        ensure('42')->isNumeric()->isGreaterThan(23);
    }

    public function tesIsGreaterOrEqualTo(): void
    {
        ensure(42)->isNumeric()->isGreaterThanOrEqualTo(23);
        ensure(42)->isNumeric()->isGreaterThanOrEqualTo(42);

        ensure('42')->isNumeric()->isGreaterThanOrEqualTo(23);
        ensure('42')->isNumeric()->isGreaterThanOrEqualTo(42);
    }

    public function testIsLessThan(): void
    {
        ensure(23)->isNumeric()->isLessThan(42);
        ensure('23')->isNumeric()->isLessThan(42);
    }

    public function testIsLessOrEqualTo(): void
    {
        ensure(23)->isNumeric()->isLessThanOrEqualTo(42);
        ensure('23')->isNumeric()->isLessThanOrEqualTo(23);
    }

    public function testIsPositive(): void
    {
        foreach (range(0, 100) as $n) {
            ensure($n)->isPositive();
        }
    }

    public function testIsNegative(): void
    {
        foreach (range(-1, -100) as $n) {
            ensure($n)->isNegative();
        }
    }

    public function testIsEven(): void
    {
        for ($i = 0; $i < 42; $i += 2) {
            ensure($i)->isEven();
        }
    }

    public function testIsOdd(): void
    {
        for ($i = 1; $i < 42; $i += 2) {
            ensure($i)->isOdd();
        }
    }

    public function testIsEqualTo(): void
    {
        ensure(42)->isEqualTo(42);
        ensure('42')->isEqualTo(42);
    }

    public function testIsNotEqualTo(): void
    {
        ensure(42)->isNotEqualTo(23);
        ensure(42)->isNotEqualTo('23');
        ensure('42')->isNotEqualTo(23);
    }

    public function testIsBetween(): void
    {
        ensure(2)->isNumeric()->isBetween(1, 3);
        ensure(50)->isNumeric()->isBetween(1, 100);
    }

    public function testIsNotBetween(): void
    {
        ensure(3)->isNumeric()->isNotBetween(1, 2);
        ensure(0)->isNumeric()->isNotBetween(1, 100);
    }

    public function testEven(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('not even');

        ensure(23)->isNumeric()->orThrow('nothing to see')->isEven()->orThrow('not even');
    }

    public function testInvalidNumber(): void
    {
        $catched = false;
        try {
            ensure('c')->isNumeric()->isGreaterThan(12);
        } catch (Throwable $t) {
            $catched = true;

            if (version_compare(PHP_VERSION, '8.0.0') >= 0) {
                $this->assertEquals('"c" is not numeric', $t->getMessage());
                $this->assertNull($t->getPrevious());
            } else {
                $this->assertEquals('"c" is not greater than "12"', $t->getMessage());
                $this->assertNotNull($t->getPrevious());
                $this->assertEquals('"c" is not numeric', $t->getPrevious()->getMessage());
            }
        }

        $this->assertTrue($catched);
    }
}
