<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once $_SESSION['INI-PATH'];

function get_pre_medication_fcids($db, $pid, $visite)
{
    $fcid_a = [];
    $query = "SELECT * FROM forms_10020 WHERE fid=90 AND fcont='".$pid."'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (!empty($fcid_a)) {
        $query = "SELECT * FROM forms_10020 WHERE fid=93 AND fcont='".$visite."' AND fcid IN (".implode(',', $fcid_a).")";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (!empty($fcid_a)) {
            $query = "SELECT * FROM forms_10020 WHERE fid=10020021 AND (fcont='V' OR fcont='MP (V)') AND fcid IN (".implode(',', $fcid_a).")";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $fcid_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
    }
    return $fcid_a;
}

function build_med_block($fcid, $med_data_a)
{
    $html_str = "
    <div class='medikament-block' style='display: flex; flex-wrap: wrap; border-radius: 4px; background-color: #fcfcfc; border-bottom: 1px solid #ddd; margin-bottom: -5px; padding: 2px;'>
        <?php
        $fcid = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
        ?>
        <input type='hidden' id='fcid' name='fcid' value='" . $fcid . "'>
        <div class='col_23'>
            <input type='text' id='FF_10020040_" . $fcid . "' name='FF_10020040_" . $fcid . "' list='med_suggestions' placeholder='Medikament eingeben' value='" . ($med_data_a[$fcid][10020040] ?? '') . "'>
        </div>
        <div class='col_23'>
            <select id='FF_10020050_" . $fcid . "' name='FF_10020050_" . $fcid . "'></select>
            <script>
                fillYearSelect('FF_10020050_" . $fcid . "', 1950, 'this_year', true, false, " . json_encode($med_data_a[$fcid][10020050] ?? '') . ");
            </script>
        </div>
            <div class='col_23'>
                <select id='FF_10020060_" . $fcid . "' name='FF_10020060_" . $fcid . "'></select>
                    <script>
                        fillYearSelect('FF_10020060_" . $fcid . "', 1950, 'this_year', true, false, " . json_encode($med_data_a[$fcid][10020060] ?? '') . ");
                    </script>
            </div>
            <div class='col_23'>
               
                    <select id='FF_10020070_" . $fcid . "' name='FF_10020070_" . $fcid . "' >";
    if ($med_data_a[$fcid][10020070] ?? '')
        $html_str .= "<option selected value='" . $med_data_a[$fcid][10020070] . "'>" . $med_data_a[$fcid][10020070] . "</option>";
    $html_str .= "<option value=''>Bitte auswählen</option>
                                    <option value='Nebenwirkungen'>Nebenwirkungen</option>
                                    <option value='Hat nicht gewirkt'>Hat nicht gewirkt</option>
                                    <option value='Hat erst gewirkt, dann aber die Wirkung verloren'>Hat erst gewirkt, dann aber die Wirkung verloren</option>
                                    <option value='Mein eigener Wunsch'>Mein eigener Wunsch</option>
                                    <option value='Es ging mir gut (Remission)'>Es ging mir gut (Remission)</option>
                                    <option value='Operation'>Operation</option>
                                    <option value='Schwangerschaft'>Schwangerschaft</option>
                                    <option value='Andere'>Andere</option>            
                        </select>
            </div>
       
        <div class='col_8'>";
    if (count($med_data_a) == 0) {
        $html_str .= "<div style='padding-bottom:3px'>
                        <button class='med_buttons' id='button_add_" . $fcid . "' type='button' onclick='addMedikamentBlock()'><svg xmlns='http://www.w3.org/2000/svg'  height='20px' width='20px' viewBox='0 -960 960 960' fill='#35a800ff'><path d='M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z'/></svg></button>
                    </div>";
    }
    $html_str .= "
        </div>
    </div><hr>";
    return $html_str;
}



$fg = 10020;
$medtype = $_REQUEST['medtype'] ?? "";
$param_str = $_REQUEST['param_str'] ?? "";
if ($param_str) {
    $param_str_decoded = urldecode(base64_decode($param_str));
    $param_a = json_decode($param_str_decoded, true);
    //echo "<pre>"; echo print_r($param_a); echo "</pre>";
}


$aktuelles_visite_datum = "";
if (count($param_a)>0)
    $aktuelles_visite_datum = $param_a['visite_datum'] ?? "";


