<?php
$this->breadcrumbs=array(
	Yii::t('feedback','feedback'),
);

$this->menu=array(
	array('label'=>Yii::t('feedback','feedbackmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('feedback','feedbacklist');?></h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
