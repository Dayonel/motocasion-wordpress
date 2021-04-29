<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Retro_Blog
 */
global $retro_blog_post_toggle;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) {
            ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>
			
			<div class="row"><?php


			$post_ids = array();
			/* Start the Loop */
			while ( have_posts() ) { the_post();

				$post_ids[] = get_the_ID();

			}

			if( $post_ids ){

				$post_ids_array = array_chunk( $post_ids, 5 );

				foreach( $post_ids_array as $post_id_array ){

					$current_posts_query = new WP_Query(
                    array( 
	                        'post_type' => 'post',
	                        'post__in' => $post_id_array,
	                        'ignore_sticky_posts' => 1
	                    )
	                );

					$post_count = 1;
					while ( $current_posts_query->have_posts() ) { $current_posts_query->the_post();
						$count = $current_posts_query->found_posts;
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */

						if( $post_count == 1 ){
							$retro_blog_post_toggle = 1 ?>

						    <div class="col-half col-half-big">
						        <?php get_template_part( 'components/post/content', get_post_format() ); ?>
						    </div>

						<?php
						}else{

							$retro_blog_post_toggle = 2;
							if( $post_count == 2 ){ ?>
								<div class='col-half'>
	    						<div class='row'>
    						<?php }

    							get_template_part( 'components/post/content', get_post_format() );

						    if( $count == $post_count ){ ?>

							    </div>
							    </div>

						    <?php
							}

						}

						

						$post_count++;

					}

					wp_reset_postdata();

				}
			}

			?></div><?php

		}else{

			get_template_part( 'components/post/content', 'none' );

		} ?>

		</main>

		<div class="retro-archive-nav">
            <div class="row">
                <div class="col-full">
                    <?php
                    the_posts_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . retro_blog_the_theme_svg('arrow-left',$return = true ) . '</span><span>' . __('Older post:', 'retro-blog') . '</span>',
                        'next_text' => '<span>' . __('Newer post:', 'retro-blog') . '</span><span class="arrow" aria-hidden="true">' . retro_blog_the_theme_svg('arrow-right',$return = true ) . '</span>',
                    )); ?>
                </div>
            </div>
        </div>

	</div>
<?php
get_sidebar();
get_footer();
