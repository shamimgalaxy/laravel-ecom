{{-- ══════════════════════════════════════════════════
    PREMIUM FOOTER — All original functionality preserved
══════════════════════════════════════════════════ --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
/* ── DESIGN TOKENS ─────────────────────────────── */
:root {
    --gold:        #C9A96E;
    --gold-light:  #E8D5B0;
    --gold-dim:    #7A5C30;
    --ink:         #0D0D0D;
    --ink-2:       #141414;
    --ink-3:       #1C1C1C;
    --ink-4:       #242424;
    --smoke:       #888880;
    --mist:        #B8B8B0;
    --parchment:   #F0EDE6;
    --serif:       'Cormorant Garamond', Georgia, serif;
    --sans:        'DM Sans', system-ui, sans-serif;
    --ease-expo:   cubic-bezier(0.16, 1, 0.3, 1);
}

/* ── FOOTER SHELL ───────────────────────────────── */
footer.footer {
    font-family: var(--sans);
    background: var(--ink);
    color: var(--mist);
    position: relative;
    overflow: hidden;
}

footer.footer::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 40% at 10% 0%, rgba(201,169,110,0.06) 0%, transparent 60%),
        radial-gradient(ellipse 40% 60% at 90% 100%, rgba(201,169,110,0.04) 0%, transparent 60%);
    pointer-events: none;
}

/* ── NEWSLETTER BAND ────────────────────────────── */
.footer-top {
    border-bottom: 1px solid rgba(201,169,110,0.15);
}

.footer-top .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.footer-top .inner-content { padding: 56px 0 52px; }

.footer-logo img { height: 36px; width: auto; opacity: 0.9; transition: opacity 0.3s; }
.footer-logo img:hover { opacity: 1; }

/* Logo column vertical centering */
.footer-top .col-lg-3 { display: flex; align-items: center; }
.footer-top .col-lg-9 { display: flex; align-items: center; }

/* Newsletter */
.footer-newsletter { flex: 1; }

.footer-newsletter .title {
    font-family: var(--serif);
    font-size: 26px;
    font-weight: 300;
    color: var(--parchment);
    letter-spacing: 0.01em;
    margin: 0 0 4px;
    line-height: 1.3;
}

.footer-newsletter .title span {
    display: block;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 300;
    color: var(--smoke);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin-top: 4px;
}

.newsletter-form {
    display: flex;
    align-items: stretch;
    gap: 0;
    margin-top: 20px;
    max-width: 480px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(201,169,110,0.2);
    border-radius: 2px;
    overflow: hidden;
    transition: border-color 0.3s;
}

.newsletter-form:focus-within {
    border-color: rgba(201,169,110,0.5);
}

.newsletter-form input[type="email"] {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    padding: 14px 20px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 300;
    color: var(--parchment);
    letter-spacing: 0.02em;
}

.newsletter-form input[type="email"]::placeholder {
    color: var(--smoke);
    letter-spacing: 0.05em;
}

.newsletter-form .button .btn {
    background: var(--gold);
    border: none;
    padding: 14px 28px;
    font-family: var(--sans);
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--ink);
    cursor: pointer;
    transition: background 0.25s, letter-spacing 0.25s;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 6px;
}

.newsletter-form .button .btn:hover {
    background: var(--gold-light);
    letter-spacing: 0.2em;
}

.newsletter-form .button .btn .dir-part {
    display: inline-block;
    width: 14px;
    height: 1px;
    background: var(--ink);
    position: relative;
    transition: width 0.25s;
}

.newsletter-form .button .btn .dir-part::after {
    content: '';
    position: absolute;
    right: 0;
    top: -3px;
    width: 6px;
    height: 6px;
    border-right: 1px solid var(--ink);
    border-top: 1px solid var(--ink);
    transform: rotate(45deg);
}

.newsletter-form .button .btn:hover .dir-part { width: 20px; }

/* ── MIDDLE SECTION ─────────────────────────────── */
.footer-middle {
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.footer-middle .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.footer-middle .bottom-inner { padding: 64px 0 60px; }

/* ── CONTACT COLUMN ─────────────────────────────── */
.single-footer h3 {
    font-family: var(--serif);
    font-size: 11px;
    font-weight: 400;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    margin: 0 0 24px;
    padding-bottom: 14px;
    border-bottom: 1px solid rgba(201,169,110,0.2);
    position: relative;
}

.single-footer h3::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 32px;
    height: 1px;
    background: var(--gold);
}

