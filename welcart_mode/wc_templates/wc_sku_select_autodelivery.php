<?php
/**
 * SKU Select Auto Delivery Page
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/* 詳細説明の場所変更機能 */
$get_subimg       = usces_get_itemSubImageNums();
$cont_position    = mode_get_options( 'content_position' );
$page_title       = mode_get_options( 'item_page_title' );
$display_inquiry  = mode_get_options( 'display_inquiry' );
$inquiry_position = mode_get_options( 'inquiry_position' );
$other_item       = mode_get_options( 'display_item_single' );

if ( ! is_array( $other_item ) ) {
	$other_item = array();
}

get_header();

global $usces;

if ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'dl-sku' ); ?> id="post-<?php the_ID(); ?>">

		<?php
		usces_remove_filter();
		usces_the_item();
		usces_have_skus();

		if ( 'lp' === $cont_position ) :
			?>
			<section class="item-content entry-content entry-box">
			<?php
			if ( $page_title ) :
				?>
				<h1 class="item-page-title"><?php the_title(); ?></h1>
				<?php
			endif;
			the_content();
			?>
			</section>
			<?php
		endif;
		?>

		<section class="is-product">
			<div class="gallery">
				<div id="itemimg" class="itemimg">
					<div class="slider slider-for">
						<div class="list">
						<?php
						if ( wp_is_mobile() ) :
							usces_the_itemImage( 0, 600, 600, $post );
						else :
							?>
							<a href="<?php usces_the_itemImageURL( 0 ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); ?>>
								<?php usces_the_itemImage( 0, 600, 600, $post ); ?>
							</a>
							<?php
						endif;
						?>
						</div>
						<?php
						foreach ( $get_subimg as $subimg ) :
							?>
							<div class="list">
							<?php
							if ( wp_is_mobile() ) :
								usces_the_itemImage( $subimg, 600, 600, $post );
							else :
								?>
								<a href="<?php usces_the_itemImageURL( $subimg ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); ?>>
									<?php usces_the_itemImage( $subimg, 600, 600, $post ); ?>
								</a>
								<?php
							endif;
							?>
							</div>
							<?php
						endforeach;
						?>
					</div>
					<?php do_action( 'usces_theme_favorite_icon' ); ?>
				</div><!-- #itemimg -->

				<?php
				if ( ! empty( $get_subimg ) ) :
					?>
					<div id="itemimg-sub" class="slider slider-nav itemimg-sub">
						<div class="list"><?php usces_the_itemImage( 0, 90, 90, $post ); ?></div>
						<?php
						foreach ( $get_subimg as $subimg ) :
							?>
							<div class="list"><?php usces_the_itemImage( $subimg, 90, 90, $post ); ?></div>
							<?php
						endforeach;
						?>
					</div><!-- #itemimg-sub -->
					<?php
				endif;
				?>
			</div><!-- .gallery -->

			<div class="add-to-cart">
				<?php
				mode_produt_tag();
				if ( in_array( 'brand', $other_item, true ) ) {
					mode_brand_label( $post );
				}
				?>

				<div class="itemname">
					<h1><?php usces_the_itemName(); ?></h1>
				<?php
				if ( in_array( 'itemcode', $other_item, true ) ) :
					?>
					<div class="itemcode"><?php usces_the_itemCode(); ?></div>
					<?php
				endif;
				?>
				</div>

				<?php
				if ( ! empty( $post->post_excerpt ) ) :
					?>
					<div class="excerpt">
						<p><?php echo esc_html( $post->post_excerpt ); ?></p>
					</div>
					<?php
				endif;
				$item_custom = usces_get_item_custom( $post->ID, 'list', 'return' );
				if ( $item_custom ) {
					echo wp_kses_post( $item_custom );
				}
				do_action( 'usces_action_single_item_outform' );
				?>
			</div><!-- .add-to-cart -->

			<div class="info">

				<?php if ( wp_is_mobile() ) : ?>
					<div class="tabs-sp">
						<ul class="tabs">

						<?php
						if ( 'initial' === $cont_position ) :
							?>
								<li class="active">
									<div class="label"><?php esc_html_e( 'Item Description', 'welcart_mode' ); ?></div>
									<div class="icon">
										<div class="in"></div>
									</div>
									<div class="entry-box entry-content select">
									<?php the_content(); /* パターンB */ ?>
									</div>
								</li>
								<?php
							endif;
						$item_custom = usces_get_item_custom( $post->ID, 'table', 'return' );
						if ( ! empty( $item_custom ) ) :
							?>
								<li>
									<div class="label"><?php esc_html_e( 'Other', 'welcart_mode' ); ?></div>
									<div class="icon">
										<div class="in"></div>
									</div>
									<div class="entry-box spec"><?php echo wp_kses_post( $item_custom ); ?></div>
								</li>
								<?php
							endif;
						if ( in_array( 'review', $other_item, true ) ) :
							?>
								<li>
									<div class="label"><?php esc_html_e( 'Review', 'welcart_mode' ); ?><span class="review-num">（ <?php echo esc_html( get_comments_number() ); ?> ）</span></div>
									<div class="icon">
										<div class="in"></div>
									</div>
									<div class="entry-box review-list">
									<?php comments_template( '/wc_templates/wc_review-list.php' ); ?>
									</div><!-- .entry-review -->
								</li>
								<?php
							endif;
						?>

						</ul>
					</div>
				<?php else : ?>
					<div class="tabs-pc">
						<ul class="tabs">
						<?php
						if ( 'initial' === $cont_position ) :
							?>
							<li class="active">
								<div class="label"><?php esc_html_e( 'Item Description', 'welcart_mode' ); ?></div>
							</li>
							<?php
						endif;
						$item_custom = usces_get_item_custom( $post->ID, 'table', 'return' );
						if ( ! empty( $item_custom ) ) :
							if ( 'initial' !== $cont_position ) {
								$class = 'active';
							} else {
								$class = 'second-menu';
							}
							?>
							<li class="<?php echo esc_attr( $class ); ?>">
								<div class="label"><?php esc_html_e( 'Other', 'welcart_mode' ); ?></div>
							</li>
							<?php
						endif;
						if ( in_array( 'review', $other_item, true ) ) :
							if ( 'initial' !== $cont_position && empty( $item_custom ) ) {
								$class = 'active';
							} else {
								$class = 'second-menu';
							}
							?>
							<li class="<?php echo esc_attr( $class ); ?>">
								<div class="label"><?php esc_html_e( 'Review', 'welcart_mode' ); ?><span class="review-num">（ <?php echo esc_html( get_comments_number() ); ?> ）</span></div>
							</li>
							<?php
						endif;
						?>
						</ul>

						<?php
						if ( 'initial' === $cont_position ) :
							?>
							<div class="entry-box entry-content select">
								<?php the_content(); /* パターンB */ ?>
							</div>
							<?php
						endif;
						if ( ! empty( $item_custom ) ) :
							if ( 'initial' !== $cont_position ) {
								$class = ' select';
							} else {
								$class = ' second-menu';
							}
							?>
							<div class="entry-box spec<?php echo esc_attr( $class ); ?>">
								<?php echo wp_kses_post( $item_custom ); ?>
							</div>
							<?php
						endif;
						if ( in_array( 'review', $other_item, true ) ) :
							if ( 'initial' !== $cont_position && empty( $item_custom ) ) {
								$class = ' select';
							} else {
								$class = ' second-menu';
							}
							?>
							<div class="entry-box review-list<?php echo esc_attr( $class ); ?>">
								<?php comments_template( '/wc_templates/wc_review-list.php' ); ?>
							</div><!-- .entry-review -->
							<?php
						endif;
						?>
					</div>
					<?php
				endif;

				if ( in_array( 'review', $other_item, true ) ) :
					?>
					<div class="entry-review">
						<?php comments_template( '/wc_templates/wc_review.php', false ); ?>
					</div>
					<?php
				endif;
				?>
			</div><!-- .info -->
		</section>

		<?php
		welcart_mode_coordinates_item_models_list();
		usces_assistance_item( $post->ID, __( 'An article concerned', 'usces' ) );
		?>

	</article>
	<?php
else :
	?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php
endif;

get_footer();
