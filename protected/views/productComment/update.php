<?php
$this->breadcrumbs=array(
	'Product Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductComment', 'url'=>array('index')),
	array('label'=>'Create ProductComment', 'url'=>array('create')),
	array('label'=>'View ProductComment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductComment', 'url'=>array('admin')),
);
?>

<h1>Update ProductComment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>