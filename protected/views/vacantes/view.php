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
<div class="table-responsive">
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
</div>