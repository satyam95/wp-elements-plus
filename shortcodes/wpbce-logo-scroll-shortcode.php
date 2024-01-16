<?php

function wpbce_main_function_for_infinity_logo_slider_block(){

    // Infinity logo slider - Shortcode Function - Parent
    function wpbce_scrolling_logo_shortcode_parent($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_isl_class' => '',
        ), $atts));
    
        $parent_output = '<div class="wpbce-logo-slider '.$wpbce_isl_class.'">
        <div class="wpbce-logos-slide">
            '.do_shortcode($content).'
        </div>
        <script>
          jQuery(document).ready(function ($) {
            $(".wpbce-logos-slide").infiniteslide({
            speed: 50,
            direction: "left",
            clone: 1,
            });
          });
        </script>
      </div>';
        
        return $parent_output;
    }
    add_shortcode( 'wpbce_scrolling_logos', 'wpbce_scrolling_logo_shortcode_parent' );

    // Infinity logo slider - Shortcode Function - Child
    function wpbce_logo_shortcode_child($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_isl_slide_logo' => '',
			'wpbce_isl_slide_class' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_slide_logo_image = wp_get_attachment_image_src( $wpbce_isl_slide_logo, 'full');
        $wpbce_slide_logo_src = $wpbce_slide_logo_image['0'];

        // Getting Side Image Alt Tag
        $wpbce_slide_logo_image_alt = get_post_meta( $wpbce_isl_slide_logo, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_slide_logo_image_alt )) {
                $wpbce_slide_logo_image_alt = get_the_title($wpbce_isl_slide_logo);
            }
    
        $child_output = '<img class="'.$wpbce_isl_slide_class.'" src="'.$wpbce_slide_logo_src.'" alt="'.$wpbce_slide_logo_image_alt.'" />';
    
        return $child_output;
    }
    add_shortcode( 'wpbce_logo', 'wpbce_logo_shortcode_child' );

    // Infinity logo slider - VC Map Function - Parent
    vc_map( array(
		'name' => __( 'Logo Slider', 'wpbce' ),
		'description' => __( 'Infinity logo slider', 'wpbce' ),
		'base' => 'wpbce_scrolling_logos',
		'icon' => plugins_url('assets/slider.png',__FILE__),
		'show_settings_on_create' => true,
        "as_parent" => array('only' => 'wpbce_logo'),
		'category' => __( 'WP Elements Plus', 'wpbce'),
        "content_element" => true,
        "is_container" => true,
		"js_view" => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_isl_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );

    // Infinity logo slider - VC Map Function - Child
    vc_map( array(
		'name' => __( 'Logo Slide', 'wpbce' ),
		'base' => 'wpbce_logo',
		'icon' => plugins_url('assets/slide.png',__FILE__),
		'show_settings_on_create' => true,
        "as_child" => array('only' => 'wpbce_scrolling_logos'),
		'category' => __( 'WP Elements Plus', 'wpbce'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'admin_label' => true,
				'heading' => __( 'Logo', 'wpbce' ),
				'param_name' => 'wpbce_isl_slide_logo',
				'description' => __( 'Add logo image here.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_isl_slide_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Wpbce_Scrolling_Logos extends WPBakeryShortCodesContainer {
        }
      }
    
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Wpbce_Logo extends WPBakeryShortCode {
        }
      }
}
add_action('vc_before_init', 'wpbce_main_function_for_infinity_logo_slider_block');