.f-contact .phone {
    font-family: var(--serif);
    font-size: 18px;
    font-weight: 300;
    color: var(--parchment);
    margin: 0 0 14px;
    letter-spacing: 0.02em;
}

.f-contact ul {
    list-style: none;
    padding: 0;
    margin: 0 0 18px;
}

.f-contact ul li {
    font-size: 12px;
    color: var(--smoke);
    letter-spacing: 0.04em;
    margin-bottom: 6px;
    display: flex;
    gap: 6px;
}

.f-contact ul li span {
    color: var(--mist);
    font-weight: 400;
}

.f-contact .mail a {
    font-size: 13px;
    color: var(--gold);
    text-decoration: none;
    letter-spacing: 0.04em;
    transition: color 0.2s, letter-spacing 0.2s;
    position: relative;
}

.f-contact .mail a::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 1px;
    background: var(--gold-light);
    transition: width 0.3s var(--ease-expo);
}

.f-contact .mail a:hover { color: var(--gold-light); }
.f-contact .mail a:hover::after { width: 100%; }

/* ── APP BUTTONS ────────────────────────────────── */
.our-app .app-btn {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.our-app .app-btn li a {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 18px;
    border: 1px solid rgba(201,169,110,0.2);
    border-radius: 2px;
    text-decoration: none;
    transition: border-color 0.25s, background 0.25s, transform 0.25s var(--ease-expo);
    background: rgba(201,169,110,0.03);
}

.our-app .app-btn li a:hover {
    border-color: rgba(201,169,110,0.5);
    background: rgba(201,169,110,0.07);
    transform: translateX(4px);
}

.our-app .app-btn li a i {
    font-size: 22px;
    color: var(--gold);
}

.our-app .app-btn .small-title {
    display: block;
    font-size: 10px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--smoke);
}

.our-app .app-btn .big-title {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: var(--parchment);
    letter-spacing: 0.02em;
}

/* ── LINK COLUMNS ───────────────────────────────── */
.f-link ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.f-link ul li a {
    font-size: 13px;
    font-weight: 300;
    color: var(--smoke);
    text-decoration: none;
    letter-spacing: 0.03em;
    transition: color 0.2s, padding-left 0.25s var(--ease-expo);
    display: block;
    position: relative;
    padding-left: 0;
}

.f-link ul li a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 1px;
    background: var(--gold);
    transition: width 0.25s var(--ease-expo);
}

.f-link ul li a:hover {
    color: var(--gold-light);
    padding-left: 16px;
}

.f-link ul li a:hover::before {
    width: 10px;
}

/* ── BOTTOM BAR ─────────────────────────────────── */
.footer-bottom {
    background: rgba(0,0,0,0.4);
}

.footer-bottom .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

.footer-bottom .inner-content {
    padding: 24px 0;
    border-top: 1px solid rgba(255,255,255,0.04);
}

/* Payment */
.payment-gateway {
    display: flex;
    align-items: center;
    gap: 14px;
}

.payment-gateway span {
    font-size: 11px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--smoke);
    white-space: nowrap;
}

.payment-gateway img {
    height: 22px;
    width: auto;
    opacity: 0.55;
    filter: grayscale(0.3);
    transition: opacity 0.3s;
}

.payment-gateway:hover img { opacity: 0.75; }

/* Copyright */
.copyright p {
    font-size: 12px;
    color: var(--smoke);
    letter-spacing: 0.04em;
    text-align: center;
    margin: 0;
}

.copyright p a {
    color: var(--gold);
    text-decoration: none;
    margin-left: 4px;
    transition: color 0.2s;
}

.copyright p a:hover { color: var(--gold-light); }

/* Social */
ul.socila {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
}

ul.socila li span {
    font-size: 11px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--smoke);
    margin-right: 4px;
}

