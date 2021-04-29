<?php
/**
 * Theme Options Panel.
 */

$default = retro_blog_get_default_theme_options();

$wp_customize->add_setting('enable_site_description',
    array(
        'default' => $default['enable_site_description'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('enable_site_description',
    array(
        'label' => esc_html__('Enable Site Description', 'retro-blog'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

$wp_customize->add_panel('theme_option_panel',
    array(
        'title'      => esc_html__('Retro Blog Options', 'retro-blog'),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
    )
);

/**
 * Theme Options Slider Section.
 */
$wp_customize->add_section( 'theme_banner_slider_section',
    array(
        'title'      => esc_html__( 'Banner Slider Options', 'retro-blog' ),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting( 'enable_banner_slider',
    array(
        'default'           => $default['enable_banner_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'enable_banner_slider',
    array(
        'label'    => esc_html__( 'Enable Front Page Slider', 'retro-blog' ),
        'section'  => 'theme_banner_slider_section',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);

$wp_customize->add_setting( 'category_for_banner_slider',
    array(
        'default'           => $default['category_for_banner_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control( new Retro_Blog_Dropdown_Taxonomies_Control( $wp_customize, 'category_for_banner_slider',
    array(
        'label'           => esc_html__( 'Category For Front Page Slider', 'retro-blog' ),
        'section'         => 'theme_banner_slider_section',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
        'priority'    	  => 20,
    ) ) );
$wp_customize->add_setting( 'button_text_banner_slider',
    array(
        'default'           => $default['button_text_banner_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'button_text_banner_slider',
    array(
        'label'    => esc_html__( 'Button Text Front Page Slider', 'retro-blog' ),
        'section'  => 'theme_banner_slider_section',
        'type'     => 'text',
        'priority' => 30,

    )
);

/**
 * Theme Options Featured Category Section.
 */
$wp_customize->add_section( 'theme_featured_category_section',
    array(
        'title'      => esc_html__( 'Featured Category Options', 'retro-blog' ),
        'priority'   => 15,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting( 'enable_featured_category',
    array(
        'default'           => $default['enable_featured_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'enable_featured_category',
    array(
        'label'    => esc_html__( 'Enable Featured Category', 'retro-blog' ),
        'section'  => 'theme_featured_category_section',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);


for ( $i=1; $i <= 3; $i++ ) {
    $wp_customize->add_setting( 'select_featured_category_'. $i, array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new Retro_Blog_Dropdown_Taxonomies_Control( $wp_customize, 'select_featured_category_'. $i,
        array(
            'label'           => esc_html__( 'Select Featured Category', 'retro-blog' ). ' - ' . $i ,
            'section'         => 'theme_featured_category_section',
            'type'            => 'dropdown-taxonomies',
            'taxonomy'        => 'category',
            'priority'    	  => '20' . $i,
        ) ) );
    $wp_customize->add_setting( 'select_featured_category_image_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'retro_blog_sanitize_image',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'select_featured_category_image_'. $i,
            array(
                'label'           => __( 'Featured Category Background Image.', 'retro-blog' ),
                'description'	  => sprintf( __( 'Recommended Size %1$s X %2$s', 'retro-blog' ), 1280, 800 ),
                'section'         => 'theme_featured_category_section',
                'priority'        => '20' . $i,

            )
        )
    );
}

/**
 * Theme Options Global Sidebar Control.
 */
$wp_customize->add_section( 'theme_global_sidebar_control_section',
    array(
        'title'      => esc_html__( 'Layout Options', 'retro-blog' ),
        'priority'   => 20,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('select_homepage_layout',
    array(
        'default' => $default['select_homepage_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_select',
    )
);
$wp_customize->add_control('select_homepage_layout',
    array(
        'label' => esc_html__('Select Homepage/Blog Layout', 'retro-blog'),
        'section' => 'theme_global_sidebar_control_section',
        'choices' => array(
            'sidebar-left' => esc_html__('Left Sidebar', 'retro-blog'),
            'sidebar-right' => esc_html__('Right Sidebar', 'retro-blog'),
            'no-sidebar' => esc_html__('FullWidth', 'retro-blog'),
        ),
        'type' => 'select',
        'priority' => 10,
    )
);

$wp_customize->add_setting('select_archive_layout',
    array(
        'default' => $default['select_archive_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_select',
    )
);
$wp_customize->add_control('select_archive_layout',
    array(
        'label' => esc_html__('Select Archive Layout', 'retro-blog'),
        'section' => 'theme_global_sidebar_control_section',
        'choices' => array(
            'sidebar-left' => esc_html__('Left Sidebar', 'retro-blog'),
            'sidebar-right' => esc_html__('Right Sidebar', 'retro-blog'),
            'no-sidebar' => esc_html__('FullWidth', 'retro-blog'),
        ),
        'type' => 'select',
        'priority' => 10,
    )
);

$wp_customize->add_setting('select_single_layout',
    array(
        'default' => $default['select_single_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_select',
    )
);
$wp_customize->add_control('select_single_layout',
    array(
        'label' => esc_html__('Select Single Page/Post Layout', 'retro-blog'),
        'section' => 'theme_global_sidebar_control_section',
        'choices' => array(
            'sidebar-left' => esc_html__('Left Sidebar', 'retro-blog'),
            'sidebar-right' => esc_html__('Right Sidebar', 'retro-blog'),
            'no-sidebar' => esc_html__('FullWidth', 'retro-blog'),
        ),
        'type' => 'select',
        'priority' => 10,
    )
);

$wp_customize->add_setting('enable_content_description',
    array(
        'default' => $default['enable_content_description'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('enable_content_description',
    array(
        'label' => esc_html__('Enable Content Description for Small Archive Posts', 'retro-blog'),
        'section' => 'theme_global_sidebar_control_section',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

$wp_customize->add_section( 'preloader_option',
    array(
        'title'      => esc_html__( 'Preloader Options', 'retro-blog' ),
        'priority'   => 20,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting( 'enable_preloader_option',
    array(
        'default'           => $default['enable_preloader_option'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'enable_preloader_option',
    array(
        'label'    => esc_html__( 'Enable Preloader', 'retro-blog' ),
        'section'  => 'preloader_option',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);
// Footer Credit Section.
$wp_customize->add_section('footer_credit_option',
    array(
        'title' => esc_html__('Footer Credit Options', 'retro-blog'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

$wp_customize->add_setting('footer_credit_text',
    array(
        'default' => $default['footer_credit_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('footer_credit_text',
    array(
        'label' => esc_html__('Footer Credit Text', 'retro-blog'),
        'section' => 'footer_credit_option',
        'type' => 'text',
        'priority' => 100,
    )
);

/*layout management section start */
$wp_customize->add_section('theme_option_section_single',
    array(
        'title'      => esc_html__('Single Post Setting', 'retro-blog'),
        'priority'   => 100,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - related_post.
$wp_customize->add_setting('related_post',
    array(
        'default'           => $default['related_post'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'retro_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('related_post',
    array(
        'label'    => esc_html__('Enable Related Post on Single post', 'retro-blog'),
        'section'  => 'theme_option_section_single',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);
// Setting related_post_title.
$wp_customize->add_setting('related_post_title',
    array(
        'default'           => $default['related_post_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('related_post_title',
    array(
        'label'    => esc_html__('Related Post Title', 'retro-blog'),
        'section'  => 'theme_option_section_single',
        'type'     => 'text',
        'priority' => 100,
    )
);