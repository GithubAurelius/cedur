<?php

$serverIp = $_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname());
# echo php_uname('n');
# echo $serverIp;
if (preg_match('/^(127\.0\.0\.1|192\.168\.|10\.|172\.(1[6-9]|2[0-9]|3[0-1])\.)/', $serverIp)) 
    $dom_loc = "local";
else
    $dom_loc = "online";


$fcid   = $_REQUEST['fcid'] ?? 0;
$fg     = $_REQUEST['fg'] ?? 0;
$fid    = $_REQUEST['fid'] ?? 0;
if ($fid) $fid  = str_replace('FF_', '', $fid);
$fcont  = $_REQUEST['fcont'] ?? "";
if ($fcont) $fcont = trim($fcont ?? '');


// $fid_backup_base = "C:/xampp/htdocs/cedur/patient_log/";
$fid_backup_base = "/var/www/cedur." . $dom_loc . "/temp/PLOG/";
$today_path = date('Ymd');

$fid_backup_path = $fid_backup_base.trim($today_path ?? '');
if (!is_dir($fid_backup_path)) mkdir($fid_backup_path, 0777, true);

$fid_backup_path = $fid_backup_base.$today_path."/";

$fp = fopen($fid_backup_path.$fcid.'_'.$fid.'.csv', 'a'); // Datei zum Anhängen öffnen
fputcsv($fp, array_values([$fcid,$fg,$fid,$fcont]), ";");
fclose($fp);
echo "{}";