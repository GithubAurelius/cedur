<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// test_script.php
header('Content-Type: text/plain; charset=utf-8');

// Pfad zu Ihrem Shell-Skript
$script_path = '/mainData/mdueffelmeyer/MIQ_projects/cedur/py/_export/test.sh';

// Überprüfen, ob das Skript existiert
if (!file_exists($script_path)) {
    die("Fehler: Skript nicht gefunden unter: $script_path");
}

// Überprüfen, ob das Skript ausführbar ist
if (!is_executable($script_path)) {
    // Versuchen, Ausführungsrechte zu setzen
    chmod($script_path, 0755);
}

// Shell-Skript ausführen
echo "Starte Skript: $script_path\n";
echo "================================\n\n";

// Methode 1: Mit shell_exec (einfachste Variante)
$output = shell_exec("bash $script_path 2>&1");
echo "Ausgabe:\n";
echo $output;

// Alternative: Mit exec (für mehr Kontrolle)
/*
exec("bash $script_path 2>&1", $output, $return_code);
echo "Ausgabe:\n";
foreach ($output as $line) {
    echo $line . "\n";
}
echo "\nReturn Code: $return_code";
*/

// Alternative: Mit system (direkte Ausgabe)
/*
echo "Ausgabe:\n";
system("bash $script_path 2>&1", $return_code);
echo "\nReturn Code: $return_code";
*/
?>


