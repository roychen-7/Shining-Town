<?php
$this->breadcrumbs=array(
	'订单创建'=>array('index'),
	'步骤一',
);

if(Yii::app()->user->isAdmin)
{
	$this->menu=array(
		array('label'=>'创建订单', 'url'=>array('index')),
		array('label'=>'管理订单', 'url'=>array('admin')),
	);
}

?>

<h2>创建订单</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>