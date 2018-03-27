<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope
         itemtype="http://schema.org/BlogPosting">

	<header>
		<h1 class="single-title post-title" itemprop="headline"><?php the_title(); ?></h1>
	</header>

	<?php if ( has_post_thumbnail() ): ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="home-thumb boxed">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	<?php endif; ?>

	<section class="post_content clearfix" itemprop="articleBody">
		<?php the_content(); ?>
	</section>

	<?php wp_link_pages( array(
		'before' => '<footer class="clearfix"><nav class="page-navigation">' . esc_html__( 'Pages:', 'lightly' ),
		'after'  => '</nav></footer>',
	) ); ?>

</article>
