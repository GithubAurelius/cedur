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
            height: 35;
            background-color: #ededed;
            border-bottom: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            box-sizing: border-box;
            border-radius: 8px;

        }

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
        .header-center,
        .header-right {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .header-center {
            flex: 1;
            justify-content: center;
            text-align: center;
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
        <div class="header-left">
            <?php $a_log = $_REQUEST['a_log'] ?? $_POST['a_log'] ?? ''; ?>
            <?php if ($a_log == 1) { ?>
                <button id='logoff_form' onclick="document.location.href ='<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'login.php' ?>'">Abmelden</button>
            <?php } ?>
            <strong><?php echo $header_info ?></strong>
        </div>

        <div class="header-center">
            <label id="status" class="hintlabel"></label>
        </div>

        <div class="header-right" id="submit_span">
            <button id='main_form_submit_button' onclick='document.main_form.submit()'>💾Speichern</button>
            <button type='button' id='main_form_submit_new_button' style='display:none' onclick='document.getElementById("helper").value="auto_sumbit_and_new";document.main_form.submit()'>💾Speichern und ➕Neu</button>
        </div>
    </div>
    <div style='margin-bottom:27px;'>
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
                    </div>
                    <creator>
				<div class='row' style='height:0;visibility: collapse;'>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10050'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10050'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10050'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10050'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset class=''><legend>Nebenwirkung</legend>
					
                    <div class='col '>
                        <div class='desc_f' >Nebenwirkung-Gruppe</div>
                    </div>
                    <div class='col '>
                        <select required id='FF_10040020' name='FF_10040020'  onchange='follow_select(this)'><option value=''>Bitte wählen</option><option value='Allergische Reaktion' <?php if (($form_data_a[10040020] ?? '') == 'Allergische Reaktion') echo 'selected'; ?>>Allergische Reaktion</option><option value='Atemwege' <?php if (($form_data_a[10040020] ?? '') == 'Atemwege') echo 'selected'; ?>>Atemwege</option><option value='Auge' <?php if (($form_data_a[10040020] ?? '') == 'Auge') echo 'selected'; ?>>Auge</option><option value='Gastrointestinal' <?php if (($form_data_a[10040020] ?? '') == 'Gastrointestinal') echo 'selected'; ?>>Gastrointestinal</option><option value='Haut- und Anhangsgebilde' <?php if (($form_data_a[10040020] ?? '') == 'Haut- und Anhangsgebilde') echo 'selected'; ?>>Haut- und Anhangsgebilde</option><option value='Herz-Kreislaufsystem' <?php if (($form_data_a[10040020] ?? '') == 'Herz-Kreislaufsystem') echo 'selected'; ?>>Herz-Kreislaufsystem</option><option value='Hormonsystem' <?php if (($form_data_a[10040020] ?? '') == 'Hormonsystem') echo 'selected'; ?>>Hormonsystem</option><option value='Hämatologisch' <?php if (($form_data_a[10040020] ?? '') == 'Hämatologisch') echo 'selected'; ?>>Hämatologisch</option><option value='Infektionen' <?php if (($form_data_a[10040020] ?? '') == 'Infektionen') echo 'selected'; ?>>Infektionen</option><option value='Malignome' <?php if (($form_data_a[10040020] ?? '') == 'Malignome') echo 'selected'; ?>>Malignome</option><option value='Nervensystem' <?php if (($form_data_a[10040020] ?? '') == 'Nervensystem') echo 'selected'; ?>>Nervensystem</option><option value='Niere' <?php if (($form_data_a[10040020] ?? '') == 'Niere') echo 'selected'; ?>>Niere</option><option value='Skelettsystem' <?php if (($form_data_a[10040020] ?? '') == 'Skelettsystem') echo 'selected'; ?>>Skelettsystem</option><option value='Stoffwechsel' <?php if (($form_data_a[10040020] ?? '') == 'Stoffwechsel') echo 'selected'; ?>>Stoffwechsel</option></select>
                    </div>
					
                    <div class='col '>
                        <div class='desc_f' >Nebenwirkung</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040040' name='FF_10040040'  onchange='follow_select(this)'><option value=''>Bitte wählen</option><option value='' <?php if (($form_data_a[10040040] ?? '') == '') echo 'selected'; ?>></option></select>
                    </div>
					
                    <div class='col'>
                        <div class='desc_f' >Beginn</div>
                    </div>
                    <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_10040050_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_10040050_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_10040050_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';' required size='12' class='control_input' id='FF_10040050' name='FF_10040050' value="<?php echo htmlspecialchars($form_data_a[10040050] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_10040050','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col '>
                        <div class='desc_f' >Noch andauerend</div>
                    </div>
                    <div class='col '>
                        <select required id='FF_10040070' name='FF_10040070'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10040070] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10040070] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_10040070_Nein' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col'>
                        <div class='desc_f' >Ende</div>
                    </div>
                    <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_10040075_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_10040075_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_10040075_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_10040075' name='FF_10040075' value="<?php echo htmlspecialchars($form_data_a[10040075] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_10040075','1950','this_year',true,false,'Y(MD)','de');</script>
				</div>
			</div></div><!--block-->
					
                    <div class='col '>
                        <div class='desc_f' >Schweregrad</div>
                    </div>
                    <div class='col '>
                        <select required id='FF_10040080' name='FF_10040080'  onchange='follow_select(this)'><option value=''></option><option value='leicht' <?php if (($form_data_a[10040080] ?? '') == 'leicht') echo 'selected'; ?>>leicht</option><option value='mittelgradig' <?php if (($form_data_a[10040080] ?? '') == 'mittelgradig') echo 'selected'; ?>>mittelgradig</option><option value='schwerwiegend' <?php if (($form_data_a[10040080] ?? '') == 'schwerwiegend') echo 'selected'; ?>>schwerwiegend</option><option value='lebensbedrohlich' <?php if (($form_data_a[10040080] ?? '') == 'lebensbedrohlich') echo 'selected'; ?>>lebensbedrohlich</option><option value='tod' <?php if (($form_data_a[10040080] ?? '') == 'tod') echo 'selected'; ?>>tod</option></select>
                    </div>
					
                    <div class='col '>
                        <div class='desc_f' >Hospitalisierung</div>
                    </div>
                    <div class='col '>
                        <select required id='FF_10040090' name='FF_10040090'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10040090] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10040090] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_10040090_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col '>
                        <div class='desc_f' >UAW-Meldung</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040100' name='FF_10040100'  onchange='follow_select(this)'><option value=''></option><option value='Erstmeldung' <?php if (($form_data_a[10040100] ?? '') == 'Erstmeldung') echo 'selected'; ?>>Erstmeldung</option><option value='Folgemeldung' <?php if (($form_data_a[10040100] ?? '') == 'Folgemeldung') echo 'selected'; ?>>Folgemeldung</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_10040100_Erstmeldung Folgemeldung' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col '>
                        <div class='desc_f' >Maßnahme nach UAW</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040110' name='FF_10040110'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[10040110] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='Dosisreduktion' <?php if (($form_data_a[10040110] ?? '') == 'Dosisreduktion') echo 'selected'; ?>>Dosisreduktion</option><option value='neue Dosis' <?php if (($form_data_a[10040110] ?? '') == 'neue Dosis') echo 'selected'; ?>>neue Dosis</option><option value='vorübergehend abgesetzt' <?php if (($form_data_a[10040110] ?? '') == 'vorübergehend abgesetzt') echo 'selected'; ?>>vorübergehend abgesetzt</option><option value='dauerhaft abgesetzt' <?php if (($form_data_a[10040110] ?? '') == 'dauerhaft abgesetzt') echo 'selected'; ?>>dauerhaft abgesetzt</option></select>
                    </div>
					
                    <div class='col '>
                        <div class='desc_f' >Re-Exposition nach UAW</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040120' name='FF_10040120'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10040120] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10040120] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_10040120_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col '>
                        <div class='desc_f' >Erneutes Auftreten?</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040130' name='FF_10040130'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[10040130] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[10040130] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_10040100_Folgemeldung' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col '>
                        <div class='desc_f' >Ausgang</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040140' name='FF_10040140'  onchange='follow_select(this)'><option value=''></option><option value='wiederhergestellt' <?php if (($form_data_a[10040140] ?? '') == 'wiederhergestellt') echo 'selected'; ?>>wiederhergestellt</option><option value='wiederhergestellt mit Schädigung' <?php if (($form_data_a[10040140] ?? '') == 'wiederhergestellt mit Schädigung') echo 'selected'; ?>>wiederhergestellt mit Schädigung</option><option value='nicht wiederhergestellt' <?php if (($form_data_a[10040140] ?? '') == 'nicht wiederhergestellt') echo 'selected'; ?>>nicht wiederhergestellt</option><option value='unbekannt' <?php if (($form_data_a[10040140] ?? '') == 'unbekannt') echo 'selected'; ?>>unbekannt</option><option value='Exitus' <?php if (($form_data_a[10040140] ?? '') == 'Exitus') echo 'selected'; ?>>Exitus</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_10040140_Exitus' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col'>
                        <div class='desc_f' >Todesursache</div>
                    </div>
                    <div class='col'>
                        <input data-fg='10050'  type='text' id='FF_10040150' name='FF_10040150' value="<?php echo htmlspecialchars($form_data_a[10040150] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col '>
                        <div class='desc_f' >Möglicher medikamentöser Zusammenhang</div>
                    </div>
                    <div class='col '>
                        <select required id='FF_10040160' name='FF_10040160'  onchange='follow_select(this)'><option value=''></option><option value='kein Zusammenhang' <?php if (($form_data_a[10040160] ?? '') == 'kein Zusammenhang') echo 'selected'; ?>>kein Zusammenhang</option><option value='Zusammenhang unwahrscheinlich' <?php if (($form_data_a[10040160] ?? '') == 'Zusammenhang unwahrscheinlich') echo 'selected'; ?>>Zusammenhang unwahrscheinlich</option><option value='Zusammenhang möglich' <?php if (($form_data_a[10040160] ?? '') == 'Zusammenhang möglich') echo 'selected'; ?>>Zusammenhang möglich</option><option value='Zusammenhang wahrscheinlich' <?php if (($form_data_a[10040160] ?? '') == 'Zusammenhang wahrscheinlich') echo 'selected'; ?>>Zusammenhang wahrscheinlich</option><option value='Zusammenhang sicher' <?php if (($form_data_a[10040160] ?? '') == 'Zusammenhang sicher') echo 'selected'; ?>>Zusammenhang sicher</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_10040160_kein Zusammenhang' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col'>
                        <div class='desc_f' >Andere Ursache</div>
                    </div>
                    <div class='col'>
                        <input data-fg='10050'  type='text' id='FF_10040170' name='FF_10040170' value="<?php echo htmlspecialchars($form_data_a[10040170] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_10040160_Zusammenhang unwahrscheinlich Zusammenhang möglich Zusammenhang wahrscheinlich Zusammenhang sicher' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col '>
                        <div class='desc_f' >Medikament</div>
                    </div>
                    <div class='col '>
                        <select  id='FF_10040180' name='FF_10040180'  onchange='follow_select(this)'><option value=''></option><option value='Codein Tropfen' <?php if (($form_data_a[10040180] ?? '') == 'Codein Tropfen') echo 'selected'; ?>>Codein Tropfen</option><option value='Codein Tabletten' <?php if (($form_data_a[10040180] ?? '') == 'Codein Tabletten') echo 'selected'; ?>>Codein Tabletten</option><option value='Imodium' <?php if (($form_data_a[10040180] ?? '') == 'Imodium') echo 'selected'; ?>>Imodium</option><option value='Lopedium' <?php if (($form_data_a[10040180] ?? '') == 'Lopedium') echo 'selected'; ?>>Lopedium</option><option value='Loperamid' <?php if (($form_data_a[10040180] ?? '') == 'Loperamid') echo 'selected'; ?>>Loperamid</option><option value='Opium Tropfen' <?php if (($form_data_a[10040180] ?? '') == 'Opium Tropfen') echo 'selected'; ?>>Opium Tropfen</option><option value='Paracodin Tropfen' <?php if (($form_data_a[10040180] ?? '') == 'Paracodin Tropfen') echo 'selected'; ?>>Paracodin Tropfen</option><option value='andere Anti-Durchfall Mittel' <?php if (($form_data_a[10040180] ?? '') == 'andere Anti-Durchfall Mittel') echo 'selected'; ?>>andere Anti-Durchfall Mittel</option><option value='Amgevita (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Amgevita (Adalimumab)') echo 'selected'; ?>>Amgevita (Adalimumab)</option><option value='Cimzia (Certolizumab)' <?php if (($form_data_a[10040180] ?? '') == 'Cimzia (Certolizumab)') echo 'selected'; ?>>Cimzia (Certolizumab)</option><option value='Entyvio (Vedolizumab)' <?php if (($form_data_a[10040180] ?? '') == 'Entyvio (Vedolizumab)') echo 'selected'; ?>>Entyvio (Vedolizumab)</option><option value='Flixabi (Infliximab)' <?php if (($form_data_a[10040180] ?? '') == 'Flixabi (Infliximab)') echo 'selected'; ?>>Flixabi (Infliximab)</option><option value='Fymskina (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Fymskina (Ustekinumab)') echo 'selected'; ?>>Fymskina (Ustekinumab)</option><option value='Hukyndra (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Hukyndra (Adalimumab)') echo 'selected'; ?>>Hukyndra (Adalimumab)</option><option value='Hulio (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Hulio (Adalimumab)') echo 'selected'; ?>>Hulio (Adalimumab)</option><option value='Humira (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Humira (Adalimumab)') echo 'selected'; ?>>Humira (Adalimumab)</option><option value='Hyrimoz (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Hyrimoz (Adalimumab)') echo 'selected'; ?>>Hyrimoz (Adalimumab)</option><option value='Idacio (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Idacio (Adalimumab)') echo 'selected'; ?>>Idacio (Adalimumab)</option><option value='Imraldi (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Imraldi (Adalimumab)') echo 'selected'; ?>>Imraldi (Adalimumab)</option><option value='Imuldosa (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Imuldosa (Ustekinumab)') echo 'selected'; ?>>Imuldosa (Ustekinumab)</option><option value='Inflectra (Infliximab)' <?php if (($form_data_a[10040180] ?? '') == 'Inflectra (Infliximab)') echo 'selected'; ?>>Inflectra (Infliximab)</option><option value='Omvoh (Mirikizumab)' <?php if (($form_data_a[10040180] ?? '') == 'Omvoh (Mirikizumab)') echo 'selected'; ?>>Omvoh (Mirikizumab)</option><option value='Otulfi (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Otulfi (Ustekinumab)') echo 'selected'; ?>>Otulfi (Ustekinumab)</option><option value='Pyzchiva (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Pyzchiva (Ustekinumab)') echo 'selected'; ?>>Pyzchiva (Ustekinumab)</option><option value='Remicade (Infliximab)' <?php if (($form_data_a[10040180] ?? '') == 'Remicade (Infliximab)') echo 'selected'; ?>>Remicade (Infliximab)</option><option value='Remsima (Infliximab) als Infusion' <?php if (($form_data_a[10040180] ?? '') == 'Remsima (Infliximab) als Infusion') echo 'selected'; ?>>Remsima (Infliximab) als Infusion</option><option value='Remsima (Infliximab) als subcutan Spritze ' <?php if (($form_data_a[10040180] ?? '') == 'Remsima (Infliximab) als subcutan Spritze ') echo 'selected'; ?>>Remsima (Infliximab) als subcutan Spritze</option><option value='Simponi (Golimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Simponi (Golimumab)') echo 'selected'; ?>>Simponi (Golimumab)</option><option value='Skyrizi (Risankizumab)' <?php if (($form_data_a[10040180] ?? '') == 'Skyrizi (Risankizumab)') echo 'selected'; ?>>Skyrizi (Risankizumab)</option><option value='Stelara (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Stelara (Ustekinumab)') echo 'selected'; ?>>Stelara (Ustekinumab)</option><option value='Steqeyma (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Steqeyma (Ustekinumab)') echo 'selected'; ?>>Steqeyma (Ustekinumab)</option><option value='Tremfya' <?php if (($form_data_a[10040180] ?? '') == 'Tremfya') echo 'selected'; ?>>Tremfya</option><option value='Tysabri' <?php if (($form_data_a[10040180] ?? '') == 'Tysabri') echo 'selected'; ?>>Tysabri</option><option value='Uzpruvo (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Uzpruvo (Ustekinumab)') echo 'selected'; ?>>Uzpruvo (Ustekinumab)</option><option value='Wezenla (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Wezenla (Ustekinumab)') echo 'selected'; ?>>Wezenla (Ustekinumab)</option><option value='Yuflyma (Adalimumab)' <?php if (($form_data_a[10040180] ?? '') == 'Yuflyma (Adalimumab)') echo 'selected'; ?>>Yuflyma (Adalimumab)</option><option value='Yesintek (Ustekinumab)' <?php if (($form_data_a[10040180] ?? '') == 'Yesintek (Ustekinumab)') echo 'selected'; ?>>Yesintek (Ustekinumab)</option><option value='Zessly' <?php if (($form_data_a[10040180] ?? '') == 'Zessly') echo 'selected'; ?>>Zessly</option><option value='andere Biologika' <?php if (($form_data_a[10040180] ?? '') == 'andere Biologika') echo 'selected'; ?>>andere Biologika</option><option value='Budenofalk (Budesonid oral)' <?php if (($form_data_a[10040180] ?? '') == 'Budenofalk (Budesonid oral)') echo 'selected'; ?>>Budenofalk (Budesonid oral)</option><option value='Budenofalk uno (Budesonid oral)' <?php if (($form_data_a[10040180] ?? '') == 'Budenofalk uno (Budesonid oral)') echo 'selected'; ?>>Budenofalk uno (Budesonid oral)</option><option value='Cortiment (Budesonid oral)' <?php if (($form_data_a[10040180] ?? '') == 'Cortiment (Budesonid oral)') echo 'selected'; ?>>Cortiment (Budesonid oral)</option><option value='Entocort (Budesonid oral)' <?php if (($form_data_a[10040180] ?? '') == 'Entocort (Budesonid oral)') echo 'selected'; ?>>Entocort (Budesonid oral)</option><option value='Budenofalkschaum (Budesonid rektal)' <?php if (($form_data_a[10040180] ?? '') == 'Budenofalkschaum (Budesonid rektal)') echo 'selected'; ?>>Budenofalkschaum (Budesonid rektal)</option><option value='Entocort-Einläufe (Budesonid rektal)' <?php if (($form_data_a[10040180] ?? '') == 'Entocort-Einläufe (Budesonid rektal)') echo 'selected'; ?>>Entocort-Einläufe (Budesonid rektal)</option><option value='andere Budesonid' <?php if (($form_data_a[10040180] ?? '') == 'andere Budesonid') echo 'selected'; ?>>andere Budesonid</option><option value='Cortison-Präparate", "Prednisolon (Cortisonpräparat oral)' <?php if (($form_data_a[10040180] ?? '') == 'Cortison-Präparate", "Prednisolon (Cortisonpräparat oral)') echo 'selected'; ?>>Cortison-Präparate", "Prednisolon (Cortisonpräparat oral)</option><option value='Decortin (Cortisonpräparat oral)' <?php if (($form_data_a[10040180] ?? '') == 'Decortin (Cortisonpräparat oral)') echo 'selected'; ?>>Decortin (Cortisonpräparat oral)</option><option value='andere Cortisonpräparate oral' <?php if (($form_data_a[10040180] ?? '') == 'andere Cortisonpräparate oral') echo 'selected'; ?>>andere Cortisonpräparate oral</option><option value='Betnesol Klysmen (Cortisonpräparate rektal)' <?php if (($form_data_a[10040180] ?? '') == 'Betnesol Klysmen (Cortisonpräparate rektal)') echo 'selected'; ?>>Betnesol Klysmen (Cortisonpräparate rektal)</option><option value='Colifoam Rektalschaum (Cortisonpräparate rektal)' <?php if (($form_data_a[10040180] ?? '') == 'Colifoam Rektalschaum (Cortisonpräparate rektal)') echo 'selected'; ?>>Colifoam Rektalschaum (Cortisonpräparate rektal)</option><option value='Postericort (Cortisonpräparate rektal)' <?php if (($form_data_a[10040180] ?? '') == 'Postericort (Cortisonpräparate rektal)') echo 'selected'; ?>>Postericort (Cortisonpräparate rektal)</option><option value='andere Cortisonpräparate rektal' <?php if (($form_data_a[10040180] ?? '') == 'andere Cortisonpräparate rektal') echo 'selected'; ?>>andere Cortisonpräparate rektal</option><option value='Immunsenker", "Azathioprin (klassischer Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Immunsenker", "Azathioprin (klassischer Immunsenker)') echo 'selected'; ?>>Immunsenker", "Azathioprin (klassischer Immunsenker)</option><option value='Methotrexat (klassischer Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Methotrexat (klassischer Immunsenker)') echo 'selected'; ?>>Methotrexat (klassischer Immunsenker)</option><option value='Puri-Nethol (klassischer Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Puri-Nethol (klassischer Immunsenker)') echo 'selected'; ?>>Puri-Nethol (klassischer Immunsenker)</option><option value='Jyseleca (neuartiger Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Jyseleca (neuartiger Immunsenker)') echo 'selected'; ?>>Jyseleca (neuartiger Immunsenker)</option><option value='Rinvoq (neuartiger Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Rinvoq (neuartiger Immunsenker)') echo 'selected'; ?>>Rinvoq (neuartiger Immunsenker)</option><option value='Velsipity (neuartiger Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Velsipity (neuartiger Immunsenker)') echo 'selected'; ?>>Velsipity (neuartiger Immunsenker)</option><option value=' Xeljanz (neuartiger Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == ' Xeljanz (neuartiger Immunsenker)') echo 'selected'; ?>>Xeljanz (neuartiger Immunsenker)</option><option value='Zeposia (neuartiger Immunsenker)' <?php if (($form_data_a[10040180] ?? '') == 'Zeposia (neuartiger Immunsenker)') echo 'selected'; ?>>Zeposia (neuartiger Immunsenker)</option><option value='andere Immunsenker' <?php if (($form_data_a[10040180] ?? '') == 'andere Immunsenker') echo 'selected'; ?>>andere Immunsenker</option><option value='Mesalazine", "Asacol (Mesalazin)' <?php if (($form_data_a[10040180] ?? '') == 'Mesalazine", "Asacol (Mesalazin)') echo 'selected'; ?>>Mesalazine", "Asacol (Mesalazin)</option><option value='Claversal (Mesalazin)' <?php if (($form_data_a[10040180] ?? '') == 'Claversal (Mesalazin)') echo 'selected'; ?>>Claversal (Mesalazin)</option><option value='Mezavant (Mesalazin)' <?php if (($form_data_a[10040180] ?? '') == 'Mezavant (Mesalazin)') echo 'selected'; ?>>Mezavant (Mesalazin)</option><option value='Pentasa (Mesalazin)' <?php if (($form_data_a[10040180] ?? '') == 'Pentasa (Mesalazin)') echo 'selected'; ?>>Pentasa (Mesalazin)</option><option value='Salofalk (Mesalazin)' <?php if (($form_data_a[10040180] ?? '') == 'Salofalk (Mesalazin)') echo 'selected'; ?>>Salofalk (Mesalazin)</option><option value='Sulfasalazin (Mesalazin)' <?php if (($form_data_a[10040180] ?? '') == 'Sulfasalazin (Mesalazin)') echo 'selected'; ?>>Sulfasalazin (Mesalazin)</option><option value='andere Mesalazine' <?php if (($form_data_a[10040180] ?? '') == 'andere Mesalazine') echo 'selected'; ?>>andere Mesalazine</option><option value='andere Medikamente", "Eisen als Infusion' <?php if (($form_data_a[10040180] ?? '') == 'andere Medikamente", "Eisen als Infusion') echo 'selected'; ?>>andere Medikamente", "Eisen als Infusion</option><option value='Eisen als Spritze' <?php if (($form_data_a[10040180] ?? '') == 'Eisen als Spritze') echo 'selected'; ?>>Eisen als Spritze</option><option value='Eisentabletten' <?php if (($form_data_a[10040180] ?? '') == 'Eisentabletten') echo 'selected'; ?>>Eisentabletten</option><option value='Eisentropfen' <?php if (($form_data_a[10040180] ?? '') == 'Eisentropfen') echo 'selected'; ?>>Eisentropfen</option><option value='Cholestagel (Gallensäurebinder)' <?php if (($form_data_a[10040180] ?? '') == 'Cholestagel (Gallensäurebinder)') echo 'selected'; ?>>Cholestagel (Gallensäurebinder)</option><option value='Colestyramin (Gallensäurebinder)' <?php if (($form_data_a[10040180] ?? '') == 'Colestyramin (Gallensäurebinder)') echo 'selected'; ?>>Colestyramin (Gallensäurebinder)</option><option value='Lipocol (Gallensäurebinder)' <?php if (($form_data_a[10040180] ?? '') == 'Lipocol (Gallensäurebinder)') echo 'selected'; ?>>Lipocol (Gallensäurebinder)</option><option value='Omeprazol (Magenschutz)' <?php if (($form_data_a[10040180] ?? '') == 'Omeprazol (Magenschutz)') echo 'selected'; ?>>Omeprazol (Magenschutz)</option><option value='Pantozol (Magenschutz)' <?php if (($form_data_a[10040180] ?? '') == 'Pantozol (Magenschutz)') echo 'selected'; ?>>Pantozol (Magenschutz)</option><option value='Vitamin B12' <?php if (($form_data_a[10040180] ?? '') == 'Vitamin B12') echo 'selected'; ?>>Vitamin B12</option><option value='Vitamin B6' <?php if (($form_data_a[10040180] ?? '') == 'Vitamin B6') echo 'selected'; ?>>Vitamin B6</option><option value='Vitamin D' <?php if (($form_data_a[10040180] ?? '') == 'Vitamin D') echo 'selected'; ?>>Vitamin D</option><option value='Vitamin D plus Calcium' <?php if (($form_data_a[10040180] ?? '') == 'Vitamin D plus Calcium') echo 'selected'; ?>>Vitamin D plus Calcium</option><option value='andere Medikamente' <?php if (($form_data_a[10040180] ?? '') == 'andere Medikamente') echo 'selected'; ?>>andere Medikamente</option></select>
                    </div>
				</div>
			</fieldset>
			<fieldset class=''><legend>Nebenwirkungen</legend>
					<div style='width:100%'><iframe id='<?php echo $fcid?>_nebenwirkung' style='width:100%;border:0;'></iframe></div>
			</fieldset></creator>
                </form>
            </td>
            <td id='<? echo $fg ?>_td_sidebar' valign='top'></td>
        </tr>
    </table>
    <script>
        var errors = 0;
        eL_load_select_logic();
        eL_check_numbers();
        eL_check_required_fields();
    </script>
    <?php
    require_once MIQ_ROOT . "/modules/form_base/form_end.php";
    $file_add_end = str_replace(".php", "_add_end.php", "./" . basename(__FILE__));
    if (file_exists($file_add_end)) include_once($file_add_end);
    ?>
    <script>
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