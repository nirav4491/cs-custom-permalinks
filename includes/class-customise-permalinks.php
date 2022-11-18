<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/nirav4491
 * @since      1.0.0
 *
 * @package    Customise_Permalinks
 * @subpackage Customise_Permalinks/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current version of the plugin.
 *
 * @since      1.0.0
 * @package    Customise_Permalinks
 * @subpackage Customise_Permalinks/includes
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Customise_Permalinks {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var Customise_Permalinks_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->version     = ( defined( 'CSTMLINKS_PLUGIN_VERSION' ) ) ? CSTMLINKS_PLUGIN_VERSION : '1.0.0';
		$this->plugin_name = 'customise-permalinks';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Customise_Permalinks_Loader. Orchestrates the hooks of the plugin.
	 * - Customise_Permalinks_i18n. Defines internationalization functionality.
	 * - Customise_Permalinks_Admin. Defines all hooks for the admin area.
	 * - Customise_Permalinks_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		require_once 'class-customise-permalinks-loader.php'; // The class responsible for orchestrating the actions and filters of the core plugin.
		require_once 'class-customise-permalinks-i18n.php'; // The class responsible for defining internationalization functionality of the plugin.
		require_once 'customise-permalinks-functions.php'; // This files use for common functions of the plugin.
		require_once __DIR__ . '/../admin/class-customise-permalinks-admin.php'; // The class responsible for defining all actions that occur in the admin area.
		require_once __DIR__ . '/../public/class-customise-permalinks-public.php'; // The class responsible for defining all actions that occur in the public-facing side of the site.

		$this->loader = new Customise_Permalinks_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Customise_Permalinks_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Customise_Permalinks_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Customise_Permalinks_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'cstmlinks_admin_enqueue_scripts_callback' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'cstmlinks_add_admin_setting_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'cstmlinks_admin_init_callback' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Customise_Permalinks_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'cscp_enqueue_styles_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'cscp_init_functions' );
		$this->loader->add_filter( 'post_link', $plugin_public, 'cscp_change_structure_permalink', 99, 2 );
		$this->loader->add_filter( 'post_type_link', $plugin_public, 'cscp_change_structure_permalink', 99, 2 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Customise_Permalinks_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
