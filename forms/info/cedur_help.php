<?php
session_start()
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Fullscreen Iframe</title>
  <style>
    /* Wichtig: html & body müssen 100% Höhe haben und keine Ränder */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    /* iframe füllt das komplette Fenster */
    iframe.fullscreen-iframe {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0;
      display: block;
    }
  </style>
</head>
<body>
  <!-- Src anpassen -->
  <iframe class="fullscreen-iframe" src="<?php echo $_SESSION['WEBROOT'].$_SESSION['PROJECT_PATH']?>forms/info/cedur_help.pdf" title="Vollbild-Iframe" allowfullscreen></iframe>
</body>
</html>
