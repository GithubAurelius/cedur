
<?php
// $db, $form_data_a[$_SESSION['param']['pid']], 10020, 10020040 
function get_all_patient_medications($db, $pid, $fg, $fid)
{
    $query = "SELECT fcid FROM forms_10020 WHERE fid = 90 AND fcont ='" . $pid . "'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $med_a = [];
    if (!empty($fcid_a)) {
        $query = "SELECT fcont FROM forms_10020 WHERE fid = 10020040 AND fcont <> '' AND fcid IN (" . implode(',', $fcid_a) . ") ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $med_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    return $med_a;
}

// main_form_submit_new_button
$posted_param_str = $_POST['param_str'] ?? "";
if ($posted_param_str) {
    $param_str = urldecode(base64_decode($posted_param_str));
    $param_a = json_decode($param_str, true);
    echo "<script>window.location.href = window.location.origin + window.location.pathname + '?saveandnew=1&param_str=" . $posted_param_str . "';</script>";
}
$saveandnew = $_REQUEST['saveandnew'] ?? "";
if ($saveandnew) {
    $form_data_a[10] = $_SESSION['m_uid'];
    $form_data_a[20] = $_SESSION['user_group'];
    $fcid = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
    $fg = 10050;
}

if (!isset($form_data_a[$_SESSION['param']['pid']]) || $form_data_a[$_SESSION['param']['pid']] == '') {
    $form_data_a[$_SESSION['param']['pid']] = $param_a['pid'];
    $form_data_a[$_SESSION['param']['praxis_pid']] = $param_a['praxis_pid'];
    $form_data_a[$_SESSION['param']['ext_fcid']] = $param_a['ext_fcid'];
    $form_data_a[$_SESSION['param']['geschlecht']] = $param_a['geschlecht'];
    $form_data_a[$_SESSION['param']['diagnosis']] = $param_a['diagnosis'];
    $form_data_a[$_SESSION['param']['visite']] = $param_a['visite'];
    $form_data_a[$_SESSION['param']['first_visit']] = $param_a['first_visit'];;
}


$helper = $_POST['helper'] ?? "";
$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) $header_info = "Patient: " . $form_data_a[$_SESSION['param']['praxis_pid']];
if (DEBUG) $header_info .= " (UID:" . $form_data_a[$_SESSION['param']['pid']] . ", V:" . $form_data_a[$_SESSION['param']['visite']] . ")";


$med_given_a = get_all_patient_medications($db, $form_data_a[$_SESSION['param']['pid']], 10020, 10020040);
$med_given_a = array_flip($med_given_a);
$med_given_a = array_flip($med_given_a);
// Index zurücksetzen
$med_given_a = array_values($med_given_a); // Auswahl für die Medikatinsliste
$med_val = $form_data_a[10050180] ?? "";   // Aktuell im Datensatz asugewähltes Medikament
// echo "<pre>"; echo print_r($med_given_a); echo "</pre>".$med_val;