<?php
/**
 * Theme Dashboard Page
 */

/**
 * Add Theme Dashboard Page to the Appearance menu
 */
function lightly_theme_dashboard_menu() {

	add_theme_page(
		sprintf( esc_html__( '%s Theme Dashboard', 'lightly' ), wp_get_theme()->get( 'Name' ) ),
		sprintf( esc_html__( '%s Theme', 'lightly' ), wp_get_theme()->get( 'Name' ) ),
		'edit_theme_options',
		'lightly',
		'lightly_theme_dashboard_page'
	);

}

add_action( 'admin_menu', 'lightly_theme_dashboard_menu' );


/**
 * Add admin notice when the theme activated, just show one time
 */
function lightly_one_activation_admin_notice(){
	global $pagenow;

	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'lightly_admin_notice' );
	}
}

add_action( 'load-themes.php',  'lightly_one_activation_admin_notice'  );

function lightly_admin_notice() {
	?>
	<div class="updated notice is-dismissible">
		<p><?php printf(
				esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$s', 'lightly' ),
				wp_get_theme()->get( 'Name' ),
				'<a href="'. esc_url( admin_url( 'themes.php?page=lightly' ) ) .'">'. esc_html__( 'Welcome page', 'lightly' ) .'</a>'
			); ?></p>
	</div>
	<?php
}


/**
 * Enqueue CSS for Dashboard Page only
 */
function lightly_theme_dashboard_enqueue( $hook ) {

	if ( $hook === 'appearance_page_lightly'  ) {
		wp_enqueue_style( 'lightly-dashboard-css', get_template_directory_uri() . '/css/dashboard.css' );
	}

}

add_action( 'admin_enqueue_scripts', 'lightly_theme_dashboard_enqueue' );


/**
 * Display the Dashboard Page
 */
function lightly_theme_dashboard_page() {

	$tab = null;

	if ( isset( $_GET['tab'] ) ) {
		$tab = $_GET['tab'];
	}
	?>
	<div class="wrap about-wrap theme-dashboard">
		<h1><?php printf( esc_html__( 'Welcome to %1s v%2s', 'lightly' ), wp_get_theme()->get( 'Name' ), wp_get_theme()->get( 'Version' ) ); ?></h1>
		<div class="about-text"><?php esc_html_e( 'Lightly is a WordPress theme for news or magazine website, neatly designed, well coded, and more importantly easy to use.', 'lightly' ) ?></div>

		<a target="_blank"
		   href="<?php echo esc_url( 'https://fancythemes.com/?utm_source=theme_dashboard_page&utm_medium=badge_link&utm_campaign=theme_admin' ); ?>"
		   class="wp-badge fancythemes"><span><?php esc_html_e( 'FancyThemes', 'lightly' ); ?></span></a>

		<h2 class="nav-tab-wrapper">
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=lightly' ) ) ?>" class="nav-tab<?php echo is_null( $tab ) ? ' nav-tab-active' : ''; ?>"><?php echo wp_get_theme()->get( 'Name' ); ?></a>
			<?php do_action( 'lightly_theme_dashboard_tabs' ); ?>
		</h2>

		<?php if ( is_null( $tab ) ) : ?>
			<div class="theme-tab-content">
				<div class="theme-content clearfix">
					<div class="theme-content-left">
						<div class="group">
							<h3><?php esc_html_e( 'Theme Customizer', 'lightly' ); ?></h3>
							<p class="about"><?php printf( esc_html__( '%s utilises the Theme Customizer for all theme settings. Click "Live Customize" to customize your site for your needs.', 'lightly' ), wp_get_theme()->get( 'Name' ) ); ?></p>
							<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"
							      class="button button-primary"><?php esc_html_e( 'Live Customize', 'lightly' ); ?></a></p>
						</div>

						<div class="group">
							<h3><?php esc_html_e( 'Theme Documentation', 'lightly' ); ?></h3>
							<p class="about"><?php printf( esc_html__( 'Need any help to setup and configure %s? Please have a look at our documentations instructions.', 'lightly' ), wp_get_theme()->get( 'Name' ) ); ?></p>
							<p><a href="http://docs.fancythemes.com" target="_blank"
							      class="button button-secondary"><?php esc_html_e( 'Online Documentation', 'lightly' ); ?></a></p>
						</div>

						<div class="group">
							<h3><?php printf( esc_html__( '%s Pro & Priority Support', 'lightly' ), wp_get_theme()->get( 'Name' ) ); ?></h3>
							<p class="about"><?php printf( esc_html__( 'We have curated amazing features such as Advanced Color Options, Typography Settings, Featured Carousel, and more into %s Pro version, which also includes priority support.', 'lightly' ), wp_get_theme()->get( 'Name' ) ); ?></p>
							<p><a href="https://fancythemes.com/themes/lightly/" target="_blank"
							      class="button button-secondary"><?php printf( esc_html__( 'Upgrade to %s Pro', 'lightly' ), wp_get_theme()->get( 'Name' ) ); ?></a></p>
						</div>
					</div>

					<div class="theme-content-right">
						<img src="<?php echo esc_url( get_template_directory_uri() .'/screenshot.png' ); ?>" alt="<?php esc_attr( 'Theme Screenshot', 'lightly' ); ?>"/>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php do_action( 'lightly_theme_dashboard_tab_content' ); ?>
	</div>
	<?php
}
