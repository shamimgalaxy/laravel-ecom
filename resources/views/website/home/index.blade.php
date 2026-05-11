@extends('website.master')
@section('title')
Online Shopping — Premium Electronics
@endsection

@section('body')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Syne:wght@400;500;700;800&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --primary: #080808;
    --accent: #E2B84A;
    --accent2: #88C0E0;
    --surface: #040404;
    --card: #111111;
    --border: rgba(226,184,74,0.15);
    --text: #F8F4EC;
    --muted: #706860;
    --white: #F8F4EC;
    --gradient-hero: linear-gradient(135deg, #040404 0%, #100A04 50%, #040810 100%);
    --glow-red: 0 0 60px rgba(226,184,74,0.28);
    --glow-amber: 0 0 60px rgba(136,192,224,0.22);
}

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background: var(--primary);
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        overflow-x: hidden;
    }

    h1, h2, h3, h4, h5 {
        font-family: 'Clash Display', sans-serif;
        letter-spacing: -0.02em;
    }

    /* ── HERO ─────────────────────────────────── */
    .hero-area {
        background: var(--gradient-hero);
        position: relative;
        overflow: hidden;
        padding: 60px 0 80px;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .hero-area::before {
        content: '';
        position: absolute;
        top: -20%;
        right: -10%;
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(255,59,48,0.12) 0%, transparent 65%);
        pointer-events: none;
    }

    .hero-area::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(90,50,200,0.1) 0%, transparent 65%);
        pointer-events: none;
    }

    /* Grid texture */
    .hero-area .grid-bg {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none;
    }

    .hero-slider-wrap {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid var(--border);
        background: var(--card);
        height: 420px;
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.7s ease, transform 0.7s ease;
        transform: translateY(20px);
        background-size: cover;
        background-position: center;
    }

    .hero-slide::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg, rgba(10,10,15,0.92) 40%, rgba(10,10,15,0.5) 100%);
    }

    .hero-slide.active {
        opacity: 1;
        transform: translateY(0);
        position: relative;
    }

    .hero-slide .content { position: relative; z-index: 2; }

    .hero-slide .badge {
        display: inline-block;
        background: var(--accent);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 18px;
        font-family: 'DM Sans', sans-serif;
    }

    .hero-slide h2 {
        font-size: 44px;
        font-weight: 700;
        line-height: 1.1;
        color: var(--white);
        margin-bottom: 14px;
    }

    .hero-slide p {
        color: var(--muted);
        font-size: 15px;
        max-width: 380px;
        margin-bottom: 22px;
        line-height: 1.7;
    }

    .hero-slide .price-tag {
        font-size: 32px;
        font-weight: 700;
        color: var(--accent2);
        font-family: 'Clash Display', sans-serif;
        margin-bottom: 28px;
    }

    .hero-slide .price-tag span {
        font-size: 14px;
        font-weight: 400;
        color: var(--muted);
        font-family: 'DM Sans', sans-serif;
    }

    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--accent);
        color: #fff;
        padding: 13px 28px;
        border-radius: 100px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.25s;
        font-family: 'DM Sans', sans-serif;
        letter-spacing: 0.02em;
    }

    .btn-primary-custom:hover {
        background: #E02D24;
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(255,59,48,0.45);
        color: #fff;
    }

    .hero-dots {
        position: absolute;
        bottom: 20px;
        left: 50px;
        display: flex;
        gap: 8px;
        z-index: 10;
    }

    .hero-dot {
        width: 8px;
        height: 8px;
        border-radius: 100px;
        background: rgba(255,255,255,0.2);
        cursor: pointer;
        transition: all 0.3s;
    }

    .hero-dot.active {
        width: 28px;
        background: var(--accent);
    }

    /* Side banners */
    .hero-side-card {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        background: var(--card);
        position: relative;
        padding: 32px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        background-size: cover;
        background-position: center;
        min-height: 195px;
        text-decoration: none;
    }

    .hero-side-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(10,10,15,0.3) 0%, rgba(10,10,15,0.88) 100%);
    }

    .hero-side-card .content { position: relative; z-index: 2; }

    .hero-side-card .sub { font-size: 11px; color: var(--accent); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700; margin-bottom: 6px; }
    .hero-side-card h3 { font-size: 20px; color: #fff; margin-bottom: 4px; }
    .hero-side-card .price { font-size: 22px; color: var(--accent2); font-family: 'Clash Display', sans-serif; font-weight: 700; }

    .hero-sale-card {
        border-radius: 20px;
        background: linear-gradient(135deg, #1E1018 0%, #2A102A 100%);
        border: 1px solid rgba(255,59,48,0.2);
        padding: 32px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hero-sale-card h2 { font-size: 26px; color: #fff; margin-bottom: 10px; }
    .hero-sale-card p { font-size: 14px; color: var(--muted); line-height: 1.6; margin-bottom: 20px; }

    /* ── TRUST BAR ────────────────────────────── */
    .trust-bar {
        background: var(--surface);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 22px 0;
    }

    .trust-bar ul {
        display: flex;
        align-items: center;
        justify-content: space-around;
        list-style: none;
        flex-wrap: wrap;
        gap: 16px;
    }

    .trust-bar li {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text);
        font-size: 14px;
        font-weight: 500;
    }

    .trust-bar li i {
        font-size: 22px;
        color: var(--accent);
    }

    .trust-bar li span { color: var(--muted); font-size: 12px; display: block; font-weight: 400; }

    /* ── SECTION TITLE ────────────────────────── */
    .section { padding: 90px 0; }

    .section-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--accent);
        font-family: 'DM Sans', sans-serif;
        margin-bottom: 10px;
    }

    .section-heading {
        font-size: 42px;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 14px;
        line-height: 1.1;
    }

    .section-desc {
        color: var(--muted);
        font-size: 15px;
        max-width: 520px;
        line-height: 1.7;
    }

    /* ── CATEGORIES ───────────────────────────── */
    .featured-categories { background: var(--surface); }

    .category-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 32px 28px 0;
        overflow: hidden;
        position: relative;
        transition: all 0.35s ease;
        margin-bottom: 24px;
        height: 100%;
    }

    .category-card:hover {
        border-color: rgba(255,59,48,0.35);
        transform: translateY(-6px);
        box-shadow: 0 24px 60px rgba(0,0,0,0.5), var(--glow-red);
    }

    .category-card .cat-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--accent);
        font-family: 'DM Sans', sans-serif;
        margin-bottom: 8px;
    }

    .category-card h3 {
        font-size: 22px;
        color: var(--white);
        margin-bottom: 20px;
    }

    .category-card ul {
        list-style: none;
        margin-bottom: 24px;
    }

    .category-card ul li {
        padding: 8px 0;
        border-top: 1px solid var(--border);
    }

    .category-card ul li:last-child { border-bottom: 1px solid var(--border); }

    .category-card ul li a {
        color: var(--muted);
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .category-card ul li a:hover { color: var(--white); }
    .category-card ul li a::after { content: '→'; font-size: 12px; opacity: 0; transition: all 0.2s; }
    .category-card ul li a:hover::after { opacity: 1; transform: translateX(4px); }

    .category-card .cat-img {
        display: block;
        width: 100%;
        height: 140px;
        object-fit: contain;
        filter: drop-shadow(0 -20px 30px rgba(255,59,48,0.12));
        transform: scale(1);
        transition: transform 0.4s ease;
    }

    .category-card:hover .cat-img { transform: scale(1.06) translateY(-4px); }

    /* ── PRODUCTS ─────────────────────────────── */
    .trending-product { background: var(--primary); }

    .product-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.35s ease;
        margin-bottom: 24px;
        position: relative;
    }

    .product-card:hover {
        border-color: rgba(255,159,10,0.3);
        transform: translateY(-6px);
        box-shadow: 0 24px 60px rgba(0,0,0,0.5);
    }

    .product-card .img-wrap {
        position: relative;
        overflow: hidden;
        background: #0d0d14;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card .img-wrap img {
        max-height: 180px;
        max-width: 90%;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .product-card:hover .img-wrap img { transform: scale(1.08); }

    .product-card .overlay-btn {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 20px;
        opacity: 0;
        transition: opacity 0.3s;
        background: linear-gradient(180deg, transparent 30%, rgba(10,10,15,0.85) 100%);
    }

    .product-card:hover .overlay-btn { opacity: 1; }

    .product-card .overlay-btn a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--accent);
        color: #fff;
        padding: 11px 22px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transform: translateY(10px);
        transition: transform 0.3s;
        font-family: 'DM Sans', sans-serif;
    }

    .product-card:hover .overlay-btn a { transform: translateY(0); }

    .product-card .product-body {
        padding: 20px;
    }

    .product-card .cat-tag {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--accent);
        font-family: 'DM Sans', sans-serif;
        margin-bottom: 6px;
    }

    .product-card h4 a {
        font-size: 16px;
        color: var(--white);
        text-decoration: none;
        font-family: 'Clash Display', sans-serif;
        transition: color 0.2s;
        display: block;
        margin-bottom: 10px;
    }

    .product-card h4 a:hover { color: var(--accent2); }

    .product-card .stars { display: flex; align-items: center; gap: 3px; margin-bottom: 12px; }
    .product-card .stars i { font-size: 12px; color: var(--accent2); }
    .product-card .stars span { font-size: 12px; color: var(--muted); margin-left: 4px; }

    .product-card .price-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .product-card .price {
        font-size: 22px;
        font-weight: 700;
        color: var(--white);
        font-family: 'Clash Display', sans-serif;
    }

    .product-card .wishlist-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--surface);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .product-card .wishlist-btn:hover { background: rgba(255,59,48,0.15); color: var(--accent); border-color: rgba(255,59,48,0.3); }

    /* NEW badge */
    .badge-new {
        position: absolute;
        top: 14px;
        left: 14px;
        background: var(--accent);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 100px;
        font-family: 'DM Sans', sans-serif;
        z-index: 2;
    }

    /* ── MID BANNER ───────────────────────────── */
    .banner.section { background: var(--surface); }

    .promo-banner {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        min-height: 240px;
        display: flex;
        align-items: flex-end;
        padding: 36px;
        background-size: cover;
        background-position: center;
        text-decoration: none;
        transition: transform 0.3s;
    }

    .promo-banner:hover { transform: scale(1.015); }

    .promo-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg, rgba(10,10,15,0.9) 30%, rgba(10,10,15,0.4) 100%);
    }

    .promo-banner .content { position: relative; z-index: 2; }
    .promo-banner h2 { font-size: 28px; color: #fff; margin-bottom: 8px; }
    .promo-banner p { font-size: 14px; color: rgba(255,255,255,0.6); margin-bottom: 18px; line-height: 1.6; }

    .btn-outline-light-custom {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #fff;
        padding: 10px 22px;
        border-radius: 100px;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.25s;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-outline-light-custom:hover {
        background: rgba(255,255,255,0.12);
        border-color: rgba(255,255,255,0.6);
        color: #fff;
    }

    /* ── SPECIAL OFFER ────────────────────────── */
    .special-offer { background: var(--primary); }

    .offer-product-mini {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 24px;
        transition: all 0.3s;
    }

    .offer-product-mini:hover {
        border-color: rgba(255,159,10,0.3);
        transform: translateY(-4px);
    }

    .offer-product-mini .mini-img {
        height: 160px;
        background: #0d0d14;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .offer-product-mini .mini-img img {
        max-height: 130px;
        object-fit: contain;
        transition: transform 0.3s;
    }

    .offer-product-mini:hover .mini-img img { transform: scale(1.07); }

    .offer-product-mini .mini-body { padding: 16px; }
    .offer-product-mini .mini-body .cat-tag { font-size: 11px; color: var(--accent); font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 5px; font-family: 'DM Sans', sans-serif; }
    .offer-product-mini .mini-body h4 a { font-size: 14px; color: var(--white); text-decoration: none; font-family: 'Clash Display', sans-serif; display: block; margin-bottom: 8px; }
    .offer-product-mini .mini-body .stars { display: flex; align-items: center; gap: 2px; margin-bottom: 8px; }
    .offer-product-mini .mini-body .stars i { font-size: 11px; color: var(--accent2); }
    .offer-product-mini .mini-body .price { font-size: 18px; font-weight: 700; color: var(--accent2); font-family: 'Clash Display', sans-serif; }

    /* Offer spotlight card */
    .offer-spotlight {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 24px;
        overflow: hidden;
        height: 100%;
    }

    .offer-spotlight .spotlight-img {
        position: relative;
        height: 260px;
        background: linear-gradient(135deg, #0d0d14 0%, #1A0A1E 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .offer-spotlight .spotlight-img img {
        max-height: 220px;
        object-fit: contain;
        position: relative;
        z-index: 2;
    }

    .offer-spotlight .spotlight-img::before {
        content: '';
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,59,48,0.2) 0%, transparent 70%);
        z-index: 1;
    }

    .sale-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent);
        color: #fff;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 13px;
        font-family: 'Clash Display', sans-serif;
        z-index: 3;
    }

    .offer-spotlight .spotlight-body { padding: 28px; }
    .offer-spotlight .spotlight-body h2 a { font-size: 22px; color: var(--white); text-decoration: none; display: block; margin-bottom: 10px; }
    .offer-spotlight .spotlight-body .stars { display: flex; gap: 3px; margin-bottom: 14px; }
    .offer-spotlight .spotlight-body .stars i { color: var(--accent2); font-size: 13px; }
    .offer-spotlight .spotlight-body .price-group { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
    .offer-spotlight .spotlight-body .price-now { font-size: 28px; font-weight: 700; color: var(--accent2); font-family: 'Clash Display', sans-serif; }
    .offer-spotlight .spotlight-body .price-was { font-size: 16px; color: var(--muted); text-decoration: line-through; }
    .offer-spotlight .spotlight-body p { font-size: 13px; color: var(--muted); line-height: 1.7; margin-bottom: 24px; }

    /* Countdown */
    .countdown-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin-bottom: 8px;
    }

    .countdown-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 12px 8px;
        text-align: center;
    }

    .countdown-box h1 {
        font-size: 28px;
        font-weight: 800;
        color: var(--white);
        font-family: 'Clash Display', sans-serif;
        letter-spacing: -0.02em;
        line-height: 1;
        margin-bottom: 4px;
    }

    .countdown-box h2 {
        font-size: 10px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
    }

    .event-ended {
        background: rgba(255,59,48,0.08);
        border: 1px solid rgba(255,59,48,0.2);
        border-radius: 12px;
        padding: 16px;
        text-align: center;
        color: var(--accent);
        font-size: 14px;
        font-weight: 600;
        font-family: 'DM Sans', sans-serif;
    }

    /* ── SIDE PROMO BANNER ────────────────────── */
    .side-promo-banner {
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        min-height: 200px;
        display: flex;
        align-items: flex-end;
        padding: 28px;
        background-size: cover;
        background-position: center;
        margin-top: 24px;
    }

    .side-promo-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg, rgba(10,10,15,0.9) 30%, rgba(10,10,15,0.4) 100%);
    }

    .side-promo-banner .content { position: relative; z-index: 2; }
    .side-promo-banner h2 { font-size: 20px; color: #fff; margin-bottom: 6px; }
    .side-promo-banner p { font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 14px; }
    .side-promo-banner .price-tag { font-size: 24px; font-weight: 700; color: var(--accent2); font-family: 'Clash Display', sans-serif; margin-bottom: 16px; }

    /* ── PRODUCT LIST ─────────────────────────── */
    .home-product-list { background: var(--surface); }

    .list-section-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--white);
        padding-bottom: 14px;
        margin-bottom: 4px;
        border-bottom: 2px solid var(--accent);
        display: inline-block;
        font-family: 'Clash Display', sans-serif;
    }

    .list-product-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
        text-decoration: none;
        transition: all 0.2s;
    }

    .list-product-item:hover { padding-left: 6px; }

    .list-product-item .list-thumb {
        width: 68px;
        height: 68px;
        border-radius: 12px;
        background: var(--card);
        border: 1px solid var(--border);
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .list-product-item .list-thumb img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        transition: transform 0.3s;
    }

    .list-product-item:hover .list-thumb img { transform: scale(1.1); }

    .list-product-item .list-info h3 {
        font-size: 14px;
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        line-height: 1.4;
        margin-bottom: 5px;
    }

    .list-product-item .list-info span {
        font-size: 15px;
        font-weight: 700;
        color: var(--accent2);
        font-family: 'Clash Display', sans-serif;
    }

    /* ── BRANDS ───────────────────────────────── */
    .brands {
        background: var(--primary);
        padding: 60px 0;
        overflow: hidden;
    }

    .brands .title {
        text-align: center;
        font-size: 14px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.2em;
        font-family: 'DM Sans', sans-serif;
        margin-bottom: 36px;
    }

    .brands-track {
        display: flex;
        gap: 60px;
        animation: scrollBrands 18s linear infinite;
        width: max-content;
    }

    @keyframes scrollBrands {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .brand-logo img {
        height: 36px;
        width: auto;
        filter: brightness(0) invert(1);
        opacity: 0.25;
        transition: opacity 0.3s;
    }

    .brand-logo img:hover { opacity: 0.7; }

    /* ── BLOG ─────────────────────────────────── */
    .blog-section { background: var(--surface); }

    .blog-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.35s;
        margin-bottom: 24px;
        height: 100%;
    }

    .blog-card:hover {
        border-color: rgba(255,59,48,0.25);
        transform: translateY(-6px);
        box-shadow: 0 24px 60px rgba(0,0,0,0.4);
    }

    .blog-card .blog-thumb {
        overflow: hidden;
        height: 200px;
    }

    .blog-card .blog-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .blog-card:hover .blog-thumb img { transform: scale(1.06); }

    .blog-card .blog-body { padding: 24px; }

    .blog-card .blog-cat {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--accent);
        text-decoration: none;
        font-family: 'DM Sans', sans-serif;
        display: inline-block;
        margin-bottom: 10px;
    }

    .blog-card h4 a {
        font-size: 18px;
        color: var(--white);
        text-decoration: none;
        line-height: 1.4;
        display: block;
        margin-bottom: 12px;
        transition: color 0.2s;
        font-family: 'Clash Display', sans-serif;
    }

    .blog-card h4 a:hover { color: var(--accent); }

    .blog-card p {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .btn-text {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--accent);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        font-family: 'DM Sans', sans-serif;
        transition: gap 0.2s;
    }

    .btn-text:hover { gap: 10px; color: var(--accent); }

    /* ── RESPONSIVE ───────────────────────────── */
    @media (max-width: 768px) {
        .hero-slide h2 { font-size: 28px; }
        .hero-slider-wrap { height: 340px; }
        .section-heading { font-size: 30px; }
        .hero-area { padding: 40px 0 60px; }
        .hero-side-card { margin-top: 16px; }
    }

    /* scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--primary); }
    ::-webkit-scrollbar-thumb { background: var(--surface); border-radius: 100px; }
</style>

{{-- ── HERO ──────────────────────────────────────── --}}
<section class="hero-area">
    <div class="grid-bg"></div>
    <div class="container">
        <div class="row align-items-stretch g-4">

            {{-- Main Slider --}}
            <div class="col-lg-8 col-12">
                <div class="hero-slider-wrap" id="heroSlider">

                    <div class="hero-slide active" style="background-image:url('website/assets/images/hero/slider-bg1.jpg');">
                        <div class="content">
                            <span class="badge">No Restocking Fee · $35 Savings</span>
                            <h2>M75 Sport<br>Watch</h2>
                            <p>Elevate your performance. Precision-engineered for athletes who demand more from every rep.</p>
                            <div class="price-tag">$320.99 <span>was $355.99</span></div>
                            <a href="product-grids.html" class="btn-primary-custom">
                                <i class="lni lni-cart"></i> Shop Now
                            </a>
                        </div>
                    </div>

                    <div class="hero-slide" style="background-image:url('website/assets/images/hero/slider-bg2.jpg');">
                        <div class="content">
                            <span class="badge">Big Sale Offer</span>
                            <h2>Best Deal on<br>CCTV Camera</h2>
                            <p>Professional surveillance made simple. Complete kit with 4K resolution and AI detection.</p>
                            <div class="price-tag">$590.00 <span>Combo Deal</span></div>
                            <a href="product-grids.html" class="btn-primary-custom">
                                <i class="lni lni-cart"></i> Shop Now
                            </a>
                        </div>
                    </div>

                    <div class="hero-dots" id="heroDots">
                        <div class="hero-dot active" data-idx="0"></div>
                        <div class="hero-dot" data-idx="1"></div>
                    </div>
                </div>
            </div>

            {{-- Side Cards --}}
            <div class="col-lg-4 col-12 d-flex flex-column gap-4">
                <a class="hero-side-card flex-fill" href="product-grids.html"
                   style="background-image:url('website/assets/images/hero/slider-bnr.jpg');">
                    <div class="content">
                        <div class="sub">New Line Required</div>
                        <h3>iPhone 12 Pro Max</h3>
                        <div class="price">$259.99</div>
                    </div>
                </a>

                <div class="hero-sale-card flex-fill">
                    <h2>Weekly Sale! 🔥</h2>
                    <p>Save up to <strong style="color:var(--accent)">50% off</strong> all online store items this week. Limited time only.</p>
                    <a href="product-grids.html" class="btn-primary-custom">
                        Explore Deals <span>→</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── TRUST BAR ─────────────────────────────────── --}}
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

{{-- ── FEATURED CATEGORIES ───────────────────────── --}}
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
            @php
                $cats = [
                    ['TV & Audios', 'featured-categories/fetured-item-1.png'],
                    ['Desktop & Laptop', 'featured-categories/fetured-item-2.png'],
                    ['CCTV Camera', 'featured-categories/fetured-item-3.png'],
                    ['DSLR Camera', 'featured-categories/fetured-item-4.png'],
                    ['Smart Phones', 'featured-categories/fetured-item-5.png'],
                    ['Game Console', 'featured-categories/fetured-item-6.png'],
                ];
                $links = ['Smart Television','QLED TV','Audios','Headphones'];
            @endphp

            @foreach($cats as $cat)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="category-card">
                    <div class="cat-label">Category</div>
                    <h3>{{ $cat[0] }}</h3>
                    <ul>
                        @foreach($links as $link)
                        <li><a href="product-grids.html">{{ $link }}</a></li>
                        @endforeach
                        <li><a href="product-grids.html">View All</a></li>
                    </ul>
                    <img class="cat-img" src="{{ asset('website/assets/images/'.$cat[1]) }}" alt="{{ $cat[0] }}">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── TRENDING PRODUCTS ─────────────────────────── --}}
<section class="trending-product section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <div class="section-label">Hot Right Now</div>
                <h2 class="section-heading">Trending Products</h2>
                <p class="section-desc">The most-loved products this week, flying off our shelves.</p>
            </div>
        </div>

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
                            <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                <i class="lni lni-cart"></i> Add to Cart
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
                        <div class="price-row">
                            <div class="price">{{ $product->selling_price }}</div>
                            <button class="wishlist-btn"><i class="lni lni-heart"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── PROMO BANNERS ─────────────────────────────── --}}
<section class="banner section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 col-md-6 col-12">
                <a class="promo-banner" href="product-grids.html"
                   style="background-image:url('website/assets/images/banner/banner-1-bg.jpg');">
                    <div class="content">
                        <h2>Smart Watch 2.0</h2>
                        <p>Space Gray Aluminum Case with Black/Volt Real Sport Band</p>
                        <span class="btn-outline-light-custom">View Details →</span>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <a class="promo-banner" href="product-grids.html"
                   style="background-image:url('website/assets/images/banner/banner-2-bg.jpg');">
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

{{-- ── SPECIAL OFFER ─────────────────────────────── --}}
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
                    @php
                        $offers = [
                            ['product-3.jpg','Camera','WiFi Security Camera','$399.00'],
                            ['product-8.jpg','Laptop','Apple MacBook Air','$899.00'],
                            ['product-6.jpg','Speaker','Bluetooth Speaker','$70.00'],
                        ];
                    @endphp
                    @foreach($offers as $offer)
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="offer-product-mini">
                            <div class="mini-img">
                                <img src="{{ asset('website/assets/images/products/'.$offer[0]) }}" alt="{{ $offer[2] }}">
                            </div>
                            <div class="mini-body">
                                <div class="cat-tag">{{ $offer[1] }}</div>
                                <h4><a href="product-details.html">{{ $offer[2] }}</a></h4>
                                <div class="stars">
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                </div>
                                <div class="price">{{ $offer[3] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <a class="side-promo-banner" href="product-grids.html"
                   style="background-image:url('website/assets/images/banner/banner-3-bg.jpg');">
                    <div class="content">
                        <h2>Samsung Notebook 9</h2>
                        <p>Thin. Light. Powerful. Redefined productivity.</p>
                        <div class="price-tag">$590.00</div>
                        <span class="btn-outline-light-custom">Shop Now →</span>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="offer-spotlight">
                    <div class="spotlight-img">
                        <span class="sale-badge">-50%</span>
                        <img src="{{ asset('website/assets/images/offer/offer-image.jpg') }}" alt="Bluetooth Headphone">
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

{{-- ── PRODUCT LIST ──────────────────────────────── --}}
<section class="home-product-list section">
    <div class="container">
        <div class="row">
            {{-- Best Sellers --}}
            <div class="col-lg-4 col-md-4 col-12">
                <span class="list-section-title">Best Sellers</span>
                @php
                    $best = [
                        ['01.jpg','GoPro Hero4 Silver','$287.99'],
                        ['02.jpg','Puro Sound Labs BT2200','$95.00'],
                        ['03.jpg','HP OfficeJet Pro 8710','$120.00'],
                    ];
                @endphp
                @foreach($best as $item)
                <a class="list-product-item" href="product-grids.html">
                    <div class="list-thumb">
                        <img src="{{ asset('website/assets/images/home-product-list/'.$item[0]) }}" alt="{{ $item[1] }}">
                    </div>
                    <div class="list-info">
                        <h3>{{ $item[1] }}</h3>
                        <span>{{ $item[2] }}</span>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- New Arrivals --}}
            <div class="col-lg-4 col-md-4 col-12">
                <span class="list-section-title">New Arrivals</span>
                @php
                    $arrivals = [
                        ['04.jpg','iPhone X 256 GB Space Gray','$1150.00'],
                        ['05.jpg','Canon EOS M50 Mirrorless','$950.00'],
                        ['06.jpg','Microsoft Xbox One S','$298.00'],
                    ];
                @endphp
                @foreach($arrivals as $item)
                <a class="list-product-item" href="product-grids.html">
                    <div class="list-thumb">
                        <img src="{{ asset('website/assets/images/home-product-list/'.$item[0]) }}" alt="{{ $item[1] }}">
                    </div>
                    <div class="list-info">
                        <h3>{{ $item[1] }}</h3>
                        <span>{{ $item[2] }}</span>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Top Rated --}}
            <div class="col-lg-4 col-md-4 col-12">
                <span class="list-section-title">Top Rated</span>
                @php
                    $rated = [
                        ['07.jpg','Samsung Gear 360 VR Camera','$68.00'],
                        ['08.jpg','Samsung Galaxy S9+ 64 GB','$840.00'],
                        ['09.jpg','Zeus Bluetooth Headphones','$28.00'],
                    ];
                @endphp
                @foreach($rated as $item)
                <a class="list-product-item" href="product-grids.html">
                    <div class="list-thumb">
                        <img src="{{ asset('website/assets/images/home-product-list/'.$item[0]) }}" alt="{{ $item[1] }}">
                    </div>
                    <div class="list-info">
                        <h3>{{ $item[1] }}</h3>
                        <span>{{ $item[2] }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── BRANDS ────────────────────────────────────── --}}
<div class="brands">
    <div class="container">
        <h2 class="title">Trusted Brands</h2>
    </div>
    <div style="overflow:hidden;">
        <div class="brands-track">
            @for($i = 1; $i <= 6; $i++)
            <div class="brand-logo">
                <img src="{{ asset('website/assets/images/brands/0'.$i.'.png') }}" alt="Brand">
            </div>
            @endfor
            @for($i = 1; $i <= 6; $i++)
            <div class="brand-logo">
                <img src="{{ asset('website/assets/images/brands/0'.$i.'.png') }}" alt="Brand">
            </div>
            @endfor
        </div>
    </div>
</div>

{{-- ── BLOG ──────────────────────────────────────── --}}
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
            @php
                $blogs = [
                    ['blog-1.jpg','eCommerce','What information is needed for shipping?','Everything you need to know about international shipping, duties, and delivery timelines explained simply.'],
                    ['blog-2.jpg','Gaming','Interesting facts about gaming consoles','From cartridges to cloud gaming — the incredible journey of the gaming console over four decades.'],
                    ['blog-3.jpg','Electronic','Electronics, instrumentation & control engineering','How modern control engineering is reshaping smart homes, IoT devices, and industrial automation.'],
                ];
            @endphp
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="blog-card">
                    <div class="blog-thumb">
                        <img src="{{ asset('website/assets/images/blog/'.$blog[0]) }}" alt="{{ $blog[2] }}">
                    </div>
                    <div class="blog-body">
                        <a class="blog-cat" href="javascript:void(0)">{{ $blog[1] }}</a>
                        <h4><a href="blog-single-sidebar.html">{{ $blog[2] }}</a></h4>
                        <p>{{ $blog[3] }}</p>
                        <a href="javascript:void(0)" class="btn-text">Read Article →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Hero Slider JS --}}
<script>
(function(){
    const slides = document.querySelectorAll('.hero-slide');
    const dots   = document.querySelectorAll('.hero-dot');
    let cur = 0, timer;

    function goTo(n) {
        slides[cur].classList.remove('active');
        dots[cur].classList.remove('active');
        cur = (n + slides.length) % slides.length;
        slides[cur].classList.add('active');
        dots[cur].classList.add('active');
    }

    function next() { goTo(cur + 1); }

    timer = setInterval(next, 5000);

    dots.forEach(d => {
        d.addEventListener('click', () => {
            clearInterval(timer);
            goTo(parseInt(d.dataset.idx));
            timer = setInterval(next, 5000);
        });
    });
})();
</script>

@endsection