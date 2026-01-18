<?php

function ins_or_rep_form_X($ts, $db, $fg, $fcid, $muid, $usergroup, $fid, $fcont)
{
    global $db_audit, $old_form_data_a;
    $ts = date("Y-m-d H:i:s");
    if (!$muid) $muid = $_SESSION['uid'];
    if (!$muid) $muid = $_SESSION['m_uid'];
    if (!$muid) $muid = $_SESSION['uid'];

    try {
        if (trim($fcont ?? '') == '') $fcont = NULL;

        // Direktes Insert oder Update in einem Schritt
        $sql = "
                INSERT INTO forms_$fg (fcid, muid, fid, fcont, usergroup, mts)
                VALUES (:fcid, :muid, :fid, :fcont, :usergroup, :mts)
                ON DUPLICATE KEY UPDATE
                    muid = VALUES(muid),
                    fcont = VALUES(fcont),
                    usergroup = VALUES(usergroup),
                    mts = VALUES(mts)
            ";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':fcid'      => $fcid,
            ':muid'      => $muid,
            ':fid'       => $fid,
            ':fcont'     => $fcont,
            ':usergroup' => $usergroup,
            ':mts'       => $ts
        ]);
        if ($fid != 10003040) $res = $stmt->execute(); // EMAIL-FIELD not saved

        $old_fcont = $old_form_data_a[$fid] ?? NULL;
        if ($fcont !== $old_fcont) {
            if ($fid != 100) {
                $sql = "INSERT INTO forms_audit (fg,fcid,muid,fid,fcont,usergroup,mts)
                            VALUES (:fg,:fcid,:muid,:fid,:fcont,:usergroup,:mts)";
                $stmt = $db_audit->prepare($sql);
                $stmt->execute([
                    ':fg'        => $fg,
                    ':fcid'      => $fcid,
                    ':muid'      => $muid,
                    ':fid'       => $fid,
                    ':fcont'     => $fcont,
                    ':usergroup' => $usergroup,
                    ':mts'       => $ts
                ]);
            }
        }
        return 1;
    } catch (Exception $e) {
        return 0; // $e->getMessage()
    }
}

function formatDateFlexible($input) {
    // Prüfung auf dd.mm.yyyy (z.B. 18.01.2026)
    if (preg_match('/^(\d{2})\.(\d{2})\.(\d{4})$/', $input, $matches)) {
        return $matches[3] . '-' . $matches[2] . '-' . $matches[1];
    }
    // Prüfung auf mm.yyyy (z.B. 01.2026)
    if (preg_match('/^(\d{2})\.(\d{4})$/', $input, $matches)) {
        return $matches[2] . '-' . $matches[1];
    }
    // Wenn kein Format passt, den Input einfach zurückgeben
    return $input;
}

// main_form_submit_new_button
$posted_param_str = $_POST['param_str'] ?? "";
if ($posted_param_str) {
    // $param_str = urldecode(base64_decode($posted_param_str));
    // $param_a = json_decode($param_str, true);
    echo "<script>window.location.href = window.location.origin + window.location.pathname + '?saveandnew=1&param_str=" . $posted_param_str . "';</script>";
}
$saveandnew = $_REQUEST['saveandnew'] ?? "";
if ($saveandnew) {
    $form_data_a[10] = $_SESSION['m_uid'];
    $form_data_a[20] = $_SESSION['user_group'];
    $fcid = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
    $fg = 10020;
}


if (!isset($form_data_a[10020021])) $form_data_a[10020021] = "MP";

if (!isset($form_data_a[$_SESSION['param']['pid']]) || $form_data_a[$_SESSION['param']['pid']] == '') {
    $form_data_a[$_SESSION['param']['pid']] = $param_a['pid'];
    $form_data_a[$_SESSION['param']['praxis_pid']] = $param_a['praxis_pid'];
    $form_data_a[$_SESSION['param']['ext_fcid']] = $param_a['ext_fcid'];
    $form_data_a[$_SESSION['param']['geschlecht']] = $param_a['geschlecht'];
    $form_data_a[$_SESSION['param']['diagnosis']] = $param_a['diagnosis'];
    $form_data_a[$_SESSION['param']['visite']] = $param_a['visite'];
    $form_data_a[$_SESSION['param']['first_visit']] = $param_a['first_visit'];;
    if (!isset($form_data_a[10020021])) $form_data_a[10020021] = "MP";
}

