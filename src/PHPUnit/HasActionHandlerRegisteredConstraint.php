<?php

/**
 * This file contains BR\WordPress\PHPUnit\HasActionConstraint.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright MIT
 */

declare(strict_types=1);

namespace BR\WordPress\TestCase\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;

class HasActionHandlerRegisteredConstraint extends Constraint
{
    protected string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function matches($other): bool
    {
        return is_int(has_action($this->action, $other));
    }

    public function toString(): string
    {
        return 'has action';
    }
}
