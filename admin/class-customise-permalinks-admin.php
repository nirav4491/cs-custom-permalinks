<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link https://github.com/nirav4491
 * @since 1.0.0
 *
 * @package    Customise_Permalinks
 * @subpackage Customise_Permalinks/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Customise_Permalinks
 * @subpackage Customise_Permalinks/admin
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Customise_Permalinks_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name          = $plugin_name;
		$this->version              = $version;
		$this->plugin_settings_tabs = array();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function cstmlinks_admin_enqueue_scripts_callback() {
		// Custom admin style.
		wp_enqueue_style(
			$this->plugin_name,
			CSTMLINKS_PLUGIN_URL . 'admin/css/cs-custom-permalinks-admin.css',
			array(),
			filemtime( CSTMLINKS_PLUGIN_PATH . 'admin/css/cs-custom-permalinks-admin.css' ),
			'all'
		);

		// Custom admin script.
		wp_enqueue_script(
			$this->plugin_name,
			CSTMLINKS_PLUGIN_URL . 'admin/js/cs-custom-permalinks-admin.js',
			array( 'jquery' ),
			filemtime( CSTMLINKS_PLUGIN_PATH . 'admin/js/cs-custom-permalinks-admin.js' ),
			true
		);
	}
	/**
	 * Function to return add admin setting menu.
	 *
	 * @since 1.0.0
	 */
	public function cstmlinks_admin_menu_callback() {
		// Add the settings page.
		add_options_page(
			__( 'Customise Pemalinks', 'customise-permalinks' ),
			__( 'Customise Pemalinks', 'customise-permalinks' ),
			'manage_options',
			'customise-permalinks',
			array( $this, 'cstmlinks_admin_settings_callback' )
		);
	}

	/**
	 * Admin settings template.
	 *
	 * @since 1.0.0
	 */
	public function cstmlinks_admin_settings_callback() {
		$tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
		$tab = ( ! is_null( $tab ) ) ? $tab : 'settings';
		?>
		<div class="wrap">
			<div class="cstmlinks-plugin-settings-header">
				<h1><?php esc_html_e( 'Customise Permalinks', 'customise-permalinks' ); ?></h1>
				<p><?php esc_html_e( 'This plugin lets you customise your permalinks structure.', 'customise-permalinks' ); ?></p>
			</div>
			<div class="hawthorne-plugin-settings-content">
				<div class="hawthorne-plugin-settings-tabs"><?php $this->cstmlinks_generate_plugin_settings_tabs(); ?></div>
				<div class="hawthorne-plugin-settings-content">
					<form action="" method="POST" id="<?php echo esc_attr( $tab ); ?>-settings-form" enctype="multipart/form-data"><?php do_settings_sections( $tab ); ?></form>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Plugin settings tabs.
	 *
	 * @version 1.0.0
	 */
	public function cstmlinks_generate_plugin_settings_tabs() {
		$tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
		$tab = ( ! is_null( $tab ) ) ? $tab : 'settings';
		echo wp_kses_post( '<h2 class="nav-tab-wrapper">' );

		// Iterate through the tabs.
		foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
			$active = ( $tab === $tab_key ) ? 'nav-tab-active' : '';
			echo wp_kses_post( '<a class="nav-tab ' . $active . '" href="?page=customise-permalinks&tab=' . $tab_key . '">' . $tab_caption . '</a>' );
		}

		echo wp_kses_post( '</h2>' );
	}

	/**
	 * Plugin settings tabs and settings templates.
	 *
	 * @version 1.0.0
	 */
	public function cstmlinks_admin_init_callback() {
		// General settings.
		$this->plugin_settings_tabs['settings'] = __( 'Settings', 'customise-permalinks' );
		register_setting( 'settings', 'settings' );
		add_settings_section( 'tab-general', ' ', array( &$this, 'cstmlinks_plugin_general_settings_callback' ), 'settings' );

		// FAQ settings.
		$this->plugin_settings_tabs['faq'] = __( 'FAQs', 'customise-permalinks' );
		register_setting( 'faq', 'faq' );
		add_settings_section( 'tab-faq', ' ', array( &$this, 'cstmlinks_plugin_faq_settings_callback' ), 'faq' );

		// Redirect to the plugin settings page just as it is activated.
		if ( get_option( 'cstmlinks_do_plugin_activation_redirect' ) ) {
			delete_option( 'cstmlinks_do_plugin_activation_redirect' );
			wp_safe_redirect( admin_url( '/options-general.php?page=customise-permalinks' ) );
			exit;
		}
	}

	/**
	 * Plugin general settings template.
	 *
	 * @since 1.0.0
	 */
	public function cstmlinks_plugin_general_settings_callback() {
		include_once 'templates/settings/general.php'; // Include the general settings template.
	}

	/**
	 * Plugin general settings template.
	 *
	 * @since 1.0.0
	 */
	public function cstmlinks_plugin_faq_settings_callback() {
		include_once 'templates/settings/faq.php'; // Include the API connection settings template.
	}

	/**
	 * Function to return custom permalink admin setting page content.
	 *
	 * @since 1.0.0
	 */
	public function cstmlinks_admin_page_contents_callback1() {
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
	public function cstmlinks_admin_init_callback1() {
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
