<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

$coordinates_cont = mode_get_options( 'coordinate_list_cont' );
if ( ! is_array( $coordinates_cont ) ) {
	$coordinates_cont = array();
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
	<a href="<?php the_permalink(); ?>">
	<?php
	/* Display Title */
	if ( in_array( 'title', $coordinates_cont, true ) ) {
		the_title( '<p class="the_title">', '</p>' );
	}
		/* Display Eyecatch Image */
		echo '<div class="img square">';
	if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large' );
	} else {
		echo '<img src="' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . '" alt="noimage" />';
	}
	/* Display Date */
	if ( in_array( 'date', $coordinates_cont, true ) ) {
		echo '<date>' . esc_html( get_the_time( 'Y/m/d' ) ) . '</date>';
	}
		echo '</div>';
	if ( is_tax( 'model' ) ) {
		$coordinate_cont = mode_get_options( 'coordinate_list_cont' );
		if ( in_array( 'title', $coordinate_cont, true ) ) {
			echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
		}
		if ( in_array( 'excerpt', $coordinate_cont, true ) ) {
			if ( has_excerpt() ) {
				the_excerpt();
			}
		}
		if ( in_array( 'date', $coordinate_cont, true ) ) {
			echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
		}
	} else {
		if ( 'show' === mode_get_options( 'display_model_info' ) ) {
			/* Display The Model Information */
			$model_info = welcart_mode_model_info();
			if ( ! empty( $model_info ) ) {
				echo wp_kses_post( $model_info );
			}
		}
	}
	?>
	</a>
</article>
