<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

// Überprüfen, ob Sessiondaten vorhanden sind
if ( !isset($_SESSION['m_uid']) ) {
    echo json_encode(["status" => "failed"]);
    exit;
} 

require_once $_SESSION['INI-PATH'];


// REPLACE-Befehl
$query = "REPLACE INTO user_miq_log (muid, logged_in, logged_out, ip_address) VALUES ('".$_SESSION['m_uid']."', '".$_SESSION['startLog']."', '".date('Y-m-d H:i:s')."', '".$_SESSION['userIp']."')";
$stmt = $db->prepare($query);


if ($stmt->execute()) {
    echo json_encode(["status" => "ok"]);
} else {
    echo json_encode(["status" => "failed"]);
}

