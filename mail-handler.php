<?php
/**
 * AJAX endpoint — obsługa formularza kontaktowego przez Mailgun
 * Zwraca JSON: { "ok": true } lub { "ok": false, "error": "..." }
 */

header('Content-Type: application/json; charset=utf-8');

// Tylko POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Niedozwolona metoda.']);
    exit;
}

require_once __DIR__ . '/includes/config.php';

// ── Sanitize ──
$name    = trim(strip_tags($_POST['name']    ?? ''));
$phone   = trim(strip_tags($_POST['phone']   ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

// ── Walidacja ──
if (!$name || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Uzupełnij wymagane pola.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Nieprawidłowy adres e-mail.']);
    exit;
}

// ── Treść maila ──
$subject  = "Wiadomość od {$name} — heligonka.pl";

$textBody  = "Imię i nazwisko: {$name}\n";
if ($phone) $textBody .= "Telefon: {$phone}\n";
$textBody .= "E-mail: {$email}\n\n";
$textBody .= "Wiadomość:\n{$message}";

$phoneLine = $phone
    ? "<tr>
         <td style='padding:8px 0;color:#999;font-size:0.78rem;text-transform:uppercase;letter-spacing:.1em;width:140px;vertical-align:top;'>Telefon</td>
         <td style='padding:8px 0;font-size:1rem;color:#222;'>{$phone}</td>
       </tr>"
    : '';

$htmlBody = "
<!DOCTYPE html>
<html lang='pl'>
<head><meta charset='UTF-8'></head>
<body style='margin:0;padding:0;background:#f0ece4;font-family:Georgia,serif;'>
  <table width='100%' cellpadding='0' cellspacing='0' style='background:#f0ece4;padding:40px 20px;'>
    <tr><td align='center'>
      <table width='580' cellpadding='0' cellspacing='0' style='max-width:580px;width:100%;'>

        <!-- Header -->
        <tr>
          <td style='background:#b83228;padding:28px 36px;'>
            <p style='margin:0;font-size:0.72rem;letter-spacing:.25em;text-transform:uppercase;color:rgba(255,255,255,.6);'>heligonka.pl</p>
            <h1 style='margin:8px 0 0;font-size:1.5rem;font-weight:700;color:#fff;'>Nowa wiadomość z formularza</h1>
          </td>
        </tr>

        <!-- Body -->
        <tr>
          <td style='background:#fff;padding:36px;'>
            <table width='100%' cellpadding='0' cellspacing='0' style='border-bottom:1px solid #ede8e0;margin-bottom:28px;padding-bottom:20px;'>
              <tr>
                <td style='padding:8px 0;color:#999;font-size:0.78rem;text-transform:uppercase;letter-spacing:.1em;width:140px;vertical-align:top;'>Imię i nazwisko</td>
                <td style='padding:8px 0;font-size:1rem;color:#222;font-weight:700;'>" . htmlspecialchars($name) . "</td>
              </tr>
              {$phoneLine}
              <tr>
                <td style='padding:8px 0;color:#999;font-size:0.78rem;text-transform:uppercase;letter-spacing:.1em;vertical-align:top;'>E-mail</td>
                <td style='padding:8px 0;font-size:1rem;'><a href='mailto:{$email}' style='color:#b83228;text-decoration:none;'>{$email}</a></td>
              </tr>
            </table>

            <p style='margin:0 0 12px;color:#999;font-size:0.78rem;text-transform:uppercase;letter-spacing:.1em;'>Wiadomość</p>
            <p style='margin:0;font-size:1.05rem;color:#333;line-height:1.85;white-space:pre-wrap;'>" . nl2br(htmlspecialchars($message)) . "</p>
          </td>
        </tr>

        <!-- Reply hint -->
        <tr>
          <td style='background:#faf7f2;padding:16px 36px;border-top:1px solid #ede8e0;'>
            <p style='margin:0;font-size:0.82rem;color:#999;font-style:italic;'>Odpowiedz bezpośrednio na tego maila — wiadomość trafi do <strong style='color:#555;'>{$email}</strong></p>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style='background:#050d1a;padding:18px 36px;text-align:center;'>
            <p style='margin:0;color:rgba(255,255,255,.3);font-size:0.72rem;letter-spacing:.1em;'>Maksymilian Czerwiński — heligonka.pl</p>
          </td>
        </tr>

      </table>
    </td></tr>
  </table>
</body>
</html>";

// ── Wyślij przez Mailgun ──
$apiUrl = MAILGUN_REGION === 'eu'
    ? 'https://api.eu.mailgun.net/v3/' . MAILGUN_DOMAIN . '/messages'
    : 'https://api.mailgun.net/v3/'    . MAILGUN_DOMAIN . '/messages';

$fromEmail = 'formularz@' . MAILGUN_DOMAIN;

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $apiUrl,
    CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
    CURLOPT_USERPWD        => 'api:' . MAILGUN_API_KEY,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => [
        'from'     => "Formularz Heligonka.pl <{$fromEmail}>",
        'to'       => MAIL_TO,
        'reply-to' => "{$name} <{$email}>",
        'subject'  => $subject,
        'text'     => $textBody,
        'html'     => $htmlBody,
    ],
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($httpCode === 200) {
    echo json_encode(['ok' => true]);
} else {
    error_log("Mailgun błąd: HTTP {$httpCode} | {$response} | cURL: {$curlError}");
    http_response_code(500);
    echo json_encode([
        'ok'    => false,
        'error' => 'Wysyłka nie powiodła się. Zadzwoń lub napisz bezpośrednio na kontakt@heligonka.pl',
    ]);
}
