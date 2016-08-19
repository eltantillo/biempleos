<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'localidades-form',
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

	<?php //echo $form->errorSummary($model); ?>
    <?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'calle',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->textField($model,'calle',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'calle',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'numero',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->textField($model,'numero',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
		<?php echo $form->error($model,'numero',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'colonia',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->textField($model,'colonia',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'colonia',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'codigo_postal',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->textField($model,'codigo_postal',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'codigo_postal',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'pais',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->dropDownList($model,'pais',array('México'=>'México'),array('class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'pais',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'estado',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->dropDownList($model,'estado',array('Chihuahua'=>'Chihuahua'),array('class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'estado',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group v-center1">
		<?php echo $form->labelEx($model,'ciudad',array('class'=>'control-label col-sm-4')); ?>
        <div class="col-sm-6">
            <?php echo $form->dropDownList($model,'ciudad',array('Cd. Juarez'=>'Cd. Juárez'),array('class'=>'form-control')); ?>
        </div>
	</div>
    <div class="form-group">
        <?php echo $form->error($model,'ciudad',array('class'=>'col-sm-offset-4 col-sm-6 errorMessage')); ?>
    </div>

	<div class="form-group buttons v-center1">
        <div class="col-sm-offset-4 col-sm-6">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar',array('class'=>'btn btn-default')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
