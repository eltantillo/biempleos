<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vacantes-form',
	'enableAjaxValidation'=>false,
));

$localidadesArray = array();

foreach ($localidades as $localidad) {
	$localidadesArray[$localidad->id] = $localidad->calle . " #" . $localidad->numero . " " . $localidad->colonia . " C.P. " . $localidad->codigo_postal;
}

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_localidad'); ?>
		<?php echo $form->dropDownList($model, 'id_localidad', $localidadesArray, array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'id_localidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'puesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sueldo'); ?>
		<?php echo $form->textField($model,'sueldo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'sueldo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ofrece'); ?>
		<?php echo $form->textArea($model,'ofrece',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ofrece'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requisitos'); ?>
		<?php echo $form->textArea($model,'requisitos',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'requisitos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disponibilidad'); ?>
		<?php echo $form->textField($model,'disponibilidad',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'disponibilidad'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->