<?php
require 'config_connections.php';

if (!file_exists(CONFIG_PATH)) {
    error_log("FATAL ERROR: Secret config file not found.");
    http_response_code(500);
    die(json_encode([
        'status' => 'fatal_error',
        'message' => 'Configuration Error: API secret not found in environment: '.$_SERVER['SCRIPT_FILENAME']
    ]));
}
$config = parse_ini_file(CONFIG_PATH);
// echo "<pre>"; echo print_r($config); echo "</pre>";
if (!isset($config['API_SECRET'])) {
    http_response_code(500);
    die(json_encode(['status' => 'fatal_error', 'message' => 'Configuration Error: API_SECRET not set in config file: '.$_SERVER['SCRIPT_FILENAME']]));
}
$API_SECRET = $config['API_SECRET'];

try {
    $pdo = new PDO('mysql:host=localhost;dbname=' . $config['DB_NAME'], $config['DB_USER'], $config['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'DB Connection failed on MD: '.$_SERVER['SCRIPT_FILENAME']]));
}

$stmt = $pdo->prepare("SELECT * FROM md_kontakte");
$stmt->execute();
$kontakte_a = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>"; echo print_r($kontakte_a); echo "</pre>";


    echo "<style>
            table {
                font-size: 12px;
                border-collapse: collapse;
                width: 100%;
                font-family: sans-serif;
            }
            th, td {
                border: 1px solid #ccc;
                padding: 6px 10px;
            }
            th {
                background: #f4f4f4;
            }
            tr:nth-child(even) {
                background: #fafafa;
            }
            </style>";
    
    function build_simple_table($kontakte_a){
        $tbl_str = "";
        if (!empty($kontakte_a)) {
            $tbl_str .= "<table border='1' cellpadding='6' cellspacing='0'>";
            $tbl_str .=  "<tr style='background-color:#f0f0f0;'>";
            foreach (array_keys($kontakte_a[0]) as $colName) {
                $tbl_str .=  "<th>" . htmlspecialchars($colName) . "</th>";
            }
            $tbl_str .=  "</tr>";
            foreach ($kontakte_a as $row) {
                $tbl_str .=  "<tr>";
                foreach ($row as $cell) {
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
            
echo build_simple_table($kontakte_a);