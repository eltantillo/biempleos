<?php
$this->breadcrumbs=array(
	'Vacantes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List vacantes', 'url'=>array('index')),
	array('label'=>'Manage vacantes', 'url'=>array('admin')),
);
?>

<h1>Create vacantes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'localidades'=>$localidades)); ?>