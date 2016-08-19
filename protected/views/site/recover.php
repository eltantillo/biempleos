<?php
/* @var $this SiteController */
/* @var $model LoginForm//usuarios_empresas */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Recover';
$this->breadcrumbs=array(
	'Recover',
);
?>

<h1 class="text-center">¿No puedes iniciar sesión?</h1>
<p class="text-center">Si has olvidado tu contraseña ingresa tu correo para restablecerla</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recover-form',
    'enableAjaxValidation'=>false,
    //'action' => $this->createUrl('site/recover'),
)); ?>

	<div class="form-group col-xs-offset-3 col-xs-6 col-md-offset-4 col-md-4">
		<?php echo $form->emailField($model,'usuario', array('placeholder'=>'Correo', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>
    <div class="clearfix"></div>
	<div class="form-group buttons text-center">
		<?php echo CHtml::submitButton('Enviar', array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->