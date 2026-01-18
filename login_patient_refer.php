<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    height: 100vh;
    background: url('forms/images/docu_example.png') no-repeat center/cover; /* nur Demo */
  }

  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6); /* dunkler Schleier */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .overlay-content {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,0.4);
  }

  .overlay-content button {
    padding: 0.75rem 2.5rem;
    font-size: 2rem;
    font-weight: bold;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
  }

  .overlay-content button:hover {
    background: #0056b3;
  }
</style>
</head>
<body>
<?php
$url = $_REQUEST['url'] ?? "";
?>
<div class="overlay">
  <div class="overlay-content">
    <p>Zum Starten der Dokumentation hier klicken <?php echo $url?></p>
    <button onclick="window.location.href='<?php echo $url?>';">
      Starten
    </button>
  </div>
</div>

</body>
</html>
