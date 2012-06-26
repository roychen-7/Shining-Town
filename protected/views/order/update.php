<?php

$step = '';

switch($sid)
{
case 2:
	$step = Yii::t('order','two');
	break;
case 3:
	$step = Yii::t('order','three');
	break;
case 4:
	$step = Yii::t('order','four');
	break;
case 5:
	$step = Yii::t('order','five');
	break;
case 6:
	$step = Yii::t('order','six');
	break;
case 7:
	$step = Yii::t('order','seven');
	break;
}

$this->breadcrumbs=array(
	Yii::t('order','order')=>array('index'),
	Yii::t('order','step').$step,
);

$this->menu=array(
	array('label'=>yii::t('order','ordercreate'), 'url'=>array('index')),
	array('label'=>yii::t('order','ordermanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('order','ordercreate');?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model,'sid'=>$sid)); ?>