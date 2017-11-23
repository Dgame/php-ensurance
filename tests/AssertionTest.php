<?php

use PHPUnit\Framework\TestCase;
use function Dgame\Ensurance\assertion;
use function Dgame\Ensurance\assure;

/**
 * Class AssertionTest
 */
final class AssertionTest extends TestCase
{
    public function testNegativeAssuranceWithoutMessage()
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('Assertion failed');
        assertion(0);
    }

    public function testNegativeAssuranceWithMessage()
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('That went wrong');
        assertion(0, 'That went wrong');
    }

    public function testPositiveAssurance()
    {
        assertion(true);
    }

    public function testDeprecatedAssurance()
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('Assertion failed');
        assure(0);
    }
}