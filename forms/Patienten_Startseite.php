<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$ini_path = $_SESSION['INI-PATH'] ?? "";

if ($ini_path && isset($_SESSION['m_uid'])) require_once $ini_path;
else {
    echo file_get_contents('logout.php');
    exit;
}


if ($_POST) {
    $read_confirm = $_POST['read_confirm'] ?? 0;
    if ($read_confirm) {
        $stmt = $db->prepare("UPDATE user_miq SET consent = 1 WHERE master_uid = ?");
        $stmt->execute([$_SESSION['m_uid']]);
    }
}

$stmt = $db->prepare("SELECT consent FROM user_miq WHERE master_uid = ?");
$stmt->execute([$_SESSION['m_uid']]);
$consent = $stmt->fetchColumn();

?>

<?php if (!$consent) { ?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Datenerfassung</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f7f6;
                color: #333;
                margin: 20px;
                padding: 0;
            }


            .consent-container {
                width: 95%;
                padding: 30px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            /* Stil für den iFrame/PDF-Container */
            #pdf-frame {
                width: 100%;
                height: 400px;
                /* Feste Höhe, damit Scrollen nötig ist */
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-bottom: 20px;
            }

            /* Checkbox und Button-Bereich */
            .controls {
                margin-top: 10px;
                padding-top: 15px;
                border-top: 1px solid #eee;
            }

            /* Deaktivierte Buttons hervorheben */
            #submit-button:disabled {
                background-color: #ccc;
                cursor: not-allowed;
                box-shadow: none;
            }
        </style>
    </head>

    <body>
        <div class="consent-container">
            <center>
                <h1>Kenntnisnahme bestätigen</h1>

                <iframe
                    id="pdf-frame"
                    src="../forms/info/251003_EW_CEDUR_V2_0.pdf"
                    title="Einverständniserklärung"
                    scrolling="yes"
                    width='100%'></iframe>

                <form id="consent-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="controls">

                        <label>
                            <input type="checkbox" id="read-confirm" name="read_confirm">
                            Ich habe die Einverständniserklärung vollständig gelesen.
                        </label>

                        <button type="submit" id="submit-button">
                            Einwilligen und Bestätigen
                        </button>
                    </div>
                </form>
            </center>
        </div>

        <script>
            const pdfFrame = document.getElementById('pdf-frame');
            const readConfirmCheckbox = document.getElementById('read-confirm');
            const submitButton = document.getElementById('submit-button');

            // Zustandsvariablen
            let isScrolledToBottom = false;
            let isChecked = false;

            // Funktion, die den Button-Zustand prüft
            function updateSubmitButton() {
                if (isScrolledToBottom && isChecked) {
                    // submitButton.disabled = false;
                } else {
                    // submitButton.disabled = true;
                }
            }

            // --- Event Listener für das Scrollen (Komplexer Teil) ---

            // Beim Laden des iFrames warten, bis der Inhalt zugänglich ist
            pdfFrame.onload = function() {
                try {
                    // Zugriff auf das iFrame-Dokument (funktioniert nur bei gleicher Domain!)
                    const iframeDocument = pdfFrame.contentDocument || pdfFrame.contentWindow.document;
                    const scrollableElement = iframeDocument.documentElement; // HTML-Element des iFrames

                    // Füge Scroll-Listener hinzu
                    scrollableElement.addEventListener('scroll', function() {
                        // Überprüfen, ob das Ende erreicht wurde:
                        // (Scrollhöhe + sichtbare Höhe >= gesamte scrollbare Höhe)
                        const isAtBottom =
                            (scrollableElement.scrollTop + scrollableElement.clientHeight) >=
                            scrollableElement.scrollHeight;

                        if (isAtBottom && !isScrolledToBottom) {
                            isScrolledToBottom = true;
                            // Haken freischalten, sobald das Ende erreicht ist
                            readConfirmCheckbox.disabled = false;
                            console.log("Ende erreicht. Checkbox freigeschaltet.");
                            updateSubmitButton();
                        }
                    });
                } catch (e) {
                    console.warn("Konnte nicht auf iFrame-Inhalt zugreifen. Stellen Sie sicher, dass das PDF auf derselben Domain liegt.");
                    // Fallback: Checkbox und Button direkt freischalten, falls Zugriff fehlschlägt.
                    readConfirmCheckbox.disabled = false;
                }
            };

            // --- Event Listener für die Checkbox ---

            readConfirmCheckbox.addEventListener('change', function() {
                isChecked = readConfirmCheckbox.checked;
                updateSubmitButton();
            });
        </script>

    <?php
    exit;
} ?>


    <?php

    function doc_after_maxDays($number, $maxDays = 3)
    {
        $dateString = substr((string)$number, 0, 8);
        $date = DateTime::createFromFormat('Ymd', $dateString);
        if (!$date) {
            return 0;
        }
        $today = new DateTime();
        $diff = $today->diff($date)->days;
        if ($date >= $today) {
            return 0;
        }
        // echo " (Date: " . $date->format('Y-m-d') . " | Today: " . $today->format('Y-m-d') ." DIFF:" . $diff . ") => ";
        return ($diff >= $maxDays) ? 1 : 0;
    }

    function build_simple_table($kontakte_a, $hidden_field_a)
    {
        $tbl_str = "";

        if (!empty($kontakte_a)) {
            $tbl_str .= "<table border='1' cellpadding='6' cellspacing='0'>";
            $tbl_str .=  "<tr style='background-color:#f0f0f0;'>";
            foreach (array_keys($kontakte_a[0]) as $colName) {
                if (!in_array($colName, $hidden_field_a))
                    $tbl_str .=  "<th>" . htmlspecialchars($colName) . "</th>";
            }
            $tbl_str .=  "</tr>";
            foreach ($kontakte_a as $row) {
                $tbl_str .=  "<tr>";
                foreach ($row as $field => $cell) {
                    if (!in_array($field, $hidden_field_a))
                        $tbl_str .=  "<td>" . htmlspecialchars($cell) . "</td>";
                }
                $tbl_str .=  "</tr>";
            }
            $tbl_str .=  "</table>";
        } else {
            $tbl_str =  "Keine Daten vorhanden.";
        }
        return $tbl_str;
    }

    function build_visite_table($visit_a, $first_visit, $hidden_field_a)
    {
        $tbl_str = "";
        $visits_active_count = 0;

        $visit_header_a = ['fcid', 'Visite(n) zur Dokumentation']; 
        $tbl_str .= "<table id='visiten' border='1' cellpadding='6' cellspacing='0'>";
        $tbl_str .=  "<tr style='background-color:#f0f0f0;'>";
        foreach ($visit_header_a as $colName) {
            $colName = str_replace('10005020', 'Visite(n) zur Dokumentation', $colName);
            if (!in_array($colName, $hidden_field_a))
                $tbl_str .=  "<th>" . $colName . "</th>";
        }
        $tbl_str .=  "<th>Aktion</th></tr>";

        if (!empty($visit_a)) {
            foreach ($visit_a as $row) {
                $fcid = $row['fcid'];
                if (!doc_after_maxDays($fcid)) {
                    $tbl_str .=  "<tr>";
                    foreach ($row as $field => $cell) {
                        if (!in_array($field, $hidden_field_a))
                            $tbl_str .=  "<td>" . $cell . "</td>";
                    }
                    $tbl_str .=  "<td><button class='buttons' onclick=\"window.open('" . $_SERVER['PHP_SELF'] . "?fcid=" . $fcid . "&vdate=" . $cell . "&first_visit=" . $first_visit . "')\">Dokumentation fortsetzen</button></td></tr>"; // document.location.href=
                    $visits_active_count = $visits_active_count + 1;
                }
            }
            
        } 
        if (!$visits_active_count) $tbl_str .=  "<tr><td></td><td>Neue Dokumentation</td><td><button class='buttons' onclick=\"window.open('" . $_SERVER['PHP_SELF'] . "?fcid=-1&vdate=" . date('d.m.Y') . "&first_visit=" . $first_visit . "')\">jetzt dokumentieren</button></td></tr>"; // document.location.href=
            
        $tbl_str .=  "</table>";
        return $tbl_str;
    }


    $fcid_pat = $_SESSION['m_uid'];
    $fcid_visite = $_REQUEST['fcid'] ?? "";
    $date_visite = $_REQUEST['vdate'] ?? "";
    $first_visit = $_REQUEST['first_visit'] ?? "";
    $date_visite_eng = "";
    if ($date_visite) {
        $date_obj = DateTime::createFromFormat('d.m.Y', $date_visite);
        $date_visite_eng = $date_obj->format('Y-m-d');
    }
    $pat_a = [];
    $pat_data_a = get_query_data($db, 'forms_10003', "fcid=$fcid_pat");
    foreach ($pat_data_a as $num => $fcont_a) {
        $pat_a[$fcont_a['fid']] = $fcont_a['fcont'];
    }

    if (!$fcid_visite) { ?>
        <!DOCTYPE html>
        <html lang="de">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Datenerfassung</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f7f6;
                    color: #333;
                    margin: 20px;
                    padding: 0;
                }

                .header-buttons {
                    margin-bottom: 25px;
                    display: flex;
                    gap: 10px;
                }

                .header-nav {
                    display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    width: 100%;
                    padding: 10px 0;
                    border-bottom: 1px solid #ddd;
                    margin-bottom: 25px;
                }

                .button-group {
                    display: flex;
                    gap: 15px;
                }

                .nav-button {
                    padding: 10px 15px;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                    font-weight: bold;
                    transition: all 0.2s ease-in-out;
                }

                .primary-button {
                    background-color: #dc3545;
                    color: white;
                }

                .primary-button:hover {
                    background-color: #c82333;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                }

                .secondary-button {
                    background-color: #6c757d;
                    color: white;
                }

                .secondary-button:hover {
                    background-color: #5a6268;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                }

                button {
                    padding: 10px 15px;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                    font-weight: bold;
                    transition: background-color 0.3s ease;
                }

                .header-buttons button {
                    background-color: #007bff;
                    color: white;
                }

                .header-buttons button:hover {
                    background-color: #0056b3;
                }

                .buttons {
                    width: 280px;
                    background-color: #28a745;
                    color: white;
                }

                .buttons:hover {
                    background-color: #1e7e34;
                }

                #visiten {
                    width: 100%;
                    border-collapse: collapse;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    background-color: white;
                    border-radius: 8px;
                    overflow: hidden;
                }

                #visiten th,
                #visiten td {
                    padding: 12px 15px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }

                #visiten thead th {
                    background-color: #343a40;
                    color: white;
                    font-weight: bold;
                    text-transform: uppercase;
                }

                #visiten tbody tr:nth-child(even) {
                    background-color: #f8f9fa;
                }

                #visiten tbody tr:hover {
                    background-color: #e9ecef;
                }

                .placeholder-box {
                    margin-top: 40px;
                    padding: 25px;
                    border: 2px dashed #ffc107;
                    background-color: #fffbe6;
                    border-radius: 8px;
                    text-align: center;
                    font-size: 1.1em;
                    color: #856404;
                    font-style: italic;
                }

                .hidden-column-active th:first-child,
                .hidden-column-active td:first-child {
                    display: none;
                }
            </style>
        </head>

        <body>
        <?php
        echo '<nav class="header-nav">';
        echo '<div><strong>CEDUR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . $pat_a['92'] . '</strong></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<div class="button-group">';
        echo '<button class="nav-button secondary-button" onclick="window.open(\'' . MIQ_PATH . 'modules/change_userdata/change_userdata.php\')">Passwort ändern</button>';
        echo '<button class="nav-button primary-button" onclick="document.location.href=\'../login.php\'">Abmelden</button>';
        echo '</div>';
        echo '</nav>';

        $cid_a = [];
        $all_visits_a = get_query_data($db, 'forms_10005', "fid=90 AND fcont='$fcid_pat'");
        foreach ($all_visits_a as $num => $visite_a) {
            // foreach ($visite_a as $col => $val) echo "<br>$col => $val";
            $cid_a[] = $visite_a["fcid"];
        }


        if (count($cid_a) > 0) $first_visit = 0;
        else $first_visit = 1;
        // echo "<br>is first visit: ".$first_visit;

        $cid_str = "";
        if ($cid_a) $cid_str = " AND fcid IN (" . implode(',', $cid_a) . ")";
        // echo "<br>cid_str: ".$cid_str;

        // echo $cid_str;
        $all_visits_a = [];
        $form_data_a = [];
        if ($cid_str) {
            $all_visits_a = get_query_data($db, 'forms_10005', "fid=10005020" . $cid_str . "  ORDER BY fcid DESC");
            // echo "<pre>"; echo print_r($all_visits_a); echo "</pre>";

            foreach ($all_visits_a as $num => $visite_a) {
                //echo "<pre>"; echo print_r($visite_a); echo "</pre>"; 
                // foreach ($visite_a as $col => $val) echo "<br>$col => $val";
                $temp_date = trim($visite_a["fcont"] ?? '');
                $date_obj = DateTime::createFromFormat('Y-m-d', $temp_date);
                $temp_date_deutsch = $date_obj->format('d.m.Y');
                $form_data_a[$num]['fcid'] = $visite_a["fcid"];
                $form_data_a[$num][$visite_a["fid"]] = $temp_date_deutsch;
            }
        }

        // echo build_simple_table($all_visits_a, ['fid','muid','usergroup','mts']);
        echo build_visite_table($form_data_a, $first_visit, []);

        echo "<div class='placeholder-box'>In diesem Bereich werden demnächst Informationen zu Ihrem Verlauf bereitgestellt.</div>";
    } else {
        $fcid_pat = $_SESSION['m_uid'];
        $user_a = get_query_data($db, 'user_miq', "master_uid=$fcid_pat")[0] ?? [];
        if (empty($user_a['last_pwchange'])) echo "User muss Passwort initial setzen!";


        // echo show_a($user_a);
        // echo show_a($pat_a);




        // echo show_a($_SESSION);

        if ($fcid_visite == -1) {
            $fcid_visite = (int) (date('YmdHis') . substr(microtime(true), 11, 2));
            $sql_str = "INSERT INTO `forms_10005` (`fcid`, `fid`, `muid`, `fcont`, `usergroup`, `mts`) VALUES
                (" . $fcid_visite . ", 10, " . $fcid_pat . ", '" . $fcid_pat . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 20, " . $fcid_pat . ", '" . $user_a['usergroup'] . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 90, " . $fcid_pat . ", '" . $fcid_pat . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 91, " . $fcid_pat . ", '" . $pat_a[91] . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 92, " . $fcid_pat . ", '" . $pat_a[92] . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 93, " . $fcid_pat . ", '" . $fcid_visite . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 94, " . $fcid_pat . ", '" . $first_visit . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 95, " . $fcid_pat . ", '" . $pat_a[95] . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 96, " . $fcid_pat . ", '" . $pat_a[96] . "', ".$user_a['usergroup'].", '" . $ts . "'),
                (" . $fcid_visite . ", 10005020, " . $fcid_pat . ", '" . $date_visite_eng . "', ".$user_a['usergroup'].", '" . $ts . "');";
            $stmt = $db->prepare($sql_str);
            $res = $stmt->execute();
        }

        // echo $fcid_visite." ".$date_visite; exit;
        $ts = date("Y-m-d H:i:s");
        $_SESSION['temp_fg']   = $_SESSION['rl']['doc_only'];
        $_SESSION['temp_fcid'] = $fcid_visite;
        $_SESSION['overwrite_navigation'] = 1;  // IMPORTANT for forms_start
        $_SESSION['temp_params_a']['pid']           = $fcid_pat;
        $_SESSION['temp_params_a']['praxis_pid']    = $pat_a[91];
        $_SESSION['temp_params_a']['ext_fcid']      = $pat_a[92];
        $_SESSION['temp_params_a']['diagnosis']     = $pat_a[95];
        $_SESSION['temp_params_a']['geschlecht']    = $pat_a[96];
        $_SESSION['temp_params_a']['first_visit']   = $first_visit;
        $_SESSION['temp_params_a']['visite']        = $fcid_visite;
        $_SESSION['temp_params_a']['visite_datum']  = $date_visite_eng;
        $_SESSION['temp_params_a']['direct'] = 1;
        $_SESSION['temp_params_a']['user_group'] = $user_a['usergroup'];

        header("Location: Patientenfragebogen.php?a_log=1");
    }

    // echo "<br>PAT:" . $fcid_pat . " VISITE: " . $fcid_visite . " VDATE: " . $date_visite_eng . " FIRST VISIT: " . $first_visit;





        ?>
        <script>
            function spalteAusblendenPerKlasse(tableId) {
                const table = document.getElementById(tableId);

                // Fügt die Klasse hinzu, die die erste Spalte ausblendet
                if (table) {
                    table.classList.add('hidden-column-active');
                }
            }

            // Aufruf der Funktion
            spalteAusblendenPerKlasse('visiten');
        </script>
        </body>

        </html>