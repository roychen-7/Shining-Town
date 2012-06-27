<?php
$this->breadcrumbs=array(
	Yii::t('product','product')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('product','productlist'), 'url'=>array('index')),
	array('label'=>Yii::t('product','productcreate'), 'url'=>array('create')),
	array('label'=>Yii::t('product','productupdate'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('product','productdelete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('product','productmanager'), 'url'=>array('admin')),
);
?>

<h2><?=$model->product_name; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'product_name',
		'product_introduce',
		'product_mark',
		'product_create_time',
		'product_marked_times',
		'mask_photo_id',
	),
)); 

echo '<div class="view">';

foreach($photos as $photo)
{
	echo '<div class="view">';
	echo ($photo->id === $model->mask_photo_id)? Yii::t('product','front(can not be deleted)').'<br />':'';
	echo CHtml::image(Yii::app()->baseUrl.'/images/photos/'.$model->product_id.'/'.$photo->photo_name,'',array('width'=>'200px','height'=>'150px')).'<br />'; 
	echo ($photo->id !== $model->mask_photo_id)?CHtml::ajaxButton(Yii::t('product','delete'), '#', array(),array('submit'=>array('deletePhoto','id'=>$photo->id,'modelId'=>$model->id))):'';
	echo ($photo->id !== $model->mask_photo_id)?CHtml::ajaxButton(Yii::t('product','setthefront'), '#', array(),array('submit'=>array('setThumbnail','id'=>$photo->id,'modelId'=>$model->id))):'';
	echo '</div>';
}
echo '</div>';
echo '<br />';
echo '<h2>',Yii::t('product','comments'),'</h2>';


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$comments->getCommentsByProductId($model->product_id),
	'filter'=>$comments,
	'columns'=>array(
		'id',
		'product_id',
		'text',
		'create_time',
		'contact_method',
		'amazing_level',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/product/deleteComment", array("id" => $data->id))',
		),
	),
)); 

?>
