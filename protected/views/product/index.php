<?php
$this->breadcrumbs=array(
	Yii::t('product','product'),
);

$this->menu=array(
	array('label'=>Yii::t('product','productcreate'), 'url'=>array('create')),
	array('label'=>Yii::t('product','productmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('product','productlist')?></h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
