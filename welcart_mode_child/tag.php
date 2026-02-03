<?php
/**
 * Tag Template for Item / Post
 * category.php の複製を基に作成
 */

get_header();
?>

	<?php
	$term         = get_queried_object();
	$term_id      = isset( $term->term_id ) ? $term->term_id : 0;
	$term_slug    = isset( $term->slug ) ? $term->slug : '';
	$term_name    = isset( $term->name ) ? $term->name : '';
	$current_page = get_query_var( 'paged' );

	$cat_info  = '';
	$cat_info .= '<div class="category-info">';
	$cat_img   = get_term_meta( $term_id, 'category-img-url', true );
	$name_eng  = get_term_meta( $term_id, 'name_eng', true );

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
		$cat_info .= '<h1 class="title-eng">' . esc_html( $name_eng ) . '</h1>';
	}

	$cat_info .= '<h1 class="title-jpn">' . esc_html( $term_name ) . '</h1>';

	$cat_info .= '</header>';

	$tag_description = term_description( $term_id );

	if ( ! empty( $tag_description ) ) {
		$cat_info .= '<div class="category-description">' . $tag_description . '</div>';
	}

	$cat_info .= '</div>';

	echo wp_kses_post( $cat_info );

	global $wp_query;

	/**
	 * このタグアーカイブが「商品タグ」かどうか簡易判定
	 * （最初の投稿が商品なら item タグとみなす）
	 */
	$is_item_tag = false;

	if ( have_posts() ) {
		$original_post = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;

		$first_post      = $wp_query->posts[0];
		$GLOBALS['post'] = $first_post;
		setup_postdata( $first_post );

		if ( function_exists( 'usces_is_item' ) && usces_is_item() ) {
			$is_item_tag = true;
		}

		wp_reset_postdata();

		if ( $original_post instanceof WP_Post ) {
			$GLOBALS['post'] = $original_post;
			setup_postdata( $original_post );
		}
	}

	if ( $is_item_tag ) {

		// ==========
		// 商品タグ用レイアウト（category.php の「商品カテゴリ」側と同じフォーマット）
		// ==========

		if ( have_posts() ) {

			$count_num    = (int) $wp_query->found_posts;
			$current_page = 0 === $current_page ? '1' : $current_page;
			$max_pages    = $wp_query->max_num_pages;

			echo '<div class="list-info">';

			if ( 'item' === $term_slug ) {
				echo '<h2 class="headline">' . esc_html__( 'All items', 'welcart_mode' ) . '</h2>';
			} else {
				// 「◯◯ の商品一覧」的な見出し（文言はお好みで調整可）
				echo '<h2 class="headline">「' . esc_html( $term_name ) .  '」' . esc_html__( 'is item list', 'welcart_mode' ) . '</h2>';
			}

			/* count items */
			echo '<div class="count-items"><span class="num">' . esc_html( $count_num ) . '</span>items</div>';

			echo '<div class="inbox">';

			/* pages */
			echo '<div class="pages-info">Page ' . esc_html( $current_page ) . ' of ' . esc_html( $max_pages ) . '</div>';

			$args = array(
				'type'      => 'list',
				'prev_text' => __( ' &laquo; ' ),
				'next_text' => __( ' &raquo; ' ),
			);
			$paginate_links = paginate_links( $args );

			if ( $paginate_links ) {
				echo '<div class="pagination-wrap top">' . wp_kses_post( $paginate_links ) . '</div>';
			}

			echo '</div>'; // .inbox

			echo '</div>'; // .list-info ★ここを追加

			// タグには階層がないので、category.php の「サブカテゴリ一覧」は省略

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

		// ==========
		// 通常投稿タグ用レイアウト（category.php の「投稿カテゴリ」側と同じフォーマット）
		// ==========

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

	// 下部ページネーション（category.php と同じ）
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
