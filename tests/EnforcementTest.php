<?php

use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\enforce;

class FooException extends Exception
{
}

class EnforcementTest extends TestCase
{
    public function testValidEnforce()
    {
        enforce(true)->orThrow('That is not true?!');
    }

    public function testInvalidEnforce()
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('That is false');

        enforce(false)->orThrow('That is false');
    }

    public function testInvalidEnforceWithException()
    {
        $this->expectException(FooException::class);
        $this->expectExceptionMessage('That is false');

        enforce(false)->orThrow(new FooException('That is false'));
    }
}