<!--[if lte IE 9]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please
    <a href="https://browsehappy.com/">upgrade your browser</a> to improve
    your experience and security.
</p>
<![endif]-->

<style>
/* ── Google Fonts ── */
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500&display=swap');

:root {
  --clr-bg:        #0a0a0a;
  --clr-surface:   #111111;
  --clr-border:    rgba(255,255,255,0.07);
  --clr-gold:      #c8a96e;
  --clr-gold-dim:  rgba(200,169,110,0.15);
  --clr-white:     #f5f0ea;
  --clr-muted:     rgba(245,240,234,0.45);
  --clr-hover:     rgba(200,169,110,0.08);
  --font-serif:    'Cormorant Garamond', Georgia, serif;
  --font-sans:     'DM Sans', sans-serif;
  --ease:          cubic-bezier(0.25, 0.46, 0.45, 0.94);
  --header-h:      68px;
}

/* ── Reset helpers ── */
.lx-header *, .lx-header *::before, .lx-header *::after { box-sizing: border-box; margin: 0; padding: 0; }
.lx-header a { text-decoration: none; color: inherit; }
.lx-header ul { list-style: none; }
.lx-header button { border: none; background: none; cursor: pointer; }
.lx-header select { -webkit-appearance: none; appearance: none; cursor: pointer; }

