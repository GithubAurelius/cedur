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
			<fieldset id='FS_'><legend>Diagnose und Symptome</legend>
					
                    <div class='col_a onetime' id='SH_102200_a'>
                        <div class='desc_f' >Datum der Erstdiagnose</div>
                    </div>
                    <div class='col_b onetime' style='display: flex; flex-wrap: nowrap;white-space: nowrap;' id='SH_102200_b'>
                        <select id='FF_102200_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102200_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_102200_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102200' name='FF_102200' value="<?php echo htmlspecialchars($form_data_a[102200] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102200','1960','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_a onetime' id='SH_102300_a'>
                        <div class='desc_f' >Erste Symptome Ihrer Erkrankung?</div>
                    </div>
                    <div class='col_b onetime' style='display: flex; flex-wrap: nowrap;white-space: nowrap;' id='SH_102300_b'>
                        <select id='FF_102300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102300_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_102300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102300' name='FF_102300' value="<?php echo htmlspecialchars($form_data_a[102300] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102300','1960','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_a onetime' id='SH_106900_a'>
                        <div class='desc_f' >Sind Sie schon einmal wegen Ihrer CED am Darm operiert worden?</div>
                    </div>
                    <div class='col_b onetime' id='SH_106900_b'>
                        <select required id='FF_106900' name='FF_106900'  onchange='follow_select(this)'><option value=''></option><option value='Nein' <?php if (($form_data_a[106900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='1 Mal' <?php if (($form_data_a[106900] ?? '') == '1 Mal') echo 'selected'; ?>>1 Mal</option><option value='2 Mal' <?php if (($form_data_a[106900] ?? '') == '2 Mal') echo 'selected'; ?>>2 Mal</option><option value='3 Mal' <?php if (($form_data_a[106900] ?? '') == '3 Mal') echo 'selected'; ?>>3 Mal</option><option value='4 Mal' <?php if (($form_data_a[106900] ?? '') == '4 Mal') echo 'selected'; ?>>4 Mal</option><option value='5 Mal' <?php if (($form_data_a[106900] ?? '') == '5 Mal') echo 'selected'; ?>>5 Mal</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_106900_1 Mal 2 Mal 3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row onetime'>
					<div class='col_100 infotext'  id='SH_'><b>1. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_107100_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_107100_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_107100_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107100' name='FF_107100' value="<?php echo htmlspecialchars($form_data_a[107100] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_107100','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col medic'>
                        <div class='desc_f'></div>
                            <select   id='FF_107200' name='FF_107200'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107200] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107200] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[107200] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_2 Mal 3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row onetime'>
					<div class='col_100 infotext'  id='SH_'><b>2. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_107400_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_107400_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_107400_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107400' name='FF_107400' value="<?php echo htmlspecialchars($form_data_a[107400] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_107400','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col medic'>
                        <div class='desc_f'></div>
                            <select   id='FF_107500' name='FF_107500'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107500] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107500] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[107500] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row onetime'>
					<div class='col_100 infotext'  id='SH_'><b>3. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_107700_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_107700_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_107700_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107700' name='FF_107700' value="<?php echo htmlspecialchars($form_data_a[107700] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_107700','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col medic'>
                        <div class='desc_f'></div>
                            <select   id='FF_107800' name='FF_107800'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107800] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107800] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[107800] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row onetime'>
					<div class='col_100 infotext'  id='SH_'><b>4. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_108000_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_108000_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_108000_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108000' name='FF_108000' value="<?php echo htmlspecialchars($form_data_a[108000] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_108000','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col medic'>
                        <div class='desc_f'></div>
                            <select   id='FF_108100' name='FF_108100'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[108100] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[108100] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[108100] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_5 Mal' class='block' style='display:none'>
				<div class='row onetime'>
					<div class='col_100 infotext'  id='SH_'><b>5. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_108300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_108300_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_108300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108300' name='FF_108300' value="<?php echo htmlspecialchars($form_data_a[108300] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_108300','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col medic'>
                        <div class='desc_f'></div>
                            <select   id='FF_108400' name='FF_108400'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[108400] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[108400] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[108400] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_102400_a'>
                        <div class='desc_f' >Waren Sie im letzten halben Jahr im Krankenhaus?</div>
                    </div>
                    <div class='col_b' id='SH_102400_b'>
                        <select required id='FF_102400' name='FF_102400'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[102400] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[102400] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_102400_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_102500_a'>
                        <div class='desc_f' >Wieviele Tage?</div>
                    </div>
                    <div class='col_b ' id='SH_102500_b'>
                        <input  type='number' id='FF_102500' name='FF_102500' value="<?php echo htmlspecialchars($form_data_a[102500] ?? ''); ?>" min='1' max='300' step='1' placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_106800_a'>
                        <div class='desc_f' >Haben Sie zur Zeit ein Stoma (künstlicher Darmausgang)?</div>
                    </div>
                    <div class='col_b' id='SH_106800_b'>
                        <select required id='FF_106800' name='FF_106800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[106800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[106800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a ' id='SH_103500_a'>
                        <div class='desc_f' >Wie viele flüssige / breiige Stuhlgänge (Bei Stoma: Beutelentleerungen) hatten Sie in der vergangenen Woche durchschnittlich pro Tag?</div>
                    </div>
                    <div class='col_b ' id='SH_103500_b'>
                        <input required type='number' id='FF_103500' name='FF_103500' value="<?php echo htmlspecialchars($form_data_a[103500] ?? ''); ?>" min='0' max='50' step='1' placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_103505_a'>
                        <div class='desc_f' >Nehmen Sie regelmäßig Durchfallmedikamente?</div>
                    </div>
                    <div class='col_b' id='SH_103505_b'>
                        <select required id='FF_103505' name='FF_103505'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[103505] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[103505] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_103600_a'>
                        <div class='desc_f' >Blutbeimengungen beim Stuhl</div>
                    </div>
                    <div class='col_b' id='SH_103600_b'>
                        <select required id='FF_103600' name='FF_103600'  onchange='follow_select(this)'><option value=''></option><option value='kein Blut' <?php if (($form_data_a[103600] ?? '') == 'kein Blut') echo 'selected'; ?>>kein Blut</option><option value='Blut bei weniger als der Hälfte der Stuhlgänge' <?php if (($form_data_a[103600] ?? '') == 'Blut bei weniger als der Hälfte der Stuhlgänge') echo 'selected'; ?>>Blut bei weniger als der Hälfte der Stuhlgänge</option><option value='deutliche Blutbeimengung' <?php if (($form_data_a[103600] ?? '') == 'deutliche Blutbeimengung') echo 'selected'; ?>>deutliche Blutbeimengung</option><option value='Blut auch ohne Stuhl' <?php if (($form_data_a[103600] ?? '') == 'Blut auch ohne Stuhl') echo 'selected'; ?>>Blut auch ohne Stuhl</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_103900_a'>
                        <div class='desc_f' >Bauchschmerzen über die letzten 7 Tage</div>
                    </div>
                    <div class='col_b' id='SH_103900_b'>
                        <select required id='FF_103900' name='FF_103900'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[103900] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='leichte' <?php if (($form_data_a[103900] ?? '') == 'leichte') echo 'selected'; ?>>leichte</option><option value='mäßige' <?php if (($form_data_a[103900] ?? '') == 'mäßige') echo 'selected'; ?>>mäßige</option><option value='schwere' <?php if (($form_data_a[103900] ?? '') == 'schwere') echo 'selected'; ?>>schwere</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_104000_a'>
                        <div class='desc_f' >Ihr Allgemeinbefinden über die letzten 7 Tage</div>
                    </div>
                    <div class='col_b' id='SH_104000_b'>
                        <select required id='FF_104000' name='FF_104000'  onchange='follow_select(this)'><option value=''></option><option value='gut' <?php if (($form_data_a[104000] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='beeinträchtigt' <?php if (($form_data_a[104000] ?? '') == 'beeinträchtigt') echo 'selected'; ?>>beeinträchtigt</option><option value='schlecht' <?php if (($form_data_a[104000] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option><option value='sehr schlecht' <?php if (($form_data_a[104000] ?? '') == 'sehr schlecht') echo 'selected'; ?>>sehr schlecht</option><option value='unerträglich' <?php if (($form_data_a[104000] ?? '') == 'unerträglich') echo 'selected'; ?>>unerträglich</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_104100_a'>
                        <div class='desc_f' >Haben oder hatten Sie Fisteln? (Wenn Sie nicht wissen, was das ist, haben bzw. hatten Sie auch keine)</div>
                    </div>
                    <div class='col_b' id='SH_104100_b'>
                        <select required id='FF_104100' name='FF_104100'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104100] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104100] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_104100_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_104200_a'>
                        <div class='desc_f' >Haben Sie aktuell Fisteln?</div>
                    </div>
                    <div class='col_b' id='SH_104200_b'>
                        <select  id='FF_104200' name='FF_104200'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104200] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104200] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
					
                    <div class='col_a onetime' id='SH_104500_a'>
                        <div class='desc_f' >Hatten Sie Fisteln?</div>
                    </div>
                    <div class='col_b onetime' id='SH_104500_b'>
                        <select  id='FF_104500' name='FF_104500'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104500] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104500] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a onetime' id='SH_111200_a'>
                        <div class='desc_f' >Haben Sie noch weitere Erkrankungen?</div>
                    </div>
                    <div class='col_b onetime' id='SH_111200_b'>
                        <select required id='FF_111200' name='FF_111200'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[111200] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[111200] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_111200_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_1113001_a'>
                        <div class='desc_f' >Bitte wählen Sie die Erkrankungen</div>
                    </div>
                    <div class='col_b' id='SH_1113001_a'>
                        <select id='mts_1113001' name='mts_1113001'><option value=''></option><option value='Akne inversa' <?php if (($form_data_a[1113001] ?? '') == 'Akne inversa') echo 'selected'; ?>>Akne inversa</option><option value='Asthma bronchiale' <?php if (($form_data_a[1113001] ?? '') == 'Asthma bronchiale') echo 'selected'; ?>>Asthma bronchiale</option><option value='Bauchspeicheldrüsenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Bauchspeicheldrüsenkrebs') echo 'selected'; ?>>Bauchspeicheldrüsenkrebs</option><option value='Blasenentzündung' <?php if (($form_data_a[1113001] ?? '') == 'Blasenentzündung') echo 'selected'; ?>>Blasenentzündung</option><option value='Bluthochdruck' <?php if (($form_data_a[1113001] ?? '') == 'Bluthochdruck') echo 'selected'; ?>>Bluthochdruck</option><option value='Brustkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Brustkrebs') echo 'selected'; ?>>Brustkrebs</option><option value='Darmkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Darmkrebs') echo 'selected'; ?>>Darmkrebs</option><option value='Diabetes mellitus' <?php if (($form_data_a[1113001] ?? '') == 'Diabetes mellitus') echo 'selected'; ?>>Diabetes mellitus</option><option value='Depression' <?php if (($form_data_a[1113001] ?? '') == 'Depression') echo 'selected'; ?>>Depression</option><option value='Eierstock-Krebs' <?php if (($form_data_a[1113001] ?? '') == 'Eierstock-Krebs') echo 'selected'; ?>>Eierstock-Krebs</option><option value='Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)' <?php if (($form_data_a[1113001] ?? '') == 'Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)') echo 'selected'; ?>>Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)</option><option value='Fettstoffwechselstörung' <?php if (($form_data_a[1113001] ?? '') == 'Fettstoffwechselstörung') echo 'selected'; ?>>Fettstoffwechselstörung</option><option value='Gallensteine' <?php if (($form_data_a[1113001] ?? '') == 'Gallensteine') echo 'selected'; ?>>Gallensteine</option><option value='Grauer Star' <?php if (($form_data_a[1113001] ?? '') == 'Grauer Star') echo 'selected'; ?>>Grauer Star</option><option value='Grüner Star' <?php if (($form_data_a[1113001] ?? '') == 'Grüner Star') echo 'selected'; ?>>Grüner Star</option><option value='Gürtelrose (Herpes zoster)' <?php if (($form_data_a[1113001] ?? '') == 'Gürtelrose (Herpes zoster)') echo 'selected'; ?>>Gürtelrose (Herpes zoster)</option><option value='Hautkrebs (schwarzer und weißer Hautkrebs)' <?php if (($form_data_a[1113001] ?? '') == 'Hautkrebs (schwarzer und weißer Hautkrebs)') echo 'selected'; ?>>Hautkrebs (schwarzer und weißer Hautkrebs)</option><option value='Haarausfall' <?php if (($form_data_a[1113001] ?? '') == 'Haarausfall') echo 'selected'; ?>>Haarausfall</option><option value='Hepatitis (A, B, C, D oder E)' <?php if (($form_data_a[1113001] ?? '') == 'Hepatitis (A, B, C, D oder E)') echo 'selected'; ?>>Hepatitis (A, B, C, D oder E)</option><option value='Herzinfarkt' <?php if (($form_data_a[1113001] ?? '') == 'Herzinfarkt') echo 'selected'; ?>>Herzinfarkt</option><option value='Hodenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Hodenkrebs') echo 'selected'; ?>>Hodenkrebs</option><option value='HIV' <?php if (($form_data_a[1113001] ?? '') == 'HIV') echo 'selected'; ?>>HIV</option><option value='Koronare Herzkrankheit' <?php if (($form_data_a[1113001] ?? '') == 'Koronare Herzkrankheit') echo 'selected'; ?>>Koronare Herzkrankheit</option><option value='Kurzdarmsyndrom' <?php if (($form_data_a[1113001] ?? '') == 'Kurzdarmsyndrom') echo 'selected'; ?>>Kurzdarmsyndrom</option><option value='Leberzirrhose' <?php if (($form_data_a[1113001] ?? '') == 'Leberzirrhose') echo 'selected'; ?>>Leberzirrhose</option><option value='Leukämie' <?php if (($form_data_a[1113001] ?? '') == 'Leukämie') echo 'selected'; ?>>Leukämie</option><option value='Lungenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Lungenkrebs') echo 'selected'; ?>>Lungenkrebs</option><option value='Lymphdrüsenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Lymphdrüsenkrebs') echo 'selected'; ?>>Lymphdrüsenkrebs</option><option value='Migräne' <?php if (($form_data_a[1113001] ?? '') == 'Migräne') echo 'selected'; ?>>Migräne</option><option value='Multiple Sklerose (MS)' <?php if (($form_data_a[1113001] ?? '') == 'Multiple Sklerose (MS)') echo 'selected'; ?>>Multiple Sklerose (MS)</option><option value='Nierenerkrankung' <?php if (($form_data_a[1113001] ?? '') == 'Nierenerkrankung') echo 'selected'; ?>>Nierenerkrankung</option><option value='Nierensteine' <?php if (($form_data_a[1113001] ?? '') == 'Nierensteine') echo 'selected'; ?>>Nierensteine</option><option value='Osteoporose' <?php if (($form_data_a[1113001] ?? '') == 'Osteoporose') echo 'selected'; ?>>Osteoporose</option><option value='PBC (Primär biliäre Zirrhose / Cholangitis)' <?php if (($form_data_a[1113001] ?? '') == 'PBC (Primär biliäre Zirrhose / Cholangitis)') echo 'selected'; ?>>PBC (Primär biliäre Zirrhose / Cholangitis)</option><option value='Prostatakrebs' <?php if (($form_data_a[1113001] ?? '') == 'Prostatakrebs') echo 'selected'; ?>>Prostatakrebs</option><option value='PSC (primär)' <?php if (($form_data_a[1113001] ?? '') == 'PSC (primär)') echo 'selected'; ?>>PSC (primär)</option><option value='Rheumatoide Arthritis' <?php if (($form_data_a[1113001] ?? '') == 'Rheumatoide Arthritis') echo 'selected'; ?>>Rheumatoide Arthritis</option><option value='Schilddrüsenüberfunktion' <?php if (($form_data_a[1113001] ?? '') == 'Schilddrüsenüberfunktion') echo 'selected'; ?>>Schilddrüsenüberfunktion</option><option value='Schilddrüsenunterfunktion' <?php if (($form_data_a[1113001] ?? '') == 'Schilddrüsenunterfunktion') echo 'selected'; ?>>Schilddrüsenunterfunktion</option><option value='Schlafstörungen' <?php if (($form_data_a[1113001] ?? '') == 'Schlafstörungen') echo 'selected'; ?>>Schlafstörungen</option><option value='Schuppenflechte' <?php if (($form_data_a[1113001] ?? '') == 'Schuppenflechte') echo 'selected'; ?>>Schuppenflechte</option><option value='Thrombose' <?php if (($form_data_a[1113001] ?? '') == 'Thrombose') echo 'selected'; ?>>Thrombose</option></select>
                        <input type='hidden' id='FF_1113001' name='FF_1113001' value="<?php echo htmlspecialchars($form_data_a[1113001] ?? ''); ?>"><ul id='chosen_1113001' class='cosen_select'></ul>
                        <script>
                            const select = document.getElementById('mts_1113001');
                            const list = document.getElementById('chosen_1113001');
                            const hiddenInput = document.getElementById('FF_1113001');
                            let selectedItems = [];
                            document.addEventListener('DOMContentLoaded', () => {
                            const saved = hiddenInput.value.trim();
                                if (saved) {
                                    selectedItems = saved.split(',').map(s => s.trim()).filter(Boolean);
                                    updateList();
                                }
                                });
                                select.addEventListener('change', () => {
                                const selectedValue = select.value;
                                if (!selectedValue) return;
                                const index = selectedItems.indexOf(selectedValue);
                                if (index === -1) {
                                        selectedItems.push(selectedValue);
                                    } else {
                                        selectedItems.splice(index, 1);
                                    }
                                    updateList();
                                    select.value = ''; 
                            });
                            function updateList() {
                                list.innerHTML = '';
                                selectedItems.forEach(item => {
                                    const li = document.createElement('li');
                                    li.textContent = item;
                                    list.appendChild(li);
                                });
                                hiddenInput.value = selectedItems.join(',');
                            }
                        </script>
                    </div>
                    
					
                    <div class='col_a' id='SH_115500_a'>
                        <div class='desc_f' >Andere Erkrankungen falls nicht in der Liste:</div>
                    </div>
                    <div class='col_b' id='SH_115500_b'>
                        <textarea id='FF_115500' name='FF_115500' rows='2'><?php echo htmlspecialchars($form_data_a[115500] ?? ''); ?></textarea>
                    </div>
				</div>
			</div></div><!--block-->
			</fieldset></creator>
                </form>
            </td>
            <td id='<? echo $fg ?>_td_sidebar' valign='top'></td>
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




</body>

</html>