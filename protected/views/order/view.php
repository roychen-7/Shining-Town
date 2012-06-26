<?php
$this->breadcrumbs=array(
	Yii::t('order','order')=>array('index'),
	Yii::t('order','orderid'),' ',$model->order_id,
);

if(Yii::app()->user->isAdmin)
{
	$this->menu=array(
		array('label'=>Yii::t('order','ordercreate'), 'url'=>array('index')),
		array('label'=>Yii::t('order','orderdelete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>Yii::t('order','ordermanager'), 'url'=>array('admin')),
	);
}
?>

<h2><?php echo Yii::t('order','order'),' ',$model->order_id,' ',Yii::t('order','detail')?></h2>

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

echo CHtml::link(CHtml::encode(Yii::t('order','go on input')), array(
						(($model->order_state_id==='1')?'create':'update'), 
						'sid' => $model->order_state_id
					)); 

?>
