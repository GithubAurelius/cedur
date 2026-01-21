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
} else {
}


?>
<script>
    // Init
    const wb_width = 2/5;
    const wb_height = 0.3;
    const winbox_num = <?= json_decode($data_def_a['num']) ?? 555 ?>;
    
    const outer_wb_add = window.top.findClosestWinboxFromIframe(window.frameElement);
    outer_wb_add.winbox.setIcon(window.top.miq_root_path + 'img/person-list.svg');
    const winbox_height = parent.window.innerHeight - window.top.men_height;
    const wh = winbox_height * wb_height;
    const ww = parent.window.innerWidth * wb_width
    if (!window.top.win_boxes?.[winbox_num]?.pos) {
        outer_wb_add.winbox.resize(ww, wh);
        outer_wb_add.winbox.move(0, parent.window.innerHeight - wh);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll("button[id^='E_']"); 
        buttons.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const visite_wb = parent.document.getElementById('winbox-' + window.top.win_boxes2form['Visite']);
                if (visite_wb) visite_wb.winbox.close();
            });
        });
    });
</script>