<?php
/**
 * The WP Asciinema plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://passionsplay.com
 * @since             0.0.1
 * @package           WP_Asciinema
 *
 * @wordpress-plugin
 * Plugin Name:       WP Asciinema
 * Description:       Displays terminal sessions recorded using Asciinema.
 * Version:           0.0.1
 * Author:            Benjamin Turner
 * Author URI:        http://passionsplay.com
 * Plugin URI:        http://passionsplay.com/plugins/wp-asciinema
 * Text Domain:       wp-asciinema
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

