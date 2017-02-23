<?php
$this->breadcrumbs=array(
	'Usuarios Aspirantes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Aspirantes', 'url'=>array('index')),
	array('label'=>'Create Aspirantes', 'url'=>array('create')),
	array('label'=>'Update Aspirantes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Aspirantes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage Aspirantes', 'url'=>array('admin')),
);
?>

<h1>View Aspirantes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_aspirante',
		'correo',
		'contrasena',
		'gcmKey',
		'activo',
	),
)); ?>
