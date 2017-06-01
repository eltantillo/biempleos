<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/vacantes.js');
$cs->registerCssFile($baseUrl.'/css/vacantes.css');

$lista = lista_aspirantes::model()->findAllByAttributes(
    array(
        'id_vacante'=>$model->id,
        'cita'=>null
    ),
    array('limit'=>10)
);
?>

<script type="text/javascript">
    var php = {
        urlLista: <?php echo "'" . CController::createUrl('vacantes/loadLista') . "'"; ?>,
        modelId: <?php echo $model->id; ?>,
        urlBase: <?php echo "'" . Yii::app()->request->baseUrl . "'"; ?>,
        labelAspirante: {<?php
        $labelAspirante = aspirantes::model()->attributeLabels();
        foreach($labelAspirante as $key=>$label) {
            echo "$key: '$label'";
            if(!(end($labelAspirante) == $label) && !(key($labelAspirante) == $key))
                echo ", ";
        }
        ?>}
    };
</script>

<h1>Puesto: <?php echo $model->puesto; ?></h1>

<?php if(count($lista) > 0): ?>
<div id="aspirante" class="relative modal fade" data-backdrop="static" role="dialog" aria-labelledby="aspiranteLabel">
    <div class="modal-dialog"></div>
    <span class="btn-top-right btn-close glyphicon glyphicon-remove" data-dismiss="modal"></span>
    <span class="glyphicon glyphicon-chevron-left left-slide"></span>
    <div class="slide-show">
        <div class="slide-item-group" role="document">
            <?php 
            $ids = array();
            foreach($lista as $l)
                $ids = $l->id_aspirante;
            
            $aspirante = aspirantes::model()->findAllByAttributes(
                array('id'=>$ids)
            );
            
            foreach($aspirante as $a):
            ?>
            <input class="hidden" id="altasp<?php echo $a->id; ?>" type="checkbox" value="<?php echo $a->id; ?>">
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl . "/images/" . ($a->foto ? ("fotos/" . $a->foto):"logo.png"); ?>" class="media-object" style="width:65px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $a->nombre; ?></h4>
                        <p class="list-group-item-text">
                            <?php
                            foreach($a as $key=>$datos) {
                                if($key == "nombre" || $key == "id" || $key == "foto")
                                    continue;
                                echo aspirantes::model()->getAttributeLabel("$key") . " " . $datos . "<br>";
                            }
                            ?>
                        </p>
                        <button class="btn btn-primary" type="submit" form="citar-form" name="aspirante[]" value="<?php echo $a->id; ?>">Citar</button>
                        <button class="btn btn-danger">Rechazar</button>
                        <label class="btn btn-info btn-citar" for="altasp<?php echo $a->id; ?>">Seleccionar</label>
                    </div>
                </div>
                <div class="visible-xs-block" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl . "/images/" . ($a->foto ? ("fotos/" . $a->foto):"logo.png"); ?>" class="center-block" style="width:65px">
                        <h4 class="media-heading"><?php echo $a->nombre; ?></h4>
                        <p class="list-group-item-text">
                            <?php echo $a->fecha_nacimiento; ?><br>
                            <?php echo $a->sexo; ?><br>
                            <?php echo $a->calle . " #" . $a->numero; ?><br>
                            <?php echo $a->estudio; ?>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="slide-item load">
                <p class="loading"><span class="glyphicon glyphicon-refresh"></span> Cargando</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <span class="glyphicon glyphicon-chevron-right right-slide"></span>
</div>

<div class="pull-left">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'citar-form',
    'action'=>Yii::app()->createUrl('vacantes/citar', array('id'=>$model->id)),
	'enableAjaxValidation'=>false,
));
?>
    <?php echo CHtml::submitButton('Citar seleccionados',array('class'=>'btn btn-primary disabled')); ?>
<?php $this->endWidget(); ?>
</div>
<div class="clearfix"></div>
<div class="list-group">
    <?php foreach($aspirante as $a): ?>
    <input class="hidden" id="asp<?php echo $a->id; ?>" type="checkbox" form="citar-form" name="aspirante[]" value="<?php echo $a->id; ?>">
    <div class="relative">
        <?php echo CHtml::link('Descargar', array('aspirantes/pdf', 'id'=>$a->id), array('class'=>'btn btn-link')); ?>
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl . "/images/" . ($a->foto ? ("fotos/" . $a->foto):"logo.png"); ?>" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre</h4>
                <p class="list-group-item-text">
                    <?php echo "Fecha de nacimiento " . $a->fecha_nacimiento; ?><br>
                    <?php echo "Genero " . $a->sexo; ?><br>
                    <?php echo "Domicilio" . $a->calle . " #" . $a->numero; ?><br>
                    <?php echo "Último grado de estudio" . $a->estudio; ?>
                </p>
            </div>
        </a>
        <div class="btn-top-right btn-group-vertical">
            <button class="btn btn-primary" type="submit" form="citar-form" name="aspirante[]" value="<?php echo $a->id; ?>">Citar</button>
            <button class="btn btn-danger">Rechazar</button>
            <label class="btn btn-info btn-citar" for="asp<?php echo $a->id; ?>">Seleccionar</label>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="relative">
        <button id="load" class="btn btn-default btn-block loading">
            <?php if(count($lista) < 10): ?>
            Fin de la lista
            <?php else: ?>
            <span class="glyphicon glyphicon-refresh"></span> Cargando
            <?php endif; ?>
        </button>
    </div>
</div>
<?php else: ?>
<div class="jumbotron">
    <h1>Sin solicitudes</h1>
    <p>Actualmente no han aplicado aspirantes para el puesto solicitado</p>
</div>
<?php endif; ?>