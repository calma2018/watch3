<?php
/**
 * The Functions Template for our theme
 *
 * @package Welcart
 * @subpackage Mode Child
 * @since 1.0.0
 */

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 10 );
function theme_enqueue_styles() {
	global $usces;

	$template_dir = get_template_directory_uri();

	wp_enqueue_style( 'parent-style', $template_dir . '/style.css', array( 'reset-style' ) );
	wp_enqueue_style( 'theme_cart_css', $template_dir . '/usces_cart.css',  array( 'reset-style' ) );

	// WCEX Plugin
	if ( defined( 'WCEX_MSA_VERSION' ) && has_action( 'wp_enqueue_scripts', 'msa_front_enqueue_style' ) ) {
		wp_enqueue_style( 'parent-msa', $template_dir . '/wcex_multi_shipping.css', array( 'msa_style' ), WCEX_MSA_VERSION, false );
	}
	if ( defined( 'WCEX_SKU_SELECT' ) ) {
		wp_enqueue_style( 'parent-sku_select', $template_dir . '/wcex_sku_select.css', array(), '1.0');
	}
	if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
		wp_enqueue_style( 'parent-auto_delivery', $template_dir . '/auto_delivery.css', array(), '1.0');
	}
	if ( defined( 'WCEX_DLSELLER' ) ) {
		wp_enqueue_style( 'parent-dlseller', $template_dir . '/dlseller.css', array(), '1.0');
	}
	if ( defined( 'WCEX_ORDER_LIST_WIDGET' ) ) {
		wp_enqueue_style( 'parent-olwidget', $template_dir . '/wcex_olwidget.css', array(), '1.0');
	}

	// ▼ 子テーマの上書きCSS（親より後に読む）
	$child_uri  = get_stylesheet_directory_uri();
	$child_path = get_stylesheet_directory();
	wp_enqueue_style(
		'child-overrides',
		$child_uri . '/assets/css/overrides.css',
		array( 'parent-style', 'theme_cart_css' ), // 親に依存させて必ず後読み
		filemtime( $child_path . '/assets/css/overrides.css' )
	);
}

// タグアーカイブでも category.css を読み込む（head で出力）
function watch3_enqueue_tag_category_style() {

	// 通常の投稿タグアーカイブ
	if ( is_tag() ) {
		wp_enqueue_style(
			'watch3-tag-category-style', 
			get_template_directory_uri() . '/assets/css/category.css', // 親テーマのCSS
			array( 'parent-style' ), 
			'1.0'
		);
	}
}
add_action( 'wp_enqueue_scripts', 'watch3_enqueue_tag_category_style', 20 );



/**
 * -----------------------------------------------
 * 管理画面（ダッシュボード）用 CSS の読み込み
 * -----------------------------------------------
 */
add_action( 'admin_enqueue_scripts', function () {
	$child_uri  = get_stylesheet_directory_uri();
	$child_path = get_stylesheet_directory();

	wp_enqueue_style(
		'child-admin-overrides',
		$child_uri . '/assets/css/admin-overrides.css',
		array(), // 親admin.cssが自動で読み込まれるので依存指定なしでOK
		filemtime( $child_path . '/assets/css/admin-overrides.css' )
	);
}, 20 ); // 優先度20で「親admin.css」の後に読み込む

/**
 * -----------------------------------------------
 * ブロックエディター用カスタムスタイルの追加
 * -----------------------------------------------
 */
// 列見出し
function my_enqueue_block_editor_assets_first_column() {
  $script = <<<SCRIPT
  wp.blocks.registerBlockStyle('core/table', {
    name: 'firstColumn',
    label: '列見出し'
  });
  SCRIPT;
  wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'my_enqueue_block_editor_assets_first_column' );



/**
 * -----------------------------------------------
 * 子テーマのテンプレ改修をできるだけfunctionに集約する
 * -----------------------------------------------
 */

/**
 * パンくずリスト表示（bcn_display用）
 */
if ( ! function_exists( 'my_child_breadcrumbs' ) ) {
	function my_child_breadcrumbs() {

		if ( ! function_exists( 'bcn_display' ) ) {
			return;
		}

		if ( is_front_page() ) {
			return;
		}

		// Welcart：カート／マイページ（派生含む）を slug とクエリで除外
		if ( is_page( array( 'usces-cart', 'usces-member' ) ) ) {
			return;
		}

		?>
		<div class="l-breadcrumbs">
			<div class="l-container" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php bcn_display(); ?>
			</div>
		</div>
		<?php
	}
}

/**
 * brand タクソノミー：最上位タームのみ取得
 */
