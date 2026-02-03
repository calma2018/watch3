<?php
/**
 * The template for features' displaying content
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

$features_cont = mode_get_options( 'features_cont' );

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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div id="itemimg" class="eyecatch">
		<?php
		if ( has_post_thumbnail() ) {

			the_post_thumbnail( 'large' );

		}
		?>
	</div><!-- #itemimg -->

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php
		if ( in_array( 'date', $features_cont, true ) ) {
			echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
		}
		?>

		<?php
		if ( in_array( 'term', $features_cont, true ) ) {
			if ( ! empty( $tags ) ) {
				echo '<div class="tag">' . wp_kses_post( $tags ) . '</div>';
			}
		}
		?>

	</header>

	<section class="is-features">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<div class="entry-footer"></div>
	</section>

</article>
