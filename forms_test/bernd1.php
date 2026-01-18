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
			<fieldset><legend>Überschriften Block 1</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Textfeld 1_TOPPPP</div><input type='text' id='F_1' name='F_1'></div>
					<div class='col'><div class='desc_f'>Eine-Auswahl-Boxen 1</div><input type='radio' id='F_2_0' name='F_2' value='Auswahl 1'> Auswahl 1<br><input type='radio' id='F_2_1' name='F_2' value='Auswahl 2'> Auswahl 2<br><input type='radio' id='F_2_2' name='F_2' value='Auswahl 3'> Auswahl 3<br></div>
					<div class='col'><div class='desc_f'>Textfeld 2</div><input type='text' id='F_3' name='F_3'></div>
					<div class='col'><div class='desc_f'>Erweiterbares Textfeld</div><textarea id='F_4' name='F_4' rows='3'></textarea></div>
					<div class='col'><div class='desc_f'>Checkbox 1</div><input type='checkbox' id='F_5' name='F_5' value='1'></div>
				</div>
			</fieldset>
			<fieldset><legend>Überschriften Block 2</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Upload-Feld 1</div><div id='src_6'></div><div id='da_6' class='drop-area' data-drop-area><input type='file' id='F_6' name='F_6[]' multiple></div><button id='button_6' type='button'  class='filedict_button'>anzeigen</button><div id='info_6' class='filedict_info_box' style='display: none;'></div></div>
					<div class='col'><div class='desc_f'>Select Feld</div><select id='F_7' name='F_7'><option value=''></option><option value='a'>a</option><option value='b'>b</option><option value='c'>c</option><option value='d'>d</option><option value='what ever'>what ever</option></select></div>
					<div class='col'><div class='desc_f'>Textfeld 5</div><input type='date' id='F_8' name='F_8'></div>
					<div class='col'><div class='desc_f'>Textfeld 9</div><input type='text' id='F_9' name='F_9'></div>
					<div class='col'><div class='desc_f'>Checkbox 2</div><input type='checkbox' id='F_10' name='F_10' value='1'></div>
					<div class='col'><div class='desc_f'>Checkbox 3</div><input type='checkbox' id='F_11' name='F_11' value='1'></div>
				</div>
			</fieldset>
			<fieldset><legend>Überschriften Block 2</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Eine-Auswahl-Boxen 2</div><input type='radio' id='F_12_0' name='F_12' value='Auswahl x'> Auswahl x<input type='radio' id='F_12_1' name='F_12' value='Auswahl y'> Auswahl y</div>
					<div class='col infotext'>Beliebiger Informationsstext - ruhig ausführlich - auch mit <strong>html-code fett</strong> oder <font style='color:red'>gefärbt</font>.</div>
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