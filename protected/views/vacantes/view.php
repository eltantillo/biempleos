<?php
$this->breadcrumbs=array(
	'Vacantes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List vacantes', 'url'=>array('index')),
	array('label'=>'Create vacantes', 'url'=>array('create')),
	array('label'=>'Update vacantes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete vacantes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage vacantes', 'url'=>array('admin')),
);
?>

<h1>View vacantes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
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
)); ?>
