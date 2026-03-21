<?php
/**
 * Wspólna sekcja <head> dla wszystkich stron.
 *
 * Zmienne dostępne przez stronę nadrzędną:
 *   $pageTitle  (string) — tytuł zakładki
 *
 * Sekcja jest otwarta (bez </head>) — strona może dołożyć własne
 * style/meta przed zamknięciem tagu.
 */
?><!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle ?? 'Maksymilian Czerwiński — Muzyk & Instruktor') ?></title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=EB+Garamond:ital,wght@0,400;0,500;1,400;1,500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
