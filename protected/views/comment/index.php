<?php
$this->breadcrumbs=array(
	'评论',
);

$this->menu=array(
	array('label'=>'创建评论', 'url'=>array('create')),
	array('label'=>'管理评论', 'url'=>array('admin')),
);
?>

<h2>评论</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
