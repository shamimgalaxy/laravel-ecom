<style>

@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@300;400&display=swap');

:root {
  --white:        #ffffff;
  --off-white:    #faf9f7;
  --cream:        #f4f1ea;
  --light-gray:   #e9e5dc;
  --mid-gray:     #aca89f;
  --dark-gray:    #6a665e;
  --charcoal:     #242220;
  --ink:          #0e0d0b;
  --ink-soft:     #1c1a17;

  --gold:         #c8a45a;
  --gold-light:   #e4ceA0;
  --gold-lighter: #f2e8cc;
  --gold-dark:    #8f6f30;
  --gold-glow:    rgba(200,164,90,0.15);
  --gold-subtle:  rgba(200,164,90,0.08);

  --accent:       #c94f2a;
  --accent-soft:  #fce9e3;

  --font-display: 'Cormorant Garamond', Georgia, serif;
  --font-body:    'DM Sans', system-ui, sans-serif;
  --font-mono:    'DM Mono', monospace;

  --radius-sm:   3px;
  --radius-md:   8px;
  --radius-lg:   14px;
  --radius-xl:   22px;

  --shadow-subtle: 0 1px 12px rgba(14,13,11,0.06);
  --shadow-card:   0 4px 32px rgba(14,13,11,0.1);
  --shadow-hover:  0 16px 64px rgba(14,13,11,0.18);
  --shadow-gold:   0 8px 32px rgba(200,164,90,0.22);

  --transition:      0.3s cubic-bezier(0.4,0,0.2,1);
  --transition-fast: 0.18s cubic-bezier(0.4,0,0.2,1);

  --btn-text: rgb(112, 110, 104);
}

.lx-header *, .lx-header *::before, .lx-header *::after {
  box-sizing: border-box; margin: 0; padding: 0;
}
.lx-header a { text-decoration: none; color: inherit; }
.lx-header ul { list-style: none; }
.lx-header button { border: none; background: none; cursor: pointer; font-family: var(--font-body); }
.lx-header select { -webkit-appearance: none; appearance: none; cursor: pointer; }

/* ══ STICKY HEADER ══════════════════════════════════════ */
.lx-header {
  position: sticky; top: 0; z-index: 1000; width: 100%;
  transition: box-shadow var(--transition);
}
.lx-header.scrolled {
  box-shadow: 0 4px 40px rgba(14,13,11,0.08);
}

/* ══ PRELOADER ══════════════════════════════════════════ */
.preloader {
  position: fixed; inset: 0; z-index: 99999;
  background: var(--ink);
  display: flex; align-items: center; justify-content: center;
  transition: opacity 0.5s ease;
}
.preloader-box {
  display: flex; flex-direction: column; align-items: center; gap: 36px;
  position: relative;
}
.preloader-box::before,
.preloader-box::after {
  content: ''; position: absolute; left: 50%; transform: translateX(-50%);
  width: 1px; background: linear-gradient(180deg, transparent, var(--gold), transparent);
  animation: pl-vline 2.5s ease-in-out infinite;
}
.preloader-box::before { top: -60px; height: 50px; }
.preloader-box::after  { bottom: -60px; height: 50px; }
@keyframes pl-vline { 0%,100%{opacity:0;} 50%{opacity:0.6;} }

.preloader-wordmark {
  font-family: var(--font-display); font-size: 42px; font-weight: 300;
  letter-spacing: 0.32em; text-transform: uppercase; color: var(--off-white);
  animation: pl-fade 1s 0.2s both; position: relative;
}
.preloader-wordmark span { color: var(--gold); font-style: italic; }
.preloader-wordmark::after {
  content: ''; position: absolute; bottom: -8px; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent); opacity: 0.5;
}
@keyframes pl-fade { from{opacity:0;transform:translateY(10px) scale(0.98);} to{opacity:1;transform:none;} }

.preloader-ring { position: relative; width: 64px; height: 64px; }
.pl-track { position: absolute; inset: 0; border-radius: 50%; border: 1px solid rgba(200,164,90,0.1); }
.pl-spin {
  position: absolute; inset: 0; border-radius: 50%; border: 1px solid transparent;
  border-top-color: var(--gold); border-right-color: rgba(200,164,90,0.3);
  animation: pl-spin 1.4s cubic-bezier(0.6,0.2,0.4,0.8) infinite;
}
.pl-spin2 {
  position: absolute; inset: 14px; border-radius: 50%; border: 1px solid transparent;
  border-bottom-color: rgba(200,164,90,0.25);
  animation: pl-spin 0.9s cubic-bezier(0.6,0.2,0.4,0.8) infinite reverse;
}
.pl-dot {
  position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
  width: 4px; height: 4px; border-radius: 50%; background: var(--gold);
  animation: pl-pulse 1.4s ease-in-out infinite;
}
@keyframes pl-spin  { to{transform:rotate(360deg);} }
@keyframes pl-pulse { 0%,100%{opacity:0.2;transform:translate(-50%,-50%) scale(0.6);} 50%{opacity:1;transform:translate(-50%,-50%) scale(1.6);} }

