<?php

/**
 * This file contains Tests\BR\WordPress\TestCase\ShortcodeExistsContraintTest.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace Tests\BR\WordPress\TestCase;

use BR\WordPress\TestCase\PHPUnit\ShortcodeExistsConstraint;
use PHPUnit\Framework\TestCase;

/**
 * Tests PostTypeExistsConstraint
 */
class ShortcodeExistsContraintTest extends TestCase
{
    /**
     * Verifies that matches() returns true when a shortcode with the given
     * name is registered.
     *
     * @return void
     */
    public function testConstraintReturnsTrueWhenShortcodeIsRegistered()
    {
        $shortcode = 'do_the_awesome';
        $handler = fn () => 'the awesome';
        add_shortcode($shortcode, $handler);
        $this->assertTrue((new ShortcodeExistsConstraint())->matches($shortcode));

        // Cleanup
        remove_shortcode($shortcode);
    }

    /**
     * Verifies that matches() returns false when a shortcode with the given
     * name is not registered.
     *
     * @return void
     */
    public function testConstraintReturnsFalseWhenShortcodeIsNotRegistered()
    {
        $shortcode = 'not_the_awesome';
        $this->assertFalse((new ShortcodeExistsConstraint())->matches($shortcode));
    }

    /**
     * Returns that toString() returns the string we expect it to.
     *
     * @return void
     */
    public function testToStringReturnsExpectedString()
    {
        $this->assertEquals(
            ShortcodeExistsConstraint::TO_STRING_TEMPLATE,
            (new ShortcodeExistsConstraint())->toString()
        );
    }
}
