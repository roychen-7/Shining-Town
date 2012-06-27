<?php
$this->breadcrumbs=array(
	Yii::t('feedback','feedback')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('feedback','deal'),
);

$this->menu=array(
	array('label'=>Yii::t('feedback','feedbacklist'), 'url'=>array('index')),
	array('label'=>Yii::t('feedback','feedbackdetail'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('feedback','feedbackmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('feedback','feedbackmanager');?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>