.preloader-bar-wrap {
  width: 140px; height: 1px; background: rgba(200,164,90,0.1);
  overflow: hidden; animation: pl-fade 1s 0.5s both;
}
.preloader-bar-fill {
  width: 100%; height: 100%;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  transform: translateX(-100%); animation: pl-sweep 1.8s ease-in-out infinite;
}
@keyframes pl-sweep { 0%{transform:translateX(-100%);} 100%{transform:translateX(100%);} }
.preloader-status {
  font-family: var(--font-body); font-size: 9px; letter-spacing: 0.28em;
  text-transform: uppercase; color: rgba(200,164,90,0.35); animation: pl-fade 1s 0.8s both;
}

/* ══ ANNOUNCEMENT ════════════════════════════════════════ */
.lx-announce {
  background: var(--ink); border-bottom: 1px solid rgba(200,164,90,0.12);
  padding: 10px 0; overflow: hidden; position: relative;
  max-height: 40px; opacity: 1;
  transition: max-height 0.4s ease, padding 0.4s ease, opacity 0.3s ease;
}
.lx-header.scrolled .lx-announce { max-height: 0; padding: 0; opacity: 0; pointer-events: none; }
.lx-announce::before,
.lx-announce::after {
  content: ''; position: absolute; top: 0; bottom: 0; width: 80px; z-index: 2; pointer-events: none;
}
.lx-announce::before { left: 0; background: linear-gradient(90deg, var(--ink), transparent); }
.lx-announce::after  { right: 0; background: linear-gradient(-90deg, var(--ink), transparent); }
.lx-announce-track {
  display: flex; width: max-content;
  animation: announce-scroll 32s linear infinite;
}
.lx-announce-track:hover { animation-play-state: paused; }
@keyframes announce-scroll { from{transform:translateX(0);} to{transform:translateX(-50%);} }
.lx-announce-item {
  display: flex; align-items: center; gap: 12px; padding: 0 56px;
  font-family: var(--font-body); font-size: 10.5px; font-weight: 500;
  letter-spacing: 0.14em; text-transform: uppercase; color: var(--gold-light); white-space: nowrap;
}
.lx-announce-sep {
  display: inline-block; width: 3px; height: 3px;
  border-radius: 50%; background: var(--gold); opacity: 0.4;
}

/* ══ TOPBAR ══════════════════════════════════════════════ */
.lx-topbar {
  background: var(--ink-soft); border-bottom: 1px solid rgba(255,255,255,0.05);
  font-family: var(--font-body); font-size: 11px; font-weight: 400; letter-spacing: 0.06em;
  max-height: 40px; overflow: visible; opacity: 1;
  transition: max-height 0.4s ease, opacity 0.3s ease;
}
.lx-header.scrolled .lx-topbar { max-height: 0; opacity: 0; pointer-events: none; }
.lx-topbar .inner {
  max-width: 1320px; margin: 0 auto; padding: 0 36px;
  display: flex; align-items: center; justify-content: space-between; height: 40px;
  overflow: visible;
}
.lx-top-left  { display: flex; align-items: center; gap: 18px; }
.lx-top-mid   { display: flex; align-items: center; gap: 10px; }
.lx-top-right { display: flex; align-items: center; gap: 18px; overflow: visible; position: relative; }

.lx-sel { position: relative; display: inline-flex; align-items: center; }
.lx-sel select {
  background: transparent; border: none; color: rgba(172,168,159,0.8);
  font: inherit; font-size: 10.5px; letter-spacing: 0.07em; padding-right: 16px;
  transition: color var(--transition);
}
.lx-sel select:hover { color: var(--gold-light); }
.lx-sel::after {
  content: ''; position: absolute; right: 2px; top: 50%;
  width: 3.5px; height: 3.5px; border-right: 1px solid var(--mid-gray);
  border-bottom: 1px solid var(--mid-gray);
  transform: translateY(-68%) rotate(45deg); pointer-events: none; opacity: 0.6;
}
.lx-sel select option { background: var(--charcoal); color: var(--off-white); }
.lx-divider { width: 1px; height: 12px; background: rgba(255,255,255,0.08); }

.lx-top-mid a {
  font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase;
  color: rgba(172,168,159,0.65); transition: color var(--transition);
  position: relative; padding: 0 2px;
}
.lx-top-mid a::after {
  content: ''; position: absolute; bottom: -2px; left: 0;
  width: 0; height: 1px; background: var(--gold); transition: width var(--transition);
}
.lx-top-mid a:hover { color: var(--gold-light); }
.lx-top-mid a:hover::after { width: 100%; }
.lx-top-dot { width: 2px; height: 2px; border-radius: 50%; background: rgba(255,255,255,0.1); display: inline-block; }

.lx-auth { display: flex; align-items: center; gap: 14px; }
.lx-auth a {
  font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase;
  color: rgba(172,168,159,0.65); transition: color var(--transition);
}
.lx-auth a:hover { color: var(--gold); }
.lx-auth-sep { color: rgba(255,255,255,0.12); font-size: 9px; }

