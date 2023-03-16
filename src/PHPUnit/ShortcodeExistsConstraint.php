<?php

/**
 * This file contains BR\WordPress\TestCase\PHPUnit\ShortcodeExistsConstraint.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Constraint for checking if a shortcode has been registered.
 *
 * This constraint is a single check to see if a shortcode by a given named has
 * been registered with add_shortcode(). It doesn't care about the callable that
 * has been registered to handle the shortcode, only that it exists.
 */
class ShortcodeExistsConstraint extends Constraint
{
    #region Constants

    /**
     * sprintf() template for toString()
     */
    public const TO_STRING_TEMPLATE = 'shortcode exists';

    #endregion Constants

    #region Constraint Methods

    /**
     * Returns true if the specified shortcode has been registered.
     *
     * @param string $other The name of the shortcode to check.
     * @return boolean Returns true if the shortcode is registered.
     */
    public function matches($other): bool
    {
        return shortcode_exists($other);
    }

    /**
     * Returns the string representation of the Constraint.
     *
     * @return string Returns the string representation of the Constraint.
     */
    public function toString(): string
    {
        return self::TO_STRING_TEMPLATE;
    }

    #region Constraint Methods
}
