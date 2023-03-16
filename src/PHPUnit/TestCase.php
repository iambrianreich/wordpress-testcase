<?php

/**
 * This file contains BR\WordPress\TestCase\PHPUnit\TestCase.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * A TestCase that provides assertions to make unit testing WordPress simpler.
 */
class TestCase extends BaseTestCase
{
    /**
     * Asserts that a specific callable is registered as an action handler for
     * a given action.
     *
     * @param string $action The name of the action.
     * @param callable $handler The callable to check for registration with the action.
     * @param string $message Message to display on failure.
     * @return void
     */
    public function assertActionHandlerIsRegistered(string $action, $handler, string $message = '')
    {
        return $this->assertThat($handler, new HasActionHandlerRegisteredConstraint('init'), $message);
    }

    /**
     * Asserts that a post type exists.
     *
     * @param string $postType The post type name.
     * @param string $message The message to display on failure
     * @return void
     */
    public function assertPostTypeExists(string $postType, string $message = '')
    {
        return $this->assertThat($postType, new PostTypeExistsConstraint(), $message);
    }

    /**
     * Asserts that a shortcode exists.
     *
     * @param string $shortcode The name of the shortcode
     * @param string $message The message to display on failure.
     * @return void
     */
    public function assertShortcodeExists(string $shortcode, string $message = '')
    {
        return $this->assertThat($shortcode, new ShortcodeExistsConstraint(), $message);
    }

    /**
     * Asserts that a callable is registered to handle plugin activation.
     *
     * @param string $file The plugin file.
     * @param callable $handler The handler to check.
     * @param string $message The message to display on failure.
     * @return void
     */
    public function assertRegistrationHookIsRegistered(string $file, $handler, string $message = '')
    {
        $this->assertThat($handler, new HasActivationHookRegisteredConstraint($file), $message);
    }
}
