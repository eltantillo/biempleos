<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresas-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Los campos marcados son <span class="required">*</span> son obligatorios.</p>

	<?php /*echo $form->errorSummary(array($empresa,$usuario));*/ ?>
    <?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>

	<div class="form-group">
		<?php echo $form->labelEx($empresa,'nombre'); ?>
        <?php echo $form->textField($empresa,'nombre',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($empresa,'nombre',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($usuario,'usuario'); ?>
        <?php echo $form->textField($usuario,'usuario',array('size'=>60,'maxlength'=>16,'class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'usuario',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($usuario,'contrasena'); ?>
        <?php echo $form->passwordField($usuario,'contrasena',array('size'=>60,'maxlength'=>32,'class'=>'form-control')); ?>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'contrasena',array('class'=>'errorMessage')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($usuario,'repeatPassword'); ?>
        <?php echo $form->passwordField($usuario,'repeatPassword',array('size'=>60,'maxlength'=>32,'class'=>'form-control')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->error($usuario,'repeatPassword',array('class'=>'errorMessage')); ?>
    </div>
    
    <div class="form-group">
        Aqui va PAYPAL
    </div>
    
    <?php if($empresa->isNewRecord): ?>
    <div class="checkbox required">
        <label><input type="checkbox"> He leido los <a href="#">terminos y condiciones</a> y la <a href="#">politica de privacidad</a> de BIE<span class="required">*</span></label>
    </div>
    <?php endif; ?>
    <br>
	<div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <?php echo CHtml::submitButton($empresa->isNewRecord ? 'Enviar' : 'Actualizar',array('class'=>'btn-enviar bttn-largo bttn-red')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
