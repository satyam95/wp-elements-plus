<?php

function wpbce_main_function_for_testimonial_block(){
    // Testimonial Shortcode Function
    function create_wpbcetestimonial_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_testi_image' => '',
			'wpbce_testi_name' => '',
			'wpbce_testi_designation' => '',
			'wpbce_testi_descp' => '',
			'wpbce_testi_class' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_testi_image_meta = wp_get_attachment_image_src( $wpbce_testi_image, 'full');
        $wpbce_testi_image_src = $wpbce_testi_image_meta['0'];

        // Getting Side Image Alt Tag
        $wpbce_testi_image_alt = get_post_meta( $wpbce_testi_image, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_testi_image_alt )) {
                $wpbce_testi_image_alt = get_the_title($wpbce_testi_image);
            }
        
        $output = '<div class="wpbce-testimonial-bolck '.$wpbce_testi_class.'">
            <div class="wpbce-inner-testimonial-bolck">
                <div class="wpbce-testi-media-block">
                    <div class="wpbce-testimonial-img"><img src="'.$wpbce_testi_image_src.'" alt="'.$wpbce_testi_image_alt.'" /></div>
                    <div class="wpbce-testimonial-head">
                        <h3>'.$wpbce_testi_name.'</h3>
                        <h4>'.$wpbce_testi_designation.'</h4>
                   </div>
                </div>
                <div class="wpbce-testi-content-block">
                    <p class="wpbce-testi-text">'.$wpbce_testi_descp.'</p>
                </div>
        </div></div>';
    
        return $output;
    }
    add_shortcode( 'wpbce_testimonial', 'create_wpbcetestimonial_shortcode' );

    // Testimonial VC Map Function
    vc_map( array(
		'name' => __( 'Testimonial', 'wpbce' ),
		'description' => __( 'Static testimonial block', 'wpbce' ),
		'base' => 'wpbce_testimonial',
        'icon' => plugins_url('assets/testimonial.png',__FILE__),
		'show_settings_on_create' => true,
		'category' => __( 'WP Elements Plus', 'wpbce'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'admin_label' => false,
				'heading' => __( 'Image', 'wpbce' ),
				'param_name' => 'wpbce_testi_image',
				'description' => __( 'Add the image.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Name', 'wpbce' ),
				'param_name' => 'wpbce_testi_name',
				'description' => __( 'Add the name.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Designation', 'wpbce' ),
				'param_name' => 'wpbce_testi_designation',
				'description' => __( 'Add the designation.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Description', 'wpbce' ),
				'param_name' => 'wpbce_testi_descp',
				'description' => __( 'Add the description.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_testi_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );
}
add_action('vc_before_init', 'wpbce_main_function_for_testimonial_block');