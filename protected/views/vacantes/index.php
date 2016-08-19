<?php
$this->breadcrumbs=array(
	'Vacantes',
);

$this->menu=array(
	array('label'=>'Create vacantes', 'url'=>array('create')),
	array('label'=>'Manage vacantes', 'url'=>array('admin')),
);
?>

<h1>Vacantes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
