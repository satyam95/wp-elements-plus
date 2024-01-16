<?php

function wpbce_main_function_for_usp_pointer_block(){
    // USP Pointer Shortcode Function
    function create_wpbceusppointer_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_usp_icon' => '',
			'wpbce_usp_pointer' => '',
			'wpbce_usp_descp' => '',
			'wpbce_usp_class' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_usp_icon_meta = wp_get_attachment_image_src( $wpbce_usp_icon, 'full');
        $wpbce_usp_icon_src = $wpbce_usp_icon_meta['0'];

        // Getting Side Image Alt Tag
        $wpbce_usp_icon_alt = get_post_meta( $wpbce_usp_icon, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_usp_icon_alt )) {
                $wpbce_usp_icon_alt = get_the_title($wpbce_usp_icon);
            }
        
        $output = '<div class="wpbce-usp-pointer-bolck '.$wpbce_usp_class.'">
            <div class="wpbceinner-usp-pointer-bolck">
                <div class="wpbceinner-usp-pointer-media">
                    <img src="'.$wpbce_usp_icon_src.'" alt="'.$wpbce_usp_icon_alt.'" />
                </div>
                <div class="wpbceinner-usp-pointer-content">
                    <h3>'.$wpbce_usp_pointer.'</h3>
                    <p>'.$wpbce_usp_descp.'</p>
                </div>
            </div>
        </div>';
    
        return $output;
    }
    add_shortcode( 'wpbce_usp_pointer', 'create_wpbceusppointer_shortcode' );
    // USP Pointer VC Map Function
    vc_map( array(
		'name' => __( 'USP Pointer', 'wpbce' ),
		'description' => __( 'USP pointer with icon.', 'wpbce' ),
		'base' => 'wpbce_usp_pointer',
        'icon' => plugins_url('assets/usp.png',__FILE__),
		'show_settings_on_create' => true,
		'category' => __( 'WP Elements Plus', 'wpbce'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'admin_label' => false,
				'heading' => __( 'Icon', 'wpbce' ),
				'param_name' => 'wpbce_usp_icon',
				'description' => __( 'Add the icon.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Title', 'wpbce' ),
				'param_name' => 'wpbce_usp_pointer',
				'description' => __( 'Add the title.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Description', 'wpbce' ),
				'param_name' => 'wpbce_usp_descp',
				'description' => __( 'Add the description.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_usp_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );
}
add_action('vc_before_init', 'wpbce_main_function_for_usp_pointer_block');