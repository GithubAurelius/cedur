<?php
session_start();
error_reporting(E_ALL);

function build_menue($men_a)
{   // Aufbau der Hauptmenüführung 
    foreach ($men_a as $men_name => $val_a) {
        $men_name   = $val_a[99902001] ?? "";
        $men_rights = $val_a[99902008] ?? "";
        if (!$men_rights || isset($_SESSION['rl'][$men_rights])) {
            echo "<li><a href='#'>" . $men_name . "</a>";
            echo "<ul class='submenu'>";
            if (isset($val_a['sub'])) {
                $submen_a = $val_a['sub'];
                foreach ($submen_a as $submen_name => $fid_a) {
                    $subrights = $fid_a[99902008] ?? "";
                    if (!$subrights || isset($_SESSION['rl'][$subrights])) {
                        // $position       = $fid_a[99902009] ?? "";
                        // $position_a = [];
                        // if ($position)  $position_a = explode(',',str_replace(' ','',$position));

                        $option         = $fid_a[99902006] ?? '';
                        $function_name  = $fid_a[99902004] ?? "console.log";
                        $call           = $fid_a[99902005] ?? "";
                        $href            = $fid_a[99902007] ?? '#';
                        if ($call) $call = str_replace('@WEBROOT_MIQ@', $_SESSION['WEBROOT'], $call);
                        if ($_SESSION['SERVICE_MAIL'] != "") $href = str_replace("@EMAIL@", $_SESSION['SERVICE_MAIL'], $href);
                        $temp_a = [];
                        $temp_a['num'] = $fid_a[99902012] ?? '';
                        $temp_a['form_name'] = $fid_a[99902010] ?? "";
                        $temp_a['title'] = $fid_a[99902020] ?? ($fid_a[99902020] ?? "No Title");  // winbox title
                        $temp_a['url'] = $call;
                        $temp_a['limit'] = $fid_a[99902015] ?? '';
                        $temp_a['work_mode'] = $fid_a[99902013] ?? '';
                        $temp_a['pos'] = isset($fid_a[99902009]) ? array_map('trim', explode(',', $fid_a[99902009]))  : [];
                        $temp_a['fid_str'] = $fid_a[99902011] ?? "";
                        if ($function_name == 'winbox_url') {
                            $data_json = htmlspecialchars(json_encode($temp_a, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES);
                            echo "<li><a href='#' data-json='" . $data_json . "' onclick=\"winbox_url(this.dataset.json)\">" . $submen_name . "</a></li>";
                        } else {
                            echo "<li><a href='" . $href . "' onClick=" . $function_name . "(" . $call . ")>" . $submen_name . "</a></li>";
                        }
                    }
                }
            }
            echo "</ul></li>";
        }
    }
}

// Login-Prüfung falls index.php aufgerufen wird.
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1) header('Location: login.php');
$ini_path = $_SESSION['INI-PATH'] ?? "";
if ($ini_path) require_once $ini_path;
else {
    echo "<h2>Sie wurden abgemeldet!</h2><h3>Scannen Sie Ihren Code erneut ein ...<br><br>oder melden Sie sich bitte über die <a href='../'>Startseite</a> an, wenn Sie über Zugangsdaten verfügen!</h3>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="de">
<?php
check_path_change(__DIR__); // TODO:5 - Fallback für Installationen ohne Subdomains (nicht getestet)
require '_param_index.php'; // Konfiguration und besodere Events für das Projekt

// Erneute Prüfung der Rechte nach indivdueller Projekt-Event-Konfiguration 
if (!isset($_SESSION['rl'])) header('Location: login.php');

/*********************************************************/
/* Menü und Module einlesen (und Hilfen für Java-Script) */
/*********************************************************/
$data_a = get_fcid_a(get_query_data($db, 'forms_99901', '1'));
$men_temp_a = get_fcid_a(get_query_data($db, 'forms_99902', '1'));
uasort($men_temp_a, function ($a, $b) {
    // Vergleicht die Werte des Schlüssels 99902003 bei aufsteigender Sortierung: $a - $b
    return $a[99902003] <=> $b[99902003]; // <=> ist der "Spaceship"-Operator, der -1, 0 oder 1 zurückgibt.
});
$win_boxes2form = [];
foreach ($data_a as $key => $val_a) {
    if ($val_a[99901003]) $win_boxes2form[$val_a[99901003]] = $val_a[99901002];
}
$men_a = [];
foreach ($men_temp_a as $key => $val_a) {
    $eltern   = trim($val_a[99902000] ?? '');
    $men_name = trim($val_a[99902001] ?? '');
    if (!$eltern) {
        foreach ($val_a as $field => $val) {
            $men_a[$men_name][$field] = $val;
        }
    } else {
        foreach ($val_a as $field => $val) {
            $men_a[$eltern]['sub'][$men_name][$field] = $val;
            if ($field == 99902012 && $val)
                if ($val_a[99902010]) $win_boxes2form[$val] = $val_a[99902010];
        }
    }
}
$win_boxes2form = array_flip($win_boxes2form);
?>

<head>
    <title><?= $_SESSION['PROJECTNAME'] ?? "" ?> - <?= $_SESSION['MIQ'] ?? "" ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>css/index.css">
    <script>
        // Essentials/ global Helper
        var num = 0; // TODO: 3 - num Einsatz muss nachkommentiert und kontrolliert werden
        window.top.men_height = 32; // für regelmäßige Berechnungen von Winboxes, etc.
        // win_boxes2form ermöglicht das dirkete Anprechen und steuern einzelener Winboxes,
        // => die winbox-id wird an das Modul/ Formular gebunden. Z.B. win_boxes2form['test'] = 12
        // win_boxes speichert speichert für jede geöffente Winbox die Eigenschaften (z.B. Position, Größe) 
        window.top.win_boxes = {};
        window.top.win_boxes2form = {};
        window.top.miq_root_path = <?php echo json_encode(MIQ_PATH ?? "") ?>;
        // window.top.window_boxes = {};
        // Wait for menue loaded 
        document.addEventListener("DOMContentLoaded", () => {
            window.top.win_boxes2form = <?php echo json_encode($win_boxes2form); ?>;
        });
    </script>
    <script src="<?php echo MIQ_PATH ?>js/index.js?RAND=<?php echo random_bytes(5) ?>"></script>
</head>

<body>
    <nav id="main_menue">
        <div class="menu-toggle">Menü</div>
        <ul class="main-nav"><?php build_menue($men_a); ?></ul>
    </nav>
    <?php if ($_SESSION['m_uid'] == 1): ?>
        <div class="dashboard-wrapper">
            <div class="dashboard-container">
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h2 class="dashboard-card-title">Statistiken</h2>
                        <p class="dashboard-card-text">Details zu Zahlen oder Kennzahlen.</p>
                    </div>
                    <div class="dashboard-card">
                        <h2 class="dashboard-card-title">Letzte Aktivitäten</h2>
                        <p class="dashboard-card-text">Log-Informationen oder Benutzeraktionen.</p>
                    </div>
                    <div class="dashboard-card">
                        <h2 class="dashboard-card-title">User und System</h2>
                        <p class="dashboard-card-text"><?php require_once MIQ_ROOT_PHP . 'sys_info.php'; ?></p>
                    </div>
                    <?php if ($_SESSION['uid'] == 1 && DEBUG):
                        // Admin-Infos zur Umgebung/ Session 
                    ?>
                        <div class="dashboard-card" style="padding:5px;">
                            <h2 class="dashboard-card-title">Session-Info</h2>
                            <div style="color:silver;max-height: 200px; overflow: auto;scrollbar-color: #888 transparent; scrollbar-width: thin;">
                                <p class="dashboard-card-text">
                                <pre><?php print_r($_SESSION); ?></pre>
                                </p>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class='fixed_logo_box'></div>
    <script>
        // document.getElementById("main_menue").style.setProperty("height", window.top.men_height + "px");
        exit_button();
        eL_show_hide_menue();
        activate_menue();
        <?php if (file_exists('forms/images/main_background.jpg')):
            // Konfiguration individuelles Projekt-Hintergrundbild 
        ?>
            document.documentElement.style.cssText = `
                background-color: transparent;
                background-image: url('forms/images/main_background.jpg');
                background-position: 50% 50%;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
            `;
        <?php endif ?>
    </script>
    <?php
    require_once 'session.php';
    ?>
</body>

</html>