<?php

function get_visits($db, $pid)
{
    $query = "SELECT fcid FROM forms_10005 WHERE fid=90 AND fcont='" . $pid . "' ORDER BY fcid;";
    // echo $query;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $res_a;
}

function get_last_visite($visits_a, $fcid)
{
    $prev = 0;
    $prevFound = false;
    foreach ($visits_a as $v) {
        if ($v == $fcid) {
            $prevFound = true;
            break;
        }
        $prev = $v; 
    }
    return $prev;
}

$helper = $_REQUEST['helper'] ?? ($_POST['helper'] ?? "");

$user_is_patient = 0;
$param_from_session_a = $_SESSION['temp_params_a'] ?? [];
if (count($param_from_session_a)) {
    $param_a = $_SESSION['temp_params_a'];
    $user_is_patient = 1;
}

$message_ready = 0;

if (!isset($form_data_a[$_SESSION['param']['pid']]) || $form_data_a[$_SESSION['param']['pid']] == '') {
    $form_data_a[$_SESSION['param']['pid']] = $param_a['pid'];
    $form_data_a[$_SESSION['param']['praxis_pid']] = $param_a['praxis_pid'];
    $form_data_a[$_SESSION['param']['ext_fcid']] = $param_a['ext_fcid'];
    $form_data_a[$_SESSION['param']['geschlecht']] = $param_a['geschlecht'];
    $form_data_a[$_SESSION['param']['diagnosis']] = $param_a['diagnosis'];
    $form_data_a[$_SESSION['param']['visite']] = $param_a['visite'];
    $form_data_a[$_SESSION['param']['first_visit']] = $param_a['first_visit'];
    $form_data_a[10005020] = $param_a['visite_datum'];

    $status = 'FIRST_INIT';
    // echo "<pre>"; echo print_r($_SESSION['param']); echo "</pre>"; // Krankenhaus: 102400
    $query_add = " AND fid IN (102600,102200,102300,102500,104500,111200,111301,115500,106900,107100,107200,107400,107500,107700,107800,108000,108100,108300,108400,102805,102806,105000,105100,105200,105300,105400,105400,105500,105500,105600,105700,105800,105900,102800,103400,103000,103300,103100,103200,102815,106000,106500,106600,106700,106701,106300,106400,106100,106700,106701,108500,108700,108800,108900,109000,109100,109200,109300,109400,110100,109500,109700,109600,109800,109900,110000,103505,101902,101904,101906,101908,101910,102000)";
    $visits_a = get_visits($db, $form_data_a[$_SESSION['param']['pid']]);
    $pre_visite = get_last_visite($visits_a, $form_data_a[$_SESSION['param']['visite']]);

    if ($pre_visite) {
        $pre_data_a =  get_form_data($db, $fg, $pre_visite, $query_add);
        echo message_box();
        $message_ready = 1;
        // echo "<pre>"; echo print_r($pre_data_a); echo "</pre>";
        foreach ($pre_data_a as $fid => $fcont) {
            $form_data_a[$fid] = $pre_data_a[$fid];
        }
        $pre_data_json = json_encode($pre_data_a);
        $status = 'FOLLOWUP_INIT';
    }
} else {
    $visits_a = get_visits($db, $form_data_a[$_SESSION['param']['pid']]);
    $pre_visite = get_last_visite($visits_a, $fcid);
}
// echo $status;

$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) $header_info = "Patient: " . $form_data_a[$_SESSION['param']['praxis_pid']];
if (isset($param_a['direct']) || isset($param_a['patient'])) $header_info = "&nbsp;&nbsp;Cedur-Nr.: " . $form_data_a[$_SESSION['param']['ext_fcid']];
if (DEBUG) $header_info .= " (" . $fcid . " UID:" . $form_data_a[$_SESSION['param']['pid']] . ", V:" . $form_data_a[$_SESSION['param']['visite']] . ")";

$groesse = $form_data_a[102600] ?? "";
if (!$groesse) $groesse = get_form_field($db, $form_data_a[$_SESSION['param']['pid']], 10003, $_SESSION['param']['groesse']);
// $diagnosis = get_form_field($db, $form_data_a[$_SESSION['param']['pid']], 10003, $_SESSION['param']['diagnosis']);
$diagnosis =  $form_data_a[$_SESSION['param']['diagnosis']];
$gender = $form_data_a[$_SESSION['param']['geschlecht']];


$errors_patient = $form_data_a[101] ?? "";
$errors_medic   = $form_data_a[102] ?? "";

// echo "<br><r><br><br>PRE:" . $pre_visite . " THIS:" . $fcid;
// echo "<br><br><br>D: ".$diagnosis." G:".$groesse. " H:".$helper;
// echo "<br><br><br><pre>"; echo print_r($form_data_a); echo "</pre>";echo "<br><br><br><pre>"; echo print_r($_SESSION); echo "</pre>";