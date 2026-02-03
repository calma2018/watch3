<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

if ( mode_get_options( 'display_coordinate' ) ) :

	$post_type   = 'coordinates';
	$num         = mode_get_options( 'coordinate_num' );
	$coord_args  = array(
		'post_type'      => $post_type,
		'posts_per_page' => $num,
	);
	$coord_query = new WP_Query( $coord_args );
	if ( $coord_query->have_posts() ) :
		$column = mode_get_options( 'coordinate_column' );

		if ( true === mode_get_options( 'coordinates_slide' ) ) {
			if ( true === mode_get_options( 'coordinates_slide_mobile' ) ) {
				if ( wp_is_mobile() ) {
					$add_slide = 'coordinate-column coordinates-column-slide';
				} else {
					$add_slide = 'coordinate-column';
				}
			} else {
				$add_slide = 'coordinate-column coordinates-column-slide';
			}
		} else {
			$add_slide = 'coordinate-column';
		}

		if ( empty( mode_get_options( 'coordinates_headline_eng' ) ) ) {
			$class = 'default';
		} else {
			$class = 'small';
		}
		?>

		<section class="section-home cordinates">

			<div class="column1120">

				<div class="entryhead">
				<?php if ( ! empty( mode_get_options( 'coordinates_headline_eng' ) ) ) : ?>
					<div class="en"><?php echo esc_html( mode_get_options( 'coordinates_headline_eng' ) ); ?></div>
				<?php else : ?>
					<div class="en">COORDINATE</div>
				<?php endif; ?>
				<?php if ( ! empty( mode_get_options( 'coordinates_headline' ) ) ) : ?>
					<h1 class="small"><?php echo esc_html( mode_get_options( 'coordinates_headline' ) ); ?></h1>
				<?php else : ?>
					<h1 class="small"><?php echo esc_html__( 'Coordinate', 'welcart_mode' ); ?></h1>
				<?php endif; ?>
				</div>

				<div class="entrybody <?php echo esc_attr( $add_slide ); ?> column-grid column-grid<?php echo esc_attr( $column ); ?>" data-column="<?php echo esc_attr( $column ); ?>">
					<?php
					while ( $coord_query->have_posts() ) {
						$coord_query->the_post();

						get_template_part( 'template-parts/loop/coordinate' );

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
