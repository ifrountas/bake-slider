<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://bakemywp.com/
 * @since      1.0.0
 *
 * @package    Bake_Slider
 * @subpackage Bake_Slider/includes
 */

/**
 * The Post Type plugin class.
 *
 * This is used to register the custom post type that is used from the plugin.
 *
 *
 * @since      1.0.0
 * @package    Bake_Slider
 * @subpackage Bake_Slider/includes
 * @author     Iakovos Frountas <hello@bakemywp.com>
 */
class Bake_Slider_Shortcode {

    public function __construct() {
        add_shortcode( 'bake_slider', array( $this, 'add_shortcode') );
    }

    public function add_shortcode( $atts = array(), $content = null, $tag = '' ) {
       
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );

        extract( shortcode_atts(
            array(
                'id' => '',
                'orderby' => 'date'
            ),
            $atts,
            $tag
        ));

        if ( !empty( $id ) ){
            $id = array_map( 'absint', explode( ',', $id ) );
        }

        ob_start();
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/bake-slider-public-display.php';
        return ob_get_clean();
    }

}