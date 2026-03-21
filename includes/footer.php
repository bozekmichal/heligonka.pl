<?php
/**
 * Stopka serwisu.
 *
 * Zmienne dostępne przez stronę nadrzędną:
 *   $hideFooterFolkStrip (bool) — ustaw true, jeśli strona sama kończy
 *                                 się paskiem folkowym (np. index.php)
 */
?>

  <?php if (empty($hideFooterFolkStrip)): ?>
  <div class="footer-folk-strip">
    <svg class="folk-strip" viewBox="0 0 1200 28" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <pattern id="folkFooter" x="0" y="0" width="48" height="28" patternUnits="userSpaceOnUse">
          <line x1="0" y1="14" x2="48" y2="14" stroke="#b83228" stroke-width="0.6" stroke-opacity="0.3"/>
          <polygon points="24,5 31,14 24,23 17,14" fill="#b83228" opacity="0.4"/>
          <circle cx="4"  cy="14" r="1.5" fill="#b83228" opacity="0.3"/>
          <circle cx="44" cy="14" r="1.5" fill="#b83228" opacity="0.3"/>
        </pattern>
      </defs>
      <rect width="1200" height="28" fill="url(#folkFooter)"/>
    </svg>
  </div>
  <?php endif; ?>

  <footer>
    <div class="footer-social">
      <a href="https://www.youtube.com/@heligonkapl/featured" target="_blank" rel="noopener noreferrer" class="footer-social-link">
        <img src="brand_assets/icons/YouTube.svg" width="26" height="18" alt="YouTube">
        YouTube
      </a>
      <a href="https://www.facebook.com/profile.php?id=100090272505042" target="_blank" rel="noopener noreferrer" class="footer-social-link">
        <img src="brand_assets/icons/Facebook.svg" width="20" height="20" alt="Facebook">
        Facebook
      </a>
    </div>
    <span class="footer-copy">© 2024 Maksymilian Czerwiński — Muzyk & Instruktor</span>
    <div class="footer-right">
      <div class="footer-gems">
        <span class="footer-gem"></span>
        <span class="footer-gem"></span>
        <span class="footer-gem"></span>
      </div>
      <span class="footer-made">Strone zrobił <a href="https://flashboard.pl" target="_blank" rel="noopener noreferrer">Bożek</a></span>
    </div>
  </footer>

  <script src="main.js"></script>
