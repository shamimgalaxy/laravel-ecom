@extends('website.master')
@section('title')
Online Shopping — Premium Electronics
@endsection

@section('body')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('website/assets/css/LineIcons.3.0.css') }}">
<style>
  :root {
    --white: #ffffff;
    --off-white: #f8f7f4;
    --cream: #f2efe8;
    --light-gray: #e8e5de;
    --mid-gray: #b8b4aa;
    --dark-gray: #6b6760;
    --charcoal: #2c2a26;
    --ink: #1a1814;
    --gold: #c9a84c;
    --gold-light: #e8d49a;
    --gold-dark: #9a7833;
    --accent: #e05a2b;
    --accent-soft: #f5e8e2;
    --font-display: 'Cormorant Garamond', Georgia, serif;
    --font-body: 'DM Sans', system-ui, sans-serif;
    --font-mono: 'DM Mono', monospace;
    --radius-sm: 4px;
    --radius-md: 10px;
    --radius-lg: 18px;
    --radius-xl: 28px;
    --shadow-soft: 0 2px 20px rgba(26,24,20,0.07);
    --shadow-card: 0 4px 40px rgba(26,24,20,0.09);
    --shadow-hover: 0 12px 60px rgba(26,24,20,0.14);
    --transition: 0.35s cubic-bezier(0.4,0,0.2,1);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: var(--font-body);
    background: var(--white);
    color: var(--charcoal);
    font-size: 15px;
    line-height: 1.7;
    overflow-x: hidden;
  }

  a { text-decoration: none; color: inherit; }
  img { display: block; max-width: 100%; }
  ul { list-style: none; }

  .container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 32px;
  }

  .row { display: flex; flex-wrap: wrap; margin: 0 -12px; }
  .row.g-4 { margin: 0 -12px; gap: 0; }
  [class^="col-"] { padding: 0 12px; }
  .col-12 { width: 100%; }
  .col-lg-3 { width: 25%; }
  .col-lg-4 { width: 33.333%; }
  .col-lg-6 { width: 50%; }
  .col-lg-8 { width: 66.666%; }
  .col-md-4 { width: 33.333%; }
  .col-md-6 { width: 50%; }

  .section { padding: 100px 0; }
  .mb-5 { margin-bottom: 48px !important; }

  .d-flex { display: flex; }
  .flex-column { flex-direction: column; }
  .flex-fill { flex: 1 1 auto; }
  .align-items-stretch { align-items: stretch; }
  .gap-4 { gap: 24px; }

  /* ─── NAV ─────────────────────────────── */
  .site-nav {
    position: sticky; top: 0; z-index: 100;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--light-gray);
    padding: 0;
  }
  .nav-inner {
    display: flex; align-items: center; justify-content: space-between;
    height: 72px;
  }
  .nav-logo {
    font-family: var(--font-display);
    font-size: 28px;
    font-weight: 300;
    letter-spacing: 0.12em;
    color: var(--ink);
  }
  .nav-logo span { color: var(--gold); }
  .nav-links { display: flex; gap: 36px; }
  .nav-links a {
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--dark-gray);
    transition: color var(--transition);
    position: relative;
  }
  .nav-links a::after {
    content: '';
    position: absolute; bottom: -4px; left: 0;
    width: 0; height: 1px;
    background: var(--gold);
    transition: width var(--transition);
  }
  .nav-links a:hover { color: var(--ink); }
  .nav-links a:hover::after { width: 100%; }
  .nav-actions { display: flex; gap: 20px; align-items: center; }
  .nav-icon-btn {
    width: 40px; height: 40px;
    border: 1px solid var(--light-gray);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--dark-gray);
    cursor: pointer;
    transition: all var(--transition);
    background: var(--white);
  }
  .nav-icon-btn:hover {
    background: var(--ink);
    border-color: var(--ink);
    color: var(--white);
    transform: scale(1.05);
  }
  .cart-badge {
    position: relative;
  }
  .cart-badge::after {
    content: '3';
    position: absolute; top: -6px; right: -6px;
    background: var(--accent);
    color: white;
    font-size: 10px;
    font-weight: 600;
    width: 18px; height: 18px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
  }

  /* ─── HERO AREA ───────────────────────── */
  .hero-area {
    background: var(--off-white);
    padding: 48px 0 56px;
    position: relative;
    overflow: hidden;
  }
  .blob1 {
    position: absolute; top: -120px; right: -80px;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%);
    pointer-events: none;
  }
  .blob2 {
    position: absolute; bottom: -100px; left: -60px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(224,90,43,0.06) 0%, transparent 70%);
    pointer-events: none;
  }
  .grid-bg {
    position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(26,24,20,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(26,24,20,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
  }

  /* HERO SLIDER */
  .hero-slider-wrap {
    position: relative;
    background: var(--white);
    border-radius: var(--radius-xl);
    overflow: hidden;
    height: 480px;
    border: 1px solid var(--light-gray);
    box-shadow: var(--shadow-card);
  }
  .hero-slide {
    position: absolute; inset: 0;
    display: flex; align-items: center;
    padding: 56px 56px 56px 56px;
    opacity: 0;
    transform: translateX(40px);
    transition: opacity 0.6s ease, transform 0.6s ease;
    pointer-events: none;
  }
  .hero-slide.active {
    opacity: 1; transform: translateX(0);
    pointer-events: auto;
  }
  .hero-slide .content {
    position: relative; z-index: 2;
    max-width: 340px;
  }
  .hero-slide .badge {
    display: inline-block;
    background: var(--gold-light);
    color: var(--gold-dark);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 30px;
    margin-bottom: 18px;
  }
  .hero-slide h2 {
    font-family: var(--font-display);
    font-size: 58px;
    font-weight: 300;
    line-height: 1.05;
    color: var(--ink);
    margin-bottom: 16px;
    letter-spacing: -0.01em;
  }
  .hero-slide p {
    font-size: 15px;
    color: var(--dark-gray);
    line-height: 1.7;
    margin-bottom: 24px;
    font-weight: 300;
  }
  .price-tag {
    font-family: var(--font-mono);
    font-size: 28px;
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 28px;
  }
  .price-tag span {
    font-size: 15px;
    color: var(--mid-gray);
    text-decoration: line-through;
    margin-left: 8px;
    font-family: var(--font-body);
  }
  .slide-imgs-wrap {
    position: absolute;
    right: 0; top: 0; bottom: 0;
    width: 52%;
    overflow: hidden;
  }
  .slide-img {
    position: absolute;
    width: 100%; height: 100%;
    object-fit: cover;
  }
  .slide-img--back { opacity: 0.15; filter: blur(2px); }
  .slide-img--mid { opacity: 1; }
  .slide-img--front { opacity: 0; }
  .slide-glow {
    position: absolute; inset: 0;
    background: linear-gradient(90deg, var(--white) 0%, transparent 50%);
  }
  .hero-dots {
    position: absolute; bottom: 28px; left: 56px;
    display: flex; gap: 8px; z-index: 10;
  }
  .hero-dot {
    width: 24px; height: 3px;
    background: var(--light-gray);
    border-radius: 2px;
    cursor: pointer;
    transition: all var(--transition);
  }
  .hero-dot.active { width: 40px; background: var(--gold); }

  /* SIDE CARDS */
  .hero-side-card {
    display: flex; align-items: flex-end;
    background-size: cover; background-position: center;
    border-radius: var(--radius-xl);
    overflow: hidden;
    padding: 28px;
    position: relative;
    min-height: 200px;
    border: 1px solid var(--light-gray);
    box-shadow: var(--shadow-soft);
    transition: transform var(--transition), box-shadow var(--transition);
  }
  .hero-side-card::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(26,24,20,0.75) 0%, rgba(26,24,20,0.1) 60%, transparent 100%);
  }
  .hero-side-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-hover); }
  .hero-side-card .content {
    position: relative; z-index: 1;
  }
  .hero-side-card .sub {
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--gold-light); margin-bottom: 4px;
  }
  .hero-side-card h3 {
    font-family: var(--font-display);
    font-size: 26px; font-weight: 400;
    color: white; margin-bottom: 6px;
  }
  .hero-side-card .price {
    font-family: var(--font-mono);
    font-size: 16px; color: white; font-weight: 400;
  }

  .hero-sale-card {
    background: var(--ink);
    border-radius: var(--radius-xl);
    padding: 36px 32px;
    display: flex; flex-direction: column; justify-content: center;
    position: relative; overflow: hidden;
    border: 1px solid var(--charcoal);
  }
  .hero-sale-card::before {
    content: '';
    position: absolute; top: -50px; right: -50px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.15) 0%, transparent 70%);
  }
  .hero-sale-card h2 {
    font-family: var(--font-display);
    font-size: 32px; font-weight: 300;
    color: white; margin-bottom: 12px;
    position: relative;
  }
  .hero-sale-card p {
    font-size: 14px; color: var(--mid-gray);
    line-height: 1.6; margin-bottom: 24px;
    position: relative;
  }

  /* ─── BUTTONS ─────────────────────────── */
  .btn-primary-custom {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--ink);
    color: white;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 14px 28px;
    border-radius: var(--radius-md);
    border: none;
    cursor: pointer;
    transition: all var(--transition);
  }
  .btn-primary-custom:hover {
    background: var(--gold);
    color: var(--ink);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(201,168,76,0.25);
  }
  .btn-outline-light-custom {
    display: inline-block;
    border: 1px solid rgba(255,255,255,0.4);
    color: white;
    font-size: 12px; font-weight: 600;
    letter-spacing: 0.08em; text-transform: uppercase;
    padding: 10px 20px;
    border-radius: var(--radius-md);
    transition: all var(--transition);
  }
  .btn-outline-light-custom:hover {
    background: white; color: var(--ink);
  }

  /* ─── PROMO BANNER ────────────────────── */

  .promo-banner-section {
  background: var(--ink);
  padding: 0;
  overflow: hidden;
  margin-bottom: 0;  /* ← add this */
  line-height: 1;    /* ← add this to prevent line-height bleed */
}
  .promo-banner-section {
    background: var(--ink);
    padding: 0;
    overflow: hidden;
  }
  .promo-banner-inner {
  display: flex; align-items: stretch;
  height: auto;  /* ← let content define height */
}
.promo-left, .promo-center, .promo-right {
  flex: 1; padding: 16px 40px;  /* ← reduced vertical padding from 32px → 16px */
  display: flex; flex-direction: column; justify-content: center;
}
  .promo-left { background: var(--charcoal); }
  .promo-center { background: var(--ink); border-left: 1px solid rgba(255,255,255,0.05); text-align: center; }
  .promo-right { background: var(--charcoal); border-left: 1px solid rgba(255,255,255,0.05); align-items: flex-end; }
  .promo-tag {
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--gold); margin-bottom: 6px;
  }
  .promo-title {
    font-family: var(--font-display);
    font-size: 38px; font-weight: 300;
    color: white; line-height: 1;
  }
  .promo-title span { color: var(--gold); }
  .promo-sub { font-size: 13px; color: var(--mid-gray); }
  .promo-percent {
    font-family: var(--font-display);
    font-size: 54px; font-weight: 300;
    color: white; line-height: 1;
  }
  .promo-percent span {
    font-family: var(--font-body);
    font-size: 13px; font-weight: 600;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--gold); display: block; margin-top: 4px;
  }
  .promo-center p { font-size: 13px; color: var(--mid-gray); margin-top: 6px; }
  .promo-badge {
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--gold); margin-bottom: 14px;
  }
  .btn-promo {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--gold);
    color: var(--ink);
    font-size: 12px; font-weight: 700;
    letter-spacing: 0.08em; text-transform: uppercase;
    padding: 12px 24px;
    border-radius: var(--radius-md);
    transition: all var(--transition);
  }
  .btn-promo:hover { background: white; transform: translateY(-2px); }

  /* ─── TRUST BAR ───────────────────────── */
  .trust-bar {
    background: var(--white);
    border-bottom: 1px solid var(--light-gray);
    padding: 28px 0;
  }
  .trust-bar ul {
    display: flex; justify-content: space-between; align-items: center;
  }
  .trust-bar li {
    display: flex; align-items: center; gap: 14px;
  }
  .trust-bar i {
    font-size: 28px;
    color: var(--gold);
  }
  .trust-bar strong {
    display: block;
    font-size: 14px; font-weight: 600;
    color: var(--ink);
    letter-spacing: 0.02em;
  }
  .trust-bar span {
    font-size: 12px; color: var(--dark-gray);
  }

  /* ─── SECTION LABELS ──────────────────── */
  .section-label {
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.14em; text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 10px;
  }
  .section-heading {
    font-family: var(--font-display);
    font-size: 46px; font-weight: 300;
    color: var(--ink); line-height: 1.1;
    margin-bottom: 14px;
    letter-spacing: -0.02em;
  }
  .section-desc {
    font-size: 15px; color: var(--dark-gray);
    font-weight: 300; max-width: 500px;
  }

  /* ─── FEATURED CATEGORIES ─────────────── */
  .featured-categories { background: var(--off-white); }
  .category-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 36px 32px 28px;
    position: relative;
    overflow: hidden;
    border: 1px solid var(--light-gray);
    margin-bottom: 24px;
    transition: transform var(--transition), box-shadow var(--transition);
    min-height: 300px;
  }
  .category-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-hover);
  }
  .category-card .orb {
    position: absolute; top: -60px; right: -60px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%);
  }
  .cat-label {
    font-size: 10px; font-weight: 600;
    letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--gold); margin-bottom: 8px;
  }
  .category-card h3 {
    font-family: var(--font-display);
    font-size: 28px; font-weight: 400;
    color: var(--ink); margin-bottom: 20px;
  }
  .category-card ul { margin-bottom: 24px; }
  .category-card ul li {
    border-bottom: 1px solid var(--light-gray);
    padding: 7px 0;
  }
  .category-card ul li:last-child { border-bottom: none; }
  .category-card ul li a {
    font-size: 13px; color: var(--dark-gray);
    transition: color var(--transition);
    display: flex; align-items: center; gap: 6px;
  }
  .category-card ul li a::before {
    content: '→';
    font-size: 11px; color: var(--gold);
    opacity: 0;
    transform: translateX(-6px);
    transition: all var(--transition);
  }
  .category-card ul li a:hover { color: var(--ink); padding-left: 4px; }
  .category-card ul li a:hover::before { opacity: 1; transform: translateX(0); }
  .cat-img {
    position: absolute; right: -10px; bottom: 20px;
    width: 130px; height: 130px;
    object-fit: contain;
    filter: drop-shadow(0 8px 20px rgba(0,0,0,0.12));
    transition: transform var(--transition);
  }
  .category-card:hover .cat-img { transform: translateY(-6px) rotate(3deg); }
  .cat-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 16px;
    border-top: 1px solid var(--light-gray);
  }
  .cat-footer span {
    font-size: 12px; font-weight: 600;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: var(--gold);
  }
  .cat-footer i { color: var(--gold); font-size: 16px; }

  /* ─── TRENDING PRODUCTS ───────────────── */
  .trending-product { background: var(--white); }
  .product-card {
    background: var(--white);
    border: 1px solid var(--light-gray);
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin-bottom: 24px;
    position: relative;
    transition: all var(--transition);
  }
  .product-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-hover);
    border-color: var(--gold-light);
  }
  .badge-new {
    position: absolute; top: 16px; left: 16px; z-index: 2;
    background: var(--accent);
    color: white;
    font-size: 10px; font-weight: 700;
    letter-spacing: 0.1em; text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 20px;
  }
  .product-card .img-wrap {
    position: relative; overflow: hidden;
    background: var(--off-white);
    height: 220px;
  }
  .product-card .img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  .product-card:hover .img-wrap img { transform: scale(1.06); }
  .overlay-btn {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: rgba(26,24,20,0.85);
    backdrop-filter: blur(6px);
    display: flex; gap: 0;
    transform: translateY(100%);
    transition: transform var(--transition);
  }
  .product-card:hover .overlay-btn { transform: translateY(0); }
  .btn-cart, .btn-details {
    flex: 1;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 13px 0;
    font-size: 12px; font-weight: 600;
    letter-spacing: 0.06em; text-transform: uppercase;
    color: white;
    transition: background var(--transition);
  }
  .btn-cart { background: transparent; border-right: 1px solid rgba(255,255,255,0.1); }
  .btn-details { background: transparent; }
  .btn-cart:hover { background: var(--gold); color: var(--ink); }
  .btn-details:hover { background: rgba(255,255,255,0.1); }
  .product-body {
    padding: 20px 20px 8px;
  }
  .cat-tag {
    font-size: 10px; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--gold); margin-bottom: 6px;
  }
  .product-body h4 {
    font-size: 15px; font-weight: 500;
    color: var(--ink);
    line-height: 1.4; margin-bottom: 10px;
  }
  .product-body h4 a:hover { color: var(--gold-dark); }
  .stars {
    display: flex; align-items: center; gap: 3px;
    margin-bottom: 4px;
  }
  .stars i { font-size: 11px; color: var(--gold); }
  .stars span { font-size: 11px; color: var(--dark-gray); margin-left: 4px; }
  .price-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 20px 16px;
    border-top: 1px solid var(--light-gray);
  }
  .price-row .price {
    font-family: var(--font-mono);
    font-size: 18px; font-weight: 400;
    color: var(--ink);
  }
  .wishlist-btn {
    width: 34px; height: 34px;
    border: 1px solid var(--light-gray);
    border-radius: 50%;
    background: var(--white);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: all var(--transition);
    color: var(--mid-gray);
  }
  .wishlist-btn:hover {
    background: var(--accent-soft);
    border-color: var(--accent);
    color: var(--accent);
  }

  /* ─── PROMO BANNERS ───────────────────── */
  .banner { background: var(--off-white); }
  .promo-banner {
    display: block;
    background-size: cover; background-position: center;
    border-radius: var(--radius-xl);
    overflow: hidden;
    height: 300px;
    position: relative;
    transition: transform var(--transition);
    border: 1px solid var(--light-gray);
  }
  .promo-banner::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(26,24,20,0.8) 0%, rgba(26,24,20,0.2) 70%);
  }
  .promo-banner:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
  .promo-banner .content {
    position: absolute; bottom: 36px; left: 36px; right: 36px;
  }
  .promo-banner h2 {
    font-family: var(--font-display);
    font-size: 36px; font-weight: 300;
    color: white; margin-bottom: 8px;
  }
  .promo-banner p {
    font-size: 13px; color: rgba(255,255,255,0.75);
    margin-bottom: 18px; font-weight: 300; max-width: 280px;
  }

  /* ─── SPECIAL OFFER ───────────────────── */
  .special-offer { background: var(--white); }
  .offer-product-mini {
    background: var(--white);
    border: 1px solid var(--light-gray);
    border-radius: var(--radius-lg);
    padding: 20px;
    margin-bottom: 20px;
    transition: all var(--transition);
  }
  .offer-product-mini:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-card);
    border-color: var(--gold-light);
  }
  .mini-img {
    height: 120px;
    display: flex; align-items: center; justify-content: center;
    background: var(--off-white);
    border-radius: var(--radius-md);
    margin-bottom: 14px;
    overflow: hidden;
  }
  .mini-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform var(--transition);
  }
  .offer-product-mini:hover .mini-img img { transform: scale(1.08); }
  .mini-body h4 {
    font-size: 13px; font-weight: 500;
    color: var(--ink); margin: 6px 0;
    line-height: 1.4;
  }
  .mini-body .price {
    font-family: var(--font-mono);
    font-size: 16px; color: var(--ink);
  }

  .side-promo-banner {
    display: block;
    background-size: cover; background-position: center;
    border-radius: var(--radius-xl);
    overflow: hidden;
    height: 220px;
    position: relative;
    margin-top: 4px;
    transition: transform var(--transition);
    border: 1px solid var(--light-gray);
  }
  .side-promo-banner::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(90deg, rgba(26,24,20,0.85) 0%, rgba(26,24,20,0.2) 70%);
  }
  .side-promo-banner:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
  .side-promo-banner .content {
    position: absolute; top: 50%; left: 32px;
    transform: translateY(-50%);
  }
  .side-promo-banner h2 {
    font-family: var(--font-display);
    font-size: 28px; font-weight: 300; color: white;
  }
  .side-promo-banner p {
    font-size: 12px; color: rgba(255,255,255,0.7);
    margin: 6px 0;
  }
  .side-promo-banner .price-tag {
    font-family: var(--font-mono);
    font-size: 20px; color: var(--gold-light);
    margin-bottom: 10px;
  }

  /* OFFER SPOTLIGHT */
  .offer-spotlight {
    background: var(--off-white);
    border-radius: var(--radius-xl);
    overflow: hidden;
    border: 1px solid var(--light-gray);
    height: 100%;
  }
  .spotlight-img {
    position: relative;
    height: 260px;
    overflow: hidden;
    background: var(--cream);
  }
  .spotlight-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  .offer-spotlight:hover .spotlight-img img { transform: scale(1.04); }
  .sale-badge {
    position: absolute; top: 20px; right: 20px; z-index: 2;
    background: var(--accent);
    color: white;
    font-size: 14px; font-weight: 700;
    width: 52px; height: 52px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
  }
  .spotlight-body { padding: 28px; }
  .spotlight-body h2 {
    font-family: var(--font-display);
    font-size: 28px; font-weight: 400;
    color: var(--ink); margin-bottom: 8px;
  }
  .price-group { display: flex; align-items: baseline; gap: 12px; margin: 12px 0; }
  .price-now {
    font-family: var(--font-mono);
    font-size: 26px; font-weight: 400; color: var(--ink);
  }
  .price-was {
    font-family: var(--font-mono);
    font-size: 16px; color: var(--mid-gray);
    text-decoration: line-through;
  }
  .spotlight-body > p {
    font-size: 13px; color: var(--dark-gray);
    line-height: 1.6; margin-bottom: 20px; font-weight: 300;
  }

  /* COUNTDOWN */
  .countdown-strip {
    display: flex; gap: 8px; margin-bottom: 12px;
  }
  .countdown-box {
    flex: 1;
    background: var(--ink);
    border-radius: var(--radius-md);
    padding: 12px 8px;
    text-align: center;
  }
  .countdown-box h1 {
    font-family: var(--font-mono);
    font-size: 22px; font-weight: 400;
    color: var(--gold); line-height: 1;
  }
  .countdown-box h2 {
    font-size: 9px; font-weight: 600;
    letter-spacing: 0.1em; text-transform: uppercase;
    color: var(--mid-gray); margin-top: 4px;
  }
  .event-ended {
    font-size: 12px; color: var(--mid-gray);
    text-align: center; margin-top: 8px;
  }

  /* ─── HOME PRODUCT LIST ───────────────── */
  .home-product-list { background: var(--off-white); }
  .list-section-title {
    display: block;
    font-family: var(--font-display);
    font-size: 24px; font-weight: 400;
    color: var(--ink);
    padding-bottom: 14px;
    border-bottom: 2px solid var(--light-gray);
    margin-bottom: 20px;
    position: relative;
  }
  .list-section-title::after {
    content: '';
    position: absolute; bottom: -2px; left: 0;
    width: 48px; height: 2px;
    background: var(--gold);
  }
  .list-product-item {
    display: flex; align-items: center; gap: 16px;
    padding: 14px 0;
    border-bottom: 1px solid var(--light-gray);
    transition: all var(--transition);
  }
  .list-product-item:last-of-type { border-bottom: none; }
  .list-product-item:hover { padding-left: 6px; }
  .list-thumb {
    width: 70px; height: 70px;
    border-radius: var(--radius-md);
    overflow: hidden;
    flex-shrink: 0;
    background: var(--white);
    border: 1px solid var(--light-gray);
  }
  .list-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform var(--transition);
  }
  .list-product-item:hover .list-thumb img { transform: scale(1.08); }
  .list-info h3 {
    font-size: 13px; font-weight: 500;
    color: var(--ink); margin-bottom: 4px;
    line-height: 1.4;
  }
  .list-info span {
    font-family: var(--font-mono);
    font-size: 13px; color: var(--gold-dark);
  }

  /* ─── BRANDS ──────────────────────────── */
  .brands {
    background: var(--white);
    padding: 60px 0 50px;
    border-top: 1px solid var(--light-gray);
    border-bottom: 1px solid var(--light-gray);
  }
  .brands .title {
    font-family: var(--font-display);
    font-size: 22px; font-weight: 300;
    color: var(--mid-gray);
    text-align: center;
    letter-spacing: 0.06em;
    margin-bottom: 40px;
  }
  .brands-track {
    display: flex; align-items: center; gap: 60px;
    animation: brandScroll 25s linear infinite;
    width: max-content;
  }
  @keyframes brandScroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }
  .brand-logo {
    height: 40px; display: flex; align-items: center;
    opacity: 0.35;
    filter: grayscale(100%);
    transition: opacity var(--transition), filter var(--transition);
    flex-shrink: 0;
  }
  .brand-logo:hover { opacity: 0.7; filter: grayscale(0%); }
  .brand-logo img { height: 100%; width: auto; object-fit: contain; }

  /* ─── BLOG ────────────────────────────── */
  .blog-section { background: var(--off-white); }
  .blog-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    overflow: hidden;
    border: 1px solid var(--light-gray);
    margin-bottom: 24px;
    transition: all var(--transition);
  }
  .blog-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-hover);
  }
  .blog-thumb {
    height: 220px; overflow: hidden;
    background: var(--cream);
  }
  .blog-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  .blog-card:hover .blog-thumb img { transform: scale(1.06); }
  .blog-body { padding: 28px; }
  .blog-cat {
    font-size: 10px; font-weight: 700;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--gold-dark);
    background: var(--gold-light);
    padding: 4px 12px;
    border-radius: 20px;
    display: inline-block; margin-bottom: 14px;
  }
  .blog-body h4 {
    font-family: var(--font-display);
    font-size: 22px; font-weight: 400;
    color: var(--ink); line-height: 1.3;
    margin-bottom: 10px;
  }
  .blog-body h4 a:hover { color: var(--gold-dark); }
  .blog-body > p {
    font-size: 13px; color: var(--dark-gray);
    line-height: 1.7; margin-bottom: 18px; font-weight: 300;
  }
  .btn-text {
    font-size: 12px; font-weight: 700;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: var(--ink);
    display: inline-flex; align-items: center; gap: 6px;
    transition: gap var(--transition);
    cursor: pointer;
  }
  .btn-text:hover { gap: 12px; color: var(--gold-dark); }

  /* ─── FOOTER ──────────────────────────── */
  .site-footer {
    background: var(--ink);
    padding: 80px 0 0;
  }
  .footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 60px;
    padding-bottom: 60px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }
  .footer-brand .logo {
    font-family: var(--font-display);
    font-size: 32px; font-weight: 300;
    letter-spacing: 0.12em;
    color: white; margin-bottom: 16px;
  }
  .footer-brand .logo span { color: var(--gold); }
  .footer-brand p {
    font-size: 14px; color: var(--mid-gray);
    line-height: 1.7; font-weight: 300;
    max-width: 280px; margin-bottom: 28px;
  }
  .footer-socials {
    display: flex; gap: 10px;
  }
  .social-btn {
    width: 38px; height: 38px;
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--mid-gray); font-size: 15px;
    transition: all var(--transition);
    cursor: pointer;
  }
  .social-btn:hover {
    background: var(--gold); border-color: var(--gold);
    color: var(--ink); transform: translateY(-2px);
  }
  .footer-col h4 {
    font-size: 11px; font-weight: 700;
    letter-spacing: 0.14em; text-transform: uppercase;
    color: white; margin-bottom: 22px;
  }
  .footer-col ul { }
  .footer-col ul li { margin-bottom: 10px; }
  .footer-col ul li a {
    font-size: 13px; color: var(--mid-gray);
    transition: color var(--transition);
  }
  .footer-col ul li a:hover { color: var(--gold); }
  .footer-bottom {
    padding: 24px 0;
    display: flex; align-items: center; justify-content: space-between;
  }
  .footer-bottom p { font-size: 12px; color: var(--dark-gray); }

  /* ─── PLACEHOLDER COLORS ──────────────── */
  .bg-placeholder-1 { background: linear-gradient(135deg, #e8e0d4 0%, #d4c9b8 100%); }
  .bg-placeholder-2 { background: linear-gradient(135deg, #dce4ec 0%, #c5d4e0 100%); }
  .bg-placeholder-3 { background: linear-gradient(135deg, #e4dce8 0%, #d0c4d8 100%); }

  /* Dummy product images using colored backgrounds */
  .product-img-1 { background: linear-gradient(135deg, #f0ece4 0%, #e0d8cc 100%); }
  .product-img-2 { background: linear-gradient(135deg, #e4ecf0 0%, #ccd8e0 100%); }

  /* ─── SCROLL ANIMATIONS ───────────────── */
  [data-reveal] {
    opacity: 0; transform: translateY(28px);
    transition: opacity 0.7s ease, transform 0.7s ease;
  }
  [data-reveal].revealed { opacity: 1; transform: translateY(0); }

  /* ─── PLACEHOLDER IMG STYLE ───────────── */
  .img-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 28px;
    color: var(--mid-gray);
  }
</style>
<style>
/* ── Trending Products Section ─────────────────────────── */
.trending-product {
  padding: 90px 0;
  background: var(--off-white, #faf9f7);
}
 
/* Section header */
.trending-header {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 48px;
  gap: 24px;
  flex-wrap: wrap;
}
.trending-header-left {}
.section-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--gold, #c8a45a);
  margin-bottom: 10px;
}
.section-label::before {
  content: '';
  display: inline-block;
  width: 28px;
  height: 1px;
  background: var(--gold, #c8a45a);
}
.section-heading {
  font-family: var(--font-display, 'Cormorant Garamond', Georgia, serif);
  font-size: clamp(30px, 4vw, 44px);
  font-weight: 400;
  color: var(--ink, #0e0d0b);
  letter-spacing: 0.02em;
  line-height: 1.15;
  margin-bottom: 10px;
}
.section-desc {
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 13.5px;
  color: var(--mid-gray, #aca89f);
  letter-spacing: 0.03em;
  max-width: 400px;
  line-height: 1.6;
  margin: 0;
}
 
/* Explore All Button */
.btn-explore-all {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 0 30px;
  height: 48px;
  background: transparent;
  border: 1px solid var(--ink, #0e0d0b);
  color: var(--ink, #0e0d0b);
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 10.5px;
  font-weight: 600;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  text-decoration: none;
  border-radius: 3px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  white-space: nowrap;
  flex-shrink: 0;
  position: relative;
  overflow: hidden;
}
.btn-explore-all::before {
  content: '';
  position: absolute;
  inset: 0;
  background: var(--ink, #0e0d0b);
  transform: translateX(-100%);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 0;
}
.btn-explore-all:hover::before { transform: translateX(0); }
.btn-explore-all:hover {
  color: var(--white, #fff);
  border-color: var(--ink, #0e0d0b);
}
.btn-explore-all span,
.btn-explore-all i {
  position: relative;
  z-index: 1;
}
.btn-explore-all .arrow-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  border: 1px solid currentColor;
  border-radius: 50%;
  font-size: 11px;
  transition: transform 0.3s ease;
}
.btn-explore-all:hover .arrow-icon {
  transform: translateX(3px);
}
 
/* Bottom explore button */
.trending-footer {
  display: flex;
  justify-content: center;
  margin-top: 56px;
}
.btn-explore-bottom {
  display: inline-flex;
  align-items: center;
  gap: 14px;
  padding: 0 48px;
  height: 54px;
  background: var(--ink, #0e0d0b);
  color: var(--white, #fff);
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 10.5px;
  font-weight: 600;
  letter-spacing: 0.16em;
  text-transform: uppercase;
  text-decoration: none;
  border-radius: 3px;
  border: 1px solid var(--ink, #0e0d0b);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}
.btn-explore-bottom::before {
  content: '';
  position: absolute;
  inset: 0;
  background: var(--gold, #c8a45a);
  transform: translateY(100%);
  transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 0;
}
.btn-explore-bottom:hover::before { transform: translateY(0); }
.btn-explore-bottom:hover {
  color: var(--ink, #0e0d0b);
  border-color: var(--gold, #c8a45a);
  box-shadow: 0 8px 32px rgba(200, 164, 90, 0.25);
}
.btn-explore-bottom span,
.btn-explore-bottom i {
  position: relative;
  z-index: 1;
}
.btn-explore-bottom i { font-size: 17px; }
 
/* Product Card */
.product-card {
  position: relative;
  background: var(--white, #fff);
  border: 1px solid var(--light-gray, #e9e5dc);
  border-radius: 10px;
  overflow: hidden;
  transition: box-shadow 0.35s ease, transform 0.35s ease, border-color 0.3s ease;
  margin-bottom: 28px;
}
.product-card:hover {
  box-shadow: 0 20px 60px rgba(14, 13, 11, 0.13);
  transform: translateY(-4px);
  border-color: rgba(200, 164, 90, 0.3);
}
 
/* Badge */
.badge-new {
  position: absolute;
  top: 14px;
  left: 14px;
  z-index: 3;
  background: var(--gold, #c8a45a);
  color: var(--ink, #0e0d0b);
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 8.5px;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 2px;
}
 
/* Image */
.img-wrap {
  position: relative;
  overflow: hidden;
  aspect-ratio: 4 / 3.2;
  background: var(--cream, #f4f1ea);
}
.img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.product-card:hover .img-wrap img { transform: scale(1.06); }
 
/* Overlay buttons */
.overlay-btn {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  gap: 1px;
  transform: translateY(100%);
  transition: transform 0.32s cubic-bezier(0.4, 0, 0.2, 1);
}
.product-card:hover .overlay-btn { transform: translateY(0); }
 
.btn-cart,
.btn-details {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  padding: 13px 10px;
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 0.13em;
  text-transform: uppercase;
  text-decoration: none;
  cursor: pointer;
  border: none;
  transition: background 0.22s ease, color 0.22s ease;
}
.btn-cart {
  background: var(--ink, #0e0d0b);
  color: var(--white, #fff);
}
.btn-cart:hover { background: var(--gold, #c8a45a); color: var(--ink, #0e0d0b); }
.btn-details {
  background: rgba(14, 13, 11, 0.78);
  color: var(--white, #fff);
  backdrop-filter: blur(4px);
}
.btn-details:hover { background: var(--gold, #c8a45a); color: var(--ink, #0e0d0b); }
.btn-cart i, .btn-details i { font-size: 14px; }
 
/* Product body */
.product-body {
  padding: 18px 18px 10px;
}
.cat-tag {
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 9px;
  font-weight: 600;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--gold, #c8a45a);
  margin-bottom: 7px;
}
.product-body h4 {
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 13.5px;
  font-weight: 500;
  color: var(--ink, #0e0d0b);
  line-height: 1.35;
  margin-bottom: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.product-body h4 a {
  color: inherit;
  text-decoration: none;
  transition: color 0.2s ease;
}
.product-body h4 a:hover { color: var(--gold-dark, #8f6f30); }
 
/* Stars */
.stars {
  display: flex;
  align-items: center;
  gap: 2px;
}
.stars i {
  font-size: 11px;
  color: var(--gold, #c8a45a);
}
.stars i.lni-star { color: var(--light-gray, #e9e5dc); }
.stars span {
  font-family: var(--font-body, 'DM Sans', sans-serif);
  font-size: 10.5px;
  color: var(--mid-gray, #aca89f);
  margin-left: 6px;
  letter-spacing: 0.03em;
}
 
/* Price row */
.price-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 18px 16px;
  border-top: 1px solid var(--light-gray, #e9e5dc);
  margin-top: 10px;
}
.price {
  font-family: var(--font-display, 'Cormorant Garamond', Georgia, serif);
  font-size: 22px;
  font-weight: 400;
  color: var(--ink, #0e0d0b);
  letter-spacing: 0.01em;
}
.wishlist-btn {
  width: 34px;
  height: 34px;
  border: 1px solid var(--light-gray, #e9e5dc);
  border-radius: 6px;
  background: transparent;
  color: var(--mid-gray, #aca89f);
  font-size: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.22s ease;
}
.wishlist-btn:hover {
  border-color: var(--gold, #c8a45a);
  color: var(--gold, #c8a45a);
  background: rgba(200, 164, 90, 0.07);
}
.wishlist-btn.active {
  border-color: #e63946;
  color: #e63946;
  background: rgba(230, 57, 70, 0.07);
}
</style>
</head>
<body>


<!-- ── VIDEO HERO ────────────────────────────────── -->
<section style="position:relative;width:100%;height:560px;overflow:hidden;background:#0e0d0b;">
  <video
    autoplay muted loop playsinline
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.6;">
    <source src="{{ asset('website/assets/videos/hero.mp4') }}" type="video/mp4">
  </video>
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(14,13,11,0.75) 0%,rgba(14,13,11,0.3) 100%);"></div>
  <div style="position:absolute;inset:0;display:flex;align-items:center;">
    <div class="container">
      <div style="max-width:560px;">
        <div style="font-size:11px;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:16px;">
          Premium Electronics
        </div>
        <h1 style="font-family:var(--font-display);font-size:clamp(40px,6vw,72px);font-weight:300;color:#fff;line-height:1.05;margin-bottom:20px;letter-spacing:-0.01em;">
          Elevate Your<br><em style="color:var(--gold);">Experience</em>
        </h1>
        <p style="font-size:16px;color:rgba(255,255,255,0.65);line-height:1.7;margin-bottom:32px;font-weight:300;max-width:420px;">
          Discover the latest in premium tech — curated for those who demand the best.
        </p>
        <div style="display:flex;gap:14px;flex-wrap:wrap;">
          <a href="{{ route('trending.index') }}" class="btn-primary-custom">
            <i class="lni lni-cart"></i> Shop Now
          </a>
          <a href="{{ route('home.about-us') }}"
             style="display:inline-flex;align-items:center;gap:8px;padding:14px 28px;border:1px solid rgba(255,255,255,0.3);color:#fff;font-size:13px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;border-radius:var(--radius-md);transition:all 0.3s ease;"
             onmouseover="this.style.background='rgba(255,255,255,0.1)'"
             onmouseout="this.style.background='transparent'">
            Learn More →
          </a>
        </div>
      </div>
    </div>
  </div>
</section>







<!-- ── PROMO BANNER ─────────────────────────────── -->
<div class="promo-banner-section">
  <div class="container" style="padding:0;max-width:100%;">
    <div class="promo-banner-inner">
      <div class="promo-left">
        <div class="promo-tag">🔥 Limited Time</div>
        <h2 class="promo-title">5.5 <span>Mega Sale</span></h2>
        <p class="promo-sub">Get The Big One!</p>
      </div>
      <div class="promo-center">
        <div class="promo-percent">12% <span>SAVINGS</span></div>
        <p>On Prepaid Orders</p>
      </div>
      <div class="promo-right">
        <p class="promo-badge">Sale is LIVE!</p>
        <a href="product-grids.html" class="btn-promo">
          Shop Now <span>→</span>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- ── TRUST BAR ─────────────────────────────────── -->
<div class="trust-bar">
  <div class="container">
    <ul>
      <li>
        <i class="lni lni-delivery"></i>
        <div>
          <strong>Free Shipping</strong>
          <span>On orders over $99</span>
        </div>
      </li>
      <li>
        <i class="lni lni-support"></i>
        <div>
          <strong>24/7 Support</strong>
          <span>Live chat or call</span>
        </div>
      </li>
      <li>
        <i class="lni lni-credit-cards"></i>
        <div>
          <strong>Secure Payment</strong>
          <span>256-bit SSL encryption</span>
        </div>
      </li>
      <li>
        <i class="lni lni-reload"></i>
        <div>
          <strong>Easy Returns</strong>
          <span>Hassle-free 30-day returns</span>
        </div>
      </li>
    </ul>
  </div>
</div>

{{-- ── TRENDING PRODUCTS ─────────────────────────── --}}
<section class="trending-product section">
  <div class="container">
 
    {{-- ── Section Header with Explore button ── --}}
    <div class="trending-header">
      <div class="trending-header-left">
        <div class="section-label">Hot Right Now</div>
        <h2 class="section-heading">Trending Products</h2>
        <p class="section-desc">The most-loved products this week, flying off our shelves.</p>
      </div>
      <a href="{{ route('trending.index') }}" class="btn-explore-all">
        <span>Explore More</span>
        <span class="arrow-icon"><i class="lni lni-arrow-right"></i></span>
      </a>
    </div>
 
    {{-- ── Product Grid ── --}}
    <div class="row">
      @foreach ($products as $i => $product)
      <div class="col-lg-3 col-md-6 col-12">
        <div class="product-card">
 
          @if($i < 2)
          <span class="badge-new">New</span>
          @endif
 
          <div class="img-wrap">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <div class="overlay-btn">
              <a class="btn-cart" href="javascript:void(0)"
                 onclick="addToCart({{ $product->id }}, this)">
                <i class="lni lni-cart"></i> Cart
              </a>
              <a class="btn-details" href="{{ route('product-detail', ['id' => $product->id]) }}">
                <i class="lni lni-eye"></i> Details
              </a>
            </div>
          </div>
 
          <div class="product-body">
            <div class="cat-tag">{{ $product->category->name ?? 'N/A' }}</div>
            <h4><a href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h4>
            <div class="stars">
              <i class="lni lni-star-filled"></i>
              <i class="lni lni-star-filled"></i>
              <i class="lni lni-star-filled"></i>
              <i class="lni lni-star-filled"></i>
              <i class="lni lni-star"></i>
              <span>4.0 (32)</span>
            </div>
          </div>
 
          <div class="price-row">
            <div class="price">৳{{ number_format($product->selling_price, 2) }}</div>
            <button class="wishlist-btn" aria-label="Add to wishlist">
              <i class="lni lni-heart"></i>
            </button>
          </div>
 
        </div>
      </div>
      @endforeach
    </div>
 
    {{-- ── Bottom Explore Button ── --}}
    <div class="trending-footer">
      <a href="{{ route('trending.index') }}" class="btn-explore-bottom">
        <i class="lni lni-grid-alt"></i>
        <span>Explore More Products</span>
      </a>
    </div>
 
  </div>
</section>

<!-- ── FEATURED CATEGORIES ───────────────────────── -->
<section class="featured-categories section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <div class="section-label">Browse By Category</div>
        <h2 class="section-heading">Featured Categories</h2>
        <p class="section-desc">Explore our curated selection of premium electronics, handpicked for quality and value.</p>
      </div>
    </div>

    <div class="row">
      <!-- TV & Audios -->
      <div class="col-lg-4 col-md-6 col-12" data-reveal>
        <div class="category-card">
          <div class="orb"></div>
          <div class="cat-label">Category</div>
          <h3>TV & Audios</h3>
          <ul>
            <li><a href="product-grids.html">Smart Television</a></li>
            <li><a href="product-grids.html">QLED TV</a></li>
            <li><a href="product-grids.html">Audios</a></li>
            <li><a href="product-grids.html">Headphones</a></li>
            <li><a href="product-grids.html">View All</a></li>
          </ul>
          <div style="position:absolute;right:16px;bottom:60px;font-size:90px;opacity:0.07;pointer-events:none;">📺</div>
          <div class="cat-footer">
            <span>View All</span>
            <i class="lni lni-arrow-right"></i>
          </div>
        </div>
      </div>
      <!-- Desktop & Laptop -->
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.1s">
        <div class="category-card">
          <div class="orb"></div>
          <div class="cat-label">Category</div>
          <h3>Desktop & Laptop</h3>
          <ul>
            <li><a href="product-grids.html">Smart Television</a></li>
            <li><a href="product-grids.html">QLED TV</a></li>
            <li><a href="product-grids.html">Audios</a></li>
            <li><a href="product-grids.html">Headphones</a></li>
            <li><a href="product-grids.html">View All</a></li>
          </ul>
          <div style="position:absolute;right:16px;bottom:60px;font-size:90px;opacity:0.07;pointer-events:none;">💻</div>
          <div class="cat-footer">
            <span>View All</span>
            <i class="lni lni-arrow-right"></i>
          </div>
        </div>
      </div>
      <!-- CCTV Camera -->
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.2s">
        <div class="category-card">
          <div class="orb"></div>
          <div class="cat-label">Category</div>
          <h3>CCTV Camera</h3>
          <ul>
            <li><a href="product-grids.html">Smart Television</a></li>
            <li><a href="product-grids.html">QLED TV</a></li>
            <li><a href="product-grids.html">Audios</a></li>
            <li><a href="product-grids.html">Headphones</a></li>
            <li><a href="product-grids.html">View All</a></li>
          </ul>
          <div style="position:absolute;right:16px;bottom:60px;font-size:90px;opacity:0.07;pointer-events:none;">📷</div>
          <div class="cat-footer">
            <span>View All</span>
            <i class="lni lni-arrow-right"></i>
          </div>
        </div>
      </div>
      <!-- DSLR Camera -->
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.0s">
        <div class="category-card">
          <div class="orb"></div>
          <div class="cat-label">Category</div>
          <h3>DSLR Camera</h3>
          <ul>
            <li><a href="product-grids.html">Smart Television</a></li>
            <li><a href="product-grids.html">QLED TV</a></li>
            <li><a href="product-grids.html">Audios</a></li>
            <li><a href="product-grids.html">Headphones</a></li>
            <li><a href="product-grids.html">View All</a></li>
          </ul>
          <div style="position:absolute;right:16px;bottom:60px;font-size:90px;opacity:0.07;pointer-events:none;">🎥</div>
          <div class="cat-footer">
            <span>View All</span>
            <i class="lni lni-arrow-right"></i>
          </div>
        </div>
      </div>
      <!-- Smart Phones -->
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.1s">
        <div class="category-card">
          <div class="orb"></div>
          <div class="cat-label">Category</div>
          <h3>Smart Phones</h3>
          <ul>
            <li><a href="product-grids.html">Smart Television</a></li>
            <li><a href="product-grids.html">QLED TV</a></li>
            <li><a href="product-grids.html">Audios</a></li>
            <li><a href="product-grids.html">Headphones</a></li>
            <li><a href="product-grids.html">View All</a></li>
          </ul>
          <div style="position:absolute;right:16px;bottom:60px;font-size:90px;opacity:0.07;pointer-events:none;">📱</div>
          <div class="cat-footer">
            <span>View All</span>
            <i class="lni lni-arrow-right"></i>
          </div>
        </div>
      </div>
      <!-- Game Console -->
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.2s">
        <div class="category-card">
          <div class="orb"></div>
          <div class="cat-label">Category</div>
          <h3>Game Console</h3>
          <ul>
            <li><a href="product-grids.html">Smart Television</a></li>
            <li><a href="product-grids.html">QLED TV</a></li>
            <li><a href="product-grids.html">Audios</a></li>
            <li><a href="product-grids.html">Headphones</a></li>
            <li><a href="product-grids.html">View All</a></li>
          </ul>
          <div style="position:absolute;right:16px;bottom:60px;font-size:90px;opacity:0.07;pointer-events:none;">🎮</div>
          <div class="cat-footer">
            <span>View All</span>
            <i class="lni lni-arrow-right"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- ── PROMO BANNERS ─────────────────────────────── -->
<section class="banner section">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-6 col-md-6 col-12" data-reveal>
        <a class="promo-banner" href="product-grids.html"
           style="background: linear-gradient(135deg, #2c2a26 0%, #1a1814 100%);">
          <div style="position:absolute;right:32px;top:50%;transform:translateY(-50%);font-size:100px;opacity:0.12;">⌚</div>
          <div class="content">
            <h2>Smart Watch 2.0</h2>
            <p>Space Gray Aluminum Case with Black/Volt Real Sport Band</p>
            <span class="btn-outline-light-custom">View Details →</span>
          </div>
        </a>
      </div>
      <div class="col-lg-6 col-md-6 col-12" data-reveal style="transition-delay:0.1s">
        <a class="promo-banner" href="product-grids.html"
           style="background: linear-gradient(135deg, #1a2c2a 0%, #0e1e1c 100%);">
          <div style="position:absolute;right:32px;top:50%;transform:translateY(-50%);font-size:100px;opacity:0.12;">🎧</div>
          <div class="content">
            <h2>Smart Headphone</h2>
            <p>Immersive sound, studio-grade quality. For audiophiles on the move.</p>
            <span class="btn-outline-light-custom">Shop Now →</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ── SPECIAL OFFER ─────────────────────────────── -->
<section class="special-offer section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <div class="section-label">Limited Time</div>
        <h2 class="section-heading">Special Offers</h2>
        <p class="section-desc">Don't miss these exclusive deals — grab them before they're gone.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12" data-reveal>
            <div class="offer-product-mini">
              <div class="mini-img">
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#edf3f8,#d8e8f4);display:flex;align-items:center;justify-content:center;font-size:44px;opacity:0.45;">📷</div>
              </div>
              <div class="mini-body">
                <div class="cat-tag">Camera</div>
                <h4><a href="product-details.html">WiFi Security Camera</a></h4>
                <div class="stars">
                  <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                </div>
                <div class="price">$399.00</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12" data-reveal style="transition-delay:0.1s">
            <div class="offer-product-mini">
              <div class="mini-img">
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#f0ece4,#e4dcd0);display:flex;align-items:center;justify-content:center;font-size:44px;opacity:0.45;">💻</div>
              </div>
              <div class="mini-body">
                <div class="cat-tag">Laptop</div>
                <h4><a href="product-details.html">Apple MacBook Air</a></h4>
                <div class="stars">
                  <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                </div>
                <div class="price">$899.00</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12" data-reveal style="transition-delay:0.2s">
            <div class="offer-product-mini">
              <div class="mini-img">
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#f4ece8,#ecdcd4);display:flex;align-items:center;justify-content:center;font-size:44px;opacity:0.45;">🔊</div>
              </div>
              <div class="mini-body">
                <div class="cat-tag">Speaker</div>
                <h4><a href="product-details.html">Bluetooth Speaker</a></h4>
                <div class="stars">
                  <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
                  <i class="lni lni-star-filled"></i>
                </div>
                <div class="price">$70.00</div>
              </div>
            </div>
          </div>
        </div>

        <a class="side-promo-banner" href="product-grids.html"
           style="background: linear-gradient(135deg, #1a2428 0%, #0c181e 100%);">
          <div style="position:absolute;right:32px;top:50%;transform:translateY(-50%);font-size:80px;opacity:0.1;">💻</div>
          <div class="content">
            <h2>Samsung Notebook 9</h2>
            <p>Thin. Light. Powerful. Redefined productivity.</p>
            <div class="price-tag">$590.00</div>
            <span class="btn-outline-light-custom">Shop Now →</span>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-12" data-reveal>
        <div class="offer-spotlight">
          <div class="spotlight-img">
            <span class="sale-badge">-50%</span>
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f0ece4,#e4dcd0);display:flex;align-items:center;justify-content:center;font-size:100px;opacity:0.25;">🎧</div>
          </div>
          <div class="spotlight-body">
            <h2><a href="product-grids.html">Bluetooth Headphone</a></h2>
            <div class="stars">
              <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
              <i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i>
              <i class="lni lni-star-filled"></i>
            </div>
            <div class="price-group">
              <span class="price-now">$200.00</span>
              <span class="price-was">$400.00</span>
            </div>
            <p>Premium audio meets iconic design. Wireless freedom with 40-hour battery life and active noise cancellation.</p>

            <div class="countdown-strip">
              <div class="countdown-box"><h1 id="days">000</h1><h2>Days</h2></div>
              <div class="countdown-box"><h1 id="hours">00</h1><h2>Hours</h2></div>
              <div class="countdown-box"><h1 id="minutes">00</h1><h2>Mins</h2></div>
              <div class="countdown-box"><h1 id="seconds">00</h1><h2>Secs</h2></div>
            </div>
            <div class="event-ended">⏰ Event has ended</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── PRODUCT LIST ──────────────────────────────── -->
<section class="home-product-list section">
  <div class="container">
    <div class="row">
      <!-- Best Sellers -->
      <div class="col-lg-4 col-md-4 col-12" data-reveal>
        <span class="list-section-title">Best Sellers</span>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f5f0e8,#ede4d4);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">📹</div>
          </div>
          <div class="list-info"><h3>GoPro Hero4 Silver</h3><span>$287.99</span></div>
        </a>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#edf3f8,#d8e8f4);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">🎧</div>
          </div>
          <div class="list-info"><h3>Puro Sound Labs BT2200</h3><span>$95.00</span></div>
        </a>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f0ece4,#e4dcd0);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">🖨️</div>
          </div>
          <div class="list-info"><h3>HP OfficeJet Pro 8710</h3><span>$120.00</span></div>
        </a>
      </div>

      <!-- New Arrivals -->
      <div class="col-lg-4 col-md-4 col-12" data-reveal style="transition-delay:0.1s">
        <span class="list-section-title">New Arrivals</span>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f4edf8,#e8d8f4);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">📱</div>
          </div>
          <div class="list-info"><h3>iPhone X 256 GB Space Gray</h3><span>$1150.00</span></div>
        </a>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#edf3f8,#d8e8f4);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">📷</div>
          </div>
          <div class="list-info"><h3>Canon EOS M50 Mirrorless</h3><span>$950.00</span></div>
        </a>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f0ece4,#e4dcd0);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">🎮</div>
          </div>
          <div class="list-info"><h3>Microsoft Xbox One S</h3><span>$298.00</span></div>
        </a>
      </div>

      <!-- Top Rated -->
      <div class="col-lg-4 col-md-4 col-12" data-reveal style="transition-delay:0.2s">
        <span class="list-section-title">Top Rated</span>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f5f0e8,#ede4d4);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">🕶️</div>
          </div>
          <div class="list-info"><h3>Samsung Gear 360 VR Camera</h3><span>$68.00</span></div>
        </a>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#edf3f8,#d8e8f4);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">📱</div>
          </div>
          <div class="list-info"><h3>Samsung Galaxy S9+ 64 GB</h3><span>$840.00</span></div>
        </a>
        <a class="list-product-item" href="product-grids.html">
          <div class="list-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f0ece4,#e4dcd0);display:flex;align-items:center;justify-content:center;font-size:24px;opacity:0.5;">🎧</div>
          </div>
          <div class="list-info"><h3>Zeus Bluetooth Headphones</h3><span>$28.00</span></div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ── BRANDS ────────────────────────────────────── -->
<div class="brands">
  <div class="container">
    <h2 class="title">Trusted Brands</h2>
  </div>
  <div style="overflow:hidden;">
    <div class="brands-track">
      <!-- Brand 1 -->
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">SAMSUNG</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">SONY</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">APPLE</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">LG</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">CANON</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">BOSE</div></div>
      <!-- Duplicates for infinite scroll -->
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">SAMSUNG</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">SONY</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">APPLE</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">LG</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">CANON</div></div>
      <div class="brand-logo"><div style="font-family:var(--font-display);font-size:26px;font-weight:300;letter-spacing:0.1em;color:var(--charcoal);white-space:nowrap;">BOSE</div></div>
    </div>
  </div>
</div>

<!-- ── BLOG ──────────────────────────────────────── -->
<section class="blog-section section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <div class="section-label">From the Journal</div>
        <h2 class="section-heading">Latest News</h2>
        <p class="section-desc">Stay in the loop with the latest in tech, gadgets, and digital living.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6 col-12" data-reveal>
        <div class="blog-card">
          <div class="blog-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#e8e0d4,#d4c9b8);display:flex;align-items:center;justify-content:center;font-size:52px;opacity:0.35;">🛒</div>
          </div>
          <div class="blog-body">
            <a class="blog-cat" href="javascript:void(0)">eCommerce</a>
            <h4><a href="blog-single-sidebar.html">What information is needed for shipping?</a></h4>
            <p>Everything you need to know about international shipping, duties, and delivery timelines explained simply.</p>
            <a href="javascript:void(0)" class="btn-text">Read Article →</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.1s">
        <div class="blog-card">
          <div class="blog-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#dce4ec,#c5d4e0);display:flex;align-items:center;justify-content:center;font-size:52px;opacity:0.35;">🎮</div>
          </div>
          <div class="blog-body">
            <a class="blog-cat" href="javascript:void(0)">Gaming</a>
            <h4><a href="blog-single-sidebar.html">Interesting facts about gaming consoles</a></h4>
            <p>From cartridges to cloud gaming — the incredible journey of the gaming console over four decades.</p>
            <a href="javascript:void(0)" class="btn-text">Read Article →</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12" data-reveal style="transition-delay:0.2s">
        <div class="blog-card">
          <div class="blog-thumb">
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#e4dce8,#d0c4d8);display:flex;align-items:center;justify-content:center;font-size:52px;opacity:0.35;">⚡</div>
          </div>
          <div class="blog-body">
            <a class="blog-cat" href="javascript:void(0)">Electronic</a>
            <h4><a href="blog-single-sidebar.html">Electronics, instrumentation & control engineering</a></h4>
            <p>How modern control engineering is reshaping smart homes, IoT devices, and industrial automation.</p>
            <a href="javascript:void(0)" class="btn-text">Read Article →</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->


<script>
  // ── HERO SLIDER ──────────────────────────────────────────
  const slides = document.querySelectorAll('.hero-slide');
  const dots   = document.querySelectorAll('.hero-dot');
  let current = 0, timer;

  function goTo(idx) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = idx;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
  }
  function autoSlide() {
    timer = setInterval(() => goTo((current + 1) % slides.length), 5000);
  }
  dots.forEach(d => d.addEventListener('click', () => {
    clearInterval(timer);
    goTo(+d.dataset.idx);
    autoSlide();
  }));
  autoSlide();

  // ── SCROLL REVEAL ────────────────────────────────────────
  const revealEls = document.querySelectorAll('[data-reveal]');
  const observer  = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('revealed'); observer.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  revealEls.forEach(el => observer.observe(el));

  // ── COUNTDOWN ────────────────────────────────────────────
  function pad(n, len) { return String(n).padStart(len, '0'); }
  const target = new Date(Date.now() - 1000);
  function updateCountdown() {
    const diff = target - Date.now();
    if (diff <= 0) {
      ['days','hours','minutes','seconds'].forEach((id, i) => {
        document.getElementById(id).textContent = i === 0 ? '000' : '00';
      });
      return;
    }
    document.getElementById('days').textContent    = pad(Math.floor(diff / 86400000), 3);
    document.getElementById('hours').textContent   = pad(Math.floor((diff % 86400000) / 3600000), 2);
    document.getElementById('minutes').textContent = pad(Math.floor((diff % 3600000) / 60000), 2);
    document.getElementById('seconds').textContent = pad(Math.floor((diff % 60000) / 1000), 2);
  }
  setInterval(updateCountdown, 1000);
  updateCountdown();

  // ── WISHLIST TOGGLE ──────────────────────────────────────
  document.querySelectorAll('.wishlist-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('active');
      const icon = btn.querySelector('i');
      icon.classList.toggle('lni-heart');
      icon.classList.toggle('lni-heart-fill');
    });
  });

  // ── ADD TO CART with fly animation ──────────────────────
  function addToCart(productId, triggerEl) {
    // Find the product image inside the same card
    var card   = triggerEl.closest('.product-card');
    var imgEl  = card ? card.querySelector('.img-wrap img') : null;
    var csrfEl = document.querySelector('meta[name="csrf-token"]');
    var csrf   = csrfEl ? csrfEl.content : '';

    // Disable the button while request is in flight
    triggerEl.style.pointerEvents = 'none';
    triggerEl.style.opacity       = '0.6';

    fetch('/add-to-cart/' + productId, {
      method:  'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN':     csrf,
        'Content-Type':     'application/json',
      },
      body: JSON.stringify({ qty: 1 }),
    })
    .then(function (res) {
      if (!res.ok) throw new Error('Failed');
      return res.json();
    })
    .then(function (data) {
      // Trigger the fly-to-cart animation (defined in header.js)
      if (typeof window.flyToCart === 'function') {
        window.flyToCart(imgEl, data.count ?? null, data.total ?? null);
      }
    })
    .catch(function () {
      // Even on error, still do the visual animation
      if (typeof window.flyToCart === 'function') {
        window.flyToCart(imgEl, null, null);
      }
    })
    .finally(function () {
      triggerEl.style.pointerEvents = '';
      triggerEl.style.opacity       = '';
    });
  }
</script>
</body>
@endsection