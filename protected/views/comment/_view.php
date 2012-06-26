<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->text), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_attitude')); ?>:</b>
	<?php echo CHtml::encode($data->service_attitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_speed')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_speed); ?>
	<br />


</div>