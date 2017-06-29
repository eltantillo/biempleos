<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
    'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="form-group">
        <input type="text" name="GCMKey" id="GCMKey" hidden="true">
	</div>

	<div class="form-group">
        <?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->emailField($model,'username', array('placeholder'=>'Correo', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
        <?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('placeholder'=>'Contraseña', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group rememberMe">
        <div class="col-xs-6">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>
        <div class="col-xs-6">
            <?php echo CHtml::link('Olvidé mi contraseña',array('site/recover'), array('class'=>'pull-right')); ?>
        </div>
        <div class="clearfix"></div>
	</div>

	<div class="form-group">
        <div class="col-xs-8">
            <?php echo CHtml::link('Registrarme como Empresa',array('empresas/registro'), array('class'=>'pull-left')); ?><br>
            <?php echo CHtml::link('Registrarme como Aspirante',array('aspirantes/registro'), array('class'=>'pull-left')); ?>
        </div>
        <div class="col-xs-4">
            <?php echo CHtml::submitButton('Iniciar Sesión', array('class'=>'btn btn-success pull-right')); ?>
        </div>
		<div class="clearfix"></div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>