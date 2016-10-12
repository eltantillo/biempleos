<?php
/*$this->breadcrumbs=array(
	'Perfil Empresa',
);

$this->menu=array(
	array('label'=>'Create localidades', 'url'=>array('create')),
	array('label'=>'Manage localidades', 'url'=>array('admin')),
);
?>

<h1>Perfil</h1>
<p>Nombre de la Empresa: <?php echo $empresa->nombre; ?></p>
<?php echo CHtml::link("Cambiar contraseñal", array("empresas/actualizar"), array("class"=>"btn btn-default")); ?>
<div id="psw panel panel-info hidden"></div>
<br>
<?php echo CHtml::link("Añadir Local", array("localidades/create"), array("class"=>"btn btn-default pull-right"))?>
<div class="clearfix"></div>
<div class="panel panel-primary">
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'locales-grid',
        'summaryText'=>'Mostrando {start}-{end} de {count} resultados',
        //'ajaxUrl' => $this->createUrl('buscador'),
        //'cssFile' => Yii::app()->baseUrl . '/css/gridView.css',
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'header'=>'Calle',
                'name' => 'calle',
                'value' => 'CHtml::encode($data->calle)'
            ),
            array(
                'header'=>'Numero',
                'name' => 'numero',
                'value' => 'CHtml::encode($data->numero)'
            ),
            array(
                'header'=>'Colonia',
                'name' => 'colonia',
                'value' => 'CHtml::encode($data->colonia)'
            ),
            array(
                'header'=>'Codigo Postal',
                'name' => 'codigo_postal',
                'value' => 'CHtml::encode($data->codigo_postal)'
            ),
            array(
                'header'=>'País',
                'name' => 'pais',
                'value' => 'CHtml::encode($data->pais)'
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{delete}',
                'buttons'=>array(
                    'delete' => array(
                        'label'=>'Borrar',
                        //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                        'url'=>'Yii::app()->createUrl("localidades/delete", array("id"=>$data->id))',
                    ),
                ),
            ),
        ),
    ));
?>
</div>*/
$empresa = Yii::app()->user->empresa;
$usuario = Yii::app()->user->usuario;
$vacantes = vacantes::model()->findAllByAttributes(array('id_empresa'=>$empresa->id));
$localidades = localidades::model()->findAllByAttributes(array('id_empresa'=>$empresa->id));
?>
<script>
$(document).ready(function() {
    $('#lista_vacante, #lista_locales').on('show.bs.collapse', function(e) {
        $(e.target).prevUntil('.panel','.list-group-item').addClass('active');
    }).on('hide.bs.collapse', function(e) {
        $(e.target).prevUntil('.panel','.list-group-item').removeClass('active');
    });
});
</script>
<h1>Inicio</h1>
<div class="row">
    <div class="col-sm-7">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#vacantes">Vacantes</a>
                        <?php echo CHtml::link("<span class='glyphicon glyphicon-plus'></span>",array('vacantes/create'),array('class'=>'panel-agregar')); ?>
                    </h4>
                </div>
                <div id="vacantes" class="panel-collapse collapse in">
                    <div id="lista_vacante" class="list-group">
                        <?php if($vacantes): ?>
                        <?php foreach($vacantes as $v): ?>
                        <?php $local = localidades::model()->findByPk($v->id_localidad); ?>
                        <div class="panel relative">
                            <a data-toggle="collapse" data-parent="#lista_vacante" href="#vacante<?php echo $v->id; ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?php echo $v->puesto; ?></h4>
                                <p class="list-group-item-text"><?php echo $v->activa ? "Habilitado":"Deshabilitado"; ?></p>
                            </a>
                            <a href="#" class="btn btn-danger btn-top-right">Deshabilitar</a>
                            <div id="vacante<?php echo $v->id; ?>" class="relative collapse">
                                <dl>
                                    <dt>Sueldo</dt>
                                    <dd>$<?php echo $v->sueldo; ?>.00</dd>
                                    <dt>Localidad</dt>
                                    <dd><?php echo "$local->calle #$local->numero, $local->colonia CP: $local->codigo_postal"; ?></dd>
                                    <dt>Requisitos</dt>
                                    <dd><?php echo $v->requisitos; ?></dd>
                                    <dt>Ofrecimiento</dt>
                                    <dd><?php echo $v->ofrece; ?></dd>
                                    <dt>Disponibilidad</dt>
                                    <dd><?php echo $v->disponibilidad ? "Si":"No"; ?></dd>
                                </dl>
                                <div class="btn-top-right">
                                    <?php
                                    if($v->activa)
                                        echo CHtml::link('Ver Aspirantes',array('vacantes/view', 'id'=>$v->id), array('class'=>'btn btn-primary')) . "<br>";
                                    echo CHtml::link('Editar',array('vacantes/update', 'id'=>$v->id), array('class'=>'btn btn-success')) . "<br>";
                                    if($v->activa)
                                        echo CHtml::link('Finalizar',array('vacantes/finalizar', 'id'=>$v->id), array('class'=>'btn btn-danger', 'confirm'=>'¿Seguro que quieres finalizar la busqueda de aspirantes para esta vacante?')) . "<br>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p class="list-group-item list-group-item-text text-center">Agrega alguna vacante</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#perfil">Perfil</a>
                    </h4>
                </div>
                <div id="perfil" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="hidden-xs">
                            <?php
                            echo "<strong>Empresa</strong><br>$empresa->nombre<br>";
                            echo "<strong>Correo</strong><br>$usuario->usuario<br>";
                            echo "<strong>Contraseña</strong><br>" . CHtml::link('Cambiar Contraseña', array('empresas/actualizar', 'id'=>$empresa->id), array('btn btn-link')) . "<br>";
                            echo "<strong>Vencimiento</strong><br>$empresa->activa<br>";
                            echo "<a href='#' class='btn btn-link col-md-12 col-md-offset-0 col-sm-offset-2 col-sm-8'>Renovar suscripción</a>";
                            ?>
                        </div>
                        <div class="visible-xs-inline-block">
                            <?php
                            echo "<strong>Empresa</strong><br>$empresa->nombre<br>";
                            echo "<strong>Correo</strong><br>$usuario->usuario<br>";
                            echo "<strong>Contraseña</strong><br>" . CHtml::link('Cambiar Contraseña', array('empresas/actualizar', 'id'=>$empresa->id), array('btn btn-link')) . "<br>";
                            echo "<strong>Vencimiento</strong><br>$empresa->activa<br>";
                            ?>
                        </div>
                        <?php echo "<a href='#' class='btn btn-link pull-right visible-xs-inline-block'>Renovar suscripción</a>"; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#localidades">Localidades</a>
                        <?php echo CHtml::link("<span class='glyphicon glyphicon-plus'></span>",array('localidades/create'),array('class'=>'panel-agregar')); ?>
                    </h4>
                </div>
                <div id="lista_locales" class="list-group">
                    <?php if($localidades): ?>
                    <?php foreach($localidades as $local): ?>
                    <div class="panel relative">
                        <a data-toggle="collapse" data-parent="#lista_locales" href="#local<?php echo $local->id; ?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?php echo "$local->calle #$local->numero, $local->colonia CP: $local->codigo_postal"; ?></h4>
                            <p class="list-group-item-text"><?php echo $local->activa ? "Habilitado":"Deshabilitado"; ?></p>
                        </a>
                        <div id="local<?php echo $local->id; ?>" class="relative collapse">
                            <div class="btn-group btn-group-justified">
                                <a href="#" class="btn btn-danger">Deshabilitar</a>
                                <a href="#" class="btn btn-success">Editar</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="list-group-item list-group-item-text text-center">No hay locales registrados</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#historial">Historial</a>
                    </h4>
                </div>
                <div id="historial" class="panel-collapse collapse in">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <p class="list-group-item-text"><span class="glyphicon glyphicon-new-window"></span> Ver historial de vacantes</p>
                        </a>
                        <a href="#" class="list-group-item">
                            <p class="list-group-item-text"><span class="glyphicon glyphicon-new-window"></span> Ver historial de aspirantes</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>