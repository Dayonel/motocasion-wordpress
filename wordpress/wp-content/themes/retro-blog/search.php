<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Retro_Blog
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'retro-blog' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'search' );

			endwhile;

			the_posts_navigation(array(
                'prev_text' => '<span class="arrow" aria-hidden="true">' . retro_blog_the_theme_svg('arrow-left',$return = true ) . '</span><span>' . __('Older post:', 'retro-blog') . '</span>',
                'next_text' => '<span>' . __('Newer post:', 'retro-blog') . '</span><span class="arrow" aria-hidden="true">' . retro_blog_the_theme_svg('arrow-right',$return = true ) . '</span>',
            ));

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</section>
<?php
get_sidebar();
get_footer();
