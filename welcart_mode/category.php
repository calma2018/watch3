<?php
/**
 * Category Template for Item / Post
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<?php
	$term_id      = get_query_var( 'cat' );
	$term         = get_category( $term_id );
	$term_slug    = $term->slug;
	$current_page = get_query_var( 'paged' );
	$cat_info     = '';
	$cat_info    .= '<div class="category-info">';
	$cat_img      = get_term_meta( $term_id, 'category-img-url', true );
	$name_eng     = get_term_meta( $term_id, 'name_eng', 1 );

	if ( ! empty( $cat_img ) ) {
		$cat_info .= '<div class="category-img"><img src="' . $cat_img . '"></div>';
	}

	if ( ! empty( $name_eng ) ) {
		$class = ' title-small';
	} else {
		$class = ' default';
	}

	$cat_info .= '<header class="entry-head' . $class . '">';

	if ( ! empty( $name_eng ) ) {
		$cat_info .= '<div class="en">' . $name_eng . '</div>';
	}

	$cat_info .= '<h1>' . get_cat_name( $term_id ) . '</h1>';

	$cat_info .= '</header>';

	if ( ! empty( category_description() ) ) {
		$cat_info .= '<div class="category-description">' . category_description() . '</div>';
	}

	$cat_info .= '</div>';

	echo wp_kses_post( $cat_info );

	if ( usces_is_cat_of_item( $term_id ) ) {
		if ( have_posts() ) {

			$count_items  = get_category( $term_id );
			$count_num    = $count_items->category_count;
			$current_page = 0 === $current_page ? '1' : $current_page;
			$max_pages    = $wp_query->max_num_pages;
			echo '<div class="list-info">';
			$is_cat_name = get_cat_name( $term_id );

			if ( 'item' === $term_slug ) {
				echo '<h2 class="headline">' . esc_html__( 'All items', 'welcart_mode' ) . '</h2>';
			} else {
				echo '<h2 class="headline">' . esc_html( $is_cat_name ) . '' . esc_html__( 'is item list', 'welcart_mode' ) . '</h2>';
			}

			/* count items */
			echo '<div class="count-items"><span class="num">' . esc_html( $count_num ) . '</span>items</div>';

			echo '<div class="inbox">';
			/* pages */
			echo '<div class="pages-info">Page ' . esc_html( $current_page ) . ' of ' . esc_html( $max_pages ) . '</div>';
			$args           = array(
				'type'      => 'list',
				'prev_text' => __( ' &laquo; ' ),
				'next_text' => __( ' &raquo; ' ),
			);
			$paginate_links = paginate_links( $args );
			if ( $paginate_links ) {
				echo '<div class="pagination-wrap top">' . wp_kses_post( $paginate_links ) . '</div>';
			}
			echo '</div>';

			/* sub category */
			if ( mode_get_options( 'display_sub_categories' ) ) {
				$args       = array(
					'parent' => $term_id,
				);
				$child_cats = get_categories( $args );

				if ( $child_cats ) {
					$html  = '';
					$html .= '<div class="child-categories">';
					$html .= '<div class="selected-category">' . __( 'Narrow down', 'welcart_mode' ) . '</div>';
					$html .= '<ul class="is-child">';

					foreach ( $child_cats as $child_cat ) {
						$child_cat_id  = $child_cat->term_id;
						$child_cat_img = get_term_meta( $child_cat_id, 'category-thumbnail-url', true );
						$html         .= '<li>';
						$html         .= '<a href="' . get_category_link( $child_cat_id ) . '">';
						$html         .= '<span class="img">';

						if ( ! empty( $child_cat_img ) ) {
							$html .= '<img src="' . $child_cat_img . '">';
						}

						$html .= '</span>';
						$html .= '<span class="name">' . $child_cat->name . '</span>';
						$html .= '</a>';
						$html .= '</li>';
					}

					$html .= '</ul>';
					$html .= '</div>';
					echo wp_kses_post( $html );
				}
			}
			echo '</div>';

			$column = mode_get_options( 'item_list_column' );
			echo '<div class="product-group column-grid column-grid' . esc_attr( $column ) . '">';

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop/product' );
			}

			echo '</div>';

		} else {

			echo '<p class="no-post">' . esc_html__( 'The product was not found.', 'welcart_mode' ) . '</p>';

		}
	} else {
		if ( have_posts() ) {

			$column        = mode_get_options( 'archives_list_column' );
			$archives_cont = mode_get_options( 'archives_cont' );
			$class         = '';
			$class        .= ' layout-list-column' . $column;

			if ( ! in_array( 'thumbnail', $archives_cont, true ) ) {
				$class .= ' not-thumbnail';
			}

			echo '<div class="post-group layout-list-column layout-list layout-list2' . esc_attr( $class ) . '">';

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop/post' );
			}

			echo '</div>';

		} else {

			echo '<p class="no-post">' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';

		}
	}

	$args           = array(
		'type'      => 'list',
		'prev_text' => __( ' &laquo; ' ),
		'next_text' => __( ' &raquo; ' ),
	);
	$paginate_links = paginate_links( $args );

	if ( $paginate_links ) {
		echo '<div class="pagination-wrap bottom">' . wp_kses_post( $paginate_links ) . '</div>';
	}

	?>

<?php
get_footer();
