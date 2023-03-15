<?php

/**
 * This file contains BR\WordPress\TestCase\PHPUnit\HasActionConstraint.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Asserts that a function is registered as an action callback.
 *
 * Constraint for asserting that an action with a given name has a specific
 * function registered as a callback.
 */
class HasActionHandlerRegisteredConstraint extends Constraint
{
    #region Constants

    /** sprintf() template for toString() */
    public const TO_STRING_TEMPLATE = 'has action handler for %s';

    #endregion Constants

    #region Properties

    /** The name of the aciton. */
    protected string $action;

    #endregion Properties

    #region Constructor

    /**
     * Creates a new HasActionHandlerRegisteredConstraint.
     *
     * @param string $action The name of the action the constraint will check against.
     */
    public function __construct(string $action)
    {
        $this->action = $action;
    }

    #endregion Constructor

    #region Constraint Methods

    /**
     * Returns true if the specified callback is registered as a handler.
     *
     * This constraint returns true if the callable specified by $other is
     * registered as a handler for the action passed to the constructor.
     *
     * @param callable $other The function to check
     * @return boolean Returns true if the function is a callback for the action.
     */
    public function matches($other): bool
    {
        return is_int(has_action($this->action, $other));
    }

    /**
     * Returns a string representation of the Constraint.
     *
     * @return string Returns a string representation of the Constraint.
     */
    public function toString(): string
    {
        return sprintf(static::TO_STRING_TEMPLATE, $this->action);
    }

    #endregion Constraint Methods
}
