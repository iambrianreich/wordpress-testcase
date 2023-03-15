<?php

/**
 * This file contains R\WordPress\TestCase\PHPUnit\HasActivationHookRegisteredConstraint.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Asserts that a plugin represented by a specific plugin file has a specific
 * callable registered as an activation hook handler.
 */
class HasActivationHookRegisteredConstraint extends Constraint
{
    #region Constants

    /**
     * sprintf() template for toString()
     */
    public const TO_STRING_TEMPLATE = 'has activation hook for plugin file %s';

    #endregion Constants

    #region Properties

    /**
     * The file that acts as the entry point to the plugin.
     */
    protected string $file;

    #endregion Properties

    #region Constructor

    /**
     * Creates a ne HasActivationHookRegisteredConstraint
     *
     * @param string $file The plugin file.
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    #endregion Constructor

    #region Constraint Methods

    /**
     * Returns true if the specified callback is registered as an activation
     * handler.
     *
     * This constraint returns true if the callable specified by $other is
     * registered as an activation handler for the plugin specified in the
     * constructor.
     *
     * @param callable $other The function to check
     * @return boolean Returns true if the function is a callback for the action.
     */
    public function matches($other): bool
    {
        // If you dig a layer deep on register_activation_hook() you find it is
        // just registering an action called activate_<file> where <file> is the
        // plugin_basename() version of the plugin file. So we can reuse the
        // parent class logic for this Constraint.
        $action = 'activate_' . plugin_basename($this->file);
        return is_int(has_action($action, $other));
    }

    /**
     * Returns a string representation of this constraint.
     *
     * @return string Returns a string representation of this constriant.
     */
    public function toString(): string
    {
        return sprintf(static::TO_STRING_TEMPLATE, $this->file);
    }
}
