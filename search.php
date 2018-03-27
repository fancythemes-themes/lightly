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
				<h4 class="widgettitle">
					<span> <?php esc_html_e( 'Search Result', 'lightly' ); ?></span>
				</h4>

				<?php if ( have_posts() ) :

					while ( have_posts() ) : the_post(); ?>

						<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content' );
						?>

					<?php endwhile; ?>

					<?php
					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page', 'lightly' ),
						'next_text'          => esc_html__( 'Next page', 'lightly' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lightly' ) . ' </span>',
					) );
					?>

				<?php else : ?>

					<article class="hentry" role="article">

						<header>
							<h2 class="post-title">
								<?php esc_html_e( 'Search return zero result.', 'lightly' ); ?>
							</h2>
						</header>

						<section class="post_content clearfix">
							<p><?php esc_html_e( 'Try search something', 'lightly' ); ?></p>
							<?php get_search_form(); ?>
							
							<p><?php esc_html_e( 'Suggestions :', 'lightly' ); ?></p>
							<ul>
								<li><?php esc_html_e( 'Make sure all words are spelled correctly.', 'lightly' ); ?>
								</li>
								<li><?php esc_html_e( 'Try different keywords.', 'lightly' ); ?>
								</li>
								<li><?php esc_html_e( 'Try more general keywords.', 'lightly' ); ?>
								</li>
							</ul>
							
							<h4><?php esc_html_e( 'Last 30 Posts', 'lightly' ); ?></h4>
							<ul>
								<?php
								$r = new WP_Query( array( 'showposts'           => 30,
								                          'post_status'         => 'publish',
								                          'ignore_sticky_posts' => 1
								) );
								while ( $r->have_posts() ) : $r->the_post();
									?>
									<li>
										<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
									</li>
									<?php
								endwhile;
								?>
							</ul>
							<h4><?php esc_html_e( 'Archives by Month:', 'lightly' ); ?></h4>
							<ul>
								<?php wp_get_archives( 'type=monthly' ); ?>
							</ul>
							
						</section>

					</article>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>