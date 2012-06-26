<?php

$step = '';

switch($sid)
{
case 2:
	$step = '二';
	break;
case 3:
	$step = '三';
	break;
case 4:
	$step = '四';
	break;
case 5:
	$step = '五';
	break;
case 6:
	$step = '六';
	break;
case 7:
	$step = '七';
	break;
}

$this->breadcrumbs=array(
	'订单'=>array('index'),
	'步骤'.$step,
);

$this->menu=array(
	array('label'=>yii::t('order','ordercreate'), 'url'=>array('index')),
	array('label'=>yii::t('order','ordermanager'), 'url'=>array('admin')),
);
?>

<h2>创建订单</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model,'sid'=>$sid)); ?>