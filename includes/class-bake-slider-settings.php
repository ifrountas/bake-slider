<?php

/**
 * The file that defines the settings of the plugin
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
class Bake_Slider_Settings {

    public static $options;

    public function __construct() {
        self::$options = get_option( 'bake_slider_options' );
    }

    public function admin_init() {

        register_setting( 'bake_slider_group', 'bake_slider_options', array( $this, 'bake_slider_validate' ) );
        
        add_settings_section(
            'bake_slider_main_section',
            __('How does it work?', 'bake-slider'),
            null,
            'bake_slider_page1'
        );

        add_settings_section(
            'bake_slider_second_section',
            __('Other Options', 'bake-slider'),
            null,
            'bake_slider_page2'
        );

        add_settings_field(
            'bake_slider_shortcode',
            __('Shortcode', 'bake-slider'),
            array( $this, 'bake_slider_shortcode_callback' ),
            'bake_slider_page1',
            'bake_slider_main_section'
        );

        add_settings_field(
            'bake_slider_title',
            __('Slider Title', 'bake-slider'),
            array( $this, 'bake_slider_title_callback' ),
            'bake_slider_page2',
            'bake_slider_second_section',
            array(
                'label_for' => 'bake_slider_title'
            )
        );

        add_settings_field(
            'bake_slider_bullets',
            __('Display Bullets', 'bake-slider'),
            array( $this, 'bake_slider_bullets_callback' ),
            'bake_slider_page2',
            'bake_slider_second_section',
            array(
                'label_for' => 'bake_slider_bullets'
            )
        );

        add_settings_field(
            'bake_slider_style',
            __('Slider Style', 'bake-slider'),
            array( $this, 'bake_slider_style_callback' ),
            'bake_slider_page2',
            'bake_slider_second_section',
            array(
                'items' => array(
                    'default' => __('Default Theme', 'bake-slider'),
                    'light' => __('Light Theme', 'bake-slider'),
                    'dark' => __('Dark Theme', 'bake-slider')
                ),
                'label_for' => 'bake_slider_style'
            )
        );


        add_settings_field(
            'bake_slider_height',
            __('Height of the Slider', 'bake-slider'),
            array( $this, 'bake_slider_height_callback' ),
            'bake_slider_page2',
            'bake_slider_second_section',
            array(
                'items' => array(
                    'twenty-five' => __('25vh', 'bake-slider'),
                    'fifty' => __('50vh', 'bake-slider'),
                    'hundred' => __('100vh', 'bake-slider'),
                    'six-hundrend-fourty' => __('640px', 'bake-slider'),
                    
                ),
                'label_for' => 'bake_slider_height'
            )
        );


    }

    public function bake_slider_shortcode_callback() {
        ?>
            <span>Use the shortcode [bake_slider] to display the slider in any page/post/widget</span>
        <?php
    }

    public function bake_slider_title_callback( $args ) {
        $title = self::$options['bake_slider_title'];
        ?>
            <input 
                type="text"
                name="bake_slider_options[bake_slider_title]"
                id="bake_slider_title"
                value="<?php echo isset( $title ) ? esc_attr( $title ) : ""; ?>"
            >
        <?php
    }

    public function bake_slider_bullets_callback( $args ) {
        $bullets = self::$options['bake_slider_bullets'];
        ?>
            <input 
                type="checkbox"
                name="bake_slider_options[bake_slider_bullets]"
                id="bake_slider_bullets"
                value="1"
                <?php 
                    if ( isset( $bullets ) ) {
                        checked( '1', $bullets, true ); 
                    }
                ?>
            >
            <label for="bake_slider_bullets"><?php _e('Whether to display bullets or not', 'bake-slider'); ?></label>
        <?php
    }

    public function bake_slider_style_callback( $args ) {
        $style = self::$options['bake_slider_style'];
        ?>
            <select
                id="bake_slider_style"
                name="bake_slider_options[bake_slider_style]">
                <?php foreach ( $args['items'] as $key => $value ) : ?>
                    <option value="<?php echo $key; ?>" <?php isset( $style ) ? selected( $key, $style, true ) : ''; ?>><?php echo esc_html( $value ); ?></option>
                <?php endforeach; ?>
            </select>
        <?php
    }


    public function bake_slider_height_callback( $args ) {
        $style = self::$options['bake_slider_height'];
        ?>
            <select
                id="bake_slider_height"
                name="bake_slider_options[bake_slider_height]">
                <?php foreach ( $args['items'] as $key => $value ) : ?>
                    <option value="<?php echo $key; ?>" <?php isset( $style ) ? selected( $key, $style, true ) : ''; ?>><?php echo esc_html( $value ); ?></option>
                <?php endforeach; ?>
            </select>
        <?php
    }

    public function bake_slider_validate( $input ) {
        
        $new_input = array();
        foreach( $input as $key => $value ) {
            switch ($key) {
                case 'bake_slider_title':
                    $new_input[$key] = sanitize_text_field( $value );
                break;
                case 'bake_slider_bullets':
                    $new_input[$key] = absint( $value );
                break;
                case 'bake_slider_style':
                    $new_input[$key] = sanitize_text_field( $value );
                break;
                default:
                    $new_input[$key] = sanitize_text_field( $value );
                break;
            }
            
        }
        return $new_input;

    }


}