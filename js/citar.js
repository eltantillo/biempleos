$(document).ready(function() {
    function setDate() {
        var altDate = $('#hiddenDate').val();
        var showDate = $('.datepicker').val();
        var time = "";
        
        if($('input[name=hora]').val() && $('input[name=minuto]').val())
            time = $('input[name=hora]').val() + ":" + $('input[name=minuto]').val() + " " + $('#timedit select').val();
        
        if (time) {
            var timeStd = "";
            if(time.endsWith("P.M.")) {
                var hour = parseInt(time.substr(0,2)) + 12;
                
                hour = hour == 24 ? "00":hour;
                timeStd = time.replace(time.substr(0,2), hour).replace(" P.M.",":00");
            } else if(time.endsWith("A.M.")) {
                timeStd = time.replace(" A.M.",":00");
            }
            
            if(!(showDate.endsWith("A.M.") || showDate.endsWith("P.M."))) {
                $('#hiddenDate').val(altDate + " " + timeStd);
                $('.datepicker').val(showDate + " " + time);
                
                altDate = $('#hiddenDate').val();
                showDate = $('.datepicker').val();
            }
            
            if (!altDate.endsWith(time)) {
                altDate = altDate.replace(altDate.substr(altDate.length - timeStd.length, altDate.length), timeStd);
                showDate = showDate.replace(showDate.substr(showDate.length - time.length, showDate.length), time);

                $('#hiddenDate').val(altDate);
                $('.datepicker').val(showDate);
            }
        }
    }
    
    function twinInputs(obj) {
        var twin = obj.name;
        
        if(twin.includes('Mini'))
            twin = twin.slice(0, twin.search('Mini'));
        else
            twin += "Mini";
        
        $('#timedit *[name=' + twin + ']').val(obj.value);
    }
    
    function changeInput(obj, operator=null) {
        if(obj.value == '')
            obj.value = 0;
        if(operator == "plus")
            obj.value = parseInt(obj.value) + 1;
        if(operator == "minus")
            obj.value = parseInt(obj.value) - 1;
        
        if(parseInt(obj.value) > parseInt(obj.max))
            obj.value = obj.max;
        if(parseInt(obj.value) < parseInt(obj.min))
            obj.value = obj.min;
            
        if(obj.value.length < 2 && 0 <= parseInt(obj.value) && parseInt(obj.value) < 10)
            obj.value = "0" + obj.value;
        
        twinInputs(obj);
    }
    
    $('#calendar').click(function() {
        $('#timedit').fadeOut('3000', function() {
            $( "#datedit" ).datepicker({
                onSelect: function(date) {
                    $('.datepicker').val(date);
                    setDate();
                    $(this).fadeOut('3000');
                },
                dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
                dayNamesShort: ["Dom", "Lun", "Mar", "Miér", "Jue", "Vie", "Sáb"],
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthNamesShort: ["Ene", "Feb", "Mar", "Abril", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                minDate: -20,
                maxDate: "+1M +10D",
                altField: "#hiddenDate",
                altFormat: "yy-mm-dd",
                dateFormat: "DD d 'de' MM 'de' yy"
            }).fadeToggle('3000');
        });
    });
    
    $('#time').click(function() {
        $('#datedit').fadeOut('3000', function() {
            $('#timedit').fadeToggle('3000');
        });
    });
    
    $('#timedit input[type=number]').on('input', function() {
        if (this.value.length > 2)
            this.value = this.value.slice(0,2);
        if (this.value > parseInt(this.max))
            this.value = this.max;
        if (this.value < parseInt(this.min))
            this.value = this.min;
    }).keydown(function(e) {
        if (!((e.keyCode > 95 && e.keyCode < 106) || (e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8))
            return false;
    }).focusout(function() {
        changeInput(this);
        setDate();
    });
    
    $('#timedit select').change(function() {
        twinInputs(this);
        setDate();
    });
    
    $('#timedit .btn').click(function() {
        if($(this).hasClass('hora-plus'))
            changeInput($('input[name=hora]').get(0), "plus");
        if($(this).hasClass('min-plus'))
            changeInput($('input[name=minuto]').get(0), "plus");
        if($(this).hasClass('hora-minus'))
            changeInput($('input[name=hora]').get(0), "minus");
        if($(this).hasClass('min-minus'))
            changeInput($('input[name=minuto]').get(0), "minus");
    });
    
    $(this).mouseup(function (e) {
        var container = $("#timedit, #datedit, #calendar, #time");

        if (!container.is(e.target) && container.has(e.target).length === 0)
            $('#timedit, #datedit').fadeOut('3000');
    });
    
    $('.glyphicon-remove').click(function() {
        $($(this).parent()).remove();
    });
});