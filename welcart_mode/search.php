<?php
/**
 * Search Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<header class="page-header">
		<h1 class="page-title"><?php /* translators: */ printf( esc_html__( 'Search Results for: %s', 'welcart_mode' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<?php if ( have_posts() ) : ?> 

		<div class="search-li type-grid">

			<?php
			$column = mode_get_options( 'item_list_column' );
			echo '<div class="product-group column-grid column-grid' . esc_attr( $column ) . '">';
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop/product' );
			}
			echo '</div>';
			?>

		</div><!-- .search-li -->

		<?php
		$args           = array(
			'type'      => 'list',
			'prev_text' => __( ' &laquo; ' ),
			'next_text' => __( ' &raquo; ' ),
		);
		$paginate_links = paginate_links( $args );
		if ( $paginate_links ) :
			?>
		<div class="pagination_wrapper">
			<?php echo wp_kses_post( paginate_links( $args ) ); ?>
		</div><!-- .pagination_wrapper -->
		<?php endif; ?>

	<?php else : ?>

		<p><?php echo esc_html__( 'No posts found.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
