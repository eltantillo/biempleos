<?php
/*$this->breadcrumbs=array(
	'Vacantes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List vacantes', 'url'=>array('index')),
	array('label'=>'Create vacantes', 'url'=>array('create')),
	array('label'=>'Update vacantes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete vacantes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage vacantes', 'url'=>array('admin')),
);*/
$lista = lista_aspirantes::model()->findAllByAttributes(
    array(
        'id_vacante'=>$model->id,
        'cita'=>null
    ));
?>

<h1>Puesto: <?php echo $model->puesto; ?></h1>

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_empresa',
		'id_localidad',
		'puesto',
		'ofrece',
		'requisitos',
		'disponibilidad',
		'fecha_publicacion',
	),
));*/ ?>
<!--div class="table-responsive">
    <input class="btn btn-primary pull-right" type="submit" form="form-citas" value="Citar a los seleccionados">
    <table class="table table-striped">
        <tbody>
            <?php if($lista != null): ?>
            <form id="form-citas" name="form-citas" action="<?php echo Yii::app()->createUrl('vacantes/citar'); ?>" method="post">
            <?php foreach($lista as $solicitud): ?>
            <tr>
                <td><input type="checkbox" name="<?php echo "aspirante_$solicitud[id_aspirante]"; ?>" value="<?php echo $solicitud[id_aspirante]; ?>"></td>
                <?php
                $aspirante = aspirante::model()->findbyPk($solicitud['id_aspirante']);
                ?>
                <td><?php echo $aspirante->datos; ?></td>
                <td><a href="#" class="btn btn-primary">Ver Datos</a></td>
                <td><?php echo CHtml::link('Citar',array('vacantes/citar'),array('class'=>'btn btn-primary')); ?></td>
            </tr>
            <?php endforeach; ?>
            </form>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
    </table>
</div-->
<script>
$(document).ready(function() {
    var aspirantes = [{id:1,datos:'aspirante1'},{id:2,datos:'aspirante2'}];
    var aspirante;/*
    <?php if($lista): ?>
    <?php foreach($lista as $l): ?>
    <?php $aspirante = aspirantes::model()->findByPk($l->id_aspirante); ?>
    aspirante = {id:<?php echo $aspirante->id; ?>,datos:<?php echo $aspirante->datos; ?>};
    apsirante.push(aspirante);
    <?php endforeach; ?>
    <?php endif; ?>*/
    
    var visibleSlideShow = false;
    
    $('#aspirante').on('show.bs.modal', function(e) {
        visibleSlideShow = true;
    }).on('hide.bs.modal', function(e) {
        visibleSlideShow = false;
    });
    
    $(document).keydown(function(e) {
        if(visibleSlideShow)
            alert(e.keyCode);
    });
});
</script>
<div id="aspirante" class="relative modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="aspiranteLabel">
    <span class="btn-top-right glyphicon glyphicon-remove" data-dismiss="modal" style="color:#59656c;font-size:2.2em;padding:0.5em 1em;cursor:pointer;"></span>
    <span class="glyphicon glyphicon-chevron-left" style="color:#59656c;font-size:2.2em;padding:29px;position:absolute;left:0;top:50%;transform: translateY(-50%);cursor:pointer;"></span>
    <div class="slide-show" role="document" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
        <div class="slide-item">
            slide 1
        </div>
        <div class="slide-item">
            slide 2
        </div>
        <div class="slide-item active">
            slide 3
        </div>
        <div class="slide-item">
            slide 4
        </div>
        <div class="slide-item">
            slide 5
        </div>
    </div>
    <span class="glyphicon glyphicon-chevron-right" style="color:#59656c;font-size:2.2em;padding:29px;position:absolute;right:0;top:50%;transform: translateY(-50%);cursor:pointer;"></span>
</div>

<div class="pull-left">
    <button type="button" class="btn btn-primary disabled">Citar seleccionados</button>
</div>
<div class="clearfix"></div>
<div class="list-group">
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal" data-id="aspirante1">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:60px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="list-group-item" data-toggle="modal" data-id="aspirante2">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:60px">
            </div>
            <div class="media-body relative">
                <h4 class="list-group-item-heading">Nombre</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right">Citar</button>
    </div>
</div>