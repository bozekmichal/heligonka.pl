<?php
$pageTitle   = 'Dejcie Spokój — Kapela Folkowa';
$currentPage = 'dejcie-spokoj';
include 'includes/head.php';
?>
  <style>
    /* ── PAGE LAYOUT ── */
    .ds-wrap {
      min-height: 100vh;
      background: var(--navy-deep);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      padding: 130px 40px 80px;
      text-align: center;
    }
    .music-bubbles { position: absolute; inset: 0; pointer-events: none; z-index: 0; }

    .ds-inner {
      position: relative;
      z-index: 2;
      max-width: 720px;
      width: 100%;
    }

    /* ── TITLE ── */
    .ds-title {
      font-family: 'Playfair Display', serif;
      font-size: 5.2rem;
      font-weight: 900;
      color: var(--cream);
      line-height: 0.95;
      margin: 16px 0 0;
    }
    .ds-title em {
      color: var(--red-bright);
      font-style: italic;
      display: block;
    }

    .ds-lead {
      font-family: 'EB Garamond', serif;
      font-size: 1.2rem;
      line-height: 1.85;
      color: var(--cream-muted);
      margin: 28px 0 0;
    }

    /* ── OCCASIONS ── */
    .ds-occasions {
      display: flex;
      justify-content: center;
      gap: 12px;
      flex-wrap: wrap;
      margin: 32px 0 40px;
    }
    .ds-tag {
      font-family: 'Lato', sans-serif;
      font-size: 0.62rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--cream-muted);
      border: 1px solid rgba(184,50,40,0.4);
      padding: 7px 16px;
      transition: border-color 0.3s, color 0.3s;
    }
    .ds-tag:hover {
      border-color: var(--red-bright);
      color: var(--cream);
    }

    /* ── CTA ── */
    .ds-cta {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 56px;
    }

    /* ── YOUTUBE BLOCK ── */
    .ds-yt {
      border-top: 1px solid rgba(184,50,40,0.2);
      padding-top: 44px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }
    .ds-yt-label {
      font-family: 'Lato', sans-serif;
      font-size: 0.62rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--cream-muted);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .ds-yt-label::before,
    .ds-yt-label::after {
      content: '';
      width: 40px;
      height: 1px;
      background: rgba(184,50,40,0.35);
    }
    .ds-yt-link {
      display: flex;
      align-items: center;
      gap: 14px;
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 600;
      color: var(--cream);
      text-decoration: none;
      padding: 18px 32px;
      border: 1px solid rgba(184,50,40,0.3);
      background: rgba(184,50,40,0.06);
      transition: background 0.3s, border-color 0.3s, color 0.3s;
    }
    .ds-yt-link:hover {
      background: rgba(184,50,40,0.14);
      border-color: var(--red-bright);
      color: var(--cream);
    }
    .ds-yt-icon {
      width: 36px; height: 36px;
      background: var(--red-bright);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      transition: background 0.3s;
    }
    .ds-yt-link:hover .ds-yt-icon { background: #e84830; }

    /* ── TOAST NOTIFICATION ── */
    .ds-wip {
      position: fixed;
      top: 80px;
      left: 50%;
      transform: translateX(-50%) translateY(0);
      z-index: 500;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-family: 'Lato', sans-serif;
      font-size: 0.62rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: #d4a843;
      border: 1px solid rgba(212,168,67,0.5);
      background: rgba(10,18,32,0.88);
      backdrop-filter: blur(12px);
      padding: 10px 22px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.4), 0 0 0 1px rgba(212,168,67,0.15);
      transition: opacity 0.6s ease, transform 0.6s ease;
      white-space: nowrap;
    }
    .ds-wip.hide {
      opacity: 0;
      transform: translateX(-50%) translateY(-16px);
      pointer-events: none;
    }
    .ds-wip-dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: #d4a843;
      flex-shrink: 0;
      animation: blink 1.4s ease-in-out infinite;
    }
    @keyframes blink {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.2; }
    }

    /* ── PHONE ── */
    .ds-phone {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      font-family: 'Playfair Display', serif;
      font-size: 2.4rem;
      font-weight: 700;
      color: var(--cream);
      text-decoration: none;
      letter-spacing: 0.04em;
      border-bottom: 2px solid rgba(184,50,40,0.35);
      padding-bottom: 4px;
      transition: color 0.3s, border-color 0.3s;
    }
    .ds-phone:hover {
      color: var(--red-bright);
      border-color: var(--red-bright);
    }
    .ds-phone svg { flex-shrink: 0; }

    @media (max-width: 640px) {
      .ds-title { font-size: 3.4rem; }
      .ds-wrap { padding: 120px 24px 60px; }
    }
  </style>
</head>
<body>

  <div class="ds-wip" id="wipToast"><span class="ds-wip-dot"></span>Strona w przygotowaniu</div>

<?php include 'includes/header.php'; ?>

  <section class="ds-wrap">
    <div class="music-bubbles" id="musicBubbles"></div>

    <div class="ds-inner">

      <p class="eyebrow">Kapela Folkowa</p>

      <h1 class="ds-title">
        Dejcie<br><em>Spokój</em>
      </h1>

      <div class="folk-inline-divider" style="justify-content:center; margin:28px 0 0;">
        <span class="bar"></span>
        <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
          <rect x="4" y="4" width="18" height="18" stroke="#b83228" stroke-width="1.2"/>
          <rect x="4" y="4" width="18" height="18" stroke="#b83228" stroke-width="1.2" transform="rotate(45 13 13)"/>
          <circle cx="13" cy="13" r="3" fill="#d64030"/>
        </svg>
        <span class="bar"></span>
      </div>

      <p class="ds-lead">
        Gramy muzykę beskidzką z pasją i przymrużeniem oka.<br>
        Zapraszamy na wesela, urodziny, festyny i wszelkie uroczystości, gdzie dobra muzyka jest obowiązkowa.
      </p>

      <div class="ds-occasions">
        <span class="ds-tag">Wesela</span>
        <span class="ds-tag">Urodziny</span>
        <span class="ds-tag">Festyny</span>
        <span class="ds-tag">Festiwale</span>
        <span class="ds-tag">Imprezy plenerowe</span>
        <span class="ds-tag">Uroczystości prywatne</span>
      </div>

      <div class="ds-cta">
        <a href="kontakt.php" class="btn-red">Zamów kapelę</a>
      </div>

      <div class="ds-yt">
        <div class="ds-yt-label">Posłuchaj nas</div>
        <a href="https://www.youtube.com/@dejciespokoj7958" target="_blank" rel="noopener noreferrer" class="ds-yt-link">
          <div class="ds-yt-icon" style="background:none; border-radius:0; width:44px; height:31px;">
            <img src="brand_assets/icons/YouTube.svg" alt="YouTube" style="width:100%;height:100%;object-fit:contain;">
          </div>
          YouTube — @dejciespokoj7958
        </a>
      </div>

    </div>
  </section>

<?php include 'includes/footer.php'; ?>

  <script>
    (function() {
      const toast = document.getElementById('wipToast');
      setTimeout(() => toast.classList.add('hide'), 7000);
    })();
  </script>
</body>
</html>
