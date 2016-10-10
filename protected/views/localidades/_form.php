<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'localidades-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass'=>'error has-error has-feedback',
        'successCssClass'=>'success has-success has-feedback',
        'afterValidateAttribute'=>"js:
        function(){
            if($('div.form-group > span').hasClass('glyphicon')) 
                $('div.form-group > span').removeAttr('class');
                
            if($('div.form-group').hasClass('success')) 
                $('div.success > span').addClass('glyphicon glyphicon-ok form-control-feedback');
                
            if($('div.form-group').hasClass('error')) 
                $('div.error > span').addClass('glyphicon glyphicon-remove form-control-feedback');
        }",
	),
)); ?>

	<p class="note">Los campos marcados son <span class="required">*</span> son obligatorios.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'calle'); ?>
        <?php echo $form->textField($model,'calle',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'calle',array('class'=>' errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'numero'); ?>
        <?php echo $form->numberField($model,'numero',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
		<?php echo $form->error($model,'numero',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'colonia'); ?>
        <?php echo $form->textField($model,'colonia',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'colonia',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'codigo_postal'); ?>
        <?php echo $form->numberField($model,'codigo_postal',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'codigo_postal',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pais'); ?>
        <?php echo $form->dropDownList($model,'pais',array(1=>'México'),array('class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'pais',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'estado'); ?>
        <?php echo $form->dropDownList($model,'estado',array(1=>'Chihuahua'),array('class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'estado',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ciudad'); ?>
        <?php echo $form->dropDownList($model,'ciudad',array(1=>'Cd. Juárez'),array('class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'ciudad',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group buttons">
        <div class="col-md-4 col-md-offset-4">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar',array('class'=>'btn-enviar bttn-largo bttn-red')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
