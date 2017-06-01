<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/empresas.js');
$cs->registerCssFile($baseUrl.'/css/empresas.css');

$empresa = Yii::app()->user->empresa;
$usuario = Yii::app()->user->usuario;
$vacantes = vacantes::model()->findAllByAttributes(array('id_empresa'=>$empresa->id, 'fecha_finalizacion'=>null));
$localidades = localidades::model()->findAllByAttributes(array('id_empresa'=>$empresa->id));
?>
<!-- Modal -->
<div class="modal fade" id="temporaryModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="temporaryModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                ¿Estas seguro que quieres finalizar la busqueda de aspirantes de esta vacante?
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="btn btn-primary" data-dismiss="modal">Finalizar</button>
                <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
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
                <div id="vacantes" class="panel-collapse collapse in" style="max-height:400px">
                    <div id="lista_vacante" class="list-group">
                        <?php if($vacantes): ?>
                        <?php foreach($vacantes as $v): ?>
                        <?php $local = localidades::model()->findByPk($v->id_localidad); ?>
                        <div class="panel relative collapse in">
                            <a data-toggle="collapse" data-parent="#lista_vacante" href="#vacante<?php echo $v->id; ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?php echo $v->puesto; ?></h4>
                                <p class="list-group-item-text"><?php echo $v->activa ? "Habilitado":"Deshabilitado"; ?></p>
                            </a>
                            <button class="btn btn-danger btn-top-right" data-item="#vacante<?php echo $v->id; ?>" data-toggle="modal" data-target="#temporaryModal" data-url="<?php echo Yii::app()->createUrl('vacantes/activo', array('id'=>$v->id)); ?>" data-action="<?php echo $v->activa ? "deshabilitar":"habilitar"; ?>"><?php echo $v->activa ? "Deshabilitar":"Habilitar"; ?></button>
                            
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
                                    ?>
                                    <?php if($v->activa): ?>
                                    <button class="btn btn-danger" data-item="#vacante<?php echo $v->id; ?>" data-toggle="modal" data-target="#temporaryModal" data-url="<?php echo Yii::app()->createUrl('vacantes/finalizar', array('id'=>$v->id)); ?>" data-action="finalizar">Finalizar</button><br>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="loading out">
                                <div>
                                    <span class="glyphicon glyphicon-refresh"></span> Cargando...
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
                        <a data-toggle="collapse" href="#lista_locales">Localidades</a>
                        <?php echo CHtml::link("<span class='glyphicon glyphicon-plus'></span>",array('localidades/create'),array('class'=>'panel-agregar')); ?>
                    </h4>
                </div>
                <div id="lista_locales" class="list-group" style="max-height:300px">
                    <?php if($localidades): ?>
                    <?php foreach($localidades as $local): ?>
                    <div class="panel relative">
                        <a data-toggle="collapse" data-parent="#lista_locales" href="#local<?php echo $local->id; ?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?php echo "$local->calle #$local->numero, $local->colonia CP: $local->codigo_postal"; ?></h4>
                            <p class="list-group-item-text"><?php echo $local->activa ? "Habilitado":"Deshabilitado"; ?></p>
                        </a>
                        <div id="local<?php echo $local->id; ?>" class="relative collapse">
                            <div class="btn-group btn-group-justified">
                                <a href="#" class="btn btn-danger" data-item="#local<?php echo $local->id; ?>" data-toggle="modal" data-target="#temporaryModal" data-url="<?php echo Yii::app()->createUrl('localidades/activo', array('id'=>$local->id)); ?>" data-action="<?php echo $local->activa ? "deshabilitar":"habilitar"; ?>"><?php echo $local->activa ? "Deshabilitar":"Habilitar"; ?></a>
                                <?php echo CHtml::link('Editar', array('localidades/update', 'id'=>$local->id), array('class'=>'btn btn-success')); ?>
                            </div>
                        </div>
                        <div class="loading out">
                            <div>
                                <span class="glyphicon glyphicon-refresh"></span> Cargando...
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