<?php
header('Content-Type: application/json');
require 'config_connections.php';

// Empfangene Daten
$pseudonym = $_POST['pseudonym'] ?? '';
$signature = $_POST['signature'] ?? '';


if (!file_exists(CONFIG_PATH)) {
    error_log("FATAL ERROR: Secret config file not found.");
    http_response_code(500);
    die(json_encode([
        'status' => 'fatal_error',
        'message' => 'Configuration Error: API secret not found in environment: '.$_SERVER['SCRIPT_FILENAME']
    ]));
}
$config_a = parse_ini_file(CONFIG_PATH);
$API_SECRET = $config_a['API_SECRET'];

// Sicherheitsprüfung: Signatur validieren
if (hash('sha256', $API_SECRET . $pseudonym) !== $signature) {
    http_response_code(401);
    die(json_encode(['status' => 'error', 'message' => 'MD: Invalid API Signature. Access denied: '.$_SERVER['SCRIPT_FILENAME']]));
}

// Datenbankverbindung herstellen (MD-Server)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=' . $config_a['DB_NAME'], $config_a['DB_USER'], $config_a['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'DB Connection failed on MD.']));
}

// $stmt = $pdo->prepare("DELETE FROM md_kontakte");
// $stmt->execute();

$sql = "SELECT patienten_email FROM md_kontakte WHERE fd_pseudonym = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo 'PDO driver: ' . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . PHP_EOL;
// echo 'DB version: ' . $pdo->query('SELECT VERSION()')->fetchColumn() . PHP_EOL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pseudonym]);
    $patienten_email = $stmt->fetchColumn();
    if ($patienten_email === false) {
        $message = "";
    } else {
        $message = $patienten_email;
    }
    echo json_encode(['status' => 'OK', 'message' => $message]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'SQL-error', 'message' => $e->getMessage()]);
    // echo "SQL-Fehler: " . $e->getMessage() . PHP_EOL;
    // Optional: var_dump($stmt->errorInfo()); // nur falls $stmt existiert
}