ul.socila li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border: 1px solid rgba(201,169,110,0.2);
    border-radius: 50%;
    color: var(--smoke);
    font-size: 14px;
    text-decoration: none;
    transition: border-color 0.25s, color 0.25s, background 0.25s, transform 0.25s var(--ease-expo);
}

ul.socila li a:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: rgba(201,169,110,0.08);
    transform: translateY(-3px);
}

/* ── SCROLL TO TOP ──────────────────────────────── */
#scrollTopBtn {
    position: fixed;
    bottom: 90px;
    right: 32px;
    z-index: 9999;
    width: 44px;
    height: 44px;
    border-radius: 2px;
    background: var(--gold);
    border: none;
    color: var(--ink);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    box-shadow: 0 8px 40px rgba(201,169,110,0.25), 0 2px 8px rgba(0,0,0,0.4);
    opacity: 0;
    visibility: hidden;
    transform: translateY(12px);
    transition:
        opacity 0.4s var(--ease-expo),
        visibility 0.4s,
        transform 0.4s var(--ease-expo),
        background 0.25s,
        box-shadow 0.25s;
}

#scrollTopBtn.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

#scrollTopBtn.visible:hover {
    background: var(--gold-light);
    box-shadow: 0 12px 48px rgba(201,169,110,0.4), 0 4px 12px rgba(0,0,0,0.4);
    transform: translateY(-4px);
}

#scrollTopBtn.visible:active {
    transform: translateY(-1px);
}

.scroll-btn-ring {
    position: absolute;
    inset: -1px;
    border-radius: 2px;
    border: 1px solid rgba(201,169,110,0.5);
    opacity: 0;
    pointer-events: none;
}

#scrollTopBtn.visible .scroll-btn-ring {
    animation: ringPulse 2.5s ease-out infinite;
}

@keyframes ringPulse {
    0%   { opacity: 0.6; transform: scale(1); }
    100% { opacity: 0;   transform: scale(1.6); }
}

.scroll-btn-icon { position: relative; z-index: 2; transition: transform 0.25s; }
#scrollTopBtn:hover .scroll-btn-icon { transform: translateY(-2px); }

/* ── DIVIDER ORNAMENT ───────────────────────────── */
.footer-ornament {
    text-align: center;
    padding: 10px 0 0;
    opacity: 0.3;
}

.footer-ornament svg { width: 120px; height: 12px; }

/* ── GRID HELPERS (matching Bootstrap columns) ──── */
.row { display: flex; flex-wrap: wrap; margin: 0 -12px; }
.col-lg-3 { padding: 0 12px; width: 25%; }
.col-lg-4 { padding: 0 12px; width: 33.333%; }
.col-lg-9 { padding: 0 12px; width: 75%; }
.col-lg-6 { padding: 0 12px; width: 50%; }
.col-12   { padding: 0 12px; width: 100%; }
.col-md-4 { }
.col-md-6 { }
.col-md-8 { }
.align-items-center { align-items: center; }

@media (max-width: 991px) {
    .col-lg-3, .col-lg-4, .col-lg-9 { width: 50%; }
    .footer-newsletter { margin-top: 24px; }
}
@media (max-width: 767px) {
    .col-lg-3, .col-lg-4, .col-lg-9 { width: 100%; }
    .copyright p, ul.socila { text-align: left; justify-content: flex-start; }
    .single-footer { margin-bottom: 40px; }
}
</style>

