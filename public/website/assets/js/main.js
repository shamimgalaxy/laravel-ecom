(function () {

  /* ── Back to top button ── */
  window.addEventListener('scroll', function () {
    var backToTop = document.querySelector('.scroll-top');
    if (!backToTop) return;
    backToTop.style.display =
      (document.documentElement.scrollTop > 50 || document.body.scrollTop > 50)
        ? 'flex' : 'none';
  });

  /* ── Mobile menu toggle ── */
  var mobileBtn = document.querySelector('.mobile-menu-btn');
  if (mobileBtn) {
    mobileBtn.addEventListener('click', function () {
      mobileBtn.classList.toggle('active');
    });
  }

}());