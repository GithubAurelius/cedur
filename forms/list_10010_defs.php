<?php

if (!empty($prepare_page)) {
    $data_def_a['desc_a']['F_10'] = 'Owner';
    $data_def_a['desc_a']['F_20'] = 'Group';
    $data_def_a['desc_a']['F_90'] = 'PID';
    $data_def_a['desc_a']['F_93'] = 'VID';
    $data_def_a['desc_a']['F_94'] = 'BASE';
    $data_def_a['desc_a']['F_fcid'] = 'FCID';

    $data_def_a['desc_a']['F_10005020'] = 'Befragung (letzte)';
    $data_def_a['desc_a']['F_92'] = 'Cedur-Nr.';
    $data_def_a['desc_a']['F_95'] = 'Diagnose';

    $data_def_a['desc_a']['F_110200'] = 'Hämatokrit';
    $data_def_a['desc_a']['F_110500'] = 'Calprotectin';
    $data_def_a['desc_a']['F_110600'] = 'Hämoglobin';
    $data_def_a['desc_a']['F_111000'] = 'CRP';
    $data_def_a['desc_a']['F_111100'] = 'Albumin';
    $data_def_a['desc_a']['F_110511'] = 'Thrombozyten';
    $data_def_a['desc_a']['F_110700'] = 'Ferritin';

    $data_def_a['desc_a']['F_96'] = 'Geschlecht';
    $data_def_a['desc_a']['F_102300'] = 'Erstsysmptome';
    $data_def_a['desc_a']['F_102200'] = 'Diagnose';
    $data_def_a['desc_a']['F_102600'] = 'Größe';
    $data_def_a['desc_a']['F_102700'] = 'Gewicht';
    $data_def_a['desc_a']['F_102705'] = 'BMI';
    $data_def_a['desc_a']['F_102800'] = 'Raucher';
    $data_def_a['desc_a']['F_102815'] = 'Ernährungsform';
    $data_def_a['desc_a']['F_108500'] = 'Schwanger';

    $data_def_a['desc_a']['F_102000'] = 'Lokalisation (CU)';
    $data_def_a['desc_a']['F_103700'] = 'Beurteilung';
    $data_def_a['desc_a']['F_110905'] = 'Nebenwirkungen';
    $data_def_a['desc_a']['F_104800'] = 'Stenosen';
    $data_def_a['desc_a']['F_115700'] = 'Temperatur';
    $data_def_a['desc_a']['F_115800'] = 'EIM';
    $data_def_a['desc_a']['F_116000'] = 'Resistenz Abd.';

    

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
    // Init
    const wb_width = 2/5;
    const wb_height = 0.7;
    const winbox_num = <?= json_decode($data_def_a['num']) ?? 59595959 ?>;
    
        const outer_wb_add = window.top.findClosestWinboxFromIframe(window.frameElement);
            outer_wb_add.winbox.setIcon(window.top.miq_root_path + 'img/person.svg');
        const winbox_height = parent.window.innerHeight - window.top.men_height;
        const wh = winbox_height * wb_height;
        const ww = parent.window.innerWidth * wb_width
        if (!window.top.win_boxes?.[winbox_num]?.pos) {
            outer_wb_add.winbox.resize(ww, wh);
            outer_wb_add.winbox.move(0, parent.window.innerHeight - wh);
        }
</script>