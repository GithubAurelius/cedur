<script>
    function printIframe(fcid) {
        const iframe = document.getElementById(fcid + "_visite_work");
        if (iframe) {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        } else {
            alert("Iframe nicht gefunden!");
        }
    }

    function show_hide_elem(id, state) {
        const elem = document.getElementById(id);
        if (elem) {
            if (state) elem.style.display = '';
            else elem.style.display = 'none';
        }
    }

    function show_all() {
        show_hide_elem('button_labor', 1);
        show_hide_elem('button_med', 1);
        show_hide_elem('button_ae', 1);
        show_hide_elem('print_button', 1);
    }

    // params
    let param_a = {};
    param_a['pid'] = "<?php echo $form_data_a[$_SESSION['param']['pid']] ?? "" ?>"; // pid could be cid
    param_a['praxis_pid'] = "<?php echo $form_data_a[$_SESSION['param']['praxis_pid']] ?? "" ?>";
    param_a['ext_fcid'] = "<?php echo $form_data_a[$_SESSION['param']['ext_fcid']] ?? "" ?>";
    param_a['geschlecht'] = "<?php echo $form_data_a[$_SESSION['param']['geschlecht']] ?? "" ?>";
    param_a['diagnosis'] = "<?php echo $form_data_a[$_SESSION['param']['diagnosis']] ?? "" ?>";
    param_a['first_visit'] = "<?php echo $form_data_a[$_SESSION['param']['first_visit']] ?? "" ?>";
    param_a['visite'] = "<?php echo $fcid ?? "" ?>";
    param_a['visite_datum'] = "<?php echo $form_data_a[10005020] ?? "" ?>";
    const param_str = JSON.stringify(param_a);

    const posted = <?php echo json_encode(!empty($_POST)); ?>;
    const fcid = <?php echo json_encode($fcid ?? "") ?>;
    const winbox_iframe = getOwnIframeElement();
    const work_frame = document.getElementById(fcid + '_visite_work');
    const form_name = <?php echo json_encode($form_name) ?>;
    const visite_date = document.getElementById('FF_10005020');
    const submit_button = document.getElementById('main_form_submit_button');
    const dashboard = document.getElementById('dashboard_visite');
    const tdSidebar = document.getElementById('<?php echo $fg ?>_td_sidebar');
    const last_visit = <?php echo json_encode($last_visit) ?>;

    if (!<?= $patient_doc_exisits ?>) {
        show_hide_elem('button_labor', 0);
        show_hide_elem('button_med', 0);
        show_hide_elem('button_ae', 0);
        show_hide_elem('print_button', 0);
    }

    if (dashboard && tdSidebar) {
        tdSidebar.appendChild(dashboard);
    }
    if (submit_button) submit_button.style.display = 'none';


    var background_field_save = 1;
    if (visite_date.value) {
        hide_header();
        document.getElementById('main_tab').style.marginTop = '0px';
        background_field_save = 1;
    }

    if (visite_date) {
        visite_date.addEventListener('change', (event) => {
            if (visite_date.value) fetchDataAndUpdateForm(param_a['pid'], 10003, 10005020, event.target.value);
            if (submit_button) submit_button.style.display = 'block';
        });
    }

    if (last_visit) fetchDataAndUpdateForm(param_a['pid'], 10003, 10005020, visite_date.value);



    document.addEventListener('DOMContentLoaded', (event) => {

        try {
            if (background_field_save) background_field_action();
            // console.log('BGS:' + (background_field_save ? 'activated' : 'off'));
        } catch (error) {
            // console.log('background_field_save (INIT):', error);
        }


        function reloadVisiteIframe() {
            const patient_winbox = parent.window.document.getElementById('winbox-21'); // window.top.win_boxes2form['Patienten-Liste']
            const visite_winbox = parent.window.document.getElementById('winbox-22');  // window.top.win_boxes2form['Patient']
            // console.log(patient_winbox);
            if (patient_winbox) {
                const patient_winbox_iframe = patient_winbox.querySelector('iframe');
                const visite_winbox_iframe = visite_winbox.querySelector('iframe');
                setTimeout(() => {
                    try {
                        patient_winbox_iframe.src = patient_winbox_iframe.src;
                        visite_winbox_iframe.src = visite_winbox_iframe.src;
                    } catch (err) {
                        console.error('Fehler beim Neuladen:', err);
                    }
                }, 1000);
            }
        }


        if (<?= $posted ?>) reloadVisiteIframe();


        if (fcid < 2025081900000000) visite_date.readOnly = true;

        if (<?= json_encode($patient_doc_exisits) ?>) {
            visite_date.readOnly = true;
        }

        eL_check_numbers();
        eL_check_required_fields();


        // Visual additions and winbox placement
        const wb_width = 3 / 5;
        const wb_height = 1;
        const winbox_num = <?= json_decode($num) ?? 59595959 ?>;
        const menue_height = window.top.document.getElementById('main_menue').offsetHeight;
        const outer_wb = window.top.findClosestWinboxFromIframe(window.frameElement);
        outer_wb.winbox.setIcon(window.top.miq_root_path + 'img/med_monitor.svg');
        const winbox_height = parent.window.innerHeight - window.top.men_height;
        const wh = winbox_height * wb_height;
        const ww = parent.window.innerWidth * wb_width
        if (!window.top.win_boxes?.[winbox_num]?.pos) {
            outer_wb.winbox.resize(ww, wh);
            outer_wb.winbox.move(parent.window.innerWidth - ww, window.top.men_height);
        }
        window.addEventListener('pagehide', () => {
            window.top.set_last_winbox_state(winbox_num, outer_wb);
        });


        const main_win_height = window.top.innerHeight - menue_height;
        work_frame.style.height = (main_win_height - 160) + 'px';




    });
</script>