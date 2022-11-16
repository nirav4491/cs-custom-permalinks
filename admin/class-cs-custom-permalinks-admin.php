<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/nirav4491
 * @since      1.0.0
 *
 * @package    Cs_Custom_Permalinks
 * @subpackage Cs_Custom_Permalinks/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cs_Custom_Permalinks
 * @subpackage Cs_Custom_Permalinks/admin
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Cs_Custom_Permalinks_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function cscp_enqueue_styles_scripts() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cs-custom-permalinks-admin.css', array(), $this->version, 'all' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cs-custom-permalinks-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function cscp_save_posts( $post_id, $post ) {
		if ( 'song' === $post->post_type ) {
			$post_new_slug = 'niravmehta/' . $post->post_name;
			update_post_meta( $post_id, 'update_post_slug', $post_new_slug );
		}
	}
}
