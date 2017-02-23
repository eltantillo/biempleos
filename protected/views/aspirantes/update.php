<?php
$this->breadcrumbs=array(
	'Usuarios Aspirantes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Aspirantes', 'url'=>array('index')),
	array('label'=>'Create Aspirantes', 'url'=>array('create')),
	array('label'=>'View Aspirantes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Aspirantes', 'url'=>array('admin')),
);
?>

<h1>Update Aspirantes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>