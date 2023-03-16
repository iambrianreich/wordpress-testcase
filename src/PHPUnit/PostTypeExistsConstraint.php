<?php

/**
 * This file contains BR\WordPress\TestCase\PHPUnit\PostTypeExistsConstraint.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Constraint for asserting that a post type exists.
 */
class PostTypeExistsConstraint extends Constraint
{
    #region Constants

    /** sprintf() template for toString() */
    public const TO_STRING_TEMPLATE = 'post type exists';

    #endregion Constants

    #region Constraint Methods

    /**
     * Returns true if the specified post type exists.
     *
     * @param string $other The post type to check for.
     * @return boolean Returns true if the post type exists.
     */
    public function matches($other): bool
    {
        return post_type_exists($other);
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string Returns a string representation of the constraint.
     */
    public function toString(): string
    {
        return self::TO_STRING_TEMPLATE;
    }

    #endregion Constraint Methods
}
