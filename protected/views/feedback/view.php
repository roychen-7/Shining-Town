<?php
$this->breadcrumbs=array(
	Yii::t('feedback','feedback')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('feedback','feedbacklist'), 'url'=>array('index')),
	array('label'=>Yii::t('feedback','feedbackdeal'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('feedback','feedbackmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('feedback','feedbackdetail');?></h2>

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

echo CHtml::image(Yii::app()->baseUrl.'/images/feedback/'.$model->order_id.'/feedback.png','',array('width'=>'200px','height'=>'200px')); 

?>
