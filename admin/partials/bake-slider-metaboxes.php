<?php

/**
 * Provide a admin area view for the metaboxes of the sliders
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://bakemywp.com/
 * @since      1.0.0
 *
 * @package    Bake_Slider
 * @subpackage Bake_Slider/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
    $link_text = get_post_meta( $post->ID, 'bake_slider_link_text', true );
    $link_url = get_post_meta( $post->ID, 'bake_slider_link_url', true );
?>

<table class="form-table bake-slider-metabox">
    <input type="hidden" name="bake_slider_nonce" value="<?php echo wp_create_nonce( 'bake_slider_nonce' ); ?>">
    <tr>
        <th>
            <label for="bake_slider_link_text">Link Text</label>
        </th>
        <td>
            <input 
                type="text" 
                name="bake_slider_link_text" 
                id="bake_slider_link_text" 
                class="regular-text link-text"
                value="<?php echo ( isset( $link_text ) ) ? esc_html( $link_text ) : ''; ?>"
                required
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="bake_slider_link_url">Link URL</label>
        </th>
        <td>
            <input 
                type="url" 
                name="bake_slider_link_url" 
                id="bake_slider_link_url" 
                class="regular-text link-url"
                value="<?php echo ( isset( $link_url ) ) ? esc_url( $link_url ) : ''; ?>"
                required
            >
        </td>
    </tr>               
</table>
