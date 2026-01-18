<?php
require 'config_connections.php';
$config_a = parse_ini_file(CONFIG_PATH);

// --- 1. SERVER-KONFIGURATION ANPASSEN ---
$imap_server = '{imap.strato.de:993/imap/ssl/novalidate-cert}INBOX';
// $imap_server  = '{imap.strato.de:993/imap/ssl}INBOX';
$imap_user    = 'service@cedur.online';
$imap_pass    = $config_a['SMTP_PASS'];

// Absender, die typischerweise Bounce-Mails senden
$bounce_senders = [
    'mailer-daemon',
    'postmaster',
    'mail delivery subsystem'
];

// --- 2. VERBINDUNG AUFBAUEN ---
$mailbox = imap_open($imap_server, $imap_user, $imap_pass);

if (!$mailbox) {
    die("IMAP-Verbindung fehlgeschlagen: " . imap_last_error());
}

// Gesamtanzahl der Nachrichten abrufen
$num_messages = imap_num_msg($mailbox);
echo "Es wurden $num_messages Nachrichten gefunden.\n\n";

// --- 3. MAILS DURCHLAUFEN ---
$results = [];

for ($i = 1; $i <= $num_messages; $i++) {
    // Ruft die Kopfzeilen (Header) der aktuellen E-Mail ab
    $header = imap_headerinfo($mailbox, $i);
    // echo "<pre>"; echo print_r($header); echo "</pre>";
    // Extrahieren des Adressaten (To-Feld)
    $to_address = '';
    if (isset($header->to[0]->mailbox) && isset($header->to[0]->host)) {
        $to_address = $header->to[0]->mailbox . "@" . $header->to[0]->host;
    }

    // Extrahieren des Absenders (From-Feld)
    $from_address = '';
    if (isset($header->from[0]->mailbox) && isset($header->from[0]->host)) {
        $from_address = $header->from[0]->mailbox . "@" . $header->from[0]->host;
    }

    // Lese Prüfung
    $is_unseen_flag_set = $header->Unseen;


    // --- 4. BOUNCE-PRÜFUNG ---
    $is_bounce = false;
    $from_mailbox_lower = strtolower($header->from[0]->mailbox ?? '');

    foreach ($bounce_senders as $sender) {
        if (strpos($from_mailbox_lower, $sender) !== false) {
            $is_bounce = true;
            break;
        }
    }

    // --- 5. ERGEBNIS SPEICHERN ---
    $results[] = [
        'message_id' => $i,
        'to_recipient' => $to_address,
        'seen_status'  => $is_unseen_flag_set == 'U' ? 'ungelesen' : '',
        'is_bounce'    => $is_bounce ? 'abgelehnt' : 'zugestellt' // Ja, Neun
    ];
}


function markiereAlsGelesen(string $server, string $user, string $pass, int $id): bool
{
    // 1. Verbindung öffnen
    $mailbox = imap_open($server, $user, $pass);

    if (!$mailbox) {
        echo "FEHLER: Verbindung fehlgeschlagen: " . imap_last_error() . "\n";
        return false;
    }

    // 2. Markieren der Nachricht mit dem Flag '\Seen'
    // Der zweite Parameter ist die Nachrichten-ID
    // Der dritte Parameter ist das Flag, das gesetzt werden soll
    $success = imap_setflag_full($mailbox, (string)$id, '\\Seen');

    // 3. Verbindung schließen
    imap_close($mailbox);

    return $success;
}





echo "<!DOCTYPE html>
<html lang='de'>

<head><style>
/* Container für die scrollbare Tabelle */
.table-wrapper {
    overflow-x: auto; /* Erzeugt horizontale Scrollbar bei Bedarf */
    margin: 20px 0;
}

/* Basistabelle & Design (Schiefergrau-Weiß) */
table {
    /* Breite muss auf 100% gesetzt werden */
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    min-width: 500px; /* Optional: Mindestbreite, bevor Scrollbar erscheint */
}

/* Kopfzeile (Schiefergrau) */
table thead th {
    background-color: #6a798f; 
    color: white;
    padding: 12px 15px;
    text-align: left;
    font-weight: bold;
}

/* Datenzeilen (Weiß-Grau gestreift) */
table tbody tr {
    border-bottom: 1px solid #dddddd;
}

table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3; /* Helles Grau */
}

table tbody tr:hover {
    background-color: #d1d9e2; /* Hover-Feedback */
}

table tbody td {
    padding: 2px 2px;
    color: #333;
}
</style></head><body>";


// --- 6. AUSGABE DER ERGEBNISSE ---
echo "<table><tr><th>ID</th><th>Adressat (TO)</th><th>Gelesen</th><th>Status</th></tr>";
foreach ($results as $mail) {
    echo "<tr>" .
        "<td>" . $mail['message_id'] . "</td>" .
        "<td>" . $mail['to_recipient'] . "</td>" .
        "<td>" . $mail['seen_status'] . "</td>" .
        "<td>" . $mail['is_bounce'] . "</td>" .
        "</tr>";
}
echo "</table>";

// Verbindung schließen
imap_ping($mailbox);
imap_close($mailbox);
echo "</body></html>";


// --- AUSFÜHRUNG GELESEN ---
$message_id = 0;
if ($message_id) {
    $erfolg = markiereAlsGelesen($imap_server, $imap_user, $imap_pass, $message_id);

    if ($erfolg) {
        echo "Nachricht $message_id wurde erfolgreich als gelesen markiert.\n";
    } else {
        echo "Nachricht $message_id konnte NICHT als gelesen markiert werden.\n";
    }
}
