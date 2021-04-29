<div class="site-info">
	<div class="wrapper">
        <?php
        $bm_footer_text = retro_blog_get_option('footer_credit_text');
        if (!empty($bm_footer_text)){ ?>
            <?php echo esc_html(retro_blog_get_option('footer_credit_text')); ?>
            <span class="sep"> | </span>
        <?php } ?>
		<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'retro-blog' ), 'Retro Blog', '<a href="http://wpinterface.com/" rel="designer" class="interface-font">WPinterface</a>' ); ?>
	</div>
    <div class="bg-fill"></div>
</div><!-- .site-info -->


<a id="scroll-top">
    <?php retro_blog_the_theme_svg('chevron-up'); ?>
</a>