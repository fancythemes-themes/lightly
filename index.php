<?php get_header(); ?>

	<div id="content">
		<div id="inner-content" class="wrap clearfix">

			<?php
			/**
			 * Lightly Featured Hook
			 */
			do_action( 'lightly_featured_content' ); ?>

			<div id="main" class="col620 clearfix" role="main">
				<?php
				/**
				 * Display Slider based on Settings
				 */
				if ( get_theme_mod( 'enable_featured_slider', false ) ) {
					$slider_cat   = get_theme_mod( 'featured_slider_category' );
					$slider_num   = get_theme_mod( 'featured_slider_posts_number', 8 );
					$slider_title = get_theme_mod( 'featured_slider_title', esc_html__( 'Featured Posts Title', 'lightly' ) );
					$slider_next  = get_theme_mod( 'featured_slider_hide_next' );
					?>
					<div id="featured-posts">
						<?php lightly_custom_loop_posts(
							array(
								'cat'         => $slider_cat,
								'showposts'   => $slider_num,
								'heading-tag' => 'h1',
								'thumb-size'  => 'full'
							),
							$slider_title,
							$slider_next
						); ?>
					</div>
					<?php
				} ?>

				<h4 class="widgettitle"><span><?php _e( 'Recent Posts', 'lightly' ); ?></span></h4>

				<?php if ( have_posts() ) :

					while ( have_posts() ) : the_post(); ?>
						
						<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php
					/**
					 * Previous/next page navigation.
					 */
					the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous', 'lightly' ),
						'next_text'          => esc_html__( 'Next', 'lightly' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lightly' ) . ' </span>',
					) );
					?>
					
				<?php else : ?>

					<?php get_template_part( 'template-parts/no-results', 'index' ); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>