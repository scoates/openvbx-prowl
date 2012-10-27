<div class="vbx-applet">
    <h2>Send a message to Prowl</h2>
    <p>API key: <input name="prowl_apikey" value="<?php echo AppletInstance::getValue('prowl_apikey');?>" /></p>
    <p>Application (optional): <input name="prowl_application" value="<?php echo AppletInstance::getValue('prowl_application');?>" /></p>
    <p>Continue…</p>
    <?php echo AppletUI::DropZone('primary'); ?>
</div>
