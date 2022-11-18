<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/nirav4491
 * @since      1.0.0
 *
 * @package    Cs_Custom_Permalinks
 * @subpackage Cs_Custom_Permalinks/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cs_Custom_Permalinks
 * @subpackage Cs_Custom_Permalinks/includes
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Customise_Permalinks_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'cs-custom-permalinks',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
