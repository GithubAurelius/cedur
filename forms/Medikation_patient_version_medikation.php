<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once $_SESSION['INI-PATH'];

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

function get_medication_ext_fcids($db, $pid, $visite)
{   // extra - only Biologika und immunsenker'
    $fcid_a = [];
    $query = "SELECT * FROM forms_10020 WHERE fid=93 and fcont='" . $visite . "'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (count($fcid_a)) {
        $query = "SELECT * FROM forms_10020 WHERE fid=90 and fcont='" . $pid . "' AND fcid IN (" . implode(',', $fcid_a) . ")";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($fcid_a)) {
            $query = "SELECT * FROM forms_10020 WHERE fid=10020021 and fcont<>'V' AND fcid IN (" . implode(',', $fcid_a) . ")";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
            if (count($fcid_a)) {
                $query = "SELECT * FROM forms_10020 WHERE fid=10020020 and (fcont='Biologika' OR fcont='Immunsenker') AND fcid IN (" . implode(',', $fcid_a) . ")";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
        }
    }
    return $fcid_a;
}

function get_medication_fcids($db, $pid, $visite)
{
    $fcid_a = [];
    $query = "SELECT fcid FROM forms_10020 WHERE fid=93 and fcont='" . $visite . "'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (count($fcid_a)) {
        $query = "SELECT fcid FROM forms_10020 WHERE fid=90 and fcont='" . $pid . "' AND fcid IN (" . implode(',', $fcid_a) . ")";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($fcid_a)) {
            $query = "SELECT fcid FROM forms_10020 WHERE fid=10020021 AND (fcont != 'V' AND fcont!='MP (V)') AND fcid IN (" . implode(',', $fcid_a) . ")";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        if (count($fcid_a)) {
            $query = "SELECT * FROM forms_10020 WHERE fid=10020060 AND fcont IS NOT NULL AND fcid IN (" . implode(',', $fcid_a) . ")";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $fcid_delete_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        if (count($fcid_delete_a) > 0 && count($fcid_a) > 0) {
            $fcid_a = array_flip($fcid_a);
            foreach ($fcid_delete_a as $key => $fcid_to_del) {
                unset($fcid_a[$fcid_to_del]);
            }
            $fcid_a = array_flip($fcid_a);
        }
    }
    return $fcid_a;
}

function get_medication($db, $pid)
{
    $query = "SELECT fcid FROM forms_10020 WHERE fid=90 and fcont='" . $pid . "'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $med_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (count($med_a)) {
        $query = "SELECT fcid,fid,fcont FROM forms_10020 WHERE fid NOT IN (99, 100) AND fcid IN (" . implode(',', $med_a) . ")";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $med_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $pre_med_fcid_a = [];
    foreach ($med_a as $key => $val_a) {
        $fid = $val_a['fid'] ?? "";
        if ($fid == 10020021) {
            $fcont = $val_a['fcont'];
            if ($fcont == 'V' || $fcont == 'MP (V)') $pre_med_fcid_a[$val_a['fcid']] = 1;
        }
    }
    
    if ($_SESSION['m_uid'] == 1) {}
    
    $fcid_a = [];
    $med2fid_a = [];
    foreach ($med_a as $key => $data_a) {
        if ( !isset($pre_med_fcid_a[$data_a['fcid']])){
            $med2fid_a[$data_a['fcid']][$data_a['fid']]  = $data_a;
            $fcid_a[$data_a['fcid']] = 1;
        }
    }
    $fcid_a = array_keys($fcid_a);
    return [$fcid_a, $med2fid_a];
}

