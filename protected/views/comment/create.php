<?php
$this->breadcrumbs=array(
	Yii::t('comment','comment')=>array('index'),
	Yii::t('comment','commentcreate'),
);

$this->menu=array(
	array('label'=>Yii::t('comment','commentlist'), 'url'=>array('index')),
	array('label'=>Yii::t('comment','commentmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('comment','commentcreate');?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>