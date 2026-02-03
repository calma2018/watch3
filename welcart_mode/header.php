<?php
/**
 * Header Template
 *
 * @package Welcart
 * @subpackage welcart_mode
 * @since 1.0.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="format-detection" content="telephone=no"/>
		<?php wp_head(); ?>
	</head>

	<?php
		$lang = 'lang-' . get_bloginfo( 'language' );
	?>
	<body <?php body_class( $lang ); ?>>

		<?php wp_body_open(); ?>

		<div id="site">

		<?php
		if ( true === mode_get_options( 'fixed_header' ) ) {
			$fixedHeader = 'header-group fixed_header';
		} else {
			$fixedHeader = 'header-group';
		}
		?>
			<header id="site-header" class="<?php echo esc_attr( $fixedHeader ); ?>" role="banner">

			<?php if ( defined( 'WCEX_WIDGET_CART' ) && true === mode_get_options( 'widget_cart_header' ) ) : ?>
				<input type="checkbox" id="widget_cart_open">
				<div class="view-cart">
					<div class="column1120">
						<label class="widgetcart-close-btn" for="widget_cart_open"><span class="bar"></span><span class="bar"></span></label>
						<div id="wgct_row"><?php echo widgetcart_get_cart_row(); ?></div>
					</div>
				</div><!-- .view-cart -->
			<?php endif; ?>

				<div class="header_inner">

					<?php welcart_mode_site_description(); ?>
					<div class="site-branding">
						<?php welcart_mode_title_logo(); ?>
					</div><!-- .site-branding -->

					<div class="drawer-sp">

						<input type="checkbox" class="open-check open-check-sp" id="open-check-sp">
						<label class="trigger-menu" for="open-check-sp">
							<?php get_template_part( 'template-parts/nav/menu-trigger' ); ?>
						</label>

						<div class="drawer-menu-sp">
							<div class="in">

								<?php
								$global_menu = 'global-menu';
								if ( has_nav_menu( $global_menu ) ) {
									welcart_mode_global_navigation();
								}
								?>

								<div class="drawer-menu-pc">

									<input type="checkbox" class="open-check open-check-pc" id="open-check-pc">
									<label class="trigger-menu" for="open-check-pc">
										<?php get_template_part( 'template-parts/nav/menu-trigger' ); ?>
									</label>

									<div class="in">
										<?php
										$sub_menu = 'sub-menu';
										if ( has_nav_menu( $sub_menu ) ) {

											echo '<nav id="sub-navigation" class="sub-navigation">';
											$args = array(
												'theme_location' => $sub_menu,
											);
											wp_nav_menu( $args );
											echo '</nav>';

										}
										?>

										<div class="shopping-navigation">
											<?php welcart_mode_header_search_form(); ?>
											<div class="membership">
											<?php if ( usces_is_login() ) : ?>
												<ul>
													<li><?php /* translators: */ printf( esc_html__( 'Hello %s', 'usces' ), esc_html( usces_the_member_name( 'return' ) ) ); ?></li>
													<li><a href="<?php echo esc_url( USCES_MEMBER_URL ); ?>"><?php esc_html_e( 'My page', 'welcart_mode' ); ?></a></li>
													<li><?php usces_loginout(); ?></li>
													<?php do_action( 'usces_theme_login_menu' ); ?>
												</ul>
											<?php else : ?>
												<ul>
													<li><?php esc_html_e( 'guest', 'usces' ); ?></li>
													<li><?php usces_loginout(); ?></li>
													<li><a href="<?php echo esc_url( USCES_NEWMEMBER_URL ); ?>"><?php esc_html_e( 'New Membership Registration', 'usces' ); ?></a></li>
												</ul>
											<?php endif; ?>
											</div>
										</div>

									</div><!-- .in -->
								</div><!-- .drawer-menu-pc -->

							</div><!-- .in -->
						</div><!-- .drawer-menu-sp -->

					</div><!-- .drawer-sp -->

					<?php if ( ! ( defined( 'WCEX_WIDGET_CART' ) && true === mode_get_options( 'widget_cart_header' ) ) ) : ?>
						<div class="incart">
							<div class="in">
								<a href="<?php echo esc_url( USCES_CART_URL ); ?>">
									<span class="welicon-shopping-cart"></span>
									<span class="total-quantity"><?php usces_totalquantity_in_cart(); ?></span>
								</a>
							</div>
						</div><!-- .incart -->
					<?php else : ?>
						<div class="incart widgetcart">
							<div class="in">
								<label for="widget_cart_open" class="widget_cart_button">
									<span class="welicon-shopping-cart"></span>
									<span class="total-quantity"><?php usces_totalquantity_in_cart(); ?></span>
								</label>
							</div>
						</div><!-- .widgetcart -->
						<div id="wgct_alert"></div>
					<?php endif; ?>

				</div><!-- header_inner -->

			</header><!-- #site-header -->

			<?php
			$class            = '';
			$is_secondary     = welcart_mode_secondary();
			$secondary_layout = mode_get_options( 'sidebar_layout' );
			if ( $is_secondary ) {
				$class .= 'site-column2';
			} else {
				$class .= 'site-column1';
			}
			if ( 'position-left' === $secondary_layout ) {
				$class .= ' position-left';
			} else {
				$class .= ' position-right';
			}
			?>
			<main class="<?php echo esc_attr( $class ); ?>" role="main">

				<?php
				if ( is_home() || is_front_page() ) :
					$headers       = get_uploaded_header_images();
					$headers_count = count( $headers );
					?>

					<div id="key" class="home-slide-container">
					<?php
					if ( $headers ) :
						if ( $headers_count > 0 ) :
							?>

							<div class="slider">
								<?php
								foreach ( $headers as $key => $value ) :
									$img_id      = $value['attachment_id'];
									$img_width   = ( ! empty( $value['width'] ) ) ? ' width=' . $value['width'] . '' : '';
									$img_height  = ( ! empty( $value['height'] ) ) ? ' height=' . $value['height'] . '' : '';
									$img_meta    = get_post( $img_id );
									$img_caption = $img_meta->post_excerpt;
									$img_alt     = $value['alt_text'];
									$img_link    = $img_meta->link_url;
									?>
									<div class="list">
										<?php if ( ! empty( $img_link ) ) : ?>
											<a href="<?php echo esc_url( $img_link ); ?>">
										<?php endif; ?>
										<figure>
											<img src="<?php echo esc_url( $value['url'] ); ?>"<?php echo esc_attr( $img_width ); ?><?php echo esc_attr( $img_height ); ?> alt="<?php echo esc_attr( $img_alt ); ?>" />
										</figure>
										<?php if ( $img_alt || $img_caption ) : ?>
											<div class="slide-content">
												<?php
												if ( $img_alt ) {
													echo '<div class="headline"><strong>' . esc_html( $img_alt ) . '</strong></div>';
												}
												if ( $img_caption ) {
													echo '<p>' . wp_kses_post( $img_caption ) . '</p>';
												}
												?>
											</div>
										<?php endif; ?>
										<?php if ( ! empty( $img_link ) ) : ?>
											</a>
										<?php endif; ?>
									</div>
									<?php
								endforeach;
								?>
							</div>
							<?php
						endif;
					else :
						?>
						<?php if ( get_header_image() ) : ?>
							<div class="default-head-img"><img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php bloginfo( 'name' ); ?>"></div>
						<?php endif; ?>
					<?php endif; ?>
					</div>

				<?php endif; ?>

				<div id="primary" class="site-content">

					<div id="content" role="main">
