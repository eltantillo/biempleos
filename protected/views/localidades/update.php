<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List localidades', 'url'=>array('index')),
	array('label'=>'Create localidades', 'url'=>array('create')),
	array('label'=>'View localidades', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage localidades', 'url'=>array('admin')),
);
?>

<h1>Update localidades <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>