/* ══ PRELOADER ══ */
.preloader {
    position: fixed; inset: 0; z-index: 99999;
    background: #0a0a0a;
    display: flex; align-items: center; justify-content: center;
    transition: opacity 0.6s ease, visibility 0.6s ease;
}
.preloader.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}
.preloader-box {
    display: flex; flex-direction: column;
    align-items: center; gap: 28px;
    position: relative;
}
.preloader-box::before {
    content: '';
    position: absolute;
    top: -40px; left: -60px; right: -60px;
    height: 1px;
    background: linear-gradient(90deg, transparent, #c8a96e, transparent);
    animation: pl-line 2s ease-in-out infinite;
}
@keyframes pl-line {
    0%,100% { opacity: 0.3; }
    50%      { opacity: 1; }
}
.preloader-logo {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 26px; font-weight: 400;
    color: #c8a96e;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    animation: pl-fadein 0.8s 0.2s both;
}
@keyframes pl-fadein {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}
.preloader-ring {
    position: relative; width: 64px; height: 64px;
}
.preloader-ring-track {
    position: absolute; inset: 0; border-radius: 50%;
    border: 1px solid rgba(200,169,110,0.12);
}
.preloader-ring-spin {
    position: absolute; inset: 0; border-radius: 50%;
    border: 1.5px solid transparent;
    border-top-color: #c8a96e;
    animation: pl-spin 1.1s cubic-bezier(0.6,0.2,0.4,0.8) infinite;
}
.preloader-ring-spin2 {
    position: absolute; inset: 10px; border-radius: 50%;
    border: 1px solid transparent;
    border-top-color: rgba(200,169,110,0.4);
    animation: pl-spin 0.75s cubic-bezier(0.6,0.2,0.4,0.8) infinite reverse;
}
.preloader-ring-dot {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: 4px; height: 4px; border-radius: 50%;
    background: #c8a96e;
    animation: pl-pulse 1.1s ease-in-out infinite;
}
@keyframes pl-spin  { to { transform: rotate(360deg); } }
@keyframes pl-pulse {
    0%,100% { opacity: 0.4; transform: translate(-50%,-50%) scale(0.8); }
    50%      { opacity: 1;   transform: translate(-50%,-50%) scale(1.3); }
}
.preloader-progress-wrap {
    width: 160px; height: 1px;
    background: rgba(200,169,110,0.12);
    overflow: hidden;
    animation: pl-fadein 0.8s 0.5s both;
}
.preloader-progress-fill {
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, #c8a96e, transparent);
    animation: pl-sweep 1.8s ease-in-out infinite;
    transform: translateX(-100%);
}
@keyframes pl-sweep {
    0%   { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.preloader-status {
    font-family: var(--font-sans);
    font-size: 10px; letter-spacing: 0.22em;
    text-transform: uppercase;
    color: rgba(200,169,110,0.4);
    animation: pl-fadein 0.8s 0.8s both;
}

/* ══════════════════
   TOPBAR
══════════════════ */
.lx-topbar {
  background: var(--clr-bg);
  border-bottom: 1px solid var(--clr-border);
  font-family: var(--font-sans);
  font-size: 11.5px;
  font-weight: 400;
  letter-spacing: 0.04em;
  color: var(--clr-muted);
}
.lx-topbar .inner {
  max-width: 1380px; margin: 0 auto; padding: 0 28px;
  display: flex; align-items: center; justify-content: space-between;
  height: 38px;
}

/* select wrappers */
.lx-sel {
  position: relative; display: inline-flex; align-items: center; gap: 6px;
}
.lx-sel select {
  background: transparent;
  border: none;
  color: var(--clr-muted);
  font: inherit;
  font-size: 11.5px;
  letter-spacing: 0.04em;
  padding-right: 18px;
  transition: color .2s;
}
.lx-sel select:hover { color: var(--clr-white); }
.lx-sel::after {
  content: '';
  position: absolute; right: 2px; top: 50%;
  transform: translateY(-50%);
  width: 5px; height: 5px;
  border-right: 1px solid var(--clr-muted);
  border-bottom: 1px solid var(--clr-muted);
  transform: translateY(-65%) rotate(45deg);
  pointer-events: none;
}
.lx-sel select option { background: #1a1a1a; color: var(--clr-white); }

.lx-top-left  { display: flex; align-items: center; gap: 20px; }
.lx-top-mid   { display: flex; align-items: center; gap: 24px; }
.lx-top-right { display: flex; align-items: center; gap: 20px; }

/* divider dot */
.lx-dot {
  width: 3px; height: 3px; border-radius: 50%;
  background: var(--clr-border); display: inline-block;
}

.lx-top-mid a {
  font-size: 11.5px; letter-spacing: 0.05em;
  text-transform: uppercase; color: var(--clr-muted);
  transition: color .2s;
}
.lx-top-mid a:hover { color: var(--clr-gold); }

/* auth links */
.lx-auth { display: flex; align-items: center; gap: 18px; }
.lx-auth a {
  font-size: 11.5px; letter-spacing: 0.05em; text-transform: uppercase;
  color: var(--clr-muted); transition: color .2s;
}
.lx-auth a:hover { color: var(--clr-gold); }
.lx-auth-sep { color: var(--clr-border); }

/* ══════════════════════════════════════════
   USER CHIP + DROPDOWN  ← FIXED
   The dropdown wrapper extends top: 100% with
   padding-top to bridge the visual gap so the
   mouse never leaves the hover zone.
══════════════════════════════════════════ */
.lx-user-chip {
  position: relative;
  display: flex; align-items: center; gap: 8px;
  font-size: 11.5px; letter-spacing: 0.04em; color: var(--clr-white);
  cursor: pointer;
  /* Extend the clickable/hover zone downward so
     moving the mouse toward the dropdown keeps
     the :hover state alive */
  padding-bottom: 12px;
  margin-bottom: -12px;
}
.lx-user-chip i { color: var(--clr-gold); font-size: 13px; }

/* Outer wrapper — transparent, starts flush at 100% */
.lx-user-dropdown {
  display: none;
  position: absolute; top: 100%; right: 0;
  /* padding-top creates an invisible bridge over
     the visual gap — mouse stays "inside" the element */
  padding-top: 12px;
  min-width: 160px;
  z-index: 9999;
}

/* Inner box — the visible card */
.lx-user-dropdown-inner {
  background: var(--clr-surface);
  border: 1px solid var(--clr-border);
  box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.lx-user-chip:hover .lx-user-dropdown { display: block; }

.lx-user-dropdown li a {
  display: block; padding: 11px 18px;
  font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.04em;
  color: var(--clr-muted); transition: all .2s;
}
.lx-user-dropdown li a:hover {
  color: var(--clr-gold);
  background: var(--clr-hover);
  padding-left: 22px;
}

/* ══════════════════
   HEADER MIDDLE
══════════════════ */
.lx-mid {
  background: var(--clr-bg);
  border-bottom: 1px solid var(--clr-border);
}
.lx-mid .inner {
  max-width: 1380px; margin: 0 auto; padding: 0 28px;
  display: grid; grid-template-columns: 220px 1fr auto;
  align-items: center; gap: 32px; height: 88px;
}

/* Logo */
.lx-logo img { height: 36px; width: auto; display: block; filter: brightness(1.1); }

/* Search */
.lx-search {
  display: flex; align-items: stretch;
  border: 1px solid var(--clr-border);
  background: rgba(255,255,255,0.03);
  height: 44px;
  transition: border-color .2s, box-shadow .2s;
}
.lx-search:focus-within {
  border-color: rgba(200,169,110,0.4);
  box-shadow: 0 0 0 3px rgba(200,169,110,0.06);
}

.lx-search-cat {
  position: relative; display: flex; align-items: center;
  border-right: 1px solid var(--clr-border);
  padding: 0 14px 0 16px;
  min-width: 110px;
}
.lx-search-cat select {
  background: transparent; border: none;
  color: var(--clr-muted); font-family: var(--font-sans);
  font-size: 12px; letter-spacing: 0.03em;
  padding-right: 16px; width: 100%;
}
.lx-search-cat::after {
  content: '';
  position: absolute; right: 14px; top: 50%;
  width: 5px; height: 5px;
  border-right: 1px solid var(--clr-muted);
  border-bottom: 1px solid var(--clr-muted);
  transform: translateY(-65%) rotate(45deg);
  pointer-events: none;
}
.lx-search-cat select option { background: #1a1a1a; color: var(--clr-white); }

.lx-search-input {
  flex: 1; display: flex; align-items: center;
}
.lx-search-input input {
  width: 100%; background: transparent; border: none; outline: none;
  color: var(--clr-white); font-family: var(--font-sans);
  font-size: 13px; padding: 0 16px;
}
.lx-search-input input::placeholder { color: var(--clr-muted); }

.lx-search-btn {
  display: flex; align-items: center; justify-content: center;
  width: 48px; background: var(--clr-gold); border: none; cursor: pointer;
  transition: background .2s;
  flex-shrink: 0;
}
.lx-search-btn:hover { background: #b8935a; }
.lx-search-btn i { color: var(--clr-bg); font-size: 15px; }

/* Hotline + Icons */
.lx-actions { display: flex; align-items: center; gap: 28px; }

.lx-hotline { display: flex; align-items: center; gap: 10px; }
.lx-hotline i { color: var(--clr-gold); font-size: 18px; }
.lx-hotline h3 {
  font-family: var(--font-sans); font-size: 12px; font-weight: 300;
  color: var(--clr-muted); white-space: nowrap;
}
.lx-hotline h3 span { color: var(--clr-white); font-weight: 500; }

.lx-icon-group { display: flex; align-items: center; gap: 6px; }

/* wishlist btn */
.lx-wishlist-btn {
  position: relative; display: flex; align-items: center; justify-content: center;
  width: 42px; height: 42px;
  border: 1px solid var(--clr-border);
  background: transparent;
  color: var(--clr-muted); font-size: 16px;
  transition: all .2s; cursor: pointer;
}
.lx-wishlist-btn:hover { border-color: rgba(200,169,110,0.5); color: var(--clr-gold); background: var(--clr-gold-dim); }
.lx-badge {
  position: absolute; top: -5px; right: -5px;
  min-width: 16px; height: 16px; border-radius: 2px;
  background: var(--clr-gold); color: var(--clr-bg);
  font-size: 9px; font-weight: 600; letter-spacing: 0;
  display: flex; align-items: center; justify-content: center;
  padding: 0 3px;
}

/* cart btn */
.lx-cart-wrap { position: relative; }
.lx-cart-btn {
  display: flex; align-items: center; gap: 10px;
  padding: 0 18px; height: 42px;
  background: var(--clr-gold); color: var(--clr-bg);
  font-family: var(--font-sans); font-size: 12px;
  font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase;
  border: none; cursor: pointer;
  transition: background .2s;
  white-space: nowrap;
}
.lx-cart-btn:hover { background: #b8935a; }
.lx-cart-btn i { font-size: 15px; }

/* cart dropdown — same bridge fix applied */
.lx-cart-wrap {
  position: relative;
  /* Extend hover zone downward */
  padding-bottom: 10px;
  margin-bottom: -10px;
}
.lx-cart-dropdown {
  display: none;
  position: absolute; top: 100%; right: 0;
  padding-top: 10px; /* invisible bridge */
  width: 340px;
  z-index: 999;
}
.lx-cart-dropdown-inner {
  background: var(--clr-surface);
  border: 1px solid var(--clr-border);
  box-shadow: 0 30px 80px rgba(0,0,0,0.6);
}
.lx-cart-wrap:hover .lx-cart-dropdown { display: block; }

.lx-cart-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid var(--clr-border);
  font-family: var(--font-sans); font-size: 11px;
  text-transform: uppercase; letter-spacing: 0.06em;
}
.lx-cart-head span { color: var(--clr-muted); }
.lx-cart-head a { color: var(--clr-gold); transition: opacity .2s; }
.lx-cart-head a:hover { opacity: 0.7; }

.lx-cart-list { max-height: 260px; overflow-y: auto; padding: 8px 0; }
.lx-cart-list::-webkit-scrollbar { width: 3px; }
.lx-cart-list::-webkit-scrollbar-thumb { background: var(--clr-border); }

.lx-cart-item {
  display: flex; align-items: flex-start; gap: 14px;
  padding: 14px 20px;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  transition: background .15s;
}
.lx-cart-item:hover { background: rgba(255,255,255,0.02); }

.lx-cart-item-img {
  width: 54px; height: 54px; flex-shrink: 0;
  border: 1px solid var(--clr-border); overflow: hidden;
}
.lx-cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
.lx-cart-item-body { flex: 1; min-width: 0; }
.lx-cart-item-body h4 {
  font-family: var(--font-serif); font-size: 14px; font-weight: 500;
  color: var(--clr-white); line-height: 1.3;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  margin-bottom: 5px;
}
.lx-cart-item-body h4 a { color: inherit; }
.lx-cart-item-body p { font-family: var(--font-sans); font-size: 12px; color: var(--clr-muted); }
.lx-cart-item-body p span { color: var(--clr-gold); }
.lx-cart-remove {
  color: var(--clr-muted); font-size: 11px; flex-shrink: 0;
  padding: 2px; transition: color .2s; cursor: pointer;
}
.lx-cart-remove:hover { color: #e05555; }

.lx-cart-footer { padding: 16px 20px; border-top: 1px solid var(--clr-border); }
.lx-cart-total {
  display: flex; justify-content: space-between; align-items: center;
  margin-bottom: 14px;
  font-family: var(--font-sans); font-size: 12px;
  text-transform: uppercase; letter-spacing: 0.05em;
}
.lx-cart-total span:first-child { color: var(--clr-muted); }
.lx-cart-total span:last-child { font-size: 16px; color: var(--clr-gold); font-weight: 500; }

.lx-cart-checkout {
  display: block; text-align: center;
  padding: 12px; background: var(--clr-gold); color: var(--clr-bg);
  font-family: var(--font-sans); font-size: 11px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.08em;
  transition: background .2s;
}
.lx-cart-checkout:hover { background: #b8935a; }

/* ══════════════════
   NAVBAR
══════════════════ */
.lx-navbar {
  background: var(--clr-surface);
  border-bottom: 1px solid var(--clr-border);
  position: sticky; top: 0; z-index: 900;
  transition: box-shadow .3s;
}
.lx-navbar.scrolled {
  box-shadow: 0 4px 40px rgba(0,0,0,0.5);
}
.lx-navbar .inner {
  max-width: 1380px; margin: 0 auto; padding: 0 28px;
  display: flex; align-items: stretch; justify-content: space-between;
  height: 52px;
}

/* Categories mega */
.lx-cat { position: relative; }
.lx-cat-btn {
  display: flex; align-items: center; gap: 10px;
  height: 100%; padding: 0 22px;
  background: var(--clr-gold);
  color: var(--clr-bg); font-family: var(--font-sans);
  font-size: 12px; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;
  white-space: nowrap; cursor: pointer; transition: background .2s;
}
.lx-cat-btn:hover { background: #b8935a; }
.lx-cat-btn i { font-size: 16px; }

.lx-cat-panel {
  display: none;
  position: absolute; top: 100%; left: 0;
  min-width: 230px; background: var(--clr-bg);
  border: 1px solid var(--clr-border); border-top: 2px solid var(--clr-gold);
  box-shadow: 0 20px 60px rgba(0,0,0,0.5); z-index: 999;
}
.lx-cat:hover .lx-cat-panel { display: block; }

.lx-cat-item {
  position: relative;
}
.lx-cat-item > a {
  display: flex; align-items: center; justify-content: space-between;
  padding: 11px 20px;
  font-family: var(--font-sans); font-size: 12.5px;
  color: var(--clr-muted); letter-spacing: 0.03em;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  transition: all .2s;
}
.lx-cat-item > a:hover { color: var(--clr-gold); background: var(--clr-hover); padding-left: 26px; }
.lx-cat-item > a i { font-size: 10px; opacity: 0.5; }

.lx-sub-cat {
  display: none;
  position: absolute; top: 0; left: 100%;
  min-width: 200px; background: var(--clr-bg);
  border: 1px solid var(--clr-border);
  box-shadow: 10px 10px 40px rgba(0,0,0,0.4);
}
.lx-cat-item:hover .lx-sub-cat { display: block; }
.lx-sub-cat li a {
  display: block; padding: 10px 18px;
  font-family: var(--font-sans); font-size: 12px;
  color: var(--clr-muted); letter-spacing: 0.03em;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  transition: all .2s;
}
.lx-sub-cat li a:hover { color: var(--clr-gold); background: var(--clr-hover); padding-left: 24px; }

/* Main nav */
.lx-nav {
  display: flex; align-items: stretch;
  font-family: var(--font-sans); font-size: 12px;
  font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase;
}
.lx-nav-item { position: relative; display: flex; }
.lx-nav-item > a {
  display: flex; align-items: center;
  padding: 0 18px; color: var(--clr-muted);
  transition: color .2s; white-space: nowrap;
  border-bottom: 2px solid transparent;
}
.lx-nav-item > a:hover,
.lx-nav-item > a.active { color: var(--clr-gold); border-bottom-color: var(--clr-gold); }

/* sub-menu */
.lx-sub {
  display: none;
  position: absolute; top: 100%; left: 0;
  min-width: 200px; background: var(--clr-bg);
  border: 1px solid var(--clr-border); border-top: 2px solid var(--clr-gold);
  box-shadow: 0 20px 50px rgba(0,0,0,0.5); z-index: 998;
}
.lx-nav-item:hover .lx-sub { display: block; }
.lx-sub li a {
  display: block; padding: 10px 20px;
  font-size: 11.5px; color: var(--clr-muted); letter-spacing: 0.04em;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  transition: all .2s;
}
.lx-sub li a:hover { color: var(--clr-gold); background: var(--clr-hover); padding-left: 26px; }

/* Social */
.lx-social { display: flex; align-items: center; gap: 0; }
.lx-social-label {
  font-family: var(--font-sans); font-size: 11px;
  text-transform: uppercase; letter-spacing: 0.07em;
  color: var(--clr-muted); padding-right: 14px;
  border-right: 1px solid var(--clr-border); margin-right: 14px;
}
.lx-social-links { display: flex; align-items: center; gap: 2px; }
.lx-social-links a {
  display: flex; align-items: center; justify-content: center;
  width: 34px; height: 34px; color: var(--clr-muted); font-size: 14px;
  transition: all .2s;
}
.lx-social-links a:hover { color: var(--clr-gold); background: var(--clr-gold-dim); }

/* ══════════════════
   MOBILE TOGGLE
══════════════════ */
.lx-mobile-toggle {
  display: none; flex-direction: column; gap: 5px;
  justify-content: center; padding: 0 14px; cursor: pointer;
}
.lx-mobile-toggle span {
  display: block; width: 22px; height: 1.5px;
  background: var(--clr-white); transition: all .3s;
}

/* ── Responsive ── */
@media (max-width: 991px) {
  .lx-mid .inner { grid-template-columns: 1fr auto; }
  .lx-search { display: none; }
  .lx-hotline { display: none; }
  .lx-top-mid { display: none; }
  .lx-mobile-toggle { display: flex; }

  .lx-nav { display: none; flex-direction: column; width: 100%; }
  .lx-nav.open { display: flex; }
  .lx-nav-item { flex-direction: column; }
  .lx-nav-item > a { padding: 12px 20px; border-bottom: 1px solid var(--clr-border); }
  .lx-sub { position: static; border-top: none; box-shadow: none; display: none; }
  .lx-sub.open { display: block; }

  .lx-navbar .inner { flex-wrap: wrap; height: auto; padding: 0; }
  .lx-cat { width: 100%; }
  .lx-cat-btn { width: 100%; justify-content: flex-start; }
  .lx-cat-panel { position: static; min-width: 100%; display: none; box-shadow: none; border: none; border-top: 1px solid var(--clr-border); }
  .lx-cat.open .lx-cat-panel { display: block; }
  .lx-social { display: none; }

  /* On mobile, user dropdown opens on click instead of hover */
  .lx-user-chip { padding-bottom: 0; margin-bottom: 0; }
  .lx-user-chip .lx-user-dropdown { padding-top: 4px; }
}
</style>

<div class="preloader" id="preloader">
    <div class="preloader-box">
        <div class="preloader-logo">MY SHOP</div>
        <div class="preloader-ring">
            <div class="preloader-ring-track"></div>
            <div class="preloader-ring-spin"></div>
            <div class="preloader-ring-spin2"></div>
            <div class="preloader-ring-dot"></div>
        </div>
        <div class="preloader-progress-wrap">
            <div class="preloader-progress-fill"></div>
        </div>
        <div class="preloader-status">Loading experience…</div>
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        const pl = document.getElementById('preloader');
        setTimeout(function () {
            pl.classList.add('hidden');
            setTimeout(function () { pl.remove(); }, 650);
        }, 400);
    });
</script>

<header class="lx-header">

    {{-- ── TOPBAR ──────────────────────────────────── --}}
    <div class="lx-topbar">
        <div class="inner">

            {{-- Currency & Language --}}
            <div class="lx-top-left">
                <div class="lx-sel">
                    <select id="select4" name="currency">
                        <option value="usd" selected>$ USD</option>
                        <option value="eur">€ EURO</option>
                        <option value="cad">$ CAD</option>
                        <option value="inr">₹ INR</option>
                        <option value="cny">¥ CNY</option>
                        <option value="bdt">৳ BDT</option>
                    </select>
                </div>
                <span class="lx-dot"></span>
                <div class="lx-sel">
                    <select id="select5" name="language">
                        <option value="en" selected>English</option>
                        <option value="es">Español</option>
                        <option value="ph">Filipino</option>
                        <option value="fr">Français</option>
                        <option value="ar">العربية</option>
                        <option value="hi">हिन्दी</option>
                        <option value="bn">বাংলা</option>
                    </select>
                </div>
            </div>

            {{-- Nav Links --}}
            <div class="lx-top-mid">
                <a href="{{ route('home') }}">Home</a>
                <span class="lx-dot"></span>
                <a href="{{ route('home.about-us') }}">About Us</a>
                <span class="lx-dot"></span>
                <a href="{{ route('home.contact-us') }}">Contact Us</a>
            </div>

            {{-- Auth --}}
            <div class="lx-top-right">
                @if(Session::get('customer_id'))
                    {{-- ╔══════════════════════════════════════╗
                         ║  FIXED: padding-top bridges the gap  ║
                         ║  between chip text and dropdown box   ║
                         ╚══════════════════════════════════════╝ --}}
                    <div class="lx-user-chip">
                        <i class="lni lni-user"></i>
                        {{ Session('customer_name') }}
                        <div class="lx-user-dropdown">
                            <div class="lx-user-dropdown-inner">
                                <ul>
                                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('customer-logout') }}">Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="lx-auth">
                        <a href="{{ route('customer-login') }}">Sign In</a>
                        <span class="lx-auth-sep">/</span>
                        <a href="{{ route('customer-login') }}">Register</a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ── HEADER MIDDLE ───────────────────────────── --}}
    <div class="lx-mid">
        <div class="inner">

            {{-- Logo --}}
            <a class="lx-logo" href="{{ route('home') }}">
                <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="ShopGrids Logo">
            </a>

            {{-- Search --}}
            <div class="lx-search">
                <div class="lx-search-cat">
                    <select id="search-category" name="search_category">
                        <option value="" selected>All</option>
                        <option value="1">option 01</option>
                        <option value="2">option 02</option>
                        <option value="3">option 03</option>
                        <option value="4">option 04</option>
                        <option value="5">option 05</option>
                    </select>
                </div>
                <div class="lx-search-input">
                    <input type="text" id="search-query" name="search_query" placeholder="Search for products…">
                </div>
                <button class="lx-search-btn" type="button" aria-label="Search">
                    <i class="lni lni-search-alt"></i>
                </button>
            </div>

            {{-- Actions --}}
            <div class="lx-actions">
                <div class="lx-hotline">
                    <i class="lni lni-phone"></i>
                    <h3>Hotline: <span>(+100) 123 456 7890</span></h3>
                </div>
                <div class="lx-icon-group">
                    {{-- Wishlist --}}
                    <button class="lx-wishlist-btn" aria-label="Wishlist">
                        <i class="lni lni-heart"></i>
                        <span class="lx-badge">0</span>
                    </button>

                    {{-- Cart — same bridge fix applied --}}
                    <div class="lx-cart-wrap">
                        <button class="lx-cart-btn" aria-label="Cart">
                            <i class="lni lni-cart"></i>
                            {{ count($cart_items ?? []) }} Items
                        </button>

                        <div class="lx-cart-dropdown">
                            <div class="lx-cart-dropdown-inner">
                                <div class="lx-cart-head">
                                    <span>{{ count($cart_items ?? []) }} Items</span>
                                    <a href="{{ route('show-cart') }}">View Cart</a>
                                </div>
                                <ul class="lx-cart-list">
                                    @php($total = 0)
                                    @foreach ($cart_items ?? [] as $item)
                                        @php($total += $item->price)
                                        <li class="lx-cart-item">
                                            <div class="lx-cart-item-img">
                                                <a href="{{ route('product-detail', ['id' => $item->id ?? '#']) }}">
                                                    <img src="{{ $item->image }}" alt="{{ $item->name }}">
                                                </a>
                                            </div>
                                            <div class="lx-cart-item-body">
                                                <h4><a href="{{ route('product-detail', ['id' => $item->id ?? '#']) }}">{{ $item->name }}</a></h4>
                                                <p>1 × <span>${{ $item->price }}</span></p>
                                            </div>
                                            <a href="javascript:void(0)" class="lx-cart-remove" title="Remove this item">
                                                <i class="lni lni-close"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="lx-cart-footer">
                                    <div class="lx-cart-total">
                                        <span>Total</span>
                                        <span>${{ number_format($total, 2) }}</span>
                                    </div>
                                    <a href="{{ route('show-cart') }}" class="lx-cart-checkout">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ── NAVBAR ──────────────────────────────────── --}}
    <div class="lx-navbar" id="lxNavbar">
        <div class="inner">

            {{-- Categories --}}
            <div class="lx-cat" id="lxCat">
                <button class="lx-cat-btn" aria-label="All Categories">
                    <i class="lni lni-menu"></i> All Categories
                </button>
                <ul class="lx-cat-panel">
                    @foreach ($categories as $category)
                        <li class="lx-cat-item">
                            <a href="{{ route('product-category', ['id' => $category->id]) }}">
                                {{ $category->name }}
                                @if($category->subCategories->count() > 0)
                                    <i class="lni lni-chevron-right"></i>
                                @endif
                            </a>
                            @if($category->subCategories->count() > 0)
                                <ul class="lx-sub-cat">
                                    @foreach ($category->subCategories as $subCategory)
                                        <li>
                                            <a href="{{ route('product-category', ['id' => $subCategory->id]) }}">
                                                {{ $subCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Mobile Toggle --}}
            <button class="lx-mobile-toggle" id="lxToggle" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>

            {{-- Main Nav --}}
            <nav>
                <ul class="lx-nav" id="lxNav">
                    <li class="lx-nav-item">
                        <a href="{{ route('home') }}" class="active">Home</a>
                    </li>
                    <li class="lx-nav-item">
                        <a href="javascript:void(0)">Pages</a>
                        <ul class="lx-sub">
                            <li><a href="{{ route('home.about-us') }}">About Us</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="{{ route('customer-login') }}">Login</a></li>
                            <li><a href="{{ route('customer-login') }}">Register</a></li>
                            <li><a href="404.html">404 Error</a></li>
                        </ul>
                    </li>
                    <li class="lx-nav-item">
                        <a href="javascript:void(0)">Shop</a>
                        <ul class="lx-sub">
                            <li><a href="product-grids.html">Shop Grid</a></li>
                            <li><a href="product-list.html">Shop List</a></li>
                            <li><a href="product-details.html">Shop Single</a></li>
                            <li><a href="{{ route('show-cart') }}">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                        </ul>
                    </li>
                    <li class="lx-nav-item">
                        <a href="javascript:void(0)">Blog</a>
                        <ul class="lx-sub">
                            <li><a href="blog-grid-sidebar.html">Blog Grid Sidebar</a></li>
                            <li><a href="blog-single.html">Blog Single</a></li>
                            <li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
                        </ul>
                    </li>
                    <li class="lx-nav-item">
                        <a href="{{ route('home.contact-us') }}">Contact Us</a>
                    </li>
                </ul>
            </nav>

            {{-- Social --}}
            <div class="lx-social">
                <span class="lx-social-label">Follow</span>
                <div class="lx-social-links">
                    <a href="javascript:void(0)" aria-label="Facebook"><i class="lni lni-facebook-filled"></i></a>
                    <a href="javascript:void(0)" aria-label="Twitter"><i class="lni lni-twitter-original"></i></a>
                    <a href="javascript:void(0)" aria-label="Instagram"><i class="lni lni-instagram"></i></a>
                    <a href="javascript:void(0)" aria-label="Skype"><i class="lni lni-skype"></i></a>
                </div>
            </div>

        </div>
    </div>

</header>

<script>
(function () {
    // Sticky navbar shadow
    const navbar = document.getElementById('lxNavbar');
    window.addEventListener('scroll', function () {
        navbar.classList.toggle('scrolled', window.scrollY > 10);
    });

    // Mobile nav toggle
    document.getElementById('lxToggle').addEventListener('click', function () {
        document.getElementById('lxNav').classList.toggle('open');
    });

    // Mobile sub-menu accordion
    document.querySelectorAll('.lx-nav-item > a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992) {
                const sub = this.parentElement.querySelector('.lx-sub');
                if (sub) sub.classList.toggle('open');
            }
        });
    });

    // Mobile categories toggle
    document.querySelector('.lx-cat-btn').addEventListener('click', function () {
        if (window.innerWidth < 992) {
            document.getElementById('lxCat').classList.toggle('open');
        }
    });

    // Mobile: user dropdown click toggle
    var userChip = document.querySelector('.lx-user-chip');
    if (userChip) {
        userChip.addEventListener('click', function (e) {
            if (window.innerWidth < 992) {
                var dd = this.querySelector('.lx-user-dropdown');
                if (dd) {
                    dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
                }
                e.stopPropagation();
            }
        });
        // Close on outside click (mobile)
        document.addEventListener('click', function () {
            if (window.innerWidth < 992) {
                var dd = userChip.querySelector('.lx-user-dropdown');
                if (dd) dd.style.display = '';
            }
        });
    }
})();
</script>