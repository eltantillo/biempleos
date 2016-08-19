<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresas-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    ),
)); ?>

	<p class="note">Los campos marcados son <span class="required">*</span> son obligatorios.</p>

	<?php /*echo $form->errorSummary(array($empresa,$usuario));*/ ?>
    <?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($empresa,'nombre',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->textField($empresa,'nombre',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($empresa,'nombre',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($usuario,'usuario',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->textField($usuario,'usuario',array('size'=>60,'maxlength'=>16,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'usuario',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($usuario,'contrasena',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->passwordField($usuario,'contrasena',array('size'=>60,'maxlength'=>32,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'contrasena',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>
    
    <div class="form-group v-center1">
        <?php echo $form->labelEx($usuario,'repeatPassword',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->passwordField($usuario,'repeatPassword',array('size'=>60,'maxlength'=>32,'class'=>'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->error($usuario,'repeatPassword',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>
    
    <div class="row">
        Aqui va PAYPAL
    </div>
    
	<div class="form-group buttons v-center1">
        <div class="col-sm-offset-4 col-sm-6">
            <?php echo CHtml::submitButton($empresa->isNewRecord ? 'Registrar' : 'Actualizar',array('class'=>'btn btn-default')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
