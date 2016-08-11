<?php

use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class NumericEnsuranceTest extends TestCase
{
    public function testIsInt()
    {
        ensure(42)->isInt();
        ensure('42')->isInt();
    }

    public function testIsFloat()
    {
        ensure(4.2)->isFloat();
        ensure('4.2')->isFloat();
    }

    public function testIsGraterThan()
    {
        ensure(42)->isNumeric()->isGreaterThan(23);
        ensure('42')->isNumeric()->isGreaterThan(23);
    }

    public function tesIsGreaterOrEqualTo()
    {
        ensure(42)->isNumeric()->isGreaterOrEqualTo(23);
        ensure(42)->isNumeric()->isGreaterOrEqualTo(42);

        ensure('42')->isNumeric()->isGreaterOrEqualTo(23);
        ensure('42')->isNumeric()->isGreaterOrEqualTo(42);
    }

    public function testIsLessThan()
    {
        ensure(23)->isNumeric()->isLessThan(42);
        ensure('23')->isNumeric()->isLessThan(42);
    }

    public function testIsLessOrEqualTo()
    {
        ensure(23)->isNumeric()->isLessOrEqualTo(42);
        ensure('23')->isNumeric()->isLessOrEqualTo(23);
    }

    public function testIsPositive()
    {
        foreach (range(0, 100) as $n) {
            ensure($n)->isPositive();
        }
    }

    public function testIsNegative()
    {
        foreach (range(-1, -100) as $n) {
            ensure($n)->isNegative();
        }
    }

    public function testIsEven()
    {
        for ($i = 0; $i < 42; $i += 2) {
            ensure($i)->isEven();
        }
    }

    public function testIsOdd()
    {
        for ($i = 1; $i < 42; $i += 2) {
            ensure($i)->isOdd();
        }
    }

    public function testIsEqualTo()
    {
        ensure(42)->isEqualTo(42);
        ensure('42')->isEqualTo(42);
    }

    public function testIsNotEqualTo()
    {
        ensure(42)->isNotEqualTo(23);
        ensure(42)->isNotEqualTo('23');
        ensure('42')->isNotEqualTo(23);
    }

    public function testIsBetween()
    {
        ensure(2)->isNumeric()->isBetween(1, 3);
        ensure(50)->isNumeric()->isBetween(1, 100);
    }

    public function testIsNotBetween()
    {
        ensure(3)->isNumeric()->isNotBetween(1, 2);
        ensure(0)->isNumeric()->isNotBetween(1, 100);
    }
}