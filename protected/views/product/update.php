<?php
$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('product','productupdate'),
);

$this->menu=array(
	array('label'=>Yii::t('product','productlist'), 'url'=>array('index')),
	array('label'=>Yii::t('product','productcreate'), 'url'=>array('create')),
	array('label'=>Yii::t('product','productdetail'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('product','productmanager'), 'url'=>array('admin')),
);
?>

<h2><?=Yii::t('product','productupdate'),' ',$model->product_name;?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>