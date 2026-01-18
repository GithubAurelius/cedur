<?php
session_start();
require_once $_SESSION['INI-PATH'];
require_once MIQ_PATH."/modules/form_base/form_start.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einfaches HTML Formular</title>
    <link rel="stylesheet" href="../../<? echo MIQ?>/css/form_base.css">
    <script src="../../<? echo MIQ?>/modules/form_base/forms.js"></script>
</head>


<body>
    
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" id='main_form' enctype="multipart/form-data">
        <div>
            <h4>
                CID: <?php echo $fcid ?>
                <button type="button" onClick="window.parent.forward_form('fcid', <?php echo $fcid ?>,'Test1')" >Beispiel weiterführendes Formular</button>
                <button type="button" onClick="window.location.href='<?=$_SERVER['PHP_SELF']?>?fg=<?=$fg?>&fcid=' + getCid()" >NEU</button>
            </h4>
            <hr>
            <input type="hidden" id="fcid" name="fcid" value="<?php echo $fcid ?>">
            <input type="hidden" id="fg" name="fg" value="<?php echo $fg ?>">
            <input type="hidden" id="opener_num" name="opener_num" value="<?php echo $opener_num ?>">
        </div>
        <creator>
			<fieldset><legend>Beschreibung</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Kurzbeschreibung</div><input type='text' id='F_110' name='F_110'></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Beschreibung</div><textarea id='F_120' name='F_120' rows='5'></textarea></div>
				</div>
			</fieldset>
			<fieldset><legend>Zusatzangaben</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Verantwortlicher</div><input type='text' id='F_180' name='F_180'></div>
					<div class='col'><div class='desc_f'>Gewerk/ Bereich</div><select id='F_170' name='F_170'><option value=''></option><option value='xxx'>xxx</option><option value='yyy'>yyy</option></select></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Termin</div><input type='date' id='F_140' name='F_140'></div>
					<div class='col'><div class='desc_f'>Status</div><select id='F_130' name='F_130'><option value=''></option><option value='10%'>10%</option><option value='20%'>20%</option><option value='40%'>40%</option><option value='60%'>60%</option><option value='80%'>80%</option><option value='90%'>90%</option><option value='95%'>95%</option></select></div>
					<div class='col'><div class='desc_f'>Kosten</div><input type='text' id='F_160' name='F_160'></div>
					<div class='col'><div class='desc_f'>Raum</div><input type='text' id='F_150' name='F_150'></div>
				</div>
			</fieldset>
			<fieldset><legend>Verfolgung/ Dokumentation</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Kommentar/ Bemerkung</div><textarea id='F_190' name='F_190' rows='3'></textarea></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Files</div><div id='src_5001'></div><div id='da_5001' class='drop-area' data-drop-area><input type='file' id='F_5001' name='F_5001[]' multiple></div><button id='button_5001' type='button'  class='filedict_button'>anzeigen</button><div id='info_5001' class='filedict_info_box' style='display: none;'></div></div>
				</div>
			</fieldset></creator>
        <input type="submit" value="Speichern">
    </form>

    <?php
        require_once MIQ_PATH."/modules/form_base/form_end.php";   
    ?>

    <script>
        try {parent.document.getElementById('<?php echo $opener_num?>_reload').click()} catch (error) {};
        get_field_ids('<?php echo $HTTPROOT.MIQ?>modules/form_base/');
        eL_uploads();
        eL_upload_info_button();
        eL_input_change();
        eL_radio_uncheck();
        eL_form_submit(); 
    </script>
    


    <?php echo debug("",1); ?>
</body>
</html>