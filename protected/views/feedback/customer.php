<?php

$json = array();
$json['message'] = $errorMessage;

$json = JSON($json);

responseJSON($json);

?>