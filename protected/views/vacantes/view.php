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
    ));
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
<script>
$(document).ready(function() {
    
    // Funciones de Carga
    var isLoading = false;
    function newContent() {
        var d = '<div class="relative">' +
        '<a href="#aspirante" class="list-group-item" data-toggle="modal">' +
            '<div class="media-left media-top">' +
                '<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">' +
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
        $('.list-group').append(d);
        $('.list-group div.relative').slideDown('slow');
        $('.list-group').append($('#load').parent());
        
        var d2 = '<div class="slide-item" style="margin-left:' + $('.slide-item:not(.slide-item:first)').css('margin-left') + '">' +
                'slide nuevo' +
            '</div>';
        $('.slide-test .slide-item.load').before(d2);
        setSlideSize();
    }
    
    $(this).scroll(function() {
        if($('#load').offset().top + $('#load').height() <= $(window).scrollTop() + $(window).height() && !isLoading) {
            isLoading = true;
            /*$.ajax({
                url: '<?php echo CController::createUrl('vacantes/loadLista'); ?>',
                data: {},
                type: 'POST',
                success: function(data) {
                    
                },
                error: function(xhr, status) {
                    
                },
                complete: function(xhr, status) {
                    isLoading = false;
                }
            });*/
            newContent();
            isLoading = false;
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
    
    // Accion Citar
    $('.btn-citar').click(function(e) {
        function toogleBtnCitar(btn) {
            if($(btn).hasClass("btn-primary"))
                $(btn).removeClass("btn-primary").addClass("btn-danger").text("Omitir");
            else
                $(btn).removeClass("btn-danger").addClass("btn-primary").text("Citar");
        }
        
        toogleBtnCitar($(this));
        
        if($(this).parents('.list-group').length) {
            var index = $('.list-group .relative').index($(this).parent());
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 1</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 1</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 2</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 2</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 3</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 3</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 4</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 4</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 5</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 5</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 6</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 6</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 7</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 7</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 8</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 8</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 9</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 9</h4>
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
            <div class="slide-item">
                <div class="media hidden-xs" style="height:400px;overflow:auto;">
                    <div class="media-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
                        <button class="btn btn-primary btn-citar">Citar</button>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Nombre 10</h4>
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
                </div>
                <div class="visible-xs-12" style="padding: 25% 0;overflow: auto;height: 100vh;">
                    <div class="col-xs-offset-2 col-xs-8">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="center-block" style="width:65px">
                        <h4 class="media-heading">Nombre 10</h4>
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
            <div class="slide-item load">
                Cargando
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
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 1</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 2</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 3</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 4</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 5</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 6</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 7</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 8</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="media list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 9</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <a href="#aspirante" class="list-group-item" data-toggle="modal">
            <div class="media-left media-top">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="media-object" style="width:65px">
            </div>
            <div class="media-body">
                <h4 class="list-group-item-heading">Nombre 10</h4>
                <p class="list-group-item-text">
                    dato 1<br>
                    dato 2<br>
                    dato 3<br>
                    dato 4<br>
                    dato 5<br>
                </p>
            </div>
        </a>
        <button class="btn btn-primary btn-top-right btn-citar">Citar</button>
    </div>
    <div class="relative">
        <button id="load" class="btn btn-default btn-block loading"><span class="glyphicon glyphicon-refresh"></span> Cargando</button>
    </div>
</div>