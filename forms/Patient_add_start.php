<?php

require '../' . $_SESSION['API_PATH'] . 'config_connections_local.php';


function check_if_valexists($db, $fg, $fid, $val)
{
    $val == $val . trim($val ?? '');
    $query = "SELECT fcid FROM forms_" . $fg . " WHERE fid=" . $fid . " AND fcont='" . $val . "' AND usergroup=" . $_SESSION['user_group'];
    // echo $query;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    // echo "<pre>"; echo print_r($res_a); echo "</pre>";
    return count($res_a);
}

function generateCodeLLLNNNN($fcid, $key10)
{
    if (strlen($fcid) !== 12) {
        throw new Exception("fcid muss genau 12 Zeichen (ymdHis) lang sein.");
    }
    if (strlen($key10) !== 10) {
        throw new Exception("key muss genau 10 Zeichen lang sein.");
    }
    // Erzeuge schlüsselabhängigen Hash (HMAC-SHA1)
    $hash = hash_hmac('sha1', $fcid, $key10);
    // Buchstaben-Teil (LLL) → 26^3 = 17576 Möglichkeiten
    $lettersInt = hexdec(substr($hash, 0, 4)) % 17576;
    $letters =
        chr(65 + intdiv($lettersInt, 676) % 26) .
        chr(65 + intdiv($lettersInt, 26) % 26) .
        chr(65 + $lettersInt % 26);
    // Zahlen-Teil (NNNN) → 0000 bis 9999
    $numbersInt = hexdec(substr($hash, 4, 4)) % 10000;
    $numbers = str_pad($numbersInt, 4, '0', STR_PAD_LEFT);
    return $letters . '-' . $numbers;
}

function get_user_data($db, $master_uid)
{
    $stmt = $db->prepare("SELECT master_uid,login_name,login_pass,email  FROM user_miq WHERE master_uid = :master_uid");
    $stmt->bindParam(':master_uid', $master_uid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_remote_email($url)
{
    $patienten_email_remote = "F_01: E-Mail nicht verfügbar";

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 3,  // Sekunden bis Verbindungsaufbau abbricht
        CURLOPT_TIMEOUT => 5,         // Gesamtzeitlimit
        CURLOPT_FAILONERROR => false, // Keine Exceptions bei HTTP 4xx/5xx
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        error_log("cURL-Fehler: " . curl_error($ch));
    } else {
        $data = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($data['message'])) {
            $patienten_email_remote = $data['message'];
        } else {
            error_log("JSON-Fehler oder Feld fehlt: " . json_last_error_msg());
        }
    }

    curl_close($ch);
    return $patienten_email_remote;
}

$user_data_a = get_user_data($db, $fcid);

if ($_POST) {

    $praxis_nr = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
    $check_fg = 10003;
    $check_fid = 91;
    if ($praxis_nr) {
        $patient_exists = check_if_valexists($db,  $check_fg, $check_fid, $form_data_a[$_SESSION['param']['praxis_pid']]);
        if ($patient_exists  > 1) {
            echo "<script>alert('Achtung!\\n\\nDer Patient mit der Nummer " . $praxis_nr . " exisitiert bereits. Das Feld >> Praxis-Nummer << wurde gelöscht!\\n\\nSie können den leeren Patientendatensatz mit einem anderen NEUEN Patienten überschreiben oder löschen.')</script>";
            $form_data_a[$_SESSION['param']['praxis_pid']] = "";
            $query = "DELETE FROM forms_" . $fg . " WHERE fcid=" . $fcid . " AND fid=" . $check_fid . " AND fcont='" . $praxis_nr . "' AND usergroup=" . $_SESSION['user_group'];
            $stmt = $db->prepare($query);
            $stmt->execute();
        }
    }
    $email = $_POST['FF_10003040'] ?? ""; // Der WERT muss zur Aktualiserung als Post gezogen werden weil er grundsätzlich nicht in forms_a gespeichert wird.
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Die E-Mail-Adresse hat kein ungültiges Format und wurde gelöscht')</script>";
        $email = "";
    }
    if ($email) {
        $url = FD_SEND_MAIL_ADDRESS_LOCAL_TRIGGER . '?pseudonym=' . $fcid . '&patienten_email=' . $email;
        $response = file_get_contents($url);
        echo $response;
    }
}

$patienten_email_remote = get_remote_email(FD_GET_MAIL_LOCAL_TRIGGER . '?pseudonym=' . $fcid); # FD_GET_MAIL_LOCAL_TRIGGER 'http://cedur.local/sec_api_send_cedur.local/fd_get_email.php'

$email = "";
$ext_fcid_code = "";
$ext_fcid_code_key = "A1X2CED3Z5"; // TODO GENERATE FROM PRAXIS-CODE 
$pid = $_REQUEST['pid'] ?? 0;

