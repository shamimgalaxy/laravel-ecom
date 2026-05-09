<script src="{{ asset('website/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('website/assets/js/tiny-slider.js')}}"></script>
<script src="{{ asset('website/assets/js/glightbox.min.js')}}"></script>
<script src="{{ asset('website/assets/js/main.js')}}"></script>
<script src="{{ asset('website/assets/js/bootstrap.bundle.min2.js')}}"></script>
<script src="{{ asset('website/assets/js/jquery-3.6.0.min2.js')}}"></script>
<script src="{{ asset('website/assets/js/xzoom.min2.js')}}"></script>

<script>
    $(document).ready(function() {
        $("#xzoom-default").xzoom({
            position: 'right',
            lens: true,
            Xoffset: 15
        });
    });
</script>

<script type="text/javascript">
    //========= Hero Slider
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
        controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
    });

    //======== Brand Slider
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
</script>

<script>
    const finaleDate = new Date("December 31, 2026 00:00:00").getTime();

    // ✅ FIX: intervalId stored so we can clear it when timer ends
    let countdownInterval;

    const timer = () => {
        const now  = new Date().getTime();
        const diff = finaleDate - now;

        if (diff < 0) {
            // Show "Event Ended" alert
            const alertEl  = document.querySelector('.alert');
            const timerBox = document.querySelector('.box-head');
            if (alertEl)  alertEl.style.display  = 'block';
            if (timerBox) timerBox.style.display  = 'none';

            // ✅ FIX: clearInterval instead of illegal return
            clearInterval(countdownInterval);
            return; // ✅ Legal here — we're inside a function
        }

        let days    = Math.floor(diff / (1000 * 60 * 60 * 24));
        let hours   = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
        let seconds = Math.floor(diff % (1000 * 60) / 1000);

        days    <= 99 ? days    = `0${days}`    : days;
        days    <= 9  ? days    = `00${days}`   : days;
        hours   <= 9  ? hours   = `0${hours}`   : hours;
        minutes <= 9  ? minutes = `0${minutes}` : minutes;
        seconds <= 9  ? seconds = `0${seconds}` : seconds;

        document.querySelector('#days').textContent    = days;
        document.querySelector('#hours').textContent   = hours;
        document.querySelector('#minutes').textContent = minutes;
        document.querySelector('#seconds').textContent = seconds;
    };

    timer();
    countdownInterval = setInterval(timer, 1000);
</script>