{{--
    SCRIPT LOAD ORDER (critical):
    1. jQuery           — everything depends on this
    2. Bootstrap bundle — needs jQuery
    3. tiny-slider      — standalone
    4. glightbox        — standalone
    5. xzoom            — needs jQuery
    6. main.js          — needs jQuery + plugins
    7. header.js        — standalone, runs its own DOMContentLoaded
    8. Inline inits     — run after all above are loaded
--}}

{{-- 1. jQuery --}}
<script src="{{ asset('website/assets/js/jquery-3.6.0.min2.js') }}"></script>

{{-- 2. Bootstrap --}}
<script src="{{ asset('website/assets/js/bootstrap.bundle.min2.js') }}"></script>
<script src="{{ asset('website/assets/js/bootstrap.min.js') }}"></script>

{{-- 3. Tiny Slider --}}
<script src="{{ asset('website/assets/js/tiny-slider.js') }}"></script>

{{-- 4. GLightbox --}}
<script src="{{ asset('website/assets/js/glightbox.min.js') }}"></script>

{{-- 5. xZoom --}}
<script src="{{ asset('website/assets/js/xzoom.min2.js') }}"></script>

{{-- 6. Main JS --}}
<script src="{{ asset('website/assets/js/main.js') }}"></script>

{{-- 7. Header JS --}}
<script src="{{ asset('website/assets/js/header.js') }}"></script>

{{-- 8. Inline initializations --}}
<script>
$(document).ready(function () {

    // ── xZoom (product image zoom) ──────────────────────────
    if ($("#xzoom-default").length) {
        $("#xzoom-default").xzoom({
            position: 'right',
            lens: true,
            Xoffset: 15
        });
    }

    // ── Hero Slider ─────────────────────────────────────────
    if (document.querySelector('.hero-slider')) {
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: [
                '<i class="lni lni-chevron-left"></i>',
                '<i class="lni lni-chevron-right"></i>'
            ],
        });
    }

    // ── Brands Logo Carousel ────────────────────────────────
    if (document.querySelector('.brands-logo-carousel')) {
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0:   { items: 1 },
                540: { items: 3 },
                768: { items: 5 },
                992: { items: 6 }
            }
        });
    }

});
</script>

{{-- ── Countdown Timer ─────────────────────────────────────── --}}
<script>
(function () {
    var daysEl    = document.querySelector('#days');
    var hoursEl   = document.querySelector('#hours');
    var minutesEl = document.querySelector('#minutes');
    var secondsEl = document.querySelector('#seconds');

    if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;

    var finaleDate        = new Date("December 31, 2026 00:00:00").getTime();
    var countdownInterval;

    function pad2(n) { return n <= 9  ? '0'  + n : '' + n; }
    function pad3(n) { return n <= 99 ? '0'  + pad2(n) : '' + n; }

    function timer() {
        var now  = new Date().getTime();
        var diff = finaleDate - now;

        if (diff < 0) {
            var alertEl  = document.querySelector('.alert');
            var timerBox = document.querySelector('.box-head');
            if (alertEl)  alertEl.style.display = 'block';
            if (timerBox) timerBox.style.display = 'none';
            clearInterval(countdownInterval);
            return;
        }

        daysEl.textContent    = pad3(Math.floor(diff / (1000 * 60 * 60 * 24)));
        hoursEl.textContent   = pad2(Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60)));
        minutesEl.textContent = pad2(Math.floor(diff % (1000 * 60 * 60) / (1000 * 60)));
        secondsEl.textContent = pad2(Math.floor(diff % (1000 * 60) / 1000));
    }

    timer();
    countdownInterval = setInterval(timer, 1000);
})();
</script>