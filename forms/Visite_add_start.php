<?php

if ($_SESSION['m_uid'] == 12025091416255056){
    $temp_a = [];
    $query = "SELECT fcid,usergroup FROM forms_10005 WHERE fid=100 AND fcont='{\"FF_0\":-1}'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $temp_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>"; echo print_r($temp_a); echo "</pre>";
    foreach ($temp_a as $key => $fcid_a) { 
        echo $fcid_a['fcid']." ".$fcid_a['usergroup']."<br>"; 
        $query = "INSERT IGNORE INTO forms_10005 (fcid, fid, fcont, usergroup) VALUES (".$fcid_a['fcid'].", 101, '✔️', ".$fcid_a['usergroup'].");";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $query = "INSERT IGNORE INTO forms_10005 (fcid, fid, fcont, usergroup) VALUES (".$fcid_a['fcid'].", 102, '✅', ".$fcid_a['usergroup'].");";
        $stmt = $db->prepare($query);
        $stmt->execute();    
    }
    // UPDATE `forms_10005` SET fcWHERE fid=100 AND fcont="✓ (OK)"
    // foreach ($arr as $key => $val) { echo "$key : $val <br>"; }
    exit;
}

function get_visits($db, $pid){ // identify first visit for one-time-fields
    $query = "SELECT fcid FROM forms_10005 WHERE fid=90 AND fcont=:pid ORDER BY fcid;";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':pid', $pid);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN); 
    return $res;
}

function is_first_visit($visit_a, $this_fcid){ 
    if (!count($visit_a))  return 1;
    else if ($visit_a[0] == $this_fcid) return 1;
    else return 0;
}

function is_last_visit($visit_a, $this_fcid){ 
    if (!count($visit_a))  return 1;
    else if ($visit_a[count($visit_a)-1] == $this_fcid) return 1;
    else return 0;
}

// Gibt Information zum Status (neu oder existenter DS)
$param_sent = 0;
if ($param_a ?? 0) $param_sent = 1;

$posted = !empty($_POST) ? 1 : 0;

$this_fcid = $form_data_a[$_SESSION['param']['pid']] ?? "";
if (isset($form_data_a[$_SESSION['param']['pid']])) 
    $visit_a = get_visits($db, $form_data_a[$_SESSION['param']['pid']], $fcid);
else 
    $visit_a = [];

$patient_doc_exisits = 0;
$temp_a = get_query_data($db, 'forms_10010',"fcid=" . $fcid);
if (count($temp_a)>0) $patient_doc_exisits = 1;
// echo "<pre>"; echo print_r($temp_a); echo "</pre>";
 
// Nur für Visite Anzeige im Dashbaord: Achtung einfacher Übertrag nach unten funktioniert nicht
$first_visit = "";
$last_visit = "";
if ($this_fcid) {
    $first_visit = is_first_visit($visit_a, $fcid);
    $last_visit = is_last_visit($visit_a, $fcid);
    # echo $this_fcid." FIRST:".$first_visit." LAST:".$last_visit;
}

// params
if (!isset($form_data_a[$_SESSION['param']['pid']]) || $form_data_a[$_SESSION['param']['pid']] ==''){
    $form_data_a[$_SESSION['param']['pid']] = $param_a['pid'];
    $form_data_a[$_SESSION['param']['praxis_pid']] = $param_a['praxis_pid'];
    $form_data_a[$_SESSION['param']['ext_fcid']] = $param_a['ext_fcid'];
    $form_data_a[$_SESSION['param']['geschlecht']] = $param_a['geschlecht'];
    $form_data_a[$_SESSION['param']['diagnosis']] = $param_a['diagnosis']; 
    $form_data_a[$_SESSION['param']['first_visit']] = is_first_visit($visit_a, $this_fcid); // without function
    $form_data_a[93] = json_encode($fcid ?? ""); // Nice to have - not nessecary
}

// fieldset var
$short_diag = "";
$temp_diag = $form_data_a[95] ?? "";

if (!$temp_diag) $temp_diag = $form_data_a[$_SESSION['param']['diagnosis']] ?? "";
if ($temp_diag == "Morbus Crohn") $short_diag = "MC";
    elseif ($temp_diag=="Colitis ulcerosa") $short_diag = "CU";
        elseif ($temp_diag=="Colitis indeterminata") $short_diag = "CI";

$praxis_id = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
$cedur_id   = $form_data_a[$_SESSION['param']['ext_fcid']] ?? "";
$praxis_id = "&nbsp;&nbsp;&nbsp; <img height='16px' src='../forms/images/patient.svg'> Pat.Nr.: ".$praxis_id;
$praxis_id = $praxis_id ." (".$cedur_id.") - ".$short_diag;




