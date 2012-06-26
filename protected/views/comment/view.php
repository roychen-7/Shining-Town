<?php
$this->breadcrumbs=array(
	'评论'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'创建评论', 'url'=>array('create')),
	array('label'=>'修改评论', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除评论', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理评论', 'url'=>array('admin')),
);
?>

<h2>评论内容 <?php echo $model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
		'create_time',
		'contact_method',
		'service_attitude',
		'delivery_speed',
	),
)); ?>
