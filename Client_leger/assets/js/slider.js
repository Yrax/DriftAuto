/* ═══════════════════════════════════════════════
   DriftAuto — slider.js
   Logique du slider automatique (Hero section)
   ═══════════════════════════════════════════════ */

(function () {
  const slides   = document.querySelectorAll('.slide');
  const dots     = document.querySelectorAll('.dot');
  const progress = document.getElementById('sliderProgress');
  const DURATION = 5000; // Durée par slide en millisecondes

  let current = 0;
  let timer   = null;

  /* ─── Navigation vers un slide précis ─── */
  function goTo(index) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (index + slides.length) % slides.length;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
    resetProgress();
  }

  function next() { goTo(current + 1); }
  function prev() { goTo(current - 1); }

  /* ─── Défilement automatique ─── */
  function startAuto() {
    clearInterval(timer);
    timer = setInterval(next, DURATION);
  }

  /* ─── Barre de progression ─── */
  function resetProgress() {
    progress.style.transition = 'none';
    progress.style.width      = '0%';
    void progress.offsetWidth; // Force le reflow pour relancer l'animation
    progress.style.transition = `width ${DURATION}ms linear`;
    progress.style.width      = '100%';
  }

  /* ─── Événements : dots ─── */
  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      goTo(parseInt(dot.dataset.index));
      startAuto();
    });
  });

  /* ─── Événements : flèches ─── */
  document.getElementById('nextSlide').addEventListener('click', () => { next(); startAuto(); });
  document.getElementById('prevSlide').addEventListener('click', () => { prev(); startAuto(); });

  /* ─── Pause au survol de la souris ─── */
  const hero = document.getElementById('hero');
  hero.addEventListener('mouseenter', () => clearInterval(timer));
  hero.addEventListener('mouseleave', startAuto);

  /* ─── Swipe tactile (mobile) ─── */
  let touchStartX = 0;
  hero.addEventListener('touchstart', e => {
    touchStartX = e.touches[0].clientX;
  }, { passive: true });

  hero.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) {
      diff > 0 ? next() : prev();
      startAuto();
    }
  });

  /* ─── Initialisation ─── */
  startAuto();
  resetProgress();
})();


/* ═══════════════════════════════════════════════
   SLIDER PROMOTIONS — navigation horizontale
   ═══════════════════════════════════════════════ */
(function () {
  const track   = document.getElementById('promoTrack');
  const dots    = document.querySelectorAll('#promoDots .promo-dot');
  const btnPrev = document.getElementById('promoPrev');
  const btnNext = document.getElementById('promoNext');

  if (!track) return;

  const cards   = track.querySelectorAll('.promo-card');
  let current   = 0;
  let autoTimer = null;
  const DURATION = 4000;

  function getCardWidth() {
    if (!cards[0]) return 0;
    const style = getComputedStyle(track);
    const gap   = parseFloat(style.gap) || 20;
    return cards[0].getBoundingClientRect().width + gap;
  }

  function goTo(index) {
    current = (index + cards.length) % cards.length;
    track.style.transform = `translateX(-${current * getCardWidth()}px)`;
    dots.forEach((d, i) => d.classList.toggle('active', i === current));
  }

  function startAuto() {
    clearInterval(autoTimer);
    autoTimer = setInterval(() => goTo(current + 1), DURATION);
  }

  dots.forEach(dot => {
    dot.addEventListener('click', () => { goTo(parseInt(dot.dataset.index)); startAuto(); });
  });

  btnNext.addEventListener('click', () => { goTo(current + 1); startAuto(); });
  btnPrev.addEventListener('click', () => { goTo(current - 1); startAuto(); });

  /* Swipe mobile */
  let touchX = 0;
  track.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; }, { passive: true });
  track.addEventListener('touchend', e => {
    const diff = touchX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) { diff > 0 ? goTo(current + 1) : goTo(current - 1); startAuto(); }
  });

  /* Pause au survol */
  track.closest('.promo-slider-wrap').addEventListener('mouseenter', () => clearInterval(autoTimer));
  track.closest('.promo-slider-wrap').addEventListener('mouseleave', startAuto);

  startAuto();
})();
