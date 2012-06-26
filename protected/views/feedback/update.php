<?php
$this->breadcrumbs=array(
	'意见反馈'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'处理',
);

$this->menu=array(
	array('label'=>'反馈列表', 'url'=>array('index')),
	array('label'=>'反馈详情', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'反馈管理', 'url'=>array('admin')),
);
?>

<h2>反馈管理</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>