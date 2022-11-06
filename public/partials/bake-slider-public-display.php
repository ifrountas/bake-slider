<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://bakemywp.com/
 * @since      1.0.0
 *
 * @package    Bake_Slider
 * @subpackage Bake_Slider/public/partials
 */
?>
<?php
    $slider_style = Bake_Slider_Settings::$options['bake_slider_style']; 
    $slider_height = Bake_Slider_Settings::$options['bake_slider_height']; 
?>
<div class="glider-contain <?php echo ( isset( $slider_style ) ) ? $slider_style : 'style-light'; ?> <?php echo ( isset( $slider_height ) ) ? $slider_height : '640px'; ?>">
    <div class="glider">
    <?php

        $bake_args = array(
            'post_type' => 'bake-slider',
            'post_status' => 'publish',
            'post__in' => $id,
            'orderby' => $orderby
        );

        $bake_slider_query = new WP_Query( $bake_args );

        if ( $bake_slider_query->have_posts() ) :
            while ( $bake_slider_query->have_posts() ) :
                $bake_slider_query->the_post();

            $button_text = get_post_meta( get_the_ID(), 'bake_slider_link_text', true );
            $button_link = get_post_meta( get_the_ID(), 'bake_slider_link_url', true );
    ?>
        <div class="bake-slider-container">
            <?php the_post_thumbnail('full', array('class'=>'bake-slider-img') ); ?>
            <div class="bake-slider-title-container">
                <div class="bake-slider-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="bake-slider-description">
                    <p class="description"><?php the_content(); ?></p>
                    <a class="link" href="<?php echo esc_attr( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
                </div>
            </div>
        </div>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>


    </div>
    <button aria-label="Previous" class="glider-prev">«</button>
    <button aria-label="Next" class="glider-next">»</button>
    <div role="tablist" class="dots"></div>
</div>
