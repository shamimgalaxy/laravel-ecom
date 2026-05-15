/* ══ HEADER — header.js ════════════════════════════════════════════════════ */

/* ── Preloader: dismiss immediately ── */
(function () {
  var pl = document.getElementById('preloader');
  if (!pl) return;
  pl.style.transition    = 'opacity 0.4s ease';
  pl.style.opacity       = '0';
  pl.style.pointerEvents = 'none';
  setTimeout(function () { if (pl.parentNode) pl.remove(); }, 400);
})();

/* ══════════════════════════════════════════════════════════
   updateCartUI — top-level scope, reachable by everything
   Targets every element that shows the cart count or total.
══════════════════════════════════════════════════════════ */
function updateCartUI(count, total) {
  /* All count display elements */
  var countEls = [
    document.getElementById('header-cart-count'),       /* inside the cart button */
    document.getElementById('header-cart-count-label'), /* inside the dropdown header */
  ];
  countEls.forEach(function (el) {
    if (el) el.textContent = count;
  });

  /* Cart total in the dropdown footer */
  var totalEl = document.getElementById('header-cart-total');
  if (totalEl && total) totalEl.textContent = total;
}

/* ── expose so product pages can call it directly ── */
window.updateCartUI = updateCartUI;

/* ══════════════════════════════════════════════════════════
   Everything DOM-dependent goes inside DOMContentLoaded
══════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function () {

  /* ── Sticky scroll ── */
  var header = document.getElementById('lxHeader');
  function onScroll() {
    if (header) header.classList.toggle('scrolled', window.scrollY > 10);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ── Mobile nav toggle ── */
  var toggle = document.getElementById('lxToggle');
  if (toggle) {
    toggle.addEventListener('click', function () {
      var nav = document.getElementById('lxNav');
      if (nav) nav.classList.toggle('open');
      toggle.classList.toggle('open');
    });
  }

  /* ── Mobile sub-menu accordion ── */
  document.querySelectorAll('.lx-nav-item > a').forEach(function (link) {
    link.addEventListener('click', function () {
      if (window.innerWidth < 992) {
        var sub = this.parentElement.querySelector('.lx-sub');
        if (sub) {
          sub.classList.toggle('open');
          this.parentElement.classList.toggle('sub-open');
        }
      }
    });
  });

  /* ── Categories panel ── */
  (function () {
    var catWrap  = document.getElementById('lxCat');
    if (!catWrap) return;
    var catPanel = catWrap.querySelector('.lx-cat-panel');
    var catBtn   = catWrap.querySelector('.lx-cat-btn');
    var closeTimer = null;

    function openCat()       { clearTimeout(closeTimer); catWrap.classList.add('open'); }
    function closeCat()      { catWrap.classList.remove('open'); }
    function scheduleClose() { clearTimeout(closeTimer); closeTimer = setTimeout(closeCat, 150); }

    if (window.innerWidth >= 992) {
      catWrap.addEventListener('mouseenter', openCat);
      catWrap.addEventListener('mouseleave', scheduleClose);
      if (catPanel) {
        catPanel.addEventListener('mouseenter', openCat);
        catPanel.addEventListener('mouseleave', scheduleClose);
      }
    }
    if (catBtn) {
      catBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        catWrap.classList.toggle('open');
      });
    }
    document.addEventListener('click', function (e) {
      if (!catWrap.contains(e.target)) closeCat();
    });
  }());

  /* ── User dropdown ── */
  (function () {
    var chip = document.getElementById('lxUserChip');
    var dd   = document.getElementById('lxUserDropdown');
    if (!chip || !dd) return;
    var closeTimer = null;

    function openDD()        { clearTimeout(closeTimer); dd.classList.add('open'); }
    function closeDD()       { dd.classList.remove('open'); }
    function scheduleClose() { clearTimeout(closeTimer); closeTimer = setTimeout(closeDD, 180); }

    chip.addEventListener('mouseenter', openDD);
    chip.addEventListener('mouseleave', scheduleClose);
    dd.addEventListener('mouseenter', openDD);
    dd.addEventListener('mouseleave', scheduleClose);
    chip.addEventListener('click', function (e) {
      e.stopPropagation();
      dd.classList.contains('open') ? closeDD() : openDD();
    });
    document.addEventListener('click', function (e) {
      if (!chip.contains(e.target)) closeDD();
    });
  }());

  /* ── Cart dropdown toggle ── */
  (function () {
    var cartWrap     = document.querySelector('.lx-cart-wrap');
    var cartBtn      = document.getElementById('lxCartBtn');
    var cartDropdown = document.querySelector('.lx-cart-dropdown');
    if (!cartBtn || !cartWrap || !cartDropdown) return;

    cartBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      cartWrap.classList.toggle('cart-open');
    });
    cartDropdown.addEventListener('click', function (e) { e.stopPropagation(); });
    document.addEventListener('click', function () { cartWrap.classList.remove('cart-open'); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') cartWrap.classList.remove('cart-open');
    });
  }());

  /* ── AJAX cart item removal ── */
  (function () {
    var cartList = document.getElementById('header-cart-list');
    if (!cartList) return;

    cartList.addEventListener('click', function (e) {
      var btn = e.target.closest('.lx-cart-remove');
      if (!btn) return;
      var url   = btn.dataset.removeUrl;
      var rowId = btn.dataset.rowId;
      var row   = document.getElementById('cart-row-' + rowId);
      if (!url || !row) return;

      row.classList.add('removing');
      fetch(url, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(function (res) { if (!res.ok) throw new Error(); return res.json(); })
        .then(function (data) {
  updateCartUI(data.count ?? 0, data.total ?? '৳0.00');
  if (data.cart_html) {
    var list = document.getElementById('header-cart-list');
    if (list) list.innerHTML = data.cart_html;
  }
})
        .catch(function () {
          row.classList.remove('removing');
          window.location.href = url;
        });
    });
  }());

  /* ══════════════════════════════════════════════════════════
     ── FLY-TO-CART  +  CART HIGHLIGHT ─────────────────────
  ══════════════════════════════════════════════════════════ */
  (function () {

    /* ── Inject animation styles once ── */
    var s = document.createElement('style');
    s.textContent = [
      /* Flying image clone */
      '.lx-fly-clone{',
        'position:fixed;pointer-events:none;z-index:2147483647;',
        'border-radius:50%;overflow:hidden;',
        'border:2px solid #c8a45a;',
        'box-shadow:0 4px 24px rgba(14,13,11,0.3);',
        'transform-origin:center center;',
      '}',

      /* Ripple ring */
      '.lx-ripple{',
        'position:fixed;pointer-events:none;z-index:2147483646;',
        'border-radius:50%;border:2px solid #c8a45a;',
        'transform:translate(-50%,-50%) scale(0.2);opacity:0.85;',
        'animation:lx-ripple-out 0.7s cubic-bezier(0.2,0.6,0.4,1) forwards;',
      '}',
      '@keyframes lx-ripple-out{',
        'to{transform:translate(-50%,-50%) scale(3.8);opacity:0;}',
      '}',

      /* Spark particle */
      '.lx-spark{',
        'position:fixed;pointer-events:none;z-index:2147483646;',
        'width:5px;height:5px;border-radius:50%;background:#c8a45a;',
        'animation:lx-spark-fly 0.65s cubic-bezier(0.2,0.8,0.4,1) forwards;',
      '}',
      '@keyframes lx-spark-fly{',
        '0%{opacity:1;transform:translate(0,0) scale(1);}',
        '80%{opacity:0.6;}',
        '100%{opacity:0;transform:translate(var(--sx),var(--sy)) scale(0);}',
      '}',

      /* Button elastic bounce */
      '@keyframes lx-pop{',
        '0%{transform:scale(1)}',
        '18%{transform:scale(1.5)}',
        '38%{transform:scale(0.78)}',
        '56%{transform:scale(1.24)}',
        '72%{transform:scale(0.91)}',
        '84%{transform:scale(1.08)}',
        '100%{transform:scale(1)}',
      '}',

      /* Button gold flash */
      '@keyframes lx-flash{',
        '0%  {background:#0e0d0b;color:#706e68;box-shadow:none;}',
        '20% {background:#c8a45a;color:#0e0d0b;',
             'box-shadow:0 0 0 6px rgba(200,164,90,0.35),',
                        '0 0 0 14px rgba(200,164,90,0.15),',
                        '0 0 32px rgba(200,164,90,0.4);}',
        '55% {background:#b8922e;color:#fff;',
             'box-shadow:0 0 0 4px rgba(200,164,90,0.2),',
                        '0 0 20px rgba(200,164,90,0.25);}',
        '100%{background:#0e0d0b;color:#706e68;box-shadow:none;}',
      '}',

      /* Count badge vertical flip */
      '@keyframes lx-count-flip{',
        '0%  {transform:translateY(0)   scale(1);   opacity:1;}',
        '35% {transform:translateY(-8px) scale(1.4); opacity:0;}',
        '36% {transform:translateY(8px)  scale(0.6); opacity:0;}',
        '100%{transform:translateY(0)   scale(1);   opacity:1;}',
      '}',

      /* Apply both button animations simultaneously */
      '#lxCartBtn.lx-landing{',
        'animation:',
          'lx-pop   0.55s cubic-bezier(0.36,0.07,0.19,0.97) both,',
          'lx-flash 0.9s  0.06s ease both;',
      '}',

      /* Count flip — targets the span inside the button */
      '#header-cart-count.lx-count-flip,',
      '#header-cart-count-label.lx-count-flip{',
        'display:inline-block;',
        'animation:lx-count-flip 0.42s cubic-bezier(0.4,0,0.2,1) both;',
      '}',
    ].join('');
    document.head.appendChild(s);

    /* ─────────────────────────────────────────
       highlightCart — all effects after landing
    ───────────────────────────────────────── */
    function highlightCart(count, total) {
      var btn = document.getElementById('lxCartBtn');
      if (!btn) return;

      var rect = btn.getBoundingClientRect();
      var cx   = rect.left + rect.width  / 2;
      var cy   = rect.top  + rect.height / 2;

      /* 1. Update the numbers immediately */
      if (count != null) updateCartUI(count, total || '');

      /* 2. Flip animation on count spans */
      ['header-cart-count', 'header-cart-count-label'].forEach(function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.classList.remove('lx-count-flip');
        void el.offsetWidth;                    /* force reflow to restart */
        el.classList.add('lx-count-flip');
        el.addEventListener('animationend', function () {
          el.classList.remove('lx-count-flip');
        }, { once: true });
      });

      /* 3. Button bounce + gold flash */
      btn.classList.remove('lx-landing');
      void btn.offsetWidth;
      btn.classList.add('lx-landing');
      btn.addEventListener('animationend', function () {
        btn.classList.remove('lx-landing');
      }, { once: true });

      /* 4. Three staggered ripple rings */
      [0, 130, 270].forEach(function (delay) {
        setTimeout(function () {
          var ring = document.createElement('div');
          ring.className = 'lx-ripple';
          ring.style.cssText =
            'width:'  + rect.width  + 'px;' +
            'height:' + rect.height + 'px;' +
            'left:'   + cx + 'px;' +
            'top:'    + cy + 'px;';
          document.body.appendChild(ring);
          ring.addEventListener('animationend', function () { ring.remove(); });
        }, delay);
      });

      /* 5. Ten spark particles */
      for (var i = 0; i < 10; i++) {
        (function (idx) {
          setTimeout(function () {
            var angle = (idx / 10) * Math.PI * 2 + Math.random() * 0.4;
            var dist  = 48 + Math.random() * 36;
            var spark = document.createElement('div');
            spark.className = 'lx-spark';
            spark.style.cssText =
              'left:' + cx + 'px;' +
              'top:'  + cy + 'px;' +
              '--sx:' + (Math.cos(angle) * dist) + 'px;' +
              '--sy:' + (Math.sin(angle) * dist) + 'px;';
            document.body.appendChild(spark);
            spark.addEventListener('animationend', function () { spark.remove(); });
          }, Math.random() * 80);
        }(i));
      }
    }

    /* ─────────────────────────────────────────
       flyToCart — quadratic Bézier arc via rAF
    ───────────────────────────────────────── */
    function flyToCart(imgEl, count, total) {
      var cartBtn = document.getElementById('lxCartBtn');

      if (!cartBtn) {
        if (count != null) updateCartUI(count, total || '');
        return;
      }

      /* No image — just run the highlight */
      if (!imgEl) {
        highlightCart(count, total);
        return;
      }

      var srcRect  = imgEl.getBoundingClientRect();
      var cartRect = cartBtn.getBoundingClientRect();

      var startX = srcRect.left  + srcRect.width  / 2;
      var startY = srcRect.top   + srcRect.height / 2;
      var destX  = cartRect.left + cartRect.width  / 2;
      var destY  = cartRect.top  + cartRect.height / 2;

      /* Cap clone size at 90px */
      var size = Math.min(srcRect.width, srcRect.height, 90);

      /* Build the flying clone */
      var clone = document.createElement('img');
      clone.src = imgEl.src;
      clone.className = 'lx-fly-clone';
      clone.style.cssText =
        'width:'  + size + 'px;' +
        'height:' + size + 'px;' +
        'left:'   + (startX - size / 2) + 'px;' +
        'top:'    + (startY - size / 2) + 'px;' +
        'opacity:1;';
      document.body.appendChild(clone);

      /*
        Bézier control point — sits above the straight line.
        Lift = max(50% of horizontal distance, 80px).
        The 0.3 horizontal bias pulls the arc toward the cart
        so it never drifts away from the target.
      */
      var lift = Math.max(Math.abs(destX - startX) * 0.5, 80);
      var cpX  = startX + (destX - startX) * 0.3;
      var cpY  = Math.min(startY, destY) - lift;

      var DURATION  = 680; /* ms */
      var startTime = null;

      function step(ts) {
        if (!startTime) startTime = ts;
        var raw = Math.min((ts - startTime) / DURATION, 1);

        /* Ease-in-out curve */
        var t = raw < 0.5
          ? 2 * raw * raw
          : 1 - Math.pow(-2 * raw + 2, 2) / 2;

        /* Quadratic Bézier: P = (1-t)²P0 + 2(1-t)tP1 + t²P2 */
        var inv = 1 - t;
        var x   = inv * inv * startX + 2 * inv * t * cpX + t * t * destX;
        var y   = inv * inv * startY + 2 * inv * t * cpY + t * t * destY;

        /* Shrink 1→0.15, fade last 30% */
        var scale   = 1 - t * 0.85;
        var opacity = raw < 0.7 ? 1 : 1 - (raw - 0.7) / 0.3;

        clone.style.transform =
          'translate(' + (x - startX) + 'px,' + (y - startY) + 'px)' +
          ' scale(' + scale + ')';
        clone.style.opacity = opacity;

        if (raw < 1) {
          requestAnimationFrame(step);
        } else {
          clone.remove();
          highlightCart(count, total);
        }
      }

      requestAnimationFrame(step);
    }

    /* ── Expose globally ── */
    window.flyToCart = flyToCart;

    /* ── Auto-wire [data-fly-cart] buttons ── */
    document.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-fly-cart]');
      if (!btn) return;

      var imgEl  = document.querySelector(btn.dataset.productImg || '#xzoom-default,.product-main-img');
      var addUrl = btn.dataset.addUrl;

      if (!addUrl) { flyToCart(imgEl, null, null); return; }

      btn.disabled = true;
      var csrf = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';

      fetch(addUrl, {
        method:  'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN':     csrf,
          'Content-Type':     'application/json',
        },
        body: JSON.stringify({ qty: parseInt(btn.dataset.qty, 10) || 1 }),
      })
        .then(function (r) { if (!r.ok) throw new Error(); return r.json(); })
        .then(function (d) {
          flyToCart(imgEl, d.count ?? null, d.total ?? null);
          if (d.cart_html) {
              var list = document.getElementById('header-cart-list');
              if (list) list.innerHTML = d.cart_html;
          }
      })
        .catch(function ()  { flyToCart(imgEl, null, null); })
        .finally(function () { btn.disabled = false; });
    });

  }()); /* end fly-to-cart */

}); /* end DOMContentLoaded */