if ($_SESSION['m_uid'] == 1) {
    // echo "<b><br><br><br>IMPORT started";
    // $vist_data_a = [];
    // $all_data = get_query_data($db, 'forms_10005', 'fid=10005020');
    // foreach ($all_data as $key => $val_a)  $vist_data_a[$val_a['fcid']] = $val_a['fcont'];
    // // echo "<pre>"; echo print_r($vist_data_a); echo "</pre>";
    // $all_data = get_query_data($db, 'forms_10020', 'fid=93');
    // foreach ($all_data as $key => $val_a) {
    //     if (isset($vist_data_a[$val_a['fcont']])) {
    //         $med_data_a[$val_a['fcid']]['fcont'] = $vist_data_a[$val_a['fcont']];
    //         $med_data_a[$val_a['fcid']]['usergroup'] = $val_a['usergroup'];
    //     }
    // }
    // foreach ($med_data_a as $key => $va_a) 
    //     ins_or_rep_form_X("", $db, 10020, $key, 1, $va_a['usergroup'], 10005020, $va_a['fcont']);
    // echo "<b>... IMPORT finished!";
}


if ( ($form_data_a[10020050] ?? "") )
    $form_data_a[10020050] = formatDateFlexible($form_data_a[10020050]);

$temp_a = get_query_data($db, 'forms_10005', 'fcid= ' . $form_data_a[$_SESSION['param']['visite']] . ' AND fid=10005020');
if (count($temp_a) > 0) {
    $visite_date = $temp_a[0]['fcont'];
    $form_data_a[10005020] = $visite_date;
    // echo "<br><br><br><br>XXX:".$visite_date;
}

$short_diag = "";
$temp_diag = $form_data_a[$_SESSION['param']['diagnosis']] ?? "";
if ($temp_diag == "Morbus Crohn") $short_diag = "MC";
elseif ($temp_diag == "Colitis ulcerosa") $short_diag = "CU";
elseif ($temp_diag == "Colitis indeterminata") $short_diag = "CI";


$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";

if ($new_header) $header_info = "Patient: " . $form_data_a[$_SESSION['param']['praxis_pid']] . "- " . $short_diag;
//if (DEBUG) $header_info .= " (UID:".$form_data_a[$_SESSION['param']['pid']].", V:".$form_data_a[$_SESSION['param']['visite']].")";


$change_status = $form_data_a[10020021] ?? "";
if (!$change_status) $form_data_a[10020021] = 'MP';
else {
    if (substr_count($change_status, 'FF')) $form_data_a[10020021] = 'MP (FF)';
    if (substr_count($change_status, 'V'))  $form_data_a[10020021] = 'MP (V)';
    if ($change_status == 'M' || substr_count($change_status, '(M)'))  $form_data_a[10020021] = 'MP (M)';
}
$diagnosis = $form_data_a[$_SESSION['param']['diagnosis']];
$not_include = "";
if ($diagnosis == 'Colitis indeterminata')  $not_include = "- CI";
if ($diagnosis == 'Morbus Crohn')       $not_include = "- CU";
if ($diagnosis == 'Colitis ulcerosa')   $not_include = "- MC";

if ($diagnosis == '') echo "<script>alert('Das Medikationssystem funktioniert nicht korrekt ohne Angabe der Diagnose!')</script>";


// echo "<pre>"; echo print_r($_POST); echo "</pre>";
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
<div id='medication_tabs' class="tabs">
    <div class="tab-buttons">
        <button type="button" class="tab-button active" data-tab="tab1" id='visite_tab'>Medikation</button>
        <button type="button" class="tab-button" data-tab="tab2">Biologika</button>
        <button type="button" class="tab-button" data-tab="tab3">Immunsenker</button>
        <button type="button" class="tab-button" data-tab="tab4">Mesalazin</button>
        <button type="button" class="tab-button" data-tab="tab5">Budesonid</button>
        <button type="button" class="tab-button" data-tab="tab6">Cortison</button>
        <button type="button" class="tab-button" data-tab="tab7">Diarrhoe</button>
        <button type="button" class="tab-button" data-tab="tab8">Schmerzmittel</button>
        <button type="button" class="tab-button" data-tab="tab9">Andere</button>
    </div>
    <div class="tab-content active" id="tab1">
        <iframe id='_Medikation' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab2">
        <iframe id='_Biologika' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab3">
        <iframe id='_Immunsenker' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab4">
        <iframe id='_Mesalazin' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab5">
        <iframe id='_Budesonid' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab6">
        <iframe id='_Cortison' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab7">
        <iframe id='_Diarrhoe' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab8">
        <iframe id='_Schmerzmittel' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab9">
        <iframe id='_Andere' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>

</div>