<?php
/**
 * Member - Favorites List Page
 *
 * @package WCEX Favorites
 * @since 1.0.0
 */

global $usces;

$member          = $usces->get_member();
$favorites_count = wcfv_get_favorites_count( $member['ID'] );
$favorite_option = wcfv_get_option();
/* translators: */
$page_title = sprintf( __( '%s List', 'favorite' ), $favorite_option['label_name'] );
$page_title = apply_filters( 'usces_theme_filter_page_title', $page_title, $favorite_option['label_name'] );
/* translators: */
$no_favorite_message = sprintf( __( 'There are no %s items.', 'favorite' ), $favorite_option['label_name'] );

get_header();
?>
	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>
		<div class="post" id="wc_member_favorite_page">

			<header class="entry-member-header">
				<div class="en">Favorite List</div>
				<h1 class="member_page_title"><?php echo esc_html( $page_title ); ?></h1>
			</header>

			<div id="memberinfo">

				<div class="error_message"></div>

				<?php if ( 1 > $favorites_count ) : ?>

					<p><?php echo esc_html( $no_favorite_message ); ?></p>

				<?php else : ?>

					<form id="member-favorite-page">
						<?php
						$favorites = wcfv_get_favorites( $member['ID'] );
						if ( 1 === $favorites_count ) {
							$args = array(
								'p' => $favorites[0],
							);
						} else {
							$args = array(
								'post__in'            => $favorites,
								'posts_per_page'      => -1,
								'orderby'             => 'post__in',
								'ignore_sticky_posts' => 1,
							);
						}
						$fv = new WP_Query( $args );
						if ( $fv->have_posts() ) :
							?>
						<div id="member-favorite" class="member-favorite section-content">
							<?php
							while ( $fv->have_posts() ) :
								$fv->the_post();
								usces_the_item();
								$post_id = get_the_ID();

								$item_cont = mode_get_options( 'item_cont' );
								if ( ! is_array( $item_cont ) ) {
									$item_cont = array();
								}
								?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php usces_the_itemName(); ?>">

											<div class="img square">
												<?php
												if ( in_array( 'item-img', $item_cont, true ) ) {
													$sub_img = usces_get_itemSubImageNums();
													if ( ! empty( $sub_img ) && ! wp_is_mobile() && mode_get_options( 'subimage_hover' ) ) {
														echo '<div class="overlay">' . wp_kses_post( usces_the_itemImage( 0, 500, 500, '', 'return' ) ) .
																'<span class="sub-img">' . wp_kses_post( usces_the_itemImage( 1, 500, 500, '', 'return' ) ) . '</span></div>';
													} else {
														usces_the_itemImage( 0, 500, 500 );
													}
												}
												?>
												<?php do_action( 'usces_theme_favorite_icon' ); ?>
												<?php
												if ( in_array( 'item-tag', $item_cont, true ) ) {
													mode_produt_tag(); }
												?>
											</div>
											<div class="info">
												<?php welcart_mode_campaign_message(); ?>
												<?php
												if ( in_array( 'brand', $item_cont, true ) ) {
													mode_brand_label( $post );
												}
												?>
												<?php if ( in_array( 'item-name', $item_cont, true ) ) : ?>
													<h2><?php usces_the_itemName(); ?></h2>
													<?php endif; ?>
													<div class="price"><?php usces_the_firstPriceCr(); ?><?php usces_guid_tax(); ?></div>
													<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
													<?php if ( ! usces_have_zaiko_anyone() && in_array( 'item-soldout', $item_cont, true ) ) : ?>
														<div class="itemsoldout">
															<?php welcart_mode_soldout_label( get_the_ID() ); ?>
														</div>
												<?php endif; ?>
											</div>

										</a>
									</article>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<?php endif; ?>
					</form>
					<?php endif; ?>

				<div class="send">
					<a class="back_to_mypage" href="<?php echo esc_url( USCES_MEMBER_URL ); ?>"><?php esc_html_e( 'Back to the member page.', 'usces' ); ?></a>
				</div>
			</div>

		</div>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
