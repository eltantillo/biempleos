<?php
$this->breadcrumbs=array(
	'Localidades',
);

$this->menu=array(
	array('label'=>'Create localidades', 'url'=>array('create')),
	array('label'=>'Manage localidades', 'url'=>array('admin')),
);
?>

<h1>Localidades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$localidades = localidades::model()->findByAttributes(array("id_empresa" => Yii::app()->user->id));            
if ($localidades == null): 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
$(window).load(function(){
    $('#Msg').modal('show');
});
</script>
<?php endif; ?>

<div id="Msg" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Atención</h4>
        </div>
        <div class="modal-body">
            <p>Necesitas registrar los locales que cuentas para hacer uso del sitio</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
        </div>
    </div><!-- /.modal-content -->
  </div>
</div>
