<?php

/**
 * This file contains Tests\BR\WordPress\TestCase\HasShortCodeHandlerRegisteredConstraintTest.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace Tests\BR\WordPress\TestCase;

use BR\WordPress\TestCase\PHPUnit\HasShortCodeHandlerRegisteredConstraint;
use PHPUnit\Framework\TestCase;

class HasShortCodeHandlerRegisteredConstraintTest extends TestCase
{
    /**
     * Verifies that match() returns true when a callable is registered as a
     * handler for a given shortcode.
     *
     * @return void
     */
    public function testMatchReturnsTrueWhenCallableIsRegisteredAsActivationHandler()
    {
        $shortcode = 'write_foo';
        $shortCodeHandler = fn () => 'foo';

        add_shortcode($shortcode, $shortCodeHandler);

        $constraint = new HasShortCodeHandlerRegisteredConstraint($shortcode);
        $this->assertTrue($constraint->matches($shortCodeHandler));

        // Apparently this doesn't reset between calls so let's clean up
        // after ourselves
        remove_shortcode($shortcode);
    }

    /**
     * Verifies that match() returns false when the callable is not registered
     * as a shortcode handler
     *
     * @return void
     */
    public function testMatchReturnsFalseWhenCallableIsNotRegisteredAsActivationHandler()
    {
        global $shortcode_tags;
        $shortcode = 'write_foo';
        $shortCodeHandler = fn () => 'foo';

        $constraint = new HasShortCodeHandlerRegisteredConstraint($shortcode);
        $this->assertFalse(isset($shortcode_tags[$shortcode]));
        $this->assertFalse($constraint->matches($shortCodeHandler));
    }

    /**
     * Verifies that match() returns false when the callable is not registered
     * as a shortcode handler
     *
     * @return void
     */
    public function testMatchReturnsFalseWhenShortcodeExistsButDoesNotMatchCallable()
    {
        global $shortcode_tags;
        $shortcode = 'write_foo';
        $shortCodeHandler = fn () => 'foo';
        $otherFunction = fn () => 'bar';

        add_shortcode($shortcode, $shortCodeHandler);

        $constraint = new HasShortCodeHandlerRegisteredConstraint($shortcode);
        $this->assertTrue(isset($shortcode_tags[$shortcode]));
        $this->assertFalse($constraint->matches($otherFunction));
    }

    /**
     * Verifies that toString() returns the expected string value.
     *
     * @return void
     */
    public function testToStringReturnsExpectedString()
    {
        $plugin = realpath(__DIR__ . '/../../../../../wordpress-testcase.php');
        $constraint = new HasShortCodeHandlerRegisteredConstraint($plugin);
        $this->assertEquals(
            sprintf($constraint::TO_STRING_TEMPLATE, $plugin),
            $constraint->toString()
        );
    }
}
