<?php
/**
 * Retro Blog Theme Customizer
 *
 * @package Retro_Blog
 */

/**
 * Customizer theme mode and default value
 */
require get_template_directory().'/inc/customizer/customizer-mode.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function retro_blog_customize_register( $wp_customize ) {

    require get_template_directory().'/inc/customizer/customizer-functions.php';

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    require get_template_directory().'/inc/customizer/customizer-upsell.php';
    require get_template_directory().'/inc/customizer/customizer-added-options.php';

}
add_action( 'customize_register', 'retro_blog_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function retro_blog_customize_preview_js() {
	wp_enqueue_script( 'retro_blog_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'retro_blog_customize_preview_js' );

function retro_blog_upsell_js() {
    wp_enqueue_script( 'retro_blog_customize_controls', get_template_directory_uri() . '/inc/customizer/upsell.js', array( 'customize-controls' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'retro_blog_upsell_js',0 );
