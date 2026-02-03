<?php
/**
 * The default template for displaying content
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-head title-small">
		<div class="en">BRAND</div>
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		$args        = array(
			'taxonomy'   => 'brand',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
		);
		$brand_query = new WP_Term_Query( $args );
		if ( $brand_query && ! is_wp_error( $brand_query ) ) {
			$html  = '';
			$html .= '<div class="brand-list">';
			foreach ( $brand_query->get_terms() as $term ) {
				$html     .= '<div class="list">';
				$term_id   = $term->term_id;
				$term_name = $term->name;
				$img_url   = get_term_meta( $term_id, 'brand-img-url', true );
				$name_sub  = get_term_meta( $term_id, 'name_sub', 1 );
				$img_id    = get_term_meta( $term_id, 'brand-img-id', true );
				$img_att   = wp_get_attachment_image( $img_id, 'img300x200' );
				$img_url   = $img_att;
				$html     .= '<a href="' . get_term_link( $term_id ) . '">';
				if ( ! empty( $img_id ) ) {
					$html .= '<div class="img square">' . $img_att . '</div>';
				}
				$html .= '<div class="info">';
				$html .= '<div class="name">' . $term_name . '</div>';
				if ( ! empty( $name_sub ) ) {
					$html .= '<div class="name-sub">' . $name_sub . '</div>';
				}
				$html .= '</div>';
				$html .= '</a>';
				$html .= '</div>';
			}
			$html .= '</div>';
			echo wp_kses_post( $html );
		}
		?>
	</div>

</article>