add_filter( 'get_terms_args', 'mode_child_brand_top_level_only', 10, 2 );
function mode_child_brand_top_level_only( $args, $taxonomies ) {

  // 管理画面のターム一覧などには影響させない
  if ( is_admin() ) {
    return $args;
  }

  // 配列化（念のため）
  $taxonomies = (array) $taxonomies;

  // 【修正箇所】
  // 「category（NEWタグなど）」が含まれている場合は、このフィルターを適用しない。
  // これを入れないと、NEWタグなどが「親カテゴリーじゃない」として除外されてしまいます。
  if ( in_array( 'category', $taxonomies, true ) ) {
    return $args;
  }

  // brand 以外のタクソノミーは素通り
  if ( ! in_array( 'brand', $taxonomies, true ) ) {
    return $args;
  }

  // ページを絞る（トップページ or 固定ページ「brand」）
  if ( ! ( is_front_page() || is_page( 'brand' ) ) ) {
    return $args;
  }

  // ここまで通過したら、brandの親タームだけを取得する設定を適用
  $args['parent'] = 0;

  // ★ 管理画面で並べ替えた順（term_order）で表示
  $args['orderby'] = 'term_order';
  $args['order']   = 'ASC';

  return $args;
}


/**
 * brand アーカイブ：子ターム一覧を表示
 *
 */
function watch3_brand_children_nav( $term ) {

	// 念のためチェック
	if ( ! ( $term instanceof WP_Term ) ) {
		return;
	}

	// 親ターム直下の子タームだけ取得
	$children = get_terms(
		array(
			'taxonomy'   => 'brand',
			'parent'     => $term->term_id,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false, // 元コードに合わせて false
		)
	);

	if ( is_wp_error( $children ) || empty( $children ) ) {
		// 子タームが無ければ何も出さない
		return;
	}

	echo '<ul class="p-brandChildIndex">';

	foreach ( $children as $child ) {

		$link = get_term_link( $child );
		if ( is_wp_error( $link ) ) {
			continue;
		}

		// 日本語名をメタに入れている場合は name_sub を優先
		$label = get_term_meta( $child->term_id, 'name_sub', true );
		if ( '' === $label ) {
			$label = $child->name;
		}

		echo '<li class="p-brandChildIndex__item">';
		echo '<a href="' . esc_url( $link ) . '">';
		echo '<span>' . esc_html( $label ) . '</span>';
		echo '</a>';
		echo '</li>';
	}

	echo '</ul>';
}


/**
 * 商品カスタムフィールド（メーカー品番・文字盤色・付属品）
 */
function watch3_show_item_acf_spec( $post_id = null ) {

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$item_ref       = get_post_meta( $post_id, 'item_ref', true );
	$item_rank      = get_post_meta( $post_id, 'item_rank', true );
	$item_dialcolor = get_post_meta( $post_id, 'item_dialcolor', true );
	$item_beltsize  = get_post_meta( $post_id, 'item_beltsize', true );
	$item_accessory = get_post_meta( $post_id, 'item_accessory', true );
	$item_accessory_other = get_post_meta( $post_id, 'item_accessory_other', true );

	// 全項目が空なら何も表示しない
	if (
		trim( $item_ref ) === '' &&
		trim( $item_dialcolor ) === '' &&
		trim( $item_accessory ) === ''
	) {
		return;
	}

	// テンプレートに渡す値
	$args = array(
		'item_ref'       => $item_ref,
		'item_rank'      => $item_rank,
		'item_dialcolor' => $item_dialcolor,
		'item_beltsize'  => $item_beltsize,
		'item_accessory' => $item_accessory,
		'item_accessory_other' => $item_accessory_other,
	);

	// template-parts/item/acf_spec.php を呼び出す
	get_template_part( 'template-parts/item/spec', null, $args );
}


/**
 * 商品詳細ページ：ブランドタームを取得（子ターム優先）
 */
function my_child_get_item_brand_term( $post_id = null ) {

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! $post_id ) {
		return null;
	}

	$terms = get_the_terms( $post_id, 'brand' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return null;
	}

	$brand_term = null;

	// まず「子ターム（親がいるターム）」を探す
	foreach ( $terms as $term ) {
		if ( 0 !== (int) $term->parent ) {
			$brand_term = $term;
			break;
		}
	}
	// 子タームが見つからなければ、先頭のタームを採用
	if ( ! $brand_term ) {
		$brand_term = reset( $terms );
	}

	return $brand_term;
}

/**
 * 商品詳細ページ：ブランド情報ブロックを出力
 */
