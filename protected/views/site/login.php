<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

/*$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
    'enableAjaxValidation'=>true,
    'action' => $this->createUrl('site/login'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->emailField($model,'username', array('placeholder'=>'Correo', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->passwordField($model,'password', array('placeholder'=>'Contraseña', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe checkbox v-center1">
		<label class="col-xs-5">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <!--?php echo $form->label($model,'rememberMe'); ?-->
            Recordarme
            <?php echo $form->error($model,'rememberMe'); ?>
        </label>
        <div class="col-xs-7 text-right">
            <?php echo CHtml::link('Olvide mi contraseña',array('site/recover')); ?>
        </div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Iniciar Sesión', array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
