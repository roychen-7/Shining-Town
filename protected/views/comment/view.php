<?php
$this->breadcrumbs=array(
	Yii::t('comment','comment')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('comment','commentlist'), 'url'=>array('index')),
	array('label'=>Yii::t('comment','commentcreate'), 'url'=>array('create')),
	array('label'=>Yii::t('comment','commentupdate'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('comment','commentdelete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('comment','commentmanager'), 'url'=>array('admin')),
);
?>

<h2><?php echo Yii::t('comment','commentdetail'),' ',$model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
		'create_time',
		'contact_method',
		'service_attitude',
		'delivery_speed',
	),
)); ?>
