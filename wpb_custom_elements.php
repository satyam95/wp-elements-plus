<?php
/*
* Plugin Name: WP Elements Plus
* Plugin URI: http://example.com/plugin-name-uri/
* Description: Custom elements for Wp Bakery to extand it's functionality. 
* Version: 1.0.0
* Author: Satyam Sagar
* Author URI: http://example.com/
*/

// Exit if accessed directly
if( !defined('ABSPATH')){
    exit;
  }

// Adding Custom Styles
function ssrt_style_script_integration() {
  wp_register_style('wpbce-main-css', plugins_url('assets/css/wpbce_main.css', __FILE__), 'all');
  wp_register_script('wpbce-scroll-js', plugins_url('assets/lib/scroll/infiniteslidev2.js', __FILE__), array( 'jquery' ), true );
  wp_register_script('wpbce-main-js', plugins_url('assets/js/wpbce_main.js', __FILE__), array( 'jquery' ), true );
}
add_action('init', 'ssrt_style_script_integration');

// use the Registered Style Below
add_action('wp_enqueue_scripts', 'ssrt_enqueue_styles');
function ssrt_enqueue_styles(){
  wp_enqueue_script('jquery');
  wp_enqueue_script('wpbce-scroll-js');
  wp_enqueue_script('wpbce-main-js');
  wp_enqueue_style('wpbce-main-css');
  
}

// Team Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-team-shortcode.php');

// Logo Scroll Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-logo-scroll-shortcode.php');

// Custom List Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-custom-list-shortcode.php');

// Testimonial Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-testimonial-shortcode.php');

// Infobox Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-infobox-shortcode.php');

// USP Pointer Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-usp-pointer-shortcode.php');

// Coverage Card Shortcode
require_once(plugin_dir_path(__FILE__).'/shortcodes/wpbce-coverage-card-shortcode.php');