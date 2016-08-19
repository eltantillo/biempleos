<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->id_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_localidad')); ?>:</b>
	<?php echo CHtml::encode($data->id_localidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('puesto')); ?>:</b>
	<?php echo CHtml::encode($data->puesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ofrece')); ?>:</b>
	<?php echo CHtml::encode($data->ofrece); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requisitos')); ?>:</b>
	<?php echo CHtml::encode($data->requisitos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disponibilidad')); ?>:</b>
	<?php echo CHtml::encode($data->disponibilidad); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_publicacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_publicacion); ?>
	<br />

	*/ ?>

</div>