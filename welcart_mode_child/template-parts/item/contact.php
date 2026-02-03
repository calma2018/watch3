<?php
/**
 * 商品詳細：お問い合わせブロック
 */

$tel_number = '06-4400-9560';
?>

<div class="p-itemBackorder">
  <span>受注対応商品</span>
</div>


<div class="p-itemContact">
  <div class="p-itemContact__caption">
    <span>価格交渉、来店予約、海外発送、</span>など<br>お気軽にご相談ください
  </div>

  <ul class="p-itemContact__action">
    <li class="p-itemContact__action_btn">
      <a href="https://bit.ly/4oenBvn" data-contacttype="line" target="_blank" rel="noopener">
        <div>
          <em>LINE</em>で相談する
        </div>
      </a>
    </li>
    <li class="p-itemContact__action_btn">
      <a href="tel:<?php echo esc_attr( $tel_number ); ?>" data-contacttype="tel">
        <div>
          <em>電話</em>で相談する
          <span class="p-itemContact__action_btn_telnum u-show--pc">
            <?php echo esc_html( $tel_number ); ?>
          </span>
        </div>
      </a>
    </li>
  </ul>

  <div class="p-itemContact__remarks">※英語・中国語対応OK</div>
</div>
