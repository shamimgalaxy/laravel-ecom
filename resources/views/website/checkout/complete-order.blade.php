@extends('website.master')

@section('title', 'Order Complete | My Shop')

@push('styles')
<style>
#oc-root {
    all: initial;
    display: block;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif !important;
    padding: 48px 16px 72px !important;
    background: #f5f4ff !important;
    min-height: 60vh !important;
    box-sizing: border-box !important;
}
#oc-root * { box-sizing: border-box !important; }
#oc-root .oc-wrap  { max-width: 500px !important; margin: 0 auto !important; }
#oc-root .oc-card  { background: #fff !important; border-radius: 18px !important; overflow: hidden !important; box-shadow: 0 4px 6px rgba(0,0,0,.05), 0 20px 50px rgba(99,71,230,.1) !important; }

/* Top gradient panel */
#oc-root .oc-top {
    background: linear-gradient(135deg, #5b3fd4 0%, #4a7cf0 55%, #2db88a 100%) !important;
    padding: 48px 36px 44px !important;
    text-align: center !important;
    position: relative !important;
    overflow: hidden !important;
}
#oc-root .oc-top::after {
    content: '' !important;
    position: absolute !important; inset: 0 !important;
    background: radial-gradient(ellipse at 50% 0%, rgba(255,255,255,.12) 0%, transparent 65%) !important;
    pointer-events: none !important;
}

/* Confetti */
#oc-root .oc-conf  { position: absolute !important; inset: 0 !important; pointer-events: none !important; overflow: hidden !important; z-index: 2 !important; }
#oc-root .oc-cp    { position: absolute !important; opacity: 0 !important; animation: oc-fall var(--d, 3s) ease var(--dl, 2s) 1 both !important; }

/* Seal */
#oc-root .oc-seal  { width: 68px !important; height: 68px !important; margin: 0 auto 22px !important; position: relative !important; z-index: 1 !important; display: block !important; animation: oc-pop .65s cubic-bezier(.34,1.5,.64,1) .4s both !important; }
#oc-root .oc-seal svg { width: 68px !important; height: 68px !important; display: block !important; overflow: visible !important; }
#oc-root .oc-glow  { position: absolute !important; inset: -14px !important; border-radius: 50% !important; background: radial-gradient(circle, rgba(255,255,255,.2) 0%, transparent 65%) !important; animation: oc-glow 3s ease-in-out 2.2s infinite !important; }

/* Text */
#oc-root .oc-ey    { display: block !important; font-size: 10px !important; letter-spacing: .2em !important; text-transform: uppercase !important; color: rgba(255,255,255,.6) !important; margin: 0 0 10px !important; position: relative !important; z-index: 1 !important; animation: oc-up .5s ease .9s both !important; font-weight: 400 !important; }
#oc-root .oc-h1    { display: block !important; font-size: 30px !important; font-weight: 700 !important; color: #fff !important; line-height: 1.25 !important; letter-spacing: -.02em !important; margin: 0 !important; position: relative !important; z-index: 1 !important; animation: oc-up .5s ease 1s both !important; }
#oc-root .oc-nm    { font-style: italic !important; font-weight: 300 !important; }
#oc-root .oc-msg   { display: block !important; font-size: 13px !important; color: rgba(255,255,255,.7) !important; margin-top: 10px !important; position: relative !important; z-index: 1 !important; animation: oc-up .5s ease 1.1s both !important; }

/* Body */
#oc-root .oc-body  { padding: 32px 36px 36px !important; background: #fff !important; }
#oc-root .oc-sub   { display: block !important; font-size: 13px !important; color: #6b7280 !important; line-height: 1.8 !important; margin: 0 0 24px !important; animation: oc-up .5s ease 1.2s both !important; font-weight: 400 !important; }

/* Stats */
#oc-root .oc-stats { display: grid !important; grid-template-columns: 1fr 1fr 1fr !important; gap: 1px !important; background: #ede9fe !important; border-radius: 12px !important; overflow: hidden !important; margin: 0 0 24px !important; animation: oc-up .5s ease 1.3s both !important; }
#oc-root .oc-si    { background: #fff !important; padding: 14px 8px !important; text-align: center !important; }
#oc-root .oc-sl    { display: block !important; font-size: 10px !important; letter-spacing: .14em !important; text-transform: uppercase !important; color: #9ca3af !important; margin-bottom: 5px !important; font-weight: 400 !important; }
#oc-root .oc-sv    { display: block !important; font-size: 14px !important; font-weight: 600 !important; color: #111827 !important; }
#oc-root .oc-sv.ok { color: #059669 !important; }

/* Button */
#oc-root .oc-btn {
    display: flex !important; align-items: center !important; justify-content: center !important; gap: 8px !important;
    width: 100% !important; padding: 14px 20px !important; border-radius: 12px !important;
    background: linear-gradient(135deg, #5b3fd4, #4a7cf0) !important;
    color: #fff !important; font-size: 13px !important; font-weight: 600 !important;
    letter-spacing: .03em !important; text-decoration: none !important;
    border: none !important; cursor: pointer !important;
    transition: transform .2s, box-shadow .2s !important;
    box-shadow: 0 4px 14px rgba(91,63,212,.35) !important;
    animation: oc-up .5s ease 1.4s both !important;
}
#oc-root .oc-btn:hover { transform: translateY(-2px) !important; box-shadow: 0 8px 24px rgba(91,63,212,.45) !important; color: #fff !important; }
#oc-root .oc-arr  { transition: transform .2s !important; display: inline-block !important; }
#oc-root .oc-btn:hover .oc-arr { transform: translateX(4px) !important; }

