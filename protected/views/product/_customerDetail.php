<?php

$json = array();
$json['message'] = $message;
$json['id'] = null;
$json['product_id'] = null;
$json['product_name'] = null;
$json['product_introduce'] = null;
$json['product_mark'] = null;
$json['product_create_time'] = null;
$json['product_images'] = null;
$json['productCommentList'] = array();

//var_dump($json['product']->product_id);

if($message === null)
{
	$json['id'] = $product->id;
	$json['product_id'] = $product->product_id;
	$json['product_name'] = $product->product_name;
	$json['product_introduce'] = $product->product_introduce;
	$json['product_mark'] = $product->product_mark;
	$json['product_create_time'] = $product->product_create_time;
	foreach($product->product_images as $key => $image)
	{
		$json['product_images'][$key]['name'] = $image;
	}
	
	foreach($productCommentList as $key => $productComment)
	{
		$json['productCommentList'][$key]['id'] = $productComment['id'];
		$json['productCommentList'][$key]['product_id'] = $productComment['product_id'];
		$json['productCommentList'][$key]['text'] = $productComment['text'];
		$json['productCommentList'][$key]['create_time'] = $productComment['create_time'];
		$json['productCommentList'][$key]['amazing_level'] = $productComment['amazing_level'];
	}
}

$json = JSON($json);

responseJSON($json);

?>