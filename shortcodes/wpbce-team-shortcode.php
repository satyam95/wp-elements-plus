<?php

function wpbce_main_function_for_team_block(){

    // Team Shortcode Function
    function create_wpbceteam_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_team_image' => '',
			'wpbce_team_name' => '',
			'wpbce_team_descp' => '',
			'wpbce_team_fb' => '',
			'wpbce_team_ig' => '',
			'wpbce_team_linkedin' => '',
			'wpbce_team_twitter' => '',
			'wpbce_team_class' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_team_image = wp_get_attachment_image_src( $wpbce_team_image, 'full');
        $wpbce_team_src = $wpbce_team_image['0'];

        // Getting Side Image Alt Tag
        $wpbce_team_image_alt = get_post_meta( $wpbce_team_image, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_team_image_alt )) {
                $wpbce_team_image_alt = get_the_title($wpbce_team_image);
            }

        // Check if facebook link exists
        if( !empty($wpbce_team_fb)){
            $wpbce_fb_link = '<div class="wpbce-single-social">
                <a href="'.$wpbce_team_fb.'" target="_blank" />
                    <img src="'.plugins_url('assets/facebook.svg',__FILE__).'" alt="facebook icon" />
                </a>
            </div>';
        } else {
            $wpbce_fb_link = '';
        }

        // Check if instagram link exists
        if( !empty($wpbce_team_ig)){
            $wpbce_instagram_link = '<div class="wpbce-single-social">
                <a href="'.$wpbce_team_ig.'" target="_blank" />
                    <img src="'.plugins_url('assets/instagram.svg',__FILE__).'" alt="facebook icon" />
                </a>
            </div>';
        } else {
            $wpbce_instagram_link = '';
        }

        // Check if linkedin link exists
		if( !empty($wpbce_team_linkedin)){
            $wpbce_linkedin_link = '<div class="wpbce-single-social">
                <a href="'.$wpbce_team_linkedin.'" target="_blank" />
                    <img src="'.plugins_url('assets/linkedin.svg',__FILE__).'" alt="facebook icon" />
                </a>
            </div>';
        } else {
            $wpbce_linkedin_link = '';
        }

        // Check if twitter link exists
		if( !empty($wpbce_team_twitter)){
            $wpbce_twitter_link = '<div class="wpbce-single-social">
                <a href="'.$wpbce_team_twitter.'" target="_blank" />
                    <img src="'.plugins_url('assets/twitter.svg',__FILE__).'" alt="facebook icon" />
                </a>
            </div>';
        } else {
            $wpbce_twitter_link = '';
        }
    
        // Output Code
        $output = '<div class="'.$wpbce_team_class.'">
		    <div class="wpbce-inner-block">
            	<div class="wpbce-media-block">
            	    <img src="'.$wpbce_team_src.'" alt="'.$wpbce_team_image_alt.'" />
            	</div>
            	<div class="wpbce-content-block">
            	    <h3 class="wpbce-title">'.$wpbce_team_name.'</h3>
            	    <p class="wpbce-description">'.$wpbce_team_descp.'</p>
            	    <div class="wpbce-social-row">
            	        '.$wpbce_fb_link.' '.$wpbce_instagram_link.' '.$wpbce_twitter_link.' '.$wpbce_linkedin_link.'
            	    </div>
            	</div>
			</div>
        </div>';
    
        return $output;
    }
    add_shortcode( 'wpbce_team', 'create_wpbceteam_shortcode' );

    // Team VC Map Function
    vc_map( array(
		'name' => __( 'Team', 'wpbce' ),
		'description' => __( 'Team block', 'wpbce' ),
		'base' => 'wpbce_team',
		'icon' => plugins_url('assets/team.png',__FILE__),
		'show_settings_on_create' => true,
		'category' => __( 'WP Elements Plus', 'wpbce'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'admin_label' => false,
				'heading' => __( 'Image', 'wpbce' ),
				'param_name' => 'wpbce_team_image',
				'description' => __( 'Add team member image.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Name', 'wpbce' ),
				'param_name' => 'wpbce_team_name',
				'description' => __( 'Enter the team member name.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Description', 'wpbce' ),
				'param_name' => 'wpbce_team_descp',
				'description' => __( 'Enter the team member description.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Facebook Link', 'wpbce' ),
				'param_name' => 'wpbce_team_fb',
				'description' => __( 'Add Facebook link if required. ', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Instagram Link', 'wpbce' ),
				'param_name' => 'wpbce_team_ig',
				'description' => __( 'Add Instagram link if required. ', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'LinkedIn Link', 'wpbce' ),
				'param_name' => 'wpbce_team_linkedin',
				'description' => __( 'Add LinkedIn link if required. ', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Twitter Link', 'wpbce' ),
				'param_name' => 'wpbce_team_twitter',
				'description' => __( 'Add Twitter link if required. ', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Additional Class', 'wpbce' ),
				'param_name' => 'wpbce_team_class',
				'description' => __( 'Add class name if required.', 'wpbce' )
			),
		)
	) );
}
add_action('vc_before_init', 'wpbce_main_function_for_team_block');