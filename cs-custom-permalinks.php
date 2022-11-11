<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/nirav4491
 * @since             1.0.0
 * @package           Cs_Custom_Permalinks
 *
 * @wordpress-plugin
 * Plugin Name:       CS Custom Permalinks
 * Plugin URI:        https://https://github.com/nirav4491
 * Description:       This plugin helps to change the custom post type permalinks.
 * Version:           1.0.0
 * Author:            Nirav Mehta
 * Author URI:        https://https://github.com/nirav4491
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cs-custom-permalinks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CS_CUSTOM_PERMALINKS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cs-custom-permalinks-activator.php
 */
function activate_cs_custom_permalinks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cs-custom-permalinks-activator.php';
	Cs_Custom_Permalinks_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cs-custom-permalinks-deactivator.php
 */
function deactivate_cs_custom_permalinks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cs-custom-permalinks-deactivator.php';
	Cs_Custom_Permalinks_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cs_custom_permalinks' );
register_deactivation_hook( __FILE__, 'deactivate_cs_custom_permalinks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cs-custom-permalinks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cs_custom_permalinks() {

	$plugin = new Cs_Custom_Permalinks();
	$plugin->run();

}
run_cs_custom_permalinks();
