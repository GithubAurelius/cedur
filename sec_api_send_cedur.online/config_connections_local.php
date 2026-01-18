<?php
const CONFIG_PATH = '/etc/config_secret.ini';
$config_array = parse_ini_file(CONFIG_PATH);

foreach ($config_array as $key => $value) {
    // optional: Sicherstellen, dass der Schlüssel gültige Konstanten-Namen sind (z.B. keine Leerzeichen)
    $key_upper = strtoupper($key); 
    // Konstante definieren, wenn sie noch nicht existiert
    if (!defined($key_upper)) {
        define($key_upper, $value);
    }
}
?>
 
