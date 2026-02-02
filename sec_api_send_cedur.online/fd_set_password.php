<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// header('Content-Type: application/json');
require 'config_connections_local.php';

$pseudonym = $_GET['login'] ?? '';
$token = $_GET['token'] ?? '';

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

if (empty($pseudonym) || empty($token)) {
    die("Ungültige Zugangsdaten: " . $_SERVER['SCRIPT_FILENAME']);
}

$pdo = new PDO('mysql:host=localhost;dbname=cedur', 'cedur_admin', 'Aurel12##33');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT login_name FROM user_miq WHERE master_uid = ?");
$stmt->execute([$pseudonym]);
$ext_id = $stmt->fetchColumn();

// Token-Validierung und Inaktivierung auf dem MD-Server auslösen
$signature = hash('sha256', $API_SECRET . $pseudonym . $token);
$data = [
    'pseudonym' => $pseudonym,
    'token'     => $token,
    'signature' => $signature,
];

// Robustere API-Kommunikation mit cURL
$ch = curl_init(MD_API_TOKEN_VALIDATE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Bei HTTPS-Verbindungen sicherstellen, dass Zertifikatsprüfung aktiv ist!
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

// A) Netzwerkfehler prüfen
if ($response === FALSE || $curl_error !== "") {
    // Fehler: Der MD-Server ist nicht erreichbar oder die URL ist falsch
    $error_msg = "FEHLER: Der Mail-Server ist nicht erreichbar. Bitte wenden Sie sich an die Praxis. (Tech-Info: " . htmlspecialchars($curl_error) . ")";
    die("❌ " . $error_msg . ': ' . $_SERVER['SCRIPT_FILENAME']);
}


// B) JSON-Dekodierungsfehler prüfen
$validation_result = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    // Fehler: Die Antwort war kein gültiges JSON (z.B. PHP-Fehler im MD-Skript)
    $error_msg = "FEHLER: Ungültige Antwort vom Mail-Server. (Tech-Info: Response: " . htmlspecialchars($response) . ")";
    die("❌ " . $error_msg . ': ' . $_SERVER['SCRIPT_FILENAME']);
}

// C) Validierungsfehler prüfen (Die eigentliche Logik)
if ($validation_result['status'] !== 'valid') {
    // Fehler: Der MD-Server hat geantwortet, aber den Token abgelehnt
    $message = $validation_result['message'] ?? 'Unbekannter Validierungsfehler';

    // Wir können die ursprüngliche Fehlermeldung vom MD-Server anzeigen
    if ($message === 'Token not found or already consumed.') {
        die("❌ Zugangscode ungültig, abgelaufen oder bereits verwendet. Bitte wenden Sie sich an Ihre Praxis: " . $_SERVER['SCRIPT_FILENAME']);
    }

    // Für alle anderen Fälle:
    die("❌ Validierungsfehler. Bitte wenden Sie sich an Ihre Praxis. (Detail: {$message}): " . $_SERVER['SCRIPT_FILENAME']);
}

// ----------------------------------------------------
// TOKEN IST GÜLTIG -> Patient darf Passwort setzen
// ----------------------------------------------------

function validatePassword(string $password): array
{
    $errors = [];
    if (strlen($password) < 10) {
        $errors[] = "Das Passwort muss mindestens 10 Zeichen lang sein.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Es muss mindestens einen Großbuchstaben enthalten.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Es muss mindestens eine Zahl enthalten.";
    }
    if (!preg_match('/[^a-zA-Z0-9\s]/', $password)) {
        $errors[] = "Es muss mindestens ein Sonderzeichen enthalten.";
    }
    return $errors;
}

// Passwort-Formular anzeigen
echo "<!DOCTYPE html>
        <html lang='de'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Test</title>
            <link rel='stylesheet' href='passwordchange.css'>
        </head>
        <body>
";
$password_ok = 0;
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $new_password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($new_password !== $password_confirm) {
        $error_message = "❌ Die eingegebenen Passwörter stimmen nicht überein.";
    } else {
        $validation_errors = validatePassword($new_password);
        
        if (!empty($validation_errors)) {
            $error_message = "Das Passwort erfüllt nicht alle Anforderungen:<br><ul><li>"
                . implode("</li><li>", $validation_errors) . "</li></ul>";
        } else {

            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            try {
                // $stmt = $pdo->prepare("UPDATE fd_patienten SET passwort_hash = ?, zugang_aktiv = TRUE WHERE pseudonym = ?");
                $stmt = $pdo->prepare("UPDATE user_miq SET login_pass = ? WHERE master_uid = ?");
                $stmt->execute([$password_hash, $pseudonym]);
                echo "<table>
                        <tr><td><h2>✅ Erfolgreich!</h2></td></tr>
                        <tr><td><h3> Ihr Passwort ist gesetzt.<br>Sie können sich nun mit Ihren Zugangsdaten anmelden:</h3><br>
                        <button type='submit' onclick=\"document.location.href='" . LOGIN_LINK . "'\">Hier klicken zur Anmeldung</button></td></tr>
                    </table>";
                $password_ok = 1;
            } catch (PDOException $e) {
                die("<h2>❌Fehler beim Speichern des Passworts</h2>");
            }
        }
    }
}

if (!$password_ok) {
    echo " 
    <form method='POST'>
    <h2>Passwort festlegen für '{$ext_id}'</h2>";

    if ($error_message) {
        echo "<div class='error'>" . $error_message . "</div>";
    }

    echo "
    <div class='rules'>
        Ihr Passwort muss enthalten:
        <ul>
            <li>Mindestens **10 Zeichen**</li>
            <li>Mindestens **ein Sonderzeichen**</li>
            <li>Mindestens **eine Zahl**</li>
            <li>Mindestens **einen Großbuchstaben**</li>
        </ul>
    </div>
    <label for='password'><strong>Neues Passwort:</strong></label>
    <input type='password' id='password' name='password' required><br>

    <label for='password_confirm'><strong>Passwort wiederholen:</strong></label>
    <input type='password' id='password_confirm' name='password_confirm' required><br>
        <button type='submit'>Passwort speichern</button>
    </form>
    ";
}
echo "</body></html>";
