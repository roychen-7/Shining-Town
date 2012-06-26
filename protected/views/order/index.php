<?php
$this->breadcrumbs=array(
	'订单',
);

if(Yii::app()->user->isAdmin)
{
	$this->menu=array(
		array('label'=>'管理订单', 'url'=>array('admin')),
	);
}

?>

<h2>订单</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_orderState',
)); ?>