function build_med_block($fcid, $med_data_a)
{
    global $visite, $aktuelles_visite_datum;
    $readonly = '';  // TODO: to many lines readonly
    $disabled = '';
    $bgcolor = '#fcfcfc';
    $is_previste_med = $med_data_a[$fcid][10020021] ?? "";
    echo "<pre>"; echo print_r($_SESSION['rl']); echo "</pre>";
    if ($is_previste_med) {
        $readonly = ' readonly';
        $disabled = ' disabled';
        $bgcolor = '#f9fae1';
    }
    $html_str = "
    
    <div class='medikament-block' style='display: flex; flex-wrap: wrap; border-radius: 4px; background-color: " . $bgcolor . "; border-bottom: 1px solid #ddd; margin-bottom: -5px; padding: 2px;'>
        <?php  $fcid = (int) (date('YmdHis') . substr(microtime(true), 11, 2));  ?>
        <input type='hidden' id='fcid' name='fcid' value='" . $fcid . "'>
        <div class='col_23'>
            <input" . $readonly . " type='text' id='FF_10020040_" . $fcid . "' name='FF_10020040_" . $fcid . "' list='med_suggestions' placeholder='Medikament eingeben' value='" . ($med_data_a[$fcid][10020040] ?? '') . "'>
        </div>
        <div class='col_23'>
            <select" . $disabled . " id='FF_10020050_" . $fcid . "' name='FF_10020050_" . $fcid . "'></select>
            <script>
                fillYearSelect('FF_10020050_" . $fcid . "', 1950, 'this_year', true, false, " . json_encode($med_data_a[$fcid][10020050] ?? '') . ");
            </script>
        </div>
        <div class='col_23 back_img'>
           <select  id='FF_10020080_" . $fcid . "' name='FF_10020080_" . $fcid . "'><option value=''></option></select>
        </div>
        <div class='col_23'>
            <select id='FF_10020060_" . $fcid . "' name='FF_10020060_" . $fcid . "'></select>
            <script>
                fillYearSelect('FF_10020060_" . $fcid . "', 1950, 'this_year', true, false, " . json_encode($med_data_a[$fcid][10020060] ?? '') . ");
            </script>
        </div>
        <div class='col_8'>";
    if (count($med_data_a) == 0) {
        $html_str .= "
            <div style='padding-bottom:3px'>
                <button class='med_buttons' id='button_add_" . $fcid . "' type='button' onclick='addMedikamentBlock()'><svg xmlns='http://www.w3.org/2000/svg'  height='20px' width='20px' viewBox='0 -960 960 960' fill='#35a800ff'><path d='M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z'/></svg></button>
             </div>";
    }
    $html_str .= "
        </div>
    </div>";
    $viste_form_med_data = $med_data_a[$fcid][93] ?? "";
    $fcid_copied = $med_data_a[$fcid][98] ?? "";
    if ($visite == $viste_form_med_data && $fcid_copied) {
    }
    $html_str .= "";
    // if ($is_previste_med) $html_str .= "<hr>";
    return $html_str;
}




//  if ($is_previste_med) $html_str .= "
//        

//  <div style='display: flex; flex-wrap: wrap; border-radius: 4px; background-color: #fcfcfc; border-bottom: 1px solid #ddd; margin-bottom: -5px; padding: 2px;'>
//                 <br><div class='col_23 desc_f'>Medikament</div>
//                 <div class='col_23 desc_f'>Einnahme-Start</div>
//                 <div class='col_23 desc_f'>Dosierung</div>
//                 <div class='col_23 desc_f'>Nur, falls abgesetzt</div>
//                 <div class='col_8 desc_f' style='display:none'></div>
//             </div>

$fg = 10020;
$medtype = $_REQUEST['medtype'] ?? "";
$param_str = $_REQUEST['param_str'] ?? "";
if ($param_str) {
    $param_str_decoded = urldecode(base64_decode($param_str));
    $param_a = json_decode($param_str_decoded, true);
    // echo "<pre>"; echo print_r($param_a); echo "</pre>";
}
$patient_active = $_SESSION['temp_params_a']['pid'] ?? "";
if ($patient_active) $param_a = $_SESSION['temp_params_a'];


$pid = $param_a['pid'] ?? "";
$visite = $param_a['visite'] ?? "";

$aktuelles_visite_datum = "";
if (count($param_a) > 0)
    $aktuelles_visite_datum = $param_a['visite_datum'] ?? "";

$visits_a = get_visits($db, $pid);
$last_viste_fcid = get_last_visite($visits_a, $visite);

// echo "AKT:" . $visite . " LAST:" . $last_viste_fcid;

$workflow_echo = 0; // Ausgabe der Aktionen

# $fcid_a = get_medication_fcids($db, $pid, $visite);

$mixex_a = get_medication($db, $pid);
$fcid_a = $mixex_a[0];
$all_med_a = $mixex_a[1];



function transform_to_formdata($arr)
{
    $trans_a = [];
    if (count($arr) > 0) {
        foreach ($arr as $fid => $fid_a) $trans_a[$fid] = $fid_a['fcont'];
    }
    return $trans_a;
}


