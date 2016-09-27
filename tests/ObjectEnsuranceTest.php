<?php

use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\ensure;

class EA
{
    public $test;

    public function foo()
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
    public function testIsInstanceOf()
    {
        $ea = new EA();

        ensure($ea)->isObject()->isInstanceOf(EA::class);
    }

    public function testIs()
    {
        $ea = new EA();

        ensure($ea)->isObject()->is(EA::class);
    }

    public function testIsSome()
    {
        $eb = new EB();

        ensure($eb)->isObject()->isSome(EA::class);
    }

    public function testExtends()
    {
        $eb = new EB();

        ensure($eb)->isObject()->extends(EA::class);
    }

    public function testImplements()
    {
        $ec = new EC();

        ensure($ec)->isObject()->implements(EI::class);
    }

    public function testIsParentOf()
    {
        $ea = new EA();

        ensure($ea)->isObject()->isParentOf(EB::class);
    }

    public function testUses()
    {
        $ed = new ED();

        ensure($ed)->isObject()->uses(ET::class);
    }

    public function testHasProperty()
    {
        $ea = new EA();

        ensure($ea)->isObject()->hasProperty('test');
    }

    public function testHasMethod()
    {
        $ea = new EA();

        ensure($ea)->isObject()->hasMethod('foo');
    }
}