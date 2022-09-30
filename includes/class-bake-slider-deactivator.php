<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://bakemywp.com/
 * @since      1.0.0
 *
 * @package    Bake_Slider
 * @subpackage Bake_Slider/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Bake_Slider
 * @subpackage Bake_Slider/includes
 * @author     Iakovos Frountas <hello@bakemywp.com>
 */
class Bake_Slider_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();
		unregister_post_type( 'bake-slider' );
	}

}
