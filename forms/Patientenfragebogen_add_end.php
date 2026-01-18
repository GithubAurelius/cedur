<script src="<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] ?>forms/Patientenfragebogen.js?RAND=<?php echo random_bytes(5); ?>"></script>
<script>
    // console.log('S--------------')



    // Plausibilisation
    function extra_plaus(user_is_patient, first_visit) {

        function op(ids) {
            const op_field = document.getElementById('FF_106900');
            const num = op_field.value.split(' ')[0];
            const y = {};
            const m = {};
            for (let i = 1; i <= num; i++) {
                if (year) {
                    y[i] = document.getElementById(year[i].id + '_year_select');
                    m[i] = document.getElementById(year[i].id + '_month_select');
                    if (year[i].value == '') {
                        year[i].style.backgroundColor = '#fdd6d6';
                        if (y[i]) y[i].style.backgroundColor = '#fdd6d6';
                        if (m[i]) m[i].style.backgroundColor = '#fdd6d6';
                        error_a[year[i].id] = 1;
                    } else {
                        year[i].style.backgroundColor = '';
                        if (y[i]) y[i].style.backgroundColor = '';
                        if (m[i]) m[i].style.backgroundColor = '';
                        error_a[year[i].id] = 0;
                    }
                }
            }
            if (!user_is_patient) {
                for (let i = 1; i <= num; i++) {
                    if (year[i]) {
                        if (year[i].value != '') {
                            if (art[i]) {
                                if (art[i].value === '') {
                                    art[i].style.backgroundColor = '#fdd6d6';
                                    error_a[art[i].id] = 1;
                                } else {
                                    art[i].style.backgroundColor = '';
                                    error_a[art[i].id] = 0;
                                }
                            }
                        } else {
                            art[i].style.backgroundColor = '';
                            error_a[art[i].id] = 0;
                        }
                    }
                }
            }
            errors = error_a_sum(error_a);
            if (errors) set_message(errors);
        }

        function check_off_work() {
            if (job && off_work) {
                if (job.value === 'Angestellt tätig' && off_work.value == '') {
                    off_work_marker.style.backgroundColor = '#fdd6d6';
                    error_a['FF_106200'] = 1;
                } else {
                    off_work_marker.style.backgroundColor = '';
                    error_a['FF_106200'] = 0;
                }
            }
        }

        // Anamnese
        field_in_group_validation('102800', ['Ja'], ['103000', '103100', '103200', '103300', '103400'], 'one'); // smoker
        if (first_visit) field_in_group_validation('102800', ['Nein'], ['102805'], 'all'); // ex-smoker
        field_in_group_validation('102805', ['Ja'], ['102806'], 'all'); // smoker
        field_in_group_validation('102805', ['Ja'], ['102806'], 'all'); // smoker
        field_in_group_validation('106000', ['Angestellt tätig', 'Selbständig tätig'], ['106500', '106600'], 'all'); // occupation
        // occupation-add because of conflicting listeners
        const job = document.getElementById('FF_106000');
        const off_work = document.getElementById('FF_106200');
        const off_work_marker = document.getElementById('cbm_106200');
        if (job) job.addEventListener('change', (event) => {
            if (job.value !== 'Angestellt tätig') error_a['FF_106200'] = 0;
            else check_off_work();
        });
        if (off_work) off_work.addEventListener('change', (event) => {
            check_off_work();
        });

        const food_info = document.getElementById('FF_102815');
        const food_info_multi_select = document.getElementById('mts_102815');
        if (food_info.value == '') {
            food_info_multi_select.style.backgroundColor = "#fdd6d6";
            error_a['FF_102815'] = 1;
        } else
            food_info_multi_select.style.backgroundColor = "";
        food_info_multi_select.addEventListener('change', () => {
            if (food_info.value == '') {
                food_info_multi_select.style.backgroundColor = "#fdd6d6";
                error_a['FF_102815'] = 1;
            } else {
                food_info_multi_select.style.backgroundColor = "";
                error_a['FF_102815'] = 0;
            }
            set_message(error_a_sum(error_a));
        });

        check_off_work();
        // retiredment
        field_in_group_validation('106000', ['Berentet aufgrund CED'], ['106400'], 'all'); // retired 1
        field_in_group_validation('106000', ['Berentet aufgrund anderer Erkrankungen'], ['106100'], 'all'); // retired 2
        field_in_group_validation('106200', ['Ja'], ['106300'], 'all'); // off work due to illness 
        // Schwangerschaft
        // if (first_visit) 
        field_in_group_validation('108500', ['Nein'], ['109100'], 'all'); // pregnacy no 
        field_in_group_validation('109100', ['Ja'], ['109200', '109300'], 'all'); // num of pregnacy
        field_in_group_validation('109300', ['Ja'], ['109400', '110100', '109700', '109500', '109700', '109600', '109800', '109900', '110000'], 'all'); // pregnacy complication 
        field_in_group_validation('108500', ['Ja'], ['108600', '108700', '108800', '108900'], 'all'); // pregnacy yes
        field_in_group_validation('108900', ['Ja'], ['109000'], 'all'); // former pregnacy
        // family disposition
        // if (first_visit) 
        field_in_group_validation('105000', ['Ja'], ['105100', '105200', '105400', '105500', '105600', '105700', '105800', '105900'], 'one', 'Ja'); // familiary dispsition
        // if (first_visit) 
        field_in_group_validation('105200', ['Ja'], ['105300'], 'one'); // twins
        // misc
        field_in_group_validation('102400', ['Ja'], ['102500'], 'all'); // hospital
        // if (first_visit) 
        field_in_group_validation('111200', ['Ja'], ['111301', '115500'], 'one'); // misc medical conditions
        // if (first_visit) 
        field_in_group_validation('115500', ['Ja'], ['115501'], 'one'); // medical conditions
        // date comparison first symptoms to diagnosis
        // if (first_visit) 
        compare_dates('FF_102300', 'FF_102200', '<=');

        // diagnoses only medics
        if (!user_is_patient) {
            field_in_group_validation('95', ['Morbus Crohn'], ['101902', '101904', '101906', '101908', '101910'], 'one'); // localization
            field_in_group_validation('104800', ['Ja'], ['104900', '104910'], 'one'); // stenosis
            field_in_group_validation('104200', ['Ja'], ['104300', '104400'], 'one'); // fistels
        }

        // op's in the past
        const art = {};
        let ids = [107200, 107500, 107800, 108100, 108400];
        ids.forEach((id, index) => {
            let element = document.getElementById('FF_' + id);
            if (element) {
                art[index + 1] = element;
                element.addEventListener('change', op);
            }
        });
        const year = {};
        const date_year = {};
        const date_month = {};
        ids = [107100, 107400, 107700, 108000, 108300];
        ids.forEach((id, index) => {
            let element = document.getElementById('FF_' + id);
            if (element) {
                year[index + 1] = element;
                element.addEventListener('change', op);
            }
            element = document.getElementById('FF_' + id + '_year_select');
            if (element) {
                date_year[index + 1] = element;
                element.addEventListener('change', op);
            }
            element = document.getElementById('FF_' + id + '_month_select');
            if (element) {
                date_month[index + 1] = element;
                element.addEventListener('change', op);
            }
        });
        op_field.addEventListener('change', () => {
            op(ids);
        });
        op(ids);

    }

    var error_premed = 0;
    let param_a = {};



    try {

        param_a['sqlstr'] = <?php echo json_encode("F_{$_SESSION['param']['pid']} = '{$form_data_a[$_SESSION['param']['pid']]}'"); ?>;
        param_a['pid'] = <?php echo json_encode($form_data_a[$_SESSION['param']['pid']] ?? ""); ?>;
        param_a['praxis_pid'] = <?php echo json_encode($form_data_a[$_SESSION['param']['praxis_pid']] ?? ""); ?>;
        param_a['ext_fcid'] = <?php echo json_encode($form_data_a[$_SESSION['param']['ext_fcid']] ?? ""); ?>;
        param_a['geschlecht'] = <?php echo json_encode($form_data_a[$_SESSION['param']['geschlecht']] ?? ""); ?>;
        param_a['diagnosis'] = <?php echo json_encode($form_data_a[$_SESSION['param']['diagnosis']] ?? ""); ?>;
        param_a['first_visit'] = <?php echo json_encode($form_data_a[$_SESSION['param']['first_visit']] ?? ""); ?>;
        param_a['visite'] = <?php echo json_encode($form_data_a[$_SESSION['param']['visite']] ?? ""); ?>;
        param_a['visite_datum'] = <?php echo json_encode($form_data_a[10005020] ?? ""); ?>;
        const param_str = JSON.stringify(param_a);

        // medication frames
        const work_frame_vormedikation = document.getElementById('vormedikation');

        if (!param_a || typeof param_a['first_visit'] === 'undefined') {
            console.warn('⚠ param_a.first_visit nicht definiert.');
        }

        if (work_frame_vormedikation) {
            if (param_a && param_a['first_visit'] == 1) {
                work_frame_vormedikation.style.height = '80px';
                const query_str = '?medtype=V&param_str=' + btoa(encodeURIComponent(param_str));
                work_frame_vormedikation.src = '<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'forms/' ?>Medikation_patient_version_vormedikation.php' + query_str;
            } else {
                const shElem = document.getElementById('SH_99999001');
                const fsElem = document.getElementById('FS_99998001');

                if (shElem) shElem.style.display = 'none';
                else console.warn('⚠ Element SH_99999001 nicht gefunden.');

                if (fsElem) fsElem.style.display = 'none';
                else console.warn('⚠ Element FS_99998001 nicht gefunden.');
            }
        } else {
            console.warn('⚠ vormedikation-Frame nicht gefunden.');
        }

        const work_frame_medikation = document.getElementById('medikation');
        if (work_frame_medikation) {
            work_frame_medikation.style.height = '80px';
            const query_str = '?medtype=M&param_str=' + btoa(encodeURIComponent(param_str));
            work_frame_medikation.src = '<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'forms/' ?>Medikation_patient_version_medikation.php' + query_str;
        } else {
            console.warn('⚠ medikation-Frame nicht gefunden.');
        }

        // medication frames dynamic height
        window.addEventListener('message', function(event) {
            try {
                if (event.data && event.data.type === 'setHeight' && event.data.frameId) {
                    const iframe = document.getElementById(event.data.frameId);
                    if (iframe) {
                        const newHeight = Math.min(parseInt(event.data.height, 10) || 0, 1000);
                        iframe.style.height = newHeight + 'px';
                    } else {
                        console.warn(`⚠ Frame mit ID "${event.data.frameId}" nicht gefunden.`);
                    }
                }
            } catch (msgErr) {
                console.error('❌ Fehler beim Verarbeiten der Message:', msgErr);
            }
        });

    } catch (err) {
        console.error('❌ Fehler im Medication-Frame-Code:', err);
    }


    // basic vars 
    const status = <?php echo json_encode($status) ?>;
    const pre_visite = <?php echo json_encode($pre_visite ?? "") ?>;
    const pre_data_json_str = <?php echo json_encode($pre_data_json ?? "") ?>;
    const user_is_patient = <?php echo json_encode($user_is_patient); ?>;
    const pid = <?php echo json_encode($form_data_a[$_SESSION['param']['pid']]); ?>;
    const fcid = <?php echo json_encode($fcid); ?>;
    const visite = <?php echo json_encode($form_data_a[$_SESSION['param']['visite']]) ?>;
    const first_visit = parseInt(<?php echo json_encode($form_data_a[$_SESSION['param']['first_visit']]) ?>);
    const diagnosis_val = param_a['diagnosis'];
    const gender_val = param_a['geschlecht'];
    var groesse_val = <?php echo json_encode($groesse) ?>;



    const helper = document.getElementById('helper');
    const groesse = document.getElementById('FF_102600');
    const gewicht = document.getElementById('FF_102700');
    const bmi = document.getElementById('FF_102705');
    const bmi_info = document.getElementById('span_102705')
    const op_field = document.getElementById('FF_106900');

    const mayo_score = document.getElementById('FF_109001');
    const mayo_p_score = document.getElementById('FF_109002');
    const ses_score = document.getElementById('FF_109003');
    const cdai_score = document.getElementById('FF_109004');
    const sidbq_score = document.getElementById('FF_109005');
    const promis_score = document.getElementById('FF_109006');
    const facit_score = document.getElementById('FF_109007');
    const hbi_score = document.getElementById('FF_109008');
    const bwl_score = document.getElementById('FF_119000');

    const labor_haemoglobin = <?php echo json_encode($_SESSION['labor_haemoglobin'] ?? "") ?>;;

    const fieldset_anamnese = document.getElementById('FS_993344');
    fieldset_anamnese.style.alignItems = 'unset';

    // const schiebe_stuhld = document.getElementById('FF_119000');
    // const schiebe_promis = document.getElementById('FF_119190');
    // console.log("SP:" + schiebe_promis.value + " SD:" + schiebe_stuhld.value);

    // if (!schiebe_stuhld.value) {
    //     error_a[schiebe_stuhld.id] = 1;
    // } else error_a[schiebe_stuhld.id] = 0;
    // if (!schiebe_promis.value) {
    //     error_a[schiebe_promis.id] = 1;
    // } else error_a[schiebe_promis.id] = 0;
    // console.log(error_a);

    document.addEventListener('DOMContentLoaded', (event) => {
        activate_multi_selects();


        // console.log('Init DOMContentLoaded');
        // console.log("STATUS:" + status);
        if (status === 'FIRST_INIT' || status === 'FOLLOWUP_INIT') {
            fetchDataAndUpdateForm(fcid, 10010, 10, <?php echo json_encode($_SESSION['m_uid'] ?? "") ?>);
            fetchDataAndUpdateForm(fcid, 10010, 20, <?php echo json_encode($_SESSION['user_group'] ?? "") ?>);
            fetchDataAndUpdateForm(fcid, 10010, 90, pid);
            fetchDataAndUpdateForm(fcid, 10010, 91, param_a['praxis_pid']);
            fetchDataAndUpdateForm(fcid, 10010, 92, param_a['ext_fcid']);
            fetchDataAndUpdateForm(fcid, 10010, 93, visite);
            fetchDataAndUpdateForm(fcid, 10010, 94, first_visit);
            fetchDataAndUpdateForm(fcid, 10010, 95, diagnosis_val);
            fetchDataAndUpdateForm(fcid, 10010, 96, gender_val);
            fetchDataAndUpdateForm(fcid, 10010, 10005020, param_a['visite_datum']);
            // console.log("Patient initialisiert!");
            if (status === 'FOLLOWUP_INIT') {
                const pre_data_json = JSON.parse(pre_data_json_str);
                for (let key in pre_data_json) {
                    if (pre_data_json.hasOwnProperty(key)) {
                        // console.log(`Schlüssel: ${key}, Wert: ${pre_data_json[key]}`);
                        fetchDataAndUpdateForm(fcid, 10010, key, pre_data_json[key]);
                    }
                }
            }
        }

        // Helper-Funktionen

        try {
            // Score-Tabelle
            const score_table = parent?.document?.querySelector("#score_table tbody");
            if (!user_is_patient && !score_table) console.warn('⚠ Score Table nicht gefunden.');

            const score_a = {
                scoreElements: [],
                scoreLabels: []
            };
            if (diagnosis_val === 'Morbus Crohn' || diagnosis_val === 'Colitis indeterminata') {
                score_a.scoreElements = [bwl_score, ses_score, cdai_score, hbi_score, sidbq_score, promis_score, facit_score].filter(Boolean);
                score_a.scoreLabels = ["BOWEL", "SES-CD", "CDAI", "HBI", "SIDBQ", "PROMIS", "FACIT"];
            } else if (diagnosis_val === 'Colitis ulcerosa') {
                score_a.scoreElements = [bwl_score, mayo_score, mayo_p_score, cdai_score, hbi_score, sidbq_score, promis_score, facit_score].filter(Boolean);
                score_a.scoreLabels = ["BOWEL", "MAYO", "p.MAYO", "CDAI", "HBI", "SIDBQ", "PROMIS", "FACIT"];
            }

            // BMI-Felder
            if (bmi) bmi.readOnly = true;
            if (helper) helper.value = <?php echo json_encode($helper) ?>;

            // console.log(`WhoAmI: ${user_is_patient ? 'PATIENT' : 'MEDIC'} G:${gender_val} D:${diagnosis_val} Gr:${groesse?.value}/${groesse_val} Ge:${gewicht?.value}`);

            // Größe
            safeAddListener(groesse, 'blur', () => {
                if (groesse?.value && gewicht?.value) safeCall(set_bmi, bmi, bmi_info, groesse.value, gewicht.value);
                groesse_val = groesse?.value;
                safeCall(fetchDataAndUpdateForm, pid, 10003, 97, groesse?.value);
            });

            // Gewicht
            safeAddListener(gewicht, 'blur', () => {
                if (groesse?.value) {
                    safeCall(set_bmi, bmi, bmi_info, groesse.value, gewicht?.value);
                } else if (groesse_val) {
                    safeCall(set_bmi, bmi, bmi_info, groesse_val, gewicht?.value);
                }
                if (!user_is_patient) safeCall(updateScoreTable, score_table, score_a);
            });

            if (groesse_val && gewicht?.value > 0) safeCall(set_bmi, bmi, bmi_info, groesse_val, gewicht.value);
            safeCall(classify_bmi, bmi_info, bmi?.value);

            // Schwanger-Block
            const block_pregnant = safeGet('B_9507');
            if (block_pregnant && gender_val === 'weiblich') block_pregnant.style.display = 'block';

            // First visit – Einmalfelder
            // if (!first_visit) {
            //     document.querySelectorAll('.onetime').forEach(el => {
            //         el.querySelectorAll('input, select, textarea').forEach(field => field.required = false);
            //         el.style.display = 'none';
            //     });
            // }

            // Event-Setup für Score-Felder
            const setupScoreListeners = (fieldNumbers, scoreSetter, updateKey) => {
                fieldNumbers.forEach(number => {
                    const selectElement = safeGet('FF_' + number, false);
                    safeAddListener(selectElement, 'change', () => {
                        if (scoreSetter) {
                            scoreSetter();
                            safeCall(fetchDataAndUpdateForm, fcid, 10010, updateKey, selectElement?.value);
                            if (!user_is_patient) safeCall(updateScoreTable, score_table, score_a);
                        }
                    });
                });
            };

            // Beispiel: BOWEL
            safeAddListener(bwl_score, 'change', () => {
                if (!user_is_patient) safeCall(updateScoreTable, score_table, score_a);
            });

            // Die restlichen Score-Listener analog wie oben... absichern - safeCall() siehe FACIT
            // setupScoreListeners([...], () => {...}, 109005);

            // CDAI
            let fieldNumbers = [102600, 102700, 103500, 103900, 104000, 115900, 115600, 115700, 104200, 104300, 104400, 115800, 103505, 116000, 110200];
            fieldNumbers.forEach(function(number) {
                const selectId = 'FF_' + number;
                const selectElement = document.getElementById(selectId);
                if (selectElement) {
                    selectElement.addEventListener('change', function() {
                        // console.log(selectElement.id + ' changed');
                        const score_cdai_a = set_cdai_score(gender_val, groesse_val, gewicht.value);
                        if (check_if_set([103500, 103900, 104000, 115900, 115600, 115700, 115800, 116000, 110200, 103505, 116000, 104200], 'FF_')
                            // && (check_if_set([104300], 'FF_') || check_if_set([104400], 'FF_'))
                        ) cdai_score.value = score_cdai_a[0];
                        else cdai_score.value = '';
                        fetchDataAndUpdateForm(fcid, 10010, 109004, cdai_score.value);
                        if (check_if_set([103500, 103900, 104000, 115900, 115600, 115700, 115800, 116000], 'FF_')) hbi_score.value = score_cdai_a[1];
                        else hbi_score.value = '';
                        fetchDataAndUpdateForm(fcid, 10010, 109008, hbi_score.value);
                        if (!user_is_patient) updateScoreTable(score_table, score_a);
                    });
                }
            })
            // SIDBQ
            fieldNumbers = [116700, 116800, 116900, 117000, 117100, 117200, 117300, 117400, 117500, 117600];
            fieldNumbers.forEach(function(number) {
                const selectId = 'FF_' + number;
                const selectElement = document.getElementById(selectId);
                if (selectElement) {
                    selectElement.addEventListener('change', function() {
                        sidbq_score.value = set_sidbq_score();
                        fetchDataAndUpdateForm(fcid, 10010, 109005, sidbq_score.value);
                        if (!user_is_patient) updateScoreTable(score_table, score_a);
                    });
                }
            })
            // PROMIS
            fieldNumbers = [119100, 119110, 119120, 119130, 119140, 119150, 119160, 119170, 119180, 119190, 119190];
            fieldNumbers.forEach(function(number) {
                const selectId = 'FF_' + number;
                const selectElement = document.getElementById(selectId);
                if (selectElement) {
                    selectElement.addEventListener('change', function() {
                        promis_score.value = set_promis_score();
                        fetchDataAndUpdateForm(fcid, 10010, 109006, promis_score.value);
                        if (!user_is_patient) updateScoreTable(score_table, score_a);
                    });
                }
            })
            // FACIT
            fieldNumbers = [117700, 117800, 117900, 118000, 118100, 118200, 118300, 118400, 118500, 118600, 118700, 118800, 118900];
            fieldNumbers.forEach(function(number) {
                const selectId = 'FF_' + number;
                const selectElement = document.getElementById(selectId);
                if (selectElement) {
                    selectElement.addEventListener('change', function() {
                        facit_score.value = set_facit_score();
                        safeCall(fetchDataAndUpdateForm, fcid, 10010, 109007, facit_score.value);
                        if (!user_is_patient) updateScoreTable(score_table, score_a);
                    });
                }
            })
            // NUR Morbus Crohn SES
            const morbus_crohn_block = document.getElementById('B_9501');
            if (diagnosis_val == 'Morbus Crohn' || diagnosis_val == 'Colitis indeterminata') {
                if (morbus_crohn_block) morbus_crohn_block.style.display = 'inline';
                let fieldNumbers = [116202, 116204, 116206, 116208, 116302, 116304, 116306, 116308, 116402, 116404, 116406, 116408, 116502, 116504, 116506, 116508, 116602, 116604, 116606, 116608];
                fieldNumbers.forEach(function(number) {
                    const selectId = 'FF_' + number;
                    const selectElement = document.getElementById(selectId);
                    if (selectElement) {
                        selectElement.addEventListener('change', function() {
                            ses_score.value = set_ses_score_a();
                            fetchDataAndUpdateForm(fcid, 10010, 109003, ses_score.value);
                            if (!user_is_patient) updateScoreTable(score_table, score_a);
                        });
                    } else {
                        console.warn(`Element mit ID "${selectId}" nicht gefunden.`);
                    }
                });
            }
            // NUR Colitis Ulcerosa MAYO
            const colitis_ulcerosa_block_lokalisation = document.getElementById('B_9503');
            const colitis_ulcerosa_block_mayo_in_loka = document.getElementById('B_9504');
            if (diagnosis_val == 'Colitis ulcerosa') {
                if (colitis_ulcerosa_block_lokalisation) colitis_ulcerosa_block_lokalisation.style.display = 'inline';
                if (colitis_ulcerosa_block_mayo_in_loka) colitis_ulcerosa_block_mayo_in_loka.style.display = 'inline';
                fieldNumbers = [103500, 103600, 103700, 103800];
                fieldNumbers.forEach(function(number) {
                    const selectId = 'FF_' + number;
                    const selectElement = document.getElementById(selectId);
                    if (selectElement) {
                        selectElement.addEventListener('change', function() {
                            const scores_mayo_a = set_mayo_score_a();
                            if (check_if_set([103500, 103600, 103700, 103800], 'FF_')) mayo_score.value = scores_mayo_a[0];
                            else mayo_score.value = 0;
                            fetchDataAndUpdateForm(fcid, 10010, 109001, mayo_score.value);
                            if (check_if_set([103500, 103600, 103700], 'FF_')) mayo_p_score.value = scores_mayo_a[1];
                            else mayo_p_score.value = 0;
                            fetchDataAndUpdateForm(fcid, 10010, 109002, mayo_p_score.value);
                            if (!user_is_patient) updateScoreTable(score_table, score_a);
                        });
                    }
                });

            }

            // filter views patient and medic 
            filter_patient_medic_view(user_is_patient, helper);

            // medic functions
            if (!user_is_patient) {
                const fields_cdai = [102600, 102700, 104000, 103900, 116000, 115900, 115600, 115700, 104200, 104300, 104400, 115800, 103500, 103505, 110200]
                const fields_hbi = [104000, 103900, 116000, 115900, 115600, 115700, 115800, 103500]
                const majo_field = [103500, 103600, 103700, 103800];
                const tag = '&nbsp;&nbsp;'
                tag_marker([9517], tag, '#e9b0eeff'); // BOWEL
                tag_marker([116100], tag, '#94e2ffff'); // SES-CD
                tag_marker(fields_cdai, tag, 'yellow');
                tag_marker(fields_hbi, tag, 'orange');
                if (diagnosis_val == 'Colitis ulcerosa') tag_marker(majo_field, tag, 'silver');

                if (labor_haemoglobin) {
                    haemoglobin_field = document.getElementById('FF_110602');
                    if (haemoglobin_field) haemoglobin_field.value = labor_haemoglobin;
                }


                // medic check all examinations for negativ
                const chooseAllButton = document.getElementById('choose_all_untersuchung');
                if (chooseAllButton) {
                    chooseAllButton.addEventListener('click', () => {
                        const ids = [104800, 115600, 115700, 115800, 115900, 116000];
                        let last_val_a = {}
                        ids.forEach(id => {
                            last_val_a[id] = document.getElementById('FF_' + id).value;
                        });
                        ids.forEach(id => {
                            if (last_val_a[id] !== 'Nein') {
                                const ff = document.getElementById(`FF_${id}`);
                                const cbJa = document.getElementById(`CB_${id}_Ja`);
                                const cbNein = document.getElementById(`CB_${id}_Nein`);
                                if (ff) ff.value = 'Nein';
                                if (cbJa) cbJa.style.backgroundColor = 'white';
                                if (cbNein) cbNein.style.backgroundColor = 'dimgray';
                                fetchDataAndUpdateForm(fcid, 10010, id, 'Nein');
                                document.getElementById(`cbm_${id}`).style.backgroundColor = '';
                            }
                        });
                        const score_cdai_a = set_cdai_score(gender_val, groesse_val, gewicht.value);
                        cdai_score.value = score_cdai_a[0];
                        fetchDataAndUpdateForm(fcid, 10010, 109004, cdai_score.value);
                        hbi_score.value = score_cdai_a[1];
                        fetchDataAndUpdateForm(fcid, 10010, 109008, hbi_score.value);
                        updateScoreTable(score_table, score_a);
                        error_a['FF_104800'] = 0;
                        error_a['FF_115600'] = 0;
                        error_a['FF_115700'] = 0;
                        error_a['FF_115800'] = 0;
                        error_a['FF_115900'] = 0;
                        error_a['FF_116000'] = 0;
                        fetchDataAndUpdateForm(fcid, 10010, 100, JSON.stringify(c_info()));
                        errors = error_a_sum(error_a);
                        set_message(errors);
                    });
                }
                updateScoreTable(score_table, score_a);
            }

            // Plausibilisierung
            extra_plaus(user_is_patient, first_visit);

            // Checks
            safeCall(eL_check_numbers);
            safeCall(eL_check_required_fields);

            if (!user_is_patient) error_a.FF_0 ??= -1;

            background_field_save = 1;
            // Background Save
            try {
                if (background_field_save) background_field_action();
                // console.log('BGS:' + (background_field_save ? 'activated' : 'off'));
            } catch (error) {
                // console.log('background_field_save (INIT):', error);
            }

            // Border Styling
            safeCall(setBorderTopForElements, [
                105200, 105400, 105500, 105600, 105700, 105800, 105900,
                115600, 115700, 115800, 115900, 116000, 110400, 110511,
                110600, 110700, 110900, 111100
            ]);

            // Message Listener
            window.addEventListener('message', (event) => {
                if (event.data?.type === 'error_premed_ready' || event.data?.type === 'error_med_ready') {
                    try {
                        error_a = {
                            ...error_a,
                            ...JSON.parse(event.data.value)
                        };
                        // safeCall(c_info);
                        try {
                            // c_info();
                            fetchDataAndUpdateForm(fcid, 10010, 100, '');
                        } catch (err) {
                            console.error(`❌ Fehler in Funktionsaufruf errorwriting patientenfragebogen`, err);
                        }
                    } catch (err) {
                        console.error('Fehler beim Verarbeiten von error_*_ready:', err);
                    }
                }
            });


            if (<?php echo json_encode($message_ready); ?>) showMessageBox('Die meisten Angaben aus Ihrer letzten Visite wurden übernommen.<br>Sollten diese nicht mehr zutreffen, bitten wir Sie, die entsprechenden Änderungen vorzunehmen.<br><br>Machen Sie bitte zudem Angaben zu den rot markierten Feldern.');

            // Page Info
            const i_am = window.location.pathname;
            const i_am_a = i_am.split('/');
            // console.log('--- ' + i_am_a[i_am_a.length - 1] + ' --<E');

            if (fcid < 2025081900000000) lock_form();

            if (!user_is_patient) {
                const parentWinbox = window.top.findParentWinboxDiv(window);
                if (parentWinbox) {
                    parentWinbox.querySelector('.wb-title').textContent = parentWinbox.querySelector('.wb-title').textContent + " -  Pat.: " + param_a['praxis_pid'] + " -  Visite: " + param_a['visite_datum'];
                }
            }

        } catch (mainErr) {
            console.error('❌ Hauptfehler im DOMContentLoaded:', mainErr);
        }
    });
