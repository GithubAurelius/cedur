<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once $_SESSION['INI-PATH'];


?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verfolgung</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Grundlegende Typografie und Farben */
        table {
            width: 100%;
            border-collapse: collapse;
            /* Entfernt den doppelten Rahmen zwischen den Zellen */
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #333;
        }

        /* Kopfzeile der Tabelle */
        thead {
            background-color: #f5f5f5;
            border-bottom: 2px solid #ddd;
        }

        th {
            padding: 8px 12px;
            text-align: left;
            font-weight: 600;
            /* Halb-fett für die Kopfzellen */
            color: #555;
        }

        /* Zellen der Tabelle */
        td {
            padding: 5px 8px;
            border-bottom: 1px solid #eee;
        }

        /* Visueller Akzent: Hover-Effekt */
        tbody tr:hover {
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }

        /* Zeilen mit gerader/ungerader Nummerierung für bessere Lesbarkeit */
        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .chart-container {
            width: 300px;
            margin: 20px 0;
            font-family: sans-serif;
        }

        .bar-row {
            margin-bottom: 10px;
        }

        .label {
            font-size: 12px;
            margin-bottom: 2px;
        }

        .bar-bg {
            background: #eee;
            width: 100%;
            height: 20px;
            border-radius: 3px;
            overflow: hidden;
        }

        .bar-fill {
            background: #2196F3;
            height: 100%;
            transition: width 0.5s;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            color: white;
            font-size: 10px;
            padding-right: 5px;
        }
    </style>
</head>

