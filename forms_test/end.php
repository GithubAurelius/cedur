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
			<fieldset><legend>Anamnese</legend>
					<div class='col'><div class='desc_f'>Wie groß sind Sie?</div></div><div class='col'><input type='text' id='FF_102600' name='FF_102600'></div>
					<div class='col'><div class='desc_f'>Wieviel wiegen Sie?</div></div><div class='col'><input type='text' id='FF_102700' name='FF_102700'></div>
					<div class='col'><div class='desc_f'>Rauchen Sie?</div></div><div class='col'><select id='FF_102800' name='FF_102800'  onchange='follow_select(this)'><option value=''></option><option value='Ja'>Ja</option><option value='Nein'>Nein</option></select></div>
			<div class='col_100'><div id='B_102800_Ja' class='block' style='display:none'>
					<div class='col infotext'>Welche Tabakprodukte nutzen Sie?</div>
				<div class='row'>
					<div class='col'><table class='table-checkbox_1'><tr><td><input type='checkbox' id='FF_102902' name='FF_102902' value='1'></td><td><div class='desc_f'>E-Zigaretten</div></td></tr></table></div>
					<div class='col'><div class='desc_f'>Wieviele E-Zigaretten pro Tag?</div><input type='text_1' id='FF_103000' name='FF_103000'></div>
				</div>
					<div class='col'><table class='table-checkbox_1'><tr><td><input type='checkbox' id='FF_102904' name='FF_102904' value='1'></td><td><div class='desc_f'>Pfeife</div></td></tr></table></div>
					<div class='col'><div class='desc_f'>Wieviele Pfeifen pro Tag?</div><input type='text_1' id='FF_103100' name='FF_103100'></div>
					<div class='col'><table class='table-checkbox_1'><tr><td><input type='checkbox' id='FF_102906' name='FF_102906' value='1'></td><td><div class='desc_f'>Tabakerhitzer</div></td></tr></table></div>
					<div class='col'><div class='desc_f'>Wieviele Tabakerhitzer pro Tag?</div><input type='text_1' id='FF_103200' name='FF_103200'></div>
					<div class='col'><table class='table-checkbox_1'><tr><td><input type='checkbox' id='FF_102908' name='FF_102908' value='1'></td><td><div class='desc_f'>Zigarillo / Zigarren</div></td></tr></table></div>
					<div class='col'><div class='desc_f'>Wieviele Zigarillos / Zigarren pro Tag?</div><input type='text_1' id='FF_103300' name='FF_103300'></div>
					<div class='col'><table class='table-checkbox_1'><tr><td><input type='checkbox' id='FF_102910' name='FF_102910' value='1'></td><td><div class='desc_f'>Zigaretten</div></td></tr></table></div>
					<div class='col'><div class='desc_f'>Wie viele Zigaretten pro Tag?</div><input type='text_1' id='FF_103400' name='FF_103400'></div>
			</div></div><!--block--></creator>
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