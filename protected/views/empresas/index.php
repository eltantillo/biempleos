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
$vacantes = vacantes::model()->findAllByAttributes(array('id_empresa'=>$empresa->id, 'activa'=>true));
$localidades = localidades::model()->findAllByAttributes(array('id_empresa'=>$empresa->id, 'activa'=>true));
?>
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
                <div id="vacantes" class="panel-collapse collapse in table-responsive">
                    <table class="table table-striped">
                        <script>
                            function mifuncion(obj) {
                                if(obj.classList.contains('glyphicon-expand'))
                                    obj.setAttribute("class","glyphicon glyphicon-collapse-down");
                                else if(obj.classList.contains('glyphicon-collapse-down'))
                                    obj.setAttribute("class","glyphicon glyphicon-expand");
                            }
                        </script>
                            <?php
                            if($vacantes) {
                                echo "<thead><tr><th>Puesto</th><th>Publicación</th></tr></thead><tbody>";
                                foreach($vacantes as $v) {
                                    $local = localidades::model()->findByPk($v->id_localidad);
                                    echo "<tr><td><span class='glyphicon glyphicon-expand' data-toggle='collapse' data-target='#collapse".$v->id."' onclick='mifuncion(this)'></span> " . CHtml::link($v->puesto, array('vacantes/view', 'id'=>$v->id), array('class'=>'prueba')) . "</td>";
                                    echo "<td>$v->fecha_publicacion</td>";
                                    echo "<td>" . CHtml::link("<span class='glyphicon glyphicon-edit'></span>", array('vacantes/update', 'id'=>$v->id)) . "</td></tr>";
                                    echo "<tr id='collapse".$v->id."' class='collapse'>
                                            <td colspan='3' class='info-vacante'>
                                                <div class='row'>
                                                    <label class='col-sm-5'>Sueldo</label>
                                                    <span class='col-sm-7'>$$v->sueldo.00</span>
                                                </div>
                                                <div class='row'>
                                                    <label class='col-sm-5'>Localidad</label>
                                                    <span class='col-sm-7'>$local->calle #$local->numero, $local->colonia CP: $local->codigo_postal</span>
                                                </div>
                                                <div class='row'>
                                                    <label class='col-sm-5'>Requisitos</label>
                                                    <span class='col-sm-7'>$v->requisitos</span>
                                                </div>
                                                <div class='row'>
                                                    <label class='col-sm-5'>Ofrecimiento</label>
                                                    <span class='col-sm-7'>$v->ofrece</span>
                                                </div>
                                                <div class='row'>
                                                    <label class='col-sm-5'>Disponibilidad</label>
                                                    <span class='col-sm-7'>".($v->disponibilidad ? "Si":"No")."</span>
                                                </div>
                                            </td>
                                          </tr>";
                                }
                                echo "</tbody>";
                            } else {
                                echo "<tbody><tr><td>No hay vacantes</td><tr></tbody>";
                            }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#historial">Perfil</a>
                    </h4>
                </div>
                <div id="historial" class="panel-collapse collapse in">
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
                <div id="localidades" class="panel-collapse collapse in table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            if($localidades) {
                                foreach($localidades as $local) {
                                    echo "<tr><td>$local->calle #$local->numero, $local->colonia CP: $local->codigo_postal</td>";
                                    echo "<td>" . CHtml::link("<span class='glyphicon glyphicon-edit'></span>", array('localidades/update', 'id'=>$local->id)) . "</td></tr>";
                                }
                            } else {
                                echo "<tr><td>No hay localidades</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#historial">Historial</a>
                    </h4>
                </div>
                <div id="historial" class="panel-collapse collapse in">
                    <div class="panel-body">Historial Pendiente</div>
                </div>
            </div>
        </div>
    </div>
</div>