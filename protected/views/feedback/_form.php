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

echo CHtml::image(Yii::app()->baseUrl.'/images/feedback/'.$model->order_id.'/feedback.png','',array('width'=>'200px','height'=>'200px')); 

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
		<?php echo ($model->dealed === 2)?CHtml::submitButton(Yii::t('feedback','deal')) : CHtml::submitButton(Yii::t('feedback','deal again')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->