<?php get_header(); ?>

	<div id="content">
		<div id="inner-content" class="wrap clearfix">

			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) :
				yoast_breadcrumb( '<div id="breadcrumbs" class="col940">', '</div>' );
			else :
				lightly_breadcrumb();
			endif;
			?>
			
			<div id="main" class="col620 left clearfix archive-two-column" role="main">
				<?php if ( is_category() ) { ?>
					<h4 class="widgettitle">
						<span> <?php single_cat_title(); ?></span>
					</h4>
				<?php } elseif ( is_tag() ) { ?>
					<h4 class="widgettitle">
						<span><?php esc_html_e( 'Tagged By', 'lightly' ); ?> <?php single_tag_title(); ?></span>
					</h4>
				<?php } elseif ( is_author() ) { ?>
					<h4 class="widgettitle">
						<span><?php esc_html_e( 'Posts By', 'lightly' ); ?> <?php the_author_meta( 'display_name', get_query_var( 'author' ) ); ?></span>
					</h4>
				<?php } elseif ( is_day() ) { ?>
					<h4 class="widgettitle">
						<span><?php esc_html_e( 'Daily Archives For', 'lightly' ); ?> <?php the_time( 'l, F j, Y' ); ?></span>
					</h4>
				<?php } elseif ( is_month() ) { ?>
					<h4 class="widgettitle">
						<span><?php esc_html_e( 'Monthly Archives For', 'lightly' ); ?> <?php the_time( 'F Y' ); ?></span>
					</h4>
				<?php } elseif ( is_year() ) { ?>
					<h4 class="widgettitle">
						<span><?php esc_html_e( 'Yearly Archives For', 'lightly' ); ?> <?php the_time( 'Y' ); ?></span>
					</h4>
				<?php } ?>

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
						'prev_text'          => __( 'Previous', 'lightly' ),
						'next_text'          => __( 'Next', 'lightly' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lightly' ) . ' </span>',
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