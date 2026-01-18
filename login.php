<?php
require '_param_login.php';
?>


<!DOCTYPE html>
<html lang="de">
<html>

<head>
    <title><?php echo $_SESSION['PROJECTNAME'] ?> Anmeldeformular</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>css/login.css?RAND=<?php echo random_bytes(5); ?>">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h2>Anmeldung <?php echo $_SESSION['PROJECTNAME'] ?></h2>
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Anmelden</button><br><br><?php echo $message ?>
    </form>

</body>

</html>