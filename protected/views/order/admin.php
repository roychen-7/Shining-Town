<?php
$this->breadcrumbs=array(
	'订单'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'创建订单', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>管理订单</h2>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'order_id',
		'order_state_id',
		'create_time',
		'product_id',
		'entered_pid',
		/*
		'remark',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