// only if dataset is new (fcid=-1 in form_start)
if (!empty($fcid_ts)) {
    $ext_fcid = substr($fcid_ts, 2);
    $ext_fcid_code = generateCodeLLLNNNN($ext_fcid, $ext_fcid_code_key);
    if ($ext_fcid_code) $form_data_a[$_SESSION['param']['ext_fcid']] = $ext_fcid_code;
}

$diagnosis = $form_data_a[95] ?? "";
$diag_short = "";
if ($diagnosis == "Morbus Crohn") $diag_short = "MC";
if ($diagnosis == "Colitis ulcerosa") $diag_short = "CU";
if ($diagnosis == "Colitis indeterminataa") $diag_short = "CI";

$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) # $header_info = "Patient: " . $form_data_a[$_SESSION['param']['praxis_pid']];
    $header_info = "<button class='save-button-style' title='Patientendaten einblenden' id='edit_patient_button'>👁️</button>"
        . " " . ($form_data_a[$_SESSION['param']['praxis_pid']] ?? "") . ": "
        . "<font style='font-weight:normal'> (" . ($form_data_a[$_SESSION['param']['ext_fcid']] ?? "") . ")"
        . " " . $diagnosis
        . " " . ($form_data_a[10003020] ?? "") . ","
        . " " . ($form_data_a[$_SESSION['param']['geschlecht']] ?? "") . "</font>";


// for interaction with user_mngt - repect DSSGVO
// if ($user_data_a) {
//     $email = $user_data_a['email'] ?? "";
//     if ($email) $form_data_a[10003040] = $email;
// }

$ppid = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
$pgender = $form_data_a[$_SESSION['param']['geschlecht']] ?? "";
$pyear = $form_data_a[10003020] ?? "";
$pdiagnosis = $form_data_a[95] ?? "";
$visite_button = "";
$data_complete = 0;
if ($ppid && $pgender && $pyear  && $pdiagnosis) {
    $visite_button = '<button id="new_visit" style="min-width:24px;max-width:24px;padding:2px" title="Neue Visite anlegen" type="button"><img src="' . MIQ_PATH . '/img/new_add.svg" width="16px"></button>';
    $data_complete = 1;
}
?>

<!-- tabs & dashboard-->
<style>
    /* tabs */
    .tabs {
        width: 100%;
        margin: auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .tab-buttons {

        display: flex;
        border-bottom: 1px solid #e0e0e0;
        background-color: #f4f4f4;
        border-radius: 6px 6px 0 0;
        overflow-x: auto;
        /* Falls es zu viele Tabs gibt */
        overflow-y: hidden;
        box-shadow: inset 0 -1px 0 #ddd;
        width: 100%;
        box-sizing: border-box;
    }

    .tab-button {
        flex: 1 1 0;
        /* Flex-grow: 1, Flex-shrink: 1, Basis: 0 */
        padding: 0.2rem;
        background-color: rgb(251, 251, 251);
        border: none;
        border-right: 2px solid #e0e0e0;
        cursor: pointer;
        font-size: 12px;
        color: #555;
        transition: background 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        outline: none;
        border-radius: 0;
        box-sizing: border-box;

        min-width: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tab-button:last-child {
        border-right: none;
    }

    .tab-button:hover {
        background-color: rgb(242, 242, 242);
        color: #222;
    }

    .tab-button.active {
        background-color: #fff7f7;
        font-weight: 600;
        color: #000;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.06), inset 0 2px 0 #fff;
        position: relative;
        z-index: 1;
    }

    .tab-content {
        display: none;
        padding: 0;
        width: 99%;
    }

    .tab-content.active {
        display: block;
    }
</style>

<!-- tabs -->
<div id='patient_tabs' class="tabs">
    <div class="tab-buttons">
        <button type="button" class="tab-button active" data-tab="tab1" id='visite_tab'>Visite</button> <?php echo $visite_button ?>
        <button type="button" class="tab-button" data-tab="tab2">Scores</button>
        <button type="button" class="tab-button" data-tab="tab3">Befragung</button>
        <button type="button" class="tab-button" data-tab="tab4">Untersuchung</button>
        <button type="button" class="tab-button" data-tab="tab5">Labor</button>
        <button type="button" class="tab-button" data-tab="tab6">Vormedikation</button>
        <button type="button" class="tab-button" data-tab="tab7">Medikation</button>
    </div>
    <div class="tab-content active" id="tab1">
        <iframe id='_visite' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab2">
        <iframe id='_scores' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab3">
        <iframe id='_patientenbefragung' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab4">
        <iframe id='_untersuchung' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab5">
        <iframe id='_labor' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab6">
        <iframe id='_vormedikation' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab7">
        <iframe id='_medikation' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>

</div>