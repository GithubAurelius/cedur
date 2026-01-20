<script src="<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'forms/' ?>Medikation_defs.js?RAND=<?php echo random_bytes(5); ?>"></script>
<script>
    const this_marker = 'F_93|' + <?php echo $form_data_a[$_SESSION['param']['visite']] ?? "" ?>;
    const not_include = <?php echo json_encode($not_include ?? ""); ?>;
    const select1 = document.getElementById('FF_10020020'); // Wirkstoffgruppe
    const select2 = document.getElementById('FF_10020040'); // Medikament
    const select3 = document.getElementById('FF_10020080'); // Dosis/ Schema
    const select4 = document.getElementById('FF_10020085'); // Dosierung

    const savedMedication = <?php echo json_encode($form_data_a['10020040'] ?? ""); ?>;
    const savedDose = <?php echo json_encode($form_data_a['10020080'] ?? ""); ?>;

    function fillSelect(selectEl, values, selectedValue = null) {
        selectEl.innerHTML = '<option value="">Bitte wählen</option>';
        values.forEach(v => {
            if (!v.includes(not_include)) { // Diagnose ist wichtig
                const opt = document.createElement('option');
                opt.value = v;
                opt.textContent = v;
                if (v === selectedValue) opt.selected = true;
                selectEl.appendChild(opt);
            }
        });
    }

    function updateSelect2(savedMed = null, savedDoseVal = null) {
        const group = select1.value;
        const match = val_med_select2_a.find(entry => entry[0] === group);
        const meds = match ? match[1].split('|') : [];

        fillSelect(select2, meds, savedMed);
        updateSelect3(savedDoseVal);
    }

    function updateSelect3(savedDoseVal = null) {
        const med = select2.value.trim();
        if (med.includes("fliximab")) {
            select4.disabled = false;
            select4.required = true;
        } else {
            select4.disabled = true;
            select4.required = false;
        }
        const match = val_med_select3_a.find(entry => entry[0] === med);
        const doses = match ? match[1].split('|') : [];
        fillSelect(select3, doses, savedDoseVal);
    }

    // Events bei Benutzeränderung
    select1.addEventListener('change', () => {
        updateSelect2(null, null);
    });

    select2.addEventListener('change', () => {
        updateSelect3(null);
    });

    // Initiales Füllen basierend auf bereits gesetztem Wirkstoffgruppe
    updateSelect2(savedMedication, savedDose);


    let param_a = {};
    param_a['sqlstr'] = "F_<?php echo $_SESSION['param']['pid'] ?> = '<?php echo $form_data_a[$_SESSION['param']['pid']]; ?>'";
    param_a['pid'] = "<?php echo $form_data_a[$_SESSION['param']['pid']] ?? "" ?>";
    param_a['praxis_pid'] = "<?php echo $form_data_a[$_SESSION['param']['praxis_pid']] ?? "" ?>";
    param_a['ext_fcid'] = "<?php echo $form_data_a[$_SESSION['param']['ext_fcid']] ?? "" ?>";
    param_a['visite'] = "<?php echo $form_data_a[$_SESSION['param']['visite']] ?? "" ?>";
    param_a['geschlecht'] = "<?php echo $form_data_a[$_SESSION['param']['geschlecht']] ?? "" ?>";
    param_a['diagnosis'] = "<?php echo $form_data_a[$_SESSION['param']['diagnosis']] ?? "" ?>";
    param_a['first_visit'] = "<?php echo $form_data_a[$_SESSION['param']['first_visit']] ?? "" ?>";
    const param_str = JSON.stringify(param_a);

    field_in_group_validation('10020060', ['@NOTEMPTY@'], ['10020070'], 'one'); // Absetzung
    compare_dates('FF_10020050', 'FF_10020060', '<=');
    main_form_submit_new_button.style.display = 'inline';
    const submitButton = document.getElementById('main_form_submit_new_button');
    if (submitButton) {
        const submitButton = document.getElementById('main_form_submit_new_button');
        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('param_str').value = btoa(encodeURIComponent(param_str));
            document.main_form.submit();
        });
    }

    // get box and num
    const parentWinbox = window.top.findParentWinboxDiv(parent.window);
    if (parentWinbox) num = parentWinbox.id.split('-')[1];
    // let this_inner_win_height = document.body.clientHeight;
    let this_inner_win_height = parentWinbox.offsetHeight;
    const observer = new ResizeObserver(entries => {
        for (let entry of entries) {
            this_inner_win_height = parseFloat(parentWinbox.style.height); // entry.contentRect.height;
            // console.log("Neue Body-Höhe:", this_inner_win_height);
        }
    });
    observer.observe(document.body); // Body beobachten

    const base_url = "<?php echo MIQ_PATH ?>modules/listing_form_native/listing_prepare.php";
    const sourceDiv = document.getElementById('medication_tabs');
    const targetDiv = document.getElementById('idonly_10003057');
    targetDiv.innerHTML = sourceDiv.innerHTML;
    sourceDiv.remove();

    const tab_a = {}
    url_params = new URLSearchParams({
        fg: "10020",
        limit: 1000,
        form: "Medikation",
        work_mode: "EF-D2",
        num: num,
        form_name: 'Medikation',
        fid_str: '93,10005020,10020021,10020050,10020020,10020040,10020080,10020060,10020085,10020070',
        query_global_str: JSON.stringify([
            ["90", "", param_a['pid']]
        ]),
        param_str: btoa(encodeURIComponent(param_str))
    });

    tab_key = 'tab1';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Medikation';
    tab_a['tab1']['url_params'] = url_params.toString();

    tab_key = 'tab2';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Biologika';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Biologika'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab3';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Immunsenker';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Immunsenker'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab4';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Mesalazin';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Mesalazine'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab5';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Budesonid';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Budesonid'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab6';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Cortison';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Cortison%'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab7';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Diarrhoe';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Anti-Durchfall Mittel%'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab8';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Schmerzmittel';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", 'Schmerzmittel'],
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();

    tab_key = 'tab9';
    tab_a[tab_key] = {};
    tab_a[tab_key]['iframe'] = '_Andere';
    url_params.set('query_global_str', JSON.stringify([
        ["90", "", param_a['pid']],
        ["10020020", "", '%ndere%'],
        
    ]));
    tab_a[tab_key]['url_params'] = url_params.toString();
  
    // ["10020021", "", '!=KE']

    // UPDATE forms_10020 SET fcont = 'KE' WHERE fid=10020021 AND fcid IN (SELECT fcid FROM `forms_10020` WHERE fid = 10020080 AND fcont = 'keine Einnahme');

    const tabButtons = document.querySelectorAll('.tab-button');
    const medication_fieldset = document.getElementById('FS_900202200');
    const tab_fieldset = document.getElementById('FS_99927');
    if (tab_fieldset) {
        // Legend innerhalb des Fieldsets auswählen
        const legend = tab_fieldset.querySelector("legend");
        if (legend) {
            legend.remove(); // entfernt das Legend-Element
        }
    }

    function set_tab_and_iframe_heigth(base_url, url_params, iframe2set, window_height, p_fieldset) {
        // console.log(this_inner_win_height, height2set, fieldset_height);
        patient_window_height_plus_header = p_fieldset.offsetHeight + 290;
        tab_height = window_height - patient_window_height_plus_header;
        tab_fieldset.style.height = tab_height;
        document.getElementById(iframe2set).src = `${base_url}?${url_params}`;
        document.getElementById(iframe2set).style.height = tab_height;
        // console.log(window_height, patient_window_height_plus_header,tab_height);
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const selectedTab = event.target.dataset.tab;
            tabButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            set_tab_and_iframe_heigth(base_url, tab_a[selectedTab]['url_params'], tab_a[selectedTab]['iframe'], this_inner_win_height, medication_fieldset)
            // Optional: Logik zum Anzeigen des richtigen Tab-Inhalts
            // const tabContent = document.querySelector(`#tab-content-${selectedTab}`);
            // if (tabContent) {
            //   // Verstecke alle Tab-Inhalte und zeige nur den gewünschten an.
            // }
        });
    });

    const buttons = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    setTimeout(() => { // ausrichten der Fenster abwarten
        set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], this_inner_win_height, medication_fieldset)
    }, 100);





    const fieldIds = ['FF_10020020', 'FF_10020040', 'FF_10020080', 'FF_10020050', 'FF_10020060', 'FF_10020070'];
    const submitBtn = document.getElementById('main_form_submit_button');
    const makeBlink = () => {
        if (submitBtn && !submitBtn.classList.contains('blink')) {
            submitBtn.classList.add('blink');
            // beepInterval = setInterval(playBeep, 1000);
        }
    };
    fieldIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('change', makeBlink);
        }
    });


    eL_check_numbers();
    eL_check_required_fields();

    const background_field_save = 0;


    const feldIds = [
        10020020,
        10020040,
        10020050,
        10020060,
        10020070,
        10020080,
        10020085
    ];

    feldIds.forEach(id => {
        const sel = document.getElementById("FF_" + id);
        if (!sel) return; // Element existiert nicht

        // Span erstellen (falls noch nicht vorhanden)
        let span = document.getElementById("isp_FF_" + id);
        if (!span) {
            span = document.createElement("span");
            span.id = "isp_FF_" + id;
            span.style.marginRight = "10px";
            span.style.display = "inline-block";
            sel.parentNode.insertBefore(span, sel);
        }
        // PHP-Wert in Span eintragen
        span.textContent = <?= json_encode($form_data_a) ?>[id] || "";
        // Select inline-block setzen, Parent nowrap
        sel.style.display = "inline-block";
        sel.parentNode.style.whiteSpace = "nowrap";
        // Optional: Span beim Ändern aktualisieren
        sel.addEventListener("change", function() {
            span.textContent = sel.tagName === 'SELECT' ? sel.options[sel.selectedIndex].text : sel.value;
        });
    });

    const el = document.getElementById("FS_900202200");

    if (el) {
        // Padding und Margin für das Haupt-Element
        el.style.padding = 0;
        el.style.marginTop = 0;

        // Alle enthaltenen DIVs
        const childDivs = el.querySelectorAll("div");
        childDivs.forEach(div => {
            div.style.padding = "2px";
        });

    }

    // Datumseingabe

    function isValidPartialDate(val) {
        // YYYY
        if (/^\d{4}$/.test(val)) {
            return val >= "1000" && val <= "2999";
        }

        // YYYY-MM
        if (/^\d{4}-\d{2}$/.test(val)) {
            const [y, m] = val.split("-").map(Number);
            return m >= 1 && m <= 12;
        }

        // YYYY-MM-DD
        if (/^\d{4}-\d{2}-\d{2}$/.test(val)) {
            const [y, m, d] = val.split("-").map(Number);
            const maxDay = new Date(y, m, 0).getDate();
            return m >= 1 && m <= 12 && d >= 1 && d <= maxDay;
        }

        return false;
    }

    const input_start = document.getElementById("FF_10020050");
    const input_start_span = document.getElementById("isp_FF_10020050");
    input_start_span.textContent = 'YYYY-MM-DD mit MM,DD optional';
    input_start.placeholder = "Kein '-' eingeben, Bindestrich automatisch ! ";

    input_start.addEventListener("input", function() {
        let v = this.value.replace(/\D/g, "").slice(0, 8);

        if (v.length > 4 && v.length <= 6) {
            v = v.slice(0, 4) + "-" + v.slice(4);
        } else if (v.length > 6) {
            v = v.slice(0, 4) + "-" + v.slice(4, 6) + "-" + v.slice(6);
        }

        this.value = v;
    });

    input_start.addEventListener("blur", function() {
        const v = this.value;
        if (v === "") return;

        if (!isValidPartialDate(v)) {
            alert("Ungültiges Datum!\nErlaubt sind:\nYYYY\nYYYY-MM\nYYYY-MM-DD");
            this.value = ""; // ✅ Feld leeren
        }
    });


    const input_stop = document.getElementById("FF_10020060");
    const input_stop_span = document.getElementById("isp_FF_10020060");
    input_stop_span.textContent = 'YYYY-MM-DD mit MM,DD optional';
    input_stop.placeholder = "Kein '-' eingeben, Bindestrich automatisch !";

    input_stop.addEventListener("input", function() {
        let v = this.value.replace(/\D/g, "").slice(0, 8);

        if (v.length > 4 && v.length <= 6) {
            v = v.slice(0, 4) + "-" + v.slice(4);
        } else if (v.length > 6) {
            v = v.slice(0, 4) + "-" + v.slice(4, 6) + "-" + v.slice(6);
        }

        this.value = v;
    });

    input_stop.addEventListener("blur", function() {
        const v = this.value;
        if (v === "") return;

        if (!isValidPartialDate(v)) {
            alert("Ungültiges Datum!\nErlaubt sind:\nYYYY\nYYYY-MM\nYYYY-MM-DD");
            this.value = ""; // ✅ Feld leeren
        }
    });

</script>