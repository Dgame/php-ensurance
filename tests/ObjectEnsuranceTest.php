<?php

use function Dgame\Ensurance\ensure;
use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;

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

    public function testNonExistingDynamicProperty(): void
    {
        $this->expectException(EnsuranceException::class);
        $std = new stdClass();
        $this->expectExceptionMessage(sprintf('"%s" does not have a property "%s"', print_r($std, true), 'foo'));

        ensure($std)->isObject()->hasProperty('foo');
    }

    public function testNonExistingStaticProperty(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage(sprintf('"%s" does not have a property "%s"', stdClass::class, 'foo'));

        ensure(stdClass::class)->isObject()->hasProperty('foo');
    }

    public function testExistingDynamicProperty(): void
    {
        $std      = new stdClass();
        $std->foo = 42;

        ensure($std)->isObject()->hasProperty('foo');
    }
}
