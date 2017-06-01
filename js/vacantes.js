$(document).ready(function() {
    // Funciones de Carga
    var isLoading = false, startPoint = 10;

    function newContent() {
        if (startPoint === -1) return false;
console.log('va bien');
        $.ajax({
            url: urlLista,
            dataType: 'json',
            data: {
                id: modelId,
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

                $(data).each(function() {
                    var foto = urlBase + "/images/" + (this.foto ? ("fotos/" + this.foto):"logo.png");
                    var listItem = '<input class="hidden" id="asp' + this.id + '" type="checkbox" form="citar-form" name="aspirante[]" value="' + this.id + '">' +
                    '<div class="relative">' +
                        '<a href="#aspirante" class="list-group-item" data-toggle="modal">' +
                            '<div class="media-left media-top">' +
                                '<img src="' + foto + '" class="media-object" style="width:65px">' +
                            '</div>' +
                            '<div class="media-body">' +
                                '<h4 class="list-group-item-heading">' + this.nombre + '</h4>' +
                                '<p class="list-group-item-text">' +
                                    'Fecha de nacimiento ' + this.fecha_nacimiento + '<br>' +
                                    'Genero ' + this.sexo + '<br>' +
                                    'Domicilio ' + this.calle + ' #' + this.numero + '<br>' +
                                    'Último grado de estudio ' + this.estudio + '<br>' +
                                '</p>' +
                            '</div>' +
                        '</a>' +
                        '<div class="btn-top-right btn-group-vertical">' +
                            '<button class="btn btn-primary" type="submit" form="citar-form" name="aspirante[]" value="' + this.id + '">Citar</button>' +
                            '<button class="btn btn-danger">Rechazar</button>' +
                            '<label class="btn btn-info btn-citar" for="asp' + this.id + '">Seleccionar</label>' +
                        '</div>' +
                    '</div>';
                    
                    var datos = "";
                    $(this).each(function(i, v) {
                        var label = "";
                        for(var key in labelAspirante) {
                            if(i == "nombre" || i == "foto" || i == "id")
                                break;
                            
                            if(i == key) {
                                label += labelAspirante[key];
                                break;
                            }
                        }
                        
                        datos += (label + " " + v + "<br>");
                    });
                    var slideItem = '<input class="hidden" id="altasp' + this.id + '" type="checkbox" value="' + this.id + '">' +
                        '<div class="slide-item" style="margin-left:' + $('.slide-item:not(.slide-item:first)').css('margin-left') + '">' +
                            '<div class="media hidden-xs" style="height:400px;overflow:auto;">' +
                                '<div class="media-left">' +
                                    '<img src="' + foto + '" class="media-object" style="width:65px">' +
                                '</div>' +
                                '<div class="media-body">' +
                                    '<h4 class="media-heading">' + this.nombre + '</h4>' +
                                    '<p class="list-group-item-text">' +
                                        datos +
                                    '</p>' +
                                    '<button class="btn btn-primary" type="submit" form="citar-form" name="aspirante[]" value="' + this.id + '">Citar</button>' +
                                    '<button class="btn btn-danger">Rechazar</button>' +
                                    '<label class="btn btn-info btn-citar" for="altasp' + this.id + '">Seleccionar</label>' +
                                '</div>' +
                            '</div>' +
                            '<div class="visible-xs-block" style="padding: 25% 0;overflow: auto;height: 100vh;">' +
                                '<div class="col-xs-offset-2 col-xs-8">' +
                                    '<img src="' + foto + '" class="center-block" style="width:65px">' +
                                    '<h4 class="media-heading">' + this.nombre + '</h4>' +
                                    '<p class="list-group-item-text">' +
                                        datos +
                                    '</p>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                            '</div>' +
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
                console.log(xhr);
        console.log('que paso');
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