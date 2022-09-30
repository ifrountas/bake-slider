<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bakemywp.com/
 * @since      1.0.0
 *
 * @package    Bake_Slider
 * @subpackage Bake_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bake_Slider
 * @subpackage Bake_Slider/admin
 * @author     Iakovos Frountas <hello@bakemywp.com>
 */
class Bake_Slider_Admin {

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
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bake_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bake_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bake-slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bake_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bake_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bake-slider-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register the admin menu page of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function add_menu() {

		add_menu_page(
			'Bake Slider Options',
			'BakeSlider',
			'manage_options',
			'bake_slider_admin',
			array( $this, 'bake_slider_settings_page' ),
			'dashicons-images-alt2'
		);


		add_submenu_page( 
			'bake_slider_admin', 
			'Manage Slides',
			'Manage Slides',
			'manage_options',
			'edit.php?post_type=bake-slider',
			null,
			null
		);

		add_submenu_page( 
			'bake_slider_admin', 
			'Add New Slide',
			'Add New Slide',
			'manage_options',
			'post-new.php?post_type=bake-slider',
			null,
			null
		);


	}

	/**
	 * Register the settings page of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function bake_slider_settings_page() {

		if ( ! current_user_can( 'manage_options') ) {
			return;
		}

		if( isset( $_GET['settings-updated'] ) )  {
			add_settings_error('bake_slider_options', 'bake_slider_message', 'Settings Saved', 'success');
		}

		settings_errors('bake_slider_options');
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/bake-slider-settings-page.php';
	}

}
