<?php

function wpbce_main_function_for_custom_list_block(){

    // Custom List - Shortcode Function - Parent
    function create_wpbce_custom_list_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_custom_list_class' => '',
        ), $atts));
    
        $parent_output = '<ul class="'.$wpbce_custom_list_class.' wpbce-list-container">'.do_shortcode($content).'</ul>';
    
        return $parent_output;
    }
    add_shortcode( 'wpbce_custom_list', 'create_wpbce_custom_list_shortcode' );

    // List Item - Shortcode Function - child
    function create_wpbce_list_item_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'wpbce_list_item_text' => '',
			'wpbce_list_item_class' => '',
            'wpbce_list_item_marker' => '',
        ), $atts));

        // Getting Side Image URL 
        $wpbce_list_item_marker_image = wp_get_attachment_image_src( $wpbce_list_item_marker, 'full');
        $wpbce_list_item_marker_src = $wpbce_list_item_marker_image['0'];

        // Getting Side Image Alt Tag
        $wpbce_list_item_marker_alt = get_post_meta( $wpbce_list_item_marker, '_wp_attachment_image_alt', true);
            if ( empty( $wpbce_list_item_marker_alt)) {
                $wpbce_list_item_marker_alt = get_the_title($wpbce_list_item_marker);
            }

        $child_output = '<li class="'.$wpbce_list_item_class.' wpbce-list-item">
            <span class="wpbce-list-marker">
            <img src="'.$wpbce_list_item_marker_src.'" alt="'.$wpbce_list_item_marker_alt.'" />
            </span>'.$wpbce_list_item_text.'</li>';
    
        return $child_output;
    }
    add_shortcode( 'wpbce_list_item', 'create_wpbce_list_item_shortcode' );

    // Custom List - VC Map Function - Parent
    vc_map( array(
		'name' => __( 'Custom List', 'wpbce' ),
		'description' => __( 'List with custom markers', 'wpbce' ),
		'base' => 'wpbce_custom_list',
		'show_settings_on_create' => true,
        'icon' => plugins_url('assets/list.png',__FILE__),
		'category' => __( 'WP Elements Plus', 'wpbce'),
        "as_parent" => array('only' => 'wpbce_list_item'),
        "content_element" => true,
        "is_container" => true,
		"js_view" => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_custom_list_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );

    // List Item - VC Map Function - Child
    vc_map( array(
		'name' => __( 'List Item', 'wpbce' ),
		'base' => 'wpbce_list_item',
		'show_settings_on_create' => true,
        'icon' => plugins_url('assets/list-item.png',__FILE__),
		'category' => __( 'WP Elements Plus', 'wpbce'),
        "as_child" => array('only' => 'wpbce_custom_list'),
		'params' => array(
            array(
				'type' => 'attach_image',
				'admin_label' => false,
				'heading' => __( 'Marker', 'wpbce' ),
				'param_name' => 'wpbce_list_item_marker',
				'description' => __( 'Add the list item marker.', 'wpbce' )
			),
			array(
				'type' => 'textfield',
				'admin_label' => true,
				'heading' => __( 'Item Text', 'wpbce' ),
				'param_name' => 'wpbce_list_item_text',
			),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Class', 'wpbce' ),
				'param_name' => 'wpbce_list_item_class',
				'description' => __( 'Add class if required.', 'wpbce' )
			),
		)
	) );

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Wpbce_Custom_List extends WPBakeryShortCodesContainer {
        }
      }
    
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Wpbce_List_Item extends WPBakeryShortCode {
        }
      }

}
add_action('vc_before_init', 'wpbce_main_function_for_custom_list_block');