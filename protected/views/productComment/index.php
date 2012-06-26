<?php
$this->breadcrumbs=array(
	'Product Comments',
);

$this->menu=array(
	array('label'=>'Create ProductComment', 'url'=>array('create')),
	array('label'=>'Manage ProductComment', 'url'=>array('admin')),
);
?>

<h1>Product Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
