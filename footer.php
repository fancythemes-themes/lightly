<footer role="contentinfo" class="footer">
	<div id="inner-footer" class="wrap clearfix">

		<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ||
		           is_active_sidebar( 'footer-sidebar-2' ) ||
		           is_active_sidebar( 'footer-sidebar-3' ) ||
		           is_active_sidebar( 'footer-sidebar-4' )
		) : ?>
			<div id="footer-widgets" class="clearfix">
				<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>
					<div class="f-widget col220 first f-widget-1">
						<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
					<div class="f-widget col220 f-widget-2">
						<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
					<div class="f-widget col220 f-widget-3">
						<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
					<div class="f-widget col220 last f-widget-4">
						<?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="attribution col940">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<?php wp_nav_menu( array(
					'theme_location'  => 'footer',
					'container'       => 'nav',
					'container_class' => 'footer-links clearfix',
					'menu_class'      => 'footer-menu',
					'depth'           => 0
				) ); ?>
			<?php endif; ?>

			<p class="footer-credit"><?php
				/* translators: 1. Site name 2. Current Year 3. WordPress Link 4. FancyThemes Link */
				echo apply_filters( 'lightly_footer_credit', sprintf(
					__( '&copy; %1$s %2$d. Powered by %3$s &amp; %4$s', 'lightly' ),
					get_bloginfo( 'name' ),
					date( 'Y' ),
					sprintf(
						'<a href="%1$s" title="%2$s" rel="nofollow">%3$s</a>',
						'https://wordpress.org/',
						esc_attr__( 'WordPress', 'lightly' ),
						esc_html__( 'WordPress', 'lightly' )
					),
					sprintf(
						'<a href="%1$s" title="%2$s" rel="nofollow">%3$s</a>',
						'https://fancythemes.com/',
						esc_attr__( 'FancyThemes', 'lightly' ),
						esc_html__( 'FancyThemes', 'lightly' )
					)
				) ); ?></p>
		</div>

	</div>
</footer>

</div>

<?php wp_footer(); ?>
</body>

</html>