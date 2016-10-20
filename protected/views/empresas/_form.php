<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresas-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'errorCssClass'=>'error has-error has-feedback',
        'successCssClass'=>'success has-success has-feedback',
        'afterValidateAttribute'=>"js:
        function(){
            if($('div.form-group > span').hasClass('glyphicon')) 
                $('div.form-group > span:not(div.password > span)').removeAttr('class');
                
            if($('div.form-group:not(div.password)').hasClass('success')) 
                $('div.success > span:not(div.password > span)').addClass('glyphicon glyphicon-ok form-control-feedback');
                
            if($('div.form-group').hasClass('error')) 
                $('div.error > span').addClass('glyphicon glyphicon-remove form-control-feedback');
        }",
        'afterValidate'=>"js:
        function(){
            if($('div.form-group > span').hasClass('glyphicon')) 
                $('div.form-group > span:not(div.password > span)').removeAttr('class');
                
            if($('div.form-group:not(div.password)').hasClass('success')) 
                $('div.success > span:not(div.password > span)').addClass('glyphicon glyphicon-ok form-control-feedback');
                
            if($('div.form-group').hasClass('error')) 
                $('div.error > span').addClass('glyphicon glyphicon-remove form-control-feedback');
        }",
	),
)); ?>

	<p class="note">Los campos marcados son <span class="required">*</span> son obligatorios.</p>

	<?php /*echo $form->errorSummary(array($empresa,$usuario));*/ ?>

	<div class="form-group">
		<?php echo $form->labelEx($empresa,'nombre'); ?>
        <?php echo $form->textField($empresa,'nombre',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($empresa,'nombre',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group">
		<?php echo $form->labelEx($usuario,'usuario'); ?>
        <?php echo $form->emailField($usuario,'usuario',array('maxlength'=>264,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'usuario',array('class'=>'errorMessage')); ?>
    </div>

	<div class="form-group password">
		<?php echo $form->labelEx($usuario,'contrasena',array('class'=>'pull-left')); ?>
        <label class="pull-right">Mínimo 8 caracteres sin espacios</label>
        <?php echo $form->passwordField($usuario,'contrasena',array('maxlength'=>32,'class'=>'form-control')); ?>
        <span></span>
	</div>
    <div class="form-group">
        <?php echo $form->error($usuario,'contrasena',array('class'=>'errorMessage')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($usuario,'repeatPassword'); ?>
        <?php echo $form->passwordField($usuario,'repeatPassword',array('maxlength'=>32,'class'=>'form-control')); ?>
        <span></span>
    </div>
    <div class="form-group">
        <?php echo $form->error($usuario,'repeatPassword',array('class'=>'errorMessage')); ?>
    </div>
    
    <?php if($empresa->isNewRecord): ?>
    <div class="checkbox required">
        <label><input type="checkbox" name="terminos"> He leido los <a href="#">terminos y condiciones</a> y la <a href="#">politica de privacidad</a> de BIE <span class="required">*</span></label>
        <span style="position: absolute;top: -8px;left: 0;"></span>
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

<script>
$(document).ready(function() {
    
    var valid = false;
    $('div.password > input[type=password]').on('keyup paste',function(){
        $('div.password').removeClass('error has-error success has-success has-feedback');
        $('div.password > span').removeClass('glyphicon glyphicon-remove glyphicon-ok form-control-feedback');
        
        if(/^((?!.*\s)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[a-z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*[a-z])(?=.*[A-Z]).{8,})$/g.test($(this).val())) {
            $('div.password').addClass('success has-success has-feedback');
            $('div.password > span').addClass('glyphicon glyphicon-ok form-control-feedback');
            valid = true;
        } else {
            $('div.password').addClass('error has-error has-feedback');
            $('div.password > span').addClass('glyphicon glyphicon-remove form-control-feedback');
            valid = false;
        }
    });
    
    <?php if($empresa->isNewRecord): ?>
    $('input[name=terminos]').change(function(){
        $('div.checkbox').removeClass('has-error');
        $('div.checkbox > span').removeClass('glyphicon glyphicon-exclamation-sign form-control-feedback');
        valid = valid && $(this).is(':checked');
    });
    <?php endif; ?>
    
    $('#empresas-form').submit(function() {
        if(!$('input[name=terminos]').is(':checked')) {
            $('div.checkbox').addClass('has-error');
            $('div.checkbox > span').addClass('glyphicon glyphicon-exclamation-sign form-control-feedback');
        }
        return valid;
    });
});
</script>
