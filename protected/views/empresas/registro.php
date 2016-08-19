<?php
$this->breadcrumbs=array(
	'Registro',
);
?>

<h1>Registrar tu Empresa</h1>

<?php echo $this->renderPartial('_form', array('empresa'=>$empresa,'usuario'=>$usuario)); ?>
