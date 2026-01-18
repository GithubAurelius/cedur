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
					
                    <div class='col_a' id='SH_101_a'>
                        <div class='desc_f' >created</div>
                    </div>
                    <div class='col_b' id='SH_101_b'>
                        <input data-fg='10003'  type='text' id='FF_101' name='FF_101' value="<?php echo htmlspecialchars($form_data_a[101] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_102_a'>
                        <div class='desc_f' >oldpid</div>
                    </div>
                    <div class='col_b' id='SH_102_b'>
                        <input data-fg='10003'  type='text' id='FF_102' name='FF_102' value="<?php echo htmlspecialchars($form_data_a[102] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_97_a'>
                        <div class='desc_f' >Groesse</div>
                    </div>
                    <div class='col_b' id='SH_97_b'>
                        <input data-fg='10003'  type='text' id='FF_97' name='FF_97' value="<?php echo htmlspecialchars($form_data_a[97] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_100_a'>
                        <div class='desc_f' >E</div>
                    </div>
                    <div class='col_b' id='SH_100_b'>
                        <input data-fg='10003'  type='text' id='FF_100' name='FF_100' value="<?php echo htmlspecialchars($form_data_a[100] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_10005020_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b' id='SH_10005020_b'>
                        <input data-fg='10003'  type='text' id='FF_10005020' name='FF_10005020' value="<?php echo htmlspecialchars($form_data_a[10005020] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_33_a'>
                        <div class='desc_f' >patient_zuletzt_informiert</div>
                    </div>
                    <div class='col_b' id='SH_33_b'>
                        <input data-fg='10003'  type='text' id='FF_33' name='FF_33' value="<?php echo htmlspecialchars($form_data_a[33] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset id='FS_99921'><legend>Patient</legend>
					
                    <div class='col_30'>
                        <div class='desc_f'>Praxis-Nummer</div>
                            <input required type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Geschlecht</div>
                            <select required  id='FF_96' name='FF_96'  onchange='follow_select(this)'><option value=''></option><option value='weiblich' <?php if (($form_data_a[96] ?? '') == 'weiblich') echo 'selected'; ?>>weiblich</option><option value='männlich' <?php if (($form_data_a[96] ?? '') == 'männlich') echo 'selected'; ?>>männlich</option><option value='divers' <?php if (($form_data_a[96] ?? '') == 'divers') echo 'selected'; ?>>divers</option></select>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Diagnose</div>
                            <select required  id='FF_95' name='FF_95'  onchange='follow_select(this)'><option value=''></option><option value='Morbus Crohn' <?php if (($form_data_a[95] ?? '') == 'Morbus Crohn') echo 'selected'; ?>>Morbus Crohn</option><option value='Colitis ulcerosa' <?php if (($form_data_a[95] ?? '') == 'Colitis ulcerosa') echo 'selected'; ?>>Colitis ulcerosa</option><option value='Colitis indeterminata' <?php if (($form_data_a[95] ?? '') == 'Colitis indeterminata') echo 'selected'; ?>>Colitis indeterminata</option></select>
                        </div>
                    </div>
					<div class='col_30'><div class='desc_f'>Geburtsjahr</div><input required type='number' id='FF_10003020' name='FF_10003020' value="<?php echo htmlspecialchars($form_data_a[10003020] ?? ''); ?>" min='1910' max='this_year' step='1' placeholder=''></div>
					
                    <div class='col_30'>
                        <div class='desc_f'>E-Mail</div>
                            <input  type='text' id='FF_10003040' name='FF_10003040' value="<?php echo htmlspecialchars($form_data_a[10003040] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Cedur-Nr.</div>
                            <input  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder='Automatikfeld'>
                        </div>
                    </div>
					<div class='col_100 infotext'  id='SH_'><hr></div>
					
                    <div class='col_a' id='SH_10003110_a'>
                        <div class='desc_f' >Biobank Aufklärung unterschrieben</div>
                    </div>
                    <div class='col_b' id='SH_10003110_b'  style='text-align:center'>
                        <div id='cbm_10003110'>
                            <input data-rcb='10003110'  class='sim_hide' type='text' id='FF_10003110' name='FF_10003110' value="<?php echo $form_data_a[10003110] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003110_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003110_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003120_a'>
                        <div class='desc_f' >Biomaterial</div>
                    </div>
                    <div class='col_b' id='SH_10003120_b'>
                        <select id='mts_10003120' name='mts_10003120'><option value=''></option><option value='Blut' <?php if (($form_data_a[10003120] ?? '') == 'Blut') echo 'selected'; ?>>Blut</option><option value='Stuhl' <?php if (($form_data_a[10003120] ?? '') == 'Stuhl') echo 'selected'; ?>>Stuhl</option><option value='Gewebe' <?php if (($form_data_a[10003120] ?? '') == 'Gewebe') echo 'selected'; ?>>Gewebe</option><option value='Urin' <?php if (($form_data_a[10003120] ?? '') == 'Urin') echo 'selected'; ?>>Urin</option><option value='Speichelprobe' <?php if (($form_data_a[10003120] ?? '') == 'Speichelprobe') echo 'selected'; ?>>Speichelprobe</option></select>
                        <input type='hidden' id='FF_10003120' name='FF_10003120' value="<?php echo htmlspecialchars($form_data_a[10003120] ?? ''); ?>"><ul id='chosen_10003120' class='cosen_select'></ul>
                        
                    </div>
                    
					<div class='col_100 infotext'  id='SH_'><hr></div>
					<div class='col_100 infotext'  id='SH_999467'></div>
			</fieldset>
			<fieldset id='FS_99922'><legend></legend>
					<div class='col_100' id='idonly_10003050'></div>
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