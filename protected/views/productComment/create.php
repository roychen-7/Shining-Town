<?php
$this->breadcrumbs=array(
	'产品评论'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'产品评论列表', 'url'=>array('index')),
	array('label'=>'管理产品评论', 'url'=>array('admin')),
);
?>

<h2>创建产品评论</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>