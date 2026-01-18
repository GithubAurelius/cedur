<?php
if (!isset($_SESSION)) session_start();

header('Content-Type: application/json');

// Refresh-Cookie prüfen
if (empty($_COOKIE['refresh_token']) || empty($_SESSION['refresh_token'])) {
    echo json_encode(['status' => 'no_refresh']);
    exit;
}

// Token gültig?
if (
    $_COOKIE['refresh_token'] !== $_SESSION['refresh_token'] ||
    time() > $_SESSION['refresh_expires']
) {
    session_unset();
    session_destroy();
    echo json_encode(['status' => 'expired']);
    exit;
}

// Neues Access-Token erzeugen
$new_token = bin2hex(random_bytes(32));
$_SESSION['access_token'] = $new_token;
$_SESSION['access_expires'] = time() + ($_SESSION['access_lifetime'] * 60);

echo json_encode([
    'status' => 'refreshed',
    'access_token' => $new_token,
    'expires_in' => $_SESSION['access_lifetime'] * 60
]);
