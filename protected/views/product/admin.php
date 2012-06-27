<?php
$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	Yii::t('product','productmanager'),
);

$this->menu=array(
	array('label'=>Yii::t('product','productlist'), 'url'=>array('index')),
	array('label'=>Yii::t('product','productcreate'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2><?=Yii::t('product','productmanager')?></h2>

<?php echo CHtml::link(Yii::t('product','advanced search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'product_id',
		'product_name',
		'product_introduce',
		'product_mark',
		'product_create_time',
		/*
		'product_marked_times',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
