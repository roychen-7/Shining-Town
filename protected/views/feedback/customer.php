<?php

$json = array();
$json['message'] = $message;

$json = JSON($json);

responseJSON($json);

?>