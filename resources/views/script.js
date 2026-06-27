/* ── ANIMASI ── */

function animateCounter(el, target, duration) {
  const start = performance.now();

  function step(now) {
    const elapsed  = now - start;
    const progress = Math.min(elapsed / duration, 1);

    const eased = 1 - Math.pow(1 - progress, 3);

    el.textContent = Math.floor(eased * target).toLocaleString('id-ID');

    if (progress < 1) requestAnimationFrame(step);
  }

  requestAnimationFrame(step);
}

window.addEventListener('DOMContentLoaded', () => {
  const counterEl = document.getElementById('counter-users');
  if (counterEl) {
    setTimeout(() => {
      animateCounter(counterEl, 1500, 1800);
    }, 900);
  }
});
const statNumbers = document.querySelectorAll('.stat-number');
 
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el     = entry.target;
      const target = parseInt(el.getAttribute('data-target'));
      animateCounter(el, target, 1800);
      observer.unobserve(el); // animasi cukup sekali
    }
  });
}, { threshold: 0.3 });
 
statNumbers.forEach(el => observer.observe(el));
/* ── SLIDER FACTORY ── */
function initSlider(sliderId, prevId, nextId, visibleCount = 2) {
  const slider = document.getElementById(sliderId);
  const btnPrev = document.getElementById(prevId);
  const btnNext = document.getElementById(nextId);

  if (!slider || !btnPrev || !btnNext) return;

  let current = 0;
  const cards = slider.children;
  const total = cards.length;

  function getCardWidth() {
    return cards[0].offsetWidth + 24;
  }

  function updateSlider() {
    slider.style.transform = `translateX(-${current * getCardWidth()}px)`;
  }

  btnNext.addEventListener('click', () => {
    if (current < total - visibleCount) current++;
    updateSlider();
  });

  btnPrev.addEventListener('click', () => {
    if (current > 0) current--;
    updateSlider();
  });
}

window.addEventListener('DOMContentLoaded', () => {
  initSlider('heroSlider', 'heroPrev', 'heroNext', 2);
  initSlider('testiSlider', 'testiPrev', 'testiNext', 2);
});