function watch3_show_item_brand( $post_id = null ) {
	$brand_term = my_child_get_item_brand_term( $post_id );

	if ( ! $brand_term instanceof WP_Term ) {
		return;
	}

	get_template_part(
		'template-parts/item/brand',
		null,
		array(
			'brand_term' => $brand_term,
		)
	);
}


/**
 * 商品詳細ページ：タグ一覧を出力
 */
function watch3_show_item_tags( $post_id = null ) {

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$tags = get_the_tags( $post_id );

	if ( empty( $tags ) || is_wp_error( $tags ) ) {
		return;
	}

	echo '<div class="p-itemTags">';
	echo '<h2 class="p-itemTags__title">関連タグ</h2>';
	echo '<ul class="p-itemTags__list">';

	foreach ( $tags as $tag ) {

		$url = get_tag_link( $tag->term_id );
		if ( is_wp_error( $url ) ) {
			continue;
		}

		echo '<li class="p-itemTags__item">';
		echo '<a href="' . esc_url( $url ) . '">' . esc_html( $tag->name ) . '</a>';
		echo '</li>';
	}

	echo '</ul>';
	echo '</div>';
}


/**
 * 商品ループ内にカスタム情報を出力する関数
 */
function my_child_custom_product_info() {
	global $post;

	// 1. ブランド名（第一階層のみ取得）
	$brand_name = '';
	$terms = get_the_terms( $post->ID, 'brand' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			// 親がいない（parent が 0）タームのみを対象とする
			if ( 0 === $term->parent ) {
				$brand_name = $term->name;
				break; // 最初に見つかった親タームを採用してループを抜ける
			}
		}
	}

	// 2. メーカー品番（カスタムフィールド：item_ref）
	$item_ref = get_post_meta( $post->ID, 'item_ref', true );

	// 3. 文字盤の色（カスタムフィールド：item_dialcolor）
	$item_dialcolor = get_post_meta( $post->ID, 'item_dialcolor', true );

	// データがいずれか存在する場合のみHTMLを出力
	if ( $brand_name || $item_ref || $item_dialcolor ) {
		echo '<div class="p-itemCard_meta">';
		
		if ( $brand_name ) {
			echo '<div class="p-itemCard_meta_brand">' . esc_html( $brand_name ) . '</div>';
		}
		
		if ( $item_ref ) {
			echo '<div class="p-itemCard_meta_ref">Ref. ' . esc_html( $item_ref ) . '</div>';
		}
		
		if ( $item_dialcolor ) {
			echo '<div class="p-itemCard_meta_dial">文字盤色 ' . esc_html( $item_dialcolor ) . '</div>';
		}

		echo '</div>';
	}
}

/**
 * 売り切れ商品のシングルページでは <body> に is-item-soldout を付与
 */
add_filter( 'body_class', 'watch3_add_soldout_to_body' );
function watch3_add_soldout_to_body( $classes ) {

	if ( ! function_exists( 'usces_have_zaiko_anyone' ) ) {
		return $classes;
	}

	if ( ! is_singular() ) {
		return $classes;
	}

	$post_id = get_queried_object_id();
	if ( ! $post_id ) {
		return $classes;
	}

	if ( ! usces_have_zaiko_anyone( $post_id ) ) {
		$classes[] = 'is-item-soldout';
	}

	return $classes;
}

/**
 * 売り切れ商品の <article> に is-item-soldout を付与（一覧・ループ用）
 */
add_filter( 'post_class', 'watch3_add_soldout_to_post', 10, 3 );
function watch3_add_soldout_to_post( $classes, $class, $post_id ) {

	if ( ! function_exists( 'usces_have_zaiko_anyone' ) ) {
		return $classes;
	}

	if ( ! usces_have_zaiko_anyone( $post_id ) ) {
		$classes[] = 'is-item-soldout';
	}

	return $classes;
}



/**
 * ブランド一覧のHTMLを返す（TOPページ用）
 * inc/template-functions.php の welcart_mode_brand() を置き換え
 */

function my_child_brand_list_html() {
	$brand     = '';
	$brand_num = mode_get_options( 'brand_num' );
	$args      = array(
		'number'     => $brand_num,
		'hide_empty' => false,
	);
	$terms     = get_terms( 'brand', $args );

	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$brand       .= '<div class="brand-logo list">';
			$term_id      = $term->term_id;
			$term_name    = $term->name;
			$brand_img_id = get_term_meta( $term_id, 'brand-img-id', true );
			$name_sub     = get_term_meta( $term_id, 'name_sub', 1 );
			$brand       .= '<a href="' . get_term_link( $term_id ) . '">';

			if ( ! empty( $brand_img_id ) ) {

				// ★変更：サムネイルサイズだけ変更する
				$img_att = wp_get_attachment_image( $brand_img_id, 'medium' );

				$brand .= $img_att;
			}

			$brand .= '<div class="over">';
			$brand .= '<div class="over-in">';
			$brand .= '<h2>' . esc_html( $term_name ) . '</h2>';

			if ( ! empty( $name_sub ) ) {
				$brand .= '<div class="sub">' . esc_html( $name_sub ) . '</div>';
			}

			$brand .= '</div>';
			$brand .= '</div>';
			$brand .= '</a>';
			$brand .= '</div>';
		}
	}

	return $brand;
}

