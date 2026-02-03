<?php
/**
 * The Product List template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

$posts_cont = mode_get_options( 'posts_cont' );

if ( ! is_array( $posts_cont ) ) {
	$posts_cont = array();
}

$archives_cont = mode_get_options( 'archives_cont' );

if ( ! is_array( $archives_cont ) ) {
	$archives_cont = array();
}

if ( is_category() ) :
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
		<a href="<?php the_permalink(); ?>">

			<div class="in">
			<?php
			if ( in_array( 'thumbnail', $archives_cont, true ) ) :
				if ( has_post_thumbnail() ) {
					$img_id  = get_post_thumbnail_id();
					$img_url = wp_get_attachment_image_src( $img_id, true );
					echo '<div class="img bg-img" style="background-image: url( ' . esc_url( $img_url[0] ) . ' );"></div>';

				} else {

					echo '<div class="img no-img"><img src="' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . '" alt="noimage" /></div>';

				}
				?>
				<div class="info">
				<?php
				if ( in_array( 'title', $archives_cont, true ) ) {
					echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
				}
				/* Display The Excerpt */
				if ( in_array( 'excerpt', $archives_cont, true ) ) {
					if ( has_excerpt() ) {
						the_excerpt();
					}
				}
				/* Display Date */
				if ( in_array( 'date', $archives_cont, true ) ) {
					echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
				}
				?>
				</div>
			<?php else : ?>
				<div class="info">
				<?php
				/* Display Date */
				if ( in_array( 'date', $archives_cont, true ) ) {
					echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
				}
				if ( in_array( 'title', $posts_cont, true ) ) {
					echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
				}
				/* Display The Excerpt */
				if ( in_array( 'excerpt', $archives_cont, true ) ) {
					if ( has_excerpt() ) {
						the_excerpt();
					}
				}
				?>
				</div>
			<?php endif; ?>
			</div>

		</a>
	</article>

<?php else : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
		<a href="<?php the_permalink(); ?>">

			<div class="in">
				<?php
				if ( in_array( 'thumbnail', $posts_cont, true ) ) :
					if ( has_post_thumbnail() ) {
						$img_id  = get_post_thumbnail_id();
						$img_url = wp_get_attachment_image_src( $img_id, 'medium', true );
						echo '<div class="img bg-img" style="background-image: url( ' . esc_url( $img_url[0] ) . ' );"></div>';

					} else {

						echo '<div class="img no-img"><img src="' . esc_url( get_theme_file_uri( 'assets/images/no-image.jpg' ) ) . '" alt="noimage" /></div>';

					}
					?>
					<div class="info">
						<?php
						if ( in_array( 'title', $posts_cont, true ) ) {
							echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
						}
						/* Display The Excerpt */
						if ( in_array( 'excerpt', $posts_cont, true ) ) {
							if ( has_excerpt() ) {
								the_excerpt();
							}
						}
						/* Display Date */
						if ( in_array( 'date', $posts_cont, true ) ) {
							echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
						}
						?>
					</div>
				<?php else : ?>
					<div class="info">
						<?php
						/* Display Date */
						if ( in_array( 'date', $posts_cont, true ) ) {
							echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
						}
						if ( in_array( 'title', $posts_cont, true ) ) {
							echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
						}
						/* Display The Excerpt */
						if ( in_array( 'excerpt', $posts_cont, true ) ) {
							if ( has_excerpt() ) {
								the_excerpt();
							}
						}
						?>
					</div>
				<?php endif; ?>

			</div>
		</a>
	</article>

	<?php
endif;