$patient_active = $_SESSION['temp_params_a']['pid'] ?? "";
if ($patient_active) $param_a = $_SESSION['temp_params_a'];

$pid = $param_a['pid'] ?? "";
$visite = $param_a['visite'] ?? "";


// TEST
// $medtype = "V";
// $pid = 2025072415311646;
// $visite = 2025072415340155;

$fcid_a = get_pre_medication_fcids($db, $pid, $visite);
// echo "<pre>"; echo print_r($fcid_a); echo "</pre>";
$med_data_a = [];
foreach ($fcid_a as $fcid) {
    $med_data_a[$fcid] = get_form_data($db, $fg, $fcid);
}
// echo "<pre>";echo print_r($fcid_a);echo "</pre>";

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
            padding: 3px;
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
                    if (stopval_field.value === 'Ja') {
                        block_field.style.display = 'flex';
                        // sendHeightToParent(frame_id);
                    } else block_field.style.display = 'none';
                });
            }
        }

        function sendHeightToParent(frameId) {
            const height = document.body.scrollHeight + 20;
            // console.log(height);
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

        function getCid() {
            // let date = new Date();
            // date.setHours(date.getHours() + 1); 
            // return parseInt(date.toISOString().split('.')[0].replace(/[^0-9]/g, '')); // .split('.')[0] Micros
            let date = new Date();
            date.setHours(date.getHours() + 2);
            let base = date.toISOString().split('.')[0].replace(/[^0-9]/g, '');
            let ms = String(date.getMilliseconds()).padStart(3, '0').slice(0, 2);
            return (base + ms); // parseInt
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
            fillYearSelect('FF_10020050_' + newFcid, 1950, 'this_year', true, false);
            fillYearSelect('FF_10020060_' + newFcid, 1950, 'this_year', true, false);
            compare_dates('FF_10020050_' + newFcid, 'FF_10020060_' + newFcid, '<=');
            stop_med('FF_10020055_' + newFcid, 'B_' + newFcid);
            // document.getElementById('B_' + newFcid).style.display = 'none';

            const input = document.getElementById('FF_10020040_' + newFcid);
            input.addEventListener("input", () => {
                const val = input.value.trim();
                if (val.length < 2) return;
                const matchingGroup = val_med_select2_a.find(([group]) => group.toLowerCase() === val.toLowerCase());
            });
            add_change_listener(newFcid);

            const medID = 'FF_10020040_' + newFcid;
            const date = document.getElementById('FF_10020050_' + newFcid);
            const date_stop = document.getElementById('FF_10020060_' + newFcid);
            const select2 = document.getElementById(medID);
            const drop = document.getElementById('FF_10020070_' + newFcid);
            select2.addEventListener('change', () => {
                check_simple(select2, date);
                check_simple(select2, date_stop);
                check_simple(select2, drop);
                noth_to_do();
            });
            check_simple(select2, date);
            check_simple(select2, date_stop);
            check_simple(select2, drop);
            date.addEventListener('change', () => {
                check_if_empty(date);
                noth_to_do();
            });
            date_stop.addEventListener('change', () => {
                check_if_empty(date_stop);
                noth_to_do();
            });
            drop.addEventListener('change', () => {
                check_if_empty(drop);
                noth_to_do();
            });
            compare_dates(date.id, date_stop.id, '<=');


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
                    // event.preventDefault();
                });
            });
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
        <div class="col_23 desc_f">Medikament</div>
        <div class="col_23 desc_f">Einnahme-Start</div>
        <div class="col_23 desc_f">Einnahme-Stop</div>
        <div class="col_23 desc_f">Absetzungsgrund</div>
    </div>

    <?php
    // LOAD DATA
    if (count($fcid_a)) {
        foreach ($fcid_a as $fcid) {
            echo build_med_block($fcid, $med_data_a);
            echo "<script>
                        

                        medID = 'FF_10020040_" . json_encode($fcid) . "';
                        date_" . json_encode($fcid) . " = document.getElementById('FF_10020050_" . json_encode($fcid) . "');
                        date_stop_" . json_encode($fcid) . " = document.getElementById('FF_10020060_" . json_encode($fcid) . "');
                        select2_" . json_encode($fcid) . " = document.getElementById(medID);
                        drop_" . json_encode($fcid) . " = document.getElementById('FF_10020070_" . json_encode($fcid) . "');
                        select2_" . json_encode($fcid) . ".addEventListener('change', () => {
                            check_simple(select2_" . json_encode($fcid) . ", date_" . json_encode($fcid) . ");
                            check_simple(select2_" . json_encode($fcid) . ", date_stop_" . json_encode($fcid) . ");
                            check_simple(select2_" . json_encode($fcid) . ", drop_" . json_encode($fcid) . ");
                            noth_to_do();
                        });
                        check_simple(select2_" . json_encode($fcid) . ", date_" . json_encode($fcid) . ");
                        check_simple(select2_" . json_encode($fcid) . ", date_stop_" . json_encode($fcid) . ");
                        check_simple(select2_" . json_encode($fcid) . ", drop_" . json_encode($fcid) . ");
                        date_" . json_encode($fcid) . ".addEventListener('change', () => {
                            compare_dates(date_" . json_encode($fcid) . ".id, date_stop_" . json_encode($fcid) . ".id, '<=');
                            check_if_empty(date_" . json_encode($fcid) . ");
                            noth_to_do();
                        });
                        date_stop_" . json_encode($fcid) . ".addEventListener('change', () => {
                            compare_dates(date_" . json_encode($fcid) . ".id, date_stop_" . json_encode($fcid) . ".id, '<=');
                            check_if_empty(date_stop_" . json_encode($fcid) . ");
                            noth_to_do();
                        });
                        drop_" . json_encode($fcid) . ".addEventListener('change', () => {
                            check_if_empty(drop_" . json_encode($fcid) . ");
                            noth_to_do();
                        });
                        
                        if (select2_" . json_encode($fcid) . ".value.trim()){
                            check_if_empty(date_" . json_encode($fcid) . ");
                            check_if_empty(date_stop_" . json_encode($fcid) . ");
                            check_if_empty(drop_" . json_encode($fcid) . ");
                        }

                        add_change_listener(" . json_encode($fcid) . ");





                        compare_dates('FF_10020050_" . $fcid . "', 'FF_10020060_" . $fcid . "', '<=');
                </script>";
        }
    }
    $fcid = (int) (date('YmdHis') . substr(microtime(true), 11, 2)) + rand(333, 666);
    echo build_med_block($fcid, []);
    // echo $fcid;
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

        const fg = 10020;

        const medtype = document.getElementById('medtype').value;
        const frame_id = (medtype === 'V') ? 'vormedikation' : 'medikation';
        // window.frameElement.id // alternativ

        // Initial load - dynamic fcid for each medication in addMedikamentBlock()
        let fcid_is_isset = [];
        let fcid = <?php echo json_encode($fcid ?? "") ?>;

        // stop_med('FF_10020055_' + fcid, 'B_' + fcid);
        auto_fill_med(fcid);
        add_change_listener(fcid);

        const medID = 'FF_10020040_' + fcid;
        const date = document.getElementById('FF_10020050_' + fcid);
        const date_stop = document.getElementById('FF_10020060_' + fcid);
        const select2 = document.getElementById(medID);
        const drop = document.getElementById('FF_10020070_' + fcid);
        select2.addEventListener('change', () => {
            check_simple(select2, date);
            check_simple(select2, date_stop);
            check_simple(select2, drop);
            noth_to_do();
        });
        check_simple(select2, date);
        check_simple(select2, date_stop);
        check_simple(select2, drop);
        date.addEventListener('change', () => {
            check_if_empty(date);
            noth_to_do();
        });
        date_stop.addEventListener('change', () => {
            check_if_empty(date_stop);
            noth_to_do();
        });
        drop.addEventListener('change', () => {
            check_if_empty(drop);
            noth_to_do();
        });
        compare_dates(date.id, date_stop.id, '<=');   

        error_a = watchObject(error_a, (obj, prop, value) => {
            parent.postMessage({
                type: 'error_premed_ready',
                value: JSON.stringify(obj)
            }, '*');
        });
        // initial on load
        parent.postMessage({
            type: 'error_premed_ready',
            value: JSON.stringify(error_a)
        }, '*');

        sendHeightToParent(frame_id);
        window.addEventListener('load', () => sendHeightToParent(frame_id));
        window.addEventListener('resize', () => sendHeightToParent(frame_id));

        const background_field_save = 0;
    </script>

</body>

</html>