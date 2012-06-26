<?php

$json = array();

$json['message'] = $message;
$json['service_attitude'] = ($json['message']===null)?$siteMarkModel->service_attitude:null;
$json['delivery_speed'] = ($json['message']===null)?$siteMarkModel->delivery_speed:null;
$json['commentList'] = null;


if($message === null)
{
	foreach($results as $key => $result)
	{
		$json['commentList'][$key]['id'] = $result['id'];
		$json['commentList'][$key]['text'] = $result['text'];
		$json['commentList'][$key]['create_time'] = $result['create_time'];
		$json['commentList'][$key]['service_attitude'] = $result['service_attitude'];
		$json['commentList'][$key]['delivery_speed'] = $result['delivery_speed'];
	}
}

$json = JSON($json);

responseJSON($json);

?>