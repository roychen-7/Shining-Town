<?php
$this->breadcrumbs=array(
	'评论'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'创建评论', 'url'=>array('create')),
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

<h2>管理评论</h2>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
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
