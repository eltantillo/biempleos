<?php
/*$this->breadcrumbs=array(
	'Perfil Empresa',
);

$this->menu=array(
	array('label'=>'Create localidades', 'url'=>array('create')),
	array('label'=>'Manage localidades', 'url'=>array('admin')),
);
?>

<h1>Perfil</h1>
<p>Nombre de la Empresa: <?php echo $empresa->nombre; ?></p>
<?php echo CHtml::link("Cambiar contraseñal", array("empresas/actualizar"), array("class"=>"btn btn-default")); ?>
<div id="psw panel panel-info hidden"></div>
<br>
<?php echo CHtml::link("Añadir Local", array("localidades/create"), array("class"=>"btn btn-default pull-right"))?>
<div class="clearfix"></div>
<div class="panel panel-primary">
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'locales-grid',
        'summaryText'=>'Mostrando {start}-{end} de {count} resultados',
        //'ajaxUrl' => $this->createUrl('buscador'),
        //'cssFile' => Yii::app()->baseUrl . '/css/gridView.css',
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'header'=>'Calle',
                'name' => 'calle',
                'value' => 'CHtml::encode($data->calle)'
            ),
            array(
                'header'=>'Numero',
                'name' => 'numero',
                'value' => 'CHtml::encode($data->numero)'
            ),
            array(
                'header'=>'Colonia',
                'name' => 'colonia',
                'value' => 'CHtml::encode($data->colonia)'
            ),
            array(
                'header'=>'Codigo Postal',
                'name' => 'codigo_postal',
                'value' => 'CHtml::encode($data->codigo_postal)'
            ),
            array(
                'header'=>'País',
                'name' => 'pais',
                'value' => 'CHtml::encode($data->pais)'
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{delete}',
                'buttons'=>array(
                    'delete' => array(
                        'label'=>'Borrar',
                        //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                        'url'=>'Yii::app()->createUrl("localidades/delete", array("id"=>$data->id))',
                    ),
                ),
            ),
        ),
    ));
?>
</div>*/?>
<h1>Inicio</h1>