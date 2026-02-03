<?php
/**
 * The template for Coordinates' displaying content
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

$post_model_info  = mode_get_options( 'display_post_model_info' );
$post_model_items = mode_get_options( 'display_post_model_items' );

if ( ! is_array( $post_model_items ) ) {
	$post_model_items = array();
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	if ( 'show' === mode_get_options( 'display_coordinate_title' ) ) {
		echo '<div class="coordinate-header">';
		the_title( '<h1 class="entry-title">', '</h1>' );
		echo '</div>';
	}

	if ( ! empty( $post->post_content ) ) {
		echo '<div class="entry-content coordinate-content">';
		the_content();
		echo '</div>';
	}

	echo '<div id="itemimg" class="eyecatch">';
	if ( mode_get_options( 'display_coordinate_title' ) ) {
		echo '<div class="entry-img">';
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
		} else {
			echo '<img src="' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . '" alt="noimage" />';
		}
		echo '</div>';
	} else {
		echo '<h1 class="entry-img">';
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
		} else {
			echo '<img src="' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . '" alt="noimage" />';
		}
		echo '</h1>';
	}
	echo '</div>';
	?>

	<section class="is-coordniates coordinate-column">
		<?php
		$terms = get_the_terms( $post->ID, 'model' );
		if ( 'show' === $post_model_info && ! empty( $terms ) ) :
			?>
			<div class="model-block">
				<?php $terms = get_the_terms( $post->ID, 'model' ); ?>
				<a href="<?php echo esc_url( get_term_link( $terms[0]->term_id ) ); ?>">
					<div class="read"><?php esc_html_e( 'The Model Information', 'welcart_mode' ); ?></div>
					<?php
					$model_info = welcart_mode_model_info();
					if ( ! empty( $model_info ) ) {
						echo wp_kses_post( $model_info );
					}
					?>
				</a>
			</div>
		<?php endif; ?>

		<?php $subtitle = mode_get_options( 'display_coordinate_subtitle' ); if ( ! empty( $subtitle ) ) : ?>
			<header class="sub-header">
				<?php echo '<h2 class="sub-title">' . esc_html( $subtitle ) . '</h2>'; /* mode_coordinate_title */ ?>
			</header>
		<?php endif; ?>

		<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-content excerpt">
				<p><?php echo esc_html( $post->post_excerpt ); ?></p>
			</div>
		<?php endif; ?>

		<?php welcart_mode_coordinate_sku_details_list(); /* selected item list */ ?>
	</section>

	<section class="other-coordniates coordinate-column">
		<!-- ↓↓↓↓↓ Coordination list of the same model ↓↓↓↓↓ -->
		<?php
		if ( 'show' === mode_get_options( 'display_model_coordinates' ) ) {
			$terms = get_the_terms( $post->ID, 'model' );
			if ( $terms ) {
				foreach ( $terms as $term ) {
					$termslug = $term->slug;
					$termname = $term->name;
				}
				$args    = array(
					'post_type'      => 'coordinates',
					'taxonomy'       => 'model',
					'term'           => $termslug,
					'posts_per_page' => -1,
					'orderby'        => 'rand',
					'post__not_in'   => array( $post->ID ),
				);
				$myPosts = new WP_query( $args );
				if ( $myPosts->have_posts() ) :
					?>
					<div class="same_coordinate">
						<header class="sub-header">
							<h2 class="model_title">
								<?php
								echo esc_html( $termname );
								esc_html_e( 'of', 'welcart_mode' );
								if ( ! empty( mode_get_options( 'coordinates_headline' ) ) ) {
									echo esc_html( mode_get_options( 'coordinates_headline' ) );
								} else {
									echo esc_html__( 'Coordinate', 'welcart_mode' ); }
								?>
							</h2>
						</header>
						<ul>
						<?php
						while ( $myPosts->have_posts() ) :
							$myPosts->the_post();
							?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										echo '<div class="img square">';
										the_post_thumbnail( 'medium' );
										echo '</div>';
									} else {
										echo '<div class="img square"><img src="' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . '" alt="noimage" /></div>';
									}
									?>
									<p><?php the_title(); ?></p>
								</a>
							</li>
						<?php endwhile; ?>
						</ul>
					</div>
					<?php
				endif;
				wp_reset_postdata();
			}
		}
		?>
		<!-- ↑↑↑↑↑ Coordination list of the same model ↑↑↑↑↑ -->

		<!-- ↓↓↓↓↓ Coordination tag list ↓↓↓↓↓ -->
		<?php
		if ( 'show' === mode_get_options( 'display_coordinate_tags' ) ) :
			$terms = get_the_terms( $post->ID, 'coorditag' );
			if ( $terms ) :
				?>
				<div class="coordinate_cloud">
					<header class="sub-header">
						<h2 class="coord_tags">
						<?php
						if ( ! empty( mode_get_options( 'coordinates_headline' ) ) ) {
							echo esc_html( mode_get_options( 'coordinates_headline' ) );
						} else {
							echo esc_html__( 'Coordinate', 'welcart_mode' );
						}
						echo esc_html__( 'Search by', 'welcart_mode' );
						?>
						</h2>
					</header>
					<ul>
					<?php
					foreach ( $terms as $term ) :
						$term_link = get_term_link( $term );
						?>
						<li><a href="<?php echo esc_url( $term_link ); ?>"># <?php echo esc_html( $term->name ); ?></a></li>
					<?php endforeach ?>
					</ul>
				</div>
				<?php
			endif;
		endif;
		?>
		<!-- ↑↑↑↑↑ Coordination tag list ↑↑↑↑↑ -->
	</section>

</article>
