<?php
$this->breadcrumbs=array(
	'订单'=>array('index'),
	'订单号：'.$model->order_id,
);

if(Yii::app()->user->isAdmin)
{
	$this->menu=array(
		array('label'=>'创建订单', 'url'=>array('index')),
		array('label'=>'删除订单', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'管理订单', 'url'=>array('admin')),
	);
}
?>

<h2>订单：<?php echo $model->order_id?> 详情</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_id',
		'order_state_zn',
		'create_time',
		'product_id',
		'entered_pid',
		'remark',
	),
)); 

echo CHtml::link(CHtml::encode('继续入库'), array(
						(($model->order_state_id==='1')?'create':'update'), 
						'sid' => $model->order_state_id
					)); 

?>
