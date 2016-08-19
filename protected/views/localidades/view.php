<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List localidades', 'url'=>array('index')),
	array('label'=>'Create localidades', 'url'=>array('create')),
	array('label'=>'Update localidades', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete localidades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage localidades', 'url'=>array('admin')),
);
?>

<h1>View localidades #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_empresa',
		'calle',
		'numero',
		'colonia',
		'codigo_postal',
		'pais',
		'estado',
		'ciudad',
	),
)); ?>
