<?php




if (!empty($prepare_page)) {
    $data_def_a['desc_a']['F_10'] = 'Owner';
    $data_def_a['desc_a']['F_20'] = 'Group';
    $data_def_a['desc_a']['F_90'] = 'PID';
    $data_def_a['desc_a']['F_93'] = 'VID';
    $data_def_a['desc_a']['F_94'] = 'BASE';
    $data_def_a['desc_a']['F_fcid'] = 'FCID';
    $data_def_a['desc_a']['F_10020020'] = 'Gruppe';
    $data_def_a['desc_a']['F_10020040'] = 'Medikament';
    $data_def_a['desc_a']['F_10020050'] = 'Start';
    $data_def_a['desc_a']['F_10020060'] = 'Stop';
} else {
}

if (count($data_def_a)) {
    # echo "<pre>"; echo print_r($data_def_a['desc_a']); echo "</pre>";
    $to_sort_a = $data_def_a['desc_a'];
    krsort($to_sort_a);
    # $data_def_a['desc_a'] = $to_sort_a;
    # echo "<pre>"; echo print_r($to_sort_a); echo "</pre>";
    $data_def_a['desc_a'] = $to_sort_a;
}

// let err_str = "";
// const labor_keys = ['FF_110200'];
// let hasKey = labor_keys.some(key => {
//     return error_a.hasOwnProperty(key);
// });
// if (hasKey) err_str = 'L'

// const medic_keys = 
// hasKey = medic_keys.some(key => {
//     return error_a.hasOwnProperty(key);
// });
// if (hasKey) err_str = err_str + 'M'


// const nw_keys = ['FF_110905'];
// hasKey = nw_keys.some(key => {
//     return error_a.hasOwnProperty(key);
// });
// if (hasKey) err_str = err_str + 'N'

?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {

        const table = document.getElementById("cases");
        if (!table) return;

        const th = document.getElementById("F_10005020");
        if (!th) { // wichtig für Einfärbung
            console.warn("Vistenspalte F_10005020 nicht gefunden!");
            return;
        }
        // Spaltenindex bestimmen
        const headerRow = th.parentNode;
        const colIndex = Array.from(headerRow.children).indexOf(th);
        if (colIndex === -1) return;
        // Alle Body-Zeilen sammeln
        const rows = table.querySelectorAll("tbody tr");
        // Werte-Gruppen bilden
        const groups = {};
        rows.forEach(row => {
            const value = row.children[colIndex].textContent.trim();
            if (!groups[value]) groups[value] = [];
            groups[value].push(row);
        });
        // Farben definieren
        const colors = ["#eeedeaff", "#d4edda", "#cce5ff", "#f8d7da", "#f6dbf1ff", "#cccbcbff"];
        let colorIndex = 0;
        // Gruppen einfärben (nur Mehrfach-Vorkommen)
        Object.values(groups).forEach(group => {
            // if (group.length < 2) return; // nur markieren wenn mehrfach
            const color = colors[colorIndex % colors.length];
            colorIndex++;
            group.forEach(row => {
                row.style.backgroundColor = color;
            });
        });

        const frame_tabelle = w.querySelector('#cases');
        const visite_cid = parent?.document?.main_form?.FF_93?.value ?? null;

        // Alle Zeilen durchgehen
        const rows_ausblenden = frame_tabelle.querySelectorAll('tr');
        let foundId = null;

        rows_ausblenden.forEach(row => {
            // Alle Zellen der Zeile holen
            const cells = row.querySelectorAll('td');
            cells.forEach(cell => {
                if (cell.textContent.trim() === visite_cid) {
                    foundId = row.id;
                    // console.log(foundId);
                    let tr = document.getElementById(foundId);
                    tr.style.backgroundColor = '#fbff94ff';
                    tr.style.fontWeight = 'bold';
                }
            });
        });

        const th_ausblenden = document.querySelector('th#F_93');
        if (th_ausblenden) {
            const colIndex = th_ausblenden.cellIndex;
            // Alle Zeilen der Tabelle holen
            const table = th_ausblenden.closest('table');
            table.querySelectorAll('tr').forEach(tr => {
                const cells = tr.querySelectorAll('th, td');
                if (cells[colIndex]) {
                    cells[colIndex].style.display = 'none';
                }
            });
        }


        // Doppelclick auslösen zum sortieren
        const element = document.getElementById('F_10005020');
        if (element) {
            const dblclickEvent = new MouseEvent('dblclick', {
                bubbles: true,
                cancelable: true,
                view: window
            });
            element.dispatchEvent(dblclickEvent);
            // console.log("Programmgesteuerter Doppelklick erfolgreich ausgelöst.");
        } else {
            console.error("Element nicht gefunden.");
        }










    });
</script>