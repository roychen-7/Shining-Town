<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_introduce'); ?>
		<?php echo $form->textField($model,'product_introduce',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_mark'); ?>
		<?php echo $form->textField($model,'product_mark'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_create_time'); ?>
		<?php echo $form->textField($model,'product_create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_marked_times'); ?>
		<?php echo $form->textField($model,'product_marked_times'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->