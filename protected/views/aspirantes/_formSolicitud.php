<style type="text/css">
input[type="radio"], input[type="radio"]+label {
    display: inline-block;
}
input[type="radio"] {
  margin-left: 15px;
}
.hidden{
    display: none;
}
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'aspirantes-form',
    'enableAjaxValidation'=>false,
));

$htmlOptions=array('separator'=>'')
?>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos Personales</a></li>
    <li role="presentation"><a href="#direccion" aria-controls="direccion" role="tab" data-toggle="tab">Dirección</a></li>
    <li role="presentation"><a href="#documentacion" aria-controls="documentacion" role="tab" data-toggle="tab">Documentación</a></li>
    <li role="presentation"><a href="#pasatiempos" aria-controls="pasatiempos" role="tab" data-toggle="tab">Pasatiempos</a></li>
    <li role="presentation"><a href="#escolaridad" aria-controls="escolaridad" role="tab" data-toggle="tab">Escolaridad</a></li>
    <li role="presentation"><a href="#habilidades" aria-controls="habilidades" role="tab" data-toggle="tab">Habilidades</a></li>
    <li role="presentation"><a href="#trabajos" aria-controls="trabajos" role="tab" data-toggle="tab">Trabajos anteriores</a></li>
    <li role="presentation"><a href="#referencias" aria-controls="referencias" role="tab" data-toggle="tab">Referencias personales</a></li>
    <li role="presentation"><a href="#extra" aria-controls="extra" role="tab" data-toggle="tab">Información extra</a></li>
    <li role="presentation"><a href="#residencia" aria-controls="residencia" role="tab" data-toggle="tab">Lugar de Residencia</a></li>
    <li role="presentation"><a href="#deudas" aria-controls="deudas" role="tab" data-toggle="tab">Deudas</a></li>
  </ul>

  <br>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="datos">
        <div class="form-group">
            <?php echo $form->labelEx($model,'foto'); ?>
            <?php echo $form->textField($model,'foto',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'foto'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'nombre'); ?>
            <?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'nombre'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
            <?php echo $form->textField($model,'fecha_nacimiento',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'fecha_nacimiento'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'sexo'); ?>
            <?php echo $form->dropDownList($model, 'sexo', array('' => '(Selecciona tu género)', 1=>'Hombre', 2=>'Mujer'), array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'sexo'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'nacionalidad'); ?>
            <?php echo $form->textField($model,'nacionalidad',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'nacionalidad'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'estatura'); ?>
            <?php echo $form->textField($model,'estatura',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'estatura'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'peso'); ?>
            <?php echo $form->textField($model,'peso',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'peso'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'estado_civil'); ?>
            <?php echo $form->dropDownList($model, 'estado_civil', array('' => '(Selecciona tu estado civil)', 1=>'Soltero', 2=>'Casado', 3=>'Divorciado'), array('class'=>'form-control')); ?>      
            <?php echo $form->error($model,'estado_civil'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="direccion">
        <div class="form-group">
            <?php echo $form->labelEx($model,'calle'); ?>
            <?php echo $form->textField($model,'calle',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'calle'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'numero'); ?>
            <?php echo $form->textField($model,'numero',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'numero'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'colonia'); ?>
            <?php echo $form->textField($model,'colonia',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'colonia'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'codigo_postal'); ?>
            <?php echo $form->textField($model,'codigo_postal',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'codigo_postal'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="documentacion">
        <div class="form-group">
            <?php echo $form->labelEx($model,'curp'); ?>
            <?php echo $form->textField($model,'curp',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'curp'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'rfc'); ?>
            <?php echo $form->textField($model,'rfc',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'rfc'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'nss'); ?>
            <?php echo $form->textField($model,'nss',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'nss'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'afore'); ?>
            <?php echo $form->textField($model,'afore',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'afore'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'cartilla_militar'); ?>
            <?php echo $form->textField($model,'cartilla_militar',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'cartilla_militar'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'pasaporte'); ?>
            <?php echo $form->textField($model,'pasaporte',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'pasaporte'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'licencia'); ?>
            <?php echo $form->radioButtonList($model,'licencia',array(0=>'No', 1=>'Si')); ?>
            <?php echo $form->error($model,'licencia'); ?>
        </div>

        <div id="license" class="hidden">
            <div class="form-group">
                <?php echo $form->labelEx($model,'clase_licencia'); ?>
                <?php echo $form->textField($model,'clase_licencia',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'clase_licencia'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'numero_licencia'); ?>
                <?php echo $form->textField($model,'numero_licencia',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'numero_licencia'); ?>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="pasatiempos">
        <div class="form-group">
            <?php echo $form->labelEx($model,'deportista'); ?>
            <?php echo $form->radioButtonList($model,'deportista',array(0=>'No', 1=>'Si')); ?>
            <?php echo $form->error($model,'deportista'); ?>
        </div>

        <div id="sport" class="form-group hidden">
            <?php echo $form->labelEx($model,'deporte'); ?>
            <?php echo $form->textField($model,'deporte',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'deporte'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'club'); ?>
            <?php echo $form->textField($model,'club',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'club'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'pasatiempo'); ?>
            <?php echo $form->textField($model,'pasatiempo',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'pasatiempo'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'meta'); ?>
            <?php echo $form->textField($model,'meta',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'meta'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="escolaridad">
        <div class="form-group">
            <?php echo $form->labelEx($model,'estudio'); ?>
            <?php echo $form->textField($model,'estudio',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'estudio'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'escuela'); ?>
            <?php echo $form->textField($model,'escuela',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'escuela'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'inicio'); ?>
            <?php echo $form->textField($model,'inicio',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'inicio'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'finalizacion'); ?>
            <?php echo $form->textField($model,'finalizacion',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'finalizacion'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'titulo'); ?>
            <?php echo $form->radioButtonList($model,'titulo',array(0=>'No', 1=>'Si')); ?>
            <?php echo $form->error($model,'titulo'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="habilidades">
        <div class="form-group">
            <?php echo $form->labelEx($model,'idioma'); ?>
            <?php echo $form->textField($model,'idioma',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'idioma'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'porcentaje'); ?>
            <?php echo $form->textField($model,'porcentaje',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'porcentaje'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'funciones_oficina'); ?>
            <?php echo $form->textField($model,'funciones_oficina',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'funciones_oficina'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'maquinaria_oficina'); ?>
            <?php echo $form->textField($model,'maquinaria_oficina',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'maquinaria_oficina'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'software'); ?>
            <?php echo $form->textField($model,'software',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'software'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'otras_funciones'); ?>
            <?php echo $form->textField($model,'otras_funciones',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'otras_funciones'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="trabajos">
        <div class="form-group">
            <?php echo $form->labelEx($model,'trabajo_anterior'); ?>
            <?php echo $form->radioButtonList($model,'trabajo_anterior',array(0=>'No', 1=>'Si')); ?>
            <?php echo $form->error($model,'trabajo_anterior'); ?>
        </div>

        <div id="work" class="hidden">
            <div class="form-group">
                <?php echo $form->labelEx($model,'tiempo_trabajo'); ?>
                <?php echo $form->textField($model,'tiempo_trabajo',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'tiempo_trabajo'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'compania'); ?>
                <?php echo $form->textField($model,'compania',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'compania'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'direccion'); ?>
                <?php echo $form->textField($model,'direccion',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'direccion'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'telefono'); ?>
                <?php echo $form->textField($model,'telefono',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'telefono'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'puesto'); ?>
                <?php echo $form->textField($model,'puesto',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'puesto'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'sueldo_inicial'); ?>
                <?php echo $form->textField($model,'sueldo_inicial',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'sueldo_inicial'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'sueldo_final'); ?>
                <?php echo $form->textField($model,'sueldo_final',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'sueldo_final'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'motivo_separacion'); ?>
                <?php echo $form->textField($model,'motivo_separacion',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'motivo_separacion'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'nombre_jefe'); ?>
                <?php echo $form->textField($model,'nombre_jefe',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'nombre_jefe'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'puesto_jefe'); ?>
                <?php echo $form->textField($model,'puesto_jefe',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'puesto_jefe'); ?>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="referencias">

        <h4>Referencia #1</h4>
        <div class="form-group">
            <?php echo $form->labelEx($model,'nombre_ref1'); ?>
            <?php echo $form->textField($model,'nombre_ref1',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'nombre_ref1'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'domicilio_ref1'); ?>
            <?php echo $form->textField($model,'domicilio_ref1',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'domicilio_ref1'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'telefono_ref1'); ?>
            <?php echo $form->textField($model,'telefono_ref1',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'telefono_ref1'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'ocupacion_ref1'); ?>
            <?php echo $form->textField($model,'ocupacion_ref1',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'ocupacion_ref1'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'tiempo_ref1'); ?>
            <?php echo $form->textField($model,'tiempo_ref1',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'tiempo_ref1'); ?>
        </div>

        <h4>Referencia #2</h4>
        <div class="form-group">
            <?php echo $form->labelEx($model,'nombre_ref2'); ?>
            <?php echo $form->textField($model,'nombre_ref2',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'nombre_ref2'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'domicilio_ref2'); ?>
            <?php echo $form->textField($model,'domicilio_ref2',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'domicilio_ref2'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'telefono_ref2'); ?>
            <?php echo $form->textField($model,'telefono_ref2',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'telefono_ref2'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'ocupacion_ref2'); ?>
            <?php echo $form->textField($model,'ocupacion_ref2',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'ocupacion_ref2'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'tiempo_ref2'); ?>
            <?php echo $form->textField($model,'tiempo_ref2',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'tiempo_ref2'); ?>
        </div>

        <h4>Referencia #3</h4>
        <div class="form-group">
            <?php echo $form->labelEx($model,'nombre_ref3'); ?>
            <?php echo $form->textField($model,'nombre_ref3',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'nombre_ref3'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'domicilio_ref3'); ?>
            <?php echo $form->textField($model,'domicilio_ref3',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'domicilio_ref3'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'telefono_ref3'); ?>
            <?php echo $form->textField($model,'telefono_ref3',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'telefono_ref3'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'ocupacion_ref3'); ?>
            <?php echo $form->textField($model,'ocupacion_ref3',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'ocupacion_ref3'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'tiempo_ref3'); ?>
            <?php echo $form->textField($model,'tiempo_ref3',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'tiempo_ref3'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="extra">
        <div class="form-group">
            <?php echo $form->labelEx($model,'parientes'); ?>
            <?php echo $form->textField($model,'parientes',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'parientes'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'afianzado'); ?>
            <?php echo $form->textField($model,'afianzado',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'afianzado'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'sindicato'); ?>
            <?php echo $form->textField($model,'sindicato',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'sindicato'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'seguro_vida'); ?>
            <?php echo $form->textField($model,'seguro_vida',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'seguro_vida'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'viajar'); ?>
            <?php echo $form->textField($model,'viajar',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'viajar'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'cambiar_residencia'); ?>
            <?php echo $form->textField($model,'cambiar_residencia',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'cambiar_residencia'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'otros_ingresos'); ?>
            <?php echo $form->textField($model,'otros_ingresos',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'otros_ingresos'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'importe_ingresos'); ?>
            <?php echo $form->textField($model,'importe_ingresos',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'importe_ingresos'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'conyuge_trabaja'); ?>
            <?php echo $form->textField($model,'conyuge_trabaja',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'conyuge_trabaja'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'percepcion'); ?>
            <?php echo $form->textField($model,'percepcion',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'percepcion'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="residencia">
        <div class="form-group">
            <?php echo $form->labelEx($model,'casa_propia'); ?>
            <?php echo $form->textField($model,'casa_propia',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'casa_propia'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'valor_casa'); ?>
            <?php echo $form->textField($model,'valor_casa',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'valor_casa'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'paga_renta'); ?>
            <?php echo $form->textField($model,'paga_renta',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'paga_renta'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'renta'); ?>
            <?php echo $form->textField($model,'renta',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'renta'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'dependientes'); ?>
            <?php echo $form->textField($model,'dependientes',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'dependientes'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'automovil'); ?>
            <?php echo $form->textField($model,'automovil',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'automovil'); ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="deudas">
        <div class="form-group">
            <?php echo $form->labelEx($model,'deudas'); ?>
            <?php echo $form->textField($model,'deudas',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'deudas'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'importe_deudas'); ?>
            <?php echo $form->textField($model,'importe_deudas',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'importe_deudas'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'acreedor'); ?>
            <?php echo $form->textField($model,'acreedor',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'acreedor'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'abono_mensual'); ?>
            <?php echo $form->textField($model,'abono_mensual',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'abono_mensual'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'gastos_mensuales'); ?>
            <?php echo $form->textField($model,'gastos_mensuales',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'gastos_mensuales'); ?>
        </div>
    </div>
  </div>

</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Actualizar',array('class'=>'btn-enviar bttn-largo bttn-red')); ?><br><br>
    </div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $("input[id='aspirantes_licencia_0']").click(function(){
        jQuery('#license').addClass('hidden');
    });
    $("input[id='aspirantes_licencia_1']").click(function(){
        jQuery('#license').removeClass('hidden');
    });

    $("input[id='aspirantes_deportista_0']").click(function(){
        jQuery('#sport').addClass('hidden');
    });
    $("input[id='aspirantes_deportista_1']").click(function(){
        jQuery('#sport').removeClass('hidden');
    });

    $("input[id='aspirantes_trabajo_anterior_0']").click(function(){
        jQuery('#work').addClass('hidden');
    });
    $("input[id='aspirantes_trabajo_anterior_1']").click(function(){
        jQuery('#work').removeClass('hidden');
    });

    
    
    $('#myTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })

</script>