</script>
<style>
    #smiley-container {
        width: 90%;
        height: 90%;
        background-color: rgba(255, 255, 255, 0.8);
        opacity: 0.5;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;

        /* STARTZUSTAND */
        opacity: 0;

        /* TRANSITION-ANWEISUNG für das langsame Einblenden */
        animation: fadeIn 3s ease-in-out forwards;
    }

    #img_smiley {
        width: 500px;
    }

    .fade-in-image {
        /* STARTZUSTAND: Das Bild ist unsichtbar */
        opacity: 0;

        /* ANIMATION: Wenden Sie die Keyframes-Animation an */
        /* fadeIn = Name der Animation */
        /* 3s = Dauer der Animation (3 Sekunden) */
        /* ease-in-out = sanfter Start und Ende */
        /* forwards = hält den Endzustand (opacity: 1) */
        animation: fadeIn 3s ease-in-out forwards;
    }

    /* 3. Definition der Keyframes für das Einblenden */
    @keyframes fadeIn {

        /* Bei Beginn der Animation (0%) */
        0% {
            opacity: 0;
        }

        /* Bei Ende der Animation (100%) */
        100% {
            opacity: 1;
            /* Vollständig sichtbar */
        }
    }

    /* ZIELZUSTAND */
    #smiley-container.visible {
        opacity: 1;
    }
