<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verfolgung</title>
    <style>
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
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            /* Halb-fett für die Kopfzellen */
            color: #555;
        }

        /* Zellen der Tabelle */
        td {
            padding: 10px 15px;
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
    </style>
</head>
<body>
    <?php
    session_start();
    require_once $_SESSION['INI-PATH'];
        
    
    $querstr = "SELECT fcid,COUNT(*) AS contents FROM forms_10010 WHERE usergroup=1 AND fcid>= 2025081900000000 GROUP BY fcid ORDER BY fcid DESC";
    $stmt = $db->prepare($querstr);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>"; echo print_r($res); echo "</pre>";

    $count_a = [];
    $sum_count =  0;
    $count_valid_a = [];
    $sum_valid =  0;
    foreach ($res as $fcid_a) {
        $fcid_str = (string) $fcid_a['fcid'];
        $year  = substr($fcid_str, 0, 4);
        $month = substr($fcid_str, 4, 2);
        $day   = substr($fcid_str, 6, 2);
        $count_a[$year][$month][$day] = ($count_a[$year][$month][$day] ?? 0) + 1;
        if ($fcid_a['contents'] > 50) $count_valid_a[$year][$month][$day] = ($count_valid_a[$year][$month][$day] ?? 0) + 1;
    }

    echo "<table border = 1>";
    echo "<tr><th>Jahr</th><th>Monat</th><th>Tag</th><th>Angelegte Visiten</th><th>Valide Patientendokumentation</th></tr>";
    foreach ($count_a as $year => $month_a)
        foreach ($month_a as $month => $day_a)
            foreach ($day_a as $day => $count) {
                $sum_count =  $sum_count + ($count_a[$year][$month][$day] ?? 0);
                $sum_valid = $sum_valid + ($count_valid_a[$year][$month][$day] ?? 0);
                echo "<tr><td>" . $year . "</td><td>" . $month . "</td><td>" . $day . "</td><td>" . $count . "</td><td>" . ($count_valid_a[$year][$month][$day] ?? 0). "</td></tr>";
            }
    echo "<tr><th><b>Summen</b></th><th></th><th></th><th><b>".$sum_count."</b></th><th><b>".$sum_valid."</b></th></tr>";
    echo "</table>";
    


?>
</body>


</html>