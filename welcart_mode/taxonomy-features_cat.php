<?php
/**
 * Taxonomy Template for Features Category
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<header class="entry-head default">
		<h1><?php single_term_title(); ?></h1>
	</header>


	<?php if ( have_posts() ) : ?>

		<div class="list-info">
			<?php
			$count_num = $wp_query->found_posts;
				echo '<div class="count-items"><span class="num">' . esc_html( $count_num ) . '</span>items</div>';
			?>
			<div class="inbox">
				<?php
					$current_page = 0 === get_query_var( 'paged' ) ? '1' : get_query_var( 'paged' );
					$max_pages    = $wp_query->max_num_pages;
					echo '<div class="pages-info">Page ' . esc_html( $current_page ) . ' of ' . esc_html( $max_pages ) . '</div>';
				?>
				<?php
					$gqv_order = get_query_var( 'order' ) ? get_query_var( 'order' ) : '';
					$new_class = ( ! empty( $gqv_order ) && 'DESC' === $gqv_order ) ? ' selected' : '';
					$old_class = ( ! empty( $gqv_order ) && 'ASC' === $gqv_order ) ? ' selected' : '';
				?>
				<nav class="new-old">
					<select name="select" onChange="location.href=value;">
						<option value="<?php echo esc_url( add_query_arg( 'order', 'DESC', get_post_type_archive_link( 'features' ) ) ); ?>"<?php echo esc_attr( $new_class ); ?>><?php esc_html_e( 'Newest Date', 'welcart_mode' ); ?></option>
						<option value="<?php echo esc_url( add_query_arg( 'order', 'ASC', get_post_type_archive_link( 'features' ) ) ); ?>"<?php echo esc_attr( $old_class ); ?>><?php esc_html_e( 'Oldest Date', 'welcart_mode' ); ?></option>
					</select>
				</nav>
			</div >
		</div>

		<div class="entrybody features-column layout-grid layout-grid-column3">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop/feature' );
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
		echo '<div class="pagination-wrap bottom">' . wp_kses_post( $paginate_links ) . '</div>';
	}
	?>

<?php
get_footer();
