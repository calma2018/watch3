<?php
/**
 * 商品詳細：お問い合わせモーダル
 * 呼び出し元から $args['tel_number'] が渡される想定
 */

$tel_number = isset($args['tel_number']) ? (string) $args['tel_number'] : '';

// ▼リンクや画像は運用に合わせて差し替えてOK
$line_url = 'https://bit.ly/4oenBvn';
$whatsapp_url = 'https://wa.me/qr/RJPBHC4YVXMIE1';
$wechat_url   = 'http://weixin.qq.com/r/mp/TyNvd67E1fOqreoU93Zd';

// QR画像（必要なら child/assets/images/ に置いてパスを入れる）
$line_qr_img     = get_stylesheet_directory_uri() . '/images/qr_wechat.jpg';
$whatsapp_qr_img = get_stylesheet_directory_uri() . '/images/qr_whatsapp.jpg';
$wechat_qr_img   = get_stylesheet_directory_uri() . '/images/qr_wechat.jpg';
?>

<div class="c-modalOverlay" id="contactModalOverlay" data-contact-modal-overlay hidden></div>

<section
  class="c-modal"
  id="contactModal"
  role="dialog"
  aria-modal="true"
  aria-labelledby="contactModalTitle"
  hidden
  data-contact-modal
>
  <div class="c-modal__inner" role="document">
    <button type="button" class="c-modal__close" aria-label="閉じる" data-contact-modal-close>
      ×
    </button>

    <h2 class="c-modal__title" id="contactModalTitle">お問い合わせ方法を選択してください</h2>

    <div class="c-modal__grid">

      <!-- LINE -->
      <div class="c-modalCard">
        <div class="c-modalCard__head">LINE</div>

        <?php if ( ! empty($line_qr_img) ) : ?>
          <div class="c-modalCard__qr">
            <img src="<?php echo esc_url($line_qr_img); ?>" alt="LINEのQRコード">
          </div>
        <?php endif; ?>

        <a class="c-modalCard__btn" href="<?php echo esc_url($line_url); ?>" target="_blank" rel="noopener" data-contacttype="line">
          LINEで相談する
        </a>
      </div>

      <!-- WhatsApp -->
      <div class="c-modalCard">
        <div class="c-modalCard__head">WhatsApp</div>

        <?php if ( ! empty($whatsapp_qr_img) ) : ?>
          <div class="c-modalCard__qr">
            <img src="<?php echo esc_url($whatsapp_qr_img); ?>" alt="WhatsAppのQRコード">
          </div>
        <?php else : ?>
          <div class="c-modalCard__note">QR画像を設定すると表示できます</div>
        <?php endif; ?>

        <?php if ( ! empty($whatsapp_url) ) : ?>
          <a class="c-modalCard__btn" href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener" data-contacttype="whatsapp">
            WhatsAppで相談する
          </a>
        <?php else : ?>
          <span class="c-modalCard__btn is-disabled" aria-disabled="true">WhatsApp準備中</span>
        <?php endif; ?>
      </div>

      <!-- WeChat -->
      <div class="c-modalCard">
        <div class="c-modalCard__head">WeChat</div>

        <?php if ( ! empty($wechat_qr_img) ) : ?>
          <div class="c-modalCard__qr">
            <img src="<?php echo esc_url($wechat_qr_img); ?>" alt="WeChatのQRコード">
          </div>
        <?php else : ?>
          <div class="c-modalCard__note">QR画像を設定すると表示できます</div>
        <?php endif; ?>

        <?php if ( ! empty($wechat_url) ) : ?>
          <a class="c-modalCard__btn" href="<?php echo esc_url($wechat_url); ?>" target="_blank" rel="noopener" data-contacttype="wechat">
            WeChatで相談する
          </a>
        <?php else : ?>
          <span class="c-modalCard__btn is-disabled" aria-disabled="true">WeChat準備中</span>
        <?php endif; ?>
      </div>

      <!-- 電話 -->
      <div class="c-modalCard c-modalCard--wide">
        <div class="c-modalCard__head">電話</div>
        <?php if ( ! empty($tel_number) ) : ?>
          <a class="c-modalCard__btn" href="tel:<?php echo esc_attr($tel_number); ?>" data-contacttype="tel">
            電話で相談する（<?php echo esc_html($tel_number); ?>）
          </a>
          <div class="c-modalCard__note">平日土日祝日　10:00〜17:00</div>
        <?php else : ?>
          <span class="c-modalCard__btn is-disabled" aria-disabled="true">電話番号未設定</span>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>