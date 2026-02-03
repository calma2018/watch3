<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

if ( mode_get_options( 'display_brand' ) ) :

	$args  = array(
		'hide_empty' => false,
	);
	$terms = get_terms( 'brand', $args );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
		$column = mode_get_options( 'brand_column' )
		?>

		<section class="section-home brand">

			<div class="column1120">

				<div class="entryhead">
					<div class="en">BRAND</div>
					<h1 class="small"><?php esc_html_e( 'Brand', 'welcart_mode' ); ?></h1>
				</div>

				<div class="entrybody column-grid column-grid<?php echo esc_attr( $column ); ?>">
					<?php
					if ( welcart_mode_brand() ) {
						echo wp_kses_post( welcart_mode_brand() );
					}
					?>
				</div>

				<?php
				if ( check_page_exist( 'brand' ) ) :
					$page_brand = get_page_by_path( 'brand' );
					$page_brand = $page_brand->ID;
					?>
					<div class="entryfoot">
						<div class="more"><a title="<?php esc_html_e( 'View list', 'welcart_mode' ); ?>" href="<?php echo esc_url( get_permalink( $page_brand ) ); ?>"><span class="label"><?php esc_html_e( 'View list', 'welcart_mode' ); ?></span></a></div>
					</div>
				<?php endif; ?>

			</div>
		</section>

		<?php
	endif;
endif;
