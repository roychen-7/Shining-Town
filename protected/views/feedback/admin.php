<?php
$this->breadcrumbs=array(
	Yii::t('feedback','feedback')=>array('index'),
	Yii::t('feedback','deal'),
);

$this->menu=array(
	array('label'=>Yii::t('feedback','feedbacklist'), 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('feedback-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2><?=Yii::t('feedback','feedbackdeal');?></h2>

<?php echo CHtml::link(Yii::t('feedback','advancesearch'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'feedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'order_id',
		'text',
		'contact_method',
		'create_time',
		'dealed',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