</style>
<script>
    // const smiley_png = 'smileyC_winter.png';  
    // const smiley_png = 'smileyC_new_year.png'; 
    // const smiley_png = 'smileyC_herbst.png';  
    const heute = new Date();
    const mmtt = (heute.getMonth() + 1) * 100 + heute.getDate();

    let smiley_png = 'smileyC.png';

    if (mmtt >= 101 && mmtt < 121) {
        smiley_png = 'smileyC_new_year.png';
    }
    if (mmtt >= 121 && mmtt < 301) {
        smiley_png = 'smileyC_winter.png';
    }
    if (mmtt >= 301 && mmtt < 601) {
        smiley_png = 'smileyC.png';
    }
    if (mmtt >= 701 && mmtt < 1001) {
        smiley_png = 'smileyC.png';
    }
    if (mmtt >= 1001 && mmtt < 1201) {
        smiley_png = 'smileyC_herbst.png';
    }
    if (mmtt >= 1201 && mmtt <= 1231) { 
        smiley_png = 'smileyC_holiday.png';
    }

    const smileyHTML = `
        <div id="smiley-container" onclick="this.style.display = 'None'">
            <center><h1>Alle wichtigen Daten sind vollständig!</h1>
            <h2>Vielen Dank für Ihre Geduld und Mitarbeit!</h2>
            <h3>Wir würden uns freuen, wenn Sie noch die wenigen 
            Zusatzfragen am Ende des Bogens beantworten.
            <br>Dazu könnnen Sie  den Smiley ausblenden, indem Sie ihn anklicken!</h2>
            <br><img id='img_smiley' src="../forms/images/` + smiley_png + `" width='100%' alt="Smiley" style='margin-top:-25px'>
            </center>
        </div>
    `;
    const smileyHTML_FACIT = `
        <div id="smiley-container" onclick="this.style.display = 'None'">
            <center><h1>Alle wichtigen Daten sind vollständig!</h1>
            <h2>Vielen Dank für Ihre Geduld, Mitarbeit und Zeit!</h2>
            <br><img id='img_smiley' src="../forms/images/` + smiley_png + `" width='100%' alt="Smiley" style='margin-top:-25px'>
            </center>
        </div>
    `;
    const smileyHTM_MEDIC = `
        <div id="smiley-container" onclick="this.style.display = 'None'">
            <center><h1>Vielen Dank für das Ausfüllen, die Visite ist hiermit abgeschlossen!</h1>
            <br><img id='img_smiley' src="../forms/images/` + smiley_png + `" width='100%' alt="Smiley" style='margin-top:-25px'>
            </center>
        </div>
    `;


    // 1. Array der zu prüfenden Nummern
    const ffNumbers = [
        '117700', '117800', '117900', '118000', '118100', '118200',
        '118300', '118400', '118500', '118600', '118700', '118800', '118900'
    ];

    function areAllFFInputsFilled() {
        return ffNumbers.every(number => {
            const selector = `select[name="FF_${number}"]`;
            const inputElement = document.querySelector(selector);
            // Prüft, ob das Element existiert und der bereinigte Wert nicht leer ist
            return inputElement && inputElement.value.trim() !== '';
        });
    }

    ffNumbers.forEach(number => {
        const selector = `select[name="FF_${number}"]`;
        const inputElement = document.querySelector(selector);
        if (inputElement) {
            // Bindet die Prüfung an die Events 'input' (während der Eingabe) und 'change' (beim Verlassen des Feldes)
            // inputElement.addEventListener('input', checkAndReport);
            inputElement.addEventListener('change', checkAndReport);
        }
    });

    // 3. Die Callback-Funktion, die die Prüfung durchführt und das Ergebnis meldet
    function checkAndReport() {
        const allFilled = areAllFFInputsFilled();

        if (allFilled) {
            if (errors === 0)
                if (user_is_patient) document.body.insertAdjacentHTML('beforeend', smileyHTML_FACIT);
            return 1;
            // console.log("ALLE Felder sind jetzt vollständig ausgefüllt. ✅");

        } else {
            return 0;
            // console.warn("Es fehlen noch Eingaben. ⚠️");
        }
    }




    // const error_save = document.getElementById('FF_100');
    // if (error_save)
    //     if (error_save.value =='{}') document.body.insertAdjacentHTML('beforeend', smileyHTML);

    const verwandte = document.getElementById('B_105000_Ja');
    if (verwandte) {
        const targetRowDiv = verwandte.firstElementChild;
        if (targetRowDiv && targetRowDiv.classList.contains('row')) {
            // targetRowDiv.style.backgroundColor = '#e0f7fa';
            // targetRowDiv.style.border = '1px solid #00bcd4';
            targetRowDiv.style.alignItems = 'flex-end';
            targetRowDiv.style.justifyContent = 'flex-end';
            // console.log("gefunden:", targetRowDiv);
        } else {
            console.log("nicht vorhanden oder hat nicht die Klasse 'row'.");
        }
    }

    fieldsetIds = ['FS_1377995', 'FS_1377996', 'FS_1377997', 'B_105000_Ja'];
    for (let i = 0; i < fieldsetIds.length; i++) {
        const currentId = fieldsetIds[i];
        const fieldsetElement = document.getElementById(currentId);
        if (fieldsetElement) {
            fieldsetElement.style.alignItems = 'flex-start';
            fieldsetElement.style.justifyContent = 'flex-start';
        } else {
            console.warn(`Element mit ID '${currentId}' nicht im DOM gefunden.`);
        }
    }

    let lastErrorsValue;
    const watcher = setInterval(() => {
        try {
            // Prüfen, ob die Variable existiert
            if (typeof errors !== "undefined") {
                if (errors !== lastErrorsValue) {
                    // console.log("errors geändert →", errors);
                    lastErrorsValue = errors;
                }

                if (errors === 0) {
                    // alert("✅ Fehler = 0!");
                    if (user_is_patient) {
                        if (!checkAndReport()) document.body.insertAdjacentHTML('beforeend', smileyHTML);

                    } else document.body.insertAdjacentHTML('beforeend', smileyHTM_MEDIC);
                    clearInterval(watcher); // Überwachung stoppen, wenn du willst
                }
            }
        } catch (e) {
            console.error("Fehler beim Überwachen:", e);
        }
    }, 200);
</script>
<?php
if ($user_is_patient) {
    $FROM = 'forms';
    require_once '../session.php';
}
?>