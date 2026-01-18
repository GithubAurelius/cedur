<?php
header('Content-Type: application/json');
require 'config_connections_local.php';

// $pseudonym = '1025071613464334';
$pseudonym = $_REQUEST['pseudonym'];


if (!file_exists(CONFIG_PATH)) {
    error_log("FATAL ERROR: Secret config file not found.");
    http_response_code(500);
    die(json_encode([
        'status' => 'fatal_error',
        'message' => 'Configuration Error: API secret not found in environment: ' . $_SERVER['SCRIPT_FILENAME']
    ]));
}
$config_a = parse_ini_file(CONFIG_PATH);
$API_SECRET = $config_a['API_SECRET'];

// ----------------------------------------------------
// Prozessstart: Daten senden

// Erzeuge die SHA-256 Signatur zur Absicherung der Anfrage
$signature = hash('sha256', $API_SECRET . $pseudonym);

// Daten für den POST-Request vorbereiten
$data = [
    'pseudonym' => $pseudonym,
    'signature' => $signature,
];

// Robuste Fehlerbehandlung mit cURL (besser als file_get_contents)
$ch = curl_init(MD_GET_DATA_TRIGGER);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Bei HTTPS-Verbindungen sicherstellen, dass Zertifikatsprüfung aktiv ist!
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

// Verarbeitung der Antwort
if ($response === FALSE) {
    die(json_encode(['status' => 'fatal_error', 'message' => 'MD-Server nicht erreichbar. cURL Error: ' . $curl_error . ': ' . $_SERVER['SCRIPT_FILENAME']]));
}
$result = json_decode($response, true);
echo json_encode($result);

// const patienten_email_remote = document.
// patienten_email_remote

// if ($http_code === 200 && $result['status'] === 'OK') {
//     echo "✅ ".$result['message'];
// } else {
//     $message = $result['message'] ?? '';
//     echo "❌ ".$result['message'];
// }


// CREATE TABLE `md_kontakte` (
//   `fd_pseudonym` bigint(20) NOT NULL,
//   `patienten_email` varchar(255) NOT NULL,
//   `passwort_token` varchar(64) DEFAULT NULL,
//   `token_ablauf` datetime DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

// ALTER TABLE `md_kontakte`
//   ADD PRIMARY KEY (`fd_pseudonym`);
// COMMIT;
