<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope
         itemtype="http://schema.org/BlogPosting">

	<header>
		<h1 class="single-title post-title" itemprop="headline"><?php the_title(); ?></h1>

		<p class="meta">
			<time
				datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
			, <?php the_author_posts_link(); ?>
			, <?php comments_popup_link(
				esc_html__( 'Leave a comment', 'lightly' ),
				esc_html__( '1 Comment', 'lightly' ),
				esc_html__( '% Comments', 'lightly' )
			); ?>
		</p>
	</header>

	<section class="post_content clearfix" itemprop="articleBody">
		<?php the_content(); ?>
	</section>

	<footer class="clearfix">
		<?php wp_link_pages( array(
			'before' => '<nav class="page-navigation">' . esc_html__( 'Pages:', 'lightly' ),
			'after'  => '</nav>',
		) ); ?>

		<?php
		$disable_category_meta_box = get_theme_mod( 'disable_category_meta_box' );

		if ( ! $disable_category_meta_box && 'post' == get_post_type() ): ?>
			<div id="article-footer-meta">
				<p><?php esc_html_e( 'Posted in ', 'lightly' );
					the_category( ', ' ); ?>. <?php the_tags( esc_html__( 'Tagged as ', 'lightly' ), ', ', '' ); ?></p>
			</div>
		<?php endif; ?>

		<?php
		/**
		 * Lightly Post Footer Hook
		 */
		do_action( 'lightly_post_footer_content' ); ?>

		<?php
		$disable_post_nav_box = get_theme_mod( 'disable_post_nav_box' );

		if ( ! $disable_post_nav_box && 'post' == get_post_type() ): ?>
			<nav class="post-nav clearfix">
				<?php next_post_link( '%link', '<span class="meta">' . esc_html__( 'Next Post &rarr;', "lightly" ) . '</span> <h3 class="post-title-small">%title</h3>' ); ?>
				<?php previous_post_link( '%link', '<span class="meta">' . esc_html__( '&larr; Previous Post', "lightly" ) . '</span> <h3 class="post-title-small">%title</h3>' ); ?>
			</nav>
		<?php endif; ?>

		<?php
		$disable_author_box = get_theme_mod( 'disable_author_box' );

		if ( ! $disable_author_box && 'post' == get_post_type() ): ?>
			<div id="author-box">
				<h3 class="widgettitle"><span><?php esc_html_e( 'Author', 'lightly' ); ?></span></h3>
				<img class="author-avatar alignleft"
				     src="http://www.gravatar.com/avatar/<?php echo md5( get_the_author_meta( 'user_email' ) ); ?>?s=45"
				     style="margin-top:5px;"/>
				<h4 class="post-title"><?php the_author_posts_link(); ?></h4>
				<?php if ( $user_url = get_the_author_meta( 'user_url' ) ) : ?>
					<p class="meta"><a
							href="<?php echo esc_url( $user_url ); ?>"><?php esc_html_e( 'Author Website', 'lightly' ); ?></a></p>
				<?php endif; ?>
				<p><?php the_author_meta( 'user_description' ); ?></p>
			</div>
		<?php endif; ?>

		<?php
		$disable_related_box = get_theme_mod( 'disable_related_box' );

		if ( ! $disable_related_box && 'post' == get_post_type() ): ?>
			<div id="related-box">
				<h4 class="widgettitle"><span><?php esc_html_e( 'Related Posts', 'lightly' ); ?></span></h4>
				<?php lightly_related_posts(); ?>
			</div>
		<?php endif; ?>
	</footer>

</article>
