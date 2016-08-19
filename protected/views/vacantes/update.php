<?php
$this->breadcrumbs=array(
	'Vacantes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List vacantes', 'url'=>array('index')),
	array('label'=>'Create vacantes', 'url'=>array('create')),
	array('label'=>'View vacantes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage vacantes', 'url'=>array('admin')),
);
?>

<h1>Update vacantes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'localidades'=>$localidades)); ?>