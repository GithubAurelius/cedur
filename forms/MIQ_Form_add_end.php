<script>
    const fg = <?php echo json_encode($form_data_a[99901001]) ?>;
    const fcid = <?php echo json_encode($fcid) ?>;
    const miq_path = <?php echo json_encode(MIQ_PATH) ?>;

    // Get Winbox and set width and height
    const outer_wb = window.top.findClosestWinboxFromIframe(window.frameElement);
    // console.log(outer_wb);
    const wh = parent.window.innerHeight-window.top.men_height;
    outer_wb.winbox.resize('50%', wh);
    
    const img_iframe_container = document.getElementById('idonly_991002');
    img_iframe_container.innerHTML = `
        <iframe id='img_iframe' 
            src="${miq_path}modules/creator/create.php?fg=${fg}"
            style="
                width: 100%;
                border: none;
                height: 200px;
                overflow-x: hidden;
                overflow-y: auto;
                display: block;
            "
            scrolling="yes"
        ></iframe>`;
    img_iframe.style.height = wh-260;

    // Reload opener winbox
    const opener_wb = parent.document.getElementById('winbox-3');
    const iframe = opener_wb.querySelector("iframe");
    if (<?php echo json_encode($_POST)?>) iframe.contentWindow.location.reload();

</script>