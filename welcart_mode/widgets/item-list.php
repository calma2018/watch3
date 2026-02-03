<?php
/**
 * Item List Widget
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Widget Regists
 */
class mode_item_list extends WP_Widget {

	/**
	 * Construct
	 */
	function __construct() {
		parent::__construct( false, $name = __( 'Welcart product list', 'welcart_mode' ) );
	}

	/**
	 * Create Widget Object
	 *
	 * @param array  $args Array.
	 * @param string $instance Instance.
	 * @return void
	 */
	function widget( $args, $instance ) {
		extract( $args );
		global $usces;

		$html      = '';
		$title     = empty( $instance['title'] ) ? '' : $instance['title'];
		$title_eng = empty( $instance['title-eng'] ) ? '' : $instance['title-eng'];
		$term_id   = empty( $instance['term_id'] ) ? usces_get_cat_id( 'item' ) : $instance['term_id'];
		$column    = empty( $instance['column'] ) ? 5 : $instance['column'];
		$number    = empty( $instance['number'] ) ? 10 : $instance['number'];

		echo $before_widget;

		if ( ! empty( $title_eng ) ) {
			echo '<div class="entryhead title-small">';
				echo '<div class="en">' . esc_html( $title_eng ) . '</div>';
			if ( ! empty( $title ) ) {
				echo $before_title . esc_html( $title ) . $after_title;
			}
				echo '</div>';
		} else {
			echo '<div class="entryhead title-normal">';
			if ( ! empty( $title ) ) {
				echo $before_title . esc_html( $title ) . $after_title;
			}
				echo '</div>';
		}

		$item_args  = array(
			'post_type'      => 'post',
			'tax_query'      => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $term_id,
				),
			),
			'posts_per_page' => $number,
		);

		if ( true === mode_get_options( 'display_widget_slide' ) ) {
			if ( true === mode_get_options( 'item_widget_slide_mobile' ) ) {
				if ( wp_is_mobile() ) {
					$addSlide = 'widget-item-column-slide';
				} else {
					$addSlide = 'widget-item-column';
				}
			} else {
				$addSlide = 'widget-item-column-slide';
			}
		} else {
			$addSlide = 'widget-item-column';
		}

		$item_query = new WP_Query( $item_args );
		if ( $item_query->have_posts() ) {
			echo '<div class="entrybody ' . esc_attr( $addSlide ) . ' column-grid column-grid' . $column . '" data-column="' . $column . '">' . "\n";
			while ( $item_query->have_posts() ) {
				$item_query->the_post();
				usces_the_item();

				get_template_part( 'template-parts/loop/product' );

			}
			echo '</div>' . "\n";
		}

		echo '<div class="entryfoot">
				<div class="more">
					<a title="' . __( 'View list', 'welcart_mode' ) . '" href="' . get_category_link( $term_id ) . '">
						<span class="label">' . __( 'View list', 'welcart_mode' ) . '</span>
					</a>
				</div>
			</div>';

		echo $after_widget;
	}

	/**
	 * Create Entry Fields
	 *
	 * @param string $instance Instance.
	 * @return void
	 */
	function form( $instance ) {
		$title        = empty( $instance['title'] ) ? '' : $instance['title'];
		$title_eng    = empty( $instance['title-eng'] ) ? '' : $instance['title-eng'];
		$term_id      = empty( $instance['term_id'] ) ? usces_get_cat_id( 'item' ) : $instance['term_id'];
		$column       = empty( $instance['column'] ) ? 5 : $instance['column'];
		$number       = empty( $instance['number'] ) ? 10 : $instance['number'];
		$target_arg   = array(
			'child_of' => usces_get_cat_id( 'item' ),
		);
		$target_terms = get_terms( 'category', $target_arg );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title-eng' ); ?>"><?php _e( 'English notation', 'welcart_mode' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title-eng' ); ?>" name="<?php echo $this->get_field_name( 'title-eng' ); ?>" type="text" value="<?php echo $title_eng; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'term_id' ); ?>"><?php _e( 'Product category to show:', 'welcart_mode' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'term_id' ); ?>" name="<?php echo $this->get_field_name( 'term_id' ); ?>">
				<option value="<?php echo usces_get_cat_id( 'item' ); ?>"
					<?php
					if ( $term_id == usces_get_cat_id( 'item' ) ) {
						echo ' selected="selected"';}
					?>
				><?php _e( 'Items', 'usces' ); ?></option>
				<?php foreach ( $target_terms as $term ) : ?>
				<option value="<?php echo $term->term_id; ?>"
					<?php
					if ( $term_id == $term->term_id ) {
						echo ' selected="selected"';}
					?>
				><?php echo $term->name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'column' ); ?>"><?php _e( 'Column:', 'welcart_mode' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>" type="number" step="1" min="3" max="6" value="<?php echo $column; ?>" size="3">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3">
		</p>
		<?php
	}

	/**
	 * Saves Entry Fields
	 *
	 * @param string $new_instance New Instance.
	 * @param string $old_instance Old Instance.
	 * @return string
	 */
	function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['title-eng'] = strip_tags( $new_instance['title-eng'] );
		$instance['term_id']   = strip_tags( $new_instance['term_id'] );
		$instance['column']    = strip_tags( $new_instance['column'] );
		$instance['number']    = strip_tags( $new_instance['number'] );
		return $instance;
	}
}
