@extends('website.master')
@section('title')
Online Shopping 

@endsection


@section('body')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --navy:   #1a3c6e;
        --navy2:  #122d54;
        --accent: #1a6fd4;
        --gold:   #e8a020;
        --light:  #f4f7fc;
        --text:   #1e293b;
        --muted:  #64748b;
        --white:  #ffffff;
    }

    .about-wrap * { box-sizing: border-box; margin: 0; padding: 0; }

    .about-wrap {
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
        overflow-x: hidden;
    }

    /* ── Hero ── */
    .about-hero {
        background: var(--navy);
        color: var(--white);
        padding: 100px 40px 80px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        pointer-events: none;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        bottom: -100px; left: -60px;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(26,111,212,0.15);
        pointer-events: none;
    }

    .about-hero-tag {
        display: inline-block;
        background: rgba(232,160,32,0.18);
        color: var(--gold);
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 20px;
        margin-bottom: 24px;
        border: 1px solid rgba(232,160,32,0.3);
    }

    .about-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(38px, 6vw, 72px);
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 24px;
        position: relative;
        z-index: 1;
    }

    .about-hero h1 span {
        color: var(--gold);
    }

    .about-hero p {
        font-size: 18px;
        font-weight: 300;
        color: rgba(255,255,255,0.75);
        max-width: 560px;
        margin: 0 auto;
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    /* ── Story Section ── */
    .about-story {
        padding: 90px 40px;
        background: var(--white);
    }

    .about-story-inner {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .story-visual {
        position: relative;
    }

    .story-img-box {
        background: var(--navy);
        border-radius: 20px;
        height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .story-img-box svg {
        width: 160px;
        height: 160px;
        opacity: 0.15;
    }

    .story-img-box-pattern {
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 20% 20%, rgba(26,111,212,0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(232,160,32,0.15) 0%, transparent 50%);
    }

    .story-badge {
        position: absolute;
        bottom: -20px;
        right: -20px;
        background: var(--gold);
        color: var(--navy2);
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 14px;
        padding: 20px 24px;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(232,160,32,0.35);
        text-align: center;
        line-height: 1.3;
    }

    .story-badge strong {
        display: block;
        font-size: 32px;
    }

    .story-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .story-text h2 span { color: var(--accent); }

    .story-divider {
        width: 48px;
        height: 4px;
        background: var(--gold);
        border-radius: 2px;
        margin-bottom: 24px;
    }

    .story-text p {
        font-size: 16px;
        line-height: 1.8;
        color: var(--muted);
        margin-bottom: 16px;
    }

    /* ── Mission ── */
    .about-mission {
        background: var(--light);
        padding: 90px 40px;
    }

    .about-mission-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .section-label {
        text-align: center;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 12px;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        color: var(--navy);
        text-align: center;
        margin-bottom: 56px;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .mission-card {
        background: var(--white);
        border-radius: 20px;
        padding: 40px 32px;
        border: 1px solid #e2e8f0;
        transition: transform 0.25s, box-shadow 0.25s;
        position: relative;
        overflow: hidden;
    }

    .mission-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--navy);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s;
    }

    .mission-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(26,60,110,0.12); }
    .mission-card:hover::before { transform: scaleX(1); }

    .mission-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: var(--light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        font-size: 26px;
    }

    .mission-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 12px;
    }

    .mission-card p {
        font-size: 15px;
        line-height: 1.7;
        color: var(--muted);
    }

    /* ── Stats ── */
    .about-stats {
        background: var(--navy);
        padding: 80px 40px;
    }

    .about-stats-inner {
        max-width: 1100px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
        text-align: center;
    }

    .stat-item {}

    .stat-number {
        font-family: 'Playfair Display', serif;
        font-size: 52px;
        font-weight: 900;
        color: var(--white);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-number span { color: var(--gold); }

    .stat-label {
        font-size: 14px;
        color: rgba(255,255,255,0.6);
        font-weight: 300;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .stat-divider {
        width: 1px;
        background: rgba(255,255,255,0.1);
        align-self: stretch;
        margin: 10px 0;
    }

    /* ── Values ── */
    .about-values {
        padding: 90px 40px;
        background: var(--white);
    }

    .about-values-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-top: 56px;
    }

    .value-row {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        padding: 28px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        transition: background 0.2s;
    }

    .value-row:hover { background: var(--light); }

    .value-num {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 900;
        color: #e2e8f0;
        line-height: 1;
        flex-shrink: 0;
        width: 48px;
    }

    .value-row:hover .value-num { color: var(--gold); transition: color 0.2s; }

    .value-content h4 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 8px;
    }

    .value-content p {
        font-size: 14px;
        line-height: 1.7;
        color: var(--muted);
    }

    /* ── CTA ── */
    .about-cta {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
        padding: 90px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-cta::before {
        content: '';
        position: absolute;
        top: -100px; right: -100px;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: rgba(26,111,212,0.1);
        pointer-events: none;
    }

    .about-cta h2 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        font-weight: 900;
        color: var(--white);
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .about-cta p {
        font-size: 17px;
        color: rgba(255,255,255,0.7);
        margin-bottom: 36px;
        position: relative;
        z-index: 1;
    }

    .cta-btn {
        display: inline-block;
        background: var(--gold);
        color: var(--navy2);
        font-weight: 600;
        font-size: 15px;
        padding: 16px 40px;
        border-radius: 50px;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        z-index: 1;
        margin: 0 8px;
    }

    .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(232,160,32,0.4); }

    .cta-btn-outline {
        display: inline-block;
        border: 2px solid rgba(255,255,255,0.4);
        color: var(--white);
        font-weight: 500;
        font-size: 15px;
        padding: 14px 40px;
        border-radius: 50px;
        text-decoration: none;
        transition: border-color 0.2s, background 0.2s;
        position: relative;
        z-index: 1;
        margin: 0 8px;
    }

    .cta-btn-outline:hover { border-color: white; background: rgba(255,255,255,0.08); }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .about-story-inner { grid-template-columns: 1fr; gap: 48px; }
        .mission-grid { grid-template-columns: 1fr; }
        .about-stats-inner { grid-template-columns: repeat(2, 1fr); }
        .values-grid { grid-template-columns: 1fr; }
        .story-badge { right: 0; bottom: -16px; }
        .about-hero { padding: 70px 24px 60px; }
        .about-story, .about-mission, .about-values, .about-cta { padding: 60px 24px; }
    }

    /* ── Animations ── */
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<div class="about-wrap">

    {{-- ── Hero ── --}}
    <section class="about-hero">
        <div class="about-hero-tag">Our Story</div>
        <h1>Shopping Made <span>Simple,</span><br>Quality Made <span>Accessible</span></h1>
        <p>We started with a simple belief — everyone deserves great products at honest prices, delivered with care.</p>
    </section>

    {{-- ── Story ── --}}
    <section class="about-story">
        <div class="about-story-inner">
            <div class="story-visual fade-up">
                <div class="story-img-box">
                    <div class="story-img-box-pattern"></div>
                    <svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="story-badge">
                    <strong>2019</strong>
                    Founded with<br>a vision
                </div>
            </div>

            <div class="story-text fade-up">
                <h2>Born from a <span>Passion</span> for Better Shopping</h2>
                <div class="story-divider"></div>
                <p>ShopGrids was founded in 2019 by a small team who were tired of the hassle — overpriced products, unreliable sellers, and slow deliveries. We knew there was a better way.</p>
                <p>We built ShopGrids from the ground up to be different: transparent pricing, carefully vetted products, and a shopping experience that respects your time and trust.</p>
                <p>Today we serve thousands of happy customers every month, but our core belief hasn't changed — you deserve the best, without the compromise.</p>
            </div>
        </div>
    </section>

    {{-- ── Mission Cards ── --}}
    <section class="about-mission">
        <div class="about-mission-inner">
            <div class="section-label">What Drives Us</div>
            <h2 class="section-title">Our Mission & Values</h2>
            <div class="mission-grid">
                <div class="mission-card fade-up">
                    <div class="mission-icon">🎯</div>
                    <h3>Our Mission</h3>
                    <p>To make quality products accessible to everyone by connecting great brands with smart shoppers — simply, reliably, and affordably.</p>
                </div>
                <div class="mission-card fade-up" style="transition-delay:0.1s">
                    <div class="mission-icon">👁️</div>
                    <h3>Our Vision</h3>
                    <p>To be the most trusted e-commerce platform in the region — a place where customers come back not just for the products, but for the experience.</p>
                </div>
                <div class="mission-card fade-up" style="transition-delay:0.2s">
                    <div class="mission-icon">🤝</div>
                    <h3>Our Promise</h3>
                    <p>Every product is genuine. Every price is fair. Every delivery is handled with care. If something goes wrong, we make it right — no questions asked.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Stats ── --}}
    <section class="about-stats">
        <div class="about-stats-inner">
            <div class="stat-item fade-up">
                <div class="stat-number">12<span>K+</span></div>
                <div class="stat-label">Happy Customers</div>
            </div>
            <div class="stat-item fade-up" style="transition-delay:0.1s">
                <div class="stat-number">3<span>K+</span></div>
                <div class="stat-label">Products Listed</div>
            </div>
            <div class="stat-item fade-up" style="transition-delay:0.2s">
                <div class="stat-number">98<span>%</span></div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
            <div class="stat-item fade-up" style="transition-delay:0.3s">
                <div class="stat-number">5<span>+</span></div>
                <div class="stat-label">Years of Service</div>
            </div>
        </div>
    </section>

    {{-- ── Core Values ── --}}
    <section class="about-values">
        <div class="about-values-inner">
            <div class="section-label">What We Stand For</div>
            <h2 class="section-title">The Principles We Live By</h2>
            <div class="values-grid">
                <div class="value-row fade-up">
                    <div class="value-num">01</div>
                    <div class="value-content">
                        <h4>Radical Transparency</h4>
                        <p>No hidden fees, no bait-and-switch. What you see is what you get — from pricing to delivery timelines.</p>
                    </div>
                </div>
                <div class="value-row fade-up" style="transition-delay:0.1s">
                    <div class="value-num">02</div>
                    <div class="value-content">
                        <h4>Customer First, Always</h4>
                        <p>Every decision we make starts with one question: is this good for our customers? If it isn't, we don't do it.</p>
                    </div>
                </div>
                <div class="value-row fade-up" style="transition-delay:0.15s">
                    <div class="value-num">03</div>
                    <div class="value-content">
                        <h4>Quality Without Compromise</h4>
                        <p>Every product on ShopGrids is reviewed before listing. We'd rather have fewer options than bad ones.</p>
                    </div>
                </div>
                <div class="value-row fade-up" style="transition-delay:0.2s">
                    <div class="value-num">04</div>
                    <div class="value-content">
                        <h4>Community & Trust</h4>
                        <p>We're not just a store — we're a community. We grow by earning trust, one order at a time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="about-cta">
        <h2>Ready to Start Shopping?</h2>
        <p>Join thousands of satisfied customers who trust ShopGrids every day.</p>
        <a href="{{ route('home') }}" class="cta-btn">Browse Products</a>
        <a href="javascript:void(0)" class="cta-btn-outline" onclick="toggleChat()">Talk to Us</a>
    </section>

</div>

<script>
    // Scroll-triggered fade-up animations
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.fade-up').forEach(function(el) {
        observer.observe(el);
    });
</script>


@endsection