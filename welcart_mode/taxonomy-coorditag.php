<?php
/**
 * Taxonomy Template for Coordinate tag
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<header class="entry-head title-small">
		<?php
			$term_id = get_queried_object_id();
			$term    = get_term( $term_id );
		?>
		<h1 class="coordinate-tag-title">
		<?php
		$term_name = $term->name;
		echo esc_html( $term_name );
		?>
		</h1>
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

	get_footer();
