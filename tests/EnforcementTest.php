<?php

use function Dgame\Ensurance\enforce;
use Dgame\Ensurance\Exception\EnsuranceException;
use PHPUnit\Framework\TestCase;

class FooException extends Exception
{
}

class EnforcementTest extends TestCase
{
    public function testAssertionWithoutMessage(): void
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('Assertion failed');

        enforce(0);
    }

    public function testAssertionWithMessage(): void
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('That should never happen');

        enforce(0, 'That should never happen');
    }

    public function testValidEnforce(): void
    {
        enforce(true)->orThrow('That is not true?!');
    }

    public function testInvalidEnforce(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->expectExceptionMessage('That is false');

        enforce(false)->orThrow('That is false');
    }

    public function testInvalidEnforceWithException(): void
    {
        $this->expectException(FooException::class);
        $this->expectExceptionMessage('That is false');

        enforce(false)->orThrowWith(new FooException('That is false'));
    }
}
