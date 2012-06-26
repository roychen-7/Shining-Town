<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_name')); ?>:</b>
	<?php echo CHtml::encode($data->product_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_introduce')); ?>:</b>
	<?php echo CHtml::encode($data->product_introduce); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_mark')); ?>:</b>
	<?php echo CHtml::encode($data->product_mark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_create_time')); ?>:</b>
	<?php echo CHtml::encode($data->product_create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_marked_times')); ?>:</b>
	<?php echo CHtml::encode($data->product_marked_times); ?>
	<br />


</div>