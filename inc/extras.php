<?php

if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;


/**
 * @param $classes
 *
 * @return array
 */
function lightly_browser_body_class( $classes ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
	} else {
		$classes[] = 'unknown';
	}
	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}

	return $classes;
}

add_filter( 'body_class', 'lightly_browser_body_class' );


/**
 * Modify the Read More in the Excerpts
 *
 * @param $more
 *
 * @return string
 */
function lightly_excerpt_more( $more ) {
	return '&hellip';
}

add_filter( 'excerpt_more', 'lightly_excerpt_more' );


/**
 * Modify the excerpt length into 35
 *
 * @param $length
 *
 * @return int
 */
function lightly_excerpt_length( $length ) {
	return 35;
}

add_filter( 'excerpt_length', 'lightly_excerpt_length', 999 );


/**
 * Search Form
 *
 * @param $form
 *
 * @return string
 */
function lightly_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <label class="screen-reader-text" for="s">' . __( 'Search for:', 'lightly' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Type your search here', 'lightly' ) . '" />
    <button type="submit" id="searchsubmit" ><span class="screen-reader-text">' . __( 'Search', 'lightly' ) . '</span></button>
    </form>';

	return $form;
}

add_filter( 'get_search_form', 'lightly_search_form' );


/**
 * Function to exclude categories from recent posts on homepage
 *
 * @param WP_Query $query
 */
function lightly_exclude_categories( WP_Query $query ) {

	$exclude_category = get_theme_mod( 'exclude_posts_categories' );

	if ( $query->is_home() && $query->is_main_query() && $exclude_category ) {
		$query->query_vars['category__not_in'] = absint( $exclude_category );
	}
}

add_action( 'pre_get_posts', 'lightly_exclude_categories' );
