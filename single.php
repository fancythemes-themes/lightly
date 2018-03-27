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
			
			<div id="main" class="col620 left first clearfix" role="main">

				<?php if ( have_posts() ) :

					while ( have_posts() ) : the_post(); ?>

						<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'single' );
						?>

					<?php endwhile; ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/no-results', 'single' ); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>