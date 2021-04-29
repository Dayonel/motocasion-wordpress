<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Retro_Blog
 */
global $retro_blog_post_toggle;

    
    if( $retro_blog_post_toggle == 1 ){

        if( !has_post_thumbnail() ){
            $content_class = 'style-bordered-no-image';
        } ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="style-archive">

                <?php if ( '' != get_the_post_thumbnail() ) : ?>

                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>" class="background">
                            <?php the_post_thumbnail( 'retro-blog-featured-image' ); ?>
                        </a>
                    </div>

                <?php endif; ?>

                <div class="post-content">
                    <header class="entry-header">

                        <?php retro_blog_post_format_icon();

                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h2>' );

                        if ( 'post' === get_post_type() ) :

                            get_template_part( 'components/post/content', 'meta' );

                        endif; ?>

                    </header>

                    <div class="entry-content">

                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn-main"><?php esc_html_e('Continue Reading','retro-blog'); ?></a>

                    </div>

                </div>

            </div>
        </article><!-- #post-## -->

    <?php
    }else{ ?>

        <div class="col-quarters">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="style-archive">

                    <?php if ( '' != get_the_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>" class="background">
                                <?php the_post_thumbnail( 'retro-blog-featured-small-image' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">

                        <header class="entry-header">

                            <?php echo retro_blog_post_format_icon(); ?>

                            <?php the_title( '<h2 class="entry-title entry-title-small"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h2>' );

                            if ( 'post' === get_post_type() ) : ?>
                            <?php get_template_part( 'components/post/content', 'meta' ); ?>
                            <?php
                            endif; ?>

                        </header>

                        <?php if( retro_blog_get_option('select_homepage_layout') == 1 ){ ?>

                            <div class="entry-content">

                                <?php the_excerpt(); ?>

                                <a href="<?php the_permalink(); ?>" class="btn-main"><?php esc_html_e('Continue Reading','retro-blog'); ?></a>
                            </div>

                        <?php } ?>

                    </div>

                </div>
            </article><!-- #post-## -->
        </div>

    <?php
    }

?>


