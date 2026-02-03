<?php
/**
 * Footer Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

?>

					</div><!-- #content -->

					<?php
					$is_secondary = welcart_mode_secondary();
					if ( $is_secondary ) {
						get_sidebar();
					}
					?>
				</div>

			</main>

			<div id="toTop" class="wrap fixed"><a href="#masthead"><span class="welicon-chevron-top"></span></a></div>

			<footer id="site-footer" role="contentinfo" class="footer-group">

				<div class="in">

				<?php if ( mode_get_options( 'facebook_button' ) || mode_get_options( 'twitter_button' ) || mode_get_options( 'instagram_button' ) || mode_get_options( 'youtube_button' ) || mode_get_options( 'line_button' ) ) : ?>
					<ul class="shop-sns">
					<?php if ( mode_get_options( 'facebook_button' ) ) : ?>
						<li class="facebook"><a href="https://www.facebook.com/<?php mode_options( 'facebook_id' ); ?>" target="_blank" rel="nofollow"><span class="facebook-svg"></span></a></li>
					<?php endif; ?>
					<?php if ( mode_get_options( 'twitter_button' ) ) : ?>
						<li class="twitter"><a href="https://x.com/<?php mode_options( 'twitter_id' ); ?>" target="_blank" rel="nofollow"><span class="twitter-svg"></span></a></li>
					<?php endif; ?>
					<?php if ( mode_get_options( 'instagram_button' ) ) : ?>
						<li class="instagram"><a href="https://www.instagram.com/<?php mode_options( 'instagram_id' ); ?>" target="_blank" rel="nofollow"><span class="instagram-svg"></span></a></li>
					<?php endif; ?>
					<?php if ( mode_get_options( 'youtube_button' ) ) : ?>
						<li class="youtube"><a href="https://www.youtube.com/channel/<?php mode_options( 'youtube_id' ); ?>" target="_blank" rel="nofollow"><span class="youtube-svg"></span></a></li>
					<?php endif; ?>
					<?php if ( mode_get_options( 'line_button' ) ) : ?>
						<li class="line"><a href="<?php mode_options( 'line_id' ); ?>" target="_blank" rel="nofollow"><span class="line-svg"></span></a></li>
					<?php endif; ?>
					</ul><!-- .shop-sns -->
				<?php endif; ?>

					<nav id="footer-navigation" class="footer-navigation">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-menu',
									'depth'          => 1,
									'menu_class'     => 'footer-menu',
								)
							);
							?>
					</nav><!-- .sub-navigation -->

				</div><!-- .in -->

				<?php welcart_mode_copyright(); ?>

			</footer><!-- #site-footer -->

			<div class="drawe-bg-sp"></div>
			<div class="drawe-bg-pc"></div>

		</div><!-- #site -->

		<?php wp_footer(); ?>

	</body>
</html>
