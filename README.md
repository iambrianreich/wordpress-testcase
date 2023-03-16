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

## Credits

Credit where it's due:

- [PLugin Integration Tests | WP-CLI](https://make.wordpress.org/cli/handbook/misc/plugin-unit-tests/):
  The official source material that explains how to setup your plugin for unit
  testing with PHPUnit. Without this foundation this project is useless.
- [r/ProWordPress](https://www.reddit.com/r/ProWordPress): The folks on the
  ProWordPress subreddit were incredibly helpful when I reached out and asked
  [how they're doing unit testing](https://www.reddit.com/r/ProWordPress/comments/11ovt5h/how_are_yall_unit_testing_your_wordpress_code_if/).

## License

MIT License

Copyright (c) 2023 Brian Reich

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
