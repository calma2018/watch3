<?php
/**
 * Taxonomy Template for Model
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<header class="entry-head title-small model-list-header">
		<?php
		$term_id      = get_queried_object_id();
		$model_img_id = get_term_meta( $term_id, 'model-img-id', true );
		if ( ! empty( $model_img_id ) ) {
			$img_att = wp_get_attachment_image( $model_img_id, 'thumbnail' );
			$img_url = $img_att[0];
			if ( ! empty( $img_att ) ) {
				echo '<div class="thumbnail">' . wp_kses_post( $img_att ) . '</div>';
			}
		}
		$term = get_term( $term_id );
		?>
		<div class="inside">
			<h1 class="model-name">
			<?php
			$term_name = $term->name;
			echo esc_html( $term_name );
			?>
			</h1>
			<?php
			$model_type   = get_term_meta( $term_id, 'model_type', true );
			$model_height = get_term_meta( $term_id, 'model_height', true );
			if ( $model_type || $model_height ) :
				echo '<p class="model-info">(';
				if ( $model_type ) {
					echo '<span class="type">' . esc_html( $model_type ) . '</span>';
				}
				if ( $model_height ) {
					echo '<span class="height">' . esc_html( $model_height ) . 'cm</span>';
				}
				echo ')</p>';
			endif;
			?>
		</div>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="entrybody coordinate-column column-grid column-grid4">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop/coordinate' );
			}
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
		echo '<div class="pagination-wrap bottom">' . esc_url( $paginate_links ) . '</div>';
	}
	?>

<?php
get_footer();
