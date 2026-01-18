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
			<fieldset><legend>Überschriften Block 1</legend><fs_cont/>
			</fieldset>
					<div class='col'><div class='desc_f'>Textfeld 1</div><input type='text' id='FF_1' name='FF_1'></div>
					<div class='col'><div class='desc_f'>Eine-Auswahl-Boxen 1</div><input type='radio' id='FF_2_0' name='FF_2' value='Auswahl 1'> Auswahl 1<br><input type='radio' id='FF_2_1' name='FF_2' value='Auswahl 2'> Auswahl 2<br><input type='radio' id='FF_2_2' name='FF_2' value='Auswahl 3'> Auswahl 3<br></div>
					<div class='col'><div class='desc_f'>Textfeld 2</div><input type='text' id='FF_3' name='FF_3'></div>
					<div class='col'><div class='desc_f'>Erweiterbares Textfeld</div><textarea id='FF_4' name='FF_4' rows='3'></textarea></div>
					<div class='col'><div class='desc_f'>Checkbox 1</div><input type='checkbox' id='FF_5' name='FF_5' value='1'></div>
			<fieldset><legend>Überschriften Block 2</legend><fs_cont/>
			</fieldset>
					<div class='col'><div class='desc_f'>Upload-Feld 1</div><div id='src_6'></div><input type='text' id='FF_6' name='FF_6' style='display:none'></div><div id='da_6' class='drop-area' data-drop-area><input type='file' id='FF_6_upl' name='FF_6_upl[]' multiple></div><button id='button_6' type='button'  class='filedict_button'>anzeigen/ ausblenden</button><div id='info_6' class='filedict_info_box' style='display: none;'></div></div>
					<div class='col'><div class='desc_f'>Select Feld</div><select id='FF_7' name='FF_7' onchange='follow_select(this)'><option value=''></option><option value='a'>a</option><option value='b'>b</option><option value='c'>c</option><option value='d'>d</option><option value='what ever'>what ever</option></select></div>
					<div class='col'><div class='desc_f'>Textfeld 5</div><input type='date' id='FF_8' name='FF_8'></div>
					<div class='col'><div class='desc_f'>Textfeld 6</div><input type='text' id='FF_9' name='FF_9'></div>
					<div class='col'><div class='desc_f'>Checkbox 2</div><input type='checkbox' id='FF_10' name='FF_10' value='1'></div>
					<div class='col'><div class='desc_f'>Checkbox 3</div><input type='checkbox' id='FF_11' name='FF_11' value='1'></div>
			<fieldset><legend>Überschriften Block 2</legend><fs_cont/>
			</fieldset>
					<div class='col'><div class='desc_f'>Eine-Auswahl-Boxen 2</div><input type='radio' id='FF_12_0' name='FF_12' value='Auswahl x'> Auswahl x<input type='radio' id='FF_12_1' name='FF_12' value='Auswahl y'> Auswahl y</div>
					<div class='col infotext'>Beliebiger Informationsstext - ruhig ausführlich - auch mit <strong>html-code fett</strong> oder <font style='color:red'>gefärbt</font>.</div></creator>
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