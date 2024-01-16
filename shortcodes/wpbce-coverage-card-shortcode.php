<?php
function wpbce_main_function_for_overage_card_block(){
    // Coverage Card Shortcode Function
    function create_wpbcecovcard_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_cov_card_pub_logo' => '',
			'wpbce_cov_card_summary' => '',
			'wpbce_cov_card_pub_date' => '',
			'wpbce_cov_card_link' => '',
			'wpbce_cov_card_pub_class' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_cov_card_pub_logo_meta = wp_get_attachment_image_src( $wpbce_cov_card_pub_logo, 'full');
        $wpbce_cov_card_pub_logo_src = $wpbce_cov_card_pub_logo_meta['0'];

        // Getting Side Image Alt Tag
        $wpbce_cov_card_pub_logo_alt = get_post_meta( $wpbce_cov_card_pub_logo, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_cov_card_pub_logo_alt )) {
                $wpbce_cov_card_pub_logo_alt = get_the_title($wpbce_cov_card_pub_logo);
            }

        $output = '<div class="wpbce-cov-card-block '.$wpbce_cov_card_pub_class.'">
        <div class="wpbce-inner-cov-card-block">
        <a href="'.$wpbce_cov_card_link.'" target="_blank" >
        <div class="wpbce-cov-card-pub-date">'.$wpbce_cov_card_pub_date.'</div>
        <div class="wpbce-cov-card-media-block">
        <img src="'.$wpbce_cov_card_pub_logo_src.'" alt="'.$wpbce_cov_card_pub_logo_alt.'" />
        </div>
        <div class="wpbce-cov-card-summary"><p>'.$wpbce_cov_card_summary.'</p></div>
        </a>
        </div>
        </div>';
    
        return $output;
    }
    add_shortcode( 'wpbce_cov_card', 'create_wpbcecovcard_shortcode' );
    // Coverage Card VC Map Function
    vc_map( array(
		'name' => __( 'News Article Card', 'wpbce' ),
		'description' => __( 'Publication coverage detail card.', 'wpbce' ),
		'base' => 'wpbce_cov_card',
        'icon' => plugins_url('assets/article.png',__FILE__),
		'show_settings_on_create' => true,
		'category' => __( 'WP Elements Plus', 'wpbce'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'admin_label' => true,
				'heading' => __( 'Publication Logo', 'wpbce' ),
				'param_name' => 'wpbce_cov_card_pub_logo',
				'description' => __( 'Add the logo of publisher.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Summary ', 'wpbce' ),
				'param_name' => 'wpbce_cov_card_summary',
				'description' => __( 'Add the summary of article', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Date of Publish', 'wpbce' ),
				'param_name' => 'wpbce_cov_card_pub_date',
				'description' => __( 'Add the published date.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Link', 'wpbce' ),
				'param_name' => 'wpbce_cov_card_link',
				'description' => __( 'Add the link of coverage article.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_cov_card_pub_class',
				'description' => __( 'Add the class if required.', 'wpbce' )
			),
		)
	) );
}

add_action('vc_before_init', 'wpbce_main_function_for_overage_card_block');
