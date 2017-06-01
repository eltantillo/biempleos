<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/citar.js');
$cs->registerCssFile($baseUrl.'/css/citar.css');
?>
<h1>Vacante <?php echo $model->puesto; ?></h1>
<label>Citando</label>
<?php foreach($aspirante as $candidato): ?>
<span>
    <img src="<?php echo $candidato->foto ? $candidato->foto:(Yii::app()->request->baseUrl . "/images/logo.png"); ?>" style="width: 32px;"> Nombre <?php echo $candidato->nombre; ?>
    <span class="glyphicon glyphicon-remove"></span>
    <input type="hidden" name="aspirante[]" form="cita" value="<?php echo $candidato->id; ?>">
</span>

<?php endforeach; ?>
<hr>
<div class="input-group">
    <div id="calendar" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></div>
    <div id="time" class="input-group-addon btn"><span class="glyphicon glyphicon-time"></span></div>
    <input class="form-control datepicker" type="text" placeholder="Fecha de la cita" readonly>
</div>
<div id="datedit" style="display:none"></div>
<div id="timedit" style="display:none">
    <div class="hidden-560 input-group">
        <input class="form-control" type="number" placeholder="Hora" max="12" min="01" name="hora">
        <div class="input-group-btn">
            <button class="btn btn-default hora-plus"><span class="glyphicon glyphicon-triangle-top"></span></button>
            <button class="btn btn-default hora-minus"><span class="glyphicon glyphicon-triangle-bottom"></span></button>
            <span style="padding: 6px 12px;vertical-align: middle;font-size: 14px;font-weight: 800;"> : </span>
        </div>
        <input class="form-control" type="number" placeholder="Minuto" max="59" min="00" name="minuto">
        <div class="input-group-btn">
            <button class="btn btn-default min-plus"><span class="glyphicon glyphicon-triangle-top"></span></button>
            <button class="btn btn-default min-minus"><span class="glyphicon glyphicon-triangle-bottom"></span></button>
        </div>
        <select class="form-control" name="tiempo">
            <option value="P.M.">P.M.</option>
            <option value="A.M.">A.M.</option>
        </select>
    </div>
    <div class="visible-560">
        <div class="input-group">
            <input class="form-control" type="number" placeholder="Hora" max="12" min="01" name="horaMini">
            <div class="input-group-btn">
                <button class="btn btn-default hora-plus"><span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="btn btn-default hora-minus"><span class="glyphicon glyphicon-triangle-bottom"></span></button>
            </div>
        </div>
        <div class="input-group">
            <input class="form-control" type="number" placeholder="Minuto" max="59" min="00" name="minutoMini">
            <div class="input-group-btn">
                <button class="btn btn-default min-plus"><span class="glyphicon glyphicon-triangle-top"></span></button>
                <button class="btn btn-default min-minus"><span class="glyphicon glyphicon-triangle-bottom"></span></button>
            </div>
        </div>
        <select class="form-control" name="tiempoMini">
            <option value="P.M.">P.M.</option>
            <option value="A.M.">A.M.</option>
        </select>
    </div>
</div>

<form id="cita" action="<? echo Yii::app()->createUrl('vacantes/citar', array('id'=>$model->id)); ?>" method="post">
    <input type="hidden" id="hiddenDate" name="date">
    <textarea class="form-control" rows="7" placeholder="Comentarios" name="comentarios"></textarea>
    <input class="btn btn-default" type="submit" value="Citar">
</form>