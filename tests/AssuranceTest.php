<?php

use function Dgame\Ensurance\assure;
use PHPUnit\Framework\TestCase;

/**
 * Class Assurance
 */
final class AssuranceTest extends TestCase
{
    public function testNegativeAssuranceWithoutMessage()
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('Assertion failed');
        assure(0);
    }

    public function testNegativeAssuranceWithMessage()
    {
        $this->expectException(AssertionError::class);
        $this->expectExceptionMessage('That went wrong');
        assure(0, 'That went wrong');
    }

    public function testPositiveAssurance()
    {
        assure(true);
    }
}