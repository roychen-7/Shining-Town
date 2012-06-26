<?php
$this->breadcrumbs=array(
	'意见反馈'=>array('index'),
	'处理',
);

$this->menu=array(
	array('label'=>'反馈列表', 'url'=>array('index')),
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

<h2>处理反馈</h2>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
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
