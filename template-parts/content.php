<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix default-post' ); ?> role="article">

	<?php if ( has_post_thumbnail() ): ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
		   class="home-thumb"><?php the_post_thumbnail(); ?></a>
	<?php endif; ?>

	<header>
		<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"
		                          title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="meta">
			<time
				datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
			, <?php the_author_posts_link(); ?>
			, <?php comments_popup_link(
				esc_html__( 'No Comment', 'lightly' ),
				esc_html__( '1 Comment', 'lightly' ),
				esc_html__( '% Comments', 'lightly' ),
				'',
				esc_html__( 'Comment Closed', 'lightly' )
			); ?>
		</p>
	</header>

	<section class="post_content clearfix">
		<?php the_excerpt(); ?>

		<p class="read-more"><a
				href="<?php the_permalink() ?>"><?php esc_html_e( 'Read Post', 'lightly' ); ?> &rarr;</a>
		</p>
	</section>

</article>