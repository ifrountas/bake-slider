<?php

/**
 * The main settings page of the plugin.
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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <?php 
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=bake_slider_admin&tab=main_options" class="nav-tab <?php echo $active_tab === 'main_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Main Options', 'bake-slider'); ?></a>
        <a href="?page=bake_slider_admin&tab=additional_options" class="nav-tab <?php echo $active_tab === 'additional_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Additional Options', 'bake-slider'); ?></a>
    </h2>
    <form action="options.php" method="post">
        <?php

            if ( $active_tab === 'main_options' ) {
                
                settings_fields( 'bake_slider_group' );
                do_settings_sections( 'bake_slider_page1' );

            }elseif( $active_tab === 'additional_options' ){
                
                settings_fields( 'bake_slider_group' );
                do_settings_sections( 'bake_slider_page2' );
            
            }
            
            submit_button( __('Save Settings', 'bake-slider') );
        ?>
    </form>
</div>