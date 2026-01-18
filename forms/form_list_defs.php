<?php
# Abwärtskompatibilität


$desc_a['F_10'] = 'Owner';
$desc_a['F_20'] = 'Group';
$desc_a['F_90'] = 'PID';
$desc_a['F_93'] = 'VID';
$desc_a['F_94'] = 'BASE';
$desc_a['F_fcid'] = 'FCID';

$data_def_a['desc_a']['F_10'] = 'Owner';
$data_def_a['desc_a']['F_20'] = 'Group';
$data_def_a['desc_a']['F_90'] = 'PID';
$data_def_a['desc_a']['F_93'] = 'VID';
$data_def_a['desc_a']['F_94'] = 'BASE';
$data_def_a['desc_a']['F_fcid'] = 'FCID';

if (($data_def_a['fg'] ?? "") == 10003){ 
    $data_def_a['desc_a']['F_10005020'] = 'Befragung (letzte)';
    $data_def_a['desc_a']['F_92'] = 'Cedur-Nr.';
    $data_def_a['desc_a']['F_95'] = 'Diagnose';
}

if (($form ?? "") == 'Patient')  {
    $show_cols_a = explode(',','fcid,F_10,F_20,F_91,F_92,F_95,F_96,F_10003020,F_10005020');
    // $sql_add = " AND fid in (102000,103700,110905,104800,115700,115800,116000)";
 
    $desc_a['F_10005020'] = 'Befragung (letzte)';
    $desc_a['F_92'] = 'Cedur-Nr.';
    $desc_a['F_95'] = 'Diagnose';
    unset($desc_a['F_101']);
    unset($desc_a['F_102']);
    unset($desc_a['F_99921']);
    unset($desc_a['F_99922']);
    unset($desc_a['F_10003050']);

    if (!isset($_SESSION['rl']['Aurelius'])) {
        unset($desc_a['fcid']);
        unset($desc_a['m_uid']);
        unset($desc_a['F_20']);
        unset($desc_a['F_20']);
        unset($desc_a['F_10']);
        unset($desc_a['F_90']);
        unset($desc_a['F_93']);
    }
}

if (($form ?? "")=='Visite') $show_cols_a = explode(',','fcid,F_10,F_20,F_90,F_10005020');
if (($view ?? "")=='' && ($form ?? "") =='Patientenfragebogen') {
    $show_cols_a = explode(',','fcid,F_10,F_20,F_90,F_91,F_92,F_93,F_94,F_95,F_96,F_100');
    $slq_add = " AND fid in(10,20,90,91,92,93,94,95,96,100)";
}
if (($form ?? "") =='Medikation') $show_cols_a = explode(',','fcid,F_10020021,F_10020020,F_10020040,F_10020080,F_10020050,F_10020060,F_10020070');
if (($form ?? "") =='Nebenwirkung') $show_cols_a = explode(',','fcid,F_10050020,F_10050040,F_10050050,F_10050070,F_10050075,F_10050080,F_10050090,F_10050100,F_10050110,F_10050120,F_10050130,F_10050140,F_10050150,F_10050160,F_10050170,F_10050180');


?>