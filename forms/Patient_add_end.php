<?php
// important for prevent password change on save patient data

if ($_POST) {

    function gen_random_str($type, $laenge = 10)
    {
        if ($type == 'passwd') $zeichen = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789@#$='; // O0Il-_!+%&*^()
        else if ($type == 'user_num') $zeichen = '0123456789';
        $ran_str = '';
        $max = strlen($zeichen) - 1;
        for ($i = 0; $i < $laenge; $i++) {
            $ran_str .= $zeichen[random_int(0, $max)];
        }
        return $ran_str;
    }

    $ext_fcid   = $_POST['FF_' . $_SESSION['param']['ext_fcid']] ?? "";

    if (!isset($user_data_a['login_name']) && $ext_fcid) {
        try {
            $passwd = gen_random_str('passwd', 10);
            $now = date("Y-m-d H:i:s");
            if (DB == 'MariaDB') {
                $query_str = "
                        INSERT INTO user_miq 
                            (master_uid, login_name, login_pass, rights, mts, usergroup)
                        VALUES
                            (:master_uid, :login_name, :login_pass, :rights, :mts, :usergroup)
                        ON DUPLICATE KEY UPDATE
                            login_name = VALUES(login_name),
                            login_pass = VALUES(login_pass),
                            rights     = VALUES(rights),
                            mts        = VALUES(mts),
                            usergroup  = VALUES(usergroup);";
            }
            $stmt = $db->prepare($query_str);
            $stmt->bindValue(":login_name", $ext_fcid);
            $stmt->bindValue(":login_pass", $passwd);
            $stmt->bindValue(":rights", 'user,doc_only-10010');
            $stmt->bindValue(":usergroup", $_SESSION['user_group']);
            $stmt->bindValue(":master_uid", $fcid);
            $stmt->bindValue(":mts", $now);
            $stmt->execute();
            // echo "<script>alert('User-Zugang angelegt')</script>";
        } catch (Exception $e) {
            echo "<script>alert('User-Zugang nicht angelegt! Bitte informieren Sie den IT-Service!')</script>";
            // echo "<h2 style='color:red;text-align:center;'>Fehler beim Anlegen des Online-Zugangs für den Patienten!</h2>";
        }
    }
}
?>
<script>
    const pid = <?php echo json_encode($fcid) ?>;

    let param_a = {};
    // 'sqlstr'     => "F_{$_SESSION['param']['pid']} = '{$fcid}'",         
    param_a = <?php
                echo json_encode([
                    'pid'        => $fcid,
                    'praxis_pid' => $form_data_a[$_SESSION['param']['praxis_pid']] ?? "",
                    'ext_fcid'   => $form_data_a[$_SESSION['param']['ext_fcid']] ?? "",
                    'geschlecht' => $form_data_a[$_SESSION['param']['geschlecht']] ?? "",
                    'diagnosis'  => $form_data_a[$_SESSION['param']['diagnosis']] ?? ""
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>;
    const param_str = JSON.stringify(param_a);
    const cedur_field = document.getElementById('FF_92');
    cedur_field.readOnly = true;
    cedur_field.style.backgroundColor = 'lightgray';

    const sourceDiv = document.getElementById('patient_tabs');
    const targetDiv = document.getElementById('idonly_10003050');
    const allTabElements = document.querySelectorAll('[data-tab]');
    const edit_patient_button = document.getElementById('edit_patient_button');

    const data_complete = <?php echo json_encode($data_complete ?? 0) ?>



    const email_field = document.getElementById('FF_10003040');
    if (email_field) {
        remember_mail = email_field.value;
        email_field.value = <?php echo json_encode($patienten_email_remote ?? "") ?>;
        if (!email_field.value && remember_mail) email_field.value = remember_mail; // TODO: DELETE WENN EMAILS ÜBERTRAGEN DSVGO!
    }


    const div_ext_button = document.getElementById('SH_999467');
    div_ext_button.style.marginTop = '-10px';
    div_ext_button.style.display = 'flex';
    div_ext_button.style.gap = '10px';
    div_ext_button.style.borderRadius = '8px';
    div_ext_button.style.backgroundColor = 'd6d6d6';

    function trigger_post(post_file, saveButton, pseudonym, patienten_email) {
        const feedbackIcon = document.getElementById('feedback-icon');
        // UI auf "Wird geladen" setzen
        if (feedbackIcon) feedbackIcon.textContent = '⏳';
        saveButton.disabled = true; // Button während des Ladevorgangs deaktivieren

        // Daten für den PHP-Post-Request vorbereiten
        const formData = new URLSearchParams();
        formData.append('pseudonym', pseudonym);
        formData.append('patienten_email', patienten_email);
        // Hier könnten weitere Daten hinzugefügt werden, z.B. Token etc.

        // Asynchronen Fetch-Aufruf starten
        fetch(post_file, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData
            })
            .then(response => {
                // HTTP-Fehler (z.B. 404, 500) hier abfangen
                if (!response.ok) {
                    throw new Error(`HTTP Error! Status: ${response.status}`);
                }
                // Versucht, die JSON-Antwort zu parsen
                return response.json();
            })
            .then(data => {
                // JSON-Ergebnis verarbeiten
                if (data.status === 'OK') {
                    if (feedbackIcon) feedbackIcon.textContent = '✅'; // Erfolg
                    // Optional: Tooltip oder Logik für data.message
                    console.log(`✅ Aktion erfolgreich. Meldung: ${data.message}`);
                } else {
                    if (feedbackIcon) feedbackIcon.textContent = '❌'; // Logischer Fehler (z.B. Validierung)
                    console.error('Server-Logikfehler:', data.message);
                }
            })
            .catch(error => {
                // Verbindung/Netzwerkfehler abfangen
                if (feedbackIcon) feedbackIcon.textContent = '❌';
                alert(`Ein kritischer Fehler ist aufgetreten. Der Server konnte nicht kontaktiert werden. (${error.message})`);
                console.error('Fetch-Fehler:', error);
            })
            .finally(() => {
                // UI zurücksetzen
                saveButton.disabled = false;
                // Das ⏳ wird erst am Ende durch ✅ oder ❌ ersetzt
            });
    }

//     Array
// (
//     [pid] => 2025102714532248
//     [praxis_pid] => 6666
//     [ext_fcid] => ZSZ-2581
//     [geschlecht] => weiblich
//     [diagnosis] => Colitis ulcerosa
// )

 // param_str: btoa(encodeURIComponent(param_str))
    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById("new_visit");
        if (btn) {

            btn.addEventListener("click", function() {
                const data = {
                    num: "102",
                    title: "Visite",
                    url: "<?php echo $_SESSION['PROJECT_PATH']; ?>forms/Visite.php?fg=10005&fcid=-1&param_str=" + btoa(encodeURIComponent(param_str))
                };
                window.top.winbox_url(JSON.stringify(data));
            });
        }
    });


    function createActionButton(text, b_id, baseLink, linkSuffix) {
        const button = document.createElement('button');
        button.className = 'save-button-style';
        button.textContent = text;
        button.id = b_id;
        button.addEventListener('click', () => {
            event.preventDefault();
            const finalLink = baseLink + linkSuffix;
            if (!linkSuffix) window.open(finalLink, '_blank');
            // else console.log();
        });
        div_ext_button.appendChild(button);
    }
    createActionButton('🖨️ Zugangsdaten drucken', 'print_it', <?= json_encode(MIQ_PATH . "modules/login_token/login_token.php?key=" . $fcid) ?>, '');


    if (email_field.value) {
        createActionButton('📧 Zugangsmail versenden', 'email_it', '', '&print=1');
        const feedbackIconSpan = document.createElement('span');
        feedbackIconSpan.id = 'feedback-icon';
        feedbackIconSpan.textContent = ''; // Oder ein Emoji/Text, falls gewünscht
        feedbackIconSpan.style.marginLeft = '10px';
        feedbackIconSpan.style.fontSize = '1.2em';
        div_ext_button.appendChild(feedbackIconSpan);

        const api_path = <?php echo json_encode($_SESSION['API_PATH']) ?>;
        const last_mail_info = document.getElementById('FF_33');
        const actButton = document.getElementById('email_it');
        actButton.addEventListener('click', () => {
            event.preventDefault();
            const pseudonym = pid;
            trigger_post('../' + api_path + '/fd_trigger_mail.php', actButton, pseudonym, '');
            last_mail_info.value = get_ts();
            fetchDataAndUpdateForm(pid, 10003, 33, last_mail_info.value);
        });
        const textfeld = document.createElement('span'); // Oder 'div', 'input' etc.
        textfeld.style.fontSize = '12px';
        textfeld.textContent = 'Zuletzt: ' + last_mail_info.value.slice(0, -3);
        div_ext_button.appendChild(textfeld);
    }



    // get box and num
    const parentWinbox = window.top.findParentWinboxDiv(window);
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


    // fieldset switch
    const patient_fieldset = document.getElementById('FS_99921');
    const main_form_submit_button = document.getElementById('main_form_submit_button');
    const main_tab = document.getElementById('main_tab');

    let fieldset_height = 0;
    if (patient_fieldset) {
        const style = window.getComputedStyle(patient_fieldset);
        if (style.display !== "none") {
            fieldset_height = patient_fieldset.offsetHeight + 10;
        }
        const legend = patient_fieldset.querySelector("legend");
        if (legend) {
            legend.remove(); // entfernt das Legend-Element
        }
    }
    const tab_fieldset = document.getElementById('FS_99922');
    if (tab_fieldset) {
        // Legend innerhalb des Fieldsets auswählen
        const legend = tab_fieldset.querySelector("legend");
        if (legend) {
            legend.remove(); // entfernt das Legend-Element
        }
    }

    function show_patient_data(tab_a, this_inner_win_height, fieldset_height) {
        patient_fieldset.style.display = ""; // oder "flex", je nach Layout
        main_form_submit_button.style.display = '';
        main_tab.style.position = "absolute";
        // main_tab.style.top = 0;
        // set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], (this_inner_win_height - 150), fieldset_height)
    }

    function hide_patient_data(tab_a, this_inner_win_height, fieldset_height) {
        patient_fieldset.style.display = "none";
        main_form_submit_button.style.display = 'none';
        main_tab.style.position = "absolute";
        // main_tab.style.top = -30;
        // set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], (this_inner_win_height), fieldset_height)
    }


    // Frame position
    targetDiv.innerHTML = sourceDiv.innerHTML;
    sourceDiv.remove();

    const tab_a = {}
    const base_url = "<?php echo MIQ_PATH ?>modules/listing_form_native/listing_prepare.php";
    var url_params = new URLSearchParams({
        fg: "10005",
        limit: 1000, 
        form: "Visite",
        work_mode: "E-D8",
        num: -1,  // Wichtig, damit keine winbox in list_100xx.php angesprochen wird
        form_name: 'Visite',
        fid_str: '10005020,92,100',
        query_global_str: JSON.stringify([
            ["90", "", pid]
        ]),
        param_str: btoa(encodeURIComponent(param_str))
    });
    tab_a['tab1'] = {};
    tab_a['tab1']['iframe'] = '_visite';
    tab_a['tab1']['url_params'] = url_params.toString();

    
    url_params.set('fg', '10010');
    url_params.set('work_mode', '');
    url_params.set('form', 'Patientenfragebogen');
    url_params.set('form_name', 'Patientenfragebogen');
    url_params.set('fid_str', '110200,110500,110600,110700,111000,111100,110511');
    tab_a['tab5'] = {};
    tab_a['tab5']['iframe'] = '_labor';
    tab_a['tab5']['url_params'] = url_params.toString();

    url_params.set('fid_str', '102300,102200,102600,102700,102705,102800,102815,108500');
    tab_a['tab3'] = {};
    tab_a['tab3']['iframe'] = '_patientenbefragung';
    tab_a['tab3']['url_params'] = url_params.toString();

    url_params.set('fid_str', '102000,103700,110905,104800,115700,115800,116000');
    tab_a['tab4'] = {};
    tab_a['tab4']['iframe'] = '_untersuchung';
    tab_a['tab4']['url_params'] = url_params.toString();


    url_params.set('fid_str', '109001,109002,109003,109004,109005,109007,109008');
    tab_a['tab2'] = {};
    tab_a['tab2']['iframe'] = '_scores';
    tab_a['tab2']['url_params'] = url_params.toString();

    url_params.set('fg', '10020');
    url_params.set('form', 'Medikation');
    url_params.set('form_name', 'Medikation');
    url_params.set('fid_str', '10005020,10020021,10020050,10020020,10020040,10020080,10020060,10020085,10020070');
    url_params.set('query_global_str', JSON.stringify([["90", "", pid], ["10020021", "", '%V%']])); //
    tab_a['tab6'] = {};
    tab_a['tab6']['iframe'] = '_vormedikation';
    tab_a['tab6']['url_params'] = url_params.toString();

   
    url_params.set('fg', '10020');
    url_params.set('form', 'Medikation');
    url_params.set('form_name', 'Medikation');
    url_params.set('fid_str', '10005020,10020021,10020050,10020020,10020040,10020080,10020060,10020085,10020070');
    url_params.set('query_global_str', JSON.stringify([["90", "", pid]]));
    tab_a['tab7'] = {};
    tab_a['tab7']['iframe'] = '_medikation';
    tab_a['tab7']['url_params'] = url_params.toString();  
    
    // url_params.set('fg', '10050');
    // url_params.set('form', 'Nebenwirkung');
    // url_params.set('form_name', 'Nebenwirkung');
    // url_params.set('fid_str', '10050020,10050040,10050050,10050070,10050075,10050080,10050090,10050100,10050110,10050120,10050130,10050140,10050150,10050160,10050170');
    // // url_params_nebenw = url_params.toString();
    // tab_a['tab7'] = {};
    // tab_a['tab7']['iframe'] = '_nebenwirkung';
    // tab_a['tab7']['url_params'] = url_params.toString();

    


    const tabButtons = document.querySelectorAll('.tab-button');

    function set_tab_and_iframe_heigth(base_url, url_params, iframe2set, window_height, p_fieldset) {
        // console.log(this_inner_win_height, height2set, fieldset_height);
        patient_window_height_plus_header = p_fieldset.offsetHeight + 150;
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
            set_tab_and_iframe_heigth(base_url, tab_a[selectedTab]['url_params'], tab_a[selectedTab]['iframe'], this_inner_win_height, patient_fieldset)
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

    if (patient_fieldset && edit_patient_button) {
        edit_patient_button.addEventListener("click", () => {
            // Aktuelles Display prüfen
            const style = window.getComputedStyle(patient_fieldset);
            if (style.display === "none")
                show_patient_data(tab_a, this_inner_win_height, fieldset_height);
            else
                hide_patient_data(tab_a, this_inner_win_height, fieldset_height);
        });
    }

    // für biomarker multiselect
    if (patient_fieldset) {
        patient_fieldset.style.alignItems = 'flex-start';
        patient_fieldset.style.justifyContent = 'flex-start';
    }

    activate_multi_selects();

    // Global functions 
    let background_field_save = 0;
    if (data_complete) {
        hide_patient_data(tab_a, this_inner_win_height, fieldset_height);
    }
    setTimeout(() => { // ausrichten der Fenster abwarten
        set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], this_inner_win_height, patient_fieldset)
    }, 100);

    eL_check_numbers();
    eL_check_required_fields();
    errors = error_a_sum(error_a);
    if (errors) set_message(errors);
    if (<?php echo json_encode($_POST['FF_10'] ?? 0) ?>) set_message(errors);

    // Visual additions and winbox placement
    const wb_width = 2 / 5;
    const wb_height = 0.7;
    const winbox_num = <?= json_decode($num) ?? 999999 ?>;
    //  data_winbox['num'] = window.top.win_boxes2form[data_def_a['form_name']] ?? 555;
    const menue_height = window.top.document.getElementById('main_menue').offsetHeight;
    const outer_wb = window.top.findClosestWinboxFromIframe(window.frameElement);
    outer_wb.winbox.setIcon(window.top.miq_root_path + 'img/person.svg');
    const winbox_height = parent.window.innerHeight - window.top.men_height;
    const wh = winbox_height * wb_height;
    const ww = parent.window.innerWidth * wb_width;
    if (!window.top.win_boxes?.[winbox_num]?.pos) outer_wb.winbox.resize(ww, wh);
    window.addEventListener('pagehide', () => {
        window.top.set_last_winbox_state(winbox_num, outer_wb);
    });


    
</script>


<!-- ❓📊📁📋⚙️➕🖥️ 🖨️📧📬✉️-->