// header
$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) $header_info = "Patient: ".$form_data_a[$_SESSION['param']['praxis_pid']];
if (DEBUG) $header_info .= " (UID:".$form_data_a[$_SESSION['param']['pid']].", V:".$fcid.")";
 

//echo "<br><br><br><pre>"; echo print_r($form_data_a); echo "</pre>";
?>
<!-- <span>&nbsp;</span> -->
<!-- dashboard -->
<style> 
    .dashboard-grid {
        margin-top: 8px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
        padding: 10px;
        /* background-color: #f9f9f9;  */
        border-radius: 8px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
        width: 91%;
    }

    .dashboard-tile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        color: #333;
        /* font-size: 0.8em; */
        /* font-weight: 500; */
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        /* max-width: 150px; */
    }

    .dashboard-tile:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-3px);
        border-color: #c0c0c0;
    }

    .dashboard-tile .icon {
        font-size: 2em;
        margin-bottom: 10px;
        color: #007bff;
        transition: color 0.3s ease;

    }


    .dashboard-tile:hover .icon {
        color: #0056b3;
        /* Dunklerer Blauton beim Hover */
    }

    /* Media Queries für Responsivität */
    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 5px;
            padding: 5px;
        }

        .dashboard-tile {
            padding: 5px;
            font-size: 0.8em;
        }

        .dashboard-tile .icon {
            font-size: 1em;
            margin-bottom: 5px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
            /* gap: 5px; */
            padding: 2px;
        }

        .dashboard-tile {
            padding: 2px;
            font-size: 0.8em;
        }

        .dashboard-tile .icon {
            font-size: 1em;
            margin-bottom: 3px;
        }
    }
</style>
<?php if ($form_data_a[10005020] ?? "") { ?>
<div id='dashboard_visite'>
        <div class="dashboard-grid">
            <button class="dashboard-tile" onclick="window.open('<?php echo MIQ_PATH ?>modules/login_token/dlog.php?dlog=' +  btoa(encodeURIComponent(param_str))  )">
                <span class="icon">🖥️</span>
                <span class="text">Praxiszugang</span>
            </button>
            <?php if ($first_visit) { ?>
                <button class="dashboard-tile" onclick="main_form_submit_button.style.display='none';window.top.load_fg_frame(10010, param_a['visite'], param_str, work_frame, '<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Patientenfragebogen.php');  show_all();">
                    <span class="icon">📋</span>
                    <span class="text">Anamnese</span>
                </button>
            <?php } ?>
            <?php if (!$first_visit) { ?>
                <button class="dashboard-tile" onclick="main_form_submit_button.style.display='none';window.top.load_fg_frame(10010, param_a['visite'], param_str, work_frame, '<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Patientenfragebogen.php'); show_all();">
                    <span class="icon">🗣️</span>
                    <span class="text">Befragung</span>
                </button>
            <?php } ?>
            <button id='button_labor' class="dashboard-tile" onclick="main_form_submit_button.style.display='none';window.top.load_fg_frame(10010, param_a['visite'], param_str, work_frame, '<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Patientenfragebogen.php', 'untersuchung');">
                <span class="icon">🩺🧪</span>
                <span class="text">Untersuchung/Labor</span>
            </button>

            <!-- <button class="dashboard-tile" onclick="main_form_submit_button.style.display='none';window.top.load_fg_frame(10010, param_a['visite'], param_str, work_frame, '<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Patientenfragebogen.php', 'labor')">
                <span class="icon">🧪</span>
                <span class="text">Labor</span>
            </button> -->


            <button id='button_med' class="dashboard-tile" onclick="main_form_submit_button.style.display='none';window.top.load_fg_frame(10020, -1, param_str, work_frame, '<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Medikation.php');">
                <span class="icon">💊</span>
                <span class="text">Medikation</span>
            </button>

            <button  id='button_ae' class="dashboard-tile" onclick="main_form_submit_button.style.display='none';window.top.load_fg_frame(10050, -1, param_str, work_frame, '<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Nebenwirkung.php');">
                <span class="icon">🚨</span>
                <span class="text">Nebenwirkung</span>
            </button>
            <button id='print_button' class="dashboard-tile" onclick='printIframe(<?php echo json_encode($fcid) ?>)'>
                <span class="icon">🖨️</span>
                <span class="text">Drucken</span>
            </button>

            <button class="dashboard-tile" style='text-align:left;'>
                <table id="score_table" border="1" style="font-size:11px;width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 3px; text-align: left;">Score</th>
                            <th style="padding: 3px; text-align: left;">Wert</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </button>
            
        </div>
    </div>
<?php }?>