/**
 * 商品タグ取得 (カスタマイズ版)
 * スラッグ: itemused, itemunused, itemsale に対応
 *
 * @param int $post_id Post ID.
 * @return string
 */
function my_mode_get_produt_tag( $post_id = null ) {
  global $post, $usces;

  // 親テーマの設定でタグ表示がOFFの場合は何も返さない
  if ( ! mode_get_options( 'display_produt_tag' ) ) {
    return;
  }

  $flag = array();
  $html = '';

  if ( null === $post_id ) {
    $post_id = $post->ID;
  }

  // カテゴリー判定ループ
  $cats = get_the_category( $post_id );
  foreach ( $cats as $cat ) {
    switch ( $cat->slug ) {
      // 親テーマ既存
      case 'itemnew':
        $flag['new'] = 1;
        break;
      case 'itemreco':
        $flag['reco'] = 1;
        break;
      
      // ▼ 追加カスタマイズ ▼
      case 'itemused':     // USED
        $flag['used'] = 1;
        break;
      case 'itemunused':   // 未使用品
        $flag['unused'] = 1;
        break;
      case 'itemsale':     // SALE(カテゴリー)
        $flag['sale_cat'] = 1;
        break;
      // ▲ 追加カスタマイズ ▲
    }
  }

  // 表示条件判定 (どれか一つでも該当すれば ul を出力)
  if ( 
      isset( $flag['new'] ) || 
      isset( $flag['reco'] ) || 
      isset( $flag['used'] ) ||      // 追加
      isset( $flag['unused'] ) ||    // 追加
      isset( $flag['sale_cat'] ) ||  // 追加
      usces_have_fewstock( $post_id ) || 
      welcart_mode_has_campaign( $post_id ) 
  ) {
    
    $html .= '<ul class="cf opt-tag">' . "\n";
    
    // 1. NEW
    if ( isset( $flag['new'] ) ) {
      $html .= '<li class="opt-tag-icon new" data-icon="new">' . mode_get_options( 'display_newtag_text' ) . '</li>' . "\n";
    }
    
    // 2. おすすめ
    if ( isset( $flag['reco'] ) ) {
      $html .= '<li class="opt-tag-icon recommend" data-icon="recommend">' . mode_get_options( 'display_hottag_text' ) . '</li>' . "\n";
    }

    // ▼ 3. USED (追加) ▼
    if ( isset( $flag['used'] ) ) {
      $html .= '<li class="opt-tag-icon used" data-icon="used">USED</li>' . "\n";
    }

    // ▼ 4. 未使用品 (追加) ▼
    if ( isset( $flag['unused'] ) ) {
      $html .= '<li class="opt-tag-icon unused" data-icon="unused">未使用品</li>' . "\n";
    }

    // ▼ 5. SALEカテゴリー (追加) ▼
    if ( isset( $flag['sale_cat'] ) ) {
      $html .= '<li class="opt-tag-icon sale-cat" data-icon="sale-cat">SALE</li>' . "\n";
    }

    // 6. 在庫僅少
    if ( usces_have_fewstock( $post_id ) ) {
      $html .= '<li class="opt-tag-icon stock" data-icon="stock">' . $usces->zaiko_status[1] . '</li>' . "\n";
    }
    
    // 7. キャンペーン (Welcart標準のSALE)
    if ( welcart_mode_has_campaign( $post_id ) ) {
      $saletag_text = mode_get_options( 'display_saletag_text' );
      if ( ! empty( $saletag_text ) ) {
        $html .= '<li class="opt-tag-icon sale" data-icon="sale">' . $saletag_text . '</li>' . "\n";
      }
    }
    
    $html .= '</ul>' . "\n";
  }

  return $html;
}

/**
 * 出力用関数
 * テンプレートファイルからはこちらを呼び出してください
 */
function my_mode_produt_tag( $post_id = null ) {
  $produt_tag = my_mode_get_produt_tag( $post_id );
  if ( ! empty( $produt_tag ) ) {
    echo wp_kses_post( $produt_tag );
  }
}