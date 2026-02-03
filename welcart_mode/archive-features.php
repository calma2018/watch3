<?php
/**
 * Archive Template for Features
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();

$index_layout    = mode_get_options( 'features_index_layout' );
$target_post     = get_post_type_object( $post_type )->name;
$target_post_cat = 'features_cat';

$current_page = get_query_var( 'paged' );
?>

	<header class="entry-head title-small">
		<div class="en">FEATURES</div>
		<h1><?php esc_html_e( 'Feature', 'welcart_mode' ); ?></h1>
	</header>

	<?php
	if ( 'section-layout' === $index_layout ) :

		$post_count = mode_get_options( 'archive_features_num' );
		$cat_args   = array(
			'parent'         => 0,
			'posts_per_page' => $post_count,
			'hierarchical'   => 0,
		);
		$child_cats = get_terms( $target_post_cat, $cat_args );
		foreach ( $child_cats as $child_cat ) :
			$child_cat_name  = esc_html( $child_cat->name );
			$target_cat_slug = esc_html( $child_cat->slug );
			$target_cat_link = get_category_link( $child_cat->term_id );
			?>

		<div class="features-block">
			<div class="sub-header">
				<h2 class="sub-title"><?php echo esc_html( $child_cat_name ); ?></h2>
			</div>
			<?php
				$args           = array(
					'post_type'      => array( $target_post ),
					'taxonomy'       => $target_post_cat,
					'term'           => $target_cat_slug,
					'post_status'    => 'publish',
					'posts_per_page' => $post_count,
				);
				$features_query = new WP_Query( $args );
				if ( $features_query->have_posts() ) {
					?>
				<div class="entrybody features-column layout-grid layout-grid-column3">
					<?php
					while ( $features_query->have_posts() ) :
						$features_query->the_post();
						get_template_part( 'template-parts/loop/feature' );
					endwhile;
					?>
				</div>
					<?php
				}
				?>

			<div class="entryfoot">
				<div class="more">
					<a title="<?php esc_html_e( 'View list', 'welcart_mode' ); ?>" href="<?php echo esc_attr( $target_cat_link ); ?>">
						<span class="label"><?php esc_html_e( 'View list', 'welcart_mode' ); ?></span>
					</a>
				</div>
			</div>

		</div>
			<?php
		endforeach;
	else :
		?>

		<?php if ( have_posts() ) : ?>

			<div class="list-info">
				<?php
				$count_custom  = wp_count_posts( 'features' );
					$count_num = $count_custom->publish;
					echo '<div class="count-items"><span class="num">' . esc_html( $count_num ) . '</span>items</div>';
				?>
				<div class="inbox">
					<?php
						$current_page = 0 === $current_page ? '1' : $current_page;
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
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/loop/feature' );
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
	endif;
	get_footer();
