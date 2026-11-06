<?php
// Default values
$statusText      = '';
$statusClass     = 'status';
$inputValue      = '';
$callDisabled    = 'disabled';      // verde di default disabilitato
$showHangup      = false;           // pulsante rosso nascosto di default

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ── Pulsante ROSSO premuto ── 
    if (array_key_exists('hangup', $_POST)) {
        $statusText   = '';
        $statusClass  = 'status';
        $inputValue   = '';
        $callDisabled = 'disabled';
        $showHangup   = false;
    }

    // ── Pulsante VERDE premuto ──
    elseif (array_key_exists('phone', $_POST)) {
        $raw = trim($_POST['phone'] ?? '');
        $inputValue = htmlspecialchars($raw);

        $digits = preg_replace('/[^0-9]/', '', $raw);

        if (strlen($digits) === 10) {
            $statusText = 'STA SQUILLANDO';
            $statusClass = 'ok';
            $callDisabled = 'disabled';   // blocca doppio click
            $showHangup = true;           // mostra pulsante rosso
        } else {
            $statusText = 'NUMERO INESISTENTE';
            $statusClass = 'error';
            $callDisabled = '';           // resta attivo per correggere
            $showHangup = false;
        }
    }
}