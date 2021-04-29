<div class="wrapper">
    <div class="site-branding">
        <?php
        if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title" data-heading="<?php bloginfo( 'name' ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php else : ?>
            <p class="site-title" data-heading="<?php bloginfo( 'name' ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php
        endif;

        if (retro_blog_get_option('enable_site_description') == 1){
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p class="site-description interface-font"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php
            endif; ?>
        <?php } ?>
        <?php retro_blog_the_custom_logo(); ?>

    </div><!-- .site-branding -->
</div>