<?php

function wpbce_main_function_for_infobox_block(){
    // Infobox Shortcode Function
    function create_wpbcectainfobox_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_cta_image' => '',
			'wpbce_cta_title' => '',
			'wpbce_cta_desp' => '',
			'wpbce_cta_btn_text' => '',
			'wpbce_cta_btn_url' => '',
			'wpbce_cta_class' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_cta_image_meta = wp_get_attachment_image_src( $wpbce_cta_image, 'full');
        $wpbce_cta_image_src = $wpbce_cta_image_meta['0'];

        // Getting Side Image Alt Tag
        $wpbce_cta_image_alt = get_post_meta( $wpbce_cta_image, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_cta_image_alt )) {
                $wpbce_cta_image_alt = get_the_title($wpbce_cta_image);
            }

        $output = '<div class="wpbce-cta-bolck '.$wpbce_cta_class.'">
            <div class="wpbce-cta-inner-block">
                <div class="wpbce-cta-head"><span class="wpbce-cta-icon"><img src="'.$wpbce_cta_image_src.'" alt="'.$wpbce_cta_image_alt.'" /></span><h3>'.$wpbce_cta_title.'</h3></div>
                <div class="wpbce-cta-descp"><p>'.$wpbce_cta_desp.'</p></div>
                <div class="wpbce-cta-btn-block"><a href="'.$wpbce_cta_btn_url.'" target="_blank" />'.$wpbce_cta_btn_text.'</a></div>
            </div>
        </div>';
    
        return $output;
    }
    add_shortcode( 'wpbce_cta_infobox', 'create_wpbcectainfobox_shortcode' );
    // Infobox VC Map Function
    vc_map( array(
		'name' => __( 'Infobox', 'wpbce' ),
		'description' => __( 'Infobox with CTA button.', 'wpbce' ),
		'base' => 'wpbce_cta_infobox',
        'icon' => plugins_url('assets/infobox.png',__FILE__),
		'show_settings_on_create' => true,
		'category' => __( 'WP Elements Plus', 'wpbce'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'admin_label' => false,
				'heading' => __( 'Icon', 'wpbce' ),
				'param_name' => 'wpbce_cta_image',
				'description' => __( 'Add the icon.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Title', 'wpbce' ),
				'param_name' => 'wpbce_cta_title',
				'description' => __( 'Add the title.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Description', 'wpbce' ),
				'param_name' => 'wpbce_cta_desp',
				'description' => __( 'Add the description.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Button Text', 'wpbce' ),
				'param_name' => 'wpbce_cta_btn_text',
				'description' => __( 'Add button text.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Button URL', 'wpbce' ),
				'param_name' => 'wpbce_cta_btn_url',
				'description' => __( 'Add button link.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_cta_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );
}
add_action('vc_before_init', 'wpbce_main_function_for_infobox_block');