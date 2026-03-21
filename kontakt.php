<?php
$pageTitle   = 'Kontakt — Maksymilian Czerwiński';
$currentPage = 'kontakt';
include 'includes/head.php';
?>
  <style>
    /* ════════════════════════════════════════
       KONTAKT v4  —  left text / right red form
    ════════════════════════════════════════ */

    .kc-wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: calc(100vh - 72px);
      margin-top: 72px;
    }

    /* ─────────────── LEFT PANEL ─────────────── */
    .kc-left {
      background: var(--navy-deep);
      padding: 80px 72px 80px 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    /* Huge ghost letter in background */
    .kc-ghost {
      position: absolute;
      right: -40px;
      bottom: -30px;
      font-family: 'Playfair Display', serif;
      font-size: 22rem;
      font-weight: 900;
      line-height: 1;
      color: rgba(184,50,40,0.04);
      pointer-events: none;
      user-select: none;
      letter-spacing: -0.05em;
    }

    .kc-eyebrow {
      font-family: 'Lato', sans-serif;
      font-size: 0.58rem;
      letter-spacing: 0.3em;
      text-transform: uppercase;
      color: var(--red-bright);
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 12px;
      opacity: 0;
      animation: fadeUp 0.6s 0.1s cubic-bezier(.4,0,.2,1) forwards;
    }
    .kc-eyebrow::before { content: ''; width: 28px; height: 1px; background: currentColor; }

    .kc-heading {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2.8rem, 3.8vw, 4rem);
      font-weight: 900;
      color: var(--cream);
      line-height: 1.06;
      margin: 0 0 28px;
      opacity: 0;
      animation: fadeUp 0.65s 0.18s cubic-bezier(.4,0,.2,1) forwards;
    }
    .kc-heading em { color: var(--red-bright); font-style: italic; }

    .kc-lead {
      font-family: 'EB Garamond', serif;
      font-size: 1.12rem;
      line-height: 1.9;
      color: var(--cream-muted);
      margin: 0 0 52px;
      max-width: 420px;
      opacity: 0;
      animation: fadeUp 0.65s 0.26s cubic-bezier(.4,0,.2,1) forwards;
    }

    /* Folk divider */
    .kc-folk {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 44px;
      opacity: 0;
      animation: fadeUp 0.6s 0.34s cubic-bezier(.4,0,.2,1) forwards;
    }
    .kc-folk-bar {
      height: 1px;
      flex: 1;
      background: linear-gradient(to right, rgba(184,50,40,0.45), transparent);
    }
    .kc-folk-bar:last-child {
      background: linear-gradient(to left, rgba(184,50,40,0.45), transparent);
    }

    /* Contact detail rows */
    .kc-details {
      display: flex;
      flex-direction: column;
      gap: 20px;
      opacity: 0;
      animation: fadeUp 0.65s 0.42s cubic-bezier(.4,0,.2,1) forwards;
    }
    .kc-detail {
      display: flex;
      align-items: center;
      gap: 16px;
      text-decoration: none;
    }
    .kc-detail-dot {
      width: 8px; height: 8px;
      background: var(--red-bright);
      transform: rotate(45deg);
      flex-shrink: 0;
    }
    .kc-detail-label {
      font-family: 'Lato', sans-serif;
      font-size: 0.65rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--red-bright);
      width: 64px;
      flex-shrink: 0;
    }
    .kc-detail-value {
      font-family: 'EB Garamond', serif;
      font-size: 1.3rem;
      color: var(--cream-dim, #d8c9b0);
      transition: color 0.25s;
    }
    a.kc-detail:hover .kc-detail-value { color: var(--cream); }

    /* ─────────────── RIGHT PANEL (RED FORM) ─────────────── */
    .kc-right {
      position: relative;
      background: var(--red, #b83228);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 72px 80px 80px;
      overflow: hidden;
    }

    /* Diagonal folk diamond pattern on red */
    .kc-right-pattern {
      position: absolute;
      inset: 0;
      pointer-events: none;
      opacity: 0.06;
    }

    /* Vertical accent on left edge of red panel */
    .kc-right::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 3px; height: 100%;
      background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.25), transparent);
    }

    .kc-form-box {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 480px;
    }

    .kc-form-tag {
      font-family: 'Lato', sans-serif;
      font-size: 0.56rem;
      letter-spacing: 0.3em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.55);
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
      opacity: 0;
      animation: fadeLeft 0.6s 0.3s cubic-bezier(.4,0,.2,1) forwards;
    }
    .kc-form-tag::after {
      content: ''; flex: 1;
      height: 1px;
      background: rgba(255,255,255,0.2);
      max-width: 48px;
    }

    .kc-form-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.9rem;
      font-weight: 700;
      color: #fff;
      margin: 0 0 48px;
      line-height: 1.2;
      opacity: 0;
      animation: fadeLeft 0.65s 0.38s cubic-bezier(.4,0,.2,1) forwards;
    }

    /* ── FLOATING LABEL FIELDS ── */
    /* Label sits over input, floats on focus/fill */
    .kc-field {
      position: relative;
      margin-bottom: 40px;
    }

    .kc-field label {
      position: absolute;
      left: 0;
      top: 10px;
      font-family: 'EB Garamond', serif;
      font-size: 1.08rem;
      color: rgba(255,255,255,0.5);
      pointer-events: none;
      transition: top 0.28s cubic-bezier(.4,0,.2,1),
                  font-size 0.28s cubic-bezier(.4,0,.2,1),
                  letter-spacing 0.28s,
                  color 0.28s;
      transform-origin: left top;
    }

    /* Float up when focused OR filled */
    .kc-field input:focus     ~ label,
    .kc-field input:not(:placeholder-shown)    ~ label,
    .kc-field textarea:focus  ~ label,
    .kc-field textarea:not(:placeholder-shown) ~ label {
      top: -16px;
      font-size: 0.54rem;
      letter-spacing: 0.22em;
      font-family: 'Lato', sans-serif;
      text-transform: uppercase;
      color: rgba(255,255,255,0.75);
    }

    .kc-opt {
      font-family: 'EB Garamond', serif;
      font-style: italic;
      font-size: 0.85em;
      letter-spacing: 0;
      text-transform: none;
      opacity: 0.6;
      margin-left: 4px;
    }

    .kc-field input,
    .kc-field textarea {
      width: 100%;
      box-sizing: border-box;
      background: transparent;
      border: none;
      border-bottom: 1px solid rgba(255,255,255,0.28);
      color: #fff;
      font-family: 'EB Garamond', serif;
      font-size: 1.12rem;
      padding: 10px 0 14px;
      outline: none;
      transition: border-color 0.3s;
      resize: none;
    }
    /* placeholder must exist but be invisible for :placeholder-shown trick */
    .kc-field input::placeholder,
    .kc-field textarea::placeholder { color: transparent; }
    .kc-field input:focus,
    .kc-field textarea:focus { border-color: rgba(255,255,255,0.12); }

    /* Animated white underline on focus */
    .kc-field-line {
      position: absolute;
      bottom: 0; left: 0;
      height: 2px;
      width: 0;
      background: rgba(255,255,255,0.85);
      transition: width 0.42s cubic-bezier(.4,0,.2,1);
    }
    .kc-field:focus-within .kc-field-line { width: 100%; }

    /* Staggered field slide-in */
    .kc-field { opacity: 0; animation: fadeLeft 0.55s cubic-bezier(.4,0,.2,1) forwards; }
    .kc-field:nth-child(1) { animation-delay: 0.44s; }
    .kc-field:nth-child(2) { animation-delay: 0.52s; }
    .kc-field:nth-child(3) { animation-delay: 0.60s; }
    .kc-field:nth-child(4) { animation-delay: 0.68s; }

    /* ── SUBMIT ── */
    .kc-submit-row {
      display: flex;
      align-items: center;
      gap: 24px;
      flex-wrap: wrap;
      margin-top: 4px;
      opacity: 0;
      animation: fadeLeft 0.55s 0.76s cubic-bezier(.4,0,.2,1) forwards;
    }

    .kc-submit {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      background: #fff;
      color: var(--red, #b83228);
      border: none;
      font-family: 'Lato', sans-serif;
      font-size: 0.65rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      font-weight: 700;
      padding: 16px 36px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: color 0.4s;
    }

    /* Dark fill sweeps in on hover */
    .kc-submit::before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--navy-deep, #050d1a);
      transform: translateY(101%);
      transition: transform 0.38s cubic-bezier(.4,0,.2,1);
    }
    .kc-submit:hover::before { transform: translateY(0); }
    .kc-submit:hover { color: var(--cream, #f2e8d5); }
    .kc-submit > * { position: relative; z-index: 1; }
    .kc-arrow { transition: transform 0.3s; }
    .kc-submit:hover .kc-arrow { transform: translateX(5px); }
    .kc-submit:disabled { opacity: 0.6; pointer-events: none; }

    .kc-note {
      font-family: 'EB Garamond', serif;
      font-size: 0.88rem;
      color: rgba(255,255,255,0.45);
      font-style: italic;
    }

    /* ── SUCCESS ── */
    .kc-success {
      display: none;
      text-align: center;
      padding: 40px 0;
    }
    .kc-success.active { display: block; }

    .kc-success-icon {
      width: 56px; height: 56px;
      border: 2px solid rgba(255,255,255,0.4);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      animation: popIn 0.5s cubic-bezier(.34,1.56,.64,1) forwards;
    }
    @keyframes popIn {
      from { transform: scale(0.5); opacity: 0; }
      to   { transform: scale(1);   opacity: 1; }
    }
    .kc-success h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      color: #fff;
      margin-bottom: 10px;
    }
    .kc-success p {
      font-family: 'EB Garamond', serif;
      font-size: 1.05rem;
      color: rgba(255,255,255,0.6);
      font-style: italic;
    }

    /* ── MAP ── */
    .kc-map {
      position: relative;
      height: 420px;
    }
    .kc-map::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg,
        transparent, rgba(184,50,40,0.5) 25%,
        rgba(214,64,48,0.9) 50%,
        rgba(184,50,40,0.5) 75%, transparent);
      z-index: 2;
    }
    .kc-map iframe { width: 100%; height: 100%; border: 0; display: block; }

    /* ── KEYFRAMES ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(22px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeLeft {
      from { opacity: 0; transform: translateX(24px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
      .kc-wrap { grid-template-columns: 1fr; margin-top: 64px; min-height: auto; }
      .kc-left { padding: 72px 32px 60px; }
      .kc-right { padding: 60px 32px 72px; }
      .kc-ghost { font-size: 14rem; }
      .kc-map { height: 300px; }
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="kc-wrap">

  <!-- ═══════════════ LEFT ═══════════════ -->
  <div class="kc-left">

    <span class="kc-ghost" aria-hidden="true">K</span>

    <p class="kc-eyebrow">Kontakt</p>

    <h1 class="kc-heading">
      Zacznijmy<br><em>razem grać</em>
    </h1>

    <p class="kc-lead">
      Interesujesz się lekcjami, warsztatem albo chcesz zamówić kapelę na uroczystość?
      Napisz lub zadzwoń — znajdziemy razem coś dla Ciebie.
    </p>

    <div class="kc-folk">
      <span class="kc-folk-bar"></span>
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <polygon points="9,0 18,9 9,18 0,9" fill="#b83228" opacity="0.5"/>
        <polygon points="9,3 15,9 9,15 3,9" fill="#050d1a"/>
        <circle cx="9" cy="9" r="2.5" fill="#d64030"/>
      </svg>
      <span class="kc-folk-bar"></span>
    </div>

    <div class="kc-details">
      <a href="tel:+48516875013" class="kc-detail">
        <span class="kc-detail-dot"></span>
        <span class="kc-detail-label">Telefon</span>
        <span class="kc-detail-value">516 875 013</span>
      </a>
      <a href="mailto:kontakt@heligonka.pl" class="kc-detail">
        <span class="kc-detail-dot"></span>
        <span class="kc-detail-label">E-mail</span>
        <span class="kc-detail-value">kontakt@heligonka.pl</span>
      </a>
      <div class="kc-detail">
        <span class="kc-detail-dot"></span>
        <span class="kc-detail-label">Adres</span>
        <span class="kc-detail-value">Beskidzka 48, Szczyrk</span>
      </div>
    </div>

  </div>

  <!-- ═══════════════ RIGHT (RED FORM) ═══════════════ -->
  <div class="kc-right">

    <!-- Folk diamond pattern on red background -->
    <svg class="kc-right-pattern" viewBox="0 0 400 600" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <pattern id="kcPat" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
          <polygon points="30,2 58,30 30,58 2,30" fill="none" stroke="#fff" stroke-width="0.8"/>
          <circle cx="30" cy="30" r="3" fill="#fff"/>
          <circle cx="0"  cy="0"  r="1.5" fill="#fff"/>
          <circle cx="60" cy="0"  r="1.5" fill="#fff"/>
          <circle cx="0"  cy="60" r="1.5" fill="#fff"/>
          <circle cx="60" cy="60" r="1.5" fill="#fff"/>
        </pattern>
      </defs>
      <rect width="400" height="600" fill="url(#kcPat)"/>
    </svg>

    <div class="kc-form-box">

      <p class="kc-form-tag">Formularz</p>
      <h2 class="kc-form-title">Napisz do mnie</h2>

      <form id="contactForm">

        <div class="kc-field">
          <input type="text" id="fname" name="name" placeholder=" " autocomplete="name" required>
          <label for="fname">Imię i nazwisko</label>
          <span class="kc-field-line"></span>
        </div>

        <div class="kc-field">
          <input type="tel" id="fphone" name="phone" placeholder=" " autocomplete="tel">
          <label for="fphone">Telefon <span class="kc-opt">(opcjonalnie)</span></label>
          <span class="kc-field-line"></span>
        </div>

        <div class="kc-field">
          <input type="email" id="femail" name="email" placeholder=" " autocomplete="email" required>
          <label for="femail">Adres e-mail</label>
          <span class="kc-field-line"></span>
        </div>

        <div class="kc-field">
          <textarea id="fmessage" name="message" rows="4" placeholder=" " required></textarea>
          <label for="fmessage">Wiadomość</label>
          <span class="kc-field-line"></span>
        </div>

        <div class="kc-submit-row">
          <button type="submit" class="kc-submit">
            <span>Wyślij</span>
            <svg class="kc-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M1 7h12M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
          <p class="kc-note">Odpowiem w&nbsp;ciągu 24&nbsp;h.</p>
        </div>

      </form>

      <div class="kc-success" id="kcSuccess">
        <div class="kc-success-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <polyline points="4,12 9.5,17.5 20,7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <h3>Wysłane!</h3>
        <p>Odezwę się wkrótce — dziękuję.</p>
      </div>

    </div>
  </div>

</section>

<!-- ═══════════════ MAP ═══════════════ -->
<div class="kc-map">
  <iframe
    title="Mapa — Beskidzka 48, Szczyrk"
    src="https://www.openstreetmap.org/export/embed.html?bbox=19.0246%2C49.7120%2C19.0347%2C49.7220&amp;layer=mapnik&amp;marker=49.7170%2C19.0297"
    loading="lazy"
  ></iframe>
</div>

<?php include 'includes/footer.php'; ?>

  <script>
    document.getElementById('contactForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const btn     = this.querySelector('.kc-submit');
      const btnText = btn.querySelector('span');
      const origText = btnText.textContent;

      // Loading state
      btn.disabled      = true;
      btnText.textContent = 'Wysyłanie…';

      const data = new FormData(this);

      try {
        const res  = await fetch('mail-handler.php', { method: 'POST', body: data });
        const json = await res.json();

        if (json.ok) {
          // Success — fade out form, show confirmation
          this.style.transition = 'opacity 0.35s, transform 0.35s';
          this.style.opacity    = '0';
          this.style.transform  = 'translateY(-12px)';
          setTimeout(() => {
            this.style.display = 'none';
            document.getElementById('kcSuccess').classList.add('active');
          }, 370);
        } else {
          showError(json.error || 'Coś poszło nie tak.');
          btn.disabled      = false;
          btnText.textContent = origText;
        }
      } catch (err) {
        showError('Brak połączenia z serwerem. Spróbuj ponownie.');
        btn.disabled      = false;
        btnText.textContent = origText;
      }

      function showError(msg) {
        let el = document.getElementById('kcError');
        if (!el) {
          el = document.createElement('p');
          el.id = 'kcError';
          el.style.cssText = 'margin-top:16px;font-family:"EB Garamond",serif;font-style:italic;color:rgba(255,255,255,0.75);font-size:0.95rem;';
          document.getElementById('contactForm').appendChild(el);
        }
        el.textContent = msg;
      }
    });
  </script>
</body>
</html>
