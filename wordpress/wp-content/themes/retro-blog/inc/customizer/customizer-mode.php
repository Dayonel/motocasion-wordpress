<?php
/**
 *
 * @package retro-blog
 */

if (!function_exists('retro_blog_get_option')):

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function retro_blog_get_option($key) {
        if (empty($key)) {
            return;
        }
        $value = '';
        $default       = retro_blog_get_default_theme_options();
        $default_value = null;
        if (is_array($default) && isset($default[$key])) {
            $default_value = $default[$key];
        }
        if (null !== $default_value) {
            $value = get_theme_mod($key, $default_value);
        } else {
            $value = get_theme_mod($key);
        }
        return $value;
    }
endif;

/**
 *
 * Customizer default values
 */

if (!function_exists('retro_blog_get_default_theme_options')):

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function retro_blog_get_default_theme_options() {
        $defaults = array();

        $defaults['enable_site_description']        = 0;
        $defaults['enable_preloader_option']        = 1;
        $defaults['enable_content_description']        = 1;
        $defaults['enable_banner_slider']        = 0;
        $defaults['enable_featured_category']        = 0;
        $defaults['category_for_banner_slider'] = 1;
        $defaults['button_text_banner_slider'] = __('Continue Reading','retro-blog');
        $defaults['select_homepage_layout'] = 'no-sidebar';
        $defaults['select_archive_layout'] = 'no-sidebar';
        $defaults['select_single_layout'] = 'no-sidebar';
        $defaults['footer_credit_text']            = __('Copyright All rights reserved','retro-blog');
        $defaults['related_post_title']    = esc_html__('Related Post', 'retro-blog');
        $defaults['related_post']            = 1;
        
        $defaults = apply_filters('retro_blog_filter_default_theme_options', $defaults);
        return $defaults;
    }
endif;