<?php
/**
 * Archive Template for Coordinates
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<?php
	if ( empty( mode_get_options( 'coordinates_headline_eng' ) ) ) {
		$class = 'default';
	} else {
		$class = 'small';
	}
	?>
	<header class="entry-head title-<?php echo esc_attr( $class ); ?>">
		<?php if ( ! empty( mode_get_options( 'coordinates_headline_eng' ) ) ) : ?>
			<div class="en"><?php echo esc_html( mode_get_options( 'coordinates_headline_eng' ) ); ?></div>
		<?php else : ?>
			<div class="en">COORDINATE</div>
		<?php endif; ?>
		<?php if ( ! empty( mode_get_options( 'coordinates_headline' ) ) ) : ?>
			<h1><?php echo esc_html( mode_get_options( 'coordinates_headline' ) ); ?></h1>
		<?php else : ?>
			<h1 class="be_small"><?php echo esc_html__( 'Coordinate', 'welcart_mode' ); ?></h1>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="entrybody coordinate-column column-grid column-grid4">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/loop/coordinate' );
				endwhile;
			?>
		</div>

	<?php else : ?>

		<p class="no-date"><?php __( 'No posts found.', 'usces' ); ?></p>

	<?php endif; ?>

	<?php
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
