<?php

/**
 * This file contains Tests\BR\WordPress\TestCase\PostTypeExistsConstraintTest.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace Tests\BR\WordPress\TestCase;

use BR\WordPress\TestCase\PHPUnit\PostTypeExistsConstraint;
use PHPUnit\Framework\TestCase;

/**
 * Tests PostTypeExistsConstraint
 */
class PostTypeExistsConstraintTest extends TestCase
{
    /**
     * Verifies that matches() returns true when the specified post type exists.
     *
     * @return void
     */
    public function testMatchesReturnsTrueWhenPostTypeExists()
    {
        $postType = 'widgets';
        register_post_type($postType);
        $this->assertTrue((new PostTypeExistsConstraint())->matches($postType));
    }
    /**
     * Verifies that matches()
     *
     * @return void
     */
    public function testMatchesReturnsFalseWhenPostTypeDoesNotExist()
    {
        $postType = 'not-widgets';
        $this->assertFalse((new PostTypeExistsConstraint())->matches($postType));
    }

    /**
     * Verifies that toString() returns the exected string.
     *
     * @return void
     */
    public function testToStringReturnsExpectedString()
    {
        $this->assertEquals(
            PostTypeExistsConstraint::TO_STRING_TEMPLATE,
            (new PostTypeExistsConstraint())->toString()
        );
    }
}
