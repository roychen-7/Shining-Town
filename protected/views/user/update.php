<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'创建用户', 'url'=>array('create')),
	array('label'=>'用户信息', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h2>更改用户<?php echo $model->user_id; ?>的信息</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>