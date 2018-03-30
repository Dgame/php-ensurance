<?php

use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class EA
{
    public $test;

    public function foo(): void
    {
    }
}

class EB extends EA
{
}

interface EI
{
}

class EC implements EI
{
}

trait ET
{
}

class ED
{
    use ET;
}

class ObjectEnsuranceTest extends TestCase
{
    public function testIsInstanceOf(): void
    {
        $ea = new EA();

        ensure($ea)->isObject()->isInstanceOf(EA::class);
    }

    public function testIs(): void
    {
        $ea = new EA();

        ensure($ea)->isObject()->isInstanceOf(EA::class);
    }

    public function testIsSome(): void
    {
        $eb = new EB();

        ensure($eb)->isObject()->isSome(EA::class);
    }

    public function testUses(): void
    {
        $ed = new ED();

        ensure($ed)->isObject()->uses(ET::class);
    }

    public function testHasProperty(): void
    {
        $ea = new EA();

        ensure($ea)->isObject()->hasProperty('test');
    }

    public function testHasMethod(): void
    {
        $ea = new EA();

        ensure($ea)->isObject()->hasMethod('foo');
    }
}