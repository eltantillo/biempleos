<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/empresas.js');
?>

<h1>Cambiar Contraseña</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cambiar-password-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass'=>'error has-error has-feedback',
        'successCssClass'=>'success has-success has-feedback',
        'afterValidateAttribute'=>"js:
        function(){
            if($('div.form-group > span').hasClass('glyphicon')) 
                $('div.form-group > span:not(div.new > span)').removeAttr('class');
                
            if($('div.form-group:not(div.password)').hasClass('success')) 
                $('div.success > span:not(div.new > span)').addClass('glyphicon glyphicon-ok form-control-feedback');
                
            if($('div.form-group').hasClass('error')) 
                $('div.error > span').addClass('glyphicon glyphicon-remove form-control-feedback');
        }",
	),
));
?>

	<div class="form-group old">
		<?php echo $form->labelEx($usuario,'oldPassword',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($usuario,'oldPassword',array('maxlength'=>32,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'oldPassword',array('class'=>'errorMessage')); ?>
    </div>
    
    <div class="form-group new">
        <?php echo $form->labelEx($usuario,'newPassword',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($usuario,'newPassword',array('maxlength'=>32,'class'=>'form-control')); ?>
        <span></span>
    </div>
    <div class="form-group">
        <?php echo $form->error($usuario,'newPassword',array('class'=>'errorMessage')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($usuario,'repeatPassword',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($usuario,'repeatPassword',array('maxlength'=>32,'class'=>'form-control')); ?>
        <span></span>
    </div>
    <div class="form-group">
        <?php echo $form->error($usuario,'repeatPassword',array('class'=>'errorMessage')); ?>
    </div>
    
	<div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <?php echo CHtml::submitButton('Cambiar Contraseña',array('class'=>'btn-enviar bttn-largo bttn-red')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
