<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

$post_type = 'features';
if ( mode_get_options( 'display_features' ) ) :
	$features_num   = mode_get_options( 'features_num' );
	$features_args  = array(
		'post_type'      => $post_type,
		'posts_per_page' => $features_num,
	);
	$features_query = new WP_Query( $features_args );
	if ( $features_query->have_posts() ) :
		?>

		<section class="section-home features">

			<div class="column1120">

				<div class="entryhead">
					<div class="en">FEATURES</div>
					<h1 class="small"><?php esc_html_e( 'Feature', 'welcart_mode' ); ?></h1>
				</div>

				<?php
				if ( 'module-list' === mode_get_options( 'features_layout' ) ) {
					$column = mode_get_options( 'features_list_column' );
					$class  = 'layout-list layout-list1 layout-list-column' . $column;
				} else {
					$column = mode_get_options( 'features_grid_column' );
					$class  = 'layout-grid layout-grid-column' . $column;
				}
				?>

				<?php
				if ( true === mode_get_options( 'features_slide' ) ) {
					if ( true === mode_get_options( 'features_slide_mobile' ) ) {
						if ( wp_is_mobile() ) {
							$addSlide = 'features-column-slide';
						} else {
							$addSlide = 'features-column';
						}
					} else {
						$addSlide = 'features-column-slide';
					}
				} else {
					$addSlide = 'features-column';
				}
				?>

				<div class="entrybody <?php echo esc_attr( $addSlide ); ?> layout-grid layout-grid-column3">
					<?php
					while ( $features_query->have_posts() ) {
						$features_query->the_post();
						get_template_part( 'template-parts/loop/feature' );
					}
					wp_reset_postdata();
					?>
				</div>

				<div class="entryfoot">
					<div class="more"><a title="<?php esc_html_e( 'View list', 'welcart_mode' ); ?>" href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>"><span class="label"><?php esc_html_e( 'View list', 'welcart_mode' ); ?></span></a></div>
				</div>

			</div>

		</section>

		<?php
	endif;
endif;
