<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/nirav4491
 * @since      1.0.0
 *
 * @package    Customise_Permalinks
 * @subpackage Customise_Permalinks/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Customise_Permalinks
 * @subpackage Customise_Permalinks/includes
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Customise_Permalinks_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules(); // Flush the rewrite rules.
		add_option( 'cstmlinks_do_plugin_activation_redirect', 1 ); // Redirect to plugin settings page on the plugin activation.
	}
}
