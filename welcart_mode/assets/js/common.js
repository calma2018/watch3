( function( $ ) {

	$( function() {

		$( '.site-content input[type=checkbox]' ).after( '<span class="checkmark"></span>' );
		$( '.site-content input[type=radio]' ).after( '<span class="radiomark"></span>' );

	});


	$(function(){
		var selectBox = $('ul.is-child')
		var display = $('.selected-category')

		display.on('click',function(){
			selectBox.fadeToggle('fast');
			return false;
		})

	})

	// アドミンバーがある時のヘッダー固定
	$(window).scroll(function() {
	var sitetop = $(this).scrollTop();
		if ( sitetop < 46 ) {
			$('.admin-bar #site').addClass('loginbar');
		} else {
			$('.admin-bar #site').removeClass('loginbar');
		}
	});


	$( function() {
		var pair = location.search.substring(1).split('&');
		var arg = new Object;
		for( var i = 0; pair[i]; i++ ) {
			var kv = pair[i].split('=');
			arg[kv[0]] = kv[1];
		}
		if( undefined != arg.from_item && undefined != arg.from_sku ) {
			$('.wpcf7-submit').on('click', function() {
				var form = $(this).parents('form');
				form.attr('action', $(this).data('action'));
				$('<input>').attr({
					'type': 'hidden',
					'name': 'from_item',
					'value': arg.from_item
				}).appendTo(form);
				$('<input>').attr({
					'type': 'hidden',
					'name': 'from_sku',
					'value': arg.from_sku
				}).appendTo(form);
			});
		}
	});

	$( '#toTop' ).hide();
	$( window ).scroll( function () {
		if ( $( this ).scrollTop() > 100 ) {
			$( '#toTop' ).fadeIn();
		} else {
			$( '#toTop' ).fadeOut();
		}
	});

	$( '#toTop a' ).click( function() {
		var speed = 800;
		var href = $( this ).attr( "href" );
		var target = $( href === "#masthead" || href === "" ? 'html' : href );
		var position = target.offset().top;
		$( "html, body" ).animate( { scrollTop:position }, speed, "swing" );
		return false;
	});

} )( jQuery );

	// contact-modal
(function () {

  function initContactModal() {
    const modal   = document.querySelector('[data-contact-modal]');
    const overlay = document.querySelector('[data-contact-modal-overlay]');
    if (!modal || !overlay) return; // そのページにモーダルが無ければ何もしない

    // openerは複数対応（商品詳細内で複数置いてもOK）
    const openBtns  = document.querySelectorAll('[data-contact-modal-open]');
    const closeBtns = document.querySelectorAll('[data-contact-modal-close]');

    let lastFocused = null;

    function openModal() {
      lastFocused = document.activeElement;
      overlay.hidden = false;
      modal.hidden = false;
      document.documentElement.classList.add('is-modal-open');
    }

    function closeModal() {
      modal.hidden = true;
      overlay.hidden = true;
      document.documentElement.classList.remove('is-modal-open');
      if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
    }

    openBtns.forEach(btn => btn.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();
    }));

    overlay.addEventListener('click', closeModal);
    closeBtns.forEach(btn => btn.addEventListener('click', closeModal));

    document.addEventListener('keydown', function (e) {
      if (!modal.hidden && e.key === 'Escape') closeModal();
    });
  }

  // DOMがすでに出来てる場合にも確実に動く
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactModal);
  } else {
    initContactModal();
  }

})();

// Floating Add to Cart (Welcart)
// (function () {

//   function initFloatingCart() {

//     // ★Welcartのボタンは inCart[ID][SKU] 形式なので ^=
//     const realBtn =
//       document.querySelector('.cart-button input.skubutton[type="submit"]') ||
//       document.querySelector('input[type="submit"][id^="inCart["]') ||
//       document.querySelector('input[type="submit"][name^="inCart["]') ||
//       document.querySelector('input.usces_cart_button');

//     if (!realBtn) return;

//     // 二重生成防止
//     if (document.querySelector('.c-floatingCart')) return;

//     // バー生成（最初は表示）
//     const bar = document.createElement('div');
//     bar.className = 'c-floatingCart is-show';
//     bar.innerHTML = `
//       <div class="c-floatingCart__inner">
//         <button type="button" class="c-floatingCart__btn">カートへ入れる</button>
//       </div>
//     `;
//     document.body.appendChild(bar);

