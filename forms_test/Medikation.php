<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$ini_path = $_SESSION['INI-PATH'] ?? "";
if ($ini_path && isset($_SESSION['m_uid'])) require_once $ini_path;
else {
    echo file_get_contents('logout.php');
    // echo "<h2><b>Sie wurden abgemeldet!</b><h3>Scannen Sie Ihren Code erneut ein ...<br><br>oder melden Sie sich bitte über die <a href='../'>Startseite<a> an, wenn Sie über Zugangsdaten verfügen!</h3>";
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
				<div class='row' style='height:0;visibility: collapse;'>
					
                    <div class='col_a' id='SH_90_a'>
                        <div class='desc_f' >pid</div>
                    </div>
                    <div class='col_b' id='SH_90_b'>
                        <input data-fg='10020'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_91_a'>
                        <div class='desc_f' >Praxis-ID</div>
                    </div>
                    <div class='col_b' id='SH_91_b'>
                        <input data-fg='10020'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_92_a'>
                        <div class='desc_f' >Cedur-Nr.</div>
                    </div>
                    <div class='col_b' id='SH_92_b'>
                        <input data-fg='10020'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_93_a'>
                        <div class='desc_f' >VID</div>
                    </div>
                    <div class='col_b' id='SH_93_b'>
                        <input data-fg='10020'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_94_a'>
                        <div class='desc_f' >Baseline</div>
                    </div>
                    <div class='col_b' id='SH_94_b'>
                        <input data-fg='10020'  type='text' id='FF_94' name='FF_94' value="<?php echo htmlspecialchars($form_data_a[94] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_95_a'>
                        <div class='desc_f' >Diagnose</div>
                    </div>
                    <div class='col_b' id='SH_95_b'>
                        <input data-fg='10020'  type='text' id='FF_95' name='FF_95' value="<?php echo htmlspecialchars($form_data_a[95] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_96_a'>
                        <div class='desc_f' >Geschlecht</div>
                    </div>
                    <div class='col_b' id='SH_96_b'>
                        <input data-fg='10020'  type='text' id='FF_96' name='FF_96' value="<?php echo htmlspecialchars($form_data_a[96] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_98_a'>
                        <div class='desc_f' >copy_from</div>
                    </div>
                    <div class='col_b' id='SH_98_b'>
                        <input data-fg='10020'  type='text' id='FF_98' name='FF_98' value="<?php echo htmlspecialchars($form_data_a[98] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_99_a'>
                        <div class='desc_f' >copy_during (not used)</div>
                    </div>
                    <div class='col_b' id='SH_99_b'>
                        <input data-fg='10020'  type='text' id='FF_99' name='FF_99' value="<?php echo htmlspecialchars($form_data_a[99] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_100_a'>
                        <div class='desc_f' >E</div>
                    </div>
                    <div class='col_b' id='SH_100_b'>
                        <input data-fg='10020'  type='text' id='FF_100' name='FF_100' value="<?php echo htmlspecialchars($form_data_a[100] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_10005020_a'>
                        <div class='desc_f' >Visite</div>
                    </div>
                    <div class='col_b' id='SH_10005020_b'>
                        <input data-fg='10020'  type='text' id='FF_10005020' name='FF_10005020' value="<?php echo htmlspecialchars($form_data_a[10005020] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset id='FS_900202200'><legend>Medikation</legend>
					
                    <div class='col_30'>
                        <div class='desc_f' >Typ</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020021' ></span>
                    </div>
                    <div class='col_30'>
                        <select required id='FF_10020021' name='FF_10020021'  onchange='follow_select(this)'><option value=''></option><option value='MP (V)' <?php if (($form_data_a[10020021] ?? '') == 'MP (V)') echo 'selected'; ?>>MP (V)</option><option value='MP (M)' <?php if (($form_data_a[10020021] ?? '') == 'MP (M)') echo 'selected'; ?>>MP (M)</option></select>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Medikamenten-Gruppe</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020020' ></span>
                    </div>
                    <div class='col_30'>
                        <select required id='FF_10020020' name='FF_10020020'  onchange='follow_select(this)'><option value=''>Bitte wählen</option><option value='Anti-Durchfall Mittel' <?php if (($form_data_a[10020020] ?? '') == 'Anti-Durchfall Mittel') echo 'selected'; ?>>Anti-Durchfall Mittel</option><option value='Biologika' <?php if (($form_data_a[10020020] ?? '') == 'Biologika') echo 'selected'; ?>>Biologika</option><option value='Budesonid' <?php if (($form_data_a[10020020] ?? '') == 'Budesonid') echo 'selected'; ?>>Budesonid</option><option value='Cortison-Präparate' <?php if (($form_data_a[10020020] ?? '') == 'Cortison-Präparate') echo 'selected'; ?>>Cortison-Präparate</option><option value='Immunsenker' <?php if (($form_data_a[10020020] ?? '') == 'Immunsenker') echo 'selected'; ?>>Immunsenker</option><option value='Mesalazine' <?php if (($form_data_a[10020020] ?? '') == 'Mesalazine') echo 'selected'; ?>>Mesalazine</option><option value='Schmerzmittel' <?php if (($form_data_a[10020020] ?? '') == 'Schmerzmittel') echo 'selected'; ?>>Schmerzmittel</option><option value='Andere Medikamente' <?php if (($form_data_a[10020020] ?? '') == 'Andere Medikamente') echo 'selected'; ?>>Andere Medikamente</option></select>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Medikament Bezeichnung</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020040' ></span>
                    </div>
                    <div class='col_30'>
                        <select required id='FF_10020040' name='FF_10020040'  onchange='follow_select(this)'><option value=''></option><option value='' <?php if (($form_data_a[10020040] ?? '') == '') echo 'selected'; ?>></option></select>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Schema</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020080' ></span>
                    </div>
                    <div class='col_30'>
                        <select required id='FF_10020080' name='FF_10020080'  onchange='follow_select(this)'><option value=''></option><option value='' <?php if (($form_data_a[10020080] ?? '') == '') echo 'selected'; ?>></option></select>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Dosierung (nur Infliximab)</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020085' ></span>
                    </div>
                    <div class='col_30'>
                        <select required id='FF_10020085' name='FF_10020085'  onchange='follow_select(this)'><option value=''></option><option value='5mg/kg' <?php if (($form_data_a[10020085] ?? '') == '5mg/kg') echo 'selected'; ?>>5mg/kg</option><option value='7,5mg/kg' <?php if (($form_data_a[10020085] ?? '') == '7,5mg/kg') echo 'selected'; ?>>7,5mg/kg</option><option value='10mg/kg' <?php if (($form_data_a[10020085] ?? '') == '10mg/kg') echo 'selected'; ?>>10mg/kg</option><option value='unbekannt' <?php if (($form_data_a[10020085] ?? '') == 'unbekannt') echo 'selected'; ?>>unbekannt</option></select>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Einnahme-Start</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020050'></span>
                    </div>
                    <div class='col_30'>
                       <input data-fg='10020' required type='text' id='FF_10020050' name='FF_10020050' value="<?php echo htmlspecialchars($form_data_a[10020050] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Einnahme-Stop</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020060'></span>
                    </div>
                    <div class='col_30'>
                       <input data-fg='10020'  type='text' id='FF_10020060' name='FF_10020060' value="<?php echo htmlspecialchars($form_data_a[10020060] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f' >Absetzungsgrund</div>
                    </div>
                    <div class='col_30' style='height:24px; color:gray;'>
                        <span id='isp_FF_10020070' ></span>
                    </div>
                    <div class='col_30'>
                        <select  id='FF_10020070' name='FF_10020070'  onchange='follow_select(this)'><option value=''></option><option value='Nebenwirkungen' <?php if (($form_data_a[10020070] ?? '') == 'Nebenwirkungen') echo 'selected'; ?>>Nebenwirkungen</option><option value='Hat nicht gewirkt' <?php if (($form_data_a[10020070] ?? '') == 'Hat nicht gewirkt') echo 'selected'; ?>>Hat nicht gewirkt</option><option value='Hat erst gewirkt, dann aber die Wirkung verloren' <?php if (($form_data_a[10020070] ?? '') == 'Hat erst gewirkt, dann aber die Wirkung verloren') echo 'selected'; ?>>Hat erst gewirkt, dann aber die Wirkung verloren</option><option value='Mein eigener Wunsch' <?php if (($form_data_a[10020070] ?? '') == 'Mein eigener Wunsch') echo 'selected'; ?>>Mein eigener Wunsch</option><option value='Es ging mir gut (Remission)' <?php if (($form_data_a[10020070] ?? '') == 'Es ging mir gut (Remission)') echo 'selected'; ?>>Es ging mir gut (Remission)</option><option value='Operation' <?php if (($form_data_a[10020070] ?? '') == 'Operation') echo 'selected'; ?>>Operation</option><option value='Schwangerschaft' <?php if (($form_data_a[10020070] ?? '') == 'Schwangerschaft') echo 'selected'; ?>>Schwangerschaft</option><option value='Andere' <?php if (($form_data_a[10020070] ?? '') == 'Andere') echo 'selected'; ?>>Andere</option></select>
                    </div>
			</fieldset>
			<fieldset id='FS_99927'><legend></legend>
					<div class='col_100' id='idonly_10003057'></div>
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