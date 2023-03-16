# iambrianreich/wordpress-testcase

This project provides a custom `TestCase` class and `Constraints` that
make unit testing PHP extensions with PHPUnit simpler.

This project is meant to work in conjuction with the WP-CLI Instructions on
setting up [PHPUnit Testing for WordPress](https://make.wordpress.org/cli/handbook/misc/plugin-unit-tests/)
it does not replace or supercede them.

## Installation

`composer require iambrianreich/wordpress-testcase`

## Usage

You can either use the `Constraint` classes defined in this project directly or
extend `BR\WordPress\TestCase\PHPUnit\TestCase`, which exposes the constraints
through `assert*()` methods that allow you to easily validate your extensions
integrations with WordPress.

```php
<?php

/**
 * Tests my plugin!
 *
 * Assumes you've correctly setup WordPress PHPUnit tests using WP-CLI so
 * when this TestCase is executed, your plugin has already run and registered
 * all of it's customizations with WordPress core.
 */
class MyPluginTest extends BR\WordPress\TestCase\PHPUnit\TestCase {

    public function testRegistersTheWidgetsPostType() {
        $this->assertPostTypeExists('widgets');
    }
}
```
