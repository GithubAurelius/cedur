<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <script src="fd_trigger_fetch.js"></script>
</head>


<?php

require 'config_connections_local.php';



function get_remote_email($url){
    $patienten_email_remote = "F_01: E-Mail nicht verfügbar"; 
    try {
        $jsonString = @file_get_contents($url);
        if ($jsonString !== false) {
            $data = json_decode($jsonString, true);
            if (json_last_error() === JSON_ERROR_NONE && isset($data['message'])) {
                $patienten_email_remote = $data['message'];
            } else {
                error_log("JSON-Fehler oder Feld fehlt: " . json_last_error_msg());
            }
        } else {
            error_log("Dateilesefehler!");
        }

    } catch (Throwable $e) { // fängt auch Fehler in PHP 7/8 sicher ab
        error_log("Fehler beim Abrufen: " . $e->getMessage());
    }
    return $patienten_email_remote;
}

$patienten_email_remote = get_remote_email(FD_GET_MAIL_LOCAL_TRIGGER . '?pseudonym=1025071613464334');

// Test Senden
$url = FD_SEND_MAIL_ADDRESS_LOCAL_TRIGGER . '?pseudonym=1025071613464334&patienten_email=marc@dueffelmeyer.de';
$response = file_get_contents($url);
echo "TEST senden:".$response."<br>";
 

?>
<body>

    <label for="pseudonym">Patienten-Pseudonym:</label>
    Pseudo:<input type="text" id="pseudonym" value="1025071613464334"> 
    E-Mail-local:<input type="text" id="patienten_email" value="marc@dueffelmeyer.de"> 
    E-Mail-remote:<input type="text" id="patienten_email_remote" value="<?php echo $patienten_email_remote?>"> 

    <button id="demo-save-button">fd_trigger_fetch.js auslösen</button>
    <span id="feedback-icon" style="margin-left: 10px; font-size: 1.2em;"></span>

    

    <iframe id='server' width='100%' height='700px' src=''></iframe>

    <script>
        setTimeout(() => {
            server.src = <?php echo json_encode(MD_SHOW_DATA)?>;
            }, 1000);

        document.getElementById('demo-save-button').addEventListener('click', () => {
            setTimeout(() => {
            server.src = <?php echo json_encode(MD_SHOW_DATA)?>;
            }, 1000);
        })

    const actButton = document.getElementById('demo-save-button');
    actButton.addEventListener('click', () => {
        const pseudonym = document.getElementById('pseudonym')?.value ?? '';
        alert("Sende:" + pseudonym);
        const patienten_email = document.getElementById('patienten_email')?.value ?? '';
        // trigger_post('fd_send_email_address.php', pseudonym, patienten_email);
        trigger_post('fd_trigger_mail.php', actButton, pseudonym, '');
    });


    </script>
    

</body>
</html>