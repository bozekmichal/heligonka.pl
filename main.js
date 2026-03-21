// Hamburger menu
(function() {
  const hamburger = document.getElementById('navHamburger');
  const mobileMenu = document.getElementById('mobileMenu');
  if (!hamburger || !mobileMenu) return;

  // Clone links from desktop nav into mobile menu
  const navLinks = document.querySelector('.nav-links');
  const mobileLinks = mobileMenu.querySelector('.mobile-menu-links');
  navLinks.querySelectorAll('a').forEach(a => mobileLinks.appendChild(a.cloneNode(true)));

  function openMenu() {
    hamburger.classList.add('open');
    mobileMenu.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    hamburger.classList.remove('open');
    mobileMenu.classList.remove('open');
    document.body.style.overflow = '';
  }

  hamburger.addEventListener('click', () => {
    hamburger.classList.contains('open') ? closeMenu() : openMenu();
  });

  mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));

  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
})();

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
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2069.2 4952" fill="currentColor"><path d="M213.9,2812.4c0,1.2,0,2.4.1,3.6.7.5,1.3,1,2,1.5l-2.1-5.1ZM474.2,3453.4c0,.7-.2,1.4-.3,2.2.7.8,1.4,1.5,2.1,2.3l-1.8-4.5Z"/><path d="M1352.5,2370.2c-6.6,0-13.1,0-19.7.3l-22.4-472.5s453.4-166.9,593.5-874.2c92.1-465-50.2-886.5-232.2-922.2-182.1-35.6-420.5,303.7-511.6,769-50.2,256.4-45.1,497.6,0,668.4-540.1,347.7-756.9,662-763.7,672-.1.2-.2.2-.2.2-114.9,161.1-182.7,359.6-182.7,574.4s.1,17.9.4,26.8l2.1,5.1c-.6-.5-1.3-1-2-1.5,7.4,247.5,104.8,471.8,259.9,639.5,0-.7.2-1.4.3-2.2l1.8,4.5h0c173.1,186.1,417.4,302,688,302s52.3-1.1,78-3.2c43.1-3.6,80.8,29.1,83.9,72.2,9.6,131.3,25.8,365.3,37.4,589.6,8.9,171.3-118,317.8-288.9,333.5-1.6.1-3.2.3-4.8.4-.7,0-1.3.1-2,.2-.8,0-1.6.1-2.4.2,86.5-69.2,133.4-182.5,112.3-298.9-27.2-150.1-158.6-255.7-306.1-255.7s-37,1.6-55.7,5c-168.9,30.6-281.3,192.9-250.6,361.8,8.1,44.6,25.4,86,50.5,122.1l-.9.8-1,.9s122.1,189.6,469.2,155.7c106.3-10.4,203.4-59.6,273.4-140.3,69.9-80.7,105.4-183.9,99.8-290.6-12.8-245.9-31-503.2-40-625.4-2.6-35.5,19.1-68,52.7-79.7,27.4-9.5,54.1-20.2,80.3-32.1,104.3-47.4,198.7-113.5,279.2-194.1,98.5-118,158.3-272.9,158.3-442.6,0-369.8-284-669.6-634.3-669.6ZM1349.2,819.4c98.9-207.2,254.2-341.7,358.9-295,104.7,46.7,113.3,254.4,20.2,464.2-150.2,338.1-457.4,454.8-457.4,454.8,0,0-20.9-416.2,78.3-624ZM1269.4,3670.5c-434.7-24.8-682.8-198.1-793.8-411.5h0c-1.2-2.4-2.4-4.7-3.6-7h0c-31.6-62.7-51.5-128.7-60.9-195.3h0c-.4-3-.8-5.9-1.2-8.9h0c-19-147.9,13.2-298.3,83.1-421.6,218-384.9,699.9-642.7,699.9-642.7l21.6,376.9c1.1,19.6-10.2,37.9-28.3,45.5-131.4,55.2-633.4,306.6-360,832.7,0,0-38.4-467.2,390.3-534.1,18.1-2.8,34.7,10.5,36,28.7l61.7,892.2c1.8,25.4-19.2,46.6-44.6,45.1ZM1455.6,3639.4c-23,7.8-47.1-8.5-48.4-32.7l-49.1-866.4c-1.2-20.3,17.1-36.2,37.1-32.3,107.1,21.4,396.8,112.4,396.5,471.7-.2,311.7-234.7,425.2-336.1,459.7Z"/></svg>',
  ];

  const container = document.getElementById('videoBubbles');
  const link = document.getElementById('videoThumbLink');
  if (!container || !link) return;

  let spawned = false;

  function spawnBubbles() {
    if (spawned) return;
    spawned = true;
    const COUNT = 10;
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

// Animated counters
(function() {
  const counters = document.querySelectorAll('.stat-num[data-count]');
  if (!counters.length) return;

  function animateCounter(el) {
    const target = parseInt(el.dataset.count, 10);
    const duration = 1600;
    const start = performance.now();
    function tick(now) {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const ease = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(ease * target) + '+';
      if (progress < 1) requestAnimationFrame(tick);
      else el.textContent = target + '+';
    }
    requestAnimationFrame(tick);
  }

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        animateCounter(e.target);
        counterObserver.unobserve(e.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(el => counterObserver.observe(el));
})();

// Music bubbles
(function() {
  const symbols = [
    // ósemka
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M512 55L512 217C509.1 217.7 466.4 228.4 384 249L384 464C384 517 333.9 560 272 560C210.1 560 160 517 160 464C160 411 210.1 368 272 368C289.2 368 305.5 371.3 320 377.2L320 103L344.2 97C444.3 71.9 500.2 58 512 55z"/></svg>',
    // dwie ósemki połączone
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M544 56.1L544 400C544 444.2 501 480 448 480C395 480 352 444.2 352 400C352 355.8 395 320 448 320C459.2 320 470 321.6 480 324.6L480 207.9L256 257.7L256 464C256 508.2 213 544 160 544C107 544 64 508.2 64 464C64 419.8 107 384 160 384C171.2 384 182 385.6 192 388.6L192 134.4L217.1 128.8L505.1 64.8L544 56.1z"/></svg>',
    // klucz (heligonka)
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2069.2 4952" fill="currentColor"><path d="M213.9,2812.4c0,1.2,0,2.4.1,3.6.7.5,1.3,1,2,1.5l-2.1-5.1ZM474.2,3453.4c0,.7-.2,1.4-.3,2.2.7.8,1.4,1.5,2.1,2.3l-1.8-4.5Z"/><path d="M1352.5,2370.2c-6.6,0-13.1,0-19.7.3l-22.4-472.5s453.4-166.9,593.5-874.2c92.1-465-50.2-886.5-232.2-922.2-182.1-35.6-420.5,303.7-511.6,769-50.2,256.4-45.1,497.6,0,668.4-540.1,347.7-756.9,662-763.7,672-.1.2-.2.2-.2.2-114.9,161.1-182.7,359.6-182.7,574.4s.1,17.9.4,26.8l2.1,5.1c-.6-.5-1.3-1-2-1.5,7.4,247.5,104.8,471.8,259.9,639.5,0-.7.2-1.4.3-2.2l1.8,4.5h0c173.1,186.1,417.4,302,688,302s52.3-1.1,78-3.2c43.1-3.6,80.8,29.1,83.9,72.2,9.6,131.3,25.8,365.3,37.4,589.6,8.9,171.3-118,317.8-288.9,333.5-1.6.1-3.2.3-4.8.4-.7,0-1.3.1-2,.2-.8,0-1.6.1-2.4.2,86.5-69.2,133.4-182.5,112.3-298.9-27.2-150.1-158.6-255.7-306.1-255.7s-37,1.6-55.7,5c-168.9,30.6-281.3,192.9-250.6,361.8,8.1,44.6,25.4,86,50.5,122.1l-.9.8-1,.9s122.1,189.6,469.2,155.7c106.3-10.4,203.4-59.6,273.4-140.3,69.9-80.7,105.4-183.9,99.8-290.6-12.8-245.9-31-503.2-40-625.4-2.6-35.5,19.1-68,52.7-79.7,27.4-9.5,54.1-20.2,80.3-32.1,104.3-47.4,198.7-113.5,279.2-194.1,98.5-118,158.3-272.9,158.3-442.6,0-369.8-284-669.6-634.3-669.6ZM1349.2,819.4c98.9-207.2,254.2-341.7,358.9-295,104.7,46.7,113.3,254.4,20.2,464.2-150.2,338.1-457.4,454.8-457.4,454.8,0,0-20.9-416.2,78.3-624ZM1269.4,3670.5c-434.7-24.8-682.8-198.1-793.8-411.5h0c-1.2-2.4-2.4-4.7-3.6-7h0c-31.6-62.7-51.5-128.7-60.9-195.3h0c-.4-3-.8-5.9-1.2-8.9h0c-19-147.9,13.2-298.3,83.1-421.6,218-384.9,699.9-642.7,699.9-642.7l21.6,376.9c1.1,19.6-10.2,37.9-28.3,45.5-131.4,55.2-633.4,306.6-360,832.7,0,0-38.4-467.2,390.3-534.1,18.1-2.8,34.7,10.5,36,28.7l61.7,892.2c1.8,25.4-19.2,46.6-44.6,45.1ZM1455.6,3639.4c-23,7.8-47.1-8.5-48.4-32.7l-49.1-866.4c-1.2-20.3,17.1-36.2,37.1-32.3,107.1,21.4,396.8,112.4,396.5,471.7-.2,311.7-234.7,425.2-336.1,459.7Z"/></svg>',
  ];

  const container = document.getElementById('musicBubbles');
  const COUNT = 13;

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

// Contact bubbles
(function() {
  const symbols = [
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M512 55L512 217C509.1 217.7 466.4 228.4 384 249L384 464C384 517 333.9 560 272 560C210.1 560 160 517 160 464C160 411 210.1 368 272 368C289.2 368 305.5 371.3 320 377.2L320 103L344.2 97C444.3 71.9 500.2 58 512 55z"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><path d="M544 56.1L544 400C544 444.2 501 480 448 480C395 480 352 444.2 352 400C352 355.8 395 320 448 320C459.2 320 470 321.6 480 324.6L480 207.9L256 257.7L256 464C256 508.2 213 544 160 544C107 544 64 508.2 64 464C64 419.8 107 384 160 384C171.2 384 182 385.6 192 388.6L192 134.4L217.1 128.8L505.1 64.8L544 56.1z"/></svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2069.2 4952" fill="currentColor"><path d="M213.9,2812.4c0,1.2,0,2.4.1,3.6.7.5,1.3,1,2,1.5l-2.1-5.1ZM474.2,3453.4c0,.7-.2,1.4-.3,2.2.7.8,1.4,1.5,2.1,2.3l-1.8-4.5Z"/><path d="M1352.5,2370.2c-6.6,0-13.1,0-19.7.3l-22.4-472.5s453.4-166.9,593.5-874.2c92.1-465-50.2-886.5-232.2-922.2-182.1-35.6-420.5,303.7-511.6,769-50.2,256.4-45.1,497.6,0,668.4-540.1,347.7-756.9,662-763.7,672-.1.2-.2.2-.2.2-114.9,161.1-182.7,359.6-182.7,574.4s.1,17.9.4,26.8l2.1,5.1c-.6-.5-1.3-1-2-1.5,7.4,247.5,104.8,471.8,259.9,639.5,0-.7.2-1.4.3-2.2l1.8,4.5h0c173.1,186.1,417.4,302,688,302s52.3-1.1,78-3.2c43.1-3.6,80.8,29.1,83.9,72.2,9.6,131.3,25.8,365.3,37.4,589.6,8.9,171.3-118,317.8-288.9,333.5-1.6.1-3.2.3-4.8.4-.7,0-1.3.1-2,.2-.8,0-1.6.1-2.4.2,86.5-69.2,133.4-182.5,112.3-298.9-27.2-150.1-158.6-255.7-306.1-255.7s-37,1.6-55.7,5c-168.9,30.6-281.3,192.9-250.6,361.8,8.1,44.6,25.4,86,50.5,122.1l-.9.8-1,.9s122.1,189.6,469.2,155.7c106.3-10.4,203.4-59.6,273.4-140.3,69.9-80.7,105.4-183.9,99.8-290.6-12.8-245.9-31-503.2-40-625.4-2.6-35.5,19.1-68,52.7-79.7,27.4-9.5,54.1-20.2,80.3-32.1,104.3-47.4,198.7-113.5,279.2-194.1,98.5-118,158.3-272.9,158.3-442.6,0-369.8-284-669.6-634.3-669.6ZM1349.2,819.4c98.9-207.2,254.2-341.7,358.9-295,104.7,46.7,113.3,254.4,20.2,464.2-150.2,338.1-457.4,454.8-457.4,454.8,0,0-20.9-416.2,78.3-624ZM1269.4,3670.5c-434.7-24.8-682.8-198.1-793.8-411.5h0c-1.2-2.4-2.4-4.7-3.6-7h0c-31.6-62.7-51.5-128.7-60.9-195.3h0c-.4-3-.8-5.9-1.2-8.9h0c-19-147.9,13.2-298.3,83.1-421.6,218-384.9,699.9-642.7,699.9-642.7l21.6,376.9c1.1,19.6-10.2,37.9-28.3,45.5-131.4,55.2-633.4,306.6-360,832.7,0,0-38.4-467.2,390.3-534.1,18.1-2.8,34.7,10.5,36,28.7l61.7,892.2c1.8,25.4-19.2,46.6-44.6,45.1ZM1455.6,3639.4c-23,7.8-47.1-8.5-48.4-32.7l-49.1-866.4c-1.2-20.3,17.1-36.2,37.1-32.3,107.1,21.4,396.8,112.4,396.5,471.7-.2,311.7-234.7,425.2-336.1,459.7Z"/></svg>',
  ];

  const container = document.getElementById('contactBubbles');
  if (!container) return;

  for (let i = 0; i < 7; i++) {
    const el = document.createElement('div');
    el.className = 'music-bubble';
    const size    = 22 + Math.random() * 58;
    const left    = 2  + Math.random() * 96;
    const dur     = 12 + Math.random() * 18;
    const delay   = -(Math.random() * dur);
    const opacity = 0.07 + Math.random() * 0.13;
    const spinDur = 6 + Math.random() * 10;
    const spinDir = Math.random() > 0.5 ? 1 : -1;
    el.style.cssText = `left:${left}%;width:${size}px;height:${size}px;animation-duration:${dur}s;animation-delay:${delay}s;--bbl-opacity:${opacity.toFixed(2)};`;
    const inner = document.createElement('span');
    inner.className = 'music-bubble-inner';
    inner.style.cssText = `--spin-dur:${spinDur}s;animation-direction:${spinDir === 1 ? 'normal' : 'reverse'};animation-delay:${delay}s;`;
    inner.innerHTML = symbols[Math.floor(Math.random() * symbols.length)];
    el.appendChild(inner);
    container.appendChild(el);
  }
})();