/* ══ USER CHIP ═══════════════════════════════════════════ */
.lx-user-chip {
  position: relative;
  display: flex; align-items: center; gap: 8px;
  padding: 10px 0;
  font-size: 10.5px; letter-spacing: 0.07em; color: var(--gold-light);
  cursor: pointer; user-select: none;
}
.lx-user-chip i { color: var(--gold); font-size: 13px; }

.lx-user-dropdown {
  display: none;
  position: absolute; top: calc(100% + 2px); right: 0;
  min-width: 170px; z-index: 99999;
}
.lx-user-dropdown::before {
  content: ''; position: absolute; top: -10px; left: 0; right: 0; height: 10px;
}
.lx-user-dropdown.open { display: block; }

.lx-user-dropdown-inner {
  background: var(--off-white); border: 1px solid var(--light-gray);
  border-top: 2px solid var(--gold);
  box-shadow: var(--shadow-hover); border-radius: var(--radius-md); overflow: hidden;
}
.lx-user-dropdown li a {
  display: block; padding: 12px 18px; font-size: 10.5px;
  text-transform: uppercase; letter-spacing: 0.1em;
  color: var(--dark-gray); border-bottom: 1px solid var(--light-gray);
  transition: all var(--transition);
}
.lx-user-dropdown li:last-child a { border-bottom: none; }
.lx-user-dropdown li a:hover { color: var(--gold-dark); background: var(--cream); padding-left: 24px; }

/* ══ HEADER MIDDLE ═══════════════════════════════════════ */
.lx-mid {
  background: var(--white);
  transition: background 0.35s ease, border-color var(--transition);
}
.lx-header.scrolled .lx-mid {
  background: rgba(255,255,255,0.75);
  border-bottom-color: rgba(233,229,220,0.4);
  backdrop-filter: blur(20px) saturate(1.8);
  -webkit-backdrop-filter: blur(20px) saturate(1.8);
}
.lx-mid .inner {
  max-width: 1320px; margin: 0 auto; padding: 0 36px;
  display: grid; grid-template-columns: auto 1fr auto;
  align-items: center; gap: 32px;
  height: 100px; transition: height var(--transition);
}
.lx-header.scrolled .lx-mid .inner { height: 68px; }

.lx-logo-wrap { display: flex; align-items: center; flex-shrink: 0; }
.lx-logo-wordmark {
  font-family: var(--font-display); font-size: 40px; font-weight: 300;
  letter-spacing: 0.18em; color: var(--ink); line-height: 1;
  transition: font-size var(--transition);
}
.lx-header.scrolled .lx-logo-wordmark { font-size: 32px; }
.lx-logo-wordmark span { color: var(--gold); font-style: italic; }
.lx-logo-img { height: 40px; width: auto; display: block; transition: height var(--transition); }
.lx-header.scrolled .lx-logo-img { height: 32px; }

.lx-search-form { display: contents; }
.lx-search {
  display: flex; align-items: stretch; border: 1px solid var(--light-gray);
  background: var(--white); height: 50px; border-radius: var(--radius-md);
  overflow: hidden; width: 100%;
  transition: border-color var(--transition), box-shadow var(--transition), height var(--transition);
}
.lx-header.scrolled .lx-search { height: 42px; }
.lx-search:focus-within {
  border-color: rgba(200,164,90,0.5);
  box-shadow: 0 0 0 4px var(--gold-subtle), 0 0 0 1px rgba(200,164,90,0.3);
  background: var(--white);
}
.lx-search-cat {
  position: relative; display: flex; align-items: center;
  border-right: 1px solid var(--light-gray); padding: 0 14px 0 18px;
  min-width: 120px; flex-shrink: 0;
}
.lx-search-cat select {
  background: transparent; border: none; color: var(--dark-gray);
  font-family: var(--font-body); font-size: 11.5px; letter-spacing: 0.04em;
  padding-right: 16px; width: 100%;
}
.lx-search-cat::after {
  content: ''; position: absolute; right: 14px; top: 50%;
  width: 4px; height: 4px; border-right: 1px solid var(--mid-gray);
  border-bottom: 1px solid var(--mid-gray);
  transform: translateY(-68%) rotate(45deg); pointer-events: none;
}
.lx-search-cat select option { background: var(--white); color: var(--ink); }
.lx-search-input { flex: 1; display: flex; align-items: center; min-width: 0; }
.lx-search-input input {
  width: 100%; background: transparent; border: none; outline: none;
  color: var(--ink); font-family: var(--font-body); font-size: 13px; padding: 0 20px;
}
.lx-search-input input::placeholder { color: var(--mid-gray); font-style: italic; }
.lx-search-btn {
  display: flex; align-items: center; justify-content: center;
  width: 54px; background: var(--ink); border: none; cursor: pointer;
  transition: background var(--transition); flex-shrink: 0;
}
.lx-search-btn:hover { background: var(--gold); }
.lx-search-btn i { color: rgba(172,168,159,0.65); font-size: 16px; }

