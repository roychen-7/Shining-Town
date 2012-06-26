<?php
$this->breadcrumbs=array(
	'意见反馈',
);

$this->menu=array(
	array('label'=>'反馈管理', 'url'=>array('admin')),
);
?>

<h2>意见反馈</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
