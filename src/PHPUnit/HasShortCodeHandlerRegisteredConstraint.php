<?php

/**
 * This file contains BR\WordPress\TestCase\PHPUnit\HasShortCodeHandlerRegisteredConstraint.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Verifies that a callable has been registered as a shortcode handler.
 */
class HasShortCodeHandlerRegisteredConstraint extends Constraint
{
    #region Constants

    /** sprintf() template for toString() */
    public const TO_STRING_TEMPLATE = 'has shortcode handler for %s';

    #endregion Constants

    #region Properties

    /**
     * The shortcode to check.
     */
    protected string $shortcode;

    #endregion Properties

    #region Constructor

    /**
     * Createsa a new instance.
     *
     * @param string $shortcode the shortcode to check.
     *
     * @param string $shortcode
     */
    public function __construct(string $shortcode)
    {
        $this->shortcode = $shortcode;
    }

    #endregion Constructor

    #region Constraint Methods

    /**
     * Returns true if the specified callabe is registered as a handler for the
     * shortcode passed to the constructor.
     *
     * @param callable $other The callable to check as a shortlink handler
     * @return boolean Returns true if the callable is a registered handler.
     */
    public function matches($other): bool
    {
        global $shortcode_tags;

        // There is a shortcode_exists() but it doesn't check that the handler
        // is properly set. To get that we need to dig deeper...
        return isset($shortcode_tags[$this->shortcode])
            ? $shortcode_tags[$this->shortcode] === $other
            : false;
    }

    /**
     * Returns a string representation of the Constraints.
     *
     * @return string Returns a string representation of the constraint.
     */
    public function toString(): string
    {
        return sprintf(self::TO_STRING_TEMPLATE, $this->shortcode);
    }

    #endregion Constraint Methods
}