.lx-actions {
  display: flex; align-items: center; gap: 20px;
  overflow: visible; position: relative; flex-shrink: 0;
}
.lx-hotline { display: flex; align-items: center; gap: 14px; }
.lx-hotline-icon {
  width: 44px; height: 44px; border: 1px solid var(--light-gray); border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--gold); flex-shrink: 0; transition: all var(--transition); position: relative;
}
.lx-hotline-icon::before {
  content: ''; position: absolute; inset: -1px; border-radius: 50%;
  border: 1px solid transparent;
  background: linear-gradient(135deg, var(--gold), transparent) border-box;
  -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
  mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
  -webkit-mask-composite: destination-out; mask-composite: exclude;
  opacity: 0; transition: opacity var(--transition);
}
.lx-hotline:hover .lx-hotline-icon { background: var(--ink); color: var(--gold); border-color: var(--gold); }
.lx-hotline:hover .lx-hotline-icon::before { opacity: 1; }
.lx-hotline-icon i { font-size: 17px; }
.lx-hotline-text h3 {
  font-family: var(--font-body); font-size: 9.5px; font-weight: 400;
  letter-spacing: 0.14em; text-transform: uppercase; color: var(--mid-gray); margin-bottom: 3px;
}
.lx-hotline-text span {
  font-family: var(--font-mono); font-size: 14px; font-weight: 400;
  color: var(--ink); white-space: nowrap; letter-spacing: 0.03em;
}
.lx-icon-group { display: flex; align-items: center; gap: 10px; overflow: visible; position: relative; }
.lx-wishlist-btn {
  position: relative; display: flex; align-items: center; justify-content: center;
  width: 46px; height: 46px; border: 1px solid var(--light-gray);
  border-radius: var(--radius-md); background: var(--white);
  color: var(--dark-gray); font-size: 17px; transition: all var(--transition); cursor: pointer;
}
.lx-wishlist-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-subtle); }
.lx-badge {
  position: absolute; top: -7px; right: -7px; min-width: 18px; height: 18px;
  border-radius: var(--radius-sm); background: var(--accent); color: var(--white);
  font-family: var(--font-body); font-size: 10px; font-weight: 600;
  display: flex; align-items: center; justify-content: center; padding: 0 4px;
  border: 2px solid var(--white);
}

/* ══ CART ════════════════════════════════════════════════ */
.lx-cart-wrap { position: relative; overflow: visible; z-index: 9990; }
.lx-cart-btn {
  display: flex; align-items: center; gap: 10px; padding: 0 24px; height: 46px;
  background: var(--ink); color: var(--btn-text); font-family: var(--font-body);
  font-size: 10.5px; font-weight: 600; letter-spacing: 0.13em; text-transform: uppercase;
  border: none; cursor: pointer; border-radius: var(--radius-md);
  transition: background var(--transition), color var(--transition); white-space: nowrap;
  overflow: visible;
  position: relative;
}
.lx-cart-btn:hover { background: var(--gold); color: var(--ink); }
.lx-cart-btn i { font-size: 17px; }
.lx-cart-dropdown {
  display: none; position: absolute; top: calc(100% + 50px); right: 0; width: 380px; z-index: 9999;
}
.lx-cart-wrap.cart-open .lx-cart-dropdown { display: block; }
.lx-cart-dropdown-inner {
  background: var(--white); border: 1px solid var(--light-gray);
  border-top: 2px solid var(--gold); border-radius: var(--radius-lg);
  overflow: visible; box-shadow: var(--shadow-hover);
}
.lx-cart-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 24px; border-bottom: 1px solid var(--light-gray);
  border-radius: var(--radius-lg) var(--radius-lg) 0 0; overflow: hidden;
}
.lx-cart-head-label { font-family: var(--font-display); font-size: 22px; font-weight: 400; color: var(--ink); letter-spacing: 0.03em; }
.lx-cart-head-label small {
  font-family: var(--font-body); font-size: 10px; letter-spacing: 0.1em;
  text-transform: uppercase; color: var(--mid-gray); font-weight: 400;
  margin-left: 6px; vertical-align: middle;
}
.lx-cart-head a {
  font-family: var(--font-body); font-size: 10px; letter-spacing: 0.12em;
  text-transform: uppercase; color: var(--gold-dark); transition: color var(--transition);
}
.lx-cart-head a:hover { color: var(--gold); }
.lx-cart-list { max-height: 280px; overflow-y: auto; }
.lx-cart-list::-webkit-scrollbar { width: 2px; }
.lx-cart-list::-webkit-scrollbar-thumb { background: var(--light-gray); border-radius: 2px; }
.lx-cart-item {
  display: flex; align-items: flex-start; gap: 16px; padding: 16px 24px;
  border-bottom: 1px solid rgba(233,229,220,0.7); transition: background var(--transition);
}
.lx-cart-item:last-child { border-bottom: none; }
.lx-cart-item:hover { background: var(--off-white); }
.lx-cart-item-img {
  width: 58px; height: 58px; flex-shrink: 0; border: 1px solid var(--light-gray);
  border-radius: var(--radius-md); overflow: hidden; background: var(--cream);
}
.lx-cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
.lx-cart-item-body { flex: 1; min-width: 0; }
.lx-cart-item-cat {
  font-family: var(--font-body); font-size: 8.5px; font-weight: 600;
  letter-spacing: 0.16em; text-transform: uppercase; color: var(--gold); margin-bottom: 4px;
}
.lx-cart-item-body h4 {
  font-family: var(--font-body); font-size: 12.5px; font-weight: 500; color: var(--ink);
  line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 6px;
}
.lx-cart-item-body h4 a { color: inherit; transition: color var(--transition); }
.lx-cart-item-body h4 a:hover { color: var(--gold-dark); }
.lx-cart-item-meta { font-family: var(--font-mono); font-size: 11.5px; color: var(--dark-gray); letter-spacing: 0.02em; }
.lx-cart-item-meta span { color: var(--gold-dark); }
.lx-cart-remove {
  color: var(--mid-gray); font-size: 11px; flex-shrink: 0; padding: 4px;
  transition: all var(--transition); cursor: pointer; background: none; border: none;
  width: 26px; height: 26px; display: flex; align-items: center; justify-content: center;
  border-radius: var(--radius-sm);
}
.lx-cart-remove:hover { color: var(--accent); background: var(--accent-soft); }
.lx-cart-item.removing { opacity: 0.35; pointer-events: none; }
.lx-cart-footer {
  padding: 18px 24px; border-top: 1px solid var(--light-gray);
  background: var(--off-white); border-radius: 0 0 var(--radius-lg) var(--radius-lg); overflow: hidden;
}
.lx-cart-total { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 14px; }
.lx-cart-total-label {
  font-family: var(--font-body); font-size: 9.5px; font-weight: 600;
  letter-spacing: 0.16em; text-transform: uppercase; color: var(--mid-gray);
}
.lx-cart-total-price { font-family: var(--font-display); font-size: 26px; font-weight: 400; color: var(--ink); letter-spacing: 0.01em; }
.lx-cart-checkout {
  display: flex; align-items: center; justify-content: center; gap: 10px; padding: 14px;
  background: rgba(33, 31, 36, 0.08); color: var(--white); font-family: var(--font-body);
  font-size: 10.5px; font-weight: 600; letter-spacing: 0.13em; text-transform: uppercase;
  border-radius: var(--radius-md); transition: background var(--transition), color var(--transition);
}
.lx-cart-checkout:hover { background: var(--gold); color: var(--ink); box-shadow: var(--shadow-gold); }
.lx-cart-checkout i { font-size: 14px; }
.lx-cart-empty-msg {
  padding: 40px 24px; text-align: center; font-family: var(--font-body);
  font-size: 11.5px; letter-spacing: 0.08em; color: var(--mid-gray);
}
.lx-cart-empty-msg i { font-size: 30px; display: block; margin-bottom: 12px; color: var(--light-gray); }

