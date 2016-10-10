<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vacantes-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass'=>'error has-error has-feedback',
        'successCssClass'=>'success has-success has-feedback',
        'afterValidateAttribute'=>"js:
        function(){
            if($('div.form-group > span').hasClass('glyphicon')) 
                $('div.form-group > span:not(div.input-group > span:first-child)').removeAttr('class');
                
            if($('div.form-group').hasClass('success')) 
                $('div.success > span:not(div.input-group > span:first-child)').addClass('glyphicon glyphicon-ok form-control-feedback');
                
            if($('div.form-group').hasClass('error')) 
                $('div.error > span:not(div.input-group > span:first-child)').addClass('glyphicon glyphicon-remove form-control-feedback');
        }",
	),
));

$localidadesArray = array();

foreach ($localidades as $localidad) {
	$localidadesArray[$localidad->id] = $localidad->calle . " #" . $localidad->numero . " " . $localidad->colonia . " C.P. " . $localidad->codigo_postal;
}

?>

	<p class="note">Los campos marcados son <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'id_localidad'); ?>
		<?php echo $form->dropDownList($model, 'id_localidad', $localidadesArray, array('class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'id_localidad',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'puesto',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sueldo'); ?>
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <?php echo $form->numberField($model,'sueldo',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <span></span>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'sueldo',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ofrece'); ?>
		<?php echo $form->textArea($model,'ofrece',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'ofrece',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'requisitos'); ?>
		<?php echo $form->textArea($model,'requisitos',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'requisitos',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'disponibilidad',array('class'=>'pull-left')); ?>
        <div class="pull-left">
            <?php echo $form->checkBox($model,'disponibilidad',array('class'=>'form-control', 'style'=>'height:17px; width:17px; margin:0px 10px;')); ?>
        </div>
        <div class="clearfix"></div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'disponibilidad',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn-enviar bttn-largo bttn-red')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->