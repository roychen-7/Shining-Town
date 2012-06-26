<?php

$json = array();
$json['state'] = $response;
$json['message'] = $message;

$json = JSON($json);

responseJSON($json);

?>