// Aktuelle Visite untersuchen, gibt es schon Daten?
$fcid_a = [];
foreach ($all_med_a as $med_fcid => $med_a) {
    if ($med_a[93]['fcont'] == $visite) $fcid_a[] = $med_fcid;
}



$med_data_a = [];
$pre_visite_med_fcid_a = [];
if (count($fcid_a)) {
    // Es gibt schon Daten also hole alle fcid Mediaktionen der aktuellen Viste   
    if ($workflow_echo) echo "<br>Medikation bereits vorhanden, also laden";
    if ($workflow_echo) echo "<br>" . show_a($fcid_a);
    foreach ($fcid_a as $fcid) {
        $med_data_a[$fcid] = transform_to_formdata($all_med_a[$fcid]);
        if ($workflow_echo) echo "<br>" . show_a($med_data_a);
    }
} else { // es gibt noch keine Daten also Vorvisite holen
    if ($workflow_echo) echo "<br>Keine Medikationsdaten in aktueller Visite => vorherige Visite abfragen:";
    // echo "<br>Visite:$visite<br>Last Visite:$last_viste_fcid";
    foreach ($all_med_a as $med_fcid => $med_a) {
        $med_a_visit = $med_a[93]['fcont'];
        $med_a_stop = trim($med_a[10020060]['fcont'] ?? "");
        if ($med_a_visit == $last_viste_fcid)
            if (!$med_a_stop) $pre_visite_med_fcid_a[] = $med_fcid;
    }

    if (count($pre_visite_med_fcid_a) > 0) {
        $pre_med_data_a = [];
        foreach ($pre_visite_med_fcid_a as $premed_fcid) {
            $pre_med_data_a[$premed_fcid] = transform_to_formdata($all_med_a[$premed_fcid]);
            $pre_med_data_a[$premed_fcid][93] = (string)$visite;
            $pre_med_data_a[$premed_fcid][98] = $premed_fcid;
            $pre_med_data_a[$premed_fcid][10020021] = 'FF';
            $pre_med_data_a[$premed_fcid][10005020] = $aktuelles_visite_datum;
        }
        if (count($pre_med_data_a) > 0) {
            $fcid_new = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
            $fcid_a = [];
            foreach ($pre_med_data_a as $premed_fcid => $single_prev_med_a) {
                // echo "<pre>"; echo print_r($single_prev_med_a); echo "</pre>";
                $fcid_new += 1;
                $fcid_a[] = $fcid_new;
                foreach ($single_prev_med_a as $fid => $fcont) {
                    if ($workflow_echo) echo "<br>$fcid_new: $fid => $fcont";
                    ins_or_rep_form('', $db, $fg, $fcid_new, '', $fid, $fcont);
                }
                $med_data_a[$fcid_new] = $single_prev_med_a;
                if ($workflow_echo) echo "<br>" . show_a($med_data_a);
            }
        }
    }
}
// else {
//     if ($workflow_echo) echo "<br>Keine Medikationsdaten in aktueller Visite => vorherige Visite abfragen:";
//     $visits_a = get_visits($db, $pid);
//     $last_viste_fcid = get_last_visite($visits_a, $visite);
//     // echo "Copy:<pre>"; echo print_r($visits_a); echo "</pre>";
//     if ($workflow_echo) echo "<br>Visite:$visite<br>Last Visite:$last_viste_fcid";
//     $pre_visite_med_fcid_a = get_medication_fcids($db, $pid, $last_viste_fcid);
//     if ($workflow_echo) echo "<br>" . show_a($pre_visite_med_fcid_a);
//     if ($workflow_echo) echo "<br>Medikation Vorvisite";
//     $pre_med_data_a = [];
//     foreach ($pre_visite_med_fcid_a as $premed_fcid) {
//         $pre_med_data_a[$premed_fcid] = get_form_data($db, $fg, $premed_fcid);
//         if ($workflow_echo) echo "Replace last_viste with visit";
//         $pre_med_data_a[$premed_fcid][93] = (string)$visite;
//         if ($workflow_echo) echo " ... and build copy:";
//         $pre_med_data_a[$premed_fcid][98] = $premed_fcid;
//         $pre_med_data_a[$premed_fcid][10020021] = 'FF';
//     }
//     if ($workflow_echo) echo "<br>" . show_a($pre_med_data_a);

