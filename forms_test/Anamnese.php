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
                        <input data-fg='10010'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10010'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10010'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10010'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_102550' name='FF_102550'  onchange='follow_select(this)'><option value=''></option><option value='weiblich' <?php if (($form_data_a[102550] ?? '') == 'weiblich') echo 'selected'; ?>>weiblich</option><option value='männlich' <?php if (($form_data_a[102550] ?? '') == 'männlich') echo 'selected'; ?>>männlich</option></select>
                    </div>
				</div>
			<fieldset class=''><legend>Anamnese</legend>
					
                    <div class='col_a'>
                        <div class='desc_f' >Wie groß sind Sie?</div>
                    </div>
                    <div class='col_b'>
                        <input required type='number' id='FF_102600' name='FF_102600' value="<?php echo htmlspecialchars($form_data_a[102600] ?? ''); ?>" min='110' max='240' step='1' placeholder='in cm'>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Wie viel wiegen Sie?</div>
                    </div>
                    <div class='col_b'>
                        <input required type='number' id='FF_102700' name='FF_102700' value="<?php echo htmlspecialchars($form_data_a[102700] ?? ''); ?>" min='30' max='300' step='1' placeholder='in kg'>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Rauchen Sie?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_102800' name='FF_102800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[102800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[102800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_102800_Ja' class='block' style='display:none'>
				<div class='row '>
					<div class='col infotext '><h4>Bitte machen Sie Angaben zu<br>den genutzten Tabakprodukten:</h4></div>
					<div class='col'><div class='desc_f'>Wie viele Zigaretten pro Tag?</div><input  type='number' id='FF_103400' name='FF_103400' value="<?php echo htmlspecialchars($form_data_a[103400] ?? ''); ?>" min='0' max='150' step='1' placeholder='in Stck.'></div>
					<div class='col'><div class='desc_f'>Wie viele E-Zigaretten pro Tag?</div><input  type='number' id='FF_103000' name='FF_103000' value="<?php echo htmlspecialchars($form_data_a[103000] ?? ''); ?>" min='0' max='150' step='1' placeholder='in Stck.'></div>
					<div class='col'><div class='desc_f'>Wie viele Zigarillos / Zigarren pro Tag?</div><input  type='number' id='FF_103300' name='FF_103300' value="<?php echo htmlspecialchars($form_data_a[103300] ?? ''); ?>" min='0' max='150' step='1' placeholder='in Stck.'></div>
					<div class='col'><div class='desc_f'>Wie viele Pfeifen pro Tag?</div><input  type='number' id='FF_103100' name='FF_103100' value="<?php echo htmlspecialchars($form_data_a[103100] ?? ''); ?>" min='0' max='150' step='1' placeholder='in Stck.'></div>
					<div class='col'><div class='desc_f'>Wie viele Tabakerhitzer pro Tag?</div><input  type='number' id='FF_103200' name='FF_103200' value="<?php echo htmlspecialchars($form_data_a[103200] ?? ''); ?>" min='0' max='150' step='1' placeholder='in Stck.'></div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Bevorzugen Sie eine spezielle Ernährungsform?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_102805' name='FF_102805'  onchange='follow_select(this)'><option value=''></option><option value='Vegetarisch' <?php if (($form_data_a[102805] ?? '') == 'Vegetarisch') echo 'selected'; ?>>Vegetarisch</option><option value='Vegan' <?php if (($form_data_a[102805] ?? '') == 'Vegan') echo 'selected'; ?>>Vegan</option><option value='Gluten-frei /-arm' <?php if (($form_data_a[102805] ?? '') == 'Gluten-frei /-arm') echo 'selected'; ?>>Gluten-frei /-arm</option><option value='Zuckerverzicht' <?php if (($form_data_a[102805] ?? '') == 'Zuckerverzicht') echo 'selected'; ?>>Zuckerverzicht</option><option value='FODMAP ( Blähungen)' <?php if (($form_data_a[102805] ?? '') == 'FODMAP ( Blähungen)') echo 'selected'; ?>>FODMAP ( Blähungen)</option><option value='Exklusive Enterale Ernährung (mit Trinknahrung)' <?php if (($form_data_a[102805] ?? '') == 'Exklusive Enterale Ernährung (mit Trinknahrung)') echo 'selected'; ?>>Exklusive Enterale Ernährung (mit Trinknahrung)</option><option value='Ballaststoffarm' <?php if (($form_data_a[102805] ?? '') == 'Ballaststoffarm') echo 'selected'; ?>>Ballaststoffarm</option><option value='Ballaststoffreich' <?php if (($form_data_a[102805] ?? '') == 'Ballaststoffreich') echo 'selected'; ?>>Ballaststoffreich</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Wie sind Sie zur Zeit tätig?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_106000' name='FF_106000'  onchange='follow_select(this)'><option value=''></option><option value='Angestellt tätig' <?php if (($form_data_a[106000] ?? '') == 'Angestellt tätig') echo 'selected'; ?>>Angestellt tätig</option><option value='Selbständig tätig' <?php if (($form_data_a[106000] ?? '') == 'Selbständig tätig') echo 'selected'; ?>>Selbständig tätig</option><option value='Student*in / Schüler*in / Auszubildende(r)' <?php if (($form_data_a[106000] ?? '') == 'Student*in / Schüler*in / Auszubildende(r)') echo 'selected'; ?>>Student*in / Schüler*in / Auszubildende(r)</option><option value='Arbeitssuchend / Arbeitslos' <?php if (($form_data_a[106000] ?? '') == 'Arbeitssuchend / Arbeitslos') echo 'selected'; ?>>Arbeitssuchend / Arbeitslos</option><option value='Elternzeit' <?php if (($form_data_a[106000] ?? '') == 'Elternzeit') echo 'selected'; ?>>Elternzeit</option><option value='Berentet aufgrund CED' <?php if (($form_data_a[106000] ?? '') == 'Berentet aufgrund CED') echo 'selected'; ?>>Berentet aufgrund CED</option><option value='Berentet aufgrund anderer Erkrankungen' <?php if (($form_data_a[106000] ?? '') == 'Berentet aufgrund anderer Erkrankungen') echo 'selected'; ?>>Berentet aufgrund anderer Erkrankungen</option><option value='Nicht berufstätig' <?php if (($form_data_a[106000] ?? '') == 'Nicht berufstätig') echo 'selected'; ?>>Nicht berufstätig</option><option value='Rentner*in' <?php if (($form_data_a[106000] ?? '') == 'Rentner*in') echo 'selected'; ?>>Rentner*in</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_106000_Angestellt tätig Selbständig tätig' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Welche Erwerbstätigkeit üben Sie derzeit aus (Beruf)?</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10010'  type='text' id='FF_106500' name='FF_106500' value="<?php echo htmlspecialchars($form_data_a[106500] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:10px;'>Umfang der aktuellen Tätigkeit in Stunden?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_106600' name='FF_106600'  onchange='follow_select(this)'><option value=''></option><option value='Vollzeit (35h-40h)' <?php if (($form_data_a[106600] ?? '') == 'Vollzeit (35h-40h)') echo 'selected'; ?>>Vollzeit (35h-40h)</option><option value='Teilzeit I (20h-30h)' <?php if (($form_data_a[106600] ?? '') == 'Teilzeit I (20h-30h)') echo 'selected'; ?>>Teilzeit I (20h-30h)</option><option value='Teilzeit II (<20h)' <?php if (($form_data_a[106600] ?? '') == 'Teilzeit II (<20h)') echo 'selected'; ?>>Teilzeit II (<20h)</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106000_Angestellt tätig' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:10px;'>Waren Sie in den letzten 6 Monaten aufgrund Ihrer CED krankgeschrieben?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_106200' name='FF_106200'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[106200] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[106200] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_106200_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie viele Tage?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_106300' name='FF_106300' value="<?php echo htmlspecialchars($form_data_a[106300] ?? ''); ?>" min='1' max='180' step='1' placeholder='Angabe in Tagen'>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106000_Berentet aufgrund CED' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Seit wann sind Sie wegen Ihrer CED berentet?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_106400' name='FF_106400' value="<?php echo htmlspecialchars($form_data_a[106400] ?? ''); ?>" min='1950' max='this_year' step='1' placeholder='Jahr (vierstellig)'>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106000_Berentet aufgrund anderer Erkrankungen' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Aufgrund welcher Erkrankung sind sie berentet?</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10010'  type='text' id='FF_106100' name='FF_106100' value="<?php echo htmlspecialchars($form_data_a[106100] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Welches ist Ihr höchster Bildungsabschluß?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_106700' name='FF_106700'  onchange='follow_select(this)'><option value=''></option><option value='Keinen Schulabschluß' <?php if (($form_data_a[106700] ?? '') == 'Keinen Schulabschluß') echo 'selected'; ?>>Keinen Schulabschluß</option><option value='Hauptschulabschluß' <?php if (($form_data_a[106700] ?? '') == 'Hauptschulabschluß') echo 'selected'; ?>>Hauptschulabschluß</option><option value='Mittlere Reife' <?php if (($form_data_a[106700] ?? '') == 'Mittlere Reife') echo 'selected'; ?>>Mittlere Reife</option><option value='Abitur /Fachabitur' <?php if (($form_data_a[106700] ?? '') == 'Abitur /Fachabitur') echo 'selected'; ?>>Abitur /Fachabitur</option><option value='Abgeschlossene Berufsausbildung' <?php if (($form_data_a[106700] ?? '') == 'Abgeschlossene Berufsausbildung') echo 'selected'; ?>>Abgeschlossene Berufsausbildung</option><option value='Bachelor' <?php if (($form_data_a[106700] ?? '') == 'Bachelor') echo 'selected'; ?>>Bachelor</option><option value='Master' <?php if (($form_data_a[106700] ?? '') == 'Master') echo 'selected'; ?>>Master</option><option value='Promotion' <?php if (($form_data_a[106700] ?? '') == 'Promotion') echo 'selected'; ?>>Promotion</option><option value='Habilitation' <?php if (($form_data_a[106700] ?? '') == 'Habilitation') echo 'selected'; ?>>Habilitation</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Sind Verwandte von Ihnen an einer CED erkrankt?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_105000' name='FF_105000'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105000] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105000] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_105000_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' >Mutter / Vater</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105100' name='FF_105100'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105100] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105100] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Bruder / Schwester</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105200' name='FF_105200'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105200] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105200] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_105200_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:3px;'>Zwilling</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105300' name='FF_105300'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105300] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105300] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Sohn / Tochter</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105400' name='FF_105400'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105400] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105400] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Großvater / Großmutter</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105500' name='FF_105500'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105500] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105500] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Tante / Onkel</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105600' name='FF_105600'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105600] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105600] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Neffe / Nichte</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105700' name='FF_105700'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105700] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105700] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Cousin / Cousine</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105800' name='FF_105800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Andere</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_105900' name='FF_105900'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[105900] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[105900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			</fieldset>
			<div class='col_100 ' ><div id='B_102550_weiblich' class='block' style='display:none'>
			<fieldset class=''><legend>Schwangerschaft</legend>
					
                    <div class='col_a '>
                        <div class='desc_f' >Sind Sie schwanger?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_108500' name='FF_108500'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[108500] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[108500] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_108500_Nein' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' >Waren Sie schon einmal schwanger?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109100' name='FF_109100'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[109100] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[109100] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_109100_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' >Anzahl der Schwangerschaften?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109200' name='FF_109200'  onchange='follow_select(this)'><option value=''>Angabe 1 bis ≥7</option><option value='1' <?php if (($form_data_a[109200] ?? '') == '1') echo 'selected'; ?>>1</option><option value='2' <?php if (($form_data_a[109200] ?? '') == '2') echo 'selected'; ?>>2</option><option value='3' <?php if (($form_data_a[109200] ?? '') == '3') echo 'selected'; ?>>3</option><option value='4' <?php if (($form_data_a[109200] ?? '') == '4') echo 'selected'; ?>>4</option><option value='5' <?php if (($form_data_a[109200] ?? '') == '5') echo 'selected'; ?>>5</option><option value='6' <?php if (($form_data_a[109200] ?? '') == '6') echo 'selected'; ?>>6</option><option value='≥7' <?php if (($form_data_a[109200] ?? '') == '≥7') echo 'selected'; ?>>≥7</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >War die letzte Schwangerschaft innerhalb der letzten 6 Monate?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109300' name='FF_109300'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[109300] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[109300] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_109300_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:10px;'>Gab es Komplikationen während Ihrer letzten Schwangerschaft?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109400' name='FF_109400'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[109400] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[109400] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:10px;'>Ist Ihr Kind gesund?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_110100' name='FF_110100'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[110100] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[110100] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Schwangerschaftswoche bei Geburt?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_109500' name='FF_109500' value="<?php echo htmlspecialchars($form_data_a[109500] ?? ''); ?>" min='22' max='43' step='1' placeholder=''>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:10px;'>Geschlecht des Kindes?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109700' name='FF_109700'  onchange='follow_select(this)'><option value=''></option><option value='männlich' <?php if (($form_data_a[109700] ?? '') == 'männlich') echo 'selected'; ?>>männlich</option><option value='weiblich' <?php if (($form_data_a[109700] ?? '') == 'weiblich') echo 'selected'; ?>>weiblich</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' style='padding-left:10px;'>Wie verlief die Geburt?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109600' name='FF_109600'  onchange='follow_select(this)'><option value=''></option><option value='spontan' <?php if (($form_data_a[109600] ?? '') == 'spontan') echo 'selected'; ?>>spontan</option><option value='geplanter Kaiserschnitt' <?php if (($form_data_a[109600] ?? '') == 'geplanter Kaiserschnitt') echo 'selected'; ?>>geplanter Kaiserschnitt</option><option value='spontaner Kaiserschnitt' <?php if (($form_data_a[109600] ?? '') == 'spontaner Kaiserschnitt') echo 'selected'; ?>>spontaner Kaiserschnitt</option><option value='vaginal-operative Entbindung (Verwendung von Saugglocke oder Geburtszange)' <?php if (($form_data_a[109600] ?? '') == 'vaginal-operative Entbindung (Verwendung von Saugglocke oder Geburtszange)') echo 'selected'; ?>>vaginal-operative Entbindung (Verwendung von Saugglocke oder Geburtszange)</option></select>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Geburtsgewicht?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_109800' name='FF_109800' value="<?php echo htmlspecialchars($form_data_a[109800] ?? ''); ?>" min='400' max='10000' step='1' placeholder='in g'>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Körpergröße bei Geburt?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_109900' name='FF_109900' value="<?php echo htmlspecialchars($form_data_a[109900] ?? ''); ?>" min='20' max='700' step='1' placeholder='in cm'>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' style='padding-left:10px;'>Kopfumfang bei Geburt?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_110000' name='FF_110000' value="<?php echo htmlspecialchars($form_data_a[110000] ?? ''); ?>" min='20' max='100' step='1' placeholder='in cm'>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_108500_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' >In welcher Woche sind Sie schwanger?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_108600' name='FF_108600' value="<?php echo htmlspecialchars($form_data_a[108600] ?? ''); ?>" min='4' max='45' step='1' placeholder='Angabe Woche 4 bis 45'>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Wann ist der errechnete Geburtstermin?</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_108700_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_108700_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_108700_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108700' name='FF_108700' value="<?php echo htmlspecialchars($form_data_a[108700] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_108700','this_year','next_year',false,true,'Y(MD)','de');</script>
					
                    <div class='col_a '>
                        <div class='desc_f' >Wurde wegen der Schwangerschaft die CED Behandlung verändert?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_108800' name='FF_108800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[108800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[108800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Waren Sie vor dieser aktuellen Schwangerschaft schon einmal schwanger?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_108900' name='FF_108900'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[108900] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[108900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_108900_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' >Anzahl der Schwangerschaften (ohne die aktuelle)?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_109000' name='FF_109000'  onchange='follow_select(this)'><option value=''>Angabe 1 bis ≥7</option><option value='1' <?php if (($form_data_a[109000] ?? '') == '1') echo 'selected'; ?>>1</option><option value='2' <?php if (($form_data_a[109000] ?? '') == '2') echo 'selected'; ?>>2</option><option value='3' <?php if (($form_data_a[109000] ?? '') == '3') echo 'selected'; ?>>3</option><option value='4' <?php if (($form_data_a[109000] ?? '') == '4') echo 'selected'; ?>>4</option><option value='5' <?php if (($form_data_a[109000] ?? '') == '5') echo 'selected'; ?>>5</option><option value='6' <?php if (($form_data_a[109000] ?? '') == '6') echo 'selected'; ?>>6</option><option value='≥7' <?php if (($form_data_a[109000] ?? '') == '≥7') echo 'selected'; ?>>≥7</option></select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
			</fieldset>
			</div></div><!--block-->
			<fieldset class=''><legend>Untersuchung - Diagnose und Symptome</legend>
					
                    <div class='col_a '>
                        <div class='desc_f' >Welche Diagnose wurde bei Ihnen gestellt?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_101900' name='FF_101900'  onchange='follow_select(this)'><option value=''></option><option value='Morbus Crohn' <?php if (($form_data_a[101900] ?? '') == 'Morbus Crohn') echo 'selected'; ?>>Morbus Crohn</option><option value='Colitis ulcerosa' <?php if (($form_data_a[101900] ?? '') == 'Colitis ulcerosa') echo 'selected'; ?>>Colitis ulcerosa</option><option value='Colitis indeterminata' <?php if (($form_data_a[101900] ?? '') == 'Colitis indeterminata') echo 'selected'; ?>>Colitis indeterminata</option></select>
                    </div>
			<div class='col_100 medic' ><div id='B_101900_Morbus Crohn' class='block' style='display:none'>
					<div class='col_100 infotext medic' style='text-align:right'>Benennen Sie bitte die Lokalisation des M. Crohn</div>
					<div class='col_100 infotext medic'><hr style='margin-top:-2px;margin-bottom:-2px'></div>
				<div class='row medic'>
					
                    <div class='col_a medic'></div>
                    <div class='col_b medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td>
                                    <input type='hidden' id='FF_101902' name='FF_101902' value='0'><input type='checkbox' id='FF_101902' name='FF_101902' value='1' <?php if (($form_data_a[101902] ?? '') == '1') echo 'checked'; ?>>
                                </td>
                                <td>
                                    <div class='desc_f'>Nur terminales Ileum</div>
                                </td>
                            </tr>
                        </table>
                    </div>
					
                    <div class='col_a medic'></div>
                    <div class='col_b medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td>
                                    <input type='hidden' id='FF_101904' name='FF_101904' value='0'><input type='checkbox' id='FF_101904' name='FF_101904' value='1' <?php if (($form_data_a[101904] ?? '') == '1') echo 'checked'; ?>>
                                </td>
                                <td>
                                    <div class='desc_f'>Nur Colon</div>
                                </td>
                            </tr>
                        </table>
                    </div>
					
                    <div class='col_a medic'></div>
                    <div class='col_b medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td>
                                    <input type='hidden' id='FF_101906' name='FF_101906' value='0'><input type='checkbox' id='FF_101906' name='FF_101906' value='1' <?php if (($form_data_a[101906] ?? '') == '1') echo 'checked'; ?>>
                                </td>
                                <td>
                                    <div class='desc_f'>Ileo-Colon</div>
                                </td>
                            </tr>
                        </table>
                    </div>
					
                    <div class='col_a medic'></div>
                    <div class='col_b medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td>
                                    <input type='hidden' id='FF_101908' name='FF_101908' value='0'><input type='checkbox' id='FF_101908' name='FF_101908' value='1' <?php if (($form_data_a[101908] ?? '') == '1') echo 'checked'; ?>>
                                </td>
                                <td>
                                    <div class='desc_f'>Oberer GI-Trakt (Öspohagus u./o. Magen u./o. Duodenum)</div>
                                </td>
                            </tr>
                        </table>
                    </div>
					
                    <div class='col_a medic'></div>
                    <div class='col_b medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td>
                                    <input type='hidden' id='FF_101910' name='FF_101910' value='0'><input type='checkbox' id='FF_101910' name='FF_101910' value='1' <?php if (($form_data_a[101910] ?? '') == '1') echo 'checked'; ?>>
                                </td>
                                <td>
                                    <div class='desc_f'>Dünndarmbefall (Jejunum / Ileum (außer term. Ileum)</div>
                                </td>
                            </tr>
                        </table>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_101900_Colitis ulcerosa Colitis indeterminata' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Benennen Sie bitte die Lokalisation der Colitis ulcerosa</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_102000' name='FF_102000'  onchange='follow_select(this)'><option value=''></option><option value='Proktitis' <?php if (($form_data_a[102000] ?? '') == 'Proktitis') echo 'selected'; ?>>Proktitis</option><option value='Linksseiten Colitis' <?php if (($form_data_a[102000] ?? '') == 'Linksseiten Colitis') echo 'selected'; ?>>Linksseiten Colitis</option><option value='Pancolitis' <?php if (($form_data_a[102000] ?? '') == 'Pancolitis') echo 'selected'; ?>>Pancolitis</option></select>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a'>
                        <div class='desc_f' >Datum der Erstdiagnose</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_102200_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102200_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_102200_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';' required size='12' class='control_input' id='FF_102200' name='FF_102200' value="<?php echo htmlspecialchars($form_data_a[102200] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102200','1960','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col_a'>
                        <div class='desc_f' >Ersten Symptome Ihrer Erkrankung?</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_102300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102300_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_102300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';' required size='12' class='control_input' id='FF_102300' name='FF_102300' value="<?php echo htmlspecialchars($form_data_a[102300] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102300','1960','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col_a '>
                        <div class='desc_f' >Waren Sie seit Ihrer letzten CEDUR-Befragung im Krankenhaus?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_102400' name='FF_102400'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[102400] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[102400] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_102400_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' >Wieviele Tage?</div>
                    </div>
                    <div class='col_b'>
                        <input  type='number' id='FF_102500' name='FF_102500' value="<?php echo htmlspecialchars($form_data_a[102500] ?? ''); ?>" min='1' max='300' step='1' placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Haben Sie zur Zeit ein Stoma (künstlicher Darmausgang)?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_106800' name='FF_106800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[106800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[106800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a'>
                        <div class='desc_f' >Wie viele flüssige / breiige Stuhlgänge (Bei Stoma: Beutelentleerungen) hatten Sie in der vergangenen Woche durchschnittlich pro Tag?</div>
                    </div>
                    <div class='col_b'>
                        <input required type='number' id='FF_103500' name='FF_103500' value="<?php echo htmlspecialchars($form_data_a[103500] ?? ''); ?>" min='0' max='50' step='1' placeholder=''>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Blutbeimengungen beim Stuhl</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_103600' name='FF_103600'  onchange='follow_select(this)'><option value=''></option><option value='kein Blut' <?php if (($form_data_a[103600] ?? '') == 'kein Blut') echo 'selected'; ?>>kein Blut</option><option value='Blut bei weniger als der Hälfte der Stuhlgänge' <?php if (($form_data_a[103600] ?? '') == 'Blut bei weniger als der Hälfte der Stuhlgänge') echo 'selected'; ?>>Blut bei weniger als der Hälfte der Stuhlgänge</option><option value='deutliche Blutbeimengung' <?php if (($form_data_a[103600] ?? '') == 'deutliche Blutbeimengung') echo 'selected'; ?>>deutliche Blutbeimengung</option><option value='Blut auch ohne Stuhl' <?php if (($form_data_a[103600] ?? '') == 'Blut auch ohne Stuhl') echo 'selected'; ?>>Blut auch ohne Stuhl</option></select>
                    </div>
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Globale Beurteilung des Krankheitszustandes</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_103700' name='FF_103700'  onchange='follow_select(this)'><option value=''></option><option value='normal' <?php if (($form_data_a[103700] ?? '') == 'normal') echo 'selected'; ?>>normal</option><option value='mild' <?php if (($form_data_a[103700] ?? '') == 'mild') echo 'selected'; ?>>mild</option><option value='moderate Erkrankung' <?php if (($form_data_a[103700] ?? '') == 'moderate Erkrankung') echo 'selected'; ?>>moderate Erkrankung</option><option value='schwere Erkrankung' <?php if (($form_data_a[103700] ?? '') == 'schwere Erkrankung') echo 'selected'; ?>>schwere Erkrankung</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_101900_Colitis ulcerosa' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a'>
                        <div class='desc_f' >Endoskopischer Befund Mayo Score (falls vorhanden)</div>
                    </div>
                    <div class='col_b'>
                        <input data-fg='10010'  type='text' id='FF_103800' name='FF_103800' value="<?php echo htmlspecialchars($form_data_a[103800] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Bauchschmerzen über die letzten 7 Tage</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_103900' name='FF_103900'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[103900] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='leichte' <?php if (($form_data_a[103900] ?? '') == 'leichte') echo 'selected'; ?>>leichte</option><option value='mäßige' <?php if (($form_data_a[103900] ?? '') == 'mäßige') echo 'selected'; ?>>mäßige</option><option value='schwere' <?php if (($form_data_a[103900] ?? '') == 'schwere') echo 'selected'; ?>>schwere</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Ihr Allgemeinbefinden über die letzten 7 Tage</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_104000' name='FF_104000'  onchange='follow_select(this)'><option value=''></option><option value='gut' <?php if (($form_data_a[104000] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='beeinträchtigt' <?php if (($form_data_a[104000] ?? '') == 'beeinträchtigt') echo 'selected'; ?>>beeinträchtigt</option><option value='schlecht' <?php if (($form_data_a[104000] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option><option value='sehr schlecht' <?php if (($form_data_a[104000] ?? '') == 'sehr schlecht') echo 'selected'; ?>>sehr schlecht</option><option value='unerträglich' <?php if (($form_data_a[104000] ?? '') == 'unerträglich') echo 'selected'; ?>>unerträglich</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' >Haben oder hatten Sie Fisteln? (Wenn Sie nicht wissen, was das ist, haben bzw. hatten Sie auch keine)</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_104100' name='FF_104100'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104100] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104100] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_104100_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' >Haben Sie aktuell Fisteln?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_104200' name='FF_104200'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104200] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104200] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_104200_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Perianale Crohn Erkrankung (z.B. Fisteln, Fissuren, Abszesse)</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_104300' name='FF_104300'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104300] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104300] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Andere Fisteln (z.B. rektovesikal, Bauchdeckenfistel etc.)</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_104400' name='FF_104400'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104400] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104400] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Hatten Sie Fisteln?</div>
                    </div>
                    <div class='col_b '>
                        <select  id='FF_104500' name='FF_104500'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104500] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104500] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_104500_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Analfissur, Analfistel(n)</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_104600' name='FF_104600'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104600] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104600] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Andere Fisteln</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_104700' name='FF_104700'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104700] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104700] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col_a medic'>
                        <div class='desc_f' >Hat oder hatte der Patient Stenosen?</div>
                    </div>
                    <div class='col_b medic'>
                        <select  id='FF_104800' name='FF_104800'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[104800] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[104800] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_104800_Ja' class='block' style='display:none'>
					<div class='col_100 infotext medic'>Lokalisation der Stenose</div>
					
                    <div class='col_100 medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td><input type='hidden' id='FF_104900' name='FF_104900' value='0'><input type='checkbox' id='FF_104900' name='FF_104900' value='1' <?php if (($form_data_a[104900] ?? '') == '1') echo 'checked'; ?>></td>
                                <td><div class='desc_f'>Dünndarmstenose</div></td>
                            </tr>
                            </table>
                    </div>
					
                    <div class='col_100 medic'>
                        <table class='table-checkbox_1'>
                            <tr>
                                <td><input type='hidden' id='FF_104910' name='FF_104910' value='0'><input type='checkbox' id='FF_104910' name='FF_104910' value='1' <?php if (($form_data_a[104910] ?? '') == '1') echo 'checked'; ?>></td>
                                <td><div class='desc_f'>Dickdarmstenose</div></td>
                            </tr>
                            </table>
                    </div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Haben Sie noch weitere Erkrankungen?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_111200' name='FF_111200'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[111200] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[111200] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_111200_Ja' class='block' style='display:none'>
				<div class='row '>
					
                    <div class='col_a '>
                        <div class='desc_f' >Bitte wählen Sie die Erkrankungen</div>
                    </div>
                    <div class='col_b '>
                        <select id='mts_1113001' name='mts_1113001'><option value=''></option><option value='Akne inversa' <?php if (($form_data_a[1113001] ?? '') == 'Akne inversa') echo 'selected'; ?>>Akne inversa</option><option value='Asthma bronchiale' <?php if (($form_data_a[1113001] ?? '') == 'Asthma bronchiale') echo 'selected'; ?>>Asthma bronchiale</option><option value='Bauchspeicheldrüsenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Bauchspeicheldrüsenkrebs') echo 'selected'; ?>>Bauchspeicheldrüsenkrebs</option><option value='Blasenentzündung' <?php if (($form_data_a[1113001] ?? '') == 'Blasenentzündung') echo 'selected'; ?>>Blasenentzündung</option><option value='Bluthochdruck' <?php if (($form_data_a[1113001] ?? '') == 'Bluthochdruck') echo 'selected'; ?>>Bluthochdruck</option><option value='Brustkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Brustkrebs') echo 'selected'; ?>>Brustkrebs</option><option value='Darmkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Darmkrebs') echo 'selected'; ?>>Darmkrebs</option><option value='Diabetes mellitus' <?php if (($form_data_a[1113001] ?? '') == 'Diabetes mellitus') echo 'selected'; ?>>Diabetes mellitus</option><option value='Depression' <?php if (($form_data_a[1113001] ?? '') == 'Depression') echo 'selected'; ?>>Depression</option><option value='Eierstock-Krebs' <?php if (($form_data_a[1113001] ?? '') == 'Eierstock-Krebs') echo 'selected'; ?>>Eierstock-Krebs</option><option value='Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)' <?php if (($form_data_a[1113001] ?? '') == 'Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)') echo 'selected'; ?>>Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)</option><option value='Fettstoffwechselstörung' <?php if (($form_data_a[1113001] ?? '') == 'Fettstoffwechselstörung') echo 'selected'; ?>>Fettstoffwechselstörung</option><option value='Gallensteine' <?php if (($form_data_a[1113001] ?? '') == 'Gallensteine') echo 'selected'; ?>>Gallensteine</option><option value='Grauer Star' <?php if (($form_data_a[1113001] ?? '') == 'Grauer Star') echo 'selected'; ?>>Grauer Star</option><option value='Grüner Star' <?php if (($form_data_a[1113001] ?? '') == 'Grüner Star') echo 'selected'; ?>>Grüner Star</option><option value='Gürtelrose (Herpes zoster)' <?php if (($form_data_a[1113001] ?? '') == 'Gürtelrose (Herpes zoster)') echo 'selected'; ?>>Gürtelrose (Herpes zoster)</option><option value='Hautkrebs (schwarzer und weiÃŸer Hautkrebs)' <?php if (($form_data_a[1113001] ?? '') == 'Hautkrebs (schwarzer und weiÃŸer Hautkrebs)') echo 'selected'; ?>>Hautkrebs (schwarzer und weiÃŸer Hautkrebs)</option><option value='Haarausfall' <?php if (($form_data_a[1113001] ?? '') == 'Haarausfall') echo 'selected'; ?>>Haarausfall</option><option value='Hepatitis (A, B, C, D oder E)' <?php if (($form_data_a[1113001] ?? '') == 'Hepatitis (A, B, C, D oder E)') echo 'selected'; ?>>Hepatitis (A, B, C, D oder E)</option><option value='Herzinfarkt' <?php if (($form_data_a[1113001] ?? '') == 'Herzinfarkt') echo 'selected'; ?>>Herzinfarkt</option><option value='Hodenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Hodenkrebs') echo 'selected'; ?>>Hodenkrebs</option><option value='HIV' <?php if (($form_data_a[1113001] ?? '') == 'HIV') echo 'selected'; ?>>HIV</option><option value='Koronare Herzkrankheit' <?php if (($form_data_a[1113001] ?? '') == 'Koronare Herzkrankheit') echo 'selected'; ?>>Koronare Herzkrankheit</option><option value='Kurzdarmsyndrom' <?php if (($form_data_a[1113001] ?? '') == 'Kurzdarmsyndrom') echo 'selected'; ?>>Kurzdarmsyndrom</option><option value='Leberzirrhose' <?php if (($form_data_a[1113001] ?? '') == 'Leberzirrhose') echo 'selected'; ?>>Leberzirrhose</option><option value='Leukämie' <?php if (($form_data_a[1113001] ?? '') == 'Leukämie') echo 'selected'; ?>>Leukämie</option><option value='Lungenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Lungenkrebs') echo 'selected'; ?>>Lungenkrebs</option><option value='Lymphdrüsenkrebs' <?php if (($form_data_a[1113001] ?? '') == 'Lymphdrüsenkrebs') echo 'selected'; ?>>Lymphdrüsenkrebs</option><option value='Migräne' <?php if (($form_data_a[1113001] ?? '') == 'Migräne') echo 'selected'; ?>>Migräne</option><option value='Multiple Sklerose (MS)' <?php if (($form_data_a[1113001] ?? '') == 'Multiple Sklerose (MS)') echo 'selected'; ?>>Multiple Sklerose (MS)</option><option value='Nierenerkrankung' <?php if (($form_data_a[1113001] ?? '') == 'Nierenerkrankung') echo 'selected'; ?>>Nierenerkrankung</option><option value='Nierensteine' <?php if (($form_data_a[1113001] ?? '') == 'Nierensteine') echo 'selected'; ?>>Nierensteine</option><option value='Osteoporose' <?php if (($form_data_a[1113001] ?? '') == 'Osteoporose') echo 'selected'; ?>>Osteoporose</option><option value='PBC (Primär biliäre Zirrhose / Cholangitis)' <?php if (($form_data_a[1113001] ?? '') == 'PBC (Primär biliäre Zirrhose / Cholangitis)') echo 'selected'; ?>>PBC (Primär biliäre Zirrhose / Cholangitis)</option><option value='Prostatakrebs' <?php if (($form_data_a[1113001] ?? '') == 'Prostatakrebs') echo 'selected'; ?>>Prostatakrebs</option><option value='PSC (primär)' <?php if (($form_data_a[1113001] ?? '') == 'PSC (primär)') echo 'selected'; ?>>PSC (primär)</option><option value='Rheumatoide Arthritis' <?php if (($form_data_a[1113001] ?? '') == 'Rheumatoide Arthritis') echo 'selected'; ?>>Rheumatoide Arthritis</option><option value='Schilddrüsenüberfunktion' <?php if (($form_data_a[1113001] ?? '') == 'Schilddrüsenüberfunktion') echo 'selected'; ?>>Schilddrüsenüberfunktion</option><option value='Schilddrüsenunterfunktion' <?php if (($form_data_a[1113001] ?? '') == 'Schilddrüsenunterfunktion') echo 'selected'; ?>>Schilddrüsenunterfunktion</option><option value='Schlafstörungen' <?php if (($form_data_a[1113001] ?? '') == 'Schlafstörungen') echo 'selected'; ?>>Schlafstörungen</option><option value='Schuppenflechte' <?php if (($form_data_a[1113001] ?? '') == 'Schuppenflechte') echo 'selected'; ?>>Schuppenflechte</option><option value='Thrombose' <?php if (($form_data_a[1113001] ?? '') == 'Thrombose') echo 'selected'; ?>>Thrombose</option></select>
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
                    
					
                    <div class='col_a '>
                        <div class='desc_f' >Andere Erkrankungen falls nicht in der Liste:</div>
                    </div>
                    <div class='col_b '>
                        <textarea id='FF_115500' name='FF_115500' rows='2'><?php echo htmlspecialchars($form_data_a[115500] ?? ''); ?></textarea>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a '>
                        <div class='desc_f' >Sind Sie schon einmal wegen Ihrer CED am Darm operiert worden?</div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_106900' name='FF_106900'  onchange='follow_select(this)'><option value=''></option><option value='Nein' <?php if (($form_data_a[106900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='1 Mal' <?php if (($form_data_a[106900] ?? '') == '1 Mal') echo 'selected'; ?>>1 Mal</option><option value='2 Mal' <?php if (($form_data_a[106900] ?? '') == '2 Mal') echo 'selected'; ?>>2 Mal</option><option value='3 Mal' <?php if (($form_data_a[106900] ?? '') == '3 Mal') echo 'selected'; ?>>3 Mal</option><option value='4 Mal' <?php if (($form_data_a[106900] ?? '') == '4 Mal') echo 'selected'; ?>>4 Mal</option><option value='5 Mal' <?php if (($form_data_a[106900] ?? '') == '5 Mal') echo 'selected'; ?>>5 Mal</option></select>
                    </div>
			<div class='col_100 ' ><div id='B_106900_1 Mal 2 Mal 3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row '>
					<div class='col_100 infotext '><b>1. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_107100_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_107100_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_107100_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107100' name='FF_107100' value="<?php echo htmlspecialchars($form_data_a[107100] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_107100','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                            <select id='FF_107200' name='FF_107200'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107200] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107200] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[107200] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106900_2 Mal 3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row '>
					<div class='col_100 infotext '><b>2. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_107400_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_107400_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_107400_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107400' name='FF_107400' value="<?php echo htmlspecialchars($form_data_a[107400] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_107400','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                            <select id='FF_107500' name='FF_107500'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107500] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107500] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[107500] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106900_3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row '>
					<div class='col_100 infotext '><b>3. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_107700_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_107700_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_107700_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107700' name='FF_107700' value="<?php echo htmlspecialchars($form_data_a[107700] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_107700','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                            <select id='FF_107800' name='FF_107800'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107800] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107800] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[107800] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106900_4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row '>
					<div class='col_100 infotext '><b>4. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_108000_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_108000_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_108000_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108000' name='FF_108000' value="<?php echo htmlspecialchars($form_data_a[108000] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_108000','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                            <select id='FF_108100' name='FF_108100'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[108100] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[108100] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[108100] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100 ' ><div id='B_106900_5 Mal' class='block' style='display:none'>
				<div class='row '>
					<div class='col_100 infotext '><b>5. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <select id='FF_108300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_108300_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                        <select id='FF_108300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108300' name='FF_108300' value="<?php echo htmlspecialchars($form_data_a[108300] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_108300','1950','this_year',true,false,'Y(MD)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                            <select id='FF_108400' name='FF_108400'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[108400] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[108400] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='protektives Ileostoma' <?php if (($form_data_a[108400] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			</fieldset>
			<fieldset class=''><legend>Stuhldrang</legend>
					
                    <div class='col' style='width:100%'>
                        <div class='desc_f'> Wie stark war Ihr Stuhldrang (plötzliches oder dringendes Bedürfnis) in den vergangenen 24 Stunden?</div>
                        <div class='slider-container'>
                            <label for='119000_wertSchieberegler' class='slider-label start-label'>Kein Stuhldrang</label>
                            <input class='wertSchieberegler' type='range' id='119000_wertSchieberegler' min='0' max='10' value=0 step='1'>
                            <label for='119000_wertSchieberegler' class='slider-label end-label'>Schlimmstmöglicher Stuhldrang</label>
                        </div>
                    </div>
                    <input type='hidden' id='FF_119000' name='FF_119000' value="<?php echo htmlspecialchars($form_data_a[119000] ?? ''); ?>">
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                        const slider = document.getElementById('119000_wertSchieberegler');
                        const textField = document.getElementById('FF_119000');
                        if (!slider || !textField) {
                            console.error('Schieberegler oder Textfeld nicht gefunden. Bitte IDs prüfen!');
                            return;
                        }
                        const updateTextFieldFromSlider = () => {
                            const sliderValue = parseInt(slider.value, 10); 
                            textField.value = sliderValue; 
                        };
                        const updateSliderFromTextField = () => {
                            let textValue = parseInt(textField.value, 10);
                            if (isNaN(textValue) || textValue < 1 || textValue > 10) {
                                textValue = Math.max(1, Math.min(10, textValue || 5));
                            }
                            slider.value = textValue;
                            textField.value = textValue;
                        };
                        slider.addEventListener('input', updateTextFieldFromSlider);
                        textField.addEventListener('change', updateSliderFromTextField); 
                        if (textField.value !== '') {
                            updateSliderFromTextField(); 
                        } else {
                            updateTextFieldFromSlider(); 
                        }
                    });
                    </script>
			</fieldset>
			<fieldset class=''><legend>Lebensqualität (SIDBQ)</legend>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Wie oft war das Gefühl von Abgeschlagenheit oder Müdigkeit und Abgespanntheit in den letzten zwei Wochen ein Problem für Sie? Bitte geben Sie an, wie oft das Gefühl von Müdigkeit oder Abgespanntheit in den letzten zwei Wochen ein Problem für Sie war.</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_116700' name='FF_116700'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[116700] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[116700] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[116700] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[116700] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[116700] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[116700] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[116700] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Wie oft mussten Sie aufgrund Ihrer Darmerkrankung in den letzten zwei Wochen Treffen mit Freunden und/oder Verwandten verschieben oder absagen?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_116800' name='FF_116800'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[116800] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[116800] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[116800] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[116800] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[116800] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[116800] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[116800] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Hatten Sie in den letzten zwei Wochen aufgrund Ihrer Darmerkrankung Schwierigkeiten, gewünschten Sport- und Freizeitaktivitäten nachzugehen?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_116900' name='FF_116900'  onchange='follow_select(this)'><option value=''></option><option value='Sehr grosse Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Sehr grosse Schwierigkeiten') echo 'selected'; ?>>Sehr grosse Schwierigkeiten</option><option value='Grosse Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Grosse Schwierigkeiten') echo 'selected'; ?>>Grosse Schwierigkeiten</option><option value='Ziemliche Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Ziemliche Schwierigkeiten') echo 'selected'; ?>>Ziemliche Schwierigkeiten</option><option value='Etwas Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Etwas Schwierigkeiten') echo 'selected'; ?>>Etwas Schwierigkeiten</option><option value='Wenig Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Wenig Schwierigkeiten') echo 'selected'; ?>>Wenig Schwierigkeiten</option><option value='Kaum Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Kaum Schwierigkeiten') echo 'selected'; ?>>Kaum Schwierigkeiten</option><option value='Keine Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Keine Schwierigkeiten') echo 'selected'; ?>>Keine Schwierigkeiten</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Wie oft haben Sie in den letzten zwei Wochen unter Bauchschmerzen gelitten?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117000' name='FF_117000'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117000] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117000] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117000] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117000] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117000] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117000] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117000] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>5.</td><td>Wie oft haben Sie sich in den letzten zwei Wochen bedrückt oder entmutigt gefühlt?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117100' name='FF_117100'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117100] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117100] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117100] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117100] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117100] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117100] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117100] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>6.</td><td></b> Hatten Sie in den letzten zwei Wochen Probleme mit dem Abgehenlassen von Blähungen?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117200' name='FF_117200'  onchange='follow_select(this)'><option value=''></option><option value='Sehr grosse Probleme' <?php if (($form_data_a[117200] ?? '') == 'Sehr grosse Probleme') echo 'selected'; ?>>Sehr grosse Probleme</option><option value='Grosse Probleme' <?php if (($form_data_a[117200] ?? '') == 'Grosse Probleme') echo 'selected'; ?>>Grosse Probleme</option><option value='Ziemliche Probleme' <?php if (($form_data_a[117200] ?? '') == 'Ziemliche Probleme') echo 'selected'; ?>>Ziemliche Probleme</option><option value='Etwas Probleme' <?php if (($form_data_a[117200] ?? '') == 'Etwas Probleme') echo 'selected'; ?>>Etwas Probleme</option><option value='Wenig Probleme' <?php if (($form_data_a[117200] ?? '') == 'Wenig Probleme') echo 'selected'; ?>>Wenig Probleme</option><option value='Kaum Probleme' <?php if (($form_data_a[117200] ?? '') == 'Kaum Probleme') echo 'selected'; ?>>Kaum Probleme</option><option value='Kein Problem' <?php if (($form_data_a[117200] ?? '') == 'Kein Problem') echo 'selected'; ?>>Kein Problem</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>7.</td><td>Hatten Sie in den letzten zwei Wochen Probleme, Ihr gewünschtes Gewicht zu halten oder zu erreichen?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117300' name='FF_117300'  onchange='follow_select(this)'><option value=''></option><option value='Sehr grosse Probleme' <?php if (($form_data_a[117300] ?? '') == 'Sehr grosse Probleme') echo 'selected'; ?>>Sehr grosse Probleme</option><option value='Grosse Probleme' <?php if (($form_data_a[117300] ?? '') == 'Grosse Probleme') echo 'selected'; ?>>Grosse Probleme</option><option value='Ziemliche Probleme' <?php if (($form_data_a[117300] ?? '') == 'Ziemliche Probleme') echo 'selected'; ?>>Ziemliche Probleme</option><option value='Etwas Probleme' <?php if (($form_data_a[117300] ?? '') == 'Etwas Probleme') echo 'selected'; ?>>Etwas Probleme</option><option value='Wenig Probleme' <?php if (($form_data_a[117300] ?? '') == 'Wenig Probleme') echo 'selected'; ?>>Wenig Probleme</option><option value='Kaum Probleme' <?php if (($form_data_a[117300] ?? '') == 'Kaum Probleme') echo 'selected'; ?>>Kaum Probleme</option><option value='Kein Problem' <?php if (($form_data_a[117300] ?? '') == 'Kein Problem') echo 'selected'; ?>>Kein Problem</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>8.</td><td>Wie oft haben Sie sich in den letzten zwei Wochen locker und entspannt gefühlt?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117400' name='FF_117400'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117400] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117400] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117400] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117400] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117400] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117400] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117400] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>9.</td><td>Wie oft haben Sie in den letzten zwei Wochen unter dem Gefühl gelitten, zur Toilette gehen zu müssen, obwohl Ihr Darm leer war?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117500' name='FF_117500'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117500] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117500] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117500] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117500] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117500] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117500] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117500] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>10.</td><td>Wie oft haben Sie sich in den letzten zwei Wochen aufgrund Ihrer Darmerkrankung zornig gefühlt?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117600' name='FF_117600'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117600] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117600] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117600] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117600] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117600] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117600] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117600] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option></select>
                    </div>
			</fieldset>
			<fieldset class=''><legend>Lebensqualität (FACIT - Fragebogen zur Einstufung der Erschöpfung)</legend>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Ich bin erschöpft</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117700' name='FF_117700'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[117700] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[117700] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[117700] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[117700] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[117700] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Ich fühle mich insgesamt schwach</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117800' name='FF_117800'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[117800] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[117800] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[117800] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[117800] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[117800] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Ich fühle mich lustlos (ausgelaugt)</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_117900' name='FF_117900'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[117900] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[117900] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[117900] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[117900] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[117900] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Ich bin müde</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118000' name='FF_118000'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118000] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118000] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118000] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118000] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118000] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>5.</td><td>Es fällt mir schwer, etwas anzufangen, weil ich müde bin</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118100' name='FF_118100'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118100] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118100] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118100] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118100] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118100] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>6.</td><td>Es fällt mir schwer, etwas zu Ende zu führen, weil ich müde bin</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118200' name='FF_118200'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118200] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118200] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118200] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118200] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118200] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>7.</td><td>Ich habe Energie</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118300' name='FF_118300'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118300] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118300] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118300] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118300] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118300] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>8.</td><td>Ich bin in der Lage, meinen gewohnten Aktivitäten nachzugehen (Beruf, Einkaufen, Schule, Freizeit, Sport usw.)</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118400' name='FF_118400'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118400] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118400] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118400] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118400] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118400] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>9.</td><td>Ich habe das Bedürfnis, tagsüber zu schlafen.</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118500' name='FF_118500'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118500] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118500] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118500] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118500] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118500] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>10.</td><td>Ich bin zu müde, um zu essen</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118600' name='FF_118600'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118600] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118600] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118600] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118600] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118600] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>11.</td><td>Ich brauche Hilfe bei meinen gewohnten Aktivitäten (Beruf, Einkaufen, Schule, Freizeit, Sport usw.)</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118700' name='FF_118700'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118700] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118700] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118700] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118700] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118700] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>12.</td><td>Ich bin frustriert weil ich zu müde bin, die Dinge zu tun, die ich machen möchte</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118800' name='FF_118800'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118800] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118800] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118800] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118800] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118800] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>13.</td><td>Ich musste meine sozialen Aktivitäten einschränken, weil ich müde bin.</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_118900' name='FF_118900'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118900] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118900] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118900] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118900] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118900] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option></select>
                    </div>
			</fieldset>
			<fieldset class=''><legend>Lebensqualität (PROMIS)</legend>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Wie würden Sie Ihren Gesundheitszustand insgesamt beschreiben?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119100' name='FF_119100'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119100] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119100] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119100] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119100] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119100] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Wie würden Sie Ihr Lebensqualität insgesamt beschreiben?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119110' name='FF_119110'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119110] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119110] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119110] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119110] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119110] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Wie würden Sie Ihren körperlichen Gesundheitszustand insgesamt beschreiben?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119120' name='FF_119120'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119120] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119120] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119120] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119120] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119120] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Wie würden Sie Ihre psychische Verfassung insgesamt beschreiben?<br>(Dazu zählen Ihre Stimmung und Ihre Fähigkeit, klar zu denken.)</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119130' name='FF_119130'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119130] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119130] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119130] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119130] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119130] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>5.</td><td>Wie zufrieden sind Sie insgesamt mit Ihren Aktivitäten mit anderen Menschen und mit Ihren Beziehungen zu anderen?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119140' name='FF_119140'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119140] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119140] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119140] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119140] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119140] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>6.</td><td>Wie gut sind Sie insgesamt in der Lage, Aktivitäten mit anderen Menschen nachzugehen und Ihre Rollen im Alltag und in der Gemeinschaft auszufüllen.<br>(Dazu zählen Aktivitäten zu Hause, am Arbeitsplatz, in Ihrem Umfeld sowie Ihre Aufgaben als Elternteil, Sohn, Tochter, Lebenspartner/-in, im Berufsleben, in Ihrem Freundeskreis usw.)</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119150' name='FF_119150'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119150] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119150] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119150] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119150] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119150] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>7.</td><td>Inwieweit sind Sie in der Lage, alltägliche körperliche Aktivitäten auszuführen, z. B. Gehen, Treppensteigen, Einkäufe tragen oder Stühle verschieben?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119160' name='FF_119160'  onchange='follow_select(this)'><option value=''></option><option value='vollständig' <?php if (($form_data_a[119160] ?? '') == 'vollständig') echo 'selected'; ?>>vollständig</option><option value='größtenteils' <?php if (($form_data_a[119160] ?? '') == 'größtenteils') echo 'selected'; ?>>größtenteils</option><option value='halbwegs' <?php if (($form_data_a[119160] ?? '') == 'halbwegs') echo 'selected'; ?>>halbwegs</option><option value='ein wenig' <?php if (($form_data_a[119160] ?? '') == 'ein wenig') echo 'selected'; ?>>ein wenig</option><option value='überhaupt nicht' <?php if (($form_data_a[119160] ?? '') == 'überhaupt nicht') echo 'selected'; ?>>überhaupt nicht</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>8.</td><td>Wie oft haben Ihnen seelische Probleme zu schaffen gemacht, wie z. B. Angstgefühle, Traurigkeit, Niedergeschlagenheit oder Reizbarkeit? </td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119170' name='FF_119170'  onchange='follow_select(this)'><option value=''></option><option value='nie' <?php if (($form_data_a[119170] ?? '') == 'nie') echo 'selected'; ?>>nie</option><option value='selten' <?php if (($form_data_a[119170] ?? '') == 'selten') echo 'selected'; ?>>selten</option><option value='manchmal' <?php if (($form_data_a[119170] ?? '') == 'manchmal') echo 'selected'; ?>>manchmal</option><option value='oft' <?php if (($form_data_a[119170] ?? '') == 'oft') echo 'selected'; ?>>oft</option><option value='immer' <?php if (($form_data_a[119170] ?? '') == 'immer') echo 'selected'; ?>>immer</option></select>
                    </div>
					
                    <div class='col_a '>
                        <div class='desc_f' ><table class='td_num'><tr><td>9.</td><td>Wie ausgepägt war Ihre Müdigkeit im Durchschnitt?</td></tr></table></div>
                    </div>
                    <div class='col_b '>
                        <select required id='FF_119180' name='FF_119180'  onchange='follow_select(this)'><option value=''></option><option value='keine Müdigkeit' <?php if (($form_data_a[119180] ?? '') == 'keine Müdigkeit') echo 'selected'; ?>>keine Müdigkeit</option><option value='schwach' <?php if (($form_data_a[119180] ?? '') == 'schwach') echo 'selected'; ?>>schwach</option><option value='mäßig' <?php if (($form_data_a[119180] ?? '') == 'mäßig') echo 'selected'; ?>>mäßig</option><option value='stark' <?php if (($form_data_a[119180] ?? '') == 'stark') echo 'selected'; ?>>stark</option><option value='sehr stark' <?php if (($form_data_a[119180] ?? '') == 'sehr stark') echo 'selected'; ?>>sehr stark</option></select>
                    </div>
					
                    <div class='col' style='width:100%'>
                        <div class='desc_f'><table class='td_num'><tr><td>10.</td><td>Wie würden Sie Ihre Schmerzen im Allgemeinen einschätzen?</td></tr></table></div>
                        <div class='slider-container'>
                            <label for='119190_wertSchieberegler' class='slider-label start-label'>Keine Schmerzen</label>
                            <input class='wertSchieberegler' type='range' id='119190_wertSchieberegler' min='0' max='10' value=0 step='1'>
                            <label for='119190_wertSchieberegler' class='slider-label end-label'>Schlimmstmögliche Schmerzen</label>
                        </div>
                    </div>
                    <input type='hidden' id='FF_119190' name='FF_119190' value="<?php echo htmlspecialchars($form_data_a[119190] ?? ''); ?>">
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                        const slider = document.getElementById('119190_wertSchieberegler');
                        const textField = document.getElementById('FF_119190');
                        if (!slider || !textField) {
                            console.error('Schieberegler oder Textfeld nicht gefunden. Bitte IDs prüfen!');
                            return;
                        }
                        const updateTextFieldFromSlider = () => {
                            const sliderValue = parseInt(slider.value, 10); 
                            textField.value = sliderValue; 
                        };
                        const updateSliderFromTextField = () => {
                            let textValue = parseInt(textField.value, 10);
                            if (isNaN(textValue) || textValue < 1 || textValue > 10) {
                                textValue = Math.max(1, Math.min(10, textValue || 5));
                            }
                            slider.value = textValue;
                            textField.value = textValue;
                        };
                        slider.addEventListener('input', updateTextFieldFromSlider);
                        textField.addEventListener('change', updateSliderFromTextField); 
                        if (textField.value !== '') {
                            updateSliderFromTextField(); 
                        } else {
                            updateTextFieldFromSlider(); 
                        }
                    });
                    </script>
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