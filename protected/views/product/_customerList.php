<?php

$json = array();

$json['message'] = $message;

if($message === null)
{
	foreach($results as $key => $result)
	{
		$json['productList'][$key]['id'] = $result['id'];
		$json['productList'][$key]['product_id'] = $result['product_id'];
		$json['productList'][$key]['product_name'] = $result['product_name'];
		$json['productList'][$key]['product_introduce'] = utf8Substr($result['product_introduce'],0,30);
		$json['productList'][$key]['product_mark'] = $result['product_mark'];
		$json['productList'][$key]['product_create_time'] = $result['product_create_time'];
		$json['productList'][$key]['product_thumbnail'] = $result['product_thumbnail'];
	}
}


$json = JSON($json);

responseJSON($json);

?>