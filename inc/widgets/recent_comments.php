<?php

class Lightly_Widget_Recent_Comments extends WP_Widget {

	function __construct() {
		parent::__construct( 'lightly_recent_comments', esc_html__( 'Lightly - Recent Comments', 'lightly' ), array(
			'classname'   => 'widget_comments_wrap',
			'description' => esc_html__( 'Display most recent comments.', 'lightly' ),
		) );
	}

	function widget( $args, $instance ) {
		$default  = array(
			'title'    => esc_html__( 'Latest Comments', 'lightly' ),
			'quantity' => 5
		);
		$instance = wp_parse_args( $instance, $default );
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$quantity = absint( $instance['quantity'] );

		echo $args['before_widget'];
		?>
		<?php if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		} ?>
		<ul class="widget_comments">
			<?php
			$recent_comments = get_comments( array(
				'number' => $quantity,
				'status' => 'approve'
			) );

			foreach ( $recent_comments as $comment ) {
				?>
				<li>
					<div
						class="comment-avatar"><?php echo get_avatar( $comment->comment_author_email, 60, '', '', array( 'class' => 'alignleft' ) ); ?></div>
					<div class="clearfix"><a
							href="<?php echo esc_url( get_comment_link( $comment ) ) ?>"
							class="comment_link"><h4 class="post-title"><?php echo $comment->comment_author; ?></h4></a>
						<?php echo( get_comment_excerpt( $comment->comment_ID ) ); ?></div>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']    = wp_strip_all_tags( $new_instance['title'] );
		$instance['quantity'] = absint( $new_instance['quantity'] );

		return $instance;
	}

	public function form( $instance ) {
		$default  = array(
			'title'    => esc_html__( 'Latest Comments', 'lightly' ),
			'quantity' => 5
		);
		$instance = wp_parse_args( $instance, $default );
		$title    = wp_strip_all_tags( $instance['title'] );
		$quantity = absint( $instance['quantity'] );
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget title:', 'lightly' ); ?></label><br/>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" type="text"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>"><?php esc_html_e( 'Number of Comments:', 'lightly' ); ?></label><br/>
			<select id="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'quantity' ) ); ?>">
				<option value="1" <?php selected( 1, $quantity ); ?>><?php echo number_format_i18n( 1 ); ?></option>
				<option value="2" <?php selected( 2, $quantity ); ?>><?php echo number_format_i18n( 2 ); ?></option>
				<option value="3" <?php selected( 3, $quantity ); ?>><?php echo number_format_i18n( 3 ); ?></option>
				<option value="4" <?php selected( 4, $quantity ); ?>><?php echo number_format_i18n( 4 ); ?></option>
				<option value="5" <?php selected( 5, $quantity ); ?>><?php echo number_format_i18n( 5 ); ?></option>
				<option value="6" <?php selected( 6, $quantity ); ?>><?php echo number_format_i18n( 6 ); ?></option>
				<option value="7" <?php selected( 7, $quantity ); ?>><?php echo number_format_i18n( 7 ); ?></option>
				<option value="8" <?php selected( 8, $quantity ); ?>><?php echo number_format_i18n( 8 ); ?></option>
				<option value="9" <?php selected( 9, $quantity ); ?>><?php echo number_format_i18n( 9 ); ?></option>
				<option value="10" <?php selected( 10, $quantity ); ?>><?php echo number_format_i18n( 10 ); ?></option>
				<option value="11" <?php selected( 11, $quantity ); ?>><?php echo number_format_i18n( 11 ); ?></option>
				<option value="12" <?php selected( 12, $quantity ); ?>><?php echo number_format_i18n( 12 ); ?></option>
				<option value="13" <?php selected( 13, $quantity ); ?>><?php echo number_format_i18n( 13 ); ?></option>
				<option value="14" <?php selected( 14, $quantity ); ?>><?php echo number_format_i18n( 14 ); ?></option>
				<option value="15" <?php selected( 15, $quantity ); ?>><?php echo number_format_i18n( 15 ); ?></option>
			</select>
		</p>
		<?php
	}

}
