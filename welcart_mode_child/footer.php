<?php
/**
 * Footer Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

?>

<!-- ★追加: Instagramフィードを表示 -->
<?php if ( ! is_page() ) : ?>
  <div class="l-container">
		<div class="p-instagramFeed">
			<h2 class="p-instagramFeed__title">INSTAGRAM</h2>
    <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
		</div>
  </div>
<?php endif; ?>
<!-- ★追加：ここまで -->

<!-- ★追加: Google翻訳 -->
<div class="p-translateFixed">
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'ja', // 元のページの言語コード
    includedLanguages: 'ja,en,ko,zh-CN,zh-TW', // 表示する言語をカンマ区切りで指定（空欄なら全言語）
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</div>
<!-- ★追加：ここまで -->


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
					<!-- ★追加： TikTok -->
						<li class="tiktok"><a href="https://www.tiktok.com/@watch3983?_r=1&_t=ZS-919yraoULBQ" target="_blank" rel="nofollow"><span class="tiktok-svg"></span></a></li>
					<!-- ★追加： ここまで -->
					<?php if ( mode_get_options( 'youtube_button' ) ) : ?>
						<li class="youtube"><a href="https://www.youtube.com/channel/<?php mode_options( 'youtube_id' ); ?>" target="_blank" rel="nofollow"><span class="youtube-svg"></span></a></li>
					<?php endif; ?>
					<?php if ( mode_get_options( 'line_button' ) ) : ?>
					<!-- ★追加： LINE 遷移先の出し分け -->
						<?php
						if ( is_front_page() ) {
							$line_url = 'https://form.lmes.jp/landing-qr/2008493659-RGkPB6ZP?uLand=Ibqxra'; // フロント用
						} elseif ( is_page( 'brand' ) ) {
							$line_url = 'https://form.lmes.jp/landing-qr/2008493659-RGkPB6ZP?uLand=2PuILT'; // brand用
						} else {
							$line_url = 'https://form.lmes.jp/landing-qr/2008493659-RGkPB6ZP?uLand=AVWf2v'; // その他ページ用 
						}
						?>

						<li class="line">
							<a href="<?php echo esc_url( $line_url ); ?>" target="_blank" rel="nofollow">
								<span class="line-svg"></span>
							</a>
						</li>
					<!-- ★追加： ここまで -->
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
