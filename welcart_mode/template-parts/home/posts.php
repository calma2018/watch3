<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

if ( mode_get_options( 'display_posts' ) ) :
	$posts_num  = mode_get_options( 'posts_num' );
	$posts_slug = mode_get_options( 'posts_category' );
	$posts_cat  = get_term_by( 'slug', $posts_slug, 'category' );
	if ( $posts_cat ) :
		$category_id       = $posts_cat->term_id;
		$category_name     = $posts_cat->name;
		$category_name_eng = get_term_meta( $category_id, 'name_eng', true );
		$sticky            = get_option( 'sticky_posts' );
		?>

		<section class="section-home posts">

			<div class="column1120">

				<div class="entryhead">
					<?php if ( $category_name_eng ) : ?>
						<div class="en"><?php echo esc_html( $category_name_eng ); ?></div>
						<h1 class="small"><?php echo esc_html( $category_name ); ?></h1>
					<?php else : ?>
						<h1 class="normal"><?php echo esc_html( $category_name ); ?></h1>
					<?php endif; ?>
				</div>

				<?php
				$class      = '';
				$column     = mode_get_options( 'posts_list_column' );
				$posts_cont = mode_get_options( 'posts_cont' );
				if ( ! is_array( $posts_cont ) ) {
					$posts_cont = array();
				}
				$class .= ' layout-list-column' . $column;
				if ( ! in_array( 'thumbnail', $posts_cont, true ) ) {
					$class .= ' not-thumbnail';
				}
				if ( 1 === $column ) {
					$class .= ' column980';
				}
				?>
				<div class="entrybody layout-list layout-list2 <?php echo esc_attr( $class ); ?>">

				<?php
				if ( ! empty( $sticky ) ) {
					$posts_num -= count( $sticky );
				}
				if ( count( $sticky ) > 0 ) {
					$posts_args  = array(
						'category_name'  => $posts_slug,
						'post__in'       => $sticky,
						'posts_per_page' => mode_get_options( 'posts_num' ),
					);
					$posts_query = new WP_Query( $posts_args );
					if ( $posts_query->have_posts() ) {
						while ( $posts_query->have_posts() ) {
							$posts_query->the_post();
							get_template_part( 'template-parts/loop/post' );
						}
					}
				}
				if ( $posts_num > 0 ) {
					$posts_args  = array(
						'post__not_in'        => $sticky,
						'category_name'       => $posts_slug,
						'posts_per_page'      => $posts_num,
						'ignore_sticky_posts' => 1,
					);
					$posts_query = new WP_Query( $posts_args );
					if ( $posts_query->have_posts() ) {
						while ( $posts_query->have_posts() ) {
							$posts_query->the_post();
							get_template_part( 'template-parts/loop/post' );
						}
					}
				}
					wp_reset_postdata();
				?>
				</div>

				<div class="entryfoot">
					<div class="more"><a title="<?php esc_html_e( 'View list', 'welcart_mode' ); ?>" href="<?php echo esc_url( get_category_link( $category_id ) ); ?>"><span class="label"><?php esc_html_e( 'View list', 'welcart_mode' ); ?></span></a></div>
				</div>

			</div>

		</section>

		<?php
	endif;
endif;
