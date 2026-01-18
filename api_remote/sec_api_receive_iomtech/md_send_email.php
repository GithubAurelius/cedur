<?php
require 'config_connections.php';
$config_a = parse_ini_file(CONFIG_PATH);

$API_SECRET = $config_a['API_SECRET'];
define("API_PATH", $config_a['API_PATH']);
define("FD_PASSWORD_SET", $config_a['FD_PASSWORD_SET']);


// PHPMailer-Klassen einbinden (Pfade ggf. anpassen)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require API_PATH . 'PHPMailer-master/src/Exception.php';
require API_PATH . 'PHPMailer-master/src/PHPMailer.php';
require API_PATH . 'PHPMailer-master/src/SMTP.php';


// Empfangene Daten
$pseudonym = $_POST['pseudonym'] ?? '';
$token = $_POST['token'] ?? '';
$signature = $_POST['signature'] ?? '';
$ext_id = $_POST['ext_id'] ?? '';




header('Content-Type: application/json');

if (!file_exists(CONFIG_PATH)) {
    error_log("FATAL ERROR: Secret config file not found.");
    http_response_code(500);
    die(json_encode([
            'status' => 'fatal_error', 
            'message' => 'Configuration Error: API secret not found in environment: '. $_SERVER['SCRIPT_FILENAME']
        ]));
}




// Sicherheitsprüfung: Signatur validieren
if (hash('sha256', $API_SECRET . $pseudonym . $token) !== $signature) {
    http_response_code(401);
    die(json_encode(['status' => 'error', 'message' => 'Invalid API Signature. Access denied.']));
}

// Datenbankverbindung herstellen (MD-Server)
try {
    $pdo = new PDO('mysql:host=localhost;dbname='.$config_a['DB_NAME'], $config_a['DB_USER'], $config_a['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'DB Connection failed on MD: '. $_SERVER['SCRIPT_FILENAME']]));
}

// E-Mail-Adresse abrufen
$stmt = $pdo->prepare("SELECT patienten_email FROM md_kontakte WHERE fd_pseudonym = ?");
$stmt->execute([$pseudonym]);
$email = $stmt->fetchColumn();

if (!$email) {
    http_response_code(404);
    die(json_encode(['status' => 'error', 'message' => 'Pseudonym not found in MD contacts: '. $_SERVER['SCRIPT_FILENAME']]));
}

// Token speichern/aktualisieren (48 Stunden gültig)
$ablauf = date('Y-m-d H:i:s', strtotime('+48 hours'));
$stmt = $pdo->prepare("UPDATE md_kontakte SET passwort_token = ?, token_ablauf = ? WHERE fd_pseudonym = ?");
$stmt->execute([$token, $ablauf, $pseudonym]);

// -----------------------------------------------------------------
// E-Mail erstellen und versenden (MIT PHPMailer)
// -----------------------------------------------------------------
$mail = new PHPMailer(true); // Wirft Exceptions bei Fehlern
$mail_success = false;

$SMTP_HOST = $config_a['SMTP_HOST']; 
$SMTP_USER = $config_a['SMTP_USER'];
$SMTP_PASS = $config_a['SMTP_PASS'];  

try {
    // Server-Einstellungen
    $mail->isSMTP();
    $mail->Host       = $SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = $SMTP_USER;
    $mail->Password   = $SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
    $mail->Port       = 587; 
    $mail->CharSet    = 'UTF-8';
    $mail->isHTML(false); // Klartext-E-Mail (sichere Wahl)

    // Empfänger
    $mail->setFrom($SMTP_USER, 'Ihr Praxisteam');
    $mail->addAddress($email);
    $mail->addBCC('service@cedur.online');
    // $mail->addBCC('marc@dueffelmeyer.de');
    // $mail->addBCC('M.Becken@immunodata.de');

    // Inhalt
    $link = FD_PASSWORD_SET . "?login=" . urlencode($pseudonym) . "&token=" . urlencode($token);
    
    $betreff = "CEDUR - Ihre Einladung zur Online-Dokumentation)";
    $body = "Sehr geehrte/r Patient/in,\n\n";
    $body .= "Bitte bewahren Sie Ihren Benutzernamen für die Dokumentation gut auf.\nDer Benutzernamen lautet:\n\n{$ext_id}\n\n";
    $body .= "Bitte klicken Sie auf den folgenden Link, um Ihr Passwort festzulegen:\n";
    $body .= $link . "\n\n";
    $body .= "Der Link ist 48 Stunden gültig.\n\nIhr CEDUR-Praxisteam.\n\nWenn Sie Ihren Benutzernamen verlieren, wenden Sie sich bitte an Ihre Praxis.";
    
    $mail->Subject = $betreff;
    $mail->Body    = $body;
    
    // Senden
    $mail->send();
    $mail_success = true; // Senden war erfolgreich

} catch (Exception $e) {
    // Fehler im Mailversand
    $mail_success = false;
    $error_message = "Mailer Error: " . $mail->ErrorInfo;
}


// Rückmeldung an den FD-Server senden
if ($mail_success) {
    echo json_encode(['status' => 'OK', 'message' => 'Token saved and email successfully sent to ' . $email]);
} else {
    // Bei Fehlschlag den gerade gespeicherten Token LÖSCHEN (Rückgängig-Machen)
    $stmt = $pdo->prepare("UPDATE md_kontakte SET passwort_token = NULL, token_ablauf = NULL WHERE fd_pseudonym = ?");
    $stmt->execute([$pseudonym]);
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Email sending failed (SMTP error). Token reverted. Details: ' . ($error_message ?? 'Unknown error')]);
}


?>