<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
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
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datenerfassung</title>
    <?php
    $file_add_start = str_replace(".php", "_add_start.php", "./" . basename(__FILE__));
    if (file_exists($file_add_start)) include_once($file_add_start);
    ?>
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>/css/form_base.css?RAND=<?php echo random_bytes(5); ?>">
    <script src="<?php echo MIQ_PATH ?>/modules/form_base/forms.js?RAND=<?php echo random_bytes(5); ?>"></script>
    <style>
        #header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 35px;
            background-color: #ededed;
            border-bottom: 1px solid #ccc;
            border-radius: 6px 6px 0 0;
            display: flex;
            flex-direction: column;
            /* <== wichtig */
            padding: 5px 10px;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            box-sizing: border-box;
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
        #sub_header {
            position: fixed;
            top: 36px;
            left: 0;
            right: 0;
            color: white;
            z-index: 999;
            height: 20px;
            transition: top 0.3s;
            text-align: center;
            font-size: 11px;
            color: #333;
            border-radius: 6px;
        }

        /* Bestehende Regeln bleiben gleich */
        #fixed-header button {
            margin-right: 6px;
            padding: 4px 10px;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
        }

        #fixed-header button:hover {
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

        #main_tab {
            width: 99%;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!--<button type="button" onClick="window.parent.forward_form('fcid', <?php echo $fcid ?>,'Test1')" >Beispiel weiterführendes Formular</button>-->
    <!--<button type="button" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?fg=<?php echo $fg ?>&fcid=' + getCid()" >NEU</button>-->

    <div id='header'>
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
    </div>
    <div id='sub_header'>
        <label id="status" class="hintlabel"></label>
    </div>

    <table id='main_tab'>
        <tr>
            <td width='99%' valign='top'>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id='main_form' name='main_form'
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
			<fieldset id='FS_'><legend>Module</legend>
				<div class='row'>
					
                    <div class='col_a' id='SH_99901000_a'>
                        <div class='desc_f' >Modultyp</div>
                    </div>
                    <div class='col_b' id='SH_99901000_b'>
                        <input data-fg='99901'  type='text' id='FF_99901000' name='FF_99901000' value="<?php echo htmlspecialchars($form_data_a[99901000] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901001_a'>
                        <div class='desc_f' >Modulnummer (fg)</div>
                    </div>
                    <div class='col_b' id='SH_99901001_b'>
                        <input data-fg='99901'  type='text' id='FF_99901001' name='FF_99901001' value="<?php echo htmlspecialchars($form_data_a[99901001] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901002_a'>
                        <div class='desc_f' >Modulname</div>
                    </div>
                    <div class='col_b' id='SH_99901002_b'>
                        <input data-fg='99901'  type='text' id='FF_99901002' name='FF_99901002' value="<?php echo htmlspecialchars($form_data_a[99901002] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901003_a'>
                        <div class='desc_f' >Formular-Bezeichnung /Form-Link</div>
                    </div>
                    <div class='col_b' id='SH_99901003_b'>
                        <input data-fg='99901'  type='text' id='FF_99901003' name='FF_99901003' value="<?php echo htmlspecialchars($form_data_a[99901003] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901004_a'>
                        <div class='desc_f' >Listen-Bezeichnung</div>
                    </div>
                    <div class='col_b' id='SH_99901004_b'>
                        <input data-fg='99901'  type='text' id='FF_99901004' name='FF_99901004' value="<?php echo htmlspecialchars($form_data_a[99901004] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901010_a'>
                        <div class='desc_f' >Positionierung FORM</div>
                    </div>
                    <div class='col_b' id='SH_99901010_b'>
                        <input data-fg='99901'  type='text' id='FF_99901010' name='FF_99901010' value="<?php echo htmlspecialchars($form_data_a[99901010] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901011_a'>
                        <div class='desc_f' >Positionierung LIST</div>
                    </div>
                    <div class='col_b' id='SH_99901011_b'>
                        <input data-fg='99901'  type='text' id='FF_99901011' name='FF_99901011' value="<?php echo htmlspecialchars($form_data_a[99901011] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901012_a'>
                        <div class='desc_f' >limit</div>
                    </div>
                    <div class='col_b' id='SH_99901012_b'>
                        <input data-fg='99901'  type='text' id='FF_99901012' name='FF_99901012' value="<?php echo htmlspecialchars($form_data_a[99901012] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901015_a'>
                        <div class='desc_f' >url</div>
                    </div>
                    <div class='col_b' id='SH_99901015_b'>
                        <input data-fg='99901'  type='text' id='FF_99901015' name='FF_99901015' value="<?php echo htmlspecialchars($form_data_a[99901015] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901016_a'>
                        <div class='desc_f' >Daten anlegen/ url-query</div>
                    </div>
                    <div class='col_b' id='SH_99901016_b'>
                        <input data-fg='99901'  type='text' id='FF_99901016' name='FF_99901016' value="<?php echo htmlspecialchars($form_data_a[99901016] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901017_a'>
                        <div class='desc_f' >Work Mode</div>
                    </div>
                    <div class='col_b' id='SH_99901017_b'>
                        <input data-fg='99901'  type='text' id='FF_99901017' name='FF_99901017' value="<?php echo htmlspecialchars($form_data_a[99901017] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901018_a'>
                        <div class='desc_f' >Winbox-Options</div>
                    </div>
                    <div class='col_b' id='SH_99901018_b'>
                        <input data-fg='99901'  type='text' id='FF_99901018' name='FF_99901018' value="<?php echo htmlspecialchars($form_data_a[99901018] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99901019_a'>
                        <div class='desc_f' >Multiple-Open</div>
                    </div>
                    <div class='col_b' id='SH_99901019_b'>
                        <input data-fg='99901'  type='text' id='FF_99901019' name='FF_99901019' value="<?php echo htmlspecialchars($form_data_a[99901019] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</fieldset></creator>
                </form>
            </td>
            <td id='<?php echo $fg ?>_td_sidebar' valign='top'></td>
        </tr>
    </table>
    <?php
    require_once MIQ_ROOT . "/modules/form_base/form_end.php";
    $file_add_end = str_replace(".php", "_add_end.php", "./" . basename(__FILE__));
    if (file_exists($file_add_end)) include_once($file_add_end);
    ?>
    <script>
        // eL_check_numbers();
        // let winbox_id = parent.window.thisbox_elem.id;
        if (window.opener);
        else try {
            parent.document.getElementById('<?php echo $opener_num ?>_reload').click()
        } catch (e) {};
        get_field_ids('<?php echo MIQ_PATH ?>/modules/form_base/');
        // eL_uploads();
        // eL_upload_info_button();
        // eL_input_change();
        // eL_radio_uncheck();
        // eL_form_submit();
    </script>



    <div id='lock-layer' class='lock-layer-hidden'></div>
</body>

</html>