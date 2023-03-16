<?php

/**
 * WordPress TestCase
 *
 * WordPress TestCase is not a plugin. It is a library that provides custom
 * constraints and test cases for making unit testing WordPress a little less
 * painful.
 *
 * @author Brian Reich <brian@brianreich.dev>
 * @copyright Copyright (C) 2023 Brian Reich
 * @version $version$
 *
 * @wordpress-plugin
 * Plugin Name:         WordPress TestCase
 * Plugin URI:          https://brianreich.dev/wordpress-plugins/wordpress-glossary/
 * Description:         Not a plugin! A library that provides custom constraints for WordPress unit testing
 * Version:             $version$
 * Requires at least:   6.0
 * Requires PHP:        8.0
 * Author:              Brian Reich <brian@brianreich.dev>
 * Author URI:          https://brianreich.dev/
 * License:             Proprietary
 * License URI:         https://brianreich.dev/wordpress-plugins/wordpress-testcase/license
 * Text Domain:         wordpress-testcase
 * Update URI:          https://brianreich.dev/wordpress-plugins/wordpress-testcase/update
 */

require_once(__DIR__ . '/vendor/autoload.php');

use BR\WordPress\TestCase\Plugin;

// Initialize the plugin class. Constructor takes care of the rest.
$plugin = new Plugin(__FILE__);
