<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'创建用户', 'url'=>array('create')),
	array('label'=>'更新用户', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除用户', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理用户', 'url'=>array('admin')),
);
?>

<h2>用户<?php echo $model->user_id; ?>的信息</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'username',
		'limit_id',
	),
)); ?>
