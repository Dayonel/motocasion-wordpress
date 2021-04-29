<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Retro_Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
    } ?>

    <?php wp_head(); ?>
</head>
<?php if (is_archive()) {
    if (retro_blog_get_option('select_archive_layout') == 'sidebar-left') {
        $min_custom_class = 'sidebar-left';
    } elseif (retro_blog_get_option('select_archive_layout') == 'sidebar-right') {
        $min_custom_class = 'sidebar-right';
    } else {
        $min_custom_class = 'no-sidebar';
    }
} elseif( is_single() || is_page() ){
    global $post;
    $single_sidebar = esc_html( get_post_meta( $post->ID, 'retro_blog_post_sidebar_option', true ) ); 
    if( $single_sidebar == '' || $single_sidebar == 'global-sidebar' ){

        $single_sidebar = retro_blog_get_option('select_single_layout');

    }
    
    if ( $single_sidebar == 'sidebar-left') {
        $min_custom_class = 'sidebar-left';
    } elseif ($single_sidebar == 'sidebar-right') {
        $min_custom_class = 'sidebar-right';
    } else {
        $min_custom_class = 'no-sidebar';
    }
} else {
    if (retro_blog_get_option('select_homepage_layout') == 'sidebar-left') {
        $min_custom_class = 'sidebar-left';
    } elseif (retro_blog_get_option('select_homepage_layout') == 'sidebar-right') {
        $min_custom_class = 'sidebar-right';
    } else {
        $min_custom_class = 'no-sidebar';
    }
} ?>
<body <?php body_class($min_custom_class); ?>>

<?php if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>

<!--Loader-->
<?php if (retro_blog_get_option('enable_preloader_option') == 1) { ?>
<div id="preloader">
    <div class="loader">
        <div class="dot dot-1"></div>
        <div class="dot dot-2"></div>
        <div class="dot dot-3"></div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="flubber">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
                <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"></feColorMatrix>
            </filter>
        </defs>
    </svg>
</div>
<!-- Loader end -->
<?php } ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'retro-blog'); ?></a>
    <header id="masthead" class="site-header" role="banner">
        <?php get_template_part('components/navigation/navigation', 'top'); ?>
        <?php get_template_part('components/header/site', 'branding'); ?>
    </header>
    <div id="content" class="site-content">
        <div class="wrapper">
            <?php if (!is_page_template('home-page-template.php')) {
                if (is_front_page() && !is_home()) {
                    get_template_part('components/banner/banner', 'slider');
                    get_template_part('components/banner/featured', 'category');
                }
            } ?>