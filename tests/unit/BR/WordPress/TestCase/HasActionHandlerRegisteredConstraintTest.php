<?php

/**
 * This file contains Tests\BR\WordPress\TestCase\HasActionHandlerRegisteredConstraintTest.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace Tests\BR\WordPress\TestCase;

use BR\WordPress\TestCase\PHPUnit\HasActionHandlerRegisteredConstraint;
use PHPUnit\Framework\TestCase;

/**
 * Tests HasActionHandlerRegisteredConstraint.
 */
class HasActionHandlerRegisteredConstraintTest extends TestCase
{
    /**
     * Verifies that matches() returns true when an action with the configured
     * name has a matching handler registered.
     *
     * @return void
     */
    public function testConstraintReturnsTrueWhenActionHandlerIsRegistered()
    {
        // Known values.
        $actionName = 'actionJackson';
        $handler = fn () => 12;

        // Add the action using WordPress API.
        add_action($actionName, $handler);

        $this->assertTrue((new HasActionHandlerRegisteredConstraint($actionName))->matches($handler));
    }

    /**
     * Verifies that matches() returns false when an action with the confgured
     * name does not have a matching handler registered.
     *
     * @return void
     */
    public function testConstraintReturnsFalseWhenActionHandlerIsNotRegistered()
    {
        $actionName = 'actionJackson';
        $handler = fn () => 13;

        $this->assertFalse(has_action($actionName, $handler));
        $this->assertFalse((new HasActionHandlerRegisteredConstraint($actionName))->matches($handler));
    }

    /**
     * Verifies that toString() returns the expected string pattern.
     *
     * @return void
     */
    public function testToString()
    {
        $actionName = 'actionJackson';
        $handler = fn () => 13;

        $constraint = new HasActionHandlerRegisteredConstraint($actionName);
        $this->assertEquals(sprintf(HasActionHandlerRegisteredConstraint::TO_STRING_TEMPLATE, $actionName), $constraint->toString());
    }
}
