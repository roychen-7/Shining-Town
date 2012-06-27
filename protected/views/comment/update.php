<?php
$this->breadcrumbs=array(
	Yii::t('comment','comment')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('comment','update'),
);

$this->menu=array(
	array('label'=>Yii::t('comment','commentlist'), 'url'=>array('index')),
	array('label'=>Yii::t('comment','commentcreate'), 'url'=>array('create')),
	array('label'=>Yii::t('comment','commentdetail'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('comment','commentmanager'), 'url'=>array('admin')),
);
?>

<h2><?php echo Yii::t('comment','commentupdate'),'(',Yii::t('comment','id'),' ',$model->id; ?>)</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>