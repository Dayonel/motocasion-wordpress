<?php
/**
* Sidebar Metabox.
*
* @package Retro Blog
*/
 
add_action( 'add_meta_boxes', 'retro_blog_metabox' );

if( ! function_exists( 'retro_blog_metabox' ) ):


    function  retro_blog_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'retro-blog' ),
            'retro_blog_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'retro-blog' ),
            'retro_blog_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$retro_blog_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'retro-blog' ),
                ),
    'sidebar-right' => array(
                    'value' => 'sidebar-right',
                    'label' => esc_html__( 'Right sidebar', 'retro-blog' ),
                ),
    'sidebar-left' => array(
                    'value'     => 'sidebar-left',
                    'label'     => esc_html__( 'Left sidebar', 'retro-blog' ),
                ),
    'no-sidebar' => array(
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'Full Width', 'retro-blog' ),
                ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'retro_blog_post_metafield_callback' ) ):
    
    function retro_blog_post_metafield_callback() {
        global $post, $retro_blog_post_sidebar_fields;
        $post_type = get_post_type($post->ID);
        $ut_ed_twitter_summary = get_theme_mod('ut_ed_twitter_summary');
        $ut_ed_open_graph = get_theme_mod('ut_ed_open_graph');
        wp_nonce_field( basename( __FILE__ ), 'retro_blog_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'retro-blog'); ?>

                        </a>
                    </li>

                </ul>
            </div>

            <div class="theme-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','retro-blog'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $retro_blog_post_sidebar = esc_html( get_post_meta( $post->ID, 'retro_blog_post_sidebar_option', true ) ); 
                            if( $retro_blog_post_sidebar == '' ){ $retro_blog_post_sidebar = 'global-sidebar'; }

                            foreach ( $retro_blog_post_sidebar_fields as $retro_blog_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="retro_blog_post_sidebar_option" value="<?php echo esc_attr( $retro_blog_post_sidebar_field['value'] ); ?>" <?php if( $retro_blog_post_sidebar_field['value'] == $retro_blog_post_sidebar ){ echo "checked='checked'";} if( empty( $retro_blog_post_sidebar ) && $retro_blog_post_sidebar_field['value']=='sidebar-right' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $retro_blog_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>


                    <?php $retro_blog_ed_feature_image = esc_attr(get_post_meta($post->ID, 'retro-blog-meta-checkbox', true)); ?>
                    <div class="metabox-opt-panel">
                        <div class="metabox-opt-wrap theme-checkbox-wrap">
                            <input id="retro-blog-ed-feature-image" name="retro-blog-meta-checkbox" type="checkbox" <?php if ($retro_blog_ed_feature_image) { ?> checked="checked" <?php } ?> />
                            <label for="retro-blog-ed-feature-image"><?php esc_html_e('Disable Feature Image', 'retro-blog'); ?></label>
                        </div>
                    </div>


                </div>
                

            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'retro_blog_save_post_meta' );

if( ! function_exists( 'retro_blog_save_post_meta' ) ):

    function retro_blog_save_post_meta( $post_id ) {

        global $post, $retro_blog_post_sidebar_fields;

        if ( !isset( $_POST[ 'retro_blog_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['retro_blog_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $retro_blog_post_sidebar_fields as $retro_blog_post_sidebar_field ) {  
            
            $old = sanitize_text_field( get_post_meta( $post_id, 'retro_blog_post_sidebar_option', true ) ); 
            $new = $_POST['retro_blog_post_sidebar_option'];

            if ( $new && $new != $old ){

                update_post_meta ( $post_id, 'retro_blog_post_sidebar_option', $new );

            }elseif( '' == $new && $old ) {

                delete_post_meta( $post_id,'retro_blog_post_sidebar_option', $old );

            }
            
        }
        

        $retro_blog_ed_feature_image_old = get_post_meta($post_id, 'retro-blog-meta-checkbox', true);
        $retro_blog_ed_feature_image_news = $_POST['retro-blog-meta-checkbox'];
        
        if ($retro_blog_ed_feature_image_news && $retro_blog_ed_feature_image_news != $retro_blog_ed_feature_image_old) {
            update_post_meta($post_id, 'retro-blog-meta-checkbox', $retro_blog_ed_feature_image_news);
        } elseif ('' == $retro_blog_ed_feature_image_news && $retro_blog_ed_feature_image_old) {
            delete_post_meta($post_id, 'retro-blog-meta-checkbox', $retro_blog_ed_feature_image_old);
        }

    }

endif;   