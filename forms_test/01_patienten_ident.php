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
			<fieldset><legend>Patientendaten</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>EDV-Nummer</div><input type='text' id='FF_100200' name='FF_100200'></div>
					<div class='col'><div class='desc_f'>Geschlecht</div><input type='text' id='FF_100300' name='FF_100300'></div>
					<div class='col'><div class='desc_f'>Geburtsjahr</div><input type='text' id='FF_100400' name='FF_100400'></div>
				</div>
				<div class='row'>
					<div class='col'><div class='desc_f'>ID</div><input type='text' id='FF_100100' name='FF_100100'></div>
					<div class='col'><div class='desc_f'>Externe ID</div><input type='text' id='FF_100700' name='FF_100700'></div>
					<div class='col'><div class='desc_f'>Test</div><input type='text' id='FF_100500' name='FF_100500'></div>
					<div class='col'><div class='desc_f'>Status</div><input type='text' id='FF_100600' name='FF_100600'></div>
					<div class='col'><div class='desc_f'>Einschluss</div><input type='text' id='FF_100800' name='FF_100800'></div>
				</div>
			<fieldset><legend>Zentrum/ Praxis</legend>
				<div class='row'>
					<div class='col'><div class='desc_f'>Zentrums ID</div><input type='text' id='FF_100900' name='FF_100900'></div>
					<div class='col'><div class='desc_f'>Zentrums Code</div><input type='text' id='FF_101000' name='FF_101000'></div>
					<div class='col'><div class='desc_f'>Zentrums Name</div><input type='text' id='FF_101100' name='FF_101100'></div>
				</div>
			</fieldset></creator>
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