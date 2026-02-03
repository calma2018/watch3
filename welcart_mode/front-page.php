<?php
/**
 * Home Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<?php if ( 'page' === get_option( 'show_on_front' ) ) : ?>

		<?php
		/* Home Widget Area 1 */
		if ( is_active_sidebar( 'home-widgetarea1' ) ) {
			dynamic_sidebar( 'home-widgetarea1' );
		}
		?>

		<section class="section-home show-on-front">
			<div class="column1120">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

							<div class="entryhead">
								<h1 class="normal"><?php esc_html_e( 'Brand', 'welcart_mode' ); ?></h1>
							</div>

							<div class="entry-content">
								<?php the_content(); ?>
							</div>

						</article>
						<?php
					endwhile;
				else :
					?>

					<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

				<?php endif; ?>
			</div>
		</section>

		<?php
		/* Home Widget Area 5 */
		if ( is_active_sidebar( 'home-widgetarea5' ) ) {
			dynamic_sidebar( 'home-widgetarea5' );
		}

		?>

	<?php else : ?>

		<?php

		/* Home Widget Area 1 */
		if ( is_active_sidebar( 'home-widgetarea1' ) ) {
			dynamic_sidebar( 'home-widgetarea1' );
		}

		get_template_part( 'template-parts/home/features' );

		/* Home Widget Area 2 */
		if ( is_active_sidebar( 'home-widgetarea2' ) ) {
			dynamic_sidebar( 'home-widgetarea2' );
		}

		get_template_part( 'template-parts/home/coordinates' );

		/* Home Widget Area 3 */
		if ( is_active_sidebar( 'home-widgetarea3' ) ) {
			dynamic_sidebar( 'home-widgetarea3' );
		}

		get_template_part( 'template-parts/home/brand' );

		/* Home Widget Area 4 */
		if ( is_active_sidebar( 'home-widgetarea4' ) ) {
			dynamic_sidebar( 'home-widgetarea4' );
		}

		get_template_part( 'template-parts/home/posts' );

		/* Home Widget Area 5 */
		if ( is_active_sidebar( 'home-widgetarea5' ) ) {
			dynamic_sidebar( 'home-widgetarea5' );
		}

		?>

	<?php endif; ?>

<?php
get_footer();
