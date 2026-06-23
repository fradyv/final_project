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
