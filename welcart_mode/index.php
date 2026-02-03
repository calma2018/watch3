<?php
/**
 * Index Template for Brand
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<?php
	/* Home Widget Area 1 */
	if ( is_active_sidebar( 'home-widgetarea1' ) ) {
		dynamic_sidebar( 'home-widgetarea1' );
	}
	?>

	<section class="section-home show-on-front-list">
		<div class="column1120">
			<div class="layout-list layout-list2 layout-list-column2">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'list' ); ?>>
						<a href="<?php the_permalink(); ?>">

							<div class="in">
								<?php
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
									echo '<h2 class="title">' . esc_html( get_the_title() ) . '</h2>';
									/* 抜粋文表示 */
									global $usces;
									remove_filter( 'the_excerpt', array( $usces, 'filter_cartContent' ), 20 );
									the_excerpt();
									/* 日付表示 */
									echo '<div class="data">' . esc_html( get_the_time( 'Y.n.j' ) ) . '</div>';
									?>
								</div>
							</div>
						</a>
					</article>

					<?php
				}
			} else {
				echo '<p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';
			}
			?>
		</div>
	</section>


	<?php
	/* Home Widget Area 5 */
	if ( is_active_sidebar( 'home-widgetarea5' ) ) {
		dynamic_sidebar( 'home-widgetarea5' );
	}
	?>

<?php
get_footer();