.lx-cart-btn { position: relative; }
.lx-cart-btn .lx-cart-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  min-width: 18px;
  height: 18px;
  border-radius: 3px;
  background: var(--accent);
  color: var(--white);
  font-size: 10px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 4px;
  border: 2px solid var(--white);
  font-family: var(--font-body);
}

/* ══ NAVBAR ══════════════════════════════════════════════ */
.lx-navbar {
  background: var(--white);
  transition: background var(--transition), border-color var(--transition);
}
.lx-header.scrolled .lx-navbar {
  background: rgba(255,255,255,0.75);
  border-bottom-color: rgba(200,164,90,0.15);
  backdrop-filter: blur(20px) saturate(1.8);
  -webkit-backdrop-filter: blur(20px) saturate(1.8);
}
.lx-navbar .inner {
  max-width: 1320px; margin: 0 auto; padding: 0 36px;
  display: flex; align-items: stretch; justify-content: space-between;
  height: 54px; overflow: visible; position: relative;
}
.lx-cat { position: relative; overflow: visible; }
.lx-cat-btn {
  display: flex; align-items: center; gap: 12px; height: 100%; padding: 0 26px;
  background: var(--ink); color: var(--btn-text); font-family: var(--font-body);
  font-size: 10.5px; font-weight: 600; letter-spacing: 0.13em; text-transform: uppercase;
  white-space: nowrap; cursor: pointer; border: none;
  transition: background var(--transition), color var(--transition);
}
.lx-cat-btn:hover { background: var(--gold); color: var(--ink); }
.lx-cat-btn i { font-size: 18px; }
.lx-cat-btn-arrow { margin-left: auto; font-size: 11px; opacity: 0.4; transition: transform var(--transition), opacity var(--transition); }
.lx-cat:hover .lx-cat-btn-arrow { transform: rotate(180deg); opacity: 0.9; }
.lx-cat-panel {
  visibility: hidden; opacity: 0; pointer-events: none;
  position: absolute; top: 100%; left: 0; min-width: 256px;
  background: var(--white); border: 1px solid var(--light-gray);
  border-top: 2px solid var(--gold); border-radius: 0 0 var(--radius-lg) var(--radius-lg);
  box-shadow: var(--shadow-hover); z-index: 9999; transform: translateY(8px);
  transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
}
.lx-cat-panel::before { content: ''; position: absolute; top: -14px; left: 0; right: 0; height: 14px; }
.lx-cat.open .lx-cat-panel { visibility: visible; opacity: 1; pointer-events: auto; transform: translateY(0); }
.lx-cat-item { position: relative; }
.lx-cat-item > a {
  display: flex; align-items: center; justify-content: space-between; padding: 12px 20px;
  font-family: var(--font-body); font-size: 12px; color: var(--charcoal); letter-spacing: 0.03em;
  border-bottom: 1px solid rgba(233,229,220,0.8); transition: all var(--transition-fast);
}
.lx-cat-item:last-child > a { border-bottom: none; }
.lx-cat-item > a i { font-size: 10px; opacity: 0; color: var(--gold); transition: all var(--transition-fast); }
.lx-cat-item > a:hover { color: var(--gold-dark); background: var(--gold-subtle); padding-left: 26px; }
.lx-cat-item > a:hover i { opacity: 1; }
.lx-sub-cat {
  display: none; position: absolute; top: 0; left: 100%; min-width: 200px;
  background: var(--white); border: 1px solid var(--light-gray);
  border-left: 2px solid var(--gold); border-radius: 0 var(--radius-md) var(--radius-md) 0;
  box-shadow: var(--shadow-hover);
}
.lx-cat-item:hover .lx-sub-cat { display: block; }
.lx-sub-cat li a {
  display: block; padding: 10px 18px; font-family: var(--font-body); font-size: 11.5px;
  color: var(--dark-gray); letter-spacing: 0.03em; border-bottom: 1px solid var(--light-gray);
  transition: all var(--transition-fast);
}
.lx-sub-cat li:last-child a { border-bottom: none; }
.lx-sub-cat li a:hover { color: var(--gold-dark); background: var(--gold-subtle); padding-left: 24px; }

