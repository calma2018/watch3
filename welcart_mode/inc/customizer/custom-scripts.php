<?php
/**
 * Customizer - Custom Scripts Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Cistom Add Scripts
 *
 * @return void
 */
function mode_custom_add_scripts() {

	/* フロントページURL */
	$front_link = get_home_url();

	/* 商品一覧ページURL */
	$cat_name = get_category_by_slug( 'item' );
	$cat_id   = $cat_name->cat_ID;
	$cat_link = get_category_link( $cat_id );

	/* 商品詳細ページ（最新一件） */
	$args       = array(
		'cat'            => $cat_id,
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_type'      => 'post',
	);
	$item_posts = get_posts( $args );
	if ( ! empty( $item_posts ) ) {
		wp_reset_postdata();
		$itemPostID    = $item_posts[0]->ID;
		$lastItem_link = get_permalink( $itemPostID );
	} else {
		$lastItem_link = get_home_url();
	}

	/* カートページURL */
	$cart_link = usces_url( 'cart', 'return' );

	/* 投稿一覧ページURL */
	$args          = array(
		'exclude' => array( 1, $cat_id ),
		'parent'  => 0,
	);
	$terms         = get_terms( 'category', $args );
	$term_ID       = $terms[0]->term_id;
	$postList_link = get_category_link( $term_ID );

	/* 投稿詳細ページ（最新一件）URL */
	$args      = array(
		'cat'            => -$cat_id,
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_type'      => 'post',
	);
	$new_posts = get_posts( $args );
	if ( ! empty( $new_posts ) ) {
		wp_reset_postdata();
		$newPostID     = $new_posts[0]->ID;
		$lastPost_link = get_permalink( $newPostID );
	} else {
		$lastPost_link = get_home_url();
	}

	/* 特集一覧ページURL */
	$features_link = get_post_type_archive_link( 'features' );

	/* コーディネイト一覧ページURL */
	$coordinatesList_link = get_post_type_archive_link( 'coordinates' );

	/* コーディネイト詳細ページ（最新一件） */
	$args              = array(
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_type'      => 'coordinates',
	);
	$coordinates_posts = get_posts( $args );
	if ( ! empty( $coordinates_posts ) ) {
		wp_reset_postdata();
		$coordinatesPostID    = $coordinates_posts[0]->ID;
		$coordinatesPost_link = get_permalink( $coordinatesPostID );
	} else {
		$coordinatesPost_link = get_home_url();
	}

	?>
<script type="text/javascript">
( function( $ ) {
	$( function() {

		wp.customize.bind( 'ready', function() {

			wp.customize.section( 'title_tagline', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'colors', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.panel( 'general_settings', function( panel ) {
				panel.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'header_image', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.panel( 'nav_menus', function( panel ) {
				panel.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'static_front_page', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'custom_css', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'front_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'sidebar_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'item_list_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $cat_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'item_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $lastItem_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'cart_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $cart_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'archives_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $postList_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'post_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $lastPost_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'features_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $features_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'coordinate_list_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $coordinatesList_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'coordinate_post_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $coordinatesPost_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

			wp.customize.section( 'sns_settings', function( section ) {
				section.expanded.bind( function( isExpanding ) {
					if(isExpanding){
						wp.customize.previewer.previewUrl.set( '<?php echo esc_url( $front_link ); ?>' );
						wp.customize.previewer.refresh();
					}
				});
			});

		});

	});
} )( jQuery );
</script>
	<?php
}
add_action( 'customize_controls_print_scripts', 'mode_custom_add_scripts', 30 );
