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
                        <input data-fg='10050'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_91_a'>
                        <div class='desc_f' >Praxis-ID</div>
                    </div>
                    <div class='col_b' id='SH_91_b'>
                        <input data-fg='10050'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_92_a'>
                        <div class='desc_f' >Cedur-Nr.</div>
                    </div>
                    <div class='col_b' id='SH_92_b'>
                        <input data-fg='10050'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_93_a'>
                        <div class='desc_f' >VID</div>
                    </div>
                    <div class='col_b' id='SH_93_b'>
                        <input data-fg='10050'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_94_a'>
                        <div class='desc_f' >Baseline</div>
                    </div>
                    <div class='col_b' id='SH_94_b'>
                        <input data-fg='10050'  type='text' id='FF_94' name='FF_94' value="<?php echo htmlspecialchars($form_data_a[94] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_95_a'>
                        <div class='desc_f' >Diagnose</div>
                    </div>
                    <div class='col_b' id='SH_95_b'>
                        <input data-fg='10050'  type='text' id='FF_95' name='FF_95' value="<?php echo htmlspecialchars($form_data_a[95] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_96_a'>
                        <div class='desc_f' >Geschlecht</div>
                    </div>
                    <div class='col_b' id='SH_96_b'>
                        <input data-fg='10050'  type='text' id='FF_96' name='FF_96' value="<?php echo htmlspecialchars($form_data_a[96] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_100_a'>
                        <div class='desc_f' >E</div>
                    </div>
                    <div class='col_b' id='SH_100_b'>
                        <input data-fg='10050'  type='text' id='FF_100' name='FF_100' value="<?php echo htmlspecialchars($form_data_a[100] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset id='FS_98561'><legend>Nebenwirkung</legend>
					
                    <div class='col'>
                        <div class='desc_f' >Nebenwirkung-Gruppe</div>
                    </div>
                    <div class='col'>
                        <select required id='FF_10050020' name='FF_10050020'  onchange='follow_select(this)'><option value=''>Bitte wählen</option><option value='Allergische Reaktion' <?php if (($form_data_a[10050020] ?? '') == 'Allergische Reaktion') echo 'selected'; ?>>Allergische Reaktion</option><option value='Atemwege' <?php if (($form_data_a[10050020] ?? '') == 'Atemwege') echo 'selected'; ?>>Atemwege</option><option value='Auge' <?php if (($form_data_a[10050020] ?? '') == 'Auge') echo 'selected'; ?>>Auge</option><option value='Gastrointestinal' <?php if (($form_data_a[10050020] ?? '') == 'Gastrointestinal') echo 'selected'; ?>>Gastrointestinal</option><option value='Haut- und Anhangsgebilde' <?php if (($form_data_a[10050020] ?? '') == 'Haut- und Anhangsgebilde') echo 'selected'; ?>>Haut- und Anhangsgebilde</option><option value='Herz-Kreislaufsystem' <?php if (($form_data_a[10050020] ?? '') == 'Herz-Kreislaufsystem') echo 'selected'; ?>>Herz-Kreislaufsystem</option><option value='Hormonsystem' <?php if (($form_data_a[10050020] ?? '') == 'Hormonsystem') echo 'selected'; ?>>Hormonsystem</option><option value='Hämatologisch' <?php if (($form_data_a[10050020] ?? '') == 'Hämatologisch') echo 'selected'; ?>>Hämatologisch</option><option value='Infektionen' <?php if (($form_data_a[10050020] ?? '') == 'Infektionen') echo 'selected'; ?>>Infektionen</option><option value='Malignome' <?php if (($form_data_a[10050020] ?? '') == 'Malignome') echo 'selected'; ?>>Malignome</option><option value='Nervensystem' <?php if (($form_data_a[10050020] ?? '') == 'Nervensystem') echo 'selected'; ?>>Nervensystem</option><option value='Niere' <?php if (($form_data_a[10050020] ?? '') == 'Niere') echo 'selected'; ?>>Niere</option><option value='Skelettsystem' <?php if (($form_data_a[10050020] ?? '') == 'Skelettsystem') echo 'selected'; ?>>Skelettsystem</option><option value='Stoffwechsel' <?php if (($form_data_a[10050020] ?? '') == 'Stoffwechsel') echo 'selected'; ?>>Stoffwechsel</option></select>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Nebenwirkung</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050040' name='FF_10050040'  onchange='follow_select(this)'><option value=''>Bitte wählen</option><option value='' <?php if (($form_data_a[10050040] ?? '') == '') echo 'selected'; ?>></option></select>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Beginn</div>
                    </div>
                    <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_10050050_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_10050050_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_10050050_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';' required size='12' class='control_input' id='FF_10050050' name='FF_10050050' value="<?php echo htmlspecialchars($form_data_a[10050050] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_10050050','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f' >Noch andauernd</div>
                    </div>
                    <div class='col'>
                        <select required id='FF_10050070' name='FF_10050070'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10050070] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10050070] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_10050070_Nein' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Ende</div>
                    </div>
                    <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_10050075_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_10050075_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_10050075_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_10050075' name='FF_10050075' value="<?php echo htmlspecialchars($form_data_a[10050075] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_10050075','1950','this_year',true,false,'Y(MD)','de');</script>
				</div>
			</div></div><!--block-->
					
                    <div class='col'>
                        <div class='desc_f' >Schweregrad</div>
                    </div>
                    <div class='col'>
                        <select required id='FF_10050080' name='FF_10050080'  onchange='follow_select(this)'><option value=''></option><option value='leicht' <?php if (($form_data_a[10050080] ?? '') == 'leicht') echo 'selected'; ?>>leicht</option><option value='mittelgradig' <?php if (($form_data_a[10050080] ?? '') == 'mittelgradig') echo 'selected'; ?>>mittelgradig</option><option value='schwerwiegend' <?php if (($form_data_a[10050080] ?? '') == 'schwerwiegend') echo 'selected'; ?>>schwerwiegend</option><option value='lebensbedrohlich' <?php if (($form_data_a[10050080] ?? '') == 'lebensbedrohlich') echo 'selected'; ?>>lebensbedrohlich</option><option value='tot' <?php if (($form_data_a[10050080] ?? '') == 'tot') echo 'selected'; ?>>tot</option></select>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Hospitalisierung</div>
                    </div>
                    <div class='col'>
                        <select required id='FF_10050090' name='FF_10050090'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10050090] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10050090] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_10050090_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >UAW-Meldung</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050100' name='FF_10050100'  onchange='follow_select(this)'><option value=''></option><option value='Erstmeldung' <?php if (($form_data_a[10050100] ?? '') == 'Erstmeldung') echo 'selected'; ?>>Erstmeldung</option><option value='Folgemeldung' <?php if (($form_data_a[10050100] ?? '') == 'Folgemeldung') echo 'selected'; ?>>Folgemeldung</option></select>
                    </div>
			<div class='col_100' ><div id='B_10050100_Erstmeldung Folgemeldung' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Maßnahme nach UAW</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050110' name='FF_10050110'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[10050110] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='Dosisreduktion' <?php if (($form_data_a[10050110] ?? '') == 'Dosisreduktion') echo 'selected'; ?>>Dosisreduktion</option><option value='neue Dosis' <?php if (($form_data_a[10050110] ?? '') == 'neue Dosis') echo 'selected'; ?>>neue Dosis</option><option value='vorübergehend abgesetzt' <?php if (($form_data_a[10050110] ?? '') == 'vorübergehend abgesetzt') echo 'selected'; ?>>vorübergehend abgesetzt</option><option value='dauerhaft abgesetzt' <?php if (($form_data_a[10050110] ?? '') == 'dauerhaft abgesetzt') echo 'selected'; ?>>dauerhaft abgesetzt</option></select>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Re-Exposition nach UAW</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050120' name='FF_10050120'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10050120] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10050120] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100' ><div id='B_10050120_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Erneutes Auftreten?</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050130' name='FF_10050130'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10050130] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10050130] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_10050100_Folgemeldung' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Ausgang</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050140' name='FF_10050140'  onchange='follow_select(this)'><option value=''></option><option value='wiederhergestellt' <?php if (($form_data_a[10050140] ?? '') == 'wiederhergestellt') echo 'selected'; ?>>wiederhergestellt</option><option value='wiederhergestellt mit Schädigung' <?php if (($form_data_a[10050140] ?? '') == 'wiederhergestellt mit Schädigung') echo 'selected'; ?>>wiederhergestellt mit Schädigung</option><option value='nicht wiederhergestellt' <?php if (($form_data_a[10050140] ?? '') == 'nicht wiederhergestellt') echo 'selected'; ?>>nicht wiederhergestellt</option><option value='unbekannt' <?php if (($form_data_a[10050140] ?? '') == 'unbekannt') echo 'selected'; ?>>unbekannt</option><option value='Exitus' <?php if (($form_data_a[10050140] ?? '') == 'Exitus') echo 'selected'; ?>>Exitus</option></select>
                    </div>
			<div class='col_100' ><div id='B_10050140_Exitus' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Todesursache</div>
                    </div>
                    <div class='col'>
                        <input data-fg='10050'  type='text' id='FF_10050150' name='FF_10050150' value="<?php echo htmlspecialchars($form_data_a[10050150] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col'>
                        <div class='desc_f' >Möglicher medikamentöser Zusammenhang</div>
                    </div>
                    <div class='col'>
                        <select required id='FF_10050160' name='FF_10050160'  onchange='follow_select(this)'><option value=''></option><option value='kein Zusammenhang' <?php if (($form_data_a[10050160] ?? '') == 'kein Zusammenhang') echo 'selected'; ?>>kein Zusammenhang</option><option value='Zusammenhang unwahrscheinlich' <?php if (($form_data_a[10050160] ?? '') == 'Zusammenhang unwahrscheinlich') echo 'selected'; ?>>Zusammenhang unwahrscheinlich</option><option value='Zusammenhang möglich' <?php if (($form_data_a[10050160] ?? '') == 'Zusammenhang möglich') echo 'selected'; ?>>Zusammenhang möglich</option><option value='Zusammenhang wahrscheinlich' <?php if (($form_data_a[10050160] ?? '') == 'Zusammenhang wahrscheinlich') echo 'selected'; ?>>Zusammenhang wahrscheinlich</option><option value='Zusammenhang sicher' <?php if (($form_data_a[10050160] ?? '') == 'Zusammenhang sicher') echo 'selected'; ?>>Zusammenhang sicher</option></select>
                    </div>
			<div class='col_100' ><div id='B_10050160_kein Zusammenhang' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Andere Ursache</div>
                    </div>
                    <div class='col'>
                        <input data-fg='10050'  type='text' id='FF_10050170' name='FF_10050170' value="<?php echo htmlspecialchars($form_data_a[10050170] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_10050160_Zusammenhang unwahrscheinlich Zusammenhang möglich Zusammenhang wahrscheinlich Zusammenhang sicher' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col'>
                        <div class='desc_f' >Medikament</div>
                    </div>
                    <div class='col'>
                        <select  id='FF_10050180' name='FF_10050180'  onchange='follow_select(this)'><option value=''></option><option value='' <?php if (($form_data_a[10050180] ?? '') == '') echo 'selected'; ?>></option></select>
                    </div>
				</div>
			</fieldset>
			<fieldset id='FS_'><legend>Verlauf Nebenwirkungen</legend>
					<div style='width:100%'><iframe id='<?php echo $fcid?>_nebenwirkung' style='width:100%;border:0;'></iframe></div>
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