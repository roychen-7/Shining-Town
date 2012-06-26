<?php
$this->breadcrumbs=array(
	Yii::t('order','order'),
);

if(Yii::app()->user->isAdmin)
{
	$this->menu=array(
		array('label'=>Yii::t('order','ordermanager'), 'url'=>array('admin')),
	);
}

?>

<h2><?=Yii::t('order','order');?></h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_orderState',
)); ?>
