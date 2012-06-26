<?php
$this->breadcrumbs=array(
	'评论'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'创建评论', 'url'=>array('create')),
	array('label'=>'评论内容', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理评论', 'url'=>array('admin')),
);
?>

<h2>更新评论 （序号：<?php echo $model->id; ?>）</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>