<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
?>

<article id="post-not-found">
	<header>
		<h1><?php esc_html_e( 'Not Found', 'lightly' ); ?></h1>
	</header>

	<section class="post_content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf(
					__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'lightly' ),
					esc_url( admin_url( 'post-new.php' ) )
				); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lightly' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lightly' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</section>

	<footer></footer>
</article>
