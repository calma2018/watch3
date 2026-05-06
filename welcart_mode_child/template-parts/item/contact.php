<?php
/**
 * 商品詳細：お問い合わせブロック（モーダル版）
 */

$tel_number = '06-4400-9560';

// 既存：受注対応商品ラベル（必要なら表示条件を付けてください）
?>
<div class="p-itemBackorder">
  <span>受注対応商品</span>
</div>

<div class="p-itemContact">
  <div class="p-itemContact__caption">
    <span>価格交渉、来店予約、海外発送、</span>など<br>お気軽にご相談ください
  </div>

  <!-- ✅ ここが「問い合わせする」ボタン（クリックでモーダル表示） -->
  <div class="p-itemContact__single">
    <button
      type="button"
      class="p-itemContact__openModal"
      data-contact-modal-open
      aria-haspopup="dialog"
      aria-controls="contactModal"
    >
      問い合わせする
    </button>
  </div>

  <div class="p-itemContact__remarks">※英語・中国語対応OK</div>

  <?php
    // ✅ モーダル本体を読み込む
    get_template_part(
      'template-parts/item/contact-modal',
      null,
      array(
        'tel_number' => $tel_number,
      )
    );
  ?>
</div>