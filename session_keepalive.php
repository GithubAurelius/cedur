<?php
// keepalive.php
if (!isset($_SESSION)) session_start();

# require_once $_SESSION['INI-PATH'];
session_start();
header('Content-Type: application/json');

$now = time();
$timeout = $_SESSION['access_lifetime'] * 60; // Access-Token Lebensdauer

// Kein Access-Token? => Fehler
if (empty($_SESSION['access_token']) || empty($_SESSION['access_expires'])) {
    echo json_encode(['status' => 'no_token']);
    exit;
}

// Token abgelaufen?
if ($now > $_SESSION['access_expires']) {
    echo json_encode(['status' => 'expired']);
    exit;
}

// Token gültig → verlängern
$_SESSION['access_expires'] = $now + $timeout;

echo json_encode([
    'status' => 'ok',
    'expires_in' => $timeout
]);


?>
