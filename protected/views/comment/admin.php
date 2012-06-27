<?php
$this->breadcrumbs=array(
	Yii::t('comment','comment')=>array('index'),
	Yii::t('comment','commentmanager'),
);

$this->menu=array(
	array('label'=>Yii::t('comment','commentlist'), 'url'=>array('index')),
	array('label'=>Yii::t('comment','commentcreate'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('comment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2><?=Yii::t('comment','commentmanager');?></h2>

<?php echo CHtml::link(Yii::t('comment','advancedsearch'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'text',
		'create_time',
		'contact_method',
		'service_attitude',
		'delivery_speed',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
