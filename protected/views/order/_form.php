<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'order_id'); ?>
	</div>
	
	<div class="row">
		<?php
		
		if(isset($sid))
		{
			if($sid === '2')
			{
				echo $form->labelEx($model,'production_time');
				echo $form->dropDownList($model,'production_time',$model->getProductionTime());
				echo $form->error($model,'production_time');
			}
			elseif($sid === '6')
			{
				echo $form->labelEx($model,'express_id');
				echo $form->textField($model,'express_id',array('size'=>50,'maxlength'=>50));
				echo $form->error($model,'express_id');
			}
		}
		else
		{
			echo $form->labelEx($model,'product_id');
			echo $form->textField($model,'product_id',array('size'=>50,'maxlength'=>50));
			echo $form->error($model,'product_id');
		}
		
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '入库' : '入库'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->