<?php

/**
 * This file contains Tests\BR\WordPress\TestCase\HasActivationHookRegisteredConstraintTest.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace Tests\BR\WordPress\TestCase;

use BR\WordPress\TestCase\PHPUnit\HasActivationHookRegisteredConstraint;
use PHPUnit\Framework\TestCase;

class HasActivationHookRegisteredConstraintTest extends TestCase
{
    /**
     * Verifies that match() returns true when a callable is registered as an
     * activation hook for a plugin.
     *
     * @return void
     */
    public function testMatchReturnsTrueWhenCallableIsRegisteredAsActivationHandler()
    {
        $plugin = realpath(__DIR__ . '/../../../../../wordpress-testcase.php');
        $activationHook = fn () => true;

        register_activation_hook($plugin, $activationHook);

        $constraint = new HasActivationHookRegisteredConstraint($plugin);
        $this->assertTrue($constraint->matches($activationHook));
    }

    /**
     * Verifies that match() returns false when the callable is not registered
     * as an activation hook for the plugin.
     *
     * @return void
     */
    public function testMatchReturnsFalseWhenCallableIsNotRegisteredAsActivationHandler()
    {
        $plugin = realpath(__DIR__ . '/../../../../../wordpress-testcase.php');
        $activationHook = fn () => true;

        $constraint = new HasActivationHookRegisteredConstraint($plugin);
        $this->assertFalse(has_action('action_' . plugin_basename($plugin), $activationHook));
        $this->assertFalse($constraint->matches($activationHook));
    }

    /**
     * Verifies that toString() returns the expected string value.
     *
     * @return void
     */
    public function testToStringReturnsExpectedString()
    {
        $plugin = realpath(__DIR__ . '/../../../../../wordpress-testcase.php');
        $constraint = new HasActivationHookRegisteredConstraint($plugin);
        $this->assertEquals(
            sprintf($constraint::TO_STRING_TEMPLATE, $plugin),
            $constraint->toString()
        );
    }
}
