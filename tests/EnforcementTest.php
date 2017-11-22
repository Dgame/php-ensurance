<?php

use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\enforce;

class FooException extends Exception
{
}

class EnforcementTest extends TestCase
{
    public function testAssertionWithoutMessage()
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('Assertion failed');

        enforce(0);
    }

    public function testAssertionWithMessage()
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('That should never happen');

        enforce(0, 'That should never happen');
    }

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