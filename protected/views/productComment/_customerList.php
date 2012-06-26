<?php

$json = array();

$json['message'] = $message;
$json['amazing_level'] = ($json['message']===null)?$productModel->product_mark:null;
$json['commentList'] = null;


if($message === null)
{
	foreach($results as $key => $result)
	{
		$json['commentList'][$key]['id'] = $result['id'];
		$json['commentList'][$key]['text'] = $result['text'];
		$json['commentList'][$key]['create_time'] = $result['create_time'];
		$json['commentList'][$key]['amazing_level'] = $result['amazing_level'];
	}
}

$json = JSON($json);

responseJSON($json);

?>