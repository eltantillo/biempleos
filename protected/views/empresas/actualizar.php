<?php
$this->breadcrumbs=array(
	$empresa->id=>array('view','id'=>$empresa->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'List empresas', 'url'=>array('index')),
	array('label'=>'Create empresas', 'url'=>array('create')),
	array('label'=>'View empresas', 'url'=>array('view', 'id'=>$empresa->id)),
	array('label'=>'Manage empresas', 'url'=>array('admin')),
);
?>

<h1>Cambiar Contraseña <!--?php //echo $empresa->nombre; ?--></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cambiar-password-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    ),
));
    ?>

    <?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <?php endif; ?>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($usuario,'oldPassword',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->passwordField($usuario,'oldPassword',array('size'=>60,'maxlength'=>32,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'oldPassword',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>
    
    <div class="form-group v-center1">
        <?php echo $form->labelEx($usuario,'newPassword',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->passwordField($usuario,'newPassword',array('size'=>60,'maxlength'=>32,'class'=>'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->error($usuario,'newPassword',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
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
    
	<div class="form-group buttons v-center1">
        <div class="col-sm-offset-4 col-sm-6">
            <?php echo CHtml::submitButton('Cambiar Contraseña',array('class'=>'btn btn-default')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
