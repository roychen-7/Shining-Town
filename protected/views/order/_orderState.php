<div class="view">

	<b><?php echo CHtml::encode(CHtml::encode($data->order_state_id)); ?>:</b>
	<?php 
		echo CHtml::link(CHtml::encode($data->state_display), array(
						(($data->id==='1')?'create':'update'), 
						'sid'=>$data->id
					)); 
	?>
	<br />

</div>