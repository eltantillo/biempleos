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
    'action' => $this->createUrl('site/postrecover'),
)); ?>

	<div class="form-group col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
		<?php echo $form->emailField($model,'usuario', array('placeholder'=>'Correo', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>
    <div class="clearfix"></div>
	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4 col-lg-offset-5 col-lg-2">
            <?php echo CHtml::submitButton('Enviar', array('class'=>'btn-enviar bttn-normal bttn-red')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->