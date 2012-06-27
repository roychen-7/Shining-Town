<?php
$this->breadcrumbs=array(
	Yii::t('comment','comment'),
);

$this->menu=array(
	array('label'=>Yii::t('comment','commentcreate'), 'url'=>array('create')),
	array('label'=>Yii::t('comment','commentmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('comment','commentlist');?></h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
