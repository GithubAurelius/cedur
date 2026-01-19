<?php
$data_def_a['desc_a']['F_101'] = 'PAT';
$data_def_a['desc_a']['F_102'] = 'MED';
//echo "<pre>"; echo print_r($_REQUEST); echo "</pre>";
?>
<script>
    // Init
    
    const wb_width = 2/5;
    const wb_height = 1;
    const winbox_num = <?= json_decode($data_def_a['num']) ?? 59595959 ?>;
    if (winbox_num>0){
        const outer_wb_add = window.top.findClosestWinboxFromIframe(window.frameElement);
            outer_wb_add.winbox.setIcon(window.top.miq_root_path + 'img/person.svg');
        const winbox_height = parent.window.innerHeight - window.top.men_height;
        const wh = winbox_height * wb_height;
        const ww = parent.window.innerWidth * wb_width
        if (!window.top.win_boxes?.[winbox_num]?.pos) {
            outer_wb_add.winbox.resize(ww, wh);
            outer_wb_add.winbox.move(0, window.top.men_height);
        }
    }
</script>