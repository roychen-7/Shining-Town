<?php

$json = array();
$json['message'] = $message;

if($message===null){
	$json['order']['id'] = $model->id;
	$json['order']['order_id'] = $model->order_id;
	$json['order']['order_state_id'] = $model->order_state_id;
	$json['order']['create_time'] = $model->create_time;
	$json['order']['product_id'] = $model->product_id;
	$json['order']['entered_pid'] = $model->entered_pid;
	$json['order']['express_id'] = ($json['order']['order_state_id']==='6') ? $model->remark : '';
	$json['order']['order_info'] = $model->order_info;
	$json['order']['product_name'] = $model->product_name;
	foreach($model->order_photos as $key => $image){
		$json['photo'][$key] = $image['photo_name'];
	}
}

$json = JSON($json);

responseJSON($json);

?>