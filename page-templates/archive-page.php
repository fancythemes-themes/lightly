<?php
/**
 * Template Name: Archives
 * A custom page to serve archive
 */

get_header(); ?>

	<div id="content">
		<div id="inner-content" class="page-default wrap clearfix">

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

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article"
						         itemscope
						         itemtype="http://schema.org/BlogPosting">

							<header>
								<h1 class="single-title post-title" itemprop="headline"><?php the_title(); ?></h1>
							</header>

							<section class="post_content clearfix" itemprop="articleBody">
								<?php the_content(); ?>

								<h4><?php esc_html_e( 'Last 30 Posts', 'lightly' ); ?></h4>
								<ul>
									<?php
									$r = new WP_Query( array(
										'showposts'           => 30,
										'post_status'         => 'publish',
										'ignore_sticky_posts' => 1
									) );
									while ( $r->have_posts() ) : $r->the_post(); ?>
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

								<h4><?php esc_html_e( 'Archives by Subject:', 'lightly' ); ?></h4>
								<ul>
									<?php wp_list_categories( 'title_li=' ); ?>
								</ul>

							</section>

							<?php wp_link_pages( array(
								'before' => '<footer class="clearfix"><nav class="page-navigation">' . esc_html__( 'Pages:', 'lightly' ),
								'after'  => '</nav></footer>',
							) ); ?>

						</article>

					<?php endwhile; ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/no-results' ); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>