//     if ($workflow_echo) echo "<br>Neue fcids erstellen und Kopie einfügen:";
//     $fcid_new = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
//     $fcid_a = [];
//     foreach ($pre_med_data_a as $premed_fcid => $single_prev_med_a) {
//         $fcid_new += 1;
//         $fcid_a[] = $fcid_new;
//         if ($workflow_echo) echo "<br>$fcid_new";
//         foreach ($single_prev_med_a as $fid => $fcont) {
//             if ($workflow_echo) echo "<br>$fcid_new: $fid => $fcont";
//             if ($fid == 10005020) $fcont = $aktuelles_visite_datum;
//             // ins_or_rep_form('', $db, $fg, $fcid_new, '', $fid, $fcont);
//         }
//         $med_data_a[$fcid_new] = $single_prev_med_a;
//         if ($workflow_echo) echo "<br>" . show_a($med_data_a);
//     }
// }



?>
<!DOCTYPE html>
<html lang="de" style='padding:0'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einfaches HTML Formular</title>
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>/css/form_base.css?RAND=<?php echo random_bytes(5); ?>">
    <script src="<?php echo MIQ_PATH ?>/modules/form_base/forms.js?RAND=<?php echo random_bytes(5); ?>"></script>
    <script src="<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'forms/' ?>Medikation_defs.js?RAND=<?php echo random_bytes(5); ?>"></script>
    <style>
        .back_img {
            background-image: url(../forms/images/ohne_dosis_tr.png);
            background-size: 90px;
            background-repeat: no-repeat;
            background-position: center center;
        }


        .med_buttons {
            display: inline-block;
            min-width: 100%;
            /* depends on number buttons */
            max-width: 100%;
            /* min-width: 30px;  */
            /* padding: 5px 5px;  */
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f8f8f8;
            cursor: pointer;
        }

        .med_buttons:hover {
            background-color: lightpink;
        }



        .col_23 {
            width: 23%;
            line-height: 12px;
            padding: 1px;
            box-sizing: border-box;
            /* justify-content: flex-end; */
        }

        .col_8 {
            display: flex;
            /* Macht den Container zu einem Flex-Container */
            flex-direction: column;
            /* Ordnet die Items spaltenweise an */
            justify-content: flex-end;/ margin-top: auto;
            width: 8%;
            /* line-height: 12px;
            padding: 5px;
            box-sizing: border-box;
            display: block;
            padding-top: 10px;
            flex-wrap: wrap; */
            /* justify-content: flex-end; */
        }

        .desc_f {
            color: dimgray;
            display: block;
            font-size: 13px;

            font-weight: bold;
        }

        @media (max-width: 600px) {
            .col_20 {
                width: calc(100% - 10px);
                margin-left: 0;
                margin-right: 0;
            }
        }
    </style>
    <script>
        function noth_to_do() {}

        function check_simple(input_one, input_two) {
            if (input_one.value) {
                input_two.style.backgroundColor = '#fdd6d6';
                error_a[input_two.id] = 1;
            } else {
                input_two.style.backgroundColor = '';
                error_a[input_two.id] = 0;
            }
        }

        function stop_med(stopval, block) {
            const stopval_field = document.getElementById(stopval);
            const block_field = document.getElementById(block);

            if (stopval_field) {
                stopval_field.addEventListener('change', () => {
                    // console.log(stopval_field.id + "=" + stopval_field.value);
                    if (stopval_field.value === 'Ja') block_field.style.display = 'flex';
                    else block_field.style.display = 'none';
                });
            }
        }

        function sendHeightToParent(frameId) {
            const height = document.body.scrollHeight + 20;
            parent.postMessage({
                type: 'setHeight',
                frameId: frameId,
                height: height
            }, '*');
        }

        function auto_fill_med(fcid) {
            let med_to_group = {};
            let all_meds = [];

            val_med_select2_a.forEach(([gruppe, medString]) => {
                const meds = medString.split("|").map(m => m.trim());
                meds.forEach(med => {
                    med_to_group[med] = gruppe;
                    all_meds.push(med);
                });
            });

            const datalist = document.getElementById("med_suggestions");

            function fillSuggestions() {
                datalist.innerHTML = "";
                const sortedValues = all_meds.sort();
                sortedValues.forEach(med => {
                    const opt = document.createElement("option");
                    opt.value = med;
                    datalist.appendChild(opt);
                });
            }
            fillSuggestions();

            const inputs = document.querySelectorAll(`input[id^="FF_10020040_"]`);
            inputs.forEach(input => {
                input.setAttribute("list", "med_suggestions");

                input.addEventListener("input", () => {
                    const val = input.value.trim();
                    if (val.length < 2) return;

                    const matchingGroup = val_med_select2_a.find(([group]) =>
                        group.toLowerCase() === val.toLowerCase()
                    );

                    // Optional: gruppenspezifische Reaktion hier ergänzen
                });
            });
        }

        function getWirkgruppenForMedikament(medikament) {
            const result = [];
            val_med_select2_a.forEach(([wirkgruppe, medikamenteString]) => {
                const medikamente = medikamenteString.split("|").map(m => m.trim().toLowerCase());
                if (medikamente.includes(medikament.toLowerCase())) {
                    result.push(wirkgruppe);
                }
            });
            return result;
        }

        function addMedikamentBlock() {
            const original = document.querySelector('.medikament-block:last-of-type'); // letzter Block
            const clone = original.cloneNode(true);
            const newFcid = getCid();


            // IDs und Names aktualisieren
            clone.querySelectorAll('[id], [name]').forEach(el => {
                if (el.id) el.id = el.id.replace(/_\d+$/, '_' + newFcid);
                if (el.name) el.name = el.name.replace(/_\d+$/, '_' + newFcid);
                if (el.tagName === 'INPUT' || el.tagName === 'SELECT') el.value = '';
            });

            // Alten Button entfernen
            const oldButton_add_Div = original.querySelector('[id^="button_add_"]');
            if (oldButton_add_Div) {
                oldButton_add_Div.remove();
            }
            const oldButton_exit_Div = original.querySelector('[id^="button_exit_"]');
            if (oldButton_exit_Div) {
                oldButton_exit_Div.remove();
            }

            // Füge neuen Block ein
            original.parentNode.appendChild(clone);

            // Fülle Jahr-Selects
            // fillYearSelect('FF_10020050_' + newFcid, 1950, 'this_year', true, false);
            // fillYearSelect('FF_10020060_' + newFcid, 1950, 'this_year', true, false);
            compare_dates('FF_10020050_' + newFcid, 'FF_10020060_' + newFcid, '<=');

            const input = document.getElementById('FF_10020040_' + newFcid);
            input.addEventListener("input", () => {
                const val = input.value.trim();
                if (val.length < 2) return;
                const matchingGroup = val_med_select2_a.find(([group]) => group.toLowerCase() === val.toLowerCase());
            });

            const medID = 'FF_10020040_' + newFcid;
            const date = document.getElementById('FF_10020050_' + newFcid);
            const dosID = 'FF_10020080_' + newFcid;
            const select2 = document.getElementById(medID);
            const select3 = document.getElementById(dosID);
            select2.addEventListener('change', () => {
                updateSelect3(select2, select3, null);
                check_simple(select2, date);
                noth_to_do();
            });
            check_simple(select2, date);
            updateSelect3(select2, select3, null);
            date.addEventListener('change', () => {
                check_if_empty(date);
                noth_to_do();
            });
            select3.addEventListener('change', () => {
                check_if_empty(select3);
                noth_to_do();
            });
            compare_dates('FF_10020050_' + newFcid, 'FF_10020060_' + newFcid, '<=');

            add_change_listener(newFcid);
            sendHeightToParent(frame_id);
            // window.addEventListener('load', sendHeightToParent);
            // window.addEventListener('resize', sendHeightToParent);
        }

        function add_change_listener(fcid) {
            let selector = "[id$=_" + fcid + "]";
            let allMatchingInputs = document.querySelectorAll(selector);
            // console.log(allMatchingInputs);
            allMatchingInputs.forEach(element => {
                element.addEventListener('change', function() {
                    // console.log(`fcid: ${fcid} fg: ${fg} fid: ${element.id.split('_')[1]} val: ${element.value}`);
                    let fid = element.id.split('_')[1];
                    parent.window.fetchDataAndUpdateForm(fcid, fg, fid, element.value);
                    if (fid == 10020040) parent.window.fetchDataAndUpdateForm(fcid, fg, 10020020, getWirkgruppenForMedikament(element.value));
                    if (!(fcid in fcid_is_isset)) {
                        fcid_is_isset[fcid] = 1;
                        const medtype_field = document.getElementById('FF_10020021_' + fcid);
                        if (medtype_field) {
                            if (medtype_field.value != '') medtype = medtype_field.value;
                        }
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 10020021, medtype);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 90, param_a['pid']);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 93, param_a['visite']);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 91, param_a['praxis_pid']);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 92, param_a['ext_fcid']);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 95, param_a['diagnosis']);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 96, param_a['geschlecht']);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 10, document.getElementById('FF_10').value);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 20, document.getElementById('FF_20').value);
                        parent.window.fetchDataAndUpdateForm(fcid, fg, 10005020, <?= json_encode($aktuelles_visite_datum) ?>);
                        // console.log("type set");
                        // console.table(param_a);
                    }
                    // event.stopPropagation();
                    // event.preventDefault();r
                });
            });
        }

        function fillSelect(selectEl, values, selectedValue = null) {
            selectEl.innerHTML = '<option value="">Bitte wählen</option>';
            values.forEach(v => {
                // if (!v.includes(not_include)) { // Diagnose ist wichtig
                const opt = document.createElement('option');
                v = v.trim();
                opt.value = v;
                opt.textContent = v;
                if (v === selectedValue) opt.selected = true;
                selectEl.appendChild(opt);
                // }
            });
        }

        function updateSelect3(select2, select3, savedDoseVal = null) {
            const med = select2.value;
            const match = val_med_select3_a.find(entry => entry[0] === med);
            const doses = match ? match[1].split('|') : [];
            if (doses.length === 0) select3.style.display = 'none';
            else {
                select3.style.display = 'inline';
                check_simple(select2, select3);
            }
            fillSelect(select3, doses, savedDoseVal);
        }
    </script>
