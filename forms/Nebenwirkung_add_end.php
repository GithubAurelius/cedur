<script src="<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'forms/' ?>Medikation_defs.js?RAND=<?php echo random_bytes(5); ?>"></script>
<script>
    function fillSelect(selectEl, values, selectedValue = null) {
        selectEl.innerHTML = '<option value="">Bitte wählen</option>';
        values.forEach(v => {
            const opt = document.createElement('option');
            opt.value = v;
            opt.textContent = v;
            if (v === selectedValue) opt.selected = true;
            selectEl.appendChild(opt);
        });
    }

    function updateSelect2(saved_NW = null) {
        const group = select1.value;
        const match = val_nw_select2_a.find(entry => entry[0] === group);
        const meds = match ? match[1].split('|') : [];
        fillSelect(select2, meds, saved_NW);
    }

     // Medikament das evtl. an NW beteiligt ist
    const select_med_val = document.getElementById("FF_10050180");
    const med_val = <?php echo json_encode($med_val)?>;          


    const select1 = document.getElementById('FF_10050020');
    const select2 = document.getElementById('FF_10050040');

    const saved_NW = <?php echo json_encode($form_data_a['10050040'] ?? ""); ?>;
    const val_nw_select2_a = [
        ["Allergische Reaktion", "Lupus-like Syndrom|vom Soforttyp unter der Infusion|vom verzögerten Typ (Myalgien bis zu 3 Tage nach der Infusion)|Andere"],
        ["Atemwege", "Dyspnoe|Lungenembolie|Andere"],
        ["Auge", "Grauer Star|Grüner Star|Makulaödem|Andere"],
        ["Gastrointestinal", "Diarrhoen|Erbrechen|Gastritis|Hepatitis|Leberwerterhöhung|Obstipation|Pankreatitis|Übelkeit|Andere"],
        ["Haut- und Anhangsgebilde", "Akne|Akne inversa|Alopezie|Cushinggesicht|Exanthem|Pilzbefall|Striae|paradoxe Psoriasis|psoriasiformes Exanthem|Andere"],
        ["Herz-Kreislaufsystem", "Arrhythmie|Art. Hypertonus|Bradykardie|Herzinsuffizienz|Hypotonie|Myokardiale Ischämie|Tachykardie|Thrombose|Andere"],
        ["Hormonsystem", "Blutzuckererhöhung|Hyperthyreose|Hypothyreose|Andere"],
        ["Hämatologisch", "Anämie|Leukopenie|Leukozytose|Panzytopenie|Thrombopenie|Thrombozytose|Andere"],
        ["Infektionen", "Atemwege|Augen|Gastrointestinal|Gynäkologischer Bereich|HNO Bereich|Haut- und Anhangsgebilde|Herz- Kreislaufsystem|Nervensystem|Niere und ableitende Harnwege|Skelettsystem; Andere|Andere"],
        ["Malignome", "Hautkrebs (Melanom)|Hautkrebs (Basaliom)|Hautkrebs (Spinaliom)|Hautkrebs (Andere)|Lymphom (Hodgkin)|Lymphom (Non-Hodgkin)|Lymphom (Andere)|Blase|Colon|Endokrine Tumore|Gallengänge|HNO Bereich|Hirntumor|Hoden|Leber|Leukämie|Lunge|Magen|Mamma-Ca|Nieren|Ovarien|Pankreas|Prostata|Sarkom|Uterus|Andere"],
        ["Nervensystem", "Cephalgien|Depression|Parästhesien|Psychose|Schlafstörungen|Schwindel|Tremor|Andere"],
        ["Niere", "Kreatininerhöhung|Proteinurie|Andere"],
        ["Skelettsystem", "Gelenkschmerzen|Osteoporose|Andere"],
        ["Stoffwechsel", "Hyperlipidämie|Andere"]
    ];
    
    const med_vals = <?php echo json_encode($med_given_a)?>;
    select1.addEventListener('change', updateSelect2);
    updateSelect2(saved_NW);

    if (med_vals) {
        select_med_val.innerHTML = '<option value="">Bitte wählen</option>';
        med_vals.forEach(value => {
            const option = document.createElement("option");
            option.value = value;
            option.textContent = value;
            select_med_val.appendChild(option);
        });
    }
    if (med_val) select_med_val.value = med_val;

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

    const this_marker = 'F_93|' + <?php echo $form_data_a[$_SESSION['param']['visite']] ?? "" ?>;

    const base_url = "<?php echo MIQ_PATH ?>modules/listing_form_native/listing_prepare.php";
    const url_params = new URLSearchParams({
        nowbox: 1,
        fg: "10050",
        limit: 100,
        form: "Nebenwirkung",
        work_mode: "EF-D5",
        num: 0,
        form_name: 'Nebenwirkung',
        fid_str: '10050020,10050040,10050050,10050070,10050080,10050180',
        param_str: btoa(encodeURIComponent(param_str)),
        query_global_str: JSON.stringify([
            ["90", "", param_a['pid']]
        ]),
        param_str: btoa(encodeURIComponent(param_str))
    });

    const url_params_patient = url_params.toString();
    const work_frame = document.getElementById('<?php echo $fcid ?>_nebenwirkung');
    work_frame.src = `${base_url}?${url_params_patient}`;


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

    const doc_fieldset = document.getElementById('FS_98561');
    const hoehe_doc_fieldset = window.getComputedStyle(doc_fieldset).height
    work_frame_height = parseInt(parent.document.body.scrollHeight) - parseInt(hoehe_doc_fieldset) - 270;
    work_frame.style.height = Math.max(work_frame_height, 120) + 'px';

    eL_check_numbers();
    eL_check_required_fields();


    const fieldIds = ['FF_10050020', 'FF_10050040', 'FF_10050050', 'FF_10050070', 'FF_10050075', 'FF_10050080', 'FF_10050090', 'FF_10050100', 'FF_10050110', 'FF_10050120', 'FF_10050130', 'FF_10050140', 'FF_10050150', 'FF_10050160', 'FF_10050170', 'FF_10050180'];
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


    const background_field_save = 0;
</script>