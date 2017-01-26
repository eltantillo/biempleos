<?php
/*$this->breadcrumbs=array(
	'Vacantes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List vacantes', 'url'=>array('index')),
	array('label'=>'Create vacantes', 'url'=>array('create')),
	array('label'=>'Update vacantes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete vacantes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage vacantes', 'url'=>array('admin')),
);*/
$lista = lista_aspirantes::model()->findAllByAttributes(
    array(
        'id_vacante'=>$model->id,
        'cita'=>null
    ),
    array('limit'=>10)
);
?>

<h1>Puesto: <?php echo $model->puesto; ?></h1>

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_empresa',
		'id_localidad',
		'puesto',
		'ofrece',
		'requisitos',
		'disponibilidad',
		'fecha_publicacion',
	),
));*/ ?>
<?php if(count($lista) > 0): ?>
<script>
$(document).ready(function() {
    
    // Funciones de Carga
    var isLoading = false, startPoint = 10;
    function newContent() {
        if(startPoint == -1)
            return false;
            
        $.ajax({
            url: '<?php echo CController::createUrl('vacantes/loadLista'); ?>',
            dataType: 'json',
            data: {
                id: "<?php echo $model->id; ?>",
                offset: startPoint
            },
            type: 'GET',
            success: function(data) {
                if(data.length > 9) {
                    startPoint += 10;
                } else {
                    $('.slide-test .slide-item.load > p').text('Fin de la lista');
                    $('#load').text('Fin de la lista');
                    startPoint = -1;
                }
                
                $(data).each(function(i, v) {
                    var foto = this.foto ? this.foto:("<?php echo Yii::app()->request->baseUrl . "/images/logo.png"; ?>");
                    var listItem = '<div class="relative">' +
                        '<a href="#aspirante" class="list-group-item" data-toggle="modal">' +
                            '<div class="media-left media-top">' +
                                '<img src="' + foto + '" class="media-object" style="width:65px">' +
                            '</div>' +
                            '<div class="media-body">' +
                                '<h4 class="list-group-item-heading">Nombre 10</h4>' +
                                '<p class="list-group-item-text">' +
                                    'dato 1<br>' +
                                    'dato 2<br>' +
                                    'dato 3<br>' +
                                    'dato 4<br>' +
                                    'dato 5<br>' +
                                '</p>' +
                            '</div>' +
                        '</a>' +
                            '<button class="btn btn-primary btn-top-right">Citar</button>' +
                        '</div>';
                    var slideItem = '<div class="slide-item" style="margin-left:' + 
                        $('.slide-item:not(.slide-item:first)').css('margin-left') + '">' +
                            'slide nuevo' +
                        '</div>';
                    
                    $('.list-group').append(listItem);
                    $('.list-group div.relative').slideDown('slow');
                    $('.list-group').append($('#load').parent());
                    $('.slide-test .slide-item.load').before(slideItem);
                    setSlideSize();
                });
            },
            error: function(xhr, status) {
                
            },
            complete: function(xhr, status) {
                isLoading = false;
            }
        });
    }
    
    $(this).scroll(function() {
        if($('#load').offset().top + $('#load').height() <= $(window).scrollTop() + $(window).height() && !isLoading) {
            isLoading = true;
            newContent();
        }
    });
    
    // Funciones del Slide
    function setSlideSize() {
        $('.slide-item').css({
            'margin-left': '0px'
        });
        
        if($(window).width() > 1199) {
            $('.slide-item').css({
                'margin-left': (($(window).width() - $('.slide-item').outerWidth()) / 2) + 'px'
            });
        } else if($(window).width() > 767) {
            $('.slide-item:first').css({
                'margin-left': (($(window).width() - $('.slide-item:first').outerWidth(true)) / 2) + 'px'
            });
            $('.slide-item:not(.slide-item:first)').css({
                'margin-left': (($(window).width() - $('.slide-item:first').outerWidth(true)) / 4) + 'px'
            });
        }
        
        $('.slide-item.load').css({
            'margin-right': $('.slide-item:first').css('margin-left')
        });
        
        var width = 0;
        $('.slide-item').each(function() { 
            width += ($(this).outerWidth(true));
        });
        $('.slide-test').width(width);
    }
    function slideTo(direction) {
        if($('.slide-show').is(':animated'))
            return;
        
        if(direction == 'left')
            $('.slide-show').animate({
                'scrollLeft': '-=' + $('.slide-item:not(.slide-item:first)').outerWidth(true)
            });
        
        if(direction == 'right')
            $('.slide-show').animate({
                'scrollLeft': '+=' + $('.slide-item:not(.slide-item:first)').outerWidth(true)
            });
    }
    function adjustSlide() {
        if($('.slide-show').is(':animated'))
            return;
        
        var dist = Math.round($('.slide-show').scrollLeft() / $('.slide-item:not(.slide-item:first)').outerWidth(true));
        $('.slide-show').animate({
            'scrollLeft': (dist * $('.slide-item:not(.slide-item:first)').outerWidth(true))
        });
    }
    
    var x, left, down, timer;

    $(".slide-show").mousedown(function(e){
        e.preventDefault();
        down = true;
        x = e.pageX;
        left = $(this).scrollLeft();
    });
    $("body").mousemove(function(e){
        if(down)
            $(".slide-show").scrollLeft(left - e.pageX + x);
    });
    $("body").mouseup(function(e){
        down = false;
    });
    $('.slide-show').scroll(function(e){
        if($(this).scrollLeft() + $(this).innerWidth() >= $(this)[0].scrollWidth) {
            newContent();
        }
        
        clearTimeout(timer);
        timer = setTimeout( function() {
            adjustSlide();
        }, 1000 );
    });
    $('.left-slide').click(function() {
        slideTo('left');
    });
    $('.right-slide').click(function() {
        slideTo('right');
    });
    $(document).keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == 37)
            slideTo('left');
        else if(keycode == 39)
            slideTo('right');
    });
    
    // Accion Citar - Falta funcionalidad
    $('.btn-citar').click(function(e) {
        function toogleBtnCitar(btn) {
            if($(btn).hasClass("btn-info")) {
                $(btn).removeClass("btn-info").addClass("btn-warning").text("Seleccionado");
                $(btn).closest('.relative:not(.relative.modal), .slide-item').toggleClass('choose');
            } else {
                $(btn).removeClass("btn-warning").addClass("btn-info").text("Seleccionar");
                $(btn).closest('.relative:not(.relative.modal), .slide-item').toggleClass('choose');
            }
        }
        
        toogleBtnCitar($(this));
        
        if($(this).parents('.list-group').length) {
            var index = $('.list-group .relative').index($(this).parent().parent());
            var twinBtn = $(".slide-test .slide-item:eq(" + index + ") .btn-citar");
            toogleBtnCitar(twinBtn);
        }
        
        if($(this).parents('.slide-item').length){
            var index = $('.slide-test .slide-item').index($(this).parent().parent().parent());
            var twinBtn = $(".list-group .relative:eq(" + index + ") .btn-citar");
            toogleBtnCitar(twinBtn);
        }
    });
    
    // Inicializacion de todo
    setSlideSize();
    $('#aspirante').on('show.bs.modal', function (e) {
        if($('.slide-show').is(':animated'))
            return;
        
        var data = $('.list-group .relative').index($(e.relatedTarget).parent());
        var valor = $('.slide-item:not(.slide-item:first)').outerWidth(true) * data;
        $('.slide-show').animate({
            'scrollLeft':valor
        });
    });
    
    $(window).resize(function() {
        setSlideSize();
    });
});
</script>
<div id="aspirante" class="relative modal fade" data-backdrop="static" role="dialog" aria-labelledby="aspiranteLabel">
    <div class="modal-dialog"></div>
    <span class="btn-top-right btn-close glyphicon glyphicon-remove" data-dismiss="modal"></span>
    <span class="glyphicon glyphicon-chevron-left left-slide"></span>
    <div class="slide-show" style="overflow:auto;width:100vw">
        <div class="slide-test" role="document">
            <?php foreach($lista as $l): ?>
            <?php $aspirante = aspirantes::model()->findbyPk($l->id_aspirante); ?>
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo $aspirante->foto ? $aspirante->foto:(Yii::app()->request->baseUrl . "/images/logo.png"); ?>" class="media-object" style="width:65px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre</h4>
                        <p class="list-group-item-text">
                            dato 1<br>
                            dato 2<br>
                            dato 3<br>
                            dato 4<br>
                            dato 5<br>
                            dato 6<br>
                            etc
                        </p>
                        <button class="btn btn-primary">Citar</button>
                        <button class="btn btn-danger">Rechazar</button>
                        <button class="btn btn-info btn-citar">Seleccionar</button>
                    </div>
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo $aspirante->foto ? $aspirante->foto:(Yii::app()->request->baseUrl . "/images/logo.png"); ?>" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre</h4>
                        <p class="list-group-item-text">
                            dato 1<br>
                            dato 2<br>
                            dato 3<br>
                            dato 4<br>
                            dato 5<br>
                            dato 6<br>
                            etc
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="slide-item load">
                <p class="loading"><span class="glyphicon glyphicon-refresh"></span> Cargando</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <span class="glyphicon glyphicon-chevron-right right-slide"></span>
</div>

<div class="pull-left">
    <button type="button" class="btn btn-primary disabled">Citar seleccionados</button>
</div>
<div class="clearfix"></div>
<div class="list-group">
    <?php foreach($lista as $l): ?>
    <?php $aspirante = aspirantes::model()->findbyPk($l->id_aspirante); ?>
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo $aspirante->foto ? $aspirante->foto:(Yii::app()->request->baseUrl . "/images/logo.png"); ?>" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <div class="btn-top-right btn-group-vertical">
            <button class="btn btn-primary">Citar</button>
            <button class="btn btn-danger">Rechazar</button>
            <button class="btn btn-info btn-citar">Seleccionar</button>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="relative">
        <button id="load" class="btn btn-default btn-block loading">
            <?php if(count($lista) < 10): ?>
            Fin de la lista
            <?php else: ?>
            <span class="glyphicon glyphicon-refresh"></span> Cargando
            <?php endif; ?>
        </button>
    </div>
</div>
<?php else: ?>
<div class="jumbotron">
    <h1>Sin solicitudes</h1>
    <p>Actualmente no han aplicado aspirantes para el puesto solicitado</p>
</div>
<?php endif; ?>