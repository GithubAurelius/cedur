<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once $_SESSION['INI-PATH'];
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
					
                    <div class='col_a'>
                        <div class='desc_f' >pid</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Praxis-ID</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Cedur-Nr.</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Visite</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Baseline</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_94' name='FF_94' value="<?php echo htmlspecialchars($form_data_a[94] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Diagnose</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_95' name='FF_95' value="<?php echo htmlspecialchars($form_data_a[95] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >geschlecht</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10030'  type='text' id='FF_96' name='FF_96' value="<?php echo htmlspecialchars($form_data_a[96] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset class=''><legend class=''>Laborergebnisse</legend>
					
                    <div class='col'>
                        <div class='desc_f' >Hämatokrit</div>
                    </div>
                    <div class='col'>
                        <input required type='number' id='FF_110200' name='FF_110200' value="<?php echo htmlspecialchars($form_data_a[110200] ?? ''); ?>" min='15' max='60' step='1' placeholder='in %'>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Calprotectin bestimmt?</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_110300' name='FF_110300'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[110300] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[110300] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_110300_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >größer 50mg/kg</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_110400' name='FF_110400'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[110400] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[110400] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_110400_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Calprotectin Wert</div>
                    </div>
                    <div class='col'>
                        <input  type='number' id='FF_110500' name='FF_110500' value="<?php echo htmlspecialchars($form_data_a[110500] ?? ''); ?>" min='51' max='10000' step='1' placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col'>
                        <div class='desc_f' >Thrombozyten (optional)</div>
                    </div>
                    <div class='col'>
                        <input  type='number' id='FF_110511' name='FF_110511' value="<?php echo htmlspecialchars($form_data_a[110511] ?? ''); ?>" min='0' max='10000' step='0.01' placeholder='in /nl'>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Hämoglobin</div>
                    </div>
                    <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <input  type='number' id='FF_110600' name='FF_110600' value="<?php echo htmlspecialchars($form_data_a[110600] ?? ''); ?>" min='2' max='25' step='0.01' placeholder=''><select id='FF_110602' name='FF_110602'  onchange='follow_select(this)'><option value=''>Bitte Einheit angeben</option><option value='g/dl' <?php if (($form_data_a[110602] ?? '') == 'g/dl') echo 'selected'; ?>>g/dl</option><option value='mmol/l' <?php if (($form_data_a[110602] ?? '') == 'mmol/l') echo 'selected'; ?>>mmol/l</option></select></div>
					
                    <div class='col'>
                        <div class='desc_f' >Ferritin</div>
                    </div>
                    <div class='col'>
                        <input  type='number' id='FF_110700' name='FF_110700' value="<?php echo htmlspecialchars($form_data_a[110700] ?? ''); ?>" min='0' max='10000' step='0.01' placeholder='in ng/ml'>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >CRP bestimmt?</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_110800' name='FF_110800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[110800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[110800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_110800_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >CRP größer 5mg/dl</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_110900' name='FF_110900'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[110900] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[110900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_110900_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >CRP</div>
                    </div>
                    <div class='col'>
                        <input  type='number' id='FF_111000' name='FF_111000' value="<?php echo htmlspecialchars($form_data_a[111000] ?? ''); ?>" min='6' max='1000' step='0.01' placeholder='in mg/l'>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col'>
                        <div class='desc_f' >Albumin (optional)</div>
                    </div>
                    <div class='col'>
                        <input  type='number' id='FF_111100' name='FF_111100' value="<?php echo htmlspecialchars($form_data_a[111100] ?? ''); ?>" min='6' max='1000' step='0.01' placeholder=''>
                    </div>
			</fieldset>
			</fieldset>
			<fieldset class=''><legend class=''>Verlauf Labor</legend>
					<div style='width:100%'><iframe id='<?php echo $fcid?>_labor' style='width:100%;border:0;'></iframe></div>
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