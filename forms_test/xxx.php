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
                <button type="button" onClick="window.location.href='<?=$_SERVER['PHP_SELF']?>?fcid=' + getCid()" >NEU</button>
            </h4>
            <hr>
            <input type="hidden" id="fcid" name="fcid" value="<?php echo $fcid ?>">
            <input type="hidden" id="fg" name="fg" value="<?php echo $fg ?>">
            <input type="hidden" id="opener_num" name="opener_num" value="<?php echo $opener_num ?>">
        </div>
        <creator>
			<fieldset><legend>Beschreibung</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Kurzbeschreibung</div><input type='text' id='F_210' name='F_210'></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Files</div><div id='da_5002' class='drop-area' data-drop-area><input type='file' id='F_5002' name='F_5002[]' multiple></div><button id='button_5002' type='button'  class='filedict_button'>anzeigen</button><div id='info_5002' class='filedict_info_box' style='display: none;'></div></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>Files</div><div id='da_5000' class='drop-area' data-drop-area><input type='file' id='F_5000' name='F_5000[]' multiple></div><button id='button_5000' type='button'  class='filedict_button'>anzeigen</button><div id='info_5000' class='filedict_info_box' style='display: none;'></div></div>
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