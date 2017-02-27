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
                    $('.slide-item-group .slide-item.load > p').text('Fin de la lista');
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
                    $('.slide-item-group .slide-item.load').before(slideItem);
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
        $('.slide-item-group').width(width);
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
    $('input[type=checkbox].hidden').change(function() {
        if($(this).is(':checked'))
            $('.btn-citar[for=altasp' + this.value + '], .btn-citar[for=asp' + this.value + ']').removeClass('btn-info').addClass('btn-warning').text('Seleccionado');
        else
            $('.btn-citar[for=altasp' + this.value + '], .btn-citar[for=asp' + this.value + ']').removeClass('btn-warning').addClass('btn-info').text('Seleccionar');
        
        $('#altasp' + this.value).prop('checked', $(this).is(':checked'));
        $('#asp' + this.value).prop('checked', $(this).is(':checked'));
        
        if($('input[type=checkbox]:checked').length)
            $('input[type=submit]').removeClass('disabled');
        else
            $('input[type=submit]').addClass('disabled');
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