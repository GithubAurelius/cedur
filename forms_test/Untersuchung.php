<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$ini_path = $_SESSION['INI-PATH'] ?? "";
if ($ini_path) require_once $ini_path;
else {
    echo "<h2><b>Sie wurden abgemeldet!</b><h3>Scannen Sie Ihren Code erneut ein ...<br><br>oder melden Sie sich bitte über die <a href='../'>Startseite<a> an, wenn Sie über Zugangsdaten verfügen!</h3>";
    exit;
}
require_once MIQ_ROOT . "/modules/form_base/form_start.php";

$file_add_start = str_replace(".php", "_add_start.php", "./" . basename(__FILE__));
if (file_exists($file_add_start)) include_once($file_add_start);
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einfaches HTML Formular</title>
    <link rel="stylesheet" href="<? echo MIQ_PATH ?>/css/form_base.css?RAND=<?php echo random_bytes(5); ?>">
    <script src="<? echo MIQ_PATH ?>/modules/form_base/forms.js?RAND=<?php echo random_bytes(5); ?>"></script>
    <style>
        .fixed-header {
            position: fixed;
            top: 0;
            left: 10px;
            right: 20px;
            background-color: #ededed;
            border-bottom: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            /* <== wichtig */
            padding: 5px 10px;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            box-sizing: border-box;
            border-radius: 8px;
            gap: 4px;
            /* Abstand zwischen den Zeilen */
        }

        /* Erste Zeile */
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Sub-Header Zeile */
        .sub-header {
            text-align:center;
            font-size: 11px;
            color: #333;
        }

        /* Bestehende Regeln bleiben gleich */
        .fixed-header button {
            margin-right: 6px;
            padding: 4px 10px;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
        }

        .fixed-header button:hover {
            background-color: lightgreen;
        }

        .header-left,
        .header-right {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .header-right {
            gap: 6px;
        }
    </style>
</head>

<body>

    <!--<button type="button" onClick="window.parent.forward_form('fcid', <?php echo $fcid ?>,'Test1')" >Beispiel weiterführendes Formular</button>-->
    <!--<button type="button" onClick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>?fg=<?= $fg ?>&fcid=' + getCid()" >NEU</button>-->

    <div class="fixed-header">
        <div class="header-row">
            <div class="header-left">
                <?php $a_log = $_REQUEST['a_log'] ?? $_POST['a_log'] ?? ''; ?>
                <?php if ($a_log == 1) { ?>
                    <button id='logoff_form' onclick="document.location.href ='<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'login.php' ?>'">Abmelden</button>
                <?php } ?>
                <strong><?php echo $header_info ?></strong>&nbsp;
            </div>
            <div class="header-right" id="submit_span">
                <button id='main_form_submit_button' onclick='document.main_form.submit()'>💾Speichern</button>
                <button type='button' id='main_form_submit_new_button' style='display:none'>💾Speichern und ➕Neu</button>
            </div>
        </div>
        <div class="sub-header">
            <label id="status" class="hintlabel"></label>
        </div>
    </div>
    <div style='margin-bottom:57px;'>
    </div>
    <table width='100%'>
        <tr>
            <td width='99%' valign='top'>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id='main_form' name='main_form'
                    enctype="multipart/form-data">
                    <div>
                        <input type="hidden" id="FF_10" name="FF_10" value="<?php echo $_SESSION['m_uid'] ?>">
                        <input type="hidden" id="FF_20" name="FF_20" value="<?php echo $_SESSION['user_group'] ?>">
                        <input type="hidden" id="fcid" name="fcid" value="<?php echo $fcid ?>">
                        <input type="hidden" id="fg" name="fg" value="<?php echo $fg ?>">
                        <input type="hidden" id="a_log" name="a_log" value="<?php echo $a_log ?>">
                        <input type="hidden" id="opener_num" name="opener_num" value="<?php echo $opener_num ?>">
                        <input type="hidden" id="helper" name="helper">
                        <input type="hidden" id="errors" name="errors">
                        <input type="hidden" id="param_str" name="param_str">
                    </div>
                    <creator>
				<div class='row' style='height:0;visibility: collapse;'>
					
                    <div class='col_a' id='SH_90_a'>
                        <div class='desc_f' >pid</div>
                    </div>
                    <div class='col_b' id='SH_90_b'>
                        <input data-fg='10040'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_91_a'>
                        <div class='desc_f' >Praxis-ID</div>
                    </div>
                    <div class='col_b' id='SH_91_b'>
                        <input data-fg='10040'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_92_a'>
                        <div class='desc_f' >Cedur-Nr.</div>
                    </div>
                    <div class='col_b' id='SH_92_b'>
                        <input data-fg='10040'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_93_a'>
                        <div class='desc_f' >Visite</div>
                    </div>
                    <div class='col_b' id='SH_93_b'>
                        <input data-fg='10040'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_94_a'>
                        <div class='desc_f' >Baseline</div>
                    </div>
                    <div class='col_b' id='SH_94_b'>
                        <input data-fg='10040'  type='text' id='FF_94' name='FF_94' value="<?php echo htmlspecialchars($form_data_a[94] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_95_a'>
                        <div class='desc_f' >Diagnose</div>
                    </div>
                    <div class='col_b' id='SH_95_b'>
                        <input data-fg='10040'  type='text' id='FF_95' name='FF_95' value="<?php echo htmlspecialchars($form_data_a[95] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_96_a'>
                        <div class='desc_f' >geschlecht</div>
                    </div>
                    <div class='col_b' id='SH_96_b'>
                        <input data-fg='10040'  type='text' id='FF_96' name='FF_96' value="<?php echo htmlspecialchars($form_data_a[96] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset id='FS_'><legend>Körperliche Untersuchung</legend>
					
                    <div class='col_a' id='SH_115600_a'>
                        <div class='desc_f' >Augenbeteiligung (Iris, Uveitis)</div>
                    </div>
                    <div class='col_b' id='SH_115600_b'>
                        <select required id='FF_115600' name='FF_115600'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[115600] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[115600] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_115700_a'>
                        <div class='desc_f' >Körpertemperatur über 37,8°C</div>
                    </div>
                    <div class='col_b' id='SH_115700_b'>
                        <select required id='FF_115700' name='FF_115700'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[115700] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[115700] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_115800_a'>
                        <div class='desc_f' >Erythema nodosum, Pyoderma gangraenosum, Stomatitis aphtosa</div>
                    </div>
                    <div class='col_b' id='SH_115800_b'>
                        <select required id='FF_115800' name='FF_115800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[115800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[115800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_115900_a'>
                        <div class='desc_f' >Gelenkschmerzen / Arthritis</div>
                    </div>
                    <div class='col_b' id='SH_115900_b'>
                        <select required id='FF_115900' name='FF_115900'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[115900] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[115900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_116000_a'>
                        <div class='desc_f' >Resistenz im Abdomen</div>
                    </div>
                    <div class='col_b' id='SH_116000_b'>
                        <select required id='FF_116000' name='FF_116000'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[116000] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[116000] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Fraglich' <?php if (($form_data_a[116000] ?? '') == 'Fraglich') echo 'selected'; ?>>Fraglich</option>
                        </select>
                    </div>
					<div class='col_100 infotext'  id='SH_'><div id='choose_all_untersuchung' class='aref_button' style='text-align:center'><button type='button'>alle Befunde negativ (hier klicken)</button></div></div>
			</fieldset>
			<fieldset id='FS_'><legend>Verlauf Untersuchung</legend>
					<div style='width:100%'><iframe id='<?php echo $fcid?>_untersuchung' style='width:100%;border:0;'></iframe></div>
			</fieldset></creator>
                </form>
            </td>
            <td id='<? echo $fg ?>_td_sidebar' valign='top'></td>
        </tr>
    </table>
    <script>
        var errors = 0;
        eL_load_select_logic();
    </script>
    <?php
    require_once MIQ_ROOT . "/modules/form_base/form_end.php";
    $file_add_end = str_replace(".php", "_add_end.php", "./" . basename(__FILE__));
    if (file_exists($file_add_end)) include_once($file_add_end);
    ?>
    <script>
        eL_check_numbers();
        eL_check_required_fields();
        // let winbox_id = parent.window.thisbox_elem.id;
        if (window.opener);
        else try {
            parent.document.getElementById('<?php echo $opener_num ?>_reload').click()
        } catch (e) {};
        get_field_ids('<?php echo MIQ_PATH ?>/modules/form_base/');
        eL_uploads();
        eL_upload_info_button();
        eL_input_change();
        eL_radio_uncheck();
        eL_form_submit();
        
    </script>




</body>

</html>