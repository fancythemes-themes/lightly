<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="clearfix" style="display:block; height:3px; width:100%;">&nbsp;</div>

<?php if ( have_comments() ) : ?>

	<h3 id="comments" class="widgettitle">
		<span><?php comments_number( esc_html__( 'No Responses', 'lightly' ), esc_html__( 'One Response', 'lightly' ), esc_html__( '% Responses', 'lightly' ) ); ?></span>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav">
			<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'lightly' ); ?></h1>
			<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
			</ul>
		</nav>
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php wp_list_comments( 'type=comment&callback=lightly_comments' ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav">
			<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'lightly' ); ?></h1>
			<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
			</ul>
		</nav>
	<?php endif; // check for comment navigation ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'lightly' ); ?></p>
	<?php endif; ?>

	<?php

endif;


if ( comments_open() ) :

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$comments_args = array(
		// remove "Text or HTML to be displayed after the set of comment fields"
		'title_reply'          => '<h4 class="widgettitle"><span>' . esc_html__( 'Leave a Reply', 'lightly' ) . '</span></h4>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'fields'               => array(
			'author' =>
				'<p class="comment-form-author"><label for="author">' . esc_html__( 'Name ', 'lightly' ) .
				( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="author" name="author" placeholder="' . esc_attr__( 'Your Name*', 'lightly' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="19" ' . $aria_req . ' ></p>',

			'email' =>
				'<p class="comment-form-email"><label for="email">' . esc_html__( 'Email ', 'lightly' ) .
				( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="email" name="email" placeholder="' . esc_attr__( 'Your Email*', 'lightly' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
				'" size="19" ' . $aria_req . ' ></p>',

			'url' =>
				'<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'lightly' ) . '</label>' .
				'<input id="url" placeholder="' . esc_attr__( 'Your Website', 'lightly' ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="19" ></p>',
		),
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comments ', 'lightly' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment  &hellip', 'lightly' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>',
		'label_submit'         => esc_html__( 'Submit Comment', 'lightly' ),
	);

	comment_form( $comments_args );

endif;
