<?php
/**
 * Nawigacja + mobilne menu.
 *
 * Zmienne dostępne przez stronę nadrzędną:
 *   $currentPage (string) — ID aktywnej strony:
 *                           'home' | 'dejcie-spokoj' | 'aktywnosci' | 'kontakt'
 */
$currentPage = $currentPage ?? '';

$nav = [
  ['href' => 'index.php',         'label' => 'Hej!',            'id' => 'home'],
  ['href' => 'dejcie-spokoj.php', 'label' => 'Dejcie Spokój',   'id' => 'dejcie-spokoj'],
  ['href' => 'aktywnosci.php',    'label' => 'Moje aktywności', 'id' => 'aktywnosci'],
  ['href' => 'kontakt.php',       'label' => 'Kontakt',         'id' => 'kontakt'],
];

// Na stronie głównej logo przewija do sekcji hero; na podstronach wraca do index
$brandHref = ($currentPage === 'home') ? '#hero' : 'index.php';
?>

  <nav id="navbar">
    <a href="<?= $brandHref ?>" class="nav-brand">M. <span>Czerwiński</span></a>
    <ul class="nav-links">
      <?php foreach ($nav as $item): ?>
      <li><a href="<?= $item['href'] ?>"<?= $currentPage === $item['id'] ? ' class="nav-active"' : '' ?>><?= $item['label'] ?></a></li>
      <?php endforeach; ?>
    </ul>
    <a href="tel:+48516875013" class="nav-phone">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 2h2.5l1 2.5-1.5 1.5c.9 1.8 2 2.9 3.8 3.8L9.5 8.5 12 9.5v2.5C7 13 0 6 2 2z" fill="#d64030"/>
      </svg>
      516 875 013
    </a>
    <button class="nav-hamburger" id="navHamburger" aria-label="Otwórz menu">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-links"></div>
    <a href="tel:+48516875013" class="mobile-menu-phone">
      <svg width="16" height="16" viewBox="0 0 13 13" fill="none">
        <path d="M2 2h2.5l1 2.5-1.5 1.5c.9 1.8 2 2.9 3.8 3.8L9.5 8.5 12 9.5v2.5C7 13 0 6 2 2z" fill="#d64030"/>
      </svg>
      516 875 013
    </a>
  </div>