//     bar.querySelector('.c-floatingCart__btn').addEventListener('click', function () {
//       realBtn.click(); // onclick="uscesCart.intoCart(...)" が走る想定
//     });

//     // 本物ボタンが見えてる時は隠す
//     if (!('IntersectionObserver' in window)) return;

//     const io = new IntersectionObserver((entries) => {
//       entries.forEach(entry => {
//         if (entry.isIntersecting) {
//           bar.classList.remove('is-show');
//         } else {
//           bar.classList.add('is-show');
//         }
//       });
//     }, { threshold: 0.1 });

//     io.observe(realBtn);
//   }

//   // DOMが出来てる/出来てない両対応
//   if (document.readyState === 'loading') {
//     document.addEventListener('DOMContentLoaded', initFloatingCart);
//   } else {
//     initFloatingCart();
//   }

// })();

// Floating Add to Cart + Contact (Welcart)
(function () {

  function initFloatingCart() {

    // 本物のカートボタン
    const realCartBtn =
      document.querySelector('.cart-button input.skubutton[type="submit"]') ||
      document.querySelector('input[type="submit"][id^="inCart["]') ||
      document.querySelector('input[type="submit"][name^="inCart["]') ||
      document.querySelector('input.usces_cart_button');

    // 本物の問い合わせボタン
    const realContactBtn =
      document.querySelector('.p-itemContact__openModal[data-contact-modal-open]') ||
      document.querySelector('[data-contact-modal-open]');

    // どっちも無ければ終了
    if (!realCartBtn && !realContactBtn) return;

    // 二重生成防止
    if (document.querySelector('.c-floatingCart')) return;

    // バー生成
    const bar = document.createElement('div');
    bar.className = 'c-floatingCart is-show';

    let buttonsHtml = '';

    if (realCartBtn) {
      buttonsHtml += `
        <button type="button" class="c-floatingCart__btn c-floatingCart__btn--cart">
          カートへ入れる
        </button>
      `;
    }

    if (realContactBtn) {
      buttonsHtml += `
        <button type="button" class="c-floatingCart__btn c-floatingCart__btn--contact">
          問い合わせする
        </button>
      `;
    }

    bar.innerHTML = `
      <div class="c-floatingCart__inner">
        ${buttonsHtml}
      </div>
    `;

    document.body.appendChild(bar);

    // カートボタン連携
    const floatingCartBtn = bar.querySelector('.c-floatingCart__btn--cart');
    if (floatingCartBtn && realCartBtn) {
      floatingCartBtn.addEventListener('click', function () {
        realCartBtn.click();
      });
    }

    // 問い合わせボタン連携
    const floatingContactBtn = bar.querySelector('.c-floatingCart__btn--contact');
    if (floatingContactBtn && realContactBtn) {
      floatingContactBtn.addEventListener('click', function () {
        realContactBtn.click();
      });
    }

    // IntersectionObserver 非対応なら常時表示
    if (!('IntersectionObserver' in window)) return;

    // 基準にする要素
    const observeTarget = realCartBtn || realContactBtn;
    if (!observeTarget) return;

    // 本物ボタンが見えてる時はフローティング非表示
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          bar.classList.remove('is-show');
        } else {
          bar.classList.add('is-show');
        }
      });
    }, { threshold: 0.1 });

    io.observe(observeTarget);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFloatingCart);
  } else {
    initFloatingCart();
  }

})();



// Rank Modal
(function () {
  function initRankModal() {
    const modal = document.getElementById('rankGuideModal');
    const openBtns = document.querySelectorAll('[data-rank-modal-open]');
    const closeBtns = document.querySelectorAll('[data-rank-modal-close]');

    if (!modal || !openBtns.length) return;

    function openModal() {
      modal.hidden = false;
      modal.setAttribute('aria-hidden', 'false');
      document.documentElement.classList.add('is-rankModal-open');
      document.body.classList.add('is-rankModal-open');
    }

    function closeModal() {
      modal.hidden = true;
      modal.setAttribute('aria-hidden', 'true');
      document.documentElement.classList.remove('is-rankModal-open');
      document.body.classList.remove('is-rankModal-open');
    }

    openBtns.forEach(function (btn) {
      btn.addEventListener('click', openModal);
    });

    closeBtns.forEach(function (btn) {
      btn.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !modal.hidden) {
        closeModal();
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initRankModal);
  } else {
    initRankModal();
  }
})();