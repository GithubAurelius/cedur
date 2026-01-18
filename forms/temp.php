
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    require_once $_SESSION['INI-PATH'];

    function germanDateToISO($dateStr){
        // to ISO
        // if (substr_count($dateStr, '.') == 2){
        //     $date_a = explode('.',$dateStr);
        //     $dateStr = $date_a[2].'-'.$date_a[1].'-'.$date_a[0];
        // }
        // // complete ISO
        // if (substr_count($dateStr, '.') == 1){
        //     $date_a = explode('.',$dateStr);
        //     $dateStr = $date_a[1].'-'.$date_a[0]; 
        // }
        // if (substr_count($dateStr, '-') == 1) $dateStr = $dateStr.'-15';
        // if (substr_count($dateStr, '-') == 0) if ($dateStr) $dateStr = $dateStr.'-07-01';

        // if (substr_count($dateStr, '-') == 2){
        //     $date_a = explode('-',$dateStr);
        //     $dateStr = $date_a[2].'.'.$date_a[1].'.'.$date_a[0];
        // }

        return $dateStr;
    }

    echo "Start ..."; // 8225 // G630398560

    // EIFU: Eligible - Insufficient Follow-up
    $patient_fcids_wihth_EIFU = "2013080811330300,2013081311193400,2013103109353500,2013111912274600,2014011511573800,2014012109270300,2014080510430900,2015012212085800,2015012610010800,2015052009355300,2015062509454800,2015070607491300,2015112409413400,2016020209001600,2017112108343900,2018011809105800,2018012510114100,2018020109420000,2018021411014000,2019042307254500,2019111909230300,2019112012524600,2020021407220400,2020062409315600,2020082809464100,2020090110283900,2020090808091600,2020112310540700,2020120109173100,2020121712592300,2021010612110100,2021022509293700,2021110411061600,2022030309233600,2022042707482800,2022051010075400,2022062211075100,2023011807490900,2023011810401600,2023012510373900,2023070408463300,2023080108462900,2023081709073000,2023102509290300,2024021212380500,2024030809531600,2024032110303300,2024050707333800,2024052910471200,2024061310173300,2024061708065500,2024061910500600,2024062412200100,2024062513153100,2024070313254500,2024070912554700,2024071007405600,2024071110021600,2024072305524600,2024080910092400,2024081309011400,2024082107594800,2024082807570100,2024090913191600,2024091607505800,2024100710533000,2024110810023400,2024112808552700,2024121014020400,2025011410311800,2025012311373500,2025012808155800,2025012811063500,2025013009331000,2025031312375500,2025031412191300,2025062305443800,2025073106322800";
    $patient_fcids_wihth_EIFU_a = explode(",",$patient_fcids_wihth_EIFU);
    $patient_fcids_wihth_EIFU_a = array_flip($patient_fcids_wihth_EIFU_a);

    
    $querstr = "SELECT fcid FROM forms_10020 WHERE fcont like '%mirik%' ORDER BY fcid";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $med_fcid = [];
    foreach ($res as $i => $temp_a) $med_fcid[] = $temp_a['fcid'];
    $fcid_str = "(" . implode(',', $med_fcid) . ")";

    $querstr = "SELECT fcid,fid,fcont FROM forms_10020 WHERE fcid IN " . $fcid_str. " ORDER BY fcid";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $med_a = [];
    foreach ($res as $i => $temp_a) {
        $med_a[$temp_a['fcid']][$temp_a['fid']] = $temp_a['fcont'];
    }

    $pat_a = [];
    foreach ($med_a as $med_fcid => $temp_a) {
        if (!isset($pat_a[$temp_a[90]])) $pat_a[$temp_a[90]] = [];
        $pat_a[$temp_a[90]]['pid']  = $temp_a[91] ?? "";
        $pat_a[$temp_a[90]]['cedur']  = $temp_a[92] ?? "";
        $pat_a[$temp_a[90]]['diag']  = $temp_a[95] ?? "";
        $pat_a[$temp_a[90]][$med_fcid]['start'] = $temp_a[10020050] ?? "";
        $pat_a[$temp_a[90]][$med_fcid]['stop']  = $temp_a[10020060] ?? "";
    }
    echo count($pat_a)." (EIFU: ".count($patient_fcids_wihth_EIFU_a).")";

    $csv_str = "DB_Pseudonym;Status;Praxis-ID;Cedur-Nr;Diagnose;Start;Stop;Start;Stop;Start;Stop;Start;Stop;Start;Stop;Start;Stop;Start;Stop;Start;Stop;Start;Stop\n";

    foreach ($pat_a as $pat_fcid => $one_pat_a) {
        $temp_str = "";
        foreach ($one_pat_a as $key => $val_a) {
            $pat_str = $pat_fcid . ";" . (isset($patient_fcids_wihth_EIFU_a[$pat_fcid]) ? "eiFU" : "") . ";" . $one_pat_a['pid'] . ";" . $one_pat_a['cedur'] . ";" . $one_pat_a['diag'] . ";";
            if ($key != 'pid' && $key != 'diag'  && $key != 'cedur')
                $temp_str .= germanDateToISO($val_a['start']) . ";" . germanDateToISO($val_a['stop']) . ";";
        }
        $temp_str = $pat_str . $temp_str . "\n";
        echo "<br>".$temp_str;
        $csv_str .= $temp_str;
    }
    echo " done";
    file_put_contents("miri.csv", $csv_str);
    // echo "<pre>"; echo print_r($pat_a); echo "</pre>"; 
    ?>
