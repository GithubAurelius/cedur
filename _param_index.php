<?php
// $_SESSION['rl'] muss immer einen Wert haben
// Individuelles Hintergrundbild der Steuerung muss immer unter abgelegt weden unter: forms/images/main_background.jpg 

// Die nachfolgenden Paramter werden als JSON an andere Formulare/Windboxes übergeben, um Daten aus höheren Ebenen
// an untere Ebenen der Dokumenationen zu übergeben: Beispiel: Ebenen an Räume, Patienten Geschlecht an Visite 
$_SESSION['param']['pid'] = 90;         // Sollte immer gesetzt werden als Power-ID (Patienten/ Ebene oder Gebäude) 
$_SESSION['param']['visite'] = 93;      // Sollte auch immer gesetzt werden als Begehung/ Patientenbesuch
$_SESSION['param']['praxis_pid'] = 91;  // comfort Praxis-Software 
$_SESSION['param']['ext_fcid'] = 92;    // comfort Pseudonym 
$_SESSION['param']['first_visit'] = 94; // comfort 
$_SESSION['param']['diagnosis'] = 95;   // comfort Med
$_SESSION['param']['geschlecht'] = 96;  // comfort Med
$_SESSION['param']['groesse'] = 97;     // comfort Med
 
$_SESSION['table_edit'] = 0;            // Erlauben des Editierens von Tabellen

// KEEPALIVVE AND LOGGING - Session und Cookie Paramter
$_SESSION['PING_SHOW'] = '';
$_SESSION['PING_INTERVAL'] = 180;
$_SESSION['access_lifetime'] = 90; // 90 Minuten
$_SESSION['refresh_lifetime'] = 2; // 2 Tage
$access_lifetime = $_SESSION['access_lifetime'] * 60; 
$refresh_lifetime = $_SESSION['refresh_lifetime'] * 24 * 60 * 60; 
$_SESSION['access_token'] = hash('sha256', $_SESSION['m_uid'] . time());
$_SESSION['access_expires'] = time() + $access_lifetime;
$_SESSION['refresh_token'] = hash('sha256', $_SESSION['m_uid'] . time());
$_SESSION['refresh_expires'] = time() + $refresh_lifetime;
// Refresh-Token im sicheren HttpOnly-Cookie
setcookie('refresh_token', $_SESSION['refresh_token'], [
    'expires' => time() + $refresh_lifetime,
    'path' => '/',
    'secure' => true,   // nur bei HTTPS
    'httponly' => true, // nicht aus JS zugreifbar
    'samesite' => 'Lax'
]);

// header('Content-Type: application/json');
// echo json_encode([
//     'access_token' => $access_token,
//     'expires_in' => $access_lifetime
// ]);

// Spezielle Sondernavigationen für Projekte 
if (isset($_SESSION['rl']['plobonly']))
    header("Location: " . MIQ_PATH . "modules/miq_plob");
elseif (isset($_SESSION['temp_params_a'])) { // only qr-direct-access
    $_SESSION['m_uid']      = $_SESSION['temp_params_a']['pid'];
    $_SESSION['uid']        = $_SESSION['temp_params_a']['pid'];
    $_SESSION['user_name']  = $_SESSION['temp_params_a']['ext_fcid'];
    $_SESSION['user_group'] = $_SESSION['temp_params_a']['user_group'];
    // TODO optional: Extract from param_a 
    $_SESSION['overwrite_navigation'] = 1;
    $_SESSION['rl']['user']     = "";
    $_SESSION['rl']['doc_only'] = 10010;
    $_SESSION['temp_fg'] = $_SESSION['rl']['doc_only'];
    $_SESSION['temp_fcid'] = $_SESSION['temp_params_a']['visite'];
    header("Location: forms/Patientenfragebogen.php?a_log=1");
} elseif (isset($_SESSION['rl']['user'])) {
    if ($_SESSION['password_expired']) header("Location: " . MIQ_PATH . "modules/change_userdata/change_userdata.php");
    else header("Location: forms/Patienten_Startseite.php");
}

// Für medizinsche Projekte  Auslesen der Vorgaben für automatisches Setzen von Einheiten
$labor_haemoglobin_set = $_SESSION['labor_haemoglobin'] ?? 0;
if (!$labor_haemoglobin_set) {
    $inst_data_a = [];
    $inst_data_a = get_query_data($db, 'forms_10000', $query_add = "fid=10000010 AND fcont='" . $_SESSION['user_group'] . "'"); // 
    if (count($inst_data_a) > 0) {
        $fcid_inst = $inst_data_a[0]['fcid'] ?? 0;
        if ($fcid_inst) {
            $inst_data_a = [];
            $inst_data_a = get_query_data($db, 'forms_10000', $query_add = "fcid=" . $fcid_inst . " AND fid=10000021");
            $labor_haemoglobin = $inst_data_a[0]['fcont'] ?? "";
            if ($labor_haemoglobin) $_SESSION['labor_haemoglobin'] = $labor_haemoglobin;
        }
    }
}