.lx-nav {
  display: flex; align-items: stretch; font-family: var(--font-body);
  font-size: 11px; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase;
}
.lx-nav-item { position: relative; display: flex; }
.lx-nav-item > a {
  display: flex; align-items: center; gap: 5px; padding: 0 20px; color: var(--dark-gray);
  white-space: nowrap; border-bottom: 2px solid transparent; transition: all var(--transition);
}
.lx-nav-item > a:hover,
.lx-nav-item > a.active { color: var(--ink); border-bottom-color: var(--gold); }
.lx-nav-item > a i { font-size: 10px; opacity: 0.3; margin-top: 1px; transition: opacity var(--transition); }
.lx-nav-item > a:hover i { opacity: 0.7; }
.lx-sub {
  visibility: hidden; opacity: 0; pointer-events: none;
  position: absolute; top: 100%; left: 0; min-width: 200px;
  background: var(--white); border: 1px solid var(--light-gray);
  border-top: 2px solid var(--gold); border-radius: 0 0 var(--radius-lg) var(--radius-lg);
  box-shadow: var(--shadow-hover); z-index: 9998; transform: translateY(8px);
  transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
}
.lx-sub::before { content: ''; position: absolute; top: -14px; left: 0; right: 0; height: 14px; }
.lx-nav-item:hover .lx-sub,
.lx-nav-item.sub-open .lx-sub { visibility: visible; opacity: 1; pointer-events: auto; transform: translateY(0); }
.lx-sub li a {
  display: block; padding: 11px 20px; font-family: var(--font-body); font-size: 11px;
  color: var(--dark-gray); letter-spacing: 0.07em; border-bottom: 1px solid var(--light-gray);
  transition: all var(--transition-fast);
}
.lx-sub li:last-child a { border-bottom: none; }
.lx-sub li a:hover { color: var(--gold-dark); background: var(--gold-subtle); padding-left: 26px; }

.lx-social { display: flex; align-items: center; gap: 2px; padding: 0 8px; overflow: visible; }
.lx-social-label {
  font-family: var(--font-body); font-size: 9px; text-transform: uppercase; letter-spacing: 0.14em;
  color: var(--mid-gray); padding-right: 14px; border-right: 1px solid var(--light-gray); margin-right: 12px;
}
.lx-social-link {
  display: flex; align-items: center; justify-content: center;
  width: 32px; height: 32px; color: var(--mid-gray); font-size: 15px;
  border-radius: var(--radius-sm); transition: all var(--transition-fast);
}
.lx-social-link:hover { color: var(--gold); background: var(--gold-subtle); }

.lx-mobile-toggle {
  display: none; flex-direction: column; gap: 5px;
  justify-content: center; padding: 0 14px; cursor: pointer;
}
.lx-mobile-toggle span { display: block; width: 22px; height: 1.5px; background: var(--charcoal); transition: all var(--transition); }
.lx-mobile-toggle.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.lx-mobile-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.lx-mobile-toggle.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

