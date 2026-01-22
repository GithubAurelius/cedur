<script>
    // textarea in Höhe strecken
    const function_field = document.getElementById('FF_99902005'); 
    function_field.style.height = "60px";
    eL_check_required_fields();

    // Get Winbox and set width and height
    const outer_wb = window.top.findClosestWinboxFromIframe(window.frameElement);
    const wh = parent.window.innerHeight-window.top.men_height;
    outer_wb.winbox.resize('50%', wh);

    // Reload opener winbox
    const opener_wb = parent.document.getElementById('winbox-' + window.top.win_boxes2form['Menue-Liste']); 
    const iframe = opener_wb.querySelector("iframe");
    if (<?php echo json_encode($_POST)?>) iframe.contentWindow.location.reload();
    
</script>