<footer class="footer">

  {{-- ── NEWSLETTER BAND ── --}}
  <div class="footer-top">
    <div class="container">
      <div class="inner-content">
        <div class="row">

          <div class="col-lg-3 col-md-4 col-12">
            <div class="footer-logo">
              <a href="index.html">
                <img src="{{ asset('website/assets/images/logo/white-logo.svg')}}" alt="#">
              </a>
            </div>
          </div>

          <div class="col-lg-9 col-md-8 col-12">
            <div class="footer-newsletter">
              <h4 class="title">
                Subscribe to our Newsletter
                <span>Get all the latest information, Sales and Offers.</span>
              </h4>
              <div class="newsletter-form-head">
                <form action="#" method="get" target="_blank" class="newsletter-form">
                 <input name="EMAIL" placeholder="Your email address..." type="email" autocomplete="email">
                  <div class="button">
                    <button class="btn">Subscribe<span class="dir-part"></span></button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  {{-- ── MIDDLE COLUMNS ── --}}
  <div class="footer-middle">
    <div class="container">
      <div class="bottom-inner">
        <div class="row">

          {{-- Contact --}}
          <div class="col-lg-3 col-md-6 col-12">
            <div class="single-footer f-contact">
              <h3>Get In Touch With Us</h3>
              <p class="phone">Phone: +1 (900) 33 169 7720</p>
              <ul>
                <li><span>Monday–Friday:</span> 9.00 am – 8.00 pm</li>
                <li><span>Saturday:</span> 10.00 am – 6.00 pm</li>
              </ul>
              <p class="mail">
                <a href="https://demo.graygrids.com/cdn-cgi/l/email-protection#5b282e2b2b34292f1b2833342b3c29323f2875383436">
                  <span class="__cf_email__" data-cfemail="98ebede8e8f7eaecd8ebf0f7e8ffeaf1fcebb6fbf7f5">[email&#160;protected]</span>
                </a>
              </p>
            </div>
          </div>

          {{-- App --}}
          <div class="col-lg-3 col-md-6 col-12">
            <div class="single-footer our-app">
              <h3>Our Mobile App</h3>
              <ul class="app-btn">
                <li>
                  <a href="javascript:void(0)">
                    <i class="lni lni-apple"></i>
                    <div>
                      <span class="small-title">Download on the</span>
                      <span class="big-title">App Store</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="lni lni-play-store"></i>
                    <div>
                      <span class="small-title">Download on the</span>
                      <span class="big-title">Google Play</span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          {{-- Info Links --}}
          <div class="col-lg-3 col-md-6 col-12">
            <div class="single-footer f-link">
              <h3>Information</h3>
              <ul>
                <li><a href="javascript:void(0)">About Us</a></li>
                <li><a href="javascript:void(0)">Contact Us</a></li>
                <li><a href="javascript:void(0)">Downloads</a></li>
                <li><a href="javascript:void(0)">Sitemap</a></li>
                <li><a href="javascript:void(0)">FAQs Page</a></li>
              </ul>
            </div>
          </div>

          {{-- Shop Links --}}
          <div class="col-lg-3 col-md-6 col-12">
            <div class="single-footer f-link">
              <h3>Shop Departments</h3>
              <ul>
                <li><a href="javascript:void(0)">Computers &amp; Accessories</a></li>
                <li><a href="javascript:void(0)">Smartphones &amp; Tablets</a></li>
                <li><a href="javascript:void(0)">TV, Video &amp; Audio</a></li>
                <li><a href="javascript:void(0)">Cameras, Photo &amp; Video</a></li>
                <li><a href="javascript:void(0)">Headphones</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  {{-- ── BOTTOM BAR ── --}}
  <div class="footer-bottom">
    <div class="container">
      <div class="inner-content">
        <div class="row align-items-center">

          <div class="col-lg-4 col-12">
            <div class="payment-gateway">
              <span>We Accept:</span>
              <img src="{{ asset('website/assets/images/footer/credit-cards-footer.png')}}" alt="#">
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <div class="copyright">
              <p>Designed and Developed by
                <a href="" rel="nofollow" target="_blank">Shamim Ahmed Shuvo</a>
              </p>
            </div>
          </div>

          <div class="col-lg-4 col-12">
            <ul class="socila">
              <li><span>Follow Us On:</span></li>
              <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
              <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
              <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
              <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>


  {{-- ── SCROLL TO TOP ── --}}
  <button id="scrollTopBtn" aria-label="Scroll to top" title="Back to top">
    <span class="scroll-btn-ring"></span>
    <span class="scroll-btn-icon">
      <i class="lni lni-arrow-up"></i>
    </span>
  </button>

</footer>


{{-- ── Legacy scroll-top anchor (original) ── --}}
<a href="#" class="scroll-top">
  <i class="lni lni-chevron-up"></i>
</a>

<script>
(function () {
    var btn = document.getElementById('scrollTopBtn');
    if (!btn) return;
    window.addEventListener('scroll', function () {
        btn.classList.toggle('visible', window.scrollY > 300);
    }, { passive: true });
    btn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();
</script>