<?php
/*$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List localidades', 'url'=>array('index')),
	array('label'=>'Manage localidades', 'url'=>array('admin')),
);*/
?>

<h1>Registrar Local</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


<?php
$localidades = localidades::model()->findByAttributes(array("id_empresa" => Yii::app()->user->id));            
if ($localidades == null): 
?>
<!--script>
$(window).load(function(){
    $('#Msg').modal('show');
});
</script>

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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div-->
<?php endif; ?>