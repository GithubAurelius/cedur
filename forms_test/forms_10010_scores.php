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
    <title>Einfaches HTML Formular</title>
    <?php
    $file_add_start = str_replace(".php", "_add_start.php", "./" . basename(__FILE__));
    if (file_exists($file_add_start)) include_once($file_add_start);
    ?>
    <link rel="stylesheet" href="<? echo MIQ_PATH ?>/css/form_base.css?RAND=<?php echo random_bytes(5); ?>">
    <script src="<? echo MIQ_PATH ?>/modules/form_base/forms.js?RAND=<?php echo random_bytes(5); ?>"></script>
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
    <!--<button type="button" onClick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>?fg=<?= $fg ?>&fcid=' + getCid()" >NEU</button>-->

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
                        <input data-fg='10010'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_91_a'>
                        <div class='desc_f' >Praxis-ID</div>
                    </div>
                    <div class='col_b' id='SH_91_b'>
                        <input data-fg='10010'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_92_a'>
                        <div class='desc_f' >Cedur-Nr.</div>
                    </div>
                    <div class='col_b' id='SH_92_b'>
                        <input data-fg='10010'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_93_a'>
                        <div class='desc_f' >Visite</div>
                    </div>
                    <div class='col_b' id='SH_93_b'>
                        <input data-fg='10010'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_94_a'>
                        <div class='desc_f' >Baseline</div>
                    </div>
                    <div class='col_b' id='SH_94_b'>
                        <input data-fg='10010'  type='text' id='FF_94' name='FF_94' value="<?php echo htmlspecialchars($form_data_a[94] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_95_a'>
                        <div class='desc_f' >Diagnose</div>
                    </div>
                    <div class='col_b' id='SH_95_b'>
                        <input data-fg='10010'  type='text' id='FF_95' name='FF_95' value="<?php echo htmlspecialchars($form_data_a[95] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_96_a'>
                        <div class='desc_f' >geschlecht</div>
                    </div>
                    <div class='col_b' id='SH_96_b'>
                        <input data-fg='10010'  type='text' id='FF_96' name='FF_96' value="<?php echo htmlspecialchars($form_data_a[96] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_100_a'>
                        <div class='desc_f' >E</div>
                    </div>
                    <div class='col_b' id='SH_100_b'>
                        <input data-fg='10010'  type='text' id='FF_100' name='FF_100' value="<?php echo htmlspecialchars($form_data_a[100] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109001_a'>
                        <div class='desc_f' >Mayo</div>
                    </div>
                    <div class='col_b' id='SH_109001_b'>
                        <input data-fg='10010'  type='text' id='FF_109001' name='FF_109001' value="<?php echo htmlspecialchars($form_data_a[109001] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109002_a'>
                        <div class='desc_f' >Mayo_p</div>
                    </div>
                    <div class='col_b' id='SH_109002_b'>
                        <input data-fg='10010'  type='text' id='FF_109002' name='FF_109002' value="<?php echo htmlspecialchars($form_data_a[109002] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109003_a'>
                        <div class='desc_f' >SES</div>
                    </div>
                    <div class='col_b' id='SH_109003_b'>
                        <input data-fg='10010'  type='text' id='FF_109003' name='FF_109003' value="<?php echo htmlspecialchars($form_data_a[109003] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109004_a'>
                        <div class='desc_f' >CDAI</div>
                    </div>
                    <div class='col_b' id='SH_109004_b'>
                        <input data-fg='10010'  type='text' id='FF_109004' name='FF_109004' value="<?php echo htmlspecialchars($form_data_a[109004] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109005_a'>
                        <div class='desc_f' >SIDBQ</div>
                    </div>
                    <div class='col_b' id='SH_109005_b'>
                        <input data-fg='10010'  type='text' id='FF_109005' name='FF_109005' value="<?php echo htmlspecialchars($form_data_a[109005] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109006_a'>
                        <div class='desc_f' >PROMIS</div>
                    </div>
                    <div class='col_b' id='SH_109006_b'>
                        <input data-fg='10010'  type='text' id='FF_109006' name='FF_109006' value="<?php echo htmlspecialchars($form_data_a[109006] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109007_a'>
                        <div class='desc_f' >FACIT</div>
                    </div>
                    <div class='col_b' id='SH_109007_b'>
                        <input data-fg='10010'  type='text' id='FF_109007' name='FF_109007' value="<?php echo htmlspecialchars($form_data_a[109007] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109008_a'>
                        <div class='desc_f' >HBI</div>
                    </div>
                    <div class='col_b' id='SH_109008_b'>
                        <input data-fg='10010'  type='text' id='FF_109008' name='FF_109008' value="<?php echo htmlspecialchars($form_data_a[109008] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset id='FS_'><legend><img height='14px' src='../images/dataentry.svg'> Anamnese</legend>
					
                    <div class='col_a ' id='SH_102600_a'>
                        <div class='desc_f' ><span id='C_102600'></span>Wie groß sind Sie?</div>
                    </div>
                    <div class='col_b ' id='SH_102600_b'>
                        <input required type='number' id='FF_102600' name='FF_102600' value="<?php echo htmlspecialchars($form_data_a[102600] ?? ''); ?>" min='110' max='240' step='1' placeholder='in cm'>
                    </div>
					
                    <div class='col_a ' id='SH_102700_a'>
                        <div class='desc_f' ><span id='C_102700'></span>Wie viel wiegen Sie?</div>
                    </div>
                    <div class='col_b ' id='SH_102700_b'>
                        <input required type='number' id='FF_102700' name='FF_102700' value="<?php echo htmlspecialchars($form_data_a[102700] ?? ''); ?>" min='30' max='300' step='1' placeholder='in kg'>
                    </div>
					
                    <div class='col_a' id='SH_102705_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Ihr BMI</div>
                    </div>
                    <div class='col_b' id='SH_102705_b'  style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <input data-fg='10010'  type='text' id='FF_102705' name='FF_102705' value="<?php echo htmlspecialchars($form_data_a[102705] ?? ''); ?>" placeholder='Automatikfeld'><span id='span_102705'></span>
                    </div>
					
                    <div class='col_a' id='SH_102800_a'>
                        <div class='desc_f' >Rauchen Sie?</div>
                    </div>
                    <div class='col_b' id='SH_102800_b'  style='text-align:center'>
                        <div id='cbm_102800'>
                            <input data-rcb='102800' required class='sim_hide' type='text' id='FF_102800' name='FF_102800' value="<?php echo $form_data_a[102800] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_102800_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_102800_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_102800_Ja' class='block' style='display:none'>
					<div class='col_100 infotext' style='padding-left:10px;' id='SH_'>➥ Bitte machen Sie Angaben zu den genutzten Tabakprodukten:</div>
				<div class='row'>
					
                    <div class='col_a' id='SH_103400_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie viele Zigaretten pro Tag?</div>
                    </div>
                    <div class='col_b' id='SH_103400_b'>
                        <input data-fg='10010'  type='text' id='FF_103400' name='FF_103400' value="<?php echo htmlspecialchars($form_data_a[103400] ?? ''); ?>" placeholder='in Stck.'>
                    </div>
					
                    <div class='col_a' id='SH_103000_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie viele E-Zigaretten pro Tag?</div>
                    </div>
                    <div class='col_b' id='SH_103000_b'>
                        <input data-fg='10010'  type='text' id='FF_103000' name='FF_103000' value="<?php echo htmlspecialchars($form_data_a[103000] ?? ''); ?>" placeholder='in Stck.'>
                    </div>
					
                    <div class='col_a' id='SH_103300_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie viele Zigarillos / Zigarren pro Tag?</div>
                    </div>
                    <div class='col_b' id='SH_103300_b'>
                        <input data-fg='10010'  type='text' id='FF_103300' name='FF_103300' value="<?php echo htmlspecialchars($form_data_a[103300] ?? ''); ?>" placeholder='in Stck.'>
                    </div>
					
                    <div class='col_a' id='SH_103100_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie viele Pfeifen pro Tag?</div>
                    </div>
                    <div class='col_b' id='SH_103100_b'>
                        <input data-fg='10010'  type='text' id='FF_103100' name='FF_103100' value="<?php echo htmlspecialchars($form_data_a[103100] ?? ''); ?>" placeholder='in Stck.'>
                    </div>
					
                    <div class='col_a' id='SH_103200_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie viele Tabakerhitzer pro Tag?</div>
                    </div>
                    <div class='col_b' id='SH_103200_b'>
                        <input data-fg='10010'  type='text' id='FF_103200' name='FF_103200' value="<?php echo htmlspecialchars($form_data_a[103200] ?? ''); ?>" placeholder='in Stck.'>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_102800_Nein' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_102805_a'>
                        <div class='desc_f' >Waren Sie früher Raucher?</div>
                    </div>
                    <div class='col_b' id='SH_102805_b'  style='text-align:center'>
                        <div id='cbm_102805'>
                            <input data-rcb='102805' required class='sim_hide' type='text' id='FF_102805' name='FF_102805' value="<?php echo $form_data_a[102805] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_102805_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_102805_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_102805_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_102806_a'>
                        <div class='desc_f' >Wie intensiv haben Sie geraucht?</div>
                    </div>
                    <div class='col_b' id='SH_102806_b'>
                        <select required id='FF_102806' name='FF_102806'  onchange='follow_select(this)'><option value=''></option><option value='gelegentlich' <?php if (($form_data_a[102806] ?? '') == 'gelegentlich') echo 'selected'; ?>>gelegentlich</option><option value='moderat' <?php if (($form_data_a[102806] ?? '') == 'moderat') echo 'selected'; ?>>moderat</option><option value='viel' <?php if (($form_data_a[102806] ?? '') == 'viel') echo 'selected'; ?>>viel</option><option value='sehr viel' <?php if (($form_data_a[102806] ?? '') == 'sehr viel') echo 'selected'; ?>>sehr viel</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_102815_a'>
                        <div class='desc_f' >Bevorzugen Sie eine spezielle Ernährungsform?</div>
                    </div>
                    <div class='col_b' id='SH_102815_b'>
                        <select required id='FF_102815' name='FF_102815'  onchange='follow_select(this)'><option value=''></option><option value='Nein' <?php if (($form_data_a[102815] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Vegetarisch' <?php if (($form_data_a[102815] ?? '') == 'Vegetarisch') echo 'selected'; ?>>Vegetarisch</option><option value='Vegan' <?php if (($form_data_a[102815] ?? '') == 'Vegan') echo 'selected'; ?>>Vegan</option><option value='Gluten-frei /-arm' <?php if (($form_data_a[102815] ?? '') == 'Gluten-frei /-arm') echo 'selected'; ?>>Gluten-frei /-arm</option><option value='Zuckerverzicht' <?php if (($form_data_a[102815] ?? '') == 'Zuckerverzicht') echo 'selected'; ?>>Zuckerverzicht</option><option value='FODMAP ( Blähungen)' <?php if (($form_data_a[102815] ?? '') == 'FODMAP ( Blähungen)') echo 'selected'; ?>>FODMAP ( Blähungen)</option><option value='Exklusive Enterale Ernährung (mit Trinknahrung)' <?php if (($form_data_a[102815] ?? '') == 'Exklusive Enterale Ernährung (mit Trinknahrung)') echo 'selected'; ?>>Exklusive Enterale Ernährung (mit Trinknahrung)</option><option value='Ballaststoffarm' <?php if (($form_data_a[102815] ?? '') == 'Ballaststoffarm') echo 'selected'; ?>>Ballaststoffarm</option><option value='Ballaststoffreich' <?php if (($form_data_a[102815] ?? '') == 'Ballaststoffreich') echo 'selected'; ?>>Ballaststoffreich</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_106000_a'>
                        <div class='desc_f' >Wie sind Sie zur Zeit tätig?</div>
                    </div>
                    <div class='col_b' id='SH_106000_b'>
                        <select required id='FF_106000' name='FF_106000'  onchange='follow_select(this)'><option value=''></option><option value='Angestellt tätig' <?php if (($form_data_a[106000] ?? '') == 'Angestellt tätig') echo 'selected'; ?>>Angestellt tätig</option><option value='Selbständig tätig' <?php if (($form_data_a[106000] ?? '') == 'Selbständig tätig') echo 'selected'; ?>>Selbständig tätig</option><option value='Student / Schüler / Auszubildender' <?php if (($form_data_a[106000] ?? '') == 'Student / Schüler / Auszubildender') echo 'selected'; ?>>Student / Schüler / Auszubildender</option><option value='Arbeitssuchend / Arbeitslos' <?php if (($form_data_a[106000] ?? '') == 'Arbeitssuchend / Arbeitslos') echo 'selected'; ?>>Arbeitssuchend / Arbeitslos</option><option value='Elternzeit' <?php if (($form_data_a[106000] ?? '') == 'Elternzeit') echo 'selected'; ?>>Elternzeit</option><option value='Berentet aufgrund CED' <?php if (($form_data_a[106000] ?? '') == 'Berentet aufgrund CED') echo 'selected'; ?>>Berentet aufgrund CED</option><option value='Berentet aufgrund anderer Erkrankungen' <?php if (($form_data_a[106000] ?? '') == 'Berentet aufgrund anderer Erkrankungen') echo 'selected'; ?>>Berentet aufgrund anderer Erkrankungen</option><option value='Nicht berufstätig' <?php if (($form_data_a[106000] ?? '') == 'Nicht berufstätig') echo 'selected'; ?>>Nicht berufstätig</option><option value='Rentner*in' <?php if (($form_data_a[106000] ?? '') == 'Rentner*in') echo 'selected'; ?>>Rentner*in</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_106000_Angestellt tätig Selbständig tätig' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_106500_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Welche Erwerbstätigkeit üben Sie derzeit aus (Beruf)?</div>
                    </div>
                    <div class='col_b' id='SH_106500_b'>
                        <input data-fg='10010'  type='text' id='FF_106500' name='FF_106500' value="<?php echo htmlspecialchars($form_data_a[106500] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_106600_a'>
                        <div class='desc_f' style='padding-left:30px;'>Umfang der aktuellen Tätigkeit in Stunden?</div>
                    </div>
                    <div class='col_b' id='SH_106600_b'>
                        <select  id='FF_106600' name='FF_106600'  onchange='follow_select(this)'><option value=''></option><option value='Vollzeit (>30h)' <?php if (($form_data_a[106600] ?? '') == 'Vollzeit (>30h)') echo 'selected'; ?>>Vollzeit (>30h)</option><option value='Teilzeit I (21h-30h)' <?php if (($form_data_a[106600] ?? '') == 'Teilzeit I (21h-30h)') echo 'selected'; ?>>Teilzeit I (21h-30h)</option><option value='Teilzeit II (bis 20h)' <?php if (($form_data_a[106600] ?? '') == 'Teilzeit II (bis 20h)') echo 'selected'; ?>>Teilzeit II (bis 20h)</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106000_Angestellt tätig' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_106200_a'>
                        <div class='desc_f' style='padding-left:30px;'>Waren Sie in den letzten 6 Monaten aufgrund Ihrer CED krankgeschrieben?</div>
                    </div>
                    <div class='col_b' id='SH_106200_b'  style='text-align:center'>
                        <div id='cbm_106200'>
                            <input data-rcb='106200'  class='sim_hide' type='text' id='FF_106200' name='FF_106200' value="<?php echo $form_data_a[106200] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_106200_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_106200_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_106200_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_106300_a'>
                        <div class='desc_f' style='padding-left:30px;'>➥ Wie viele Tage?</div>
                    </div>
                    <div class='col_b ' id='SH_106300_b'>
                        <input  type='number' id='FF_106300' name='FF_106300' value="<?php echo htmlspecialchars($form_data_a[106300] ?? ''); ?>" min='1' max='180' step='1' placeholder='Angabe in Tagen'>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106000_Berentet aufgrund CED' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_106400_a'>
                        <div class='desc_f' style='padding-left:10px;'>Seit wann sind Sie wegen Ihrer CED berentet?</div>
                    </div>
                    <div class='col_b ' id='SH_106400_b'>
                        <input  type='number' id='FF_106400' name='FF_106400' value="<?php echo htmlspecialchars($form_data_a[106400] ?? ''); ?>" min='1950' max='this_year' step='1' placeholder='Jahr (vierstellig)'>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106000_Berentet aufgrund anderer Erkrankungen' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_106100_a'>
                        <div class='desc_f' style='padding-left:10px;'>Aufgrund welcher Erkrankung sind sie berentet?</div>
                    </div>
                    <div class='col_b' id='SH_106100_b'>
                        <input data-fg='10010'  type='text' id='FF_106100' name='FF_106100' value="<?php echo htmlspecialchars($form_data_a[106100] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_106700_a'>
                        <div class='desc_f' >Welchen Schulabschluß haben Sie?</div>
                    </div>
                    <div class='col_b' id='SH_106700_b'>
                        <select required id='FF_106700' name='FF_106700'  onchange='follow_select(this)'><option value=''></option><option value='Keinen Schulabschluß' <?php if (($form_data_a[106700] ?? '') == 'Keinen Schulabschluß') echo 'selected'; ?>>Keinen Schulabschluß</option><option value='Hauptschulabschluß' <?php if (($form_data_a[106700] ?? '') == 'Hauptschulabschluß') echo 'selected'; ?>>Hauptschulabschluß</option><option value='Mittlere Reife' <?php if (($form_data_a[106700] ?? '') == 'Mittlere Reife') echo 'selected'; ?>>Mittlere Reife</option><option value='Abitur/Fachabitur' <?php if (($form_data_a[106700] ?? '') == 'Abitur/Fachabitur') echo 'selected'; ?>>Abitur/Fachabitur</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_106701_a'>
                        <div class='desc_f' >Welches ist Ihr höchster Bildungsabschluß?</div>
                    </div>
                    <div class='col_b' id='SH_106701_b'>
                        <select required id='FF_106701' name='FF_106701'  onchange='follow_select(this)'><option value=''></option><option value='kein Abschluß' <?php if (($form_data_a[106701] ?? '') == 'kein Abschluß') echo 'selected'; ?>>kein Abschluß</option><option value='Abgeschlossene Berufsausbildung' <?php if (($form_data_a[106701] ?? '') == 'Abgeschlossene Berufsausbildung') echo 'selected'; ?>>Abgeschlossene Berufsausbildung</option><option value='Bachelor' <?php if (($form_data_a[106701] ?? '') == 'Bachelor') echo 'selected'; ?>>Bachelor</option><option value='Master' <?php if (($form_data_a[106701] ?? '') == 'Master') echo 'selected'; ?>>Master</option><option value='Promotion' <?php if (($form_data_a[106701] ?? '') == 'Promotion') echo 'selected'; ?>>Promotion</option><option value='Habilitation' <?php if (($form_data_a[106701] ?? '') == 'Habilitation') echo 'selected'; ?>>Habilitation</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_105000_a'>
                        <div class='desc_f' >Sind Verwandte von Ihnen an einer CED erkrankt?</div>
                    </div>
                    <div class='col_b' id='SH_105000_b'  style='text-align:center'>
                        <div id='cbm_105000'>
                            <input data-rcb='105000' required class='sim_hide' type='text' id='FF_105000' name='FF_105000' value="<?php echo $form_data_a[105000] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105000_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105000_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_105000_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_105100_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Mutter / Vater</div>
                    </div>
                    <div class='col_b' id='SH_105100_b'  style='text-align:center'>
                        <div id='cbm_105100'>
                            <input data-rcb='105100'  class='sim_hide' type='text' id='FF_105100' name='FF_105100' value="<?php echo $form_data_a[105100] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105100_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105100_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_105200_a'>
                        <div class='desc_f' style='padding-left:30px;'>Bruder / Schwester</div>
                    </div>
                    <div class='col_b' id='SH_105200_b'  style='text-align:center'>
                        <div id='cbm_105200'>
                            <input data-rcb='105200'  class='sim_hide' type='text' id='FF_105200' name='FF_105200' value="<?php echo $form_data_a[105200] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105200_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105200_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_105200_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_105300_a'>
                        <div class='desc_f' style='padding-left:30px;'>➥ Zwilling</div>
                    </div>
                    <div class='col_b' id='SH_105300_b'  style='text-align:center'>
                        <div id='cbm_105300'>
                            <input data-rcb='105300'  class='sim_hide' type='text' id='FF_105300' name='FF_105300' value="<?php echo $form_data_a[105300] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105300_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105300_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_105400_a'>
                        <div class='desc_f' style='padding-left:30px;'>Sohn / Tochter</div>
                    </div>
                    <div class='col_b' id='SH_105400_b'  style='text-align:center'>
                        <div id='cbm_105400'>
                            <input data-rcb='105400'  class='sim_hide' type='text' id='FF_105400' name='FF_105400' value="<?php echo $form_data_a[105400] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105400_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105400_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_105500_a'>
                        <div class='desc_f' style='padding-left:30px;'>Großvater / Großmutter</div>
                    </div>
                    <div class='col_b' id='SH_105500_b'  style='text-align:center'>
                        <div id='cbm_105500'>
                            <input data-rcb='105500'  class='sim_hide' type='text' id='FF_105500' name='FF_105500' value="<?php echo $form_data_a[105500] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105500_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105500_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_105600_a'>
                        <div class='desc_f' style='padding-left:30px;'>Tante / Onkel</div>
                    </div>
                    <div class='col_b' id='SH_105600_b'  style='text-align:center'>
                        <div id='cbm_105600'>
                            <input data-rcb='105600'  class='sim_hide' type='text' id='FF_105600' name='FF_105600' value="<?php echo $form_data_a[105600] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105600_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105600_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_105700_a'>
                        <div class='desc_f' style='padding-left:30px;'>Neffe / Nichte</div>
                    </div>
                    <div class='col_b' id='SH_105700_b'  style='text-align:center'>
                        <div id='cbm_105700'>
                            <input data-rcb='105700'  class='sim_hide' type='text' id='FF_105700' name='FF_105700' value="<?php echo $form_data_a[105700] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105700_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105700_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_105800_a'>
                        <div class='desc_f' style='padding-left:30px;'>Cousin / Cousine</div>
                    </div>
                    <div class='col_b' id='SH_105800_b'  style='text-align:center'>
                        <div id='cbm_105800'>
                            <input data-rcb='105800'  class='sim_hide' type='text' id='FF_105800' name='FF_105800' value="<?php echo $form_data_a[105800] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105800_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105800_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_105900_a'>
                        <div class='desc_f' style='padding-left:30px;'>Andere</div>
                    </div>
                    <div class='col_b' id='SH_105900_b'  style='text-align:center'>
                        <div id='cbm_105900'>
                            <input data-rcb='105900'  class='sim_hide' type='text' id='FF_105900' name='FF_105900' value="<?php echo $form_data_a[105900] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_105900_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_105900_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
				</div>
			</div></div><!--block-->
			</fieldset>
			<div class='col_100' ><div id='B_9507' class='block' style='display:none'>
			<fieldset id='FS_'><legend><img height='14px' src='../images/pregnacy.svg'> Schwangerschaft</legend>
					
                    <div class='col_a' id='SH_108500_a'>
                        <div class='desc_f' >Sind Sie schwanger?</div>
                    </div>
                    <div class='col_b' id='SH_108500_b'  style='text-align:center'>
                        <div id='cbm_108500'>
                            <input data-rcb='108500' required class='sim_hide' type='text' id='FF_108500' name='FF_108500' value="<?php echo $form_data_a[108500] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_108500_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_108500_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_108500_Nein' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_109100_a'>
                        <div class='desc_f' >Waren Sie schon einmal schwanger?</div>
                    </div>
                    <div class='col_b' id='SH_109100_b'  style='text-align:center'>
                        <div id='cbm_109100'>
                            <input data-rcb='109100' required class='sim_hide' type='text' id='FF_109100' name='FF_109100' value="<?php echo $form_data_a[109100] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_109100_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_109100_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_109100_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_109200_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Anzahl der Schwangerschaften?</div>
                    </div>
                    <div class='col_b' id='SH_109200_b'>
                        <select  id='FF_109200' name='FF_109200'  onchange='follow_select(this)'><option value=''>Angabe 1 bis ≥7</option><option value='1' <?php if (($form_data_a[109200] ?? '') == '1') echo 'selected'; ?>>1</option><option value='2' <?php if (($form_data_a[109200] ?? '') == '2') echo 'selected'; ?>>2</option><option value='3' <?php if (($form_data_a[109200] ?? '') == '3') echo 'selected'; ?>>3</option><option value='4' <?php if (($form_data_a[109200] ?? '') == '4') echo 'selected'; ?>>4</option><option value='5' <?php if (($form_data_a[109200] ?? '') == '5') echo 'selected'; ?>>5</option><option value='6' <?php if (($form_data_a[109200] ?? '') == '6') echo 'selected'; ?>>6</option><option value='≥7' <?php if (($form_data_a[109200] ?? '') == '≥7') echo 'selected'; ?>>≥7</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_109300_a'>
                        <div class='desc_f' style='padding-left:30px;'>War die letzte Schwangerschaft innerhalb der letzten 6 Monate?</div>
                    </div>
                    <div class='col_b' id='SH_109300_b'  style='text-align:center'>
                        <div id='cbm_109300'>
                            <input data-rcb='109300'  class='sim_hide' type='text' id='FF_109300' name='FF_109300' value="<?php echo $form_data_a[109300] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_109300_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_109300_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_109300_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_109400_a'>
                        <div class='desc_f' style='padding-left:30px;'>➥ Gab es Komplikationen während Ihrer letzten Schwangerschaft?</div>
                    </div>
                    <div class='col_b' id='SH_109400_b'  style='text-align:center'>
                        <div id='cbm_109400'>
                            <input data-rcb='109400'  class='sim_hide' type='text' id='FF_109400' name='FF_109400' value="<?php echo $form_data_a[109400] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_109400_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_109400_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_110100_a'>
                        <div class='desc_f' style='padding-left:30px;'>Ist Ihr Kind gesund?</div>
                    </div>
                    <div class='col_b' id='SH_110100_b'  style='text-align:center'>
                        <div id='cbm_110100'>
                            <input data-rcb='110100'  class='sim_hide' type='text' id='FF_110100' name='FF_110100' value="<?php echo $form_data_a[110100] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_110100_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_110100_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a ' id='SH_109500_a'>
                        <div class='desc_f' style='padding-left:30px;'>Schwangerschaftswoche bei Geburt?</div>
                    </div>
                    <div class='col_b ' id='SH_109500_b'>
                        <input  type='number' id='FF_109500' name='FF_109500' value="<?php echo htmlspecialchars($form_data_a[109500] ?? ''); ?>" min='22' max='43' step='1' placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_109700_a'>
                        <div class='desc_f' style='padding-left:30px;'>Geschlecht des Kindes?</div>
                    </div>
                    <div class='col_b' id='SH_109700_b'>
                        <select  id='FF_109700' name='FF_109700'  onchange='follow_select(this)'><option value=''></option><option value='männlich' <?php if (($form_data_a[109700] ?? '') == 'männlich') echo 'selected'; ?>>männlich</option><option value='weiblich' <?php if (($form_data_a[109700] ?? '') == 'weiblich') echo 'selected'; ?>>weiblich</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_109600_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wie verlief die Geburt?</div>
                    </div>
                    <div class='col_b' id='SH_109600_b'>
                        <select  id='FF_109600' name='FF_109600'  onchange='follow_select(this)'><option value=''></option><option value='spontan' <?php if (($form_data_a[109600] ?? '') == 'spontan') echo 'selected'; ?>>spontan</option><option value='geplanter Kaiserschnitt' <?php if (($form_data_a[109600] ?? '') == 'geplanter Kaiserschnitt') echo 'selected'; ?>>geplanter Kaiserschnitt</option><option value='spontaner Kaiserschnitt' <?php if (($form_data_a[109600] ?? '') == 'spontaner Kaiserschnitt') echo 'selected'; ?>>spontaner Kaiserschnitt</option><option value='vaginal-operative Entbindung (Verwendung von Saugglocke oder Geburtszange)' <?php if (($form_data_a[109600] ?? '') == 'vaginal-operative Entbindung (Verwendung von Saugglocke oder Geburtszange)') echo 'selected'; ?>>vaginal-operative Entbindung (Verwendung von Saugglocke oder Geburtszange)</option>
                        </select>
                    </div>
					
                    <div class='col_a ' id='SH_109800_a'>
                        <div class='desc_f' style='padding-left:30px;'>Geburtsgewicht?</div>
                    </div>
                    <div class='col_b ' id='SH_109800_b'>
                        <input  type='number' id='FF_109800' name='FF_109800' value="<?php echo htmlspecialchars($form_data_a[109800] ?? ''); ?>" min='400' max='10000' step='1' placeholder='in g'>
                    </div>
					
                    <div class='col_a ' id='SH_109900_a'>
                        <div class='desc_f' style='padding-left:30px;'>Körpergröße bei Geburt?</div>
                    </div>
                    <div class='col_b ' id='SH_109900_b'>
                        <input  type='number' id='FF_109900' name='FF_109900' value="<?php echo htmlspecialchars($form_data_a[109900] ?? ''); ?>" min='20' max='700' step='1' placeholder='in cm'>
                    </div>
					
                    <div class='col_a ' id='SH_110000_a'>
                        <div class='desc_f' style='padding-left:30px;'>Kopfumfang bei Geburt?</div>
                    </div>
                    <div class='col_b ' id='SH_110000_b'>
                        <input  type='number' id='FF_110000' name='FF_110000' value="<?php echo htmlspecialchars($form_data_a[110000] ?? ''); ?>" min='20' max='100' step='1' placeholder='in cm'>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_108500_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_108600_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ In welcher Woche sind Sie schwanger?</div>
                    </div>
                    <div class='col_b ' id='SH_108600_b'>
                        <input  type='number' id='FF_108600' name='FF_108600' value="<?php echo htmlspecialchars($form_data_a[108600] ?? ''); ?>" min='4' max='45' step='1' placeholder='Angabe Woche 4 bis 45'>
                    </div>
					
                    <div class='col_a' id='SH_108700_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wann ist der errechnete Geburtstermin?</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap; white-space: nowrap;justify-content: flex-end;' id='SH_108700_b'>
                        <select id='FF_108700_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_108700_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select  id='FF_108700_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='hidden' placeholder='wählen' style='min-width:80px';'  size='9' class='control_input' id='FF_108700' name='FF_108700' value="<?php echo htmlspecialchars($form_data_a[108700] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_108700','this_year','next_year',false,true,'Y(MD)','de');</script>
					
                    <div class='col_a' id='SH_108800_a'>
                        <div class='desc_f' style='padding-left:30px;'>Wurde wegen der Schwangerschaft die CED Behandlung verändert?</div>
                    </div>
                    <div class='col_b' id='SH_108800_b'  style='text-align:center'>
                        <div id='cbm_108800'>
                            <input data-rcb='108800'  class='sim_hide' type='text' id='FF_108800' name='FF_108800' value="<?php echo $form_data_a[108800] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_108800_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_108800_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_108900_a'>
                        <div class='desc_f' style='padding-left:30px;'>Waren Sie vor dieser aktuellen Schwangerschaft schon einmal schwanger?</div>
                    </div>
                    <div class='col_b' id='SH_108900_b'  style='text-align:center'>
                        <div id='cbm_108900'>
                            <input data-rcb='108900'  class='sim_hide' type='text' id='FF_108900' name='FF_108900' value="<?php echo $form_data_a[108900] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_108900_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_108900_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_108900_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_109000_a'>
                        <div class='desc_f' style='padding-left:30px;'>➥ Anzahl der Schwangerschaften (ohne die aktuelle)?</div>
                    </div>
                    <div class='col_b' id='SH_109000_b'>
                        <select  id='FF_109000' name='FF_109000'  onchange='follow_select(this)'><option value=''>Angabe 1 bis ≥7</option><option value='1' <?php if (($form_data_a[109000] ?? '') == '1') echo 'selected'; ?>>1</option><option value='2' <?php if (($form_data_a[109000] ?? '') == '2') echo 'selected'; ?>>2</option><option value='3' <?php if (($form_data_a[109000] ?? '') == '3') echo 'selected'; ?>>3</option><option value='4' <?php if (($form_data_a[109000] ?? '') == '4') echo 'selected'; ?>>4</option><option value='5' <?php if (($form_data_a[109000] ?? '') == '5') echo 'selected'; ?>>5</option><option value='6' <?php if (($form_data_a[109000] ?? '') == '6') echo 'selected'; ?>>6</option><option value='≥7' <?php if (($form_data_a[109000] ?? '') == '≥7') echo 'selected'; ?>>≥7</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
			</fieldset>
			</div></div><!--block-->
			<fieldset id='FS_'><legend><img height='14px' src='../images/diagnosis.svg'> Diagnose und Symptome</legend>
					
                    <div class='col_a' id='SH_102200_a'>
                        <div class='desc_f' >Datum der Erstdiagnose</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap; white-space: nowrap;justify-content: flex-end;' id='SH_102200_b'>
                        <select id='FF_102200_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102200_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select required id='FF_102200_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='hidden' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102200' name='FF_102200' value="<?php echo htmlspecialchars($form_data_a[102200] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102200','1960','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_a' id='SH_102300_a'>
                        <div class='desc_f' >Erste Symptome Ihrer Erkrankung?</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap; white-space: nowrap;justify-content: flex-end;' id='SH_102300_b'>
                        <select id='FF_102300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102300_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select required id='FF_102300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='hidden' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102300' name='FF_102300' value="<?php echo htmlspecialchars($form_data_a[102300] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102300','1960','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_a' id='SH_102400_a'>
                        <div class='desc_f' >Waren Sie im letzten halben Jahr im Krankenhaus?</div>
                    </div>
                    <div class='col_b' id='SH_102400_b'  style='text-align:center'>
                        <div id='cbm_102400'>
                            <input data-rcb='102400' required class='sim_hide' type='text' id='FF_102400' name='FF_102400' value="<?php echo $form_data_a[102400] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_102400_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_102400_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_102400_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_102500_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Wieviele Tage?</div>
                    </div>
                    <div class='col_b ' id='SH_102500_b'>
                        <input  type='number' id='FF_102500' name='FF_102500' value="<?php echo htmlspecialchars($form_data_a[102500] ?? ''); ?>" min='1' max='300' step='1' placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a ' id='SH_103500_a'>
                        <div class='desc_f' ><span id='C_103500'></span>Wie viele flüssige / breiige Stuhlgänge (Bei Stoma: Beutelentleerungen) hatten Sie in der vergangenen Woche durchschnittlich pro Tag?</div>
                    </div>
                    <div class='col_b ' id='SH_103500_b'>
                        <input required type='number' id='FF_103500' name='FF_103500' value="<?php echo htmlspecialchars($form_data_a[103500] ?? ''); ?>" min='0' max='50' step='1' placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_103505_a'>
                        <div class='desc_f' ><span id='C_103505'></span>Nehmen Sie regelmäßig Durchfallmedikamente?</div>
                    </div>
                    <div class='col_b' id='SH_103505_b'  style='text-align:center'>
                        <div id='cbm_103505'>
                            <input data-rcb='103505' required class='sim_hide' type='text' id='FF_103505' name='FF_103505' value="<?php echo $form_data_a[103505] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_103505_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_103505_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_103600_a'>
                        <div class='desc_f' ><span id='C_103600'></span>Blutbeimengungen beim Stuhl</div>
                    </div>
                    <div class='col_b' id='SH_103600_b'>
                        <select required id='FF_103600' name='FF_103600'  onchange='follow_select(this)'><option value=''></option><option value='kein Blut' <?php if (($form_data_a[103600] ?? '') == 'kein Blut') echo 'selected'; ?>>kein Blut</option><option value='Blut bei weniger als der Hälfte der Stuhlgänge' <?php if (($form_data_a[103600] ?? '') == 'Blut bei weniger als der Hälfte der Stuhlgänge') echo 'selected'; ?>>Blut bei weniger als der Hälfte der Stuhlgänge</option><option value='deutliche Blutbeimengung' <?php if (($form_data_a[103600] ?? '') == 'deutliche Blutbeimengung') echo 'selected'; ?>>deutliche Blutbeimengung</option><option value='Blut auch ohne Stuhl' <?php if (($form_data_a[103600] ?? '') == 'Blut auch ohne Stuhl') echo 'selected'; ?>>Blut auch ohne Stuhl</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_103900_a'>
                        <div class='desc_f' ><span id='C_103900'></span>Bauchschmerzen über die letzten 7 Tage</div>
                    </div>
                    <div class='col_b' id='SH_103900_b'>
                        <select required id='FF_103900' name='FF_103900'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[103900] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='leichte' <?php if (($form_data_a[103900] ?? '') == 'leichte') echo 'selected'; ?>>leichte</option><option value='mäßige' <?php if (($form_data_a[103900] ?? '') == 'mäßige') echo 'selected'; ?>>mäßige</option><option value='schwere' <?php if (($form_data_a[103900] ?? '') == 'schwere') echo 'selected'; ?>>schwere</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_104000_a'>
                        <div class='desc_f' ><span id='C_104000'></span>Ihr Allgemeinbefinden über die letzten 7 Tage</div>
                    </div>
                    <div class='col_b' id='SH_104000_b'>
                        <select required id='FF_104000' name='FF_104000'  onchange='follow_select(this)'><option value=''></option><option value='gut' <?php if (($form_data_a[104000] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='beeinträchtigt' <?php if (($form_data_a[104000] ?? '') == 'beeinträchtigt') echo 'selected'; ?>>beeinträchtigt</option><option value='schlecht' <?php if (($form_data_a[104000] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option><option value='sehr schlecht' <?php if (($form_data_a[104000] ?? '') == 'sehr schlecht') echo 'selected'; ?>>sehr schlecht</option><option value='unerträglich' <?php if (($form_data_a[104000] ?? '') == 'unerträglich') echo 'selected'; ?>>unerträglich</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_104500_a'>
                        <div class='desc_f' >Hatten Sie in der Vergangenheit Fisteln? (Wenn Sie nicht wissen, was das ist, haben bzw. hatten Sie auch keine)</div>
                    </div>
                    <div class='col_b' id='SH_104500_b'  style='text-align:center'>
                        <div id='cbm_104500'>
                            <input data-rcb='104500' required class='sim_hide' type='text' id='FF_104500' name='FF_104500' value="<?php echo $form_data_a[104500] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104500_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_104500_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_104200_a'>
                        <div class='desc_f' ><span id='C_104200'></span>Haben Sie aktuell Fisteln?</div>
                    </div>
                    <div class='col_b' id='SH_104200_b'  style='text-align:center'>
                        <div id='cbm_104200'>
                            <input data-rcb='104200' required class='sim_hide' type='text' id='FF_104200' name='FF_104200' value="<?php echo $form_data_a[104200] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104200_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_104200_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_111200_a'>
                        <div class='desc_f' >Haben Sie noch weitere Erkrankungen?</div>
                    </div>
                    <div class='col_b' id='SH_111200_b'  style='text-align:center'>
                        <div id='cbm_111200'>
                            <input data-rcb='111200' required class='sim_hide' type='text' id='FF_111200' name='FF_111200' value="<?php echo $form_data_a[111200] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_111200_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_111200_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_111200_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_111301_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥Bitte wählen Sie die Erkrankungen</div>
                    </div>
                    <div class='col_b' id='SH_111301_a'>
                        <select id='mts_111301' name='mts_111301'><option value=''></option><option value='Akne inversa' <?php if (($form_data_a[111301] ?? '') == 'Akne inversa') echo 'selected'; ?>>Akne inversa</option><option value='Asthma bronchiale' <?php if (($form_data_a[111301] ?? '') == 'Asthma bronchiale') echo 'selected'; ?>>Asthma bronchiale</option><option value='Bauchspeicheldrüsenkrebs' <?php if (($form_data_a[111301] ?? '') == 'Bauchspeicheldrüsenkrebs') echo 'selected'; ?>>Bauchspeicheldrüsenkrebs</option><option value='Blasenentzündung' <?php if (($form_data_a[111301] ?? '') == 'Blasenentzündung') echo 'selected'; ?>>Blasenentzündung</option><option value='Bluthochdruck' <?php if (($form_data_a[111301] ?? '') == 'Bluthochdruck') echo 'selected'; ?>>Bluthochdruck</option><option value='Brustkrebs' <?php if (($form_data_a[111301] ?? '') == 'Brustkrebs') echo 'selected'; ?>>Brustkrebs</option><option value='Darmkrebs' <?php if (($form_data_a[111301] ?? '') == 'Darmkrebs') echo 'selected'; ?>>Darmkrebs</option><option value='Diabetes mellitus' <?php if (($form_data_a[111301] ?? '') == 'Diabetes mellitus') echo 'selected'; ?>>Diabetes mellitus</option><option value='Depression' <?php if (($form_data_a[111301] ?? '') == 'Depression') echo 'selected'; ?>>Depression</option><option value='Eierstock-Krebs' <?php if (($form_data_a[111301] ?? '') == 'Eierstock-Krebs') echo 'selected'; ?>>Eierstock-Krebs</option><option value='Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)' <?php if (($form_data_a[111301] ?? '') == 'Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)') echo 'selected'; ?>>Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)</option><option value='Fettstoffwechselstörung' <?php if (($form_data_a[111301] ?? '') == 'Fettstoffwechselstörung') echo 'selected'; ?>>Fettstoffwechselstörung</option><option value='Gallensteine' <?php if (($form_data_a[111301] ?? '') == 'Gallensteine') echo 'selected'; ?>>Gallensteine</option><option value='Grauer Star' <?php if (($form_data_a[111301] ?? '') == 'Grauer Star') echo 'selected'; ?>>Grauer Star</option><option value='Grüner Star' <?php if (($form_data_a[111301] ?? '') == 'Grüner Star') echo 'selected'; ?>>Grüner Star</option><option value='Gürtelrose (Herpes zoster)' <?php if (($form_data_a[111301] ?? '') == 'Gürtelrose (Herpes zoster)') echo 'selected'; ?>>Gürtelrose (Herpes zoster)</option><option value='Hautkrebs (schwarzer und weißer Hautkrebs)' <?php if (($form_data_a[111301] ?? '') == 'Hautkrebs (schwarzer und weißer Hautkrebs)') echo 'selected'; ?>>Hautkrebs (schwarzer und weißer Hautkrebs)</option><option value='Haarausfall' <?php if (($form_data_a[111301] ?? '') == 'Haarausfall') echo 'selected'; ?>>Haarausfall</option><option value='Hepatitis (A, B, C, D oder E)' <?php if (($form_data_a[111301] ?? '') == 'Hepatitis (A, B, C, D oder E)') echo 'selected'; ?>>Hepatitis (A, B, C, D oder E)</option><option value='Herzinfarkt' <?php if (($form_data_a[111301] ?? '') == 'Herzinfarkt') echo 'selected'; ?>>Herzinfarkt</option><option value='Hodenkrebs' <?php if (($form_data_a[111301] ?? '') == 'Hodenkrebs') echo 'selected'; ?>>Hodenkrebs</option><option value='HIV' <?php if (($form_data_a[111301] ?? '') == 'HIV') echo 'selected'; ?>>HIV</option><option value='Koronare Herzkrankheit' <?php if (($form_data_a[111301] ?? '') == 'Koronare Herzkrankheit') echo 'selected'; ?>>Koronare Herzkrankheit</option><option value='Kurzdarmsyndrom' <?php if (($form_data_a[111301] ?? '') == 'Kurzdarmsyndrom') echo 'selected'; ?>>Kurzdarmsyndrom</option><option value='Leberzirrhose' <?php if (($form_data_a[111301] ?? '') == 'Leberzirrhose') echo 'selected'; ?>>Leberzirrhose</option><option value='Leukämie' <?php if (($form_data_a[111301] ?? '') == 'Leukämie') echo 'selected'; ?>>Leukämie</option><option value='Lungenkrebs' <?php if (($form_data_a[111301] ?? '') == 'Lungenkrebs') echo 'selected'; ?>>Lungenkrebs</option><option value='Lymphdrüsenkrebs' <?php if (($form_data_a[111301] ?? '') == 'Lymphdrüsenkrebs') echo 'selected'; ?>>Lymphdrüsenkrebs</option><option value='Migräne' <?php if (($form_data_a[111301] ?? '') == 'Migräne') echo 'selected'; ?>>Migräne</option><option value='Multiple Sklerose (MS)' <?php if (($form_data_a[111301] ?? '') == 'Multiple Sklerose (MS)') echo 'selected'; ?>>Multiple Sklerose (MS)</option><option value='Nierenerkrankung' <?php if (($form_data_a[111301] ?? '') == 'Nierenerkrankung') echo 'selected'; ?>>Nierenerkrankung</option><option value='Nierensteine' <?php if (($form_data_a[111301] ?? '') == 'Nierensteine') echo 'selected'; ?>>Nierensteine</option><option value='Osteoporose' <?php if (($form_data_a[111301] ?? '') == 'Osteoporose') echo 'selected'; ?>>Osteoporose</option><option value='PBC (Primär biliäre Zirrhose / Cholangitis)' <?php if (($form_data_a[111301] ?? '') == 'PBC (Primär biliäre Zirrhose / Cholangitis)') echo 'selected'; ?>>PBC (Primär biliäre Zirrhose / Cholangitis)</option><option value='Prostatakrebs' <?php if (($form_data_a[111301] ?? '') == 'Prostatakrebs') echo 'selected'; ?>>Prostatakrebs</option><option value='PSC (primär)' <?php if (($form_data_a[111301] ?? '') == 'PSC (primär)') echo 'selected'; ?>>PSC (primär)</option><option value='Rheumatoide Arthritis' <?php if (($form_data_a[111301] ?? '') == 'Rheumatoide Arthritis') echo 'selected'; ?>>Rheumatoide Arthritis</option><option value='Schilddrüsenüberfunktion' <?php if (($form_data_a[111301] ?? '') == 'Schilddrüsenüberfunktion') echo 'selected'; ?>>Schilddrüsenüberfunktion</option><option value='Schilddrüsenunterfunktion' <?php if (($form_data_a[111301] ?? '') == 'Schilddrüsenunterfunktion') echo 'selected'; ?>>Schilddrüsenunterfunktion</option><option value='Schlafstörungen' <?php if (($form_data_a[111301] ?? '') == 'Schlafstörungen') echo 'selected'; ?>>Schlafstörungen</option><option value='Schuppenflechte' <?php if (($form_data_a[111301] ?? '') == 'Schuppenflechte') echo 'selected'; ?>>Schuppenflechte</option><option value='Thrombose' <?php if (($form_data_a[111301] ?? '') == 'Thrombose') echo 'selected'; ?>>Thrombose</option></select>
                        <input type='hidden' id='FF_111301' name='FF_111301' value="<?php echo htmlspecialchars($form_data_a[111301] ?? ''); ?>"><ul id='chosen_111301' class='cosen_select'></ul>
                        <script>
                            const select = document.getElementById('mts_111301');
                            const list = document.getElementById('chosen_111301');
                            const hiddenInput = document.getElementById('FF_111301');
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
                                    const event = new Event('change', { bubbles: true });
                                    hiddenInput.dispatchEvent(event);
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
                        <div class='desc_f' style='padding-left:30px;'> Andere Erkrankungen falls nicht in der Liste:</div>
                    </div>
                    <div class='col_b' id='SH_115500_b'>
                        <textarea id='FF_115500' name='FF_115500' rows='2'><?php echo htmlspecialchars($form_data_a[115500] ?? ''); ?></textarea>
                    </div>
				</div>
			</div></div><!--block-->
			</fieldset>
			<fieldset id='FS_99991005'><legend><img height='14px' src='../images/oparation.svg'> Operationen</legend>
					
                    <div class='col_a' id='SH_106900_a'>
                        <div class='desc_f' >Sind Sie schon einmal wegen Ihrer CED am Darm operiert worden?</div>
                    </div>
                    <div class='col_b' id='SH_106900_b'>
                        <select required id='FF_106900' name='FF_106900'  onchange='follow_select(this)'><option value=''></option><option value='Nein' <?php if (($form_data_a[106900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='1 Mal' <?php if (($form_data_a[106900] ?? '') == '1 Mal') echo 'selected'; ?>>1 Mal</option><option value='2 Mal' <?php if (($form_data_a[106900] ?? '') == '2 Mal') echo 'selected'; ?>>2 Mal</option><option value='3 Mal' <?php if (($form_data_a[106900] ?? '') == '3 Mal') echo 'selected'; ?>>3 Mal</option><option value='4 Mal' <?php if (($form_data_a[106900] ?? '') == '4 Mal') echo 'selected'; ?>>4 Mal</option><option value='5 Mal' <?php if (($form_data_a[106900] ?? '') == '5 Mal') echo 'selected'; ?>>5 Mal</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_106900_1 Mal 2 Mal 3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
					<div class='col_100 infotext' style='padding-left:10px;' id='SH_'>➥ Die Angabe zur Art der Operation ist optional. Wenn Sie wissen,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;um welche Art es sich handelte, können Sie dies ergänzen.</div>
				<div class='row'>
					<div class='col_100 infotext'  id='SH_'><b>1. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_107100_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_107100_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_107100_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='hidden' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107100' name='FF_107100' value="<?php echo htmlspecialchars($form_data_a[107100] ?? ''); ?>">
                        </div>
                    <script>multi_date('FF_107100','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                        <select   id='FF_107200' name='FF_107200'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107200] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107200] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107200] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='Pouchanlage' <?php if (($form_data_a[107200] ?? '') == 'Pouchanlage') echo 'selected'; ?>>Pouchanlage</option><option value='Dauerhaftes Stoma' <?php if (($form_data_a[107200] ?? '') == 'Dauerhaftes Stoma') echo 'selected'; ?>>Dauerhaftes Stoma</option><option value='Vorübergehendes Stoma' <?php if (($form_data_a[107200] ?? '') == 'Vorübergehendes Stoma') echo 'selected'; ?>>Vorübergehendes Stoma</option><option value='protektives Ileostoma' <?php if (($form_data_a[107200] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_2 Mal 3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext'  id='SH_'><b>2. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_107400_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_107400_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_107400_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='hidden' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107400' name='FF_107400' value="<?php echo htmlspecialchars($form_data_a[107400] ?? ''); ?>">
                        </div>
                    <script>multi_date('FF_107400','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                        <select   id='FF_107500' name='FF_107500'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107500] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107500] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107500] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='Pouchanlage' <?php if (($form_data_a[107500] ?? '') == 'Pouchanlage') echo 'selected'; ?>>Pouchanlage</option><option value='Dauerhaftes Stoma' <?php if (($form_data_a[107500] ?? '') == 'Dauerhaftes Stoma') echo 'selected'; ?>>Dauerhaftes Stoma</option><option value='Vorübergehendes Stoma' <?php if (($form_data_a[107500] ?? '') == 'Vorübergehendes Stoma') echo 'selected'; ?>>Vorübergehendes Stoma</option><option value='protektives Ileostoma' <?php if (($form_data_a[107500] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_3 Mal 4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext'  id='SH_'><b>3. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_107700_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_107700_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_107700_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='hidden' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107700' name='FF_107700' value="<?php echo htmlspecialchars($form_data_a[107700] ?? ''); ?>">
                        </div>
                    <script>multi_date('FF_107700','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                        <select   id='FF_107800' name='FF_107800'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[107800] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[107800] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[107800] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='Pouchanlage' <?php if (($form_data_a[107800] ?? '') == 'Pouchanlage') echo 'selected'; ?>>Pouchanlage</option><option value='Dauerhaftes Stoma' <?php if (($form_data_a[107800] ?? '') == 'Dauerhaftes Stoma') echo 'selected'; ?>>Dauerhaftes Stoma</option><option value='Vorübergehendes Stoma' <?php if (($form_data_a[107800] ?? '') == 'Vorübergehendes Stoma') echo 'selected'; ?>>Vorübergehendes Stoma</option><option value='protektives Ileostoma' <?php if (($form_data_a[107800] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_4 Mal 5 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext'  id='SH_'><b>4. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_108000_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_108000_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_108000_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='hidden' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108000' name='FF_108000' value="<?php echo htmlspecialchars($form_data_a[108000] ?? ''); ?>">
                        </div>
                    <script>multi_date('FF_108000','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                        <select   id='FF_108100' name='FF_108100'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[108100] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[108100] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[108100] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='Pouchanlage' <?php if (($form_data_a[108100] ?? '') == 'Pouchanlage') echo 'selected'; ?>>Pouchanlage</option><option value='Dauerhaftes Stoma' <?php if (($form_data_a[108100] ?? '') == 'Dauerhaftes Stoma') echo 'selected'; ?>>Dauerhaftes Stoma</option><option value='Vorübergehendes Stoma' <?php if (($form_data_a[108100] ?? '') == 'Vorübergehendes Stoma') echo 'selected'; ?>>Vorübergehendes Stoma</option><option value='protektives Ileostoma' <?php if (($form_data_a[108100] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_5 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext'  id='SH_'><b>5. Operation:</b></div>
					
                        <div class='desc_f' ></div><br>
                        <div class='col' style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_108300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_108300_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_108300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='hidden' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_108300' name='FF_108300' value="<?php echo htmlspecialchars($form_data_a[108300] ?? ''); ?>">
                        </div>
                    <script>multi_date('FF_108300','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col'>
                        <div class='desc_f'></div>
                        <select   id='FF_108400' name='FF_108400'  onchange='follow_select(this)'><option value=''>Art der OP</option><option value='Colektomie' <?php if (($form_data_a[108400] ?? '') == 'Colektomie') echo 'selected'; ?>>Colektomie</option><option value='Dünndarm-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Dünndarm-Resektion') echo 'selected'; ?>>Dünndarm-Resektion</option><option value='Fistel- / Abszess-OP' <?php if (($form_data_a[108400] ?? '') == 'Fistel- / Abszess-OP') echo 'selected'; ?>>Fistel- / Abszess-OP</option><option value='Ileocoecal-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Ileocoecal-Resektion') echo 'selected'; ?>>Ileocoecal-Resektion</option><option value='Colon-Teil-Resektion' <?php if (($form_data_a[108400] ?? '') == 'Colon-Teil-Resektion') echo 'selected'; ?>>Colon-Teil-Resektion</option><option value='Pouchanlage' <?php if (($form_data_a[108400] ?? '') == 'Pouchanlage') echo 'selected'; ?>>Pouchanlage</option><option value='Dauerhaftes Stoma' <?php if (($form_data_a[108400] ?? '') == 'Dauerhaftes Stoma') echo 'selected'; ?>>Dauerhaftes Stoma</option><option value='Vorübergehendes Stoma' <?php if (($form_data_a[108400] ?? '') == 'Vorübergehendes Stoma') echo 'selected'; ?>>Vorübergehendes Stoma</option><option value='protektives Ileostoma' <?php if (($form_data_a[108400] ?? '') == 'protektives Ileostoma') echo 'selected'; ?>>protektives Ileostoma</option></select>
                    </div>
				</div>
			</div></div><!--block-->
			</div></div><!--block-->
			</fieldset>
			<fieldset id='FS_99998001'><legend><img height='14px' src='../images/medikation.svg'> Vormedikation - frühere CED-Medikamente</legend>
					<div class='col_100 infotext'  id='SH_99999001'>Geben Sie hier bitte nur die Medikamente an, die Sie <strong>wegen Ihrer CED in der VERGANGENHEIT</strong> eingenommen und abgesetzt haben, also <strong>AKTUELL NICHT</strong> mehr einnehmen.<br><font style='font-size:11px;color:gray'>Drücken Sie auf <label style='vertical-align:bottom'><svg xmlns='http://www.w3.org/2000/svg'  height='20px' width='20px' viewBox='0 -960 960 960' fill='#35a800ff'><path d='M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z'/></svg></label> (Hinzufügen) wenn Sie ein Medikament erfasst haben, um ein weiteres zu ergänzen oder die Eingabe zu beenden</font></div>
					<div style='width:100%'><iframe id='vormedikation' title='vormedikation' style='width:100%;border:0;'></iframe></div>
			</fieldset>
			<fieldset id='FS_99998002'><legend><img height='14px' src='../images/medikation.svg'> Aktuelle CED-Medikation/ Verordnung</legend>
					<div class='col_100 infotext'  id='SH_99999002'>Bitte geben Sie die Medikamente ein, die Sie <strong>wegen Ihrer CED AKTUELL</strong> einnehmen.<br><font style='font-size:11px;color:gray'>Drücken Sie auf <label style='vertical-align:bottom'><svg xmlns='http://www.w3.org/2000/svg'  height='20px' width='20px' viewBox='0 -960 960 960' fill='#35a800ff'><path d='M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z'/></svg></label> (Hinzufügen) wenn Sie ein Medikament erfasst haben, um ein weiteres zu ergänzen oder die Eingabe zu beenden</font></div>
					<div style='width:100%'><iframe id='medikation' title='medikation' style='width:100%;border:0;'></iframe></div>
			</fieldset>
			<fieldset id='FS_99991008'><legend><img height='14px' src='../images/untersuchung.svg'> Ärztliche Untersuchung</legend>
			<div class='col_100' ><div id='B_9501' class='block' style='display:none'>
					<div class='col_100 infotext'  id='SH_'>Benennen Sie bitte die Lokalisation (MC oder CI)</div>
					<div class='col_100 infotext'  id='SH_'><hr style='margin-top:-2px;margin-bottom:-2px'></div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_101902_b'>
                        <div id='cbm_101902'>
                            <input data-cb='101902'  class='sim_hide' id='FF_101902' name='FF_101902' value="<?php echo $form_data_a[101902] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_101902' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nur terminales Ileum</span></label>
                        </div>  
                    </div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_101904_b'>
                        <div id='cbm_101904'>
                            <input data-cb='101904'  class='sim_hide' id='FF_101904' name='FF_101904' value="<?php echo $form_data_a[101904] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_101904' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nur Colon</span></label>
                        </div>  
                    </div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_101906_b'>
                        <div id='cbm_101906'>
                            <input data-cb='101906'  class='sim_hide' id='FF_101906' name='FF_101906' value="<?php echo $form_data_a[101906] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_101906' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ileo-Colon</span></label>
                        </div>  
                    </div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_101908_b'>
                        <div id='cbm_101908'>
                            <input data-cb='101908'  class='sim_hide' id='FF_101908' name='FF_101908' value="<?php echo $form_data_a[101908] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_101908' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Oberer GI-Trakt (Öspohagus u./o. Magen u./o. Duodenum)</span></label>
                        </div>  
                    </div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_101910_b'>
                        <div id='cbm_101910'>
                            <input data-cb='101910'  class='sim_hide' id='FF_101910' name='FF_101910' value="<?php echo $form_data_a[101910] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_101910' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Dünndarmbefall (Jejunum / Ileum (außer term. Ileum)</span></label>
                        </div>  
                    </div>
				<div class='row'>
					
                    <div class='col_a' id='SH_116100_a'>
                        <div class='desc_f' ><span id='C_116100'></span>SES-CD Score erhoben (MC oder CI)?</div>
                    </div>
                    <div class='col_b' id='SH_116100_b'  style='text-align:center'>
                        <div id='cbm_116100'>
                            <input data-rcb='116100' required class='sim_hide' type='text' id='FF_116100' name='FF_116100' value="<?php echo $form_data_a[116100] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_116100_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_116100_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
				</div>
			<div class='col_100'><div id='B_116100_Ja' class='block_2' style='display:none'>
					<div class='col_b' ><div class='desc_f'></div></div>
					<div class='col_a' style='display: flex; flex-wrap: nowrap;white-space: nowrap;margin:0; padding:2px'>
					<div class='' style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%''><small style='padding:3px'><br>Ulzeration</small></div>
					<div class='' style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%''><small style='padding:3px'>Ausdehnung<br>Ulzeration</small></div>
					<div class='' style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%''><small style='padding:3px'>Entzündete<br>Oberfläche</small></div>
					<div class='' style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%''><small style='padding:3px'><br>Stenose</small></div></div>
					<div class='col_b' style='padding-left:30px;'><div class='desc_f'>Ileum</div></div>
					<div class='col_a' style='display: flex; flex-wrap: nowrap;white-space: nowrap;margin:0; padding:2px'>
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116202' name='FF_116202'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116202] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='aphtoid < 0,5cm' <?php if (($form_data_a[116202] ?? '') == 'aphtoid < 0,5cm') echo 'selected'; ?>>aphtoid < 0,5cm</option><option value='0,5cm - 2cm' <?php if (($form_data_a[116202] ?? '') == '0,5cm - 2cm') echo 'selected'; ?>>0,5cm - 2cm</option><option value='> 2cm' <?php if (($form_data_a[116202] ?? '') == '> 2cm') echo 'selected'; ?>>> 2cm</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116204' name='FF_116204'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116204] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 10%' <?php if (($form_data_a[116204] ?? '') == '< 10%') echo 'selected'; ?>>< 10%</option><option value='10 - 30%' <?php if (($form_data_a[116204] ?? '') == '10 - 30%') echo 'selected'; ?>>10 - 30%</option><option value='> 30%' <?php if (($form_data_a[116204] ?? '') == '> 30%') echo 'selected'; ?>>> 30%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116206' name='FF_116206'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116206] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 50%' <?php if (($form_data_a[116206] ?? '') == '< 50%') echo 'selected'; ?>>< 50%</option><option value='50 - 75%' <?php if (($form_data_a[116206] ?? '') == '50 - 75%') echo 'selected'; ?>>50 - 75%</option><option value='> 75%' <?php if (($form_data_a[116206] ?? '') == '> 75%') echo 'selected'; ?>>> 75%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116208' name='FF_116208'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116208] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='singulär, passierbar' <?php if (($form_data_a[116208] ?? '') == 'singulär, passierbar') echo 'selected'; ?>>singulär, passierbar</option><option value='multipel, passierbar' <?php if (($form_data_a[116208] ?? '') == 'multipel, passierbar') echo 'selected'; ?>>multipel, passierbar</option><option value='nicht passierbar' <?php if (($form_data_a[116208] ?? '') == 'nicht passierbar') echo 'selected'; ?>>nicht passierbar</option>
                        </select>
                    </div>&nbsp;</div>
					<div class='col_b' style='padding-left:30px;'><div class='desc_f'>Colon rechts</div></div>
					<div class='col_a' style='display: flex; flex-wrap: nowrap;white-space: nowrap;margin:0; padding:2px'>
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116302' name='FF_116302'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116302] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='aphtoid < 0,5cm' <?php if (($form_data_a[116302] ?? '') == 'aphtoid < 0,5cm') echo 'selected'; ?>>aphtoid < 0,5cm</option><option value='0,5cm - 2cm' <?php if (($form_data_a[116302] ?? '') == '0,5cm - 2cm') echo 'selected'; ?>>0,5cm - 2cm</option><option value='> 2cm' <?php if (($form_data_a[116302] ?? '') == '> 2cm') echo 'selected'; ?>>> 2cm</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116304' name='FF_116304'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116304] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 10%' <?php if (($form_data_a[116304] ?? '') == '< 10%') echo 'selected'; ?>>< 10%</option><option value='10 - 30%' <?php if (($form_data_a[116304] ?? '') == '10 - 30%') echo 'selected'; ?>>10 - 30%</option><option value='> 30%' <?php if (($form_data_a[116304] ?? '') == '> 30%') echo 'selected'; ?>>> 30%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116306' name='FF_116306'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116306] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 50%' <?php if (($form_data_a[116306] ?? '') == '< 50%') echo 'selected'; ?>>< 50%</option><option value='50 - 75%' <?php if (($form_data_a[116306] ?? '') == '50 - 75%') echo 'selected'; ?>>50 - 75%</option><option value='> 75%' <?php if (($form_data_a[116306] ?? '') == '> 75%') echo 'selected'; ?>>> 75%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116308' name='FF_116308'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116308] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='singulär, passierbar' <?php if (($form_data_a[116308] ?? '') == 'singulär, passierbar') echo 'selected'; ?>>singulär, passierbar</option><option value='multipel, passierbar' <?php if (($form_data_a[116308] ?? '') == 'multipel, passierbar') echo 'selected'; ?>>multipel, passierbar</option><option value='nicht passierbar' <?php if (($form_data_a[116308] ?? '') == 'nicht passierbar') echo 'selected'; ?>>nicht passierbar</option>
                        </select>
                    </div>&nbsp;</div>
					<div class='col_b' style='padding-left:30px;'><div class='desc_f'>Colon transversum</div></div>
					<div class='col_a' style='display: flex; flex-wrap: nowrap;white-space: nowrap;margin:0; padding:2px'>
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116402' name='FF_116402'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116402] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='aphtoid < 0,5cm' <?php if (($form_data_a[116402] ?? '') == 'aphtoid < 0,5cm') echo 'selected'; ?>>aphtoid < 0,5cm</option><option value='0,5cm - 2cm' <?php if (($form_data_a[116402] ?? '') == '0,5cm - 2cm') echo 'selected'; ?>>0,5cm - 2cm</option><option value='> 2cm' <?php if (($form_data_a[116402] ?? '') == '> 2cm') echo 'selected'; ?>>> 2cm</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116404' name='FF_116404'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116404] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 10%' <?php if (($form_data_a[116404] ?? '') == '< 10%') echo 'selected'; ?>>< 10%</option><option value='10 - 30%' <?php if (($form_data_a[116404] ?? '') == '10 - 30%') echo 'selected'; ?>>10 - 30%</option><option value='> 30%' <?php if (($form_data_a[116404] ?? '') == '> 30%') echo 'selected'; ?>>> 30%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116406' name='FF_116406'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116406] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 50%' <?php if (($form_data_a[116406] ?? '') == '< 50%') echo 'selected'; ?>>< 50%</option><option value='50 - 75%' <?php if (($form_data_a[116406] ?? '') == '50 - 75%') echo 'selected'; ?>>50 - 75%</option><option value='> 75%' <?php if (($form_data_a[116406] ?? '') == '> 75%') echo 'selected'; ?>>> 75%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116408' name='FF_116408'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116408] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='singulär, passierbar' <?php if (($form_data_a[116408] ?? '') == 'singulär, passierbar') echo 'selected'; ?>>singulär, passierbar</option><option value='multipel, passierbar' <?php if (($form_data_a[116408] ?? '') == 'multipel, passierbar') echo 'selected'; ?>>multipel, passierbar</option><option value='nicht passierbar' <?php if (($form_data_a[116408] ?? '') == 'nicht passierbar') echo 'selected'; ?>>nicht passierbar</option>
                        </select>
                    </div>&nbsp;</div>
					<div class='col_b' style='padding-left:30px;'><div class='desc_f'>Colon links</div></div>
					<div class='col_a' style='display: flex; flex-wrap: nowrap;white-space: nowrap;margin:0; padding:2px'>
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116502' name='FF_116502'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116502] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='aphtoid < 0,5cm' <?php if (($form_data_a[116502] ?? '') == 'aphtoid < 0,5cm') echo 'selected'; ?>>aphtoid < 0,5cm</option><option value='0,5cm - 2cm' <?php if (($form_data_a[116502] ?? '') == '0,5cm - 2cm') echo 'selected'; ?>>0,5cm - 2cm</option><option value='> 2cm' <?php if (($form_data_a[116502] ?? '') == '> 2cm') echo 'selected'; ?>>> 2cm</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116504' name='FF_116504'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116504] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 10%' <?php if (($form_data_a[116504] ?? '') == '< 10%') echo 'selected'; ?>>< 10%</option><option value='10 - 30%' <?php if (($form_data_a[116504] ?? '') == '10 - 30%') echo 'selected'; ?>>10 - 30%</option><option value='> 30%' <?php if (($form_data_a[116504] ?? '') == '> 30%') echo 'selected'; ?>>> 30%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116506' name='FF_116506'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116506] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 50%' <?php if (($form_data_a[116506] ?? '') == '< 50%') echo 'selected'; ?>>< 50%</option><option value='50 - 75%' <?php if (($form_data_a[116506] ?? '') == '50 - 75%') echo 'selected'; ?>>50 - 75%</option><option value='> 75%' <?php if (($form_data_a[116506] ?? '') == '> 75%') echo 'selected'; ?>>> 75%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116508' name='FF_116508'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116508] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='singulär, passierbar' <?php if (($form_data_a[116508] ?? '') == 'singulär, passierbar') echo 'selected'; ?>>singulär, passierbar</option><option value='multipel, passierbar' <?php if (($form_data_a[116508] ?? '') == 'multipel, passierbar') echo 'selected'; ?>>multipel, passierbar</option><option value='nicht passierbar' <?php if (($form_data_a[116508] ?? '') == 'nicht passierbar') echo 'selected'; ?>>nicht passierbar</option>
                        </select>
                    </div>&nbsp;</div>
					<div class='col_b' style='padding-left:30px;'><div class='desc_f'>Rektum</div></div>
					<div class='col_a' style='display: flex; flex-wrap: nowrap;white-space: nowrap;margin:0; padding:2px'>
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116602' name='FF_116602'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116602] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='aphtoid < 0,5cm' <?php if (($form_data_a[116602] ?? '') == 'aphtoid < 0,5cm') echo 'selected'; ?>>aphtoid < 0,5cm</option><option value='0,5cm - 2cm' <?php if (($form_data_a[116602] ?? '') == '0,5cm - 2cm') echo 'selected'; ?>>0,5cm - 2cm</option><option value='> 2cm' <?php if (($form_data_a[116602] ?? '') == '> 2cm') echo 'selected'; ?>>> 2cm</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116604' name='FF_116604'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116604] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 10%' <?php if (($form_data_a[116604] ?? '') == '< 10%') echo 'selected'; ?>>< 10%</option><option value='10 - 30%' <?php if (($form_data_a[116604] ?? '') == '10 - 30%') echo 'selected'; ?>>10 - 30%</option><option value='> 30%' <?php if (($form_data_a[116604] ?? '') == '> 30%') echo 'selected'; ?>>> 30%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116606' name='FF_116606'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116606] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='< 50%' <?php if (($form_data_a[116606] ?? '') == '< 50%') echo 'selected'; ?>>< 50%</option><option value='50 - 75%' <?php if (($form_data_a[116606] ?? '') == '50 - 75%') echo 'selected'; ?>>50 - 75%</option><option value='> 75%' <?php if (($form_data_a[116606] ?? '') == '> 75%') echo 'selected'; ?>>> 75%</option>
                        </select>
                    </div>&nbsp;
                    <div style='display:flex;flex-wrap: wrap;text-align:center;width:25%;max-width:25%'>
                        <select  id='FF_116608' name='FF_116608'  onchange='follow_select(this)'><option value=''></option><option value='keine' <?php if (($form_data_a[116608] ?? '') == 'keine') echo 'selected'; ?>>keine</option><option value='singulär, passierbar' <?php if (($form_data_a[116608] ?? '') == 'singulär, passierbar') echo 'selected'; ?>>singulär, passierbar</option><option value='multipel, passierbar' <?php if (($form_data_a[116608] ?? '') == 'multipel, passierbar') echo 'selected'; ?>>multipel, passierbar</option><option value='nicht passierbar' <?php if (($form_data_a[116608] ?? '') == 'nicht passierbar') echo 'selected'; ?>>nicht passierbar</option>
                        </select>
                    </div>&nbsp;</div>
					<div class='col_100 infotext'  id='SH_'> </div>
			</div></div><!--block-->
			</div></div><!--block-->
			<div class='col_100' ><div id='B_9503' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_102000_a'>
                        <div class='desc_f' >Benennen Sie bitte die Lokalisation (Colitis ulcerosa)</div>
                    </div>
                    <div class='col_b' id='SH_102000_b'>
                        <select required id='FF_102000' name='FF_102000'  onchange='follow_select(this)'><option value=''></option><option value='Proktitis' <?php if (($form_data_a[102000] ?? '') == 'Proktitis') echo 'selected'; ?>>Proktitis</option><option value='Linksseiten Colitis' <?php if (($form_data_a[102000] ?? '') == 'Linksseiten Colitis') echo 'selected'; ?>>Linksseiten Colitis</option><option value='Pancolitis' <?php if (($form_data_a[102000] ?? '') == 'Pancolitis') echo 'selected'; ?>>Pancolitis</option>
                        </select>
                    </div>
				</div>
				<div class='row'>
					
                    <div class='col_a' id='SH_103700_a'>
                        <div class='desc_f' ><span id='C_103700'></span>Globale Beurteilung des Krankheitszustandes</div>
                    </div>
                    <div class='col_b' id='SH_103700_b'>
                        <select required id='FF_103700' name='FF_103700'  onchange='follow_select(this)'><option value=''></option><option value='normal' <?php if (($form_data_a[103700] ?? '') == 'normal') echo 'selected'; ?>>normal</option><option value='mild' <?php if (($form_data_a[103700] ?? '') == 'mild') echo 'selected'; ?>>mild</option><option value='moderate Erkrankung' <?php if (($form_data_a[103700] ?? '') == 'moderate Erkrankung') echo 'selected'; ?>>moderate Erkrankung</option><option value='schwere Erkrankung' <?php if (($form_data_a[103700] ?? '') == 'schwere Erkrankung') echo 'selected'; ?>>schwere Erkrankung</option>
                        </select>
                    </div>
				</div>
			<div class='col_100' ><div id='B_9504' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_103800_a'>
                        <div class='desc_f' ><span id='C_103800'></span>Endoskopischer Befund Mayo Score</div>
                    </div>
                    <div class='col_b' id='SH_103800_b'>
                        <select required id='FF_103800' name='FF_103800'  onchange='follow_select(this)'><option value=''></option><option value='keine Befund vorhanden' <?php if (($form_data_a[103800] ?? '') == 'keine Befund vorhanden') echo 'selected'; ?>>keine Befund vorhanden</option><option value='normaler Befund oder inaktive Erkrankung' <?php if (($form_data_a[103800] ?? '') == 'normaler Befund oder inaktive Erkrankung') echo 'selected'; ?>>normaler Befund oder inaktive Erkrankung</option><option value='milde Colitis (Erythem, leicht spröde Schleimhaut)' <?php if (($form_data_a[103800] ?? '') == 'milde Colitis (Erythem, leicht spröde Schleimhaut)') echo 'selected'; ?>>milde Colitis (Erythem, leicht spröde Schleimhaut)</option><option value='moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)' <?php if (($form_data_a[103800] ?? '') == 'moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)') echo 'selected'; ?>>moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)</option><option value='schwere Colitis (Ulzerationen, spontane Blutungen)' <?php if (($form_data_a[103800] ?? '') == 'schwere Colitis (Ulzerationen, spontane Blutungen)') echo 'selected'; ?>>schwere Colitis (Ulzerationen, spontane Blutungen)</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
			</div></div><!--block-->
			<div class='col_100' ><div id='B_104200_Ja' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext'  id='SH_'>Angaben zu aktuellen Fisteln des Patienten</div>
					
                    <div class='col_a' id='SH_104300_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_104300'></span>Perianale Crohn Erkrankung (z.B. Fisteln, Fissuren, Abszesse)</div>
                    </div>
                    <div class='col_b' id='SH_104300_b'  style='text-align:center'>
                        <div id='cbm_104300'>
                            <input data-rcb='104300'  class='sim_hide' type='text' id='FF_104300' name='FF_104300' value="<?php echo $form_data_a[104300] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104300_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_104300_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_104400_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_104400'></span>Andere Fisteln (z.B. rektovesikal, Bauchdeckenfistel etc.)</div>
                    </div>
                    <div class='col_b' id='SH_104400_b'  style='text-align:center'>
                        <div id='cbm_104400'>
                            <input data-rcb='104400'  class='sim_hide' type='text' id='FF_104400' name='FF_104400' value="<?php echo $form_data_a[104400] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104400_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_104400_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
				</div>
			</div></div><!--block-->
					<div class='col_100 infotext'  id='SH_'>Weitere Untersuchungsbefunde</div>
					
                    <div class='col_a' id='SH_104800_a'>
                        <div class='desc_f' style='padding-left:30px;'>Hat oder hatte der Patient Stenosen?</div>
                    </div>
                    <div class='col_b' id='SH_104800_b'  style='text-align:center'>
                        <div id='cbm_104800'>
                            <input data-rcb='104800' required class='sim_hide' type='text' id='FF_104800' name='FF_104800' value="<?php echo $form_data_a[104800] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104800_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_104800_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_104800_Ja' class='block' style='display:none'>
					<div class='col_100 infotext' style='padding-left:30px;' id='SH_'> ➥ Lokalisation der Stenose</div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_104900_b'>
                        <div id='cbm_104900'>
                            <input data-cb='104900'  class='sim_hide' id='FF_104900' name='FF_104900' value="<?php echo $form_data_a[104900] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104900' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Dünndarmstenose</span></label>
                        </div>  
                    </div>
					
                    <div class='col_b' style='padding-left:40%' id='SH_104910_b'>
                        <div id='cbm_104910'>
                            <input data-cb='104910'  class='sim_hide' id='FF_104910' name='FF_104910' value="<?php echo $form_data_a[104910] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_104910' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Dickdarmstenose</span></label>
                        </div>  
                    </div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_115600_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_115600'></span>Augenbeteiligung (Iritis, Uveitis)</div>
                    </div>
                    <div class='col_b' id='SH_115600_b'  style='text-align:center'>
                        <div id='cbm_115600'>
                            <input data-rcb='115600' required class='sim_hide' type='text' id='FF_115600' name='FF_115600' value="<?php echo $form_data_a[115600] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_115600_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_115600_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_115700_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_115700'></span>Körpertemperatur über 37,8°C</div>
                    </div>
                    <div class='col_b' id='SH_115700_b'  style='text-align:center'>
                        <div id='cbm_115700'>
                            <input data-rcb='115700' required class='sim_hide' type='text' id='FF_115700' name='FF_115700' value="<?php echo $form_data_a[115700] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_115700_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_115700_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_115800_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_115800'></span>Erythema nodosum, Pyoderma gangraenosum, Stomatitis aphtosa</div>
                    </div>
                    <div class='col_b' id='SH_115800_b'  style='text-align:center'>
                        <div id='cbm_115800'>
                            <input data-rcb='115800' required class='sim_hide' type='text' id='FF_115800' name='FF_115800' value="<?php echo $form_data_a[115800] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_115800_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_115800_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_115900_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_115900'></span>Gelenkschmerzen / Arthritis</div>
                    </div>
                    <div class='col_b' id='SH_115900_b'  style='text-align:center'>
                        <div id='cbm_115900'>
                            <input data-rcb='115900' required class='sim_hide' type='text' id='FF_115900' name='FF_115900' value="<?php echo $form_data_a[115900] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_115900_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_115900_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					
                    <div class='col_a' id='SH_116000_a'>
                        <div class='desc_f' style='padding-left:30px;'><span id='C_116000'></span>Resistenz im Abdomen</div>
                    </div>
                    <div class='col_b' id='SH_116000_b'  style='text-align:center'>
                        <div id='cbm_116000'>
                            <input data-rcb='116000' required class='sim_hide' type='text' id='FF_116000' name='FF_116000' value="<?php echo $form_data_a[116000] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_116000_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_116000_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
					<div class='col' style='height:100%'><div class='desc_f'></div></div>
					<div class='col' style='height:100%'><div class='desc_f'><div id='choose_all_untersuchung' class='aref_button' style='text-align:center'><button type='button' class='aref_button' style='width:200px'>alle Befunde negativ</button></div></div></div>
			</fieldset>
			<fieldset id='FS_99991009'><legend><img height='14px' src='../images/labor.svg'> Laborergebnisse</legend>
					
                    <div class='col_a ' id='SH_110200_a'>
                        <div class='desc_f' ><span id='C_110200'></span>Hämatokrit</div>
                    </div>
                    <div class='col_b ' id='SH_110200_b'>
                        <input required type='number' id='FF_110200' name='FF_110200' value="<?php echo htmlspecialchars($form_data_a[110200] ?? ''); ?>" min='15' max='60' step='1' placeholder='in %'>
                    </div>
					
                    <div class='col_a' id='SH_110400_a'>
                        <div class='desc_f' >Calprotectin größer 50mg/kg</div>
                    </div>
                    <div class='col_b' id='SH_110400_b'  style='text-align:center'>
                        <div id='cbm_110400'>
                            <input data-rcb='110400'  class='sim_hide' type='text' id='FF_110400' name='FF_110400' value="<?php echo $form_data_a[110400] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_110400_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_110400_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_110400_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_110500_a'>
                        <div class='desc_f' >➥ Calprotectin Wert</div>
                    </div>
                    <div class='col_b ' id='SH_110500_b'>
                        <input  type='number' id='FF_110500' name='FF_110500' value="<?php echo htmlspecialchars($form_data_a[110500] ?? ''); ?>" min='51' max='10000' step='1' placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a ' id='SH_110511_a'>
                        <div class='desc_f' >Thrombozyten (optional)</div>
                    </div>
                    <div class='col_b ' id='SH_110511_b'>
                        <input  type='number' id='FF_110511' name='FF_110511' value="<?php echo htmlspecialchars($form_data_a[110511] ?? ''); ?>" min='0' max='10000' step='0.01' placeholder='in /nl'>
                    </div>
					
                    <div class='col_a'  id='SH_110600_a'>
                        <div class='desc_f' >Hämoglobin</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;' id='SH_110600_b'>
                        <input  type='number' id='FF_110600' name='FF_110600' value="<?php echo htmlspecialchars($form_data_a[110600] ?? ''); ?>" min='2' max='25' step='0.01' placeholder=''><select id='FF_110602' name='FF_110602'  onchange='follow_select(this)'><option value=''>Bitte Einheit angeben</option><option value='g/dl' <?php if (($form_data_a[110602] ?? '') == 'g/dl') echo 'selected'; ?>>g/dl</option><option value='mmol/l' <?php if (($form_data_a[110602] ?? '') == 'mmol/l') echo 'selected'; ?>>mmol/l</option></select></div>
					
                    <div class='col_a ' id='SH_110700_a'>
                        <div class='desc_f' >Ferritin</div>
                    </div>
                    <div class='col_b ' id='SH_110700_b'>
                        <input  type='number' id='FF_110700' name='FF_110700' value="<?php echo htmlspecialchars($form_data_a[110700] ?? ''); ?>" min='0' max='10000' step='0.01' placeholder='in ng/ml'>
                    </div>
					
                    <div class='col_a' id='SH_110900_a'>
                        <div class='desc_f' >CRP größer 5mg/l</div>
                    </div>
                    <div class='col_b' id='SH_110900_b'  style='text-align:center'>
                        <div id='cbm_110900'>
                            <input data-rcb='110900'  class='sim_hide' type='text' id='FF_110900' name='FF_110900' value="<?php echo $form_data_a[110900] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_110900_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_110900_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			<div class='col_100' ><div id='B_110900_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a ' id='SH_111000_a'>
                        <div class='desc_f' >➥ CRP</div>
                    </div>
                    <div class='col_b ' id='SH_111000_b'>
                        <input  type='number' id='FF_111000' name='FF_111000' value="<?php echo htmlspecialchars($form_data_a[111000] ?? ''); ?>" min='6' max='1000' step='0.01' placeholder='in mg/l'>
                    </div>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a ' id='SH_111100_a'>
                        <div class='desc_f' >Albumin</div>
                    </div>
                    <div class='col_b ' id='SH_111100_b'>
                        <input  type='number' id='FF_111100' name='FF_111100' value="<?php echo htmlspecialchars($form_data_a[111100] ?? ''); ?>" min='6' max='1000' step='0.01' placeholder=''>
                    </div>
			</fieldset>
			<fieldset id='FS_99991003'><legend><img height='14px' src='../images/sae.svg'> Nebenwirkungen</legend>
					
                    <div class='col_a' id='SH_110905_a'>
                        <div class='desc_f' >Wurden Nebenwirkungen festgestellt, die durch die Medikation induziert wurden?</div>
                    </div>
                    <div class='col_b' id='SH_110905_b'  style='text-align:center'>
                        <div id='cbm_110905'>
                            <input data-rcb='110905' required class='sim_hide' type='text' id='FF_110905' name='FF_110905' value="<?php echo $form_data_a[110905] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_110905_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_110905_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                            
                        </div>
                       
                    </div>
			</fieldset>
			<fieldset id='FS_9517'><legend><span id='C_9517'></span>Stuhldrang</legend>
					
                    <div class='col' style='width:100%' id='SH_119000'>
                        <div class='desc_f'> Wie stark war Ihr Stuhldrang (plötzliches oder dringendes Bedürfnis) in den vergangenen 24 Stunden?</div>
                        <div class='slider-container'>
                            <label for='119000_wertSchieberegler' class='slider-label start-label'>Kein Stuhldrang</label>
                            <input class='wertSchieberegler' type='range' id='119000_wertSchieberegler' min='0' max='10' value=0 step='1'>
                            <label for='119000_wertSchieberegler' class='slider-label end-label'>Schlimmstmöglicher Stuhldrang</label>
                            <span style='position: absolute;left:42.9%;background-color:yellow;color:green;padding.right:2px;' id='wertSchieberegler_display_119000'>0</span>
                        </div>
                    </div>
                    <input type='hidden' id='FF_119000' name='FF_119000' value="<?php echo htmlspecialchars($form_data_a[119000] ?? ''); ?>">
                    <script>
                        initSliderWithHiddenField('<?php echo 119000; ?>');
                    </script>
			</fieldset>
			<fieldset id='FS_'><legend>Lebensqualität (SIDBQ)</legend>
					
                    <div class='col_a' id='SH_116700_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Wie oft war das Gefühl von Abgeschlagenheit oder Müdigkeit und Abgespanntheit in den letzten zwei Wochen ein Problem für Sie?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_116700_b'>
                        <select required id='FF_116700' name='FF_116700'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[116700] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[116700] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[116700] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[116700] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[116700] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[116700] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[116700] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_116800_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Wie oft mussten Sie aufgrund Ihrer Darmerkrankung in den letzten zwei Wochen Treffen mit Freunden und/oder Verwandten verschieben oder absagen?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_116800_b'>
                        <select required id='FF_116800' name='FF_116800'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[116800] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[116800] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[116800] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[116800] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[116800] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[116800] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[116800] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_116900_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Hatten Sie in den letzten zwei Wochen aufgrund Ihrer Darmerkrankung Schwierigkeiten, gewünschten Sport- und Freizeitaktivitäten nachzugehen?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_116900_b'>
                        <select required id='FF_116900' name='FF_116900'  onchange='follow_select(this)'><option value=''></option><option value='Sehr grosse Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Sehr grosse Schwierigkeiten') echo 'selected'; ?>>Sehr grosse Schwierigkeiten</option><option value='Grosse Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Grosse Schwierigkeiten') echo 'selected'; ?>>Grosse Schwierigkeiten</option><option value='Ziemliche Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Ziemliche Schwierigkeiten') echo 'selected'; ?>>Ziemliche Schwierigkeiten</option><option value='Etwas Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Etwas Schwierigkeiten') echo 'selected'; ?>>Etwas Schwierigkeiten</option><option value='Wenig Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Wenig Schwierigkeiten') echo 'selected'; ?>>Wenig Schwierigkeiten</option><option value='Kaum Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Kaum Schwierigkeiten') echo 'selected'; ?>>Kaum Schwierigkeiten</option><option value='Keine Schwierigkeiten' <?php if (($form_data_a[116900] ?? '') == 'Keine Schwierigkeiten') echo 'selected'; ?>>Keine Schwierigkeiten</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117000_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Wie oft haben Sie in den letzten zwei Wochen unter Bauchschmerzen gelitten?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117000_b'>
                        <select required id='FF_117000' name='FF_117000'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117000] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117000] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117000] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117000] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117000] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117000] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117000] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117100_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>5.</td><td>Wie oft haben Sie sich in den letzten zwei Wochen bedrückt oder entmutigt gefühlt?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117100_b'>
                        <select required id='FF_117100' name='FF_117100'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117100] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117100] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117100] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117100] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117100] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117100] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117100] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117200_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>6.</td><td></b> Hatten Sie in den letzten zwei Wochen Probleme mit dem Abgehenlassen von Blähungen?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117200_b'>
                        <select required id='FF_117200' name='FF_117200'  onchange='follow_select(this)'><option value=''></option><option value='Sehr grosse Probleme' <?php if (($form_data_a[117200] ?? '') == 'Sehr grosse Probleme') echo 'selected'; ?>>Sehr grosse Probleme</option><option value='Grosse Probleme' <?php if (($form_data_a[117200] ?? '') == 'Grosse Probleme') echo 'selected'; ?>>Grosse Probleme</option><option value='Ziemliche Probleme' <?php if (($form_data_a[117200] ?? '') == 'Ziemliche Probleme') echo 'selected'; ?>>Ziemliche Probleme</option><option value='Etwas Probleme' <?php if (($form_data_a[117200] ?? '') == 'Etwas Probleme') echo 'selected'; ?>>Etwas Probleme</option><option value='Wenig Probleme' <?php if (($form_data_a[117200] ?? '') == 'Wenig Probleme') echo 'selected'; ?>>Wenig Probleme</option><option value='Kaum Probleme' <?php if (($form_data_a[117200] ?? '') == 'Kaum Probleme') echo 'selected'; ?>>Kaum Probleme</option><option value='Kein Problem' <?php if (($form_data_a[117200] ?? '') == 'Kein Problem') echo 'selected'; ?>>Kein Problem</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117300_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>7.</td><td>Hatten Sie in den letzten zwei Wochen Probleme, Ihr gewünschtes Gewicht zu halten oder zu erreichen?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117300_b'>
                        <select required id='FF_117300' name='FF_117300'  onchange='follow_select(this)'><option value=''></option><option value='Sehr grosse Probleme' <?php if (($form_data_a[117300] ?? '') == 'Sehr grosse Probleme') echo 'selected'; ?>>Sehr grosse Probleme</option><option value='Grosse Probleme' <?php if (($form_data_a[117300] ?? '') == 'Grosse Probleme') echo 'selected'; ?>>Grosse Probleme</option><option value='Ziemliche Probleme' <?php if (($form_data_a[117300] ?? '') == 'Ziemliche Probleme') echo 'selected'; ?>>Ziemliche Probleme</option><option value='Etwas Probleme' <?php if (($form_data_a[117300] ?? '') == 'Etwas Probleme') echo 'selected'; ?>>Etwas Probleme</option><option value='Wenig Probleme' <?php if (($form_data_a[117300] ?? '') == 'Wenig Probleme') echo 'selected'; ?>>Wenig Probleme</option><option value='Kaum Probleme' <?php if (($form_data_a[117300] ?? '') == 'Kaum Probleme') echo 'selected'; ?>>Kaum Probleme</option><option value='Kein Problem' <?php if (($form_data_a[117300] ?? '') == 'Kein Problem') echo 'selected'; ?>>Kein Problem</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117400_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>8.</td><td>Wie oft haben Sie sich in den letzten zwei Wochen locker und entspannt gefühlt?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117400_b'>
                        <select required id='FF_117400' name='FF_117400'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117400] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117400] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117400] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117400] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117400] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117400] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117400] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117500_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>9.</td><td>Wie oft haben Sie in den letzten zwei Wochen unter dem Gefühl gelitten, zur Toilette gehen zu müssen, obwohl Ihr Darm leer war?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117500_b'>
                        <select required id='FF_117500' name='FF_117500'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117500] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117500] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117500] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117500] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117500] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117500] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117500] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117600_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>10.</td><td>Wie oft haben Sie sich in den letzten zwei Wochen aufgrund Ihrer Darmerkrankung zornig gefühlt?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117600_b'>
                        <select required id='FF_117600' name='FF_117600'  onchange='follow_select(this)'><option value=''></option><option value='Ständig' <?php if (($form_data_a[117600] ?? '') == 'Ständig') echo 'selected'; ?>>Ständig</option><option value='Meistens' <?php if (($form_data_a[117600] ?? '') == 'Meistens') echo 'selected'; ?>>Meistens</option><option value='Ziemlich oft' <?php if (($form_data_a[117600] ?? '') == 'Ziemlich oft') echo 'selected'; ?>>Ziemlich oft</option><option value='Manchmal' <?php if (($form_data_a[117600] ?? '') == 'Manchmal') echo 'selected'; ?>>Manchmal</option><option value='Selten' <?php if (($form_data_a[117600] ?? '') == 'Selten') echo 'selected'; ?>>Selten</option><option value='Fast Nie' <?php if (($form_data_a[117600] ?? '') == 'Fast Nie') echo 'selected'; ?>>Fast Nie</option><option value='Nie' <?php if (($form_data_a[117600] ?? '') == 'Nie') echo 'selected'; ?>>Nie</option>
                        </select>
                    </div>
			</fieldset>
			<fieldset id='FS_'><legend>Lebensqualität (PROMIS)</legend>
					
                    <div class='col_a' id='SH_119100_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Wie würden Sie Ihren Gesundheitszustand insgesamt beschreiben?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119100_b'>
                        <select required id='FF_119100' name='FF_119100'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119100] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119100] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119100] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119100] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119100] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119110_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Wie würden Sie Ihre Lebensqualität insgesamt beschreiben?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119110_b'>
                        <select required id='FF_119110' name='FF_119110'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119110] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119110] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119110] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119110] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119110] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119120_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Wie würden Sie Ihren körperlichen Gesundheitszustand insgesamt beschreiben?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119120_b'>
                        <select required id='FF_119120' name='FF_119120'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119120] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119120] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119120] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119120] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119120] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119130_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Wie würden Sie Ihre psychische Verfassung insgesamt beschreiben?<br>(Dazu zählen Ihre Stimmung und Ihre Fähigkeit, klar zu denken.)</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119130_b'>
                        <select required id='FF_119130' name='FF_119130'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119130] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119130] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119130] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119130] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119130] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119140_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>5.</td><td>Wie zufrieden sind Sie insgesamt mit Ihren Aktivitäten mit anderen Menschen und mit Ihren Beziehungen zu anderen?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119140_b'>
                        <select required id='FF_119140' name='FF_119140'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119140] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119140] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119140] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119140] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119140] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119150_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>6.</td><td>Wie gut sind Sie insgesamt in der Lage, Aktivitäten mit anderen Menschen nachzugehen und Ihre Rollen im Alltag und in der Gemeinschaft auszufüllen.<br>(Dazu zählen Aktivitäten zu Hause, am Arbeitsplatz, in Ihrem Umfeld sowie Ihre Aufgaben als Elternteil, Sohn, Tochter, Lebenspartner/-in, im Berufsleben, in Ihrem Freundeskreis usw.)</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119150_b'>
                        <select required id='FF_119150' name='FF_119150'  onchange='follow_select(this)'><option value=''></option><option value='ausgezeichnet' <?php if (($form_data_a[119150] ?? '') == 'ausgezeichnet') echo 'selected'; ?>>ausgezeichnet</option><option value='sehr gut' <?php if (($form_data_a[119150] ?? '') == 'sehr gut') echo 'selected'; ?>>sehr gut</option><option value='gut' <?php if (($form_data_a[119150] ?? '') == 'gut') echo 'selected'; ?>>gut</option><option value='einigermaßen' <?php if (($form_data_a[119150] ?? '') == 'einigermaßen') echo 'selected'; ?>>einigermaßen</option><option value='schlecht' <?php if (($form_data_a[119150] ?? '') == 'schlecht') echo 'selected'; ?>>schlecht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119160_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>7.</td><td>Inwieweit sind Sie in der Lage, alltägliche körperliche Aktivitäten auszuführen, z. B. Gehen, Treppensteigen, Einkäufe tragen oder Stühle verschieben?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119160_b'>
                        <select required id='FF_119160' name='FF_119160'  onchange='follow_select(this)'><option value=''></option><option value='vollständig' <?php if (($form_data_a[119160] ?? '') == 'vollständig') echo 'selected'; ?>>vollständig</option><option value='größtenteils' <?php if (($form_data_a[119160] ?? '') == 'größtenteils') echo 'selected'; ?>>größtenteils</option><option value='halbwegs' <?php if (($form_data_a[119160] ?? '') == 'halbwegs') echo 'selected'; ?>>halbwegs</option><option value='ein wenig' <?php if (($form_data_a[119160] ?? '') == 'ein wenig') echo 'selected'; ?>>ein wenig</option><option value='überhaupt nicht' <?php if (($form_data_a[119160] ?? '') == 'überhaupt nicht') echo 'selected'; ?>>überhaupt nicht</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119170_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>8.</td><td>Wie oft haben Ihnen seelische Probleme zu schaffen gemacht, wie z. B. Angstgefühle, Traurigkeit, Niedergeschlagenheit oder Reizbarkeit? </td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119170_b'>
                        <select required id='FF_119170' name='FF_119170'  onchange='follow_select(this)'><option value=''></option><option value='nie' <?php if (($form_data_a[119170] ?? '') == 'nie') echo 'selected'; ?>>nie</option><option value='selten' <?php if (($form_data_a[119170] ?? '') == 'selten') echo 'selected'; ?>>selten</option><option value='manchmal' <?php if (($form_data_a[119170] ?? '') == 'manchmal') echo 'selected'; ?>>manchmal</option><option value='oft' <?php if (($form_data_a[119170] ?? '') == 'oft') echo 'selected'; ?>>oft</option><option value='immer' <?php if (($form_data_a[119170] ?? '') == 'immer') echo 'selected'; ?>>immer</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_119180_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>9.</td><td>Wie ausgepägt war Ihre Müdigkeit im Durchschnitt?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_119180_b'>
                        <select required id='FF_119180' name='FF_119180'  onchange='follow_select(this)'><option value=''></option><option value='keine Müdigkeit' <?php if (($form_data_a[119180] ?? '') == 'keine Müdigkeit') echo 'selected'; ?>>keine Müdigkeit</option><option value='schwach' <?php if (($form_data_a[119180] ?? '') == 'schwach') echo 'selected'; ?>>schwach</option><option value='mäßig' <?php if (($form_data_a[119180] ?? '') == 'mäßig') echo 'selected'; ?>>mäßig</option><option value='stark' <?php if (($form_data_a[119180] ?? '') == 'stark') echo 'selected'; ?>>stark</option><option value='sehr stark' <?php if (($form_data_a[119180] ?? '') == 'sehr stark') echo 'selected'; ?>>sehr stark</option>
                        </select>
                    </div>
					
                    <div class='col' style='width:100%' id='SH_119190'>
                        <div class='desc_f'><table class='td_num'><tr><td>10.</td><td>Wie würden Sie Ihre Schmerzen im Allgemeinen einschätzen?</td></tr></table></div>
                        <div class='slider-container'>
                            <label for='119190_wertSchieberegler' class='slider-label start-label'>Keine Schmerzen</label>
                            <input class='wertSchieberegler' type='range' id='119190_wertSchieberegler' min='0' max='10' value=0 step='1'>
                            <label for='119190_wertSchieberegler' class='slider-label end-label'>Schlimmstmögliche Schmerzen</label>
                            <span style='position: absolute;left:42.9%;background-color:yellow;color:green;padding.right:2px;' id='wertSchieberegler_display_119190'>0</span>
                        </div>
                    </div>
                    <input type='hidden' id='FF_119190' name='FF_119190' value="<?php echo htmlspecialchars($form_data_a[119190] ?? ''); ?>">
                    <script>
                        initSliderWithHiddenField('<?php echo 119190; ?>');
                    </script>
			</fieldset>
					<div class='col_100 infotext'  id='SH_5915'>Vielen Dank, dass Sie sich bereits die Zeit genommen haben, unseren Fragebogen auszufüllen. Uns ist bewusst, dass dies mit Aufwand verbunden ist. Der folgende Abschnitt ist daher freiwillig – wir würden uns jedoch sehr freuen, wenn Sie auch diesen beantworten. Ihre Angaben helfen dabei, die Behandlungsqualität weiter zu verbessern – zu Ihrem Nutzen und dem anderer Patientinnen und Patienten.<br>&nbsp;</div>
			<fieldset id='FS_'><legend>Lebensqualität (FACIT - Fragebogen zur Einstufung der Erschöpfung)</legend>
					
                    <div class='col_a' id='SH_117700_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Ich bin erschöpft</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117700_b'>
                        <select  id='FF_117700' name='FF_117700'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[117700] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[117700] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[117700] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[117700] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[117700] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117800_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Ich fühle mich insgesamt schwach</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117800_b'>
                        <select  id='FF_117800' name='FF_117800'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[117800] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[117800] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[117800] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[117800] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[117800] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_117900_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Ich fühle mich lustlos (ausgelaugt)</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117900_b'>
                        <select  id='FF_117900' name='FF_117900'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[117900] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[117900] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[117900] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[117900] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[117900] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118000_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Ich bin müde</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118000_b'>
                        <select  id='FF_118000' name='FF_118000'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118000] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118000] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118000] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118000] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118000] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118100_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>5.</td><td>Es fällt mir schwer, etwas anzufangen, weil ich müde bin</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118100_b'>
                        <select  id='FF_118100' name='FF_118100'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118100] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118100] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118100] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118100] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118100] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118200_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>6.</td><td>Es fällt mir schwer, etwas zu Ende zu führen, weil ich müde bin</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118200_b'>
                        <select  id='FF_118200' name='FF_118200'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118200] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118200] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118200] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118200] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118200] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118300_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>7.</td><td>Ich habe Energie</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118300_b'>
                        <select  id='FF_118300' name='FF_118300'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118300] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118300] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118300] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118300] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118300] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118400_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>8.</td><td>Ich bin in der Lage, meinen gewohnten Aktivitäten nachzugehen (Beruf, Einkaufen, Schule, Freizeit, Sport usw.)</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118400_b'>
                        <select  id='FF_118400' name='FF_118400'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118400] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118400] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118400] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118400] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118400] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118500_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>9.</td><td>Ich habe das Bedürfnis, tagsüber zu schlafen.</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118500_b'>
                        <select  id='FF_118500' name='FF_118500'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118500] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118500] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118500] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118500] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118500] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118600_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>10.</td><td>Ich bin zu müde, um zu essen</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118600_b'>
                        <select  id='FF_118600' name='FF_118600'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118600] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118600] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118600] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118600] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118600] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118700_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>11.</td><td>Ich brauche Hilfe bei meinen gewohnten Aktivitäten (Beruf, Einkaufen, Schule, Freizeit, Sport usw.)</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118700_b'>
                        <select  id='FF_118700' name='FF_118700'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118700] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118700] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118700] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118700] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118700] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118800_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>12.</td><td>Ich bin frustriert weil ich zu müde bin, die Dinge zu tun, die ich machen möchte</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118800_b'>
                        <select  id='FF_118800' name='FF_118800'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118800] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118800] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118800] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118800] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118800] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_118900_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>13.</td><td>Ich musste meine sozialen Aktivitäten einschränken, weil ich müde bin.</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_118900_b'>
                        <select  id='FF_118900' name='FF_118900'  onchange='follow_select(this)'><option value=''></option><option value='Überhaupt nicht' <?php if (($form_data_a[118900] ?? '') == 'Überhaupt nicht') echo 'selected'; ?>>Überhaupt nicht</option><option value='Ein wenig' <?php if (($form_data_a[118900] ?? '') == 'Ein wenig') echo 'selected'; ?>>Ein wenig</option><option value='Mäßig' <?php if (($form_data_a[118900] ?? '') == 'Mäßig') echo 'selected'; ?>>Mäßig</option><option value='Ziemlich' <?php if (($form_data_a[118900] ?? '') == 'Ziemlich') echo 'selected'; ?>>Ziemlich</option><option value='Sehr' <?php if (($form_data_a[118900] ?? '') == 'Sehr') echo 'selected'; ?>>Sehr</option>
                        </select>
                    </div>
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



    <div id='lock-layer' class='lock-layer-hidden'></div>
</body>

</html>