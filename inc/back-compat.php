<?php
/**
 * Lightly back compat functionality
 *
 * Prevents Lightly from running on WordPress versions prior to 4.5,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.5.
 */

/**
 * Prevent switching to Lightly on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function lightly_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'lightly_upgrade_notice' );
}

add_action( 'after_switch_theme', 'lightly_switch_theme' );


/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Lightly on WordPress versions prior to 4.5.
 *
 * @global string $wp_version WordPress version.
 */
function lightly_upgrade_notice() {
	$message = sprintf( esc_html__( 'Lightly requires at least WordPress version 4.5. You are running version %s. Please upgrade and try again.', 'lightly' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}


/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.5.
 *
 * @global string $wp_version WordPress version.
 */
function lightly_customize() {
	wp_die( sprintf( esc_html__( 'Lightly requires at least WordPress version 4.5. You are running version %s. Please upgrade and try again.', 'lightly' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}

add_action( 'load-customize.php', 'lightly_customize' );


/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.5.
 *
 * @global string $wp_version WordPress version.
 */
function lightly_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'Lightly requires at least WordPress version 4.5. You are running version %s. Please upgrade and try again.', 'lightly' ), $GLOBALS['wp_version'] ) );
	}
}

add_action( 'template_redirect', 'lightly_preview' );
