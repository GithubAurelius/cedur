<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
require_once $_SESSION['INI-PATH'];
require_once MIQ_ROOT."/modules/form_base/form_start.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einfaches HTML Formular</title>
    <link rel="stylesheet" href="<? echo MIQ_PATH?>/css/form_base.css">
    <script src="<? echo MIQ_PATH?>/modules/form_base/forms.js"></script>
</head>


<body>
    
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" id='main_form' enctype="multipart/form-data">
        <div>
            <h4>
                CID: <?php echo $fcid ?>
                <!--<button type="button" onClick="window.parent.forward_form('fcid', <?php echo $fcid ?>,'Test1')" >Beispiel weiterführendes Formular</button>-->
                <button type="button" onClick="window.location.href='<?=$_SERVER['PHP_SELF']?>?fg=<?=$fg?>&fcid=' + getCid()" >NEU</button>
            </h4>
            <hr>
            <input type="hidden" id="fcid" name="fcid" value="<?php echo $fcid ?>">
            <input type="hidden" id="fg" name="fg" value="<?php echo $fg ?>">
            <input type="hidden" id="opener_num" name="opener_num" value="<?php echo $opener_num ?>">
        </div>
        <creator>
			<fieldset><legend>patient</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Patient ID</div><input type='text' id='FF_100100' name='FF_100100'></div>
					<div class='col'><div class='desc_f'>Patient Nummer</div><input type='text' id='FF_100200' name='FF_100200'></div>
					<div class='col'><div class='desc_f'>Patient Geschlecht</div><input type='text' id='FF_100300' name='FF_100300'></div>
					<div class='col'><div class='desc_f'>Patient Geburtsjahr</div><input type='text' id='FF_100400' name='FF_100400'></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Patient Test</div><input type='text' id='FF_100500' name='FF_100500'></div>
					<div class='col'><div class='desc_f'>Patient Status</div><input type='text' id='FF_100600' name='FF_100600'></div>
					<div class='col'><div class='desc_f'>Patient Externe ID</div><input type='text' id='FF_100700' name='FF_100700'></div>
					<div class='col'><div class='desc_f'>Patient Erstallt am</div><input type='text' id='FF_100800' name='FF_100800'></div>
			<fieldset><legend>center</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Zentrums ID</div><input type='text' id='FF_100900' name='FF_100900'></div>
					<div class='col'><div class='desc_f'>Zentrums Code</div><input type='text' id='FF_101000' name='FF_101000'></div>
					<div class='col'><div class='desc_f'>Zentrums Name</div><input type='text' id='FF_101100' name='FF_101100'></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Befragung erstellt am</div><input type='text' id='FF_101200' name='FF_101200'></div>
					<div class='col'><div class='desc_f'>Befragung zuletzt bearbeitet am</div><input type='text' id='FF_101300' name='FF_101300'></div>
					<div class='col'><div class='desc_f'>Befragung abgeschlossen am</div><input type='text' id='FF_101400' name='FF_101400'></div>
					<div class='col'><div class='desc_f'>CDAI-Score</div><input type='text' id='FF_101500' name='FF_101500'></div>
					<div class='col'><div class='desc_f'>SIDBQ-Score</div><input type='text' id='FF_101600' name='FF_101600'></div>
					<div class='col'><div class='desc_f'>CACP-Score</div><input type='text' id='FF_101700' name='FF_101700'></div>
					<div class='col'><div class='desc_f'>FACIT-Score</div><input type='text' id='FF_101800' name='FF_101800'></div>
				</div>
			</fieldset>
					<div class='col'><div class='desc_f'>Welche Diagnose wurde bei Ihnen gestellt?</div><input type='text' id='FF_101900' name='FF_101900'></div>
					<div class='col'><div class='desc_f'>Benennen Sie bitte die Lokalisation der Colitis ulcerosa</div><input type='text' id='FF_102000' name='FF_102000'></div>
					<div class='col'><div class='desc_f'>Benennen Sie bitte die Lokalisation des M. Crohn</div><input type='text' id='FF_102100' name='FF_102100'></div>
					<div class='col'><div class='desc_f'>Datum der Erstdiagnose</div><input type='text' id='FF_102200' name='FF_102200'></div>
					<div class='col'><div class='desc_f'>Wann sind bei Ihnen die ersten Symptome Ihrer Erkrankung aufgetreten?</div><input type='text' id='FF_102300' name='FF_102300'></div>
					<div class='col'><div class='desc_f'>Waren Sie seit Ihrer letzten CEDUR-Befragung im Krankenhaus?</div><input type='text' id='FF_102400' name='FF_102400'></div>
					<div class='col'><div class='desc_f'>An welchen Tagen waren Sie im Krankenhaus?</div><input type='text' id='FF_102500' name='FF_102500'></div>
					<div class='col'><div class='desc_f'>Wie groß sind Sie?</div><input type='text' id='FF_102600' name='FF_102600'></div>
					<div class='col'><div class='desc_f'>Wieviel wiegen Sie?</div><input type='text' id='FF_102700' name='FF_102700'></div>
					<div class='col'><div class='desc_f'>Rauchen Sie?</div><input type='text' id='FF_102800' name='FF_102800'></div>
					<div class='col'><div class='desc_f'>Welche Tabakprodukte nutzen Sie?</div><input type='text' id='FF_102900' name='FF_102900'></div>
					<div class='col'><div class='desc_f'>Wie häufig rauchen Sie E-Zigaretten pro Tag?</div><input type='text' id='FF_103000' name='FF_103000'></div>
					<div class='col'><div class='desc_f'>Wie oft rauchen Sie Pfeife pro Tag?</div><input type='text' id='FF_103100' name='FF_103100'></div>
					<div class='col'><div class='desc_f'>Wie häufig nutzen Sie einen Tabakerhitzer pro Tag?</div><input type='text' id='FF_103200' name='FF_103200'></div>
					<div class='col'><div class='desc_f'>Wieviele Zigarillos / Zigarren rauchen Sie pro Tag?</div><input type='text' id='FF_103300' name='FF_103300'></div>
					<div class='col'><div class='desc_f'>Wie viele Zigaretten rauchen Sie pro Tag?</div><input type='text' id='FF_103400' name='FF_103400'></div>
					<div class='col'><div class='desc_f'>Wie viele flüssige / breiige Stuhlgänge (Bei Stoma: Beutelentleerungen) hatten Sie in der vergangenen Woche durchschnittlich pro Tag?</div><input type='text' id='FF_103500' name='FF_103500'></div>
					<div class='col'><div class='desc_f'>Blutbeimengungen beim Stuhl</div><input type='text' id='FF_103600' name='FF_103600'></div>
					<div class='col'><div class='desc_f'>Globale Beurteilung des Krankheitszustandes</div><input type='text' id='FF_103700' name='FF_103700'></div>
					<div class='col'><div class='desc_f'>Endoskopischer Befund Mayo Score (falls vorhanden)</div><input type='text' id='FF_103800' name='FF_103800'></div>
					<div class='col'><div class='desc_f'>Bauchschmerzen über die letzten 7 Tage</div><input type='text' id='FF_103900' name='FF_103900'></div>
					<div class='col'><div class='desc_f'>Ihr Allgemeinbefinden über die letzten 7 Tage</div><input type='text' id='FF_104000' name='FF_104000'></div>
					<div class='col'><div class='desc_f'>Haben oder hatten Sie Fisteln? (Wenn Sie nicht wissen, was das ist, haben bzw. hatten Sie auch keine)</div><input type='text' id='FF_104100' name='FF_104100'></div>
					<div class='col'><div class='desc_f'>Haben Sie aktuell Fisteln?</div><input type='text' id='FF_104200' name='FF_104200'></div>
					<div class='col'><div class='desc_f'>Perianale Crohn Erkrankung (z.B. Fisteln, Fissuren, Abszesse)</div><input type='text' id='FF_104300' name='FF_104300'></div>
					<div class='col'><div class='desc_f'>Andere Fisteln (z.B. rektovesikal, Bauchdeckenfistel etc.)</div><input type='text' id='FF_104400' name='FF_104400'></div>
					<div class='col'><div class='desc_f'>Hatten Sie Fisteln?</div><input type='text' id='FF_104500' name='FF_104500'></div>
					<div class='col'><div class='desc_f'>Analfissur, Analfistel(n)</div><input type='text' id='FF_104600' name='FF_104600'></div>
					<div class='col'><div class='desc_f'>Andere Fisteln</div><input type='text' id='FF_104700' name='FF_104700'></div>
					<div class='col'><div class='desc_f'>Hat oder hatte der Patient Stenosen?</div><input type='text' id='FF_104800' name='FF_104800'></div>
					<div class='col'><div class='desc_f'>Lokalisation der Stenose</div><input type='text' id='FF_104900' name='FF_104900'></div>
					<div class='col'><div class='desc_f'>Sind Verwandte von Ihnen an einer CED erkrankt?</div><input type='text' id='FF_105000' name='FF_105000'></div>
					<div class='col'><div class='desc_f'>Mutter / Vater</div><input type='text' id='FF_105100' name='FF_105100'></div>
					<div class='col'><div class='desc_f'>Bruder / Schwester</div><input type='text' id='FF_105200' name='FF_105200'></div>
					<div class='col'><div class='desc_f'>Zwilling</div><input type='text' id='FF_105300' name='FF_105300'></div>
					<div class='col'><div class='desc_f'>Sohn / Tochter</div><input type='text' id='FF_105400' name='FF_105400'></div>
					<div class='col'><div class='desc_f'>Großvater / Großmutter</div><input type='text' id='FF_105500' name='FF_105500'></div>
					<div class='col'><div class='desc_f'>Tante / Onkel</div><input type='text' id='FF_105600' name='FF_105600'></div>
					<div class='col'><div class='desc_f'>Neffe / Nichte</div><input type='text' id='FF_105700' name='FF_105700'></div>
					<div class='col'><div class='desc_f'>Cousin / Cousine</div><input type='text' id='FF_105800' name='FF_105800'></div>
					<div class='col'><div class='desc_f'>Andere</div><input type='text' id='FF_105900' name='FF_105900'></div>
					<div class='col'><div class='desc_f'>Wie sind Sie zur Zeit tätig?</div><input type='text' id='FF_106000' name='FF_106000'></div>
					<div class='col'><div class='desc_f'>Aufgrund welcher Erkrankung sind sie berentet?</div><input type='text' id='FF_106100' name='FF_106100'></div>
					<div class='col'><div class='desc_f'>Waren Sie in den letzten 6 Monaten aufgrund Ihrer CED krankgeschrieben?</div><input type='text' id='FF_106200' name='FF_106200'></div>
					<div class='col'><div class='desc_f'>Bitte geben Sie in dem Kalender Ihre Fehltage ein.</div><input type='text' id='FF_106300' name='FF_106300'></div>
					<div class='col'><div class='desc_f'>Seit wann sind Sie wegen Ihrer CED berentet?</div><input type='text' id='FF_106400' name='FF_106400'></div>
					<div class='col'><div class='desc_f'>Welche Erwerbstätigkeit üben Sie derzeit aus (Beruf)?</div><input type='text' id='FF_106500' name='FF_106500'></div>
					<div class='col'><div class='desc_f'>Umfang der aktuellen Tätigkeit</div><input type='text' id='FF_106600' name='FF_106600'></div>
					<div class='col'><div class='desc_f'>Welchen Schulabschluß haben Sie?</div><input type='text' id='FF_106700' name='FF_106700'></div>
					<div class='col'><div class='desc_f'>Haben Sie zur Zeit ein Stoma (künstlicher Darmausgang)?</div><input type='text' id='FF_106800' name='FF_106800'></div>
					<div class='col'><div class='desc_f'>Sind Sie schon einmal wegen Ihrer CED am Darm operiert worden?</div><input type='text' id='FF_106900' name='FF_106900'></div>
					<div class='col'><div class='desc_f'>1. Operation</div><input type='text' id='FF_107000' name='FF_107000'></div>
					<div class='col'><div class='desc_f'>Datum der OP</div><input type='text' id='FF_107100' name='FF_107100'></div>
					<div class='col'><div class='desc_f'>Art der OP</div><input type='text' id='FF_107200' name='FF_107200'></div>
					<div class='col'><div class='desc_f'>2. Operation</div><input type='text' id='FF_107300' name='FF_107300'></div>
					<div class='col'><div class='desc_f'>Datum der OP</div><input type='text' id='FF_107400' name='FF_107400'></div>
					<div class='col'><div class='desc_f'>Art der OP</div><input type='text' id='FF_107500' name='FF_107500'></div>
					<div class='col'><div class='desc_f'>3. Operation</div><input type='text' id='FF_107600' name='FF_107600'></div>
					<div class='col'><div class='desc_f'>Datum der OP</div><input type='text' id='FF_107700' name='FF_107700'></div>
					<div class='col'><div class='desc_f'>Art der OP</div><input type='text' id='FF_107800' name='FF_107800'></div>
					<div class='col'><div class='desc_f'>4. Operation</div><input type='text' id='FF_107900' name='FF_107900'></div>
					<div class='col'><div class='desc_f'>Datum der OP</div><input type='text' id='FF_108000' name='FF_108000'></div>
					<div class='col'><div class='desc_f'>Art der OP</div><input type='text' id='FF_108100' name='FF_108100'></div>
					<div class='col'><div class='desc_f'>5. Operation</div><input type='text' id='FF_108200' name='FF_108200'></div>
					<div class='col'><div class='desc_f'>Datum der OP</div><input type='text' id='FF_108300' name='FF_108300'></div>
					<div class='col'><div class='desc_f'>Art der OP</div><input type='text' id='FF_108400' name='FF_108400'></div>
					<div class='col'><div class='desc_f'>Sind Sie schwanger? </div><input type='text' id='FF_108500' name='FF_108500'></div>
					<div class='col'><div class='desc_f'>In welcher Woche sind Sie schwanger?</div><input type='text' id='FF_108600' name='FF_108600'></div>
					<div class='col'><div class='desc_f'>Wann ist der errechnete Geburtstermin?</div><input type='text' id='FF_108700' name='FF_108700'></div>
					<div class='col'><div class='desc_f'>Wurde wegen der Schwangerschaft die CED Behandlung verändert?</div><input type='text' id='FF_108800' name='FF_108800'></div>
					<div class='col'><div class='desc_f'>Waren sie vor dieser aktuellen Schwangerschaft schon einmal schwanger?</div><input type='text' id='FF_108900' name='FF_108900'></div>
					<div class='col'><div class='desc_f'>Anzahl der Schwangerschaften (ohne die aktuelle):</div><input type='text' id='FF_109000' name='FF_109000'></div>
					<div class='col'><div class='desc_f'>Waren Sie schon einmal schwanger?</div><input type='text' id='FF_109100' name='FF_109100'></div>
					<div class='col'><div class='desc_f'>Anzahl der Schwangerschaften</div><input type='text' id='FF_109200' name='FF_109200'></div>
					<div class='col'><div class='desc_f'>War die letzte Schwangerschaft innerhalb der letzten 6 Monate</div><input type='text' id='FF_109300' name='FF_109300'></div>
					<div class='col'><div class='desc_f'>Gab es Komplikationen während Ihrer letzten Schwangerschaft?</div><input type='text' id='FF_109400' name='FF_109400'></div>
					<div class='col'><div class='desc_f'>Schwangerschaftswoche bei Geburt</div><input type='text' id='FF_109500' name='FF_109500'></div>
					<div class='col'><div class='desc_f'>Wie verlief die Geburt?</div><input type='text' id='FF_109600' name='FF_109600'></div>
					<div class='col'><div class='desc_f'>Geschlecht des Kindes</div><input type='text' id='FF_109700' name='FF_109700'></div>
					<div class='col'><div class='desc_f'>Geburtsgewicht</div><input type='text' id='FF_109800' name='FF_109800'></div>
					<div class='col'><div class='desc_f'>Körpergröße des Kindes bei Geburt</div><input type='text' id='FF_109900' name='FF_109900'></div>
					<div class='col'><div class='desc_f'>Kopfumfang des Kindes bei Geburt</div><input type='text' id='FF_110000' name='FF_110000'></div>
					<div class='col'><div class='desc_f'>Ist Ihr Kind gesund?</div><input type='text' id='FF_110100' name='FF_110100'></div>
					<div class='col'><div class='desc_f'>Hämatokrit</div><input type='text' id='FF_110200' name='FF_110200'></div>
					<div class='col'><div class='desc_f'>Calprotectin bestimmt?</div><input type='text' id='FF_110300' name='FF_110300'></div>
					<div class='col'><div class='desc_f'>größer 50mg/kg</div><input type='text' id='FF_110400' name='FF_110400'></div>
					<div class='col'><div class='desc_f'>Wert</div><input type='text' id='FF_110500' name='FF_110500'></div>
					<div class='col'><div class='desc_f'>Hämoglobin</div><input type='text' id='FF_110600' name='FF_110600'></div>
					<div class='col'><div class='desc_f'>Ferritin</div><input type='text' id='FF_110700' name='FF_110700'></div>
					<div class='col'><div class='desc_f'>CRP bestimmt?</div><input type='text' id='FF_110800' name='FF_110800'></div>
					<div class='col'><div class='desc_f'>CRP größer 5mg/dl</div><input type='text' id='FF_110900' name='FF_110900'></div>
					<div class='col'><div class='desc_f'>mg/dl</div><input type='text' id='FF_111000' name='FF_111000'></div>
					<div class='col'><div class='desc_f'>Albumin</div><input type='text' id='FF_111100' name='FF_111100'></div>
					<div class='col'><div class='desc_f'>Haben Sie noch weitere Erkrankungen?</div><input type='text' id='FF_111200' name='FF_111200'></div>
					<div class='col'><div class='desc_f'>Akne inversa</div><input type='text' id='FF_111300' name='FF_111300'></div>
					<div class='col'><div class='desc_f'>Asthma bronchiale</div><input type='text' id='FF_111400' name='FF_111400'></div>
					<div class='col'><div class='desc_f'>Bauchspeicheldrüsenkrebs</div><input type='text' id='FF_111500' name='FF_111500'></div>
					<div class='col'><div class='desc_f'>Blasenentzündung</div><input type='text' id='FF_111600' name='FF_111600'></div>
					<div class='col'><div class='desc_f'>Bluthochdruck</div><input type='text' id='FF_111700' name='FF_111700'></div>
					<div class='col'><div class='desc_f'>Brustkrebs</div><input type='text' id='FF_111800' name='FF_111800'></div>
					<div class='col'><div class='desc_f'>Darmkrebs</div><input type='text' id='FF_111900' name='FF_111900'></div>
					<div class='col'><div class='desc_f'>Diabetes mellitus</div><input type='text' id='FF_112000' name='FF_112000'></div>
					<div class='col'><div class='desc_f'>Depression</div><input type='text' id='FF_112100' name='FF_112100'></div>
					<div class='col'><div class='desc_f'>Eierstock-Krebs</div><input type='text' id='FF_112200' name='FF_112200'></div>
					<div class='col'><div class='desc_f'>Fatigue Syndrom (ständige Müdigkeit, Abgeschlagenheit)</div><input type='text' id='FF_112300' name='FF_112300'></div>
					<div class='col'><div class='desc_f'>Fettstoffwechselstörung</div><input type='text' id='FF_112400' name='FF_112400'></div>
					<div class='col'><div class='desc_f'>Gallensteine</div><input type='text' id='FF_112500' name='FF_112500'></div>
					<div class='col'><div class='desc_f'>Grauer Star</div><input type='text' id='FF_112600' name='FF_112600'></div>
					<div class='col'><div class='desc_f'>Grüner Star</div><input type='text' id='FF_112700' name='FF_112700'></div>
					<div class='col'><div class='desc_f'>Gürtelrose (Herpes zoster)</div><input type='text' id='FF_112800' name='FF_112800'></div>
					<div class='col'><div class='desc_f'>Hautkrebs (schwarzer und weißer Hautkrebs)</div><input type='text' id='FF_112900' name='FF_112900'></div>
					<div class='col'><div class='desc_f'>Haarausfall</div><input type='text' id='FF_113000' name='FF_113000'></div>
					<div class='col'><div class='desc_f'>Hepatitis (A, B, C, D oder E)</div><input type='text' id='FF_113100' name='FF_113100'></div>
					<div class='col'><div class='desc_f'>Herzinfarkt</div><input type='text' id='FF_113200' name='FF_113200'></div>
					<div class='col'><div class='desc_f'>Hodenkrebs</div><input type='text' id='FF_113300' name='FF_113300'></div>
					<div class='col'><div class='desc_f'>HIV</div><input type='text' id='FF_113400' name='FF_113400'></div>
					<div class='col'><div class='desc_f'>Koronare Herzkrankheit</div><input type='text' id='FF_113500' name='FF_113500'></div>
					<div class='col'><div class='desc_f'>Kurzdarmsyndrom</div><input type='text' id='FF_113600' name='FF_113600'></div>
					<div class='col'><div class='desc_f'>Leberzirrhose</div><input type='text' id='FF_113700' name='FF_113700'></div>
					<div class='col'><div class='desc_f'>Leukämie</div><input type='text' id='FF_113800' name='FF_113800'></div>
					<div class='col'><div class='desc_f'>Lungenkrebs</div><input type='text' id='FF_113900' name='FF_113900'></div>
					<div class='col'><div class='desc_f'>Lymphdrüsenkrebs</div><input type='text' id='FF_114000' name='FF_114000'></div>
					<div class='col'><div class='desc_f'>Migräne</div><input type='text' id='FF_114100' name='FF_114100'></div>
					<div class='col'><div class='desc_f'>Multiple Sklerose (MS)</div><input type='text' id='FF_114200' name='FF_114200'></div>
					<div class='col'><div class='desc_f'>Nierenerkrankung</div><input type='text' id='FF_114300' name='FF_114300'></div>
					<div class='col'><div class='desc_f'>Nierensteine</div><input type='text' id='FF_114400' name='FF_114400'></div>
					<div class='col'><div class='desc_f'>Osteoporose</div><input type='text' id='FF_114500' name='FF_114500'></div>
					<div class='col'><div class='desc_f'>PBC (Primär biliäre Zirrhose / Cholangitis)</div><input type='text' id='FF_114600' name='FF_114600'></div>
					<div class='col'><div class='desc_f'>Prostatakrebs</div><input type='text' id='FF_114700' name='FF_114700'></div>
					<div class='col'><div class='desc_f'>PSC (primär)</div><input type='text' id='FF_114800' name='FF_114800'></div>
					<div class='col'><div class='desc_f'>Rheumatoide Arthritis</div><input type='text' id='FF_114900' name='FF_114900'></div>
					<div class='col'><div class='desc_f'>Schilddrüsenüberfunktion</div><input type='text' id='FF_115000' name='FF_115000'></div>
					<div class='col'><div class='desc_f'>Schilddrüsenunterfunktion</div><input type='text' id='FF_115100' name='FF_115100'></div>
					<div class='col'><div class='desc_f'>Schlafstörungen</div><input type='text' id='FF_115200' name='FF_115200'></div>
					<div class='col'><div class='desc_f'>Schuppenflechte</div><input type='text' id='FF_115300' name='FF_115300'></div>
					<div class='col'><div class='desc_f'>Thrombose</div><input type='text' id='FF_115400' name='FF_115400'></div>
					<div class='col'><div class='desc_f'>Andere Erkrankungen</div><input type='text' id='FF_115500' name='FF_115500'></div>
					<div class='col'><div class='desc_f'>Augenbeteiligung (Iris, Uveitis)</div><input type='text' id='FF_115600' name='FF_115600'></div>
					<div class='col'><div class='desc_f'>Körpertemperatur über 37,8°C</div><input type='text' id='FF_115700' name='FF_115700'></div>
					<div class='col'><div class='desc_f'>Erythema nodosum, Pyoderma gangraenosum, Stomatitis aphtosa</div><input type='text' id='FF_115800' name='FF_115800'></div>
					<div class='col'><div class='desc_f'>Gelenkschmerzen / Arthritis</div><input type='text' id='FF_115900' name='FF_115900'></div>
					<div class='col'><div class='desc_f'>Resistenz im Abdomen</div><input type='text' id='FF_116000' name='FF_116000'></div>
					<div class='col'><div class='desc_f'>SES-CD Score</div><input type='text' id='FF_116100' name='FF_116100'></div>
					<div class='col'><div class='desc_f'>Ileum</div><input type='text' id='FF_116200' name='FF_116200'></div>
					<div class='col'><div class='desc_f'>Colon rechts</div><input type='text' id='FF_116300' name='FF_116300'></div>
					<div class='col'><div class='desc_f'>Colon transversum</div><input type='text' id='FF_116400' name='FF_116400'></div>
					<div class='col'><div class='desc_f'>Colon links</div><input type='text' id='FF_116500' name='FF_116500'></div>
					<div class='col'><div class='desc_f'>Rektum</div><input type='text' id='FF_116600' name='FF_116600'></div>
					<div class='col'><div class='desc_f'>1. Wie oft war das Gefühl von Abgeschlagenheit oder Müdigkeit und Abgespanntheit in den letzten zwei Wochen ein Problem für Sie? Bitte geben Sie an, wie oft das Gefühl von Müdigkeit oder Abgespanntheit in den letzten zwei Wochen ein Problem für Sie war.</div><input type='text' id='FF_116700' name='FF_116700'></div>
					<div class='col'><div class='desc_f'>2. Wie oft mussten Sie aufgrund Ihrer Darmerkrankung in den letzten zwei Wochen Treffen mit Freunden und/oder Verwandten verschieben oder absagen? </div><input type='text' id='FF_116800' name='FF_116800'></div>
					<div class='col'><div class='desc_f'>3. Hatten Sie in den letzten zwei Wochen aufgrund Ihrer Darmerkrankung Schwierigkeiten, gewünschten Sport- und Freizeitaktivitäten nachzugehen?</div><input type='text' id='FF_116900' name='FF_116900'></div>
					<div class='col'><div class='desc_f'>4. Wie oft haben Sie in den letzten zwei Wochen unter Bauchschmerzen gelitten? </div><input type='text' id='FF_117000' name='FF_117000'></div>
					<div class='col'><div class='desc_f'>5. Wie oft haben Sie sich in den letzten zwei Wochen bedrückt oder entmutigt gefühlt? </div><input type='text' id='FF_117100' name='FF_117100'></div>
					<div class='col'><div class='desc_f'>6. Hatten Sie in den letzten zwei Wochen Probleme mit dem Abgehenlassen von Blähungen? </div><input type='text' id='FF_117200' name='FF_117200'></div>
					<div class='col'><div class='desc_f'>7. Hatten Sie in den letzten zwei Wochen Probleme, Ihr gewünschtes Gewicht zu halten oder zu erreichen?</div><input type='text' id='FF_117300' name='FF_117300'></div>
					<div class='col'><div class='desc_f'>8. Wie oft haben Sie sich in den letzten zwei Wochen locker und entspannt gefühlt? </div><input type='text' id='FF_117400' name='FF_117400'></div>
					<div class='col'><div class='desc_f'>9. Wie oft haben Sie in den letzten zwei Wochen unter dem Gefühl gelitten, zur Toilette gehen zu müssen, obwohl Ihr Darm leer war? </div><input type='text' id='FF_117500' name='FF_117500'></div>
					<div class='col'><div class='desc_f'>10. Wie oft haben Sie sich in den letzten zwei Wochen aufgrund Ihrer Darmerkrankung zornig gefühlt? </div><input type='text' id='FF_117600' name='FF_117600'></div>
					<div class='col'><div class='desc_f'>Ich bin erschöpft</div><input type='text' id='FF_117700' name='FF_117700'></div>
					<div class='col'><div class='desc_f'>Ich fühle mich insgesamt schwach</div><input type='text' id='FF_117800' name='FF_117800'></div>
					<div class='col'><div class='desc_f'>Ich fühle mich lustlos (ausgelaugt)</div><input type='text' id='FF_117900' name='FF_117900'></div>
					<div class='col'><div class='desc_f'>Ich bin müde</div><input type='text' id='FF_118000' name='FF_118000'></div>
					<div class='col'><div class='desc_f'>Es fällt mir schwer, etwas anzufangen, weil ich müde bin</div><input type='text' id='FF_118100' name='FF_118100'></div>
					<div class='col'><div class='desc_f'>Es fällt mir schwer, etwas zu Ende zu führen, weil ich müde bin</div><input type='text' id='FF_118200' name='FF_118200'></div>
					<div class='col'><div class='desc_f'>Ich habe Energie</div><input type='text' id='FF_118300' name='FF_118300'></div>
					<div class='col'><div class='desc_f'>Ich bin in der Lage, meinen gewohnten Aktivitäten nachzugehen (Beruf, Einkaufen, Schule, Freizeit, Sport usw.)</div><input type='text' id='FF_118400' name='FF_118400'></div>
					<div class='col'><div class='desc_f'>Ich habe das Bedürfnis, tagsüber zu schlafen.</div><input type='text' id='FF_118500' name='FF_118500'></div>
					<div class='col'><div class='desc_f'>Ich bin zu müde, um zu essen</div><input type='text' id='FF_118600' name='FF_118600'></div>
					<div class='col'><div class='desc_f'>Ich brauche Hilfe bei meinen gewohnten Aktivitäten (Beruf, Einkaufen, Schule, Freizeit, Sport usw.)</div><input type='text' id='FF_118700' name='FF_118700'></div>
					<div class='col'><div class='desc_f'>Ich bin frustriert weil ich zu müde bin, die Dinge zu tun, die ich machen möchte</div><input type='text' id='FF_118800' name='FF_118800'></div>
					<div class='col'><div class='desc_f'>Ich musste meine sozialen Aktivitäten einschränken, weil ich müde bin. </div><input type='text' id='FF_118900' name='FF_118900'></div>
					<div class='col'><div class='desc_f'>Wie stark war Ihr Stuhldrang (plötzliches oder dringendes Bedürfnis) in den vergangenen 24 Stunden?</div><input type='text' id='FF_119000' name='FF_119000'></div>
					<div class='col'><div class='desc_f'>Anti-Durchfall Mittel</div><input type='text' id='FF_119100' name='FF_119100'></div>
					<div class='col'><div class='desc_f'>Codein Trpf./ Tbl.</div><input type='text' id='FF_119200' name='FF_119200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_119300' name='FF_119300'></div>
					<div class='col'><div class='desc_f'>Imodium®</div><input type='text' id='FF_119400' name='FF_119400'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_119500' name='FF_119500'></div>
					<div class='col'><div class='desc_f'>Lopedium®</div><input type='text' id='FF_119600' name='FF_119600'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_119700' name='FF_119700'></div>
					<div class='col'><div class='desc_f'>Loperamid</div><input type='text' id='FF_119800' name='FF_119800'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_119900' name='FF_119900'></div>
					<div class='col'><div class='desc_f'>Opium Tropfen</div><input type='text' id='FF_120000' name='FF_120000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_120100' name='FF_120100'></div>
					<div class='col'><div class='desc_f'>Paracodin® Trpf.</div><input type='text' id='FF_120200' name='FF_120200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_120300' name='FF_120300'></div>
					<div class='col'><div class='desc_f'>Biologika (z.B. Cimzia®, Entyvio®, Flixabi®, Humira®, Inflectra®, Remicade®, Remsima®, Simponi®, Stelara®, Tysabri®)</div><input type='text' id='FF_120400' name='FF_120400'></div>
					<div class='col'><div class='desc_f'>Adalimumab (z.B. Amgevita®, Hulio®, Humira®, Hyrimoz®, Idacio®, Imraldi®)</div><input type='text' id='FF_120500' name='FF_120500'></div>
					<div class='col'><div class='desc_f'>Amgevita®</div><input type='text' id='FF_120600' name='FF_120600'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_120700' name='FF_120700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_120800' name='FF_120800'></div>
					<div class='col'><div class='desc_f'>Hukyndra</div><input type='text' id='FF_120900' name='FF_120900'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_121000' name='FF_121000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_121100' name='FF_121100'></div>
					<div class='col'><div class='desc_f'>Hulio®</div><input type='text' id='FF_121200' name='FF_121200'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_121300' name='FF_121300'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_121400' name='FF_121400'></div>
					<div class='col'><div class='desc_f'>Humira®</div><input type='text' id='FF_121500' name='FF_121500'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_121600' name='FF_121600'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_121700' name='FF_121700'></div>
					<div class='col'><div class='desc_f'>Hyrimoz®</div><input type='text' id='FF_121800' name='FF_121800'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_121900' name='FF_121900'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_122000' name='FF_122000'></div>
					<div class='col'><div class='desc_f'>Idacio®</div><input type='text' id='FF_122100' name='FF_122100'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_122200' name='FF_122200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_122300' name='FF_122300'></div>
					<div class='col'><div class='desc_f'>Imraldi®</div><input type='text' id='FF_122400' name='FF_122400'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_122500' name='FF_122500'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_122600' name='FF_122600'></div>
					<div class='col'><div class='desc_f'>Yuflyma®</div><input type='text' id='FF_122700' name='FF_122700'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_122800' name='FF_122800'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_122900' name='FF_122900'></div>
					<div class='col'><div class='desc_f'>unbekannt</div><input type='text' id='FF_123000' name='FF_123000'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_123100' name='FF_123100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_123200' name='FF_123200'></div>
					<div class='col'><div class='desc_f'>Infliximab (z.B. Flixabi®, Inflectra®, Remicade®, Remsima®, Zessly®)</div><input type='text' id='FF_123300' name='FF_123300'></div>
					<div class='col'><div class='desc_f'>Flixabi</div><input type='text' id='FF_123400' name='FF_123400'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_123500' name='FF_123500'></div>
					<div class='col'><div class='desc_f'>Dosierung</div><input type='text' id='FF_123600' name='FF_123600'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_123700' name='FF_123700'></div>
					<div class='col'><div class='desc_f'>Inflectra</div><input type='text' id='FF_123800' name='FF_123800'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_123900' name='FF_123900'></div>
					<div class='col'><div class='desc_f'>Dosierung</div><input type='text' id='FF_124000' name='FF_124000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_124100' name='FF_124100'></div>
					<div class='col'><div class='desc_f'>Remicade</div><input type='text' id='FF_124200' name='FF_124200'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_124300' name='FF_124300'></div>
					<div class='col'><div class='desc_f'>Dosierung</div><input type='text' id='FF_124400' name='FF_124400'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_124500' name='FF_124500'></div>
					<div class='col'><div class='desc_f'>Remsima</div><input type='text' id='FF_124600' name='FF_124600'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_124700' name='FF_124700'></div>
					<div class='col'><div class='desc_f'>Dosierung</div><input type='text' id='FF_124800' name='FF_124800'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_124900' name='FF_124900'></div>
					<div class='col'><div class='desc_f'>Remsima als subcutan Spritze</div><input type='text' id='FF_125000' name='FF_125000'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_125100' name='FF_125100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_125200' name='FF_125200'></div>
					<div class='col'><div class='desc_f'>Zessly</div><input type='text' id='FF_125300' name='FF_125300'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_125400' name='FF_125400'></div>
					<div class='col'><div class='desc_f'>Dosierung</div><input type='text' id='FF_125500' name='FF_125500'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_125600' name='FF_125600'></div>
					<div class='col'><div class='desc_f'>unbekannt</div><input type='text' id='FF_125700' name='FF_125700'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_125800' name='FF_125800'></div>
					<div class='col'><div class='desc_f'>Dosierung</div><input type='text' id='FF_125900' name='FF_125900'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_126000' name='FF_126000'></div>
					<div class='col'><div class='desc_f'>Cimzia ®</div><input type='text' id='FF_126100' name='FF_126100'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_126200' name='FF_126200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_126300' name='FF_126300'></div>
					<div class='col'><div class='desc_f'>Entyvio ®</div><input type='text' id='FF_126400' name='FF_126400'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_126500' name='FF_126500'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_126600' name='FF_126600'></div>
					<div class='col'><div class='desc_f'>Omvoh®</div><input type='text' id='FF_126700' name='FF_126700'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_126800' name='FF_126800'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_126900' name='FF_126900'></div>
					<div class='col'><div class='desc_f'>Simponi ®</div><input type='text' id='FF_127000' name='FF_127000'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_127100' name='FF_127100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_127200' name='FF_127200'></div>
					<div class='col'><div class='desc_f'>Skyrizi®</div><input type='text' id='FF_127300' name='FF_127300'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_127400' name='FF_127400'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_127500' name='FF_127500'></div>
					<div class='col'><div class='desc_f'>Stelara ®</div><input type='text' id='FF_127600' name='FF_127600'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_127700' name='FF_127700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_127800' name='FF_127800'></div>
					<div class='col'><div class='desc_f'>Tysabri ®</div><input type='text' id='FF_127900' name='FF_127900'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_128000' name='FF_128000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_128100' name='FF_128100'></div>
					<div class='col'><div class='desc_f'>andere Biologika</div><input type='text' id='FF_128200' name='FF_128200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_128300' name='FF_128300'></div>
					<div class='col'><div class='desc_f'>Budesonid (Budenofalk®, Entocort®, Cortiment®)</div><input type='text' id='FF_128400' name='FF_128400'></div>
					<div class='col'><div class='desc_f'>Budesonid oral (z.B. Budenofalk®, Budenofalk uno®, Cortiment®, Entocort®)</div><input type='text' id='FF_128500' name='FF_128500'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_128600' name='FF_128600'></div>
					<div class='col'><div class='desc_f'>Budesonid rektal (z.B. Budenofalkschaum®, Entocort®-Einläufe)</div><input type='text' id='FF_128700' name='FF_128700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_128800' name='FF_128800'></div>
					<div class='col'><div class='desc_f'>Cortison-Präparate (z.B. Betnesol®, Colifoam®, Decortin®, Prednisolon)</div><input type='text' id='FF_128900' name='FF_128900'></div>
					<div class='col'><div class='desc_f'>Cortisonpräparat oral (z.B. Prednisolon, Decortin® etc.)</div><input type='text' id='FF_129000' name='FF_129000'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_129100' name='FF_129100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_129200' name='FF_129200'></div>
					<div class='col'><div class='desc_f'>Cortisonpräparate rektal (Betnesol Klysmen®, Colifoam Rektalschaum®, Postericort®)</div><input type='text' id='FF_129300' name='FF_129300'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_129400' name='FF_129400'></div>
					<div class='col'><div class='desc_f'>Immunsenker (Azathioprin, Methotrexat, Xeljanz®, Jyseleca®)</div><input type='text' id='FF_129500' name='FF_129500'></div>
					<div class='col'><div class='desc_f'>klassische Immunsenker</div><input type='text' id='FF_129600' name='FF_129600'></div>
					<div class='col'><div class='desc_f'>6-Mercaptopurin (z.B. Puri-Nethol®)</div><input type='text' id='FF_129700' name='FF_129700'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_129800' name='FF_129800'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_129900' name='FF_129900'></div>
					<div class='col'><div class='desc_f'>Azathioprin</div><input type='text' id='FF_130000' name='FF_130000'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_130100' name='FF_130100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_130200' name='FF_130200'></div>
					<div class='col'><div class='desc_f'>Methotrexat</div><input type='text' id='FF_130300' name='FF_130300'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_130400' name='FF_130400'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_130500' name='FF_130500'></div>
					<div class='col'><div class='desc_f'>andere Immunsuppressiva</div><input type='text' id='FF_130600' name='FF_130600'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_130700' name='FF_130700'></div>
					<div class='col'><div class='desc_f'>neuartige Immunsenker</div><input type='text' id='FF_130800' name='FF_130800'></div>
					<div class='col'><div class='desc_f'>Jyseleca ®</div><input type='text' id='FF_130900' name='FF_130900'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_131000' name='FF_131000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_131100' name='FF_131100'></div>
					<div class='col'><div class='desc_f'>Rinvoq®</div><input type='text' id='FF_131200' name='FF_131200'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_131300' name='FF_131300'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_131400' name='FF_131400'></div>
					<div class='col'><div class='desc_f'>Velsipity®</div><input type='text' id='FF_131500' name='FF_131500'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_131600' name='FF_131600'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_131700' name='FF_131700'></div>
					<div class='col'><div class='desc_f'>Xeljanz ®</div><input type='text' id='FF_131800' name='FF_131800'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_131900' name='FF_131900'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_132000' name='FF_132000'></div>
					<div class='col'><div class='desc_f'>Zeposia®</div><input type='text' id='FF_132100' name='FF_132100'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_132200' name='FF_132200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_132300' name='FF_132300'></div>
					<div class='col'><div class='desc_f'>Mesalazine (z.B. Asacol®, Claversal®, Mezavant®, Pentasa®, Salofalk®)</div><input type='text' id='FF_132400' name='FF_132400'></div>
					<div class='col'><div class='desc_f'>Asacol®</div><input type='text' id='FF_132500' name='FF_132500'></div>
					<div class='col'><div class='desc_f'>Asacol 1.600mg</div><input type='text' id='FF_132600' name='FF_132600'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_132700' name='FF_132700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_132800' name='FF_132800'></div>
					<div class='col'><div class='desc_f'>andere Mesalazine (z.B. Claversal®, Mezavant®, Pentasa®, Salofalk®, Sulfasalazin)</div><input type='text' id='FF_132900' name='FF_132900'></div>
					<div class='col'><div class='desc_f'>Mesalazine oral (z.B. Claversal®, Mezavant®, Pentasa®, Salofalk®, Sulfasalazin)</div><input type='text' id='FF_133000' name='FF_133000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_133100' name='FF_133100'></div>
					<div class='col'><div class='desc_f'>Mesalazine rektal</div><input type='text' id='FF_133200' name='FF_133200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_133300' name='FF_133300'></div>
					<div class='col'><div class='desc_f'>andere Medikamente (z.B. Eisentherapie)</div><input type='text' id='FF_133400' name='FF_133400'></div>
					<div class='col'><div class='desc_f'>Eisenpräparate</div><input type='text' id='FF_133500' name='FF_133500'></div>
					<div class='col'><div class='desc_f'>Eisen als Infusion oder Spritze</div><input type='text' id='FF_133600' name='FF_133600'></div>
					<div class='col'><div class='desc_f'>Cosmofer®</div><input type='text' id='FF_133700' name='FF_133700'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_133800' name='FF_133800'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_133900' name='FF_133900'></div>
					<div class='col'><div class='desc_f'>Ferinject®</div><input type='text' id='FF_134000' name='FF_134000'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_134100' name='FF_134100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_134200' name='FF_134200'></div>
					<div class='col'><div class='desc_f'>Ferrlecit®</div><input type='text' id='FF_134300' name='FF_134300'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_134400' name='FF_134400'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_134500' name='FF_134500'></div>
					<div class='col'><div class='desc_f'>Monofer®</div><input type='text' id='FF_134600' name='FF_134600'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_134700' name='FF_134700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_134800' name='FF_134800'></div>
					<div class='col'><div class='desc_f'>Venofer®</div><input type='text' id='FF_134900' name='FF_134900'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_135000' name='FF_135000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_135100' name='FF_135100'></div>
					<div class='col'><div class='desc_f'>unbekannt</div><input type='text' id='FF_135200' name='FF_135200'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_135300' name='FF_135300'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_135400' name='FF_135400'></div>
					<div class='col'><div class='desc_f'>Eisentabletten/-Tropfen</div><input type='text' id='FF_135500' name='FF_135500'></div>
					<div class='col'><div class='desc_f'>Feraccru ®</div><input type='text' id='FF_135600' name='FF_135600'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_135700' name='FF_135700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_135800' name='FF_135800'></div>
					<div class='col'><div class='desc_f'>Ferrosanol ®</div><input type='text' id='FF_135900' name='FF_135900'></div>
					<div class='col'><div class='desc_f'>Einnahmefrequenz</div><input type='text' id='FF_136000' name='FF_136000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_136100' name='FF_136100'></div>
					<div class='col'><div class='desc_f'>Gallensäurebinder</div><input type='text' id='FF_136200' name='FF_136200'></div>
					<div class='col'><div class='desc_f'>Cholestagel ®</div><input type='text' id='FF_136300' name='FF_136300'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_136400' name='FF_136400'></div>
					<div class='col'><div class='desc_f'>Colestyramin</div><input type='text' id='FF_136500' name='FF_136500'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_136600' name='FF_136600'></div>
					<div class='col'><div class='desc_f'>Lipocol ®</div><input type='text' id='FF_136700' name='FF_136700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_136800' name='FF_136800'></div>
					<div class='col'><div class='desc_f'>Magenschutz</div><input type='text' id='FF_136900' name='FF_136900'></div>
					<div class='col'><div class='desc_f'>Omeprazol ®</div><input type='text' id='FF_137000' name='FF_137000'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_137100' name='FF_137100'></div>
					<div class='col'><div class='desc_f'>Pantozol ®</div><input type='text' id='FF_137200' name='FF_137200'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_137300' name='FF_137300'></div>
					<div class='col'><div class='desc_f'>Vitamine</div><input type='text' id='FF_137400' name='FF_137400'></div>
					<div class='col'><div class='desc_f'>Vitamin B12</div><input type='text' id='FF_137500' name='FF_137500'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_137600' name='FF_137600'></div>
					<div class='col'><div class='desc_f'>Vitamin B6</div><input type='text' id='FF_137700' name='FF_137700'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_137800' name='FF_137800'></div>
					<div class='col'><div class='desc_f'>Vitamin D</div><input type='text' id='FF_137900' name='FF_137900'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_138000' name='FF_138000'></div>
					<div class='col'><div class='desc_f'>Vitamin D plus Calcium</div><input type='text' id='FF_138100' name='FF_138100'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_138200' name='FF_138200'></div>
					<div class='col'><div class='desc_f'>Andere Medikamente</div><input type='text' id='FF_138300' name='FF_138300'></div>
					<div class='col'><div class='desc_f'>Seit wann nehmen Sie diese Medikation?</div><input type='text' id='FF_138400' name='FF_138400'></div>
					<div class='col'><div class='desc_f'>Mayo-Score - Gesamt</div><input type='text' id='FF_138500' name='FF_138500'></div>
					<div class='col'><div class='desc_f'>Mayo-Score - Partial</div><input type='text' id='FF_138600' name='FF_138600'></div>
					<div class='col'><div class='desc_f'>Biologika (z.B. Cimzia®, Entyvio®, Flixabi®, Humira®, Inflectra®, Remicade®, Remsima®, Simponi®, Stelara®, Tysabri®)</div><input type='text' id='FF_138700' name='FF_138700'></div>
					<div class='col'><div class='desc_f'>Adalimumab (z.B. Amgevita®, Hulio®, Humira®, Hyrimoz®, Idacio®, Imraldi®)</div><input type='text' id='FF_138800' name='FF_138800'></div>
					<div class='col'><div class='desc_f'>Amgevita®</div><input type='text' id='FF_138900' name='FF_138900'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_139000' name='FF_139000'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_139100' name='FF_139100'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_139200' name='FF_139200'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_139300' name='FF_139300'></div>
					<div class='col'><div class='desc_f'>Hukyndra</div><input type='text' id='FF_139400' name='FF_139400'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_139500' name='FF_139500'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_139600' name='FF_139600'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_139700' name='FF_139700'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_139800' name='FF_139800'></div>
					<div class='col'><div class='desc_f'>Hulio®</div><input type='text' id='FF_139900' name='FF_139900'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_140000' name='FF_140000'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_140100' name='FF_140100'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_140200' name='FF_140200'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_140300' name='FF_140300'></div>
					<div class='col'><div class='desc_f'>Humira®</div><input type='text' id='FF_140400' name='FF_140400'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_140500' name='FF_140500'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_140600' name='FF_140600'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_140700' name='FF_140700'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_140800' name='FF_140800'></div>
					<div class='col'><div class='desc_f'>Hyrimoz®</div><input type='text' id='FF_140900' name='FF_140900'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_141000' name='FF_141000'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_141100' name='FF_141100'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_141200' name='FF_141200'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_141300' name='FF_141300'></div>
					<div class='col'><div class='desc_f'>Idacio®</div><input type='text' id='FF_141400' name='FF_141400'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_141500' name='FF_141500'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_141600' name='FF_141600'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_141700' name='FF_141700'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_141800' name='FF_141800'></div>
					<div class='col'><div class='desc_f'>Imraldi®</div><input type='text' id='FF_141900' name='FF_141900'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_142000' name='FF_142000'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_142100' name='FF_142100'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_142200' name='FF_142200'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_142300' name='FF_142300'></div>
					<div class='col'><div class='desc_f'>Yuflyma®</div><input type='text' id='FF_142400' name='FF_142400'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_142500' name='FF_142500'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_142600' name='FF_142600'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_142700' name='FF_142700'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_142800' name='FF_142800'></div>
					<div class='col'><div class='desc_f'>unbekannt</div><input type='text' id='FF_142900' name='FF_142900'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_143000' name='FF_143000'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_143100' name='FF_143100'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_143200' name='FF_143200'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_143300' name='FF_143300'></div>
					<div class='col'><div class='desc_f'>Infliximab (z.B. Flixabi®, Inflectra®, Remicade®, Remsima®, Zessly®)</div><input type='text' id='FF_143400' name='FF_143400'></div>
					<div class='col'><div class='desc_f'>Flixabi</div><input type='text' id='FF_143500' name='FF_143500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_143600' name='FF_143600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_143700' name='FF_143700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_143800' name='FF_143800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_143900' name='FF_143900'></div>
					<div class='col'><div class='desc_f'>Inflectra</div><input type='text' id='FF_144000' name='FF_144000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_144100' name='FF_144100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_144200' name='FF_144200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_144300' name='FF_144300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_144400' name='FF_144400'></div>
					<div class='col'><div class='desc_f'>Remicade</div><input type='text' id='FF_144500' name='FF_144500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_144600' name='FF_144600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_144700' name='FF_144700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_144800' name='FF_144800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_144900' name='FF_144900'></div>
					<div class='col'><div class='desc_f'>Remsima</div><input type='text' id='FF_145000' name='FF_145000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_145100' name='FF_145100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_145200' name='FF_145200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_145300' name='FF_145300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_145400' name='FF_145400'></div>
					<div class='col'><div class='desc_f'>Remsima als subcutan Spritze</div><input type='text' id='FF_145500' name='FF_145500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_145600' name='FF_145600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_145700' name='FF_145700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_145800' name='FF_145800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_145900' name='FF_145900'></div>
					<div class='col'><div class='desc_f'>Zessly</div><input type='text' id='FF_146000' name='FF_146000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_146100' name='FF_146100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_146200' name='FF_146200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_146300' name='FF_146300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_146400' name='FF_146400'></div>
					<div class='col'><div class='desc_f'>unbekannt</div><input type='text' id='FF_146500' name='FF_146500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_146600' name='FF_146600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_146700' name='FF_146700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_146800' name='FF_146800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_146900' name='FF_146900'></div>
					<div class='col'><div class='desc_f'>Cimzia ®</div><input type='text' id='FF_147000' name='FF_147000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_147100' name='FF_147100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_147200' name='FF_147200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_147300' name='FF_147300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_147400' name='FF_147400'></div>
					<div class='col'><div class='desc_f'>Entyvio ®</div><input type='text' id='FF_147500' name='FF_147500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_147600' name='FF_147600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_147700' name='FF_147700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_147800' name='FF_147800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_147900' name='FF_147900'></div>
					<div class='col'><div class='desc_f'>Omvoh®</div><input type='text' id='FF_148000' name='FF_148000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_148100' name='FF_148100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_148200' name='FF_148200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_148300' name='FF_148300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_148400' name='FF_148400'></div>
					<div class='col'><div class='desc_f'>Simponi ®</div><input type='text' id='FF_148500' name='FF_148500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_148600' name='FF_148600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_148700' name='FF_148700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_148800' name='FF_148800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_148900' name='FF_148900'></div>
					<div class='col'><div class='desc_f'>Skyrizi®</div><input type='text' id='FF_149000' name='FF_149000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_149100' name='FF_149100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_149200' name='FF_149200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_149300' name='FF_149300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_149400' name='FF_149400'></div>
					<div class='col'><div class='desc_f'>Stelara ®</div><input type='text' id='FF_149500' name='FF_149500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_149600' name='FF_149600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_149700' name='FF_149700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_149800' name='FF_149800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_149900' name='FF_149900'></div>
					<div class='col'><div class='desc_f'>Tysabri ®</div><input type='text' id='FF_150000' name='FF_150000'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_150100' name='FF_150100'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_150200' name='FF_150200'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_150300' name='FF_150300'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_150400' name='FF_150400'></div>
					<div class='col'><div class='desc_f'>andere Biologika</div><input type='text' id='FF_150500' name='FF_150500'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_150600' name='FF_150600'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_150700' name='FF_150700'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_150800' name='FF_150800'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_150900' name='FF_150900'></div>
					<div class='col'><div class='desc_f'>Budesonid (Budenofalk®, Entocort®, Cortiment®)</div><input type='text' id='FF_151000' name='FF_151000'></div>
					<div class='col'><div class='desc_f'>Budesonid oral (z.B. Budenofalk®, Budenofalk uno®, Cortiment®, Entocort®)</div><input type='text' id='FF_151100' name='FF_151100'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_151200' name='FF_151200'></div>
					<div class='col'><div class='desc_f'>Budesonid rektal (z.B. Budenofalkschaum®, Entocort®-Einläufe)</div><input type='text' id='FF_151300' name='FF_151300'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_151400' name='FF_151400'></div>
					<div class='col'><div class='desc_f'>Cortison-Präparate (z.B. Betnesol®, Colifoam®, Decortin®, Prednisolon)</div><input type='text' id='FF_151500' name='FF_151500'></div>
					<div class='col'><div class='desc_f'>Cortisonpräparat oral (z.B. Prednisolon, Decortin® etc.)</div><input type='text' id='FF_151600' name='FF_151600'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_151700' name='FF_151700'></div>
					<div class='col'><div class='desc_f'>Cortisonpräparate rektal (Betnesol Klysmen®, Colifoam Rektalschaum®, Postericort®)</div><input type='text' id='FF_151800' name='FF_151800'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_151900' name='FF_151900'></div>
					<div class='col'><div class='desc_f'>Immunsenker (Azathioprin, Methotrexat, Xeljanz®, Jyseleca®)</div><input type='text' id='FF_152000' name='FF_152000'></div>
					<div class='col'><div class='desc_f'>klassische Immunsenker</div><input type='text' id='FF_152100' name='FF_152100'></div>
					<div class='col'><div class='desc_f'>6-Mercaptopurin (z.B. Puri-Nethol®)</div><input type='text' id='FF_152200' name='FF_152200'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_152300' name='FF_152300'></div>
					<div class='col'><div class='desc_f'>Azathioprin</div><input type='text' id='FF_152400' name='FF_152400'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_152500' name='FF_152500'></div>
					<div class='col'><div class='desc_f'>Methotrexat</div><input type='text' id='FF_152600' name='FF_152600'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_152700' name='FF_152700'></div>
					<div class='col'><div class='desc_f'>andere Immunsuppressiva</div><input type='text' id='FF_152800' name='FF_152800'></div>
					<div class='col'><div class='desc_f'>Wie lange haben Sie das Präperat wegen Ihrer CED insgesamt eingenommen (seit Erstdiagnose), bitte addieren Sie alle Tage/Wochen/Jahre und geben die ungefähre Gesamtsumme an.</div><input type='text' id='FF_152900' name='FF_152900'></div>
					<div class='col'><div class='desc_f'>neuartige Immunsenker</div><input type='text' id='FF_153000' name='FF_153000'></div>
					<div class='col'><div class='desc_f'>Jyseleca ®</div><input type='text' id='FF_153100' name='FF_153100'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_153200' name='FF_153200'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_153300' name='FF_153300'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_153400' name='FF_153400'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_153500' name='FF_153500'></div>
					<div class='col'><div class='desc_f'>Rinvoq®</div><input type='text' id='FF_153600' name='FF_153600'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_153700' name='FF_153700'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_153800' name='FF_153800'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_153900' name='FF_153900'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_154000' name='FF_154000'></div>
					<div class='col'><div class='desc_f'>Xeljanz ®</div><input type='text' id='FF_154100' name='FF_154100'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_154200' name='FF_154200'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_154300' name='FF_154300'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_154400' name='FF_154400'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_154500' name='FF_154500'></div>
					<div class='col'><div class='desc_f'>Zeposia®</div><input type='text' id='FF_154600' name='FF_154600'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_154700' name='FF_154700'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_154800' name='FF_154800'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_154900' name='FF_154900'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_155000' name='FF_155000'></div>
					<div class='col'><div class='desc_f'>Mesalazine (z.B. Asacol®, Claversal®, Mezavant®, Pentasa®, Salofalk®)</div><input type='text' id='FF_155100' name='FF_155100'></div>
					<div class='col'><div class='desc_f'>Asacol®</div><input type='text' id='FF_155200' name='FF_155200'></div>
					<div class='col'><div class='desc_f'>Asacol 1.600mg</div><input type='text' id='FF_155300' name='FF_155300'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_155400' name='FF_155400'></div>
					<div class='col'><div class='desc_f'>andere Mesalazine (z.B. Claversal®, Mezavant®, Pentasa®, Salofalk®, Sulfasalazin)</div><input type='text' id='FF_155500' name='FF_155500'></div>
					<div class='col'><div class='desc_f'>Mesalazine oral (z.B. Claversal®, Mezavant®, Pentasa®, Salofalk®, Sulfasalazin)</div><input type='text' id='FF_155600' name='FF_155600'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_155700' name='FF_155700'></div>
					<div class='col'><div class='desc_f'>Mesalazine rektal</div><input type='text' id='FF_155800' name='FF_155800'></div>
					<div class='col'><div class='desc_f'>Seit wann erhalten / erhielten Sie diese Medikation?</div><input type='text' id='FF_155900' name='FF_155900'></div>
					<div class='col'><div class='desc_f'>SES-CD-Score</div><input type='text' id='FF_313700' name='FF_313700'></div>
					<div class='col'><div class='desc_f'>Wurde das Medikament abgesetzt?</div><input type='text' id='FF_313800' name='FF_313800'></div>
					<div class='col'><div class='desc_f'>Wann wurde das Medikament abgesetzt?</div><input type='text' id='FF_313900' name='FF_313900'></div>
					<div class='col'><div class='desc_f'>Was war der Grund für das Absetzen des Medikamentes?</div><input type='text' id='FF_314000' name='FF_314000'></div>
					<div class='col'><div class='desc_f'>Wie oft hatten Sie in den letzten 2 Wochen Stuhlgang?</div><input type='text' id='FF_314100' name='FF_314100'></div>
					<div class='col'><div class='desc_f'>Welche Konsistenz hat Ihr Stuhl überwiegend?</div><input type='text' id='FF_314200' name='FF_314200'></div>
					<div class='col'><div class='desc_f'>Wie gut können Sie den Stuhldrang  spüren/einschätzen?</div><input type='text' id='FF_314300' name='FF_314300'></div>
					<div class='col'><div class='desc_f'>Wie gut können Sie Blähungen, flüssigen oder festen Stuhl unterscheiden?</div><input type='text' id='FF_314400' name='FF_314400'></div>
					<div class='col'><div class='desc_f'>Wie rasch müssen Sie nach dem Stuhldrang zur Toilette?</div><input type='text' id='FF_314500' name='FF_314500'></div>
					<div class='col'><div class='desc_f'>Wie oft finden Sie Stuhl in der Unterwäsche?</div><input type='text' id='FF_314600' name='FF_314600'></div>
					<div class='col'><div class='desc_f'>Wie oft finden Sie Unterwäsche verschmiert? (sog. 'Bremsspuren")</div><input type='text' id='FF_314700' name='FF_314700'></div>
					<div class='col'><div class='desc_f'>Nehmen Sie Medikamente, um den Stuhl einzudicken?</div><input type='text' id='FF_314800' name='FF_314800'></div></creator>
        <input type="submit" value="Speichern">
    </form>

    <?php
        require_once MIQ_ROOT."/modules/form_base/form_end.php"; 
        $file_add_end = str_replace(".php","_add_end.php","./".basename(__FILE__));
        if (file_exists($file_add_end)) include_once($file_add_end);
    ?>

<script>
        // let winbox_id = parent.window.thisbox_elem.id;
        if (window.opener); 
        else try{parent.document.getElementById('<?php echo $opener_num?>_reload').click()} catch(e){};
        get_field_ids('<?php echo MIQ_PATH?>/modules/form_base/');
        eL_uploads();
        eL_upload_info_button();
        eL_input_change();
        eL_radio_uncheck();
        eL_form_submit(); 
    </script>
    



</body>
</html>