<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>
<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<div id="secondary" class="sidebar col300 right clearfix" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
<?php endif; ?>