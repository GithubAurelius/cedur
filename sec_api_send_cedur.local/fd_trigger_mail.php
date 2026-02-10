<?php
header('Content-Type: application/json');
require 'config_connections_local.php';

# $pseudonym = '2025071613464334'; 
$pseudonym = $_POST['pseudonym'];

$pdo = new PDO('mysql:host=localhost;dbname=cedur', 'mdueffelmeyer', 'Aurel12##3355');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
$stmt = $pdo->prepare("SELECT login_name FROM user_miq WHERE master_uid = ?");
$stmt->execute([$pseudonym]);
$ext_id = $stmt->fetchColumn(); 

if (!file_exists(CONFIG_PATH)) {
    error_log("FATAL ERROR: Secret config file not found.");
    http_response_code(500);
    die(json_encode([
        'status' => 'fatal_error',
        'message' => 'Configuration Error: API secret not found in environment:' . $_SERVER['SCRIPT_FILENAME']
    ]));
}
$config_a = parse_ini_file(CONFIG_PATH);
$API_SECRET = $config_a['API_SECRET'];

// Erzeuge einen sicheren, einmaligen Token
$token = bin2hex(random_bytes(32));

// Erzeuge die SHA-256 Signatur zur Absicherung der Anfrage
$signature = hash('sha256', $API_SECRET . $pseudonym . $token);

// Daten für den POST-Request vorbereiten
$data = [
    'pseudonym' => $pseudonym,
    'token'     => $token,
    'signature' => $signature,
    'ext_id'    => $ext_id
];

// Robuste Fehlerbehandlung mit cURL (besser als file_get_contents)
$ch = curl_init(MD_SEND_EMAIL);
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
    die('Fehler: MD-Server nicht erreichbar. cURL Error: ' . $curl_error . ': ' . $_SERVER['SCRIPT_FILENAME']);
}

$result = $response; // response durchreichen

// if ($http_code === 200 && $result['status'] === 'OK') {
//     echo "✅ E-Mail-Versand für Pseudonym '{$pseudonym}' erfolgreich ausgelöst. Nachricht: " . $result['message'];
// } elseif ($http_code === 404) {
//     // Der wichtigste Fall: Pseudonym auf dem MD-Server nicht gefunden
//     echo "❌ **FEHLER (404):** Das Pseudonym '{$pseudonym}' existiert nicht in der E-Mail-Datenbank des Mail-Servers. Bitte in der Praxis-DB ergänzen.";
// } else {
//     // Andere Fehler (500, Signaturfehler 401, etc.)
//     $message = $result['message'] ?? 'Unbekannter Fehler';
//     echo "❌ FEHLER ({$http_code}): E-Mail-Versand fehlgeschlagen. Nachricht: {$message}";
// }
echo $result;
