// Nav scroll state
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
}, { passive: true });

// Intersection Observer — fade-up
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      observer.unobserve(e.target);
    }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

// Subtle hero parallax on photo
const photoWrap = document.getElementById('photoWrap');
if (photoWrap && window.matchMedia('(min-width: 860px)').matches) {
  window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    const parallaxVal = scrolled * 0.12;
    photoWrap.style.transform = `translateY(${parallaxVal}px)`;
  }, { passive: true });
}

// Shimmer on folk ornaments
const shimmerEls = document.querySelectorAll('.shimmer-ornament');
shimmerEls.forEach(el => {
  el.style.animation = 'shimmer 4s ease-in-out infinite';
});

// Video thumbnail bubbles
(function() {
  const symbols = [
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M512 55L512 217C509.1 217.7 466.4 228.4 384 249L384 464C384 517 333.9 560 272 560C210.1 560 160 517 160 464C160 411 210.1 368 272 368C289.2 368 305.5 371.3 320 377.2L320 103L344.2 97C444.3 71.9 500.2 58 512 55z"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M544 56.1L544 400C544 444.2 501 480 448 480C395 480 352 444.2 352 400C352 355.8 395 320 448 320C459.2 320 470 321.6 480 324.6L480 207.9L256 257.7L256 464C256 508.2 213 544 160 544C107 544 64 508.2 64 464C64 419.8 107 384 160 384C171.2 384 182 385.6 192 388.6L192 134.4L217.1 128.8L505.1 64.8L544 56.1z"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z"/></svg>',
  ];

  const container = document.getElementById('videoBubbles');
  const link = document.getElementById('videoThumbLink');
  if (!container || !link) return;

  let spawned = false;

  function spawnBubbles() {
    if (spawned) return;
    spawned = true;
    const COUNT = 14;
    for (let i = 0; i < COUNT; i++) {
      const el = document.createElement('div');
      el.className = 'video-bubble';
      const size    = 16 + Math.random() * 36;
      const left    = 4  + Math.random() * 92;
      const dur     = 5  + Math.random() * 8;
      const delay   = -(Math.random() * dur);
      const opacity = 0.1 + Math.random() * 0.2;
      const spinDur = 4 + Math.random() * 8;
      const spinDir = Math.random() > 0.5 ? 'normal' : 'reverse';
      el.style.cssText = `left:${left}%;width:${size}px;height:${size}px;animation-duration:${dur}s;animation-delay:${delay}s;--bbl-opacity:${opacity.toFixed(2)};`;
      const inner = document.createElement('span');
      inner.className = 'video-bubble-inner';
      inner.style.cssText = `--spin-dur:${spinDur}s;animation-direction:${spinDir};animation-delay:${delay}s;`;
      inner.innerHTML = symbols[Math.floor(Math.random() * symbols.length)];
      el.appendChild(inner);
      container.appendChild(el);
    }
  }

  link.addEventListener('mouseenter', spawnBubbles);
})();

// Music bubbles
(function() {
  const symbols = [
    // ósemka
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M512 55L512 217C509.1 217.7 466.4 228.4 384 249L384 464C384 517 333.9 560 272 560C210.1 560 160 517 160 464C160 411 210.1 368 272 368C289.2 368 305.5 371.3 320 377.2L320 103L344.2 97C444.3 71.9 500.2 58 512 55z"/></svg>',
    // dwie ósemki połączone
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M544 56.1L544 400C544 444.2 501 480 448 480C395 480 352 444.2 352 400C352 355.8 395 320 448 320C459.2 320 470 321.6 480 324.6L480 207.9L256 257.7L256 464C256 508.2 213 544 160 544C107 544 64 508.2 64 464C64 419.8 107 384 160 384C171.2 384 182 385.6 192 388.6L192 134.4L217.1 128.8L505.1 64.8L544 56.1z"/></svg>',
    // serce
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z"/></svg>',
  ];

  const container = document.getElementById('musicBubbles');
  const COUNT = 18;

  for (let i = 0; i < COUNT; i++) {
    const el = document.createElement('div');
    el.className = 'music-bubble';

    const size    = 22 + Math.random() * 58;          // 22–80px
    const left    = 2  + Math.random() * 96;          // 2–98%
    const dur     = 12 + Math.random() * 18;          // 12–30s
    const delay   = -(Math.random() * dur);            // pre-offset
    const opacity = 0.07 + Math.random() * 0.13;      // 0.07–0.20

    const spinDur  = 6 + Math.random() * 10;
    const spinDir  = Math.random() > 0.5 ? 1 : -1;

    el.style.cssText = `
      left:${left}%;
      width:${size}px; height:${size}px;
      animation-duration:${dur}s;
      animation-delay:${delay}s;
      --bbl-opacity:${opacity.toFixed(2)};
    `;

    const inner = document.createElement('span');
    inner.className = 'music-bubble-inner';
    inner.style.cssText = `
      --spin-dur:${spinDur}s;
      animation-direction:${spinDir === 1 ? 'normal' : 'reverse'};
      animation-delay:${delay}s;
    `;
    inner.innerHTML = symbols[Math.floor(Math.random() * symbols.length)];
    el.appendChild(inner);
    container.appendChild(el);
  }
})();
