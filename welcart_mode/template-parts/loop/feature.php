<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

if ( is_post_type_archive( 'features' ) || is_tax( 'features_cat' ) ) {
	$features_cont = mode_get_options( 'archive_features_cont' );
} else {
	$features_cont = mode_get_options( 'features_cont' );
}

if ( ! is_array( $features_cont ) ) {
	$features_cont = array();
}

$tags    = '';
$post_id = get_the_ID();
$terms   = get_the_terms( $post_id, 'features_cat' );
if ( $terms && ! ( is_wp_error( $terms ) ) ) {
	foreach ( $terms as $term ) {
		$tags .= '<span>' . esc_html( $term->name ) . '</span>';
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php
		if ( in_array( 'thumbnail', $features_cont, true ) ) {
			if ( has_post_thumbnail() ) {
				$img_id  = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src( $img_id, 'large', true );
				echo '<div class="img bg-img" style="background-image: url( ' . esc_url( $img_url[0] ) . ' );"></div>';

			} else {

				echo '<div class="img bg-img no-img" style="background-image: url( ' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . ' );"></div>';

			}
		}
		?>
		<div class="info">
			<?php
			if ( ! empty( $tags ) ) {
				if ( in_array( 'term', $features_cont, true ) ) {
					echo '<div class="tag">' . wp_kses_post( $tags ) . '</div>';
				}
			}
			if ( in_array( 'title', $features_cont, true ) ) {
				echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
			}
			/* Display The Excerpt */
			if ( in_array( 'excerpt', $features_cont, true ) ) {
				if ( has_excerpt() ) {
					the_excerpt();
				}
			}
			/* Display Date */
			if ( in_array( 'date', $features_cont, true ) ) {
				echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
			}
			?>
		</div>
	</a>
</article>
