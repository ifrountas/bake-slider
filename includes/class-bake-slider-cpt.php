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
class Bake_Slider_Post_Type {

    public function create_post_type() {

        register_post_type(
            'bake-slider',
            array(
                'label' => __('BakeSlider', 'bake-slider'),
                'description' => __('Sliders', 'bake-slider'),
                'labels' => array(
                    'name' => __('BakeSlider', 'bake-slider'),
                    'singular' => __('Slider', 'bake-slider'),
                    'add_new' => __('Add Slider', 'bake-slider'),
                    'add_new_item' => __('Add Slider', 'bake-slider'),
                    'edit_item' => __('Edit Slider', 'bake-slider'),
                    'new_item' => __('Add Slider', 'bake-slider')
                ),
                'public' => true,
                'supports' => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => false,
                'publicly_queryable' => true,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-images-alt2',
            )
        );

    }


    public function bake_slider_cpt_columns( $columns ) {

        $columns['bake_slider_link_text'] = esc_html__( 'Link Text', 'bake-slider' );
        $columns['bake_slider_link_url'] = esc_html__( 'Link URL', 'bake-slider' );
        return $columns;

    }

    public function bake_slider_cpt_custom_columns( $column, $post_id ) {

        switch( $column ){
            case 'bake_slider_link_text':
                echo esc_html( get_post_meta( $post_id, 'bake_slider_link_text', true ) );
                break;
            case 'bake_slider_link_url':
                echo esc_url( get_post_meta( $post_id, 'bake_slider_link_url', true ) );
                break;
        }

    }

    public function bake_slider_sortable_columns( $columns ) {

        $columns['bake_slider_link_text'] = 'bake_slider_link_text';
        return $columns;

    }

    public function add_meta_boxes() {
        add_meta_box( 
            'bake_slider_meta_box', 
            __('Slider Link Options', 'bake-slider'), 
            array ( $this, 'add_inner_meta_boxes' ), 
            'bake-slider', 
            'normal', 
            'high'
        );
    }

    public function add_inner_meta_boxes( $post ) {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/bake-slider-metaboxes.php';
    }

    public function save_post( $post_id ) {

        if ( isset( $_POST['bake_slider_nonce'] ) ) {
            if ( ! wp_verify_nonce( $_POST['bake_slider_nonce'], 'bake_slider_nonce' ) ){
                return;
            }
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'bake-slider' ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        if ( ( isset( $_POST['action'] ) ) && ( $_POST['action'] === 'editpost' ) ) {

            $old_link_text = get_post_meta( $post_id, 'bake_slider_link_text', true );
            $new_link_text = $_POST['bake_slider_link_text'];
            $old_link_url = get_post_meta( $post_id, 'bake_slider_link_url', true );
            $new_link_url = $_POST['bake_slider_link_url'];

            if ( empty( $new_link_text) ) {
                update_post_meta( $post_id, 'bake_slider_link_text', 'Add some text' );
            }else{
                update_post_meta( $post_id, 'bake_slider_link_text', sanitize_text_field( $new_link_text ), $old_link_text);
            }

            if ( empty( $new_link_url) ) {
                update_post_meta( $post_id, 'bake_slider_link_url', '#');
            }else{
                update_post_meta( $post_id, 'bake_slider_link_url', esc_url_raw( $new_link_url ), $old_link_url);
            }
            
            
        }

    }
}