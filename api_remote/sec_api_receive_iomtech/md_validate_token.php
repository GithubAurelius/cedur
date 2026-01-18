<?php
header('Content-Type: application/json');
require 'config_connections.php';

// Empfangene Daten
$pseudonym = $_POST['pseudonym'] ?? '';
$token = $_POST['token'] ?? '';
$signature = $_POST['signature'] ?? '';

if (!file_exists(CONFIG_PATH)) {
    error_log("FATAL ERROR: Secret config file not found.");
    http_response_code(500);
    die(json_encode([
            'status' => 'fatal_error', 
            'message' => 'Configuration Error: API secret not found in environment.'
        ]));
}
$config_a = parse_ini_file(CONFIG_PATH);
$API_SECRET = $config_a['API_SECRET'];

// Sicherheitsprüfung: Signatur validieren
if (hash('sha256', $API_SECRET . $pseudonym . $token) !== $signature) {
    http_response_code(401);
    die(json_encode(['status' => 'error', 'message' => 'Invalid API Signature. Access denied: '. $_SERVER['SCRIPT_FILENAME']]));
}

// Datenbankverbindung herstellen (MD-Server)
try {
    $pdo = new PDO('mysql:host=localhost;dbname='.$config_a['DB_NAME'], $config_a['DB_USER'], $config_a['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'DB Connection failed on MD: '. $_SERVER['SCRIPT_FILENAME']]));
}

// Token und Ablaufdatum prüfen
// Prüft nur Existenz und Gültigkeit, aber löscht den Token NICHT.
$stmt = $pdo->prepare("SELECT token_ablauf FROM md_kontakte WHERE fd_pseudonym = ? AND TRIM(passwort_token) = ?");
$stmt->execute([$pseudonym, $token]);
$ablauf_datum = $stmt->fetchColumn();


if (!$ablauf_datum) {
    die(json_encode(['status' => 'invalid', 'message' => 'Token not found or already consumed: '. $_SERVER['SCRIPT_FILENAME']]));
}

if (strtotime($ablauf_datum) < time()) {
    die(json_encode(['status' => 'invalid', 'message' => 'Token expired: '. $_SERVER['SCRIPT_FILENAME']]));
}

// Erfolgsantwort (NUR EINE ANTWORT IST ZULÄSSIG!)
echo json_encode(['status' => 'valid', 'message' => 'Token is valid.']); 
