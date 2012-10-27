<?php
namespace OpenVBX\plugin\prowl;

class Message
{
  const API_ENDPOINT = 'http://api.prowlapp.com/publicapi/add';
  protected $apiKey;
  public $event = null;
  public $application = null;
  public function __construct($apiKey) {
    $this->apiKey = $apiKey;
  }

  public function send($description) {
    $params = array(
      'apikey' => $this->apiKey,
      'description' => $description,
    );
    if ($this->event) {
      $params['event'] = $this->event;
    }
    if ($this->application) {
      $params['application'] = $this->application;
    }
    $content = http_build_query($params);

    
    $opts = array(
      'http' => array(
        'method' => 'POST',
        'ignore_errors' => true,
        'user_agent' => 'ProwlMsg/1.0 PHP/' . PHP_VERSION,
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $content,
      )
    );
    $context = stream_context_create($opts);

    return file_get_contents(self::API_ENDPOINT, false, $context);
  }
}
