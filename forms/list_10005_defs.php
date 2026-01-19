<?php
$data_def_a['desc_a']['F_101'] = 'PAT';
$data_def_a['desc_a']['F_102'] = 'MED';

//echo "<pre>"; echo print_r($_REQUEST); echo "</pre>";

foreach ($table_a as $fcid => $data_a) {
        if (isset($data_a[100])){
            $touched = 0;
            $error_a = json_decode($data_a[100], true) ?? [];
            
            $groups = [
                'L.' => ['FF_110200'],
                'U.' => ['FF_101902','FF_101904','FF_101906','FF_101908','FF_101910','FF_116100','FF_116202','FF_116204','FF_116206','FF_116208','FF_116302','FF_116304','FF_116306','FF_116308','FF_116402','FF_116404','FF_116406','FF_116408','FF_116502','FF_116504','FF_116506','FF_116508','FF_116602','FF_116604','FF_116606','FF_116608','FF_102000','FF_103700','FF_103800','FF_104300','FF_104400','FF_104800','FF_104900','FF_104910','FF_115600','FF_115700','FF_115800','FF_115900','FF_116000','FF_108400','FF_108100','FF_107800','FF_107500','FF_107200'],
                'N' => ['FF_110905'],
            ];
 
            $temp_str = '';
            foreach ($groups as $symbol => $keys2check) {
                foreach ($keys2check as $key) {
                    if (isset($error_a[$key])) {
                        $temp_str .= $symbol;
                        $touched = 1;
                        break; // nur einmal pro Gruppe
                    }
                }
            }

            if (!$touched && count($error_a)>0) $temp_str = 'P ('.count($error_a).')';
            if ($touched && count($error_a)>0) $temp_str = $temp_str . ' ('.count($error_a).')';
             

            if (count($error_a)==1 && isset($error_a['FF_0'])) $temp_str = '✓ (OK)';

            $table_a[$fcid][100] = $temp_str;
        }
        else {
            $table_a[$fcid][100] = '-';
        }
    }


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