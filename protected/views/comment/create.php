<?php
$this->breadcrumbs=array(
	'评论'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'管理评论', 'url'=>array('admin')),
);
?>

<h2>创建评论</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>