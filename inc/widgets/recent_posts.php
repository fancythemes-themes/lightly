<?php

class Lightly_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		parent::__construct( 'lightly_recent_posts', esc_html__( 'Lightly - Recent Posts', 'lightly' ), array(
			'classname'   => 'widget_posts_wrap',
			'description' => esc_html__( 'Display most recent Posts.', 'lightly' )
		) );
	}

	function widget( $args, $instance ) {
		$default  = array(
			'title'    => esc_html__( 'Recent Posts', 'lightly' ),
			'cats'     => '',
			'cat'      => '',
			'quantity' => 5,
			'order'    => 'date',
		);
		$instance = wp_parse_args( $instance, $default );
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$cats     = preg_replace( '|[^0-9,-]|', '', $instance['cats'] );
		$cat      = absint( $instance['cat'] );
		$quantity = absint( $instance['quantity'] );
		$order    = in_array( $instance['order'], array(
			'date',
			'rand',
			'comment_count'
		), true ) ? $instance['order'] : 'date';

		echo $args['before_widget'];
		?>
		<?php if ( ! empty( $instance['title'] ) && $cat === 0 ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		} ?>
		<?php if ( $cat > 0 ) {
			echo $args['before_title'] . apply_filters( 'widget_title', get_cat_name( $cat ) ) . $args['after_title'];
		} ?>
		<div class="widget_posts">
			<?php
			$r = new WP_Query( array(
				'showposts'           => $quantity,
				'cat'                 => $cat === 0 ? $cats : $cat,
				'orderby'             => $order,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
			) );
			$i = 0;
			while ( $r->have_posts() ) : $r->the_post(); ?>
				<article class="type-3">
					<header>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
							   class="home-thumb alignleft"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
						<?php endif; ?>
						<h2 class="post-title-small h3"><a href="<?php the_permalink() ?>"
						                                   rel="bookmark"
						                                   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="meta">
							<time
								datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							<span class="author-meta">, <?php the_author_posts_link(); ?></span><span
								class="comment-count-meta">, <?php comments_popup_link(
									esc_html__( 'No Comment', 'lightly' ),
									esc_html__( '1 Comment', 'lightly' ),
									esc_html__( '% Comments', 'lightly' ),
									'',
									esc_html__( 'Comment Closed', 'lightly' )
								); ?></span>
						</p>
					</header>
				</article>
				<?php

				$i ++;

			endwhile;

			wp_reset_postdata(); ?>
		</div>
		<div class="clear"><!-- --></div>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = wp_strip_all_tags( $new_instance['title'] );

		$instance['cats']     = preg_replace( '|[^0-9,-]|', '', $new_instance['cats'] );
		$instance['cat']      = absint( $new_instance['cat'] );
		$instance['quantity'] = absint( $new_instance['quantity'] );
		$instance['order']    = in_array( $new_instance['order'], array(
			'date',
			'rand',
			'comment_count'
		), true ) ? $new_instance['order'] : 'date';

		$default = array(
			'title'    => esc_html__( 'Recent Posts', 'lightly' ),
			'cats'     => '',
			'cat'      => '',
			'quantity' => 1,
			'order'    => 'date',
		);

		$instance = wp_parse_args( $instance, $default );

		return $instance;
	}

	public function form( $instance ) {
		$default  = array(
			'title'    => esc_html__( 'Recent Posts', 'lightly' ),
			'cats'     => '',
			'cat'      => '',
			'quantity' => 5,
			'order'    => 'date',
		);
		$instance = wp_parse_args( $instance, $default );
		$title    = wp_strip_all_tags( $instance['title'] );
		$cats     = preg_replace( '|[^0-9,-]|', '', $instance['cats'] );
		$cat      = absint( $instance['cat'] );
		$quantity = absint( $instance['quantity'] );
		$order    = in_array( $instance['order'], array(
			'date',
			'rand',
			'comment_count'
		), true ) ? $instance['order'] : 'date';
		?>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget title (Will automaticly use category name when select single category):', 'lightly' ); ?></label><br/>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" type="text"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php esc_html_e( 'Category:', 'lightly' ); ?></label><br/>
			<select id="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'cat' ) ); ?>">
				<option
					value="0" <?php selected( 0, $cat ); ?>><?php esc_html_e( 'Multiple Categories', 'lightly' ); ?></option>
				<?php
				$of_categories_obj = get_categories( 'hide_empty=0' );
				foreach ( $of_categories_obj as $of_cat ) {
					?>
					<option
						value="<?php echo intval( $of_cat->cat_ID ); ?>" <?php selected( intval( $of_cat->cat_ID ), $cat ); ?>><?php echo esc_html( $of_cat->cat_name ); ?></option>
					<?php
				}
				?>
			</select>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'cats' ) ); ?>"><?php esc_html_e( 'Enter ID of categories e.g. 1,2,3,4. Leave it blank to pull all categories (if multiple category choosed).:', 'lightly' ); ?></label><br/>
			<input id="<?php echo esc_attr( $this->get_field_id( 'cats' ) ); ?>" class="widefat" type="text"
			       name="<?php echo esc_attr( $this->get_field_name( 'cats' ) ); ?>"
			       value="<?php echo esc_attr( $cats ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'quantity' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'lightly' ); ?></label><br/>
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
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order posts by:', 'lightly' ); ?></label><br/>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option
					value="date" <?php selected( 'date', $order ); ?>><?php esc_html_e( 'date', 'lightly' ); ?></option>
				<option
					value="rand" <?php selected( 'rand', $order ); ?>><?php esc_html_e( 'random', 'lightly' ); ?></option>
				<option
					value="comment_count" <?php selected( 'comment_count', $order ); ?>><?php esc_html_e( 'popular', 'lightly' ); ?></option>
			</select>
		</p>
		<?php
	}

}
