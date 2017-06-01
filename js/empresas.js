$(document).ready(function() {
    //JS Form Registro
    $('div.password > input[type=password]').on('keyup paste',function(){
        $('div.password').removeClass('error has-error success has-success has-feedback');
        $('div.password > span').removeClass('glyphicon glyphicon-remove glyphicon-ok form-control-feedback');
        
        if(/^((?!.*\s)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[a-z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*[a-z])(?=.*[A-Z]).{8,})$/g.test($(this).val())) {
            $('div.password').addClass('success has-success has-feedback');
            $('div.password > span').addClass('glyphicon glyphicon-ok form-control-feedback');
        } else {
            $('div.password').addClass('error has-error has-feedback');
            $('div.password > span').addClass('glyphicon glyphicon-remove form-control-feedback');
        }
    });
    
    //JS Actualizar
    var valid = false;
    $('div.new > input[type=password]').on('keyup paste',function(){
        $('div.new').removeClass('error has-error success has-success has-feedback');
        $('div.new > span').removeClass('glyphicon glyphicon-remove glyphicon-ok form-control-feedback');
        
        if(/^((?!.*\s)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[a-z]).{8,})$|^((?!.*\s)(?=.*\d)(?=.*[A-Z]).{8,})$|^((?!.*\s)(?=.*[a-z])(?=.*[A-Z]).{8,})$/g.test($(this).val())) {
            $('div.new').addClass('success has-success has-feedback');
            $('div.new > span').addClass('glyphicon glyphicon-ok form-control-feedback');
            valid = true;
        } else {
            $('div.new').addClass('error has-error has-feedback');
            $('div.new > span').addClass('glyphicon glyphicon-remove form-control-feedback');
            valid = false;
        }
    });
    
    $('#cambiar-password-form').submit(function() {
        return valid;
    });
    
    // JS Index
    $('#lista_vacante, #lista_locales').on('show.bs.collapse', function(e) {
        $(e.target).prevUntil('.panel','.list-group-item').addClass('active');
    }).on('hide.bs.collapse', function(e) {
        $(e.target).prevUntil('.panel','.list-group-item').removeClass('active');
    });
    
    var active = false;
    $(window).click(function() {
        if(active)
            $('#temporaryModal').effect('shake');
    });

    $('#temporaryModal .modal-content').click(function(e){
        active = false;
    });
    
    $('#temporaryModal').on('show.bs.modal', function(e) {
        $('#delete').data('url', $(e.relatedTarget).data('url'));
        $('#delete').data('item', $(e.relatedTarget).data('item'));
        $('#delete').data('action', $(e.relatedTarget).data('action'));
        $('#delete').data('activateBy', $(e.relatedTarget));
        
        if($(e.relatedTarget).data('action') == "finalizar")
            $('#temporaryModal .modal-body').text('¿Estas seguro que quieres finalizar la busqueda de aspirantes de esta vacante?');
        else if($(e.relatedTarget).data('action') == "deshabilitar")
            $('#temporaryModal .modal-body').text('¿Estas seguro que quieres habilitarlo?');
        else if($(e.relatedTarget).data('action') == "habilitar")
            $('#temporaryModal .modal-body').text('¿Estas seguro que quieres deshabilitarlo?');
        
    }).on('shown.bs.modal', function() {
        active = true;
    }).on('hidden.bs.modal', function() {
        active = false;
    });
    
    $('#delete, #cancel').click(function(e) {
        if($(this).is('#delete')) {
            var item = $(this).data('item');
            var action = $(this).data('action');
            $.ajax({
                url: $(this).data('url'),
                beforeSend: function() {
                    $(item).parent().children().last().removeClass('out');
                    $(item).parent().children().last().addClass('in');
                },
                success: function(r) {
                    switch(action){
                        case "finalizar":
                            $(item).collapse('hide');
                            $(item).parent().on('hidden.bs.collapse', function(e) {
                                if ($(this).is(e.target))
                                    $(this).remove();
                                $(item).parent().collapse('hide');
                            });
                            break;
                            
                        case "deshabilitar":
                            var btn = $('#delete').data('activateBy');
                            $(btn).removeClass('btn-danger');
                            $(btn).addClass('btn-primary');
                            $(btn).text('Habilitar');
                            $(btn).data('action','habilitar');
                            
                            var text = "a[href='" + item + "'] p.list-group-item-text";
                            $(text).text("Deshabilitado");
                            break;
                            
                        case "habilitar":
                            var btn = $('#delete').data('activateBy');
                            $(btn).removeClass('btn-primary');
                            $(btn).addClass('btn-danger');
                            $(btn).text('Deshabilitar');
                            $(btn).data('action','deshabilitar');
                            
                            var text = "a[href='" + item + "'] p.list-group-item-text";
                            $(text).text('Habilitado');
                            break;
                    }
                    $(item).parent().children().last().removeClass('in');
                    $(item).parent().children().last().addClass('out');
                },
                error: function() {
                    $("<div class='alert alert-danger fade in'><button type='button' class='close' data-dismiss='alert' aria-label='close'>&times;</button>Ocurrio un problema. Intentalo más tarde recargando la página</div>").insertAfter('#temporaryModal');
                    $(item).parent().children().last().removeClass('in');
                    $(item).parent().children().last().addClass('out');
                }
            });
        }
    });
});