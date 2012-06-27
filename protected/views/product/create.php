<?php
$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	Yii::t('product','productcreate'),
);

$this->menu=array(
	array('label'=>Yii::t('product','productlist'), 'url'=>array('index')),
	array('label'=>Yii::t('product','productmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('product','productcreate')?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>