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

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php if ( is_single() ) : ?>

		<?php if ( has_post_thumbnail() && 'display' === mode_get_options( 'display_post_thumbnail' ) ) : ?>
			<div class="entry-img"><?php the_post_thumbnail( 'full' ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	<div class="entry-content">

		<?php the_content( __( '(more...)' ) ); ?>

	</div><!-- .entry-content -->

	<?php if ( ! ( usces_is_item() || welcart_mode_is_cart_page() || welcart_mode_is_member_page() ) ) : ?>
		<div class="entry-meta">
			<?php if ( ! is_page() ) : ?>
				<span class="date"><span class="welicon-date"></span><time><?php the_date(); ?></time></span>
				<?php
			endif;
			if ( get_the_category() ) :
				?>
				<span class="cat"><span class="welicon-category"></span><?php the_category( ',' ); ?></span>
				<?php
			endif;
			if ( get_the_tags() ) :
				?>
				<span class="tag"><span class="welicon-tag"></span><?php the_tags( '' ); ?></span>
				<?php
				endif;
			if ( ! is_page() ) :
				?>
			<span class="author"><span class="welicon-user"></span><?php the_author(); ?><?php edit_post_link( __( 'Edit This' ) ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</article>