</head>

<body>
    <input type='hidden' id='pid' name='pid' value='<?php echo $pid ?>'>
    <input type='hidden' id='visite' name='visite' value='<?php echo $visite ?>'>
    <input type='hidden' id='fg' name='fg' value='<?php echo $fg ?>'>
    <input type='hidden' id='medtype' name='medtype' value='<?php echo $medtype ?>'>
    <input type="hidden" id="FF_10" name="FF_10" value="<?php echo $_SESSION['m_uid'] ?>">
    <input type="hidden" id="FF_20" name="FF_20" value="<?php echo $_SESSION['user_group'] ?>">
    <input type="hidden" id="FF_91" name="FF_91" value="<?php echo $pid ?>">

    <datalist id="med_suggestions"></datalist>
    <div style="display: flex; flex-wrap: wrap; border-radius: 4px; background-color: #fcfcfc; border-bottom: 1px solid #ddd; margin-bottom: -5px; padding: 2px;">
        <br>
        <div class="col_23 desc_f">Medikament</div>
        <div class="col_23 desc_f">Einnahme-Start</div>
        <div class="col_23 desc_f">Dosierung</div>
        <div class="col_23 desc_f">Nur, falls abgesetzt</div>
        <div class="col_8 desc_f" style='display:none'></div>
    </div>

    <?php
    // LOAD DATA
    if (count($fcid_a)) {
        foreach ($fcid_a as $fcid) {
            echo build_med_block($fcid, $med_data_a); // previsit_med_data_a
            echo "<script>
                    savedDose_" . json_encode($fcid) . " = " . json_encode($med_data_a[$fcid][10020080] ?? "") . ";
                    const date_" . json_encode($fcid) . " = document.getElementById('FF_10020050_" . json_encode($fcid) . "'); 
                    const select2_" . json_encode($fcid) . " = document.getElementById('FF_10020040_" . json_encode($fcid) . "'); 
                    const select3_" . json_encode($fcid) . " = document.getElementById('FF_10020080_" . json_encode($fcid) . "'); 
                    select2_" . json_encode($fcid) . ".addEventListener('change', () => {
                        updateSelect3(select2_" . json_encode($fcid) . ", select3_" . json_encode($fcid) . ", 'null');
                        check_simple(select2_" . json_encode($fcid) . ", date_" . json_encode($fcid) . ");
                        noth_to_do();
                    });
                    
                    check_simple(select2_" . json_encode($fcid) . ", date_" . json_encode($fcid) . ");
                    updateSelect3(select2_" . json_encode($fcid) . ", select3_" . json_encode($fcid) . ", savedDose_" . json_encode($fcid) . ");
                    date_" . json_encode($fcid) . ".addEventListener('change', () => { check_if_empty(date_" . json_encode($fcid) . ");noth_to_do(); });
                    select3_" . json_encode($fcid) . ".addEventListener('change', () => { check_if_empty(select3_" . json_encode($fcid) . ");noth_to_do(); });
                    // check_if_empty(select2_" . json_encode($fcid) . ");
                    if (select3_" . json_encode($fcid) . ".length>1) check_if_empty(select3_" . json_encode($fcid) . ");
                    if (select2_" . json_encode($fcid) . ".value) check_if_empty(date_" . json_encode($fcid) . ");
                    compare_dates('FF_10020050_" . json_encode($fcid) . "','FF_10020060_" . json_encode($fcid) . "', '<=');
                    add_change_listener(" . json_encode($fcid) . ");   
                </script>";
        };
        echo  "<hr><div  style='line-height:20px;padding:3px;background-color:#f9fae1'>⚠️ Die oben angezeigte Medikation entstammt der aktuellen Verodnung bzw. letzten Dokumentation. Bitte überprüfen Sie sorgfältig die <strong>Dosierung und aktualisieren Sie diese bitte</strong>. Falls Sie das Medikament inzwischen abgesetzt haben, geben Sie bitte das Datum des Absetzens ein. Sollte sich Ihre Medikation seitdem geändert haben, können Sie Ihre aktuellen Medikamente im Feld unterhalb dieses Textes eintragen.</div><hr>";
    }
    $fcid = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
    echo build_med_block($fcid, []);
    // echo $fcid;
    // echo "<pre>"; echo print_r($med_data_a); echo "</pre>";
    ?>

    <script>
        // const pid = document.getElementById('pid').value;
        // const visite = document.getElementById('visite').value;
        // const fg = document.getElementById('fg').value;

        const param_a = {};
        param_a['pid'] = <?php echo json_encode($param_a['pid'] ?? ""); ?>;
        param_a['visite'] = <?php echo json_encode($param_a['visite'] ?? ""); ?>;
        param_a['praxis_pid'] = <?php echo json_encode($param_a['praxis_pid'] ?? ""); ?>;
        param_a['ext_fcid'] = <?php echo json_encode($param_a['ext_fcid'] ?? ""); ?>;
        param_a['diagnosis'] = <?php echo json_encode($param_a['diagnosis'] ?? ""); ?>;
        param_a['geschlecht'] = <?php echo json_encode($param_a['geschlecht'] ?? ""); ?>;
        // console.table(param_a);


        // Initial load - dynamic fcid for each medication in addMedikamentBlock()
        // Erster block ohne Daten
        const fg = 10020;

        const medtype = document.getElementById('medtype').value;
        const frame_id = (medtype === 'V') ? 'vormedikation' : 'medikation';
        // window.frameElement.id // alternativ

        let fcid_is_isset = [];
        let fcid = <?php echo json_encode($fcid ?? "") ?>;
        auto_fill_med(fcid);
        add_change_listener(fcid);

        const medID = 'FF_10020040_' + fcid;
        const date = document.getElementById('FF_10020050_' + fcid);
        const date_stop = document.getElementById('FF_10020060_' + fcid);
        const dosID = 'FF_10020080_' + fcid;
        const select2 = document.getElementById(medID);
        const select3 = document.getElementById(dosID);
        select2.addEventListener('change', () => {
            updateSelect3(select2, select3, null);
            check_simple(select2, date);
            noth_to_do();
        });
        check_simple(select2, date);
        updateSelect3(select2, select3, null);
        date.addEventListener('change', () => {
            check_if_empty(date);
            noth_to_do();
        });
        select3.addEventListener('change', () => {
            check_if_empty(select3);
            noth_to_do();
        });
        compare_dates(date.id, date_stop.id, '<=');

        error_a = watchObject(error_a, (obj, prop, value) => {
            parent.postMessage({
                type: 'error_med_ready',
                value: JSON.stringify(obj)
            }, '*');
        });
        // initial on load
        parent.postMessage({
            type: 'error_med_ready',
            value: JSON.stringify(error_a)
        }, '*');


        // init and repeat in addMedikamentBlock
        sendHeightToParent(frame_id);
        window.addEventListener('load', () => sendHeightToParent(frame_id));
        window.addEventListener('resize', () => sendHeightToParent(frame_id));

        const background_field_save = 0;
    </script>

</body>

</html>