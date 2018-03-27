<?php

if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;


/**
 * Display Comments
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function lightly_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
	<article id="comment-<?php comment_ID(); ?>" class="clearfix">
		<header class="comment-author vcard">
			<?php echo get_avatar( $comment, $size = '45' ); ?>
			<?php printf( __( '<cite class="fn">%s</cite>', 'lightly' ), get_comment_author_link() ) ?>
			<p class="meta"><a
					href="<?php echo esc_url( get_comment_link( $comment ) ) ?>"><?php echo get_comment_date( get_option( 'date_format' ) ) . ' ' . get_comment_time( get_option( 'time_format' ) ); ?></a>
			</p>
		</header>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<div class="help">
				<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'lightly' ) ?></p>
			</div>
		<?php endif; ?>
		<section class="comment_content post_content clearfix">
			<?php comment_text() ?>
		</section>
		<?php comment_reply_link( array_merge( $args, array(
			'depth'     => $depth,
			'max_depth' => $args['max_depth']
		) ) ) ?>
	</article>
	<?php /* </li> is added by wordpress automatically */ ?>
	<?php
}


/**
 * Display Site Logo/Name
 */
function lightly_site_brand() {

	if ( has_custom_logo() ) :

		the_custom_logo();

	else : ?>
		<a class="site-title" href="<?php echo esc_url( home_url() ); ?>"
		   rel="nofollow"><?php bloginfo( 'name' ); ?></a>
		<?php $description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) : ?>
			<span class="site-description meta-"><?php echo $description; ?></span>
		<?php endif;

	endif;
}


/**
 * Display Breadcrumbs
 */
function lightly_breadcrumb() {
	if ( ! is_front_page() ) {
		echo '<div id="breadcrumbs" class="col940"> <a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'lightly' ) . '</a> ';
	}

	if ( ( is_category() || is_single() ) && ! is_attachment() ) {
		$category = get_the_category();

		if ( count( $category ) > 0 ) {
			$ID = $category[0]->cat_ID;
			if ( $ID ) {
				echo get_category_parents( $ID, true, ' ', false );
			}
		}
	}

	if ( ! is_front_page() && ( is_single() || is_page() ) ) {
		the_title();
	}
	if ( is_tag() ) {
		printf( esc_html__( 'Tag: %s', 'lightly' ), single_tag_title( '', false ) );
	}
	if ( is_404() ) {
		esc_html_e( '404 - Page not Found', 'lightly' );
	}
	if ( is_search() ) {
		esc_html_e( 'Search', 'lightly' );
	}
	if ( is_year() ) {
		echo get_the_time( 'Y' );
	}
	if ( is_month() ) {
		echo get_the_time( 'F Y' );
	}
	if ( is_author() ) {
		printf( esc_html__( 'Posts by %s', 'lightly' ), get_the_author() );
	}

	if ( ! is_front_page() ) {
		echo "</div>";
	}
}


/**
 * Display Related Posts Function\
 */
function lightly_related_posts() {
	$post     = get_post();
	$category = get_the_category( $post->ID );
	$cat_id   = $category[0]->cat_ID;
	$args     = array(
		'cat'          => $cat_id,
		'showposts'    => 3, /* you can change this to show more */
		'post__not_in' => array( $post->ID )
	);

	$related_posts = new WP_Query( $args );

	if ( $related_posts ) :
		while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
			<article class="clearfix type-3">
				<header>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
						   class="home-thumb"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
					<?php endif; ?>
					<h3 class="post-title-small h3"><a href="<?php the_permalink() ?>"
					                                   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h3>
					<p class="meta">
						<time
							datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
						<span class="author-meta">, <?php the_author_posts_link(); ?></span>
						<span class="comment-count-meta">, <?php comments_popup_link(
								esc_html__( 'No Comment', 'lightly' ),
								esc_html__( '1 Comment', 'lightly' ),
								esc_html__( '% Comments', 'lightly' ),
								'',
								esc_html__( 'Comment Closed', 'lightly' )
							); ?></span>
					</p>
				</header>
			</article>
		<?php endwhile;
	else : ?>
		<div class="no_related_post type-3"><?php esc_html_e( 'Cannot Retrieved a Related Posts Yet!', 'lightly' ); ?></div>
	<?php endif;

	wp_reset_postdata();
}


/**
 * Dsiplay Featured Slider/Carousel
 *
 * @param array $args
 * @param string $title
 * @param bool $hide_next
 * @param bool $content_only
 */
function lightly_custom_loop_posts( $args = '', $title = '', $hide_next = false, $content_only = false ) {

	$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : $paged;

	if ( 1 < $paged && $hide_next ) {
		return;
	}

	$htag     = ( isset( $args['heading-tag'] ) ) ? $args['heading-tag'] : 'h3';
	$img_size = ( isset( $args['thumb-size'] ) ) ? $args['thumb-size'] : 'thumb-300';

	$recent = new WP_Query( $args );

	if ( ! ( $recent->have_posts() ) ) {
		return;
	}

	$index_nav = '';
	?>
	<div class="custom-loop clearfix">
		<?php if ( ! empty( $title ) ) : ?>
			<h4 class="widgettitle"><span><?php echo $title; ?></span></h4>
		<?php endif; ?>
		<div class="loop-items clearfix">
			<?php $i = 0; ?>
			<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
				<article class="<?php echo( 'item item-' . $i . ' clearfix' ); ?>" role="article">

					<?php if ( has_post_thumbnail() ): ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
						   class="carousel-thumb"><?php the_post_thumbnail( $img_size ); ?></a>
					<?php endif; ?>
					<header>
						<h3 class="post-title <?php echo esc_attr( $htag ); ?>"><a href="<?php the_permalink() ?>"
						                                                           rel="bookmark"
						                                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
						<p class="meta">
							<time
								datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							, <?php the_author_posts_link(); ?></p>

					</header>
				</article>
				<?php
				$i ++;
				$index_nav .= '<a href="#" class="nav-index"><span>' . $i . '</span></a>';
			endwhile;

			wp_reset_postdata(); ?>
		</div>
		<?php if ( ! $content_only ) : ?>
			<nav class="clearfix">
				<a href="#" class="slider-prev"><span>&larr;</span></a>
				<?php echo $index_nav; ?>
				<a href="#" class="slider-next"><span>&rarr;</span></a>
			</nav>
		<?php endif; ?>

	</div>
	<?php
}