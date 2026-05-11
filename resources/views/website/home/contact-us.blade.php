@extends('website.master')

@section('title')
Contact Us
@endsection

@section('body')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

    .contact-hero {
        background: linear-gradient(135deg, #1a3c6e 0%, #0f2447 60%, #0a1628 100%);
        padding: 90px 0 70px;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 400px; height: 400px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.06);
    }
    .contact-hero::after {
        content: '';
        position: absolute;
        bottom: -120px; left: -60px;
        width: 500px; height: 500px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.04);
    }
    .contact-hero-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #22c55e;
        margin-bottom: 16px;
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 5vw, 58px);
        font-weight: 700;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 20px;
    }
    .contact-hero h1 span {
        color: #22c55e;
    }
    .contact-hero p {
        font-family: 'DM Sans', sans-serif;
        font-size: 17px;
        color: rgba(255,255,255,0.65);
        max-width: 480px;
        line-height: 1.7;
    }
    .breadcrumb-contact {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        color: rgba(255,255,255,0.45);
        margin-bottom: 28px;
    }
    .breadcrumb-contact a { color: rgba(255,255,255,0.45); text-decoration: none; transition: color 0.2s; }
    .breadcrumb-contact a:hover { color: #22c55e; }
    .breadcrumb-contact span { color: rgba(255,255,255,0.7); }

    /* Info Cards */
    .contact-info-section {
        background: #f8fafc;
        padding: 60px 0 0;
    }
    .info-card {
        background: #fff;
        border-radius: 16px;
        padding: 36px 28px;
        text-align: center;
        border: 1px solid #e8eef6;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
    }
    .info-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(26, 60, 110, 0.12);
    }
    .info-card-icon {
        width: 64px; height: 64px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        font-size: 26px;
    }
    .info-card-icon.blue { background: #e8f0fb; color: #1a3c6e; }
    .info-card-icon.green { background: #dcfce7; color: #16a34a; }
    .info-card-icon.orange { background: #fef3c7; color: #d97706; }
    .info-card-icon.purple { background: #f3e8ff; color: #7c3aed; }
    .info-card h4 {
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .info-card p, .info-card a {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #64748b;
        margin: 0;
        text-decoration: none;
        line-height: 1.6;
        display: block;
    }
    .info-card a:hover { color: #1a3c6e; }

    /* Main Section */
    .contact-main {
        background: #f8fafc;
        padding: 60px 0 80px;
    }

    /* Form */
    .contact-form-wrap {
        background: #fff;
        border-radius: 20px;
        padding: 48px 44px;
        border: 1px solid #e8eef6;
        box-shadow: 0 4px 24px rgba(26,60,110,0.06);
    }
    .form-section-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #22c55e;
        margin-bottom: 8px;
    }
    .contact-form-wrap h2 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        color: #1a3c6e;
        margin-bottom: 8px;
    }
    .contact-form-wrap > p {
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        color: #64748b;
        margin-bottom: 32px;
    }
    .form-group { margin-bottom: 20px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 7px;
        display: block;
    }
    .form-label span { color: #ef4444; margin-left: 2px; }
    .form-control-custom {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #1e293b;
        background: #fafbfc;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        box-sizing: border-box;
    }
    .form-control-custom:focus {
        border-color: #1a3c6e;
        box-shadow: 0 0 0 3px rgba(26,60,110,0.08);
        background: #fff;
    }
    .form-control-custom::placeholder { color: #9ca3af; }
    textarea.form-control-custom { resize: vertical; min-height: 130px; }
    select.form-control-custom { appearance: none; cursor: pointer; }

    .subject-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
    }
    .subject-chip {
        padding: 7px 14px;
        border-radius: 20px;
        border: 1.5px solid #e2e8f0;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafbfc;
        user-select: none;
    }
    .subject-chip:hover, .subject-chip.active {
        border-color: #1a3c6e;
        background: #1a3c6e;
        color: #fff;
    }

    .submit-btn {
        width: 100%;
        padding: 15px 28px;
        background: #1a3c6e;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        margin-top: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .submit-btn:hover { background: #22c55e; transform: translateY(-1px); }
    .submit-btn:active { transform: translateY(0); }
    .submit-btn .btn-icon { font-size: 18px; transition: transform 0.2s; }
    .submit-btn:hover .btn-icon { transform: translateX(4px); }

    /* Sidebar */
    .contact-sidebar { display: flex; flex-direction: column; gap: 24px; }

    .sidebar-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px;
        border: 1px solid #e8eef6;
    }
    .sidebar-card h4 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        color: #1a3c6e;
        margin-bottom: 16px;
    }

    /* Hours */
    .hours-list { list-style: none; padding: 0; margin: 0; }
    .hours-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 9px 0;
        border-bottom: 1px solid #f1f5f9;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
    }
    .hours-list li:last-child { border-bottom: none; }
    .hours-list .day { color: #374151; font-weight: 500; }
    .hours-list .time { color: #64748b; }
    .hours-list .closed { color: #ef4444; font-size: 12px; font-weight: 600; letter-spacing: 0.5px; }

    /* Chat CTA */
    .chat-cta-card {
        background: linear-gradient(135deg, #1a3c6e 0%, #0f2447 100%);
        border-radius: 16px;
        padding: 28px;
        text-align: center;
        border: none;
    }
    .chat-cta-card .chat-icon {
        width: 52px; height: 52px;
        background: rgba(34,197,94,0.2);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
        font-size: 22px;
        color: #22c55e;
    }
    .chat-cta-card h4 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        color: #fff;
        margin-bottom: 8px;
    }
    .chat-cta-card p {
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 18px;
        line-height: 1.6;
    }
    .chat-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 11px 22px;
        background: #22c55e;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
    }
    .chat-cta-btn:hover { background: #16a34a; color: #fff; }

    /* FAQ */
    .faq-section {
        padding: 70px 0;
        background: #fff;
    }
    .faq-section .section-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #22c55e;
        text-align: center;
        margin-bottom: 10px;
    }
    .faq-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        font-weight: 700;
        color: #1a3c6e;
        text-align: center;
        margin-bottom: 10px;
    }
    .faq-section > .container > p {
        font-family: 'DM Sans', sans-serif;
        text-align: center;
        color: #64748b;
        font-size: 16px;
        margin-bottom: 48px;
    }
    .faq-item {
        border: 1px solid #e8eef6;
        border-radius: 12px;
        margin-bottom: 12px;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .faq-item:hover { box-shadow: 0 4px 16px rgba(26,60,110,0.08); }
    .faq-question {
        width: 100%;
        padding: 18px 24px;
        background: none;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        text-align: left;
        gap: 16px;
    }
    .faq-question .faq-icon {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
        color: #64748b;
        transition: background 0.2s, transform 0.3s;
    }
    .faq-item.open .faq-question .faq-icon {
        background: #1a3c6e;
        color: #fff;
        transform: rotate(45deg);
    }
    .faq-answer {
        display: none;
        padding: 0 24px 20px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #64748b;
        line-height: 1.75;
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
    }
    .faq-item.open .faq-answer { display: block; }

    /* Map */
    .map-section {
        background: #f8fafc;
        padding: 0 0 80px;
    }
    .map-wrap {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e8eef6;
        box-shadow: 0 4px 24px rgba(26,60,110,0.08);
    }
    .map-wrap iframe {
        width: 100%;
        height: 380px;
        display: block;
        border: none;
        filter: grayscale(20%);
    }

    /* Success Message */
    .success-message {
        display: none;
        background: #dcfce7;
        border: 1px solid #86efac;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #15803d;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .form-row { grid-template-columns: 1fr; }
        .contact-form-wrap { padding: 28px 20px; }
        .contact-hero { padding: 60px 0 50px; }
    }
</style>

{{-- Hero --}}
<section class="contact-hero">
    <div class="container">
        <div class="breadcrumb-contact">
            <a href="{{ route('home') }}">Home</a>
            <i class="lni lni-chevron-right" style="font-size:10px;"></i>
            <span>Contact Us</span>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="contact-hero-label">Get in Touch</div>
                <h1>We'd Love to <span>Hear</span> From You</h1>
                <p>Have a question, feedback, or need support? Our team is ready to help you every step of the way.</p>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-end">
                <div style="display:flex;gap:16px;">
                    <div style="background:rgba(255,255,255,0.07);border-radius:16px;padding:24px;text-align:center;min-width:120px;">
                        <div style="font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:#22c55e;">24/7</div>
                        <div style="font-family:'DM Sans',sans-serif;font-size:13px;color:rgba(255,255,255,0.55);margin-top:4px;">Support</div>
                    </div>
                    <div style="background:rgba(255,255,255,0.07);border-radius:16px;padding:24px;text-align:center;min-width:120px;">
                        <div style="font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:#22c55e;">&lt;2h</div>
                        <div style="font-family:'DM Sans',sans-serif;font-size:13px;color:rgba(255,255,255,0.55);margin-top:4px;">Response Time</div>
                    </div>
                    <div style="background:rgba(255,255,255,0.07);border-radius:16px;padding:24px;text-align:center;min-width:120px;">
                        <div style="font-family:'Playfair Display',serif;font-size:36px;font-weight:700;color:#22c55e;">98%</div>
                        <div style="font-family:'DM Sans',sans-serif;font-size:13px;color:rgba(255,255,255,0.55);margin-top:4px;">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Info Cards --}}
<section class="contact-info-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <div class="info-card-icon blue"><i class="lni lni-map-marker"></i></div>
                    <h4>Visit Our Store</h4>
                    <p>New Paltan, Dhaka-1205<br>Bangladesh</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <div class="info-card-icon green"><i class="lni lni-phone"></i></div>
                    <h4>Call Us Anytime</h4>
                    <a href="tel:+8801748793616">+880 1748-793616</a>
                    <a href="tel:+8801748793616" style="margin-top:4px;">+880 1748-793616</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <div class="info-card-icon orange"><i class="lni lni-envelope"></i></div>
                    <h4>Email Support</h4>
                    <a href="mailto:shamimgalaxy@gmail.com">shamimgalaxy@gmail.com</a>
                    <a href="mailto:support@shopgrids.com" style="margin-top:4px;">support@shopgrids.com</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <div class="info-card-icon purple"><i class="lni lni-whatsapp"></i></div>
                    <h4>WhatsApp Us</h4>
                    <a href="https://wa.me/8801748793616" target="_blank">Chat on WhatsApp</a>
                    <p style="margin-top:4px;">Mon–Sat, 9am–8pm</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Main Contact Area --}}
<section class="contact-main">
    <div class="container" style="padding-top:48px;">
        <div class="row g-5">

            {{-- Form --}}
            <div class="col-lg-7">
                <div class="contact-form-wrap">
                    <div class="form-section-label">Send a Message</div>
                    <h2>How Can We Help?</h2>
                    <p>Fill out the form below and we'll get back to you within 2 hours.</p>

                    <div class="success-message" id="successMsg">
                        <i class="lni lni-checkmark-circle" style="font-size:20px;"></i>
                        <span>Your message has been sent! We'll respond within 2 hours.</span>
                    </div>

                    <form id="contactForm" action="#" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">First Name <span>*</span></label>
                                <input type="text" class="form-control-custom" placeholder="John" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name <span>*</span></label>
                                <input type="text" class="form-control-custom" placeholder="Doe" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email Address <span>*</span></label>
                                <input type="email" class="form-control-custom" placeholder="john@example.com" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control-custom" placeholder="+880 1700-000000">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">What's this about?</label>
                            <div class="subject-chips">
                                <span class="subject-chip active" onclick="selectChip(this)">Order Issue</span>
                                <span class="subject-chip" onclick="selectChip(this)">Product Inquiry</span>
                                <span class="subject-chip" onclick="selectChip(this)">Return & Refund</span>
                                <span class="subject-chip" onclick="selectChip(this)">Technical Support</span>
                                <span class="subject-chip" onclick="selectChip(this)">Partnership</span>
                                <span class="subject-chip" onclick="selectChip(this)">Other</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Order Number <small style="color:#9ca3af;font-weight:400;">(if applicable)</small></label>
                            <input type="text" class="form-control-custom" placeholder="e.g. #SG-2026-00123">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Your Message <span>*</span></label>
                            <textarea class="form-control-custom" placeholder="Please describe your issue or question in detail..." required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            Send Message <span class="btn-icon"><i class="lni lni-arrow-right"></i></span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-5">
                <div class="contact-sidebar">

                    {{-- Live Chat CTA --}}
                    <div class="chat-cta-card">
                        <div class="chat-icon"><i class="lni lni-comments-alt-2"></i></div>
                        <h4>Prefer Live Chat?</h4>
                        <p>Get instant answers from our support team. Available 24/7 for your convenience.</p>
                        <button class="chat-cta-btn" onclick="toggleChat()">
                            <i class="lni lni-comments"></i> Start Live Chat
                        </button>
                    </div>

                    {{-- Business Hours --}}
                    <div class="sidebar-card">
                        <h4>Business Hours</h4>
                        <ul class="hours-list">
                            <li>
                                <span class="day">Monday – Friday</span>
                                <span class="time">9:00 AM – 8:00 PM</span>
                            </li>
                            <li>
                                <span class="day">Saturday</span>
                                <span class="time">10:00 AM – 6:00 PM</span>
                            </li>
                            <li>
                                <span class="day">Sunday</span>
                                <span class="closed">CLOSED</span>
                            </li>
                        </ul>
                        <div style="margin-top:16px;padding:12px 14px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;gap:8px;">
                            <span style="width:8px;height:8px;background:#22c55e;border-radius:50%;flex-shrink:0;"></span>
                            <span style="font-family:'DM Sans',sans-serif;font-size:13px;color:#15803d;font-weight:500;">We're currently open</span>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="sidebar-card">
                        <h4>Follow Us</h4>
                        <p style="font-family:'DM Sans',sans-serif;font-size:14px;color:#64748b;margin-bottom:16px;">Stay updated with our latest products, offers and news.</p>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;">
                            <a href="javascript:void(0)" style="display:flex;align-items:center;gap:7px;padding:9px 14px;border-radius:8px;border:1px solid #e2e8f0;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;color:#374151;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.borderColor='#1877f2';this.style.color='#1877f2'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151'">
                                <i class="lni lni-facebook-filled" style="color:#1877f2;font-size:16px;"></i> Facebook
                            </a>
                            <a href="javascript:void(0)" style="display:flex;align-items:center;gap:7px;padding:9px 14px;border-radius:8px;border:1px solid #e2e8f0;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;color:#374151;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.borderColor='#e1306c';this.style.color='#e1306c'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151'">
                                <i class="lni lni-instagram" style="color:#e1306c;font-size:16px;"></i> Instagram
                            </a>
                            <a href="javascript:void(0)" style="display:flex;align-items:center;gap:7px;padding:9px 14px;border-radius:8px;border:1px solid #e2e8f0;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;color:#374151;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.borderColor='#1da1f2';this.style.color='#1da1f2'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151'">
                                <i class="lni lni-twitter-original" style="color:#1da1f2;font-size:16px;"></i> Twitter
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="faq-section">
    <div class="container">
        <div class="section-label">FAQ</div>
        <h2>Frequently Asked Questions</h2>
        <p>Find quick answers to common questions below.</p>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-item open">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        How long does delivery take?
                        <span class="faq-icon"><i class="lni lni-plus"></i></span>
                    </button>
                    <div class="faq-answer">Standard delivery takes 3–5 business days within Dhaka, and 5–7 days for other areas. Express delivery (1–2 days) is available at an additional charge during checkout.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        What is your return policy?
                        <span class="faq-icon"><i class="lni lni-plus"></i></span>
                    </button>
                    <div class="faq-answer">We offer a hassle-free 7-day return policy on all products. Items must be unused, in original packaging, and accompanied by the original receipt. Contact us to initiate a return.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Do you offer cash on delivery?
                        <span class="faq-icon"><i class="lni lni-plus"></i></span>
                    </button>
                    <div class="faq-answer">Yes! We offer cash on delivery across Bangladesh. You can also pay via bKash, Nagad, or credit/debit card through our secure SSLCommerz payment gateway.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        How can I track my order?
                        <span class="faq-icon"><i class="lni lni-plus"></i></span>
                    </button>
                    <div class="faq-answer">Once your order is dispatched, you'll receive a tracking number via SMS and email. You can also log in to your customer dashboard to view real-time order status.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Can I change or cancel my order?
                        <span class="faq-icon"><i class="lni lni-plus"></i></span>
                    </button>
                    <div class="faq-answer">Orders can be modified or cancelled within 2 hours of placement. After that, please contact our support team as soon as possible and we'll do our best to accommodate your request.</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Map --}}
<section class="map-section">
    <div class="container">
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.3282661515!2d90.41469!3d23.73534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904d2!2sNew%20Paltan%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1680000000000"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<script>
    function selectChip(el) {
        document.querySelectorAll('.subject-chip').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
    }

    function toggleFaq(btn) {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        if (!isOpen) item.classList.add('open');
    }

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('.submit-btn');
        btn.innerHTML = '<i class="lni lni-spinner-arrow" style="animation:spin 1s linear infinite"></i> Sending...';
        btn.disabled = true;
        setTimeout(() => {
            document.getElementById('successMsg').style.display = 'flex';
            btn.innerHTML = 'Send Message <span class="btn-icon"><i class="lni lni-arrow-right"></i></span>';
            btn.disabled = false;
            this.reset();
            document.querySelectorAll('.subject-chip').forEach((c, i) => c.classList.toggle('active', i === 0));
            window.scrollTo({ top: document.getElementById('contactForm').offsetTop - 100, behavior: 'smooth' });
        }, 1500);
    });

    // Auto-hide status indicator based on time
    const now = new Date();
    const hour = now.getHours();
    const day  = now.getDay();
    const statusEl = document.querySelector('.contact-sidebar .sidebar-card:last-of-type') ;
    const dot = document.querySelector('[style*="background:#22c55e;border-radius:50%"]');
    const statusText = dot ? dot.nextElementSibling : null;
    const isWeekday = day >= 1 && day <= 5;
    const isSaturday = day === 6;
    const isOpen = (isWeekday && hour >= 9 && hour < 20) || (isSaturday && hour >= 10 && hour < 18);
    if (!isOpen && dot && statusText) {
        dot.style.background = '#ef4444';
        statusText.style.color = '#dc2626';
        statusText.textContent = 'Currently closed — we\'ll respond soon';
        statusText.closest('div').style.background = '#fef2f2';
    }
</script>

@endsection