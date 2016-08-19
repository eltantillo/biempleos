<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" data-tab-url="<?php echo Yii::app()->createUrl('site/recover'); ?>" data-tab-always-refresh="true" href="#home">Solicitudes</a></li>
    <li><a data-toggle="tab" data-tab-url="<?php echo Yii::app()->createUrl('site/recover'); ?>" href="#menu1">Citas</a></li>
    <li class="pull-right"><a data-toggle="tab" data-tab-url="<?php echo Yii::app()->createUrl('vacantes/create'); ?>" href="#menu2">+ Crear Oferta de Empleo</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <div></div>
    </div>
    <div id="menu1" class="tab-pane fade">
        <div></div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <div></div>
    </div>
</div>

<!--script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.loadmask.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-remote-tabs.js"></script-->

<script>
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
  //e.target // newly activated tab
  //e.relatedTarget // previous active tab
    var enlace = $(this).attr("data-tab-url");
    var id = $(this).attr("href");
    $.ajax({
        url: enlace,
        beforeSend: function() {
            $(id + " div").addClass("loading");
        },
        success: function(result) {
            $(id).html(result);
        }
    });
})
</script>