<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'text',
		'contact_method',
		'create_time',
		'photo_name',
		'dealed_zn',
	),
));

echo '<br />';

echo CHtml::image(Yii::app()->baseUrl.'/images/feedback/'.$model->order_id.'/feedback.png','图片的说明',array('width'=>'200px','height'=>'200px')); 

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'order_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : '处理'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->