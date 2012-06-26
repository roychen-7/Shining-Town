<?php
$this->breadcrumbs=array(
	Yii::t('order','ordercreate')=>array('index'),
	Yii::t('order','step').Yii::t('order','one'),
);

if(Yii::app()->user->isAdmin)
{
	$this->menu=array(
		array('label'=>Yii::t('order','ordercreate'), 'url'=>array('index')),
		array('label'=>Yii::t('order','ordermanager'), 'url'=>array('admin')),
	);
}

?>

<h2><?=Yii::t('order','ordercreate')?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>