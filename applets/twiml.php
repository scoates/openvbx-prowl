<?php
require 'prowl.php';

$type = AppletInstance::getFlowType();
if ($type == 'voice') {
    $msg = "call from {$_REQUEST['Caller']}";
} else { // sms
    $msg = "message from {$_REQUEST['From']}";
}
$p = new OpenVBX\plugin\prowl\Message(AppletInstance::getValue('prowl_apikey'));
$p->event = $type;
$application = AppletInstance::getValue('prowl_application','OpenVBX');
if (!empty($application)) {
    $p->application = $application;
}

// The response object constructs the TwiML for our applet
$response = new TwimlResponse;
 
$p->send($msg);

// $primary is getting the url created by what ever applet was put
// into the primary dropzone
$primary = AppletInstance::getDropZoneUrl('primary');
 
// As long as the primary dropzone is not empty add the redirect
// twiml to $response
if(!empty($primary)) {
    $response->redirect($primary);
}
 
// This will create the twiml
$response->respond();