/* Keyframes */
@keyframes oc-pop  { from { opacity:0; transform: scale(.25) rotate(-20deg); } to { opacity:1; transform: scale(1) rotate(0); } }
@keyframes oc-glow { 0%,100% { opacity:.5; transform:scale(1); } 50% { opacity:1; transform:scale(1.2); } }
@keyframes oc-up   { from { opacity:0; transform: translateY(10px); } to { opacity:1; transform:translateY(0); } }
@keyframes oc-dr   { to { stroke-dashoffset: 0; } }
@keyframes oc-dc   { to { stroke-dashoffset: 0; } }
@keyframes oc-fall { 0% { opacity:1; transform: translateY(-6px) rotate(0); } 100% { opacity:0; transform: translateY(180px) rotate(var(--r, 360deg)); } }
</style>
@endpush

@section('body')

<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Order Complete</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li>Complete Order</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="oc-root">
    <div class="oc-wrap">
        <div class="oc-card">

            <div class="oc-top">
                <div class="oc-conf" id="oc-conf"></div>

                <div class="oc-seal">
                    <div class="oc-glow"></div>
                    <svg viewBox="0 0 68 68" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="ocRG" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="rgba(255,255,255,.95)"/>
                                <stop offset="100%" stop-color="rgba(255,255,255,.45)"/>
                            </linearGradient>
                        </defs>
                        <circle cx="34" cy="34" r="32" fill="none"
                            stroke="rgba(255,255,255,.18)" stroke-width="1" stroke-dasharray="3 5"/>
                        <circle cx="34" cy="34" r="25" fill="none"
                            stroke="url(#ocRG)" stroke-width="2" stroke-linecap="round"
                            stroke-dasharray="157" stroke-dashoffset="157"
                            transform="rotate(-90 34 34)"
                            style="animation: oc-dr 1.2s ease .6s forwards"/>
                        <polyline points="20,34 30,44 50,22" fill="none"
                            stroke="#fff" stroke-width="2.8"
                            stroke-linecap="round" stroke-linejoin="round"
                            stroke-dasharray="48" stroke-dashoffset="48"
                            style="animation: oc-dc .4s ease 1.7s forwards"/>
                    </svg>
                </div>

                <span class="oc-ey">Order Confirmed</span>
                <span class="oc-h1">
                    Thank you,<br>
                    <span class="oc-nm">{{ session('customer_name', 'Valued Customer') }}</span>
                </span>

                @if(session('message'))
                    <span class="oc-msg">{{ session('message') }}</span>
                @endif
            </div>

            <div class="oc-body">
                <span class="oc-sub">
                    Your order has been placed and is being prepared.<br>
                    A confirmation will arrive in your inbox shortly.
                </span>

                <div class="oc-stats">
                    <div class="oc-si">
                        <span class="oc-sl">Status</span>
                        <span class="oc-sv ok">Confirmed</span>
                    </div>
                    <div class="oc-si">
                        <span class="oc-sl">Delivery</span>
                        <span class="oc-sv">3–5 Days</span>
                    </div>
  <div class="oc-si">
    <span class="oc-sl">Support 24/7</span>
    <span class="oc-sv" style="display: flex; gap: 16px; justify-content: center;">
        <a href="tel:+10012345678" style="color: inherit; text-decoration: none;" title="Call Us">
            📞 Call
        </a>
        <a href="javascript:void(0)" 
           onclick="document.querySelector('.chat-toggle-btn').click()" 
           style="color: inherit; text-decoration: none;" 
           title="Live Chat">
            💬 Chat
        </a>
    </span>
</div>
                </div>

                <a href="{{ url('/') }}" class="oc-btn">
                    Continue Shopping <span class="oc-arr">→</span>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
    var c = ['rgba(255,255,255,.9)','rgba(196,181,253,.9)','rgba(110,231,183,.9)','rgba(255,255,255,.5)','rgba(165,180,252,.8)'];
    var w = document.getElementById('oc-conf');
    for (var i = 0; i < 40; i++) {
        var el = document.createElement('div');
        el.className = 'oc-cp';
        var p = Math.random() > .5;
        el.setAttribute('style',
            (p ? 'width:3px;height:8px;border-radius:2px' : 'width:5px;height:5px;border-radius:1px')
            + ';position:absolute'
            + ';left:'  + (10 + Math.random() * 80) + '%'
            + ';top:'   + (5  + Math.random() * 35) + '%'
            + ';background:' + c[i % c.length]
            + ';opacity:0'
            + ';--d:'   + (2  + Math.random() * 2)   + 's'
            + ';--dl:'  + (1.8 + Math.random() * 1.5) + 's'
            + ';--r:'   + (Math.random() > .5 ? 1 : -1) * (150 + Math.random() * 300) + 'deg'
            + ';animation:oc-fall var(--d) ease var(--dl) 1 both'
        );
        w.appendChild(el);
    }
})();
</script>
@endpush