<?php
$this->breadcrumbs=array(
	'Product Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductComment', 'url'=>array('index')),
	array('label'=>'Create ProductComment', 'url'=>array('create')),
	array('label'=>'Update ProductComment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductComment', 'url'=>array('admin')),
);
?>

<h1>View ProductComment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'text',
		'create_time',
		'contact_method',
		'amazing_level',
	),
)); ?>
