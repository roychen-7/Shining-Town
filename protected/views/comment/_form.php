<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_method'); ?>
		<?php echo $form->textField($model,'contact_method',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_attitude'); ?>
		<?php echo $form->textField($model,'service_attitude').' (1~5)'; ?>
		<?php echo $form->error($model,'service_attitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery_speed'); ?>
		<?php echo $form->textField($model,'delivery_speed').' (1~5)'; ?>
		<?php echo $form->error($model,'delivery_speed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->