/* ══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 1200px) {
  .lx-mid .inner { gap: 20px; }
  .lx-hotline-text span { font-size: 12px; }
}
@media (max-width: 991px) {
  .lx-mid .inner {
    display: flex; flex-wrap: nowrap; justify-content: space-between;
    height: auto; padding: 14px 20px; gap: 14px;
  }
  .lx-search-form { display: none; }
  .lx-hotline { display: none; }
  .lx-top-mid { display: none; }
  .lx-mobile-toggle { display: flex; }
  .lx-nav { display: none; flex-direction: column; width: 100%; }
  .lx-nav.open { display: flex; }
  .lx-nav-item { flex-direction: column; }
  .lx-nav-item > a {
    padding: 14px 20px; border-bottom: 1px solid var(--light-gray); border-left: 2px solid transparent;
  }
  .lx-nav-item > a:hover,
  .lx-nav-item > a.active { border-bottom: 1px solid var(--light-gray); border-left-color: var(--gold); }
  .lx-sub {
    position: static; border-top: none; box-shadow: none;
    visibility: hidden; opacity: 0; max-height: 0; overflow: hidden;
    border-radius: 0; transform: none;
    transition: max-height 0.3s ease, opacity 0.3s ease, visibility 0.3s;
  }
  .lx-sub.open { visibility: visible; opacity: 1; max-height: 999px; pointer-events: auto; }
  .lx-sub li a { padding-left: 32px; }
  .lx-navbar .inner { flex-wrap: wrap; height: auto; padding: 0; }
  .lx-cat { width: 100%; }
  .lx-cat-btn { width: 100%; justify-content: flex-start; }
  .lx-cat-panel {
    position: static; min-width: 100%; display: none; box-shadow: none;
    border: none; border-top: 1px solid var(--light-gray); border-radius: 0;
  }
  .lx-cat.open .lx-cat-panel { display: block; }
  .lx-social { display: none; }
  .lx-header.scrolled .lx-announce { max-height: 40px; padding: 10px 0; opacity: 1; pointer-events: auto; }
  .lx-header.scrolled .lx-topbar  { max-height: 40px; opacity: 1; pointer-events: auto; }
  .lx-user-chip { padding-bottom: 0; margin-bottom: 0; }
  .lx-cart-btn { padding: 0 14px; font-size: 10px; }
  .lx-cart-dropdown { width: calc(100vw - 32px); right: -16px; }
}
@media (max-width: 480px) {
  .lx-cart-btn span:not(:first-child) { display: none; }
  .lx-logo-wordmark { font-size: 28px; }
}

</style>

{{-- ══ PRELOADER ══ --}}
<div class="preloader" id="preloader">
  <div class="preloader-box">
    <div class="preloader-wordmark">LU<span>X</span>E</div>
    <div class="preloader-ring">
      <div class="pl-track"></div>
      <div class="pl-spin"></div>
      <div class="pl-spin2"></div>
      <div class="pl-dot"></div>
    </div>
    <div class="preloader-bar-wrap">
      <div class="preloader-bar-fill"></div>
    </div>
    <div class="preloader-status">Curating your experience…</div>
  </div>
</div>

<header class="lx-header" id="lxHeader">

  {{-- ── ANNOUNCEMENT TICKER ── --}}
  <div class="lx-announce">
    <div class="lx-announce-track">
      <span class="lx-announce-item">Free Shipping on orders over $99 <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">5.5 Mega Sale — Up to 50% Off <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">New Arrivals: iPhone 12 Pro Max <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">24/7 Support — Live Chat or Call <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">Free Shipping on orders over $99 <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">5.5 Mega Sale — Up to 50% Off <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">New Arrivals: iPhone 12 Pro Max <span class="lx-announce-sep"></span></span>
      <span class="lx-announce-item">24/7 Support — Live Chat or Call <span class="lx-announce-sep"></span></span>
    </div>
  </div>

  {{-- ── TOPBAR ── --}}
  <div class="lx-topbar">
    <div class="inner">
      <div class="lx-top-left">
        <div class="lx-sel">
          <select name="currency">
            <option value="usd" selected>$ USD</option>
            <option value="eur">€ EUR</option>
            <option value="cad">$ CAD</option>
            <option value="inr">₹ INR</option>
            <option value="bdt">৳ BDT</option>
          </select>
        </div>
        <div class="lx-divider"></div>
        <div class="lx-sel">
          <select name="language">
            <option value="en" selected>English</option>
            <option value="es">Español</option>
            <option value="fr">Français</option>
            <option value="bn">বাংলা</option>
          </select>
        </div>
      </div>
      <div class="lx-top-mid">
        <a href="{{ route('home') }}">Home</a>
        <span class="lx-top-dot"></span>
        <a href="{{ route('home.about-us') }}">About Us</a>
        <span class="lx-top-dot"></span>
        <a href="{{ route('home.contact-us') }}">Contact Us</a>
      </div>
      <div class="lx-top-right">
        @if(Session::get('customer_id'))
          <div class="lx-user-chip" id="lxUserChip">
            <i class="lni lni-user"></i>
            <span>{{ session('customer_name') }}</span>
            <i class="lni lni-chevron-down" style="font-size:9px; opacity:0.5;"></i>
            <div class="lx-user-dropdown" id="lxUserDropdown">
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

  {{-- ── HEADER MIDDLE ── --}}
  <div class="lx-mid">
    <div class="inner">

      <a class="lx-logo-wrap" href="{{ route('home') }}">
        @if(file_exists(public_path('website/assets/images/logo/logo.svg')))
          <img class="lx-logo-img" src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="Logo">
        @else
          <div class="lx-logo-wordmark">LU<span>X</span>E</div>
        @endif
      </a>

      <form class="lx-search-form" action="" method="GET">
        <div class="lx-search">
          <div class="lx-search-cat">
            <select name="category">
              <option value="">All</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="lx-search-input">
            <input type="text" name="q" placeholder="Search for products, brands…" value="{{ request('q') }}">
          </div>
          <button class="lx-search-btn" type="submit" aria-label="Search">
            <i class="lni lni-search-alt"></i>
          </button>
        </div>
      </form>

      <div class="lx-actions">
        <div class="lx-hotline">
          <div class="lx-hotline-icon"><i class="lni lni-phone"></i></div>
          <div class="lx-hotline-text">
            <h3>Hotline</h3>
            <span>(+100) 123 456 7890</span>
          </div>
        </div>
        <div class="lx-icon-group">
          <button class="lx-wishlist-btn" aria-label="Wishlist">
            <i class="lni lni-heart"></i>
            <span class="lx-badge" id="header-wishlist-count">{{ $wishlist_count ?? 0 }}</span>
          </button>
          <div class="lx-cart-wrap">
            <button class="lx-cart-btn" id="lxCartBtn" aria-label="Cart">
  <i class="lni lni-cart"></i>
  <span>Cart</span>
  <span class="lx-badge lx-cart-badge" id="header-cart-count">{{ $cart_count ?? 0 }}</span>
</button>
            <div class="lx-cart-dropdown">
              <div class="lx-cart-dropdown-inner">
                <div class="lx-cart-head">
                  <div class="lx-cart-head-label">
                    Cart <small>(<span id="header-cart-count-label">{{ $cart_count ?? 0 }}</span>)</small>
                  </div>
                  <a href="{{ route('show-cart') }}">View All</a>
                </div>
                <ul class="lx-cart-list" id="header-cart-list">
    @include('website.includes.cart-items', ['cart' => $cart_items])
</ul>
                <div class="lx-cart-footer">
                  <div class="lx-cart-total">
                    <span class="lx-cart-total-label">Total</span>
                    <span class="lx-cart-total-price" id="header-cart-total">
    {{ $cart_total ?? '৳0.00' }}
</span>
                  </div>
                  <a href="{{ route('show-cart') }}" class="lx-cart-checkout">
                    <i class="lni lni-credit-cards"></i> <span>Proceed to Checkout</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- ── NAVBAR ── --}}
  <div class="lx-navbar">
    <div class="inner">

      <div class="lx-cat" id="lxCat">
        <button class="lx-cat-btn" aria-label="All Categories">
          <i class="lni lni-menu"></i>
          <span>All Categories</span>
          <span class="lx-cat-btn-arrow"><i class="lni lni-chevron-down"></i></span>
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
                  @foreach ($category->subCategories as $sub)
                    <li>
                      <a href="{{ route('product-category', ['id' => $sub->id]) }}">{{ $sub->name }}</a>
                    </li>
                  @endforeach
                </ul>
              @endif
            </li>
          @endforeach
        </ul>
      </div>

      <button class="lx-mobile-toggle" id="lxToggle" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>

      <nav>
        <ul class="lx-nav" id="lxNav">
          <li class="lx-nav-item">
            <a href="{{ route('home') }}" class="active">Home</a>
          </li>
          <li class="lx-nav-item">
            <a href="javascript:void(0)">Pages <i class="lni lni-chevron-down"></i></a>
            <ul class="lx-sub">
              <li><a href="{{ route('home.about-us') }}">About Us</a></li>
              <li><a href="{{ route('customer-login') }}">Login</a></li>
              <li><a href="{{ route('customer-login') }}">Register</a></li>
            </ul>
          </li>
          <li class="lx-nav-item">
            <a href="javascript:void(0)">Shop <i class="lni lni-chevron-down"></i></a>
            <ul class="lx-sub">
              <li><a href="{{ route('show-cart') }}">Cart</a></li>
              <li><a href="{{ route('checkout') }}">Checkout</a></li>
            </ul>
          </li>
          <li class="lx-nav-item">
            <a href="{{ route('home.contact-us') }}">Contact Us</a>
          </li>
        </ul>
      </nav>

      <div class="lx-social">
        <span class="lx-social-label">Follow</span>
        <a class="lx-social-link" href="javascript:void(0)" aria-label="Facebook"><i class="lni lni-facebook-fill"></i></a>
        <a class="lx-social-link" href="javascript:void(0)" aria-label="Twitter"><i class="lni lni-twitter-fill"></i></a>
        <a class="lx-social-link" href="javascript:void(0)" aria-label="Instagram"><i class="lni lni-instagram-fill"></i></a>
      </div>

    </div>
  </div>

</header>
<script src="{{ asset('website/assets/js/header.js') }}"></script>

