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
	/**
	 * Function to return add admin setting menu.
	 *
	 * @since 1.0.0
	 */
	public function cscp_add_admin_setting_menu() {
		add_menu_page(
			__( 'Custom Pemalinks', 'cs-custom-permalinks' ), // page <title>Title</title>
			__( 'Custom Pemalinks', 'cs-custom-permalinks' ), // link text
			'manage_options', // user capabilities
			'cscp-custom-permalink', // page slug
			array( $this, 'cscp_admin_page_contents_callback' ), // this function prints the page content
			'dashicons-admin-links', // icon (from Dashicons for example)
			4 // menu position
		);
	}
	/**
	 * Function to return custom permalink admin setting page content.
	 *
	 * @since 1.0.0
	 */
	public function cscp_admin_page_contents_callback() {
		?>
		<h1> <?php esc_html_e( 'Welcome to custom permalink admin page.', 'cs-custom-permalinks' ); ?> </h1>
		<form method="POST" action="options.php">
			<?php
			settings_fields( 'cscp-custom-permalink' );
			do_settings_sections( 'cscp-custom-permalink' );
			submit_button();
			?>
		</form>
		<?php
	}
	/**
	 * Function to return admin setting on setting page.
	 */
	public function cscp_admin_init_callback() {
		add_settings_section(
			'cscp_page_setting_section',
			__( 'All post types', 'cs-custom-permalinksn' ),
			array( $this, 'cscp_setting_section_callback_function' ),
			'cscp-custom-permalink'
		);
		$cscp_args = array(
			'public'                => true,
			'exclude_from_search'   => false,
			'_builtin'              => false
		); 
	
		$cscp_output     = 'objects'; // names or objects, note names is the default
		$cscp_operator   = 'and'; // 'and' or 'or'
		$cscp_post_types = get_post_types( $cscp_args, $cscp_output, $cscp_operator );
		foreach ( $cscp_post_types as $cscp_post_type ) {
			$post_type_name = $cscp_post_type->labels->singular_name;
			$post_type_slug = $cscp_post_type->rewrite['slug'];
			add_settings_field(
				'cscp_setting_field_'. $post_type_slug,
				__( $post_type_slug, 'cs-custom-permalinksn' ),
				array( $this, 'cscp_setting_markup_posts' ),
				'cscp-custom-permalink',
				'cscp_page_setting_section'
			);
			register_setting( 'cscp_page_setting_section', 'cscp_setting_field_'. $post_type_slug );
		}
		
	}
	/**
	 * Function to return html for section.
	 */
	public function cscp_setting_section_callback_function() {
		echo '<p>Registered post types</p>';
	}
	/**
	 * Function to return html for admin settings fields.
	 */
	public function cscp_setting_markup_posts() {
		$cscp_args = array(
			'public'                => true,
			'exclude_from_search'   => false,
			'_builtin'              => false
		); 
	
		$cscp_output     = 'objects'; // names or objects, note names is the default
		$cscp_operator   = 'and'; // 'and' or 'or'
		$cscp_post_types = get_post_types( $cscp_args, $cscp_output, $cscp_operator );
		foreach ( $cscp_post_types as $cscp_post_type ) {
			$post_type_name = $cscp_post_type->labels->singular_name;
			$post_type_slug = $cscp_post_type->rewrite['slug'];
			?>
			<input type="text" id="<?php echo esc_attr( $post_type_slug ); ?>" name="<?php echo esc_attr( $post_type_slug ); ?>" value="<?php echo esc_attr( $post_type_slug ); ?>">
			<?php
		}
	}
}