<body>
    <?php


    $querstr = "SELECT fcid, fid, fcont FROM forms_10000 WHERE fid=10000002 OR fid=10000010";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $user_a = get_fcid_a($res_a);

    $pat_a = [];
    foreach ($user_a as $fcid => $fid_a) {
        $pat_a[$fid_a[10000010]] = [];
        $pat_a[$fid_a[10000010]]['name'] = $fid_a[10000002];
    }
    // echo "<pre>"; echo print_r($group2name_a); echo "</pre>";

    // Patienten holen
    $querstr = "SELECT LEFT(fcid, 6) AS yearmonthcount, usergroup, COUNT(*) AS patcount FROM forms_10003 WHERE usergroup > 0 AND usergroup < 98 AND fid = 20 GROUP BY yearmonthcount, usergroup ORDER BY yearmonthcount DESC";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    # echo "<pre>"; echo print_r($res_a); echo "</pre>";
    foreach ($res_a as $key => $val) $pat_a[$val['usergroup']]['pat_count_m'][$val['yearmonthcount']] = $val['patcount'];

    $querstr = "SELECT LEFT(fcid, 4) AS yearcount, usergroup, COUNT(*) AS patcount FROM forms_10003 WHERE usergroup > 0 AND usergroup < 98 AND fid = 20 GROUP BY yearcount, usergroup ORDER BY yearcount DESC";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    # echo "<pre>"; echo print_r($res_a); echo "</pre>";
    foreach ($res_a as $key => $val) $pat_a[$val['usergroup']]['pat_count_y'][$val['yearcount']] = $val['patcount'];
    # echo "<pre>"; echo print_r($pat_a); echo "</pre>";

    echo "<h2>Rekrutierung nach Jahr</h2>";
    $data = [];
    foreach ($pat_a as $usergroup => $count_a) {
        $pat_count_y = $count_a['pat_count_y'] ?? [];
        echo "<table border = 1>";
        echo "<tr><th colspan='2' align='center'><b>" . $count_a['name'] . "</b></th></tr>";
        echo "<tr><th style='width:50%'>Jahr</th><th>Tag</th></tr>";
        if ($pat_count_y)
            foreach ($pat_count_y as $year => $count) {
                echo "<tr><td>" . $year . "</td><td>" . $count . "</td></tr>";
                $pat_a[$usergroup]['pat_sum'] = ($pat_a[$usergroup]['pat_sum'] ?? 0) + $count;
            }
        echo "<tr><th><b>Summen</b></th><th><b>" . ($pat_a[$usergroup]['pat_sum'] ?? ""). "</b></th></tr>";
        $data[$count_a['name']] = $pat_a[$usergroup]['pat_sum'] ?? 0;
        echo "</table><br>";
    }

    // $data = [
    //     "MD" => 15,
    //     "MB" => 28,
    //     "SH" => 10,
    //     "MB/SH" => 42
    // ];

    // 1. Maximalwert finden, um die Balken proportional zu berechnen (100% entspricht dem höchsten Wert)
    $max = max($data);


    echo "<div class='chart-container'>";
    foreach ($data as $name => $value) {
        $width = ($value / $max) * 100;
        echo "<div class='bar-row'>
                <div class='label'>" . htmlspecialchars($name) . " (" . $value . ")</div>
                <div class='bar-bg'>
                    <div class='bar-fill' style='width:" . $width . "%;'>" . $value . "</div>
                </div>
            </div>";
    }
    echo "</div>";

    echo "<hr><br><h2>Rekrutierung neue Patienten nach Monat/Jahr ab  2025-08</h2>";
    $data = [];
    foreach ($pat_a as $usergroup => $count_a) {
        $pat_count_m = $count_a['pat_count_m'] ?? [];
        echo "<table border = 1>";
        echo "<tr><th colspan='2' align='center'><b>" . $count_a['name'] . "</b></th></tr>";
        echo "<tr><th style='width:50%'>Jahr/Monat</th><th>Tag</th></tr>";
        if ($pat_count_m)
            foreach ($pat_count_m as $year => $count) {
                if ($year > 202507) {
                    echo "<tr><td>" . $year . "</td><td>" . $count . "</td></tr>";
                    $pat_a[$usergroup]['pat_sub_sum'] = ($pat_a[$usergroup]['pat_sub_sum'] ?? 0) + $count;
                }
            }
        echo "<tr><th><b>Summen</b></th><th><b>" . ($pat_a[$usergroup]['pat_sub_sum'] ?? 0) . "</b></th></tr>";
        $data[$count_a['name']] = $pat_a[$usergroup]['pat_sub_sum'] ?? 0;
        echo "</table><br>";
    }
    echo "<div class='chart-container'>";
    foreach ($data as $name => $value) {
        $width = ($value / $max) * 100;
        echo "<div class='bar-row'>
                <div class='label'>" . htmlspecialchars($name) . " (" . $value . ")</div>
                <div class='bar-bg'>
                    <div class='bar-fill' style='width:" . $width . "%;'>" . $value . "</div>
                </div>
            </div>";
    }
    echo "</div>";


    // Visiten holen
    $querstr = "SELECT LEFT(fcid, 6) AS yearmonthcount, usergroup, COUNT(*) AS patcount FROM forms_10010 WHERE usergroup > 0 AND usergroup < 98 AND fid = 20 GROUP BY yearmonthcount, usergroup ORDER BY yearmonthcount DESC";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    # echo "<pre>"; echo print_r($res_a); echo "</pre>";
    foreach ($res_a as $key => $val) $pat_a[$val['usergroup']]['pat_count_m'][$val['yearmonthcount']] = $val['patcount'];


    echo "<hr><br><h2>Angelegte Visten nach Monat/Jahr ab  2025-08</h2>";
    $data = [];
    foreach ($pat_a as $usergroup => $count_a) {
        $pat_count_m = $count_a['pat_count_m'] ?? [];
        echo "<table border = 1>";
        echo "<tr><th colspan='2' align='center'><b>" . $count_a['name'] . "</b></th></tr>";
        echo "<tr><th style='width:50%'>Jahr/Monat</th><th>Tag</th></tr>";
        if ($pat_count_m)
            foreach ($pat_count_m as $year => $count) {
                if ($year > 202507) {
                    echo "<tr><td>" . substr((string)$year, 0, 4) . "-" . substr((string)$year, 4, 2) . "</td><td>" . $count . "</td></tr>";
                    $pat_a[$usergroup]['visdata_sum'] = ($pat_a[$usergroup]['visdata_sum'] ?? 0) + $count;
                }
            }
        echo "<tr><th><b>Summen</b></th><th><b>" . ($pat_a[$usergroup]['visdata_sum'] ?? 0) . "</b></th></tr>";
        $data[$count_a['name']] = $pat_a[$usergroup]['visdata_sum'] ?? 0;
        echo "</table><br>";
    }
    echo "<div class='chart-container'>";
    foreach ($data as $name => $value) {
        $width = ($value / $max) * 100;
        echo "<div class='bar-row'>
                <div class='label'>" . htmlspecialchars($name) . " (" . $value . ")</div>
                <div class='bar-bg'>
                    <div class='bar-fill' style='width:" . $width . "%;'>" . $value . "</div>
                </div>
            </div>";
    }
    echo "</div>";


    // Medikationen holen
    $querstr = "SELECT LEFT(fcid, 6) AS yearmonthcount, usergroup, COUNT(*) AS patcount FROM forms_10020 WHERE usergroup > 0 AND usergroup < 98 AND fid = 20 GROUP BY yearmonthcount, usergroup ORDER BY yearmonthcount DESC";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_ASSOC);
    # echo "<pre>"; echo print_r($res_a); echo "</pre>";
    foreach ($res_a as $key => $val) $pat_a[$val['usergroup']]['pat_count_m'][$val['yearmonthcount']] = $val['patcount'];


    echo "<hr><br><h2>Erfasste Medikaktionen nach Monat/Jahr ab  2025-08</h2>";
    $data = [];
    foreach ($pat_a as $usergroup => $count_a) {
        $pat_count_m = $count_a['pat_count_m'] ?? [];
        echo "<table border = 1>";
        echo "<tr><th colspan='2' align='center'><b>" . $count_a['name'] . "</b></th></tr>";
        echo "<tr><th style='width:50%'>Jahr/Monat</th><th>Tag</th></tr>";
        foreach ($pat_count_m as $year => $count) {
            if ($year > 202507) {
                echo "<tr><td>" . substr((string)$year, 0, 4) . "-" . substr((string)$year, 4, 2) . "</td><td>" . $count . "</td></tr>";
                $pat_a[$usergroup]['med_sum'] = ($pat_a[$usergroup]['med_sum'] ?? 0) + $count;
            }
        }
        echo "<tr><th><b>Summen</b></th><th><b>" . ($pat_a[$usergroup]['med_sum'] ?? 0) . "</b></th></tr>";
        $data[$count_a['name']] = $pat_a[$usergroup]['med_sum'] ?? 0;
        echo "</table><br>";
    }
    echo "<div class='chart-container'>";
    foreach ($data as $name => $value) {
        $width = ($value / $max) * 100;
        echo "<div class='bar-row'>
                <div class='label'>" . htmlspecialchars($name) . " (" . $value . ")</div>
                <div class='bar-bg'>
                    <div class='bar-fill' style='width:" . $width . "%;'>" . $value . "</div>
                </div>
            </div>";
    }
    echo "</div>";


    // $querstr = "SELECT fcid,COUNT(*) AS contents FROM forms_10010 WHERE usergroup=1 AND fcid>= 2025081900000000 GROUP BY fcid ORDER BY fcid DESC";
    // $stmt = $db->prepare($querstr);
    // $stmt->execute();
    // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // // echo "<pre>"; echo print_r($res); echo "</pre>";

    // $count_a = [];
    // $sum_count =  0;
    // $count_valid_a = [];
    // $sum_valid =  0;
    // foreach ($res as $fcid_a) {
    //     $fcid_str = (string) $fcid_a['fcid'];
    //     $year  = substr($fcid_str, 0, 4);
    //     $month = substr($fcid_str, 4, 2);
    //     $day   = substr($fcid_str, 6, 2);
    //     $count_a[$year][$month][$day] = ($count_a[$year][$month][$day] ?? 0) + 1;
    //     if ($fcid_a['contents'] > 50) $count_valid_a[$year][$month][$day] = ($count_valid_a[$year][$month][$day] ?? 0) + 1;
    // }

    // echo "<table border = 1>";
    // echo "<tr><th>Jahr</th><th>Monat</th><th>Tag</th><th>Angelegte Visiten</th><th>Valide Patientendokumentation</th></tr>";
    // foreach ($count_a as $year => $month_a)
    //     foreach ($month_a as $month => $day_a)
    //         foreach ($day_a as $day => $count) {
    //             $sum_count =  $sum_count + ($count_a[$year][$month][$day] ?? 0);
    //             $sum_valid = $sum_valid + ($count_valid_a[$year][$month][$day] ?? 0);
    //             echo "<tr><td>" . $year . "</td><td>" . $month . "</td><td>" . $day . "</td><td>" . $count . "</td><td>" . ($count_valid_a[$year][$month][$day] ?? 0). "</td></tr>";
    //         }
    // echo "<tr><th><b>Summen</b></th><th></th><th></th><th><b>".$sum_count."</b></th><th><b>".$sum_valid."</b></th></tr>";
    // echo "</table>";



    ?>
</body>


</html>