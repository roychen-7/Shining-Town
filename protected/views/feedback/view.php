<?php
$this->breadcrumbs=array(
	'意见反馈'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'反馈列表', 'url'=>array('index')),
	array('label'=>'反馈处理', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'反馈管理', 'url'=>array('admin')),
);
?>

<h2>反馈内容</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'text',
		'contact_method',
		'create_time',
		'dealed_zn',
	),
)); 

echo '<br />';

echo CHtml::image(Yii::app()->baseUrl.'/images/feedback/'.$model->order_id.'/feedback.png','图片的说明',array('width'=>'200px','height'=>'200px')); 

?>
