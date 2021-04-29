<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Retro_Blog
 */
if (is_archive()) {
    if (retro_blog_get_option('select_archive_layout') == 'no-sidebar') {
    return;
    }
} elseif( is_single() || is_page() ){

    global $post;
    $single_sidebar = esc_html( get_post_meta( $post->ID, 'retro_blog_post_sidebar_option', true ) ); 
    if( $single_sidebar == '' || $single_sidebar == 'global-sidebar' ){

        $single_sidebar = retro_blog_get_option('select_single_layout');

    }

    if ($single_sidebar == 'no-sidebar') {
    	return;
    }
} else {
    if (retro_blog_get_option('select_homepage_layout') == 'no-sidebar') {
    	return;
    }
}
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
