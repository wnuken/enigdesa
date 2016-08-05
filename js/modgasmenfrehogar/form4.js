/**
 * Funciones JavaScript para formulario 4
 * @author cemedinaa	
 * @since  15-07-2016
 */



$(function () {

    

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    var agregarPuntosMiles = function(numero){
        return String(numero).split(/(?=(?:\d{3})+$)/).join(".");
    }

    $("#form_4").validate({
        ignore: "",
        //Mensajes de error
        errorPlacement: function(error, element) {
            element.after(error);               
            error.css('display','inline');
            error.css('margin-left','10px');                
            error.css('color',"#FF0000");
        },
        submitHandler: function(form) {
            return true;
            
        }
    });

    var valor_maximo = parseInt($("#VALOR_MAXIMO").val(), 10);
    var valor_minimo = parseInt($("#VALOR_MINIMO").val(), 10);
    
    if(!isNaN(valor_maximo)) {
        $( "input[type=text]" ).numerico().largo(agregarPuntosMiles($("#VALOR_MAXIMO").val()).length);
    }

    $( "input[type=text]" ).each(function() {
        
        if(!isNaN(valor_maximo) && !isNaN(valor_maximo) && $(this).attr("name") && !$(this).prop("disabled") && $(this).attr("id").indexOf("txt_") != -1){
            // Validaciones
            //if( $("#ID_SECCION3").val() != "G3" && $("#ID_SECCION3").val() != "G4") {
                $(this).rules("add", { required   :   true, esEntero: '', menorQue: valor_minimo, mayorQue: valor_maximo,
                    messages: { required   :  "Digite un valor.", esEntero: "El N&uacute;mero no es v&aacute;lido", menorQue:"Digite un valor mayor o igual a " + agregarPuntosMiles(valor_minimo), mayorQue:"Digite un valor menor o igual a " + agregarPuntosMiles(valor_maximo)}
                });
            //}
            // Para las secciones G3 y G4 ademas de estar en el rango tambien se acepta 0 como valor estimado
            /*else {
                var idInput_ = "#" + $(this).attr("id");
                $(this).rules("add", { 
                    required   :   true,
                    esEntero: '',
                    menorQue: 
                        function() {
                            if(parseInt($(idInput_).val(), 10) == 0)
                                return 0;
                            else return valor_minimo;
                        }, 
                    mayorQue:
                        function() {
                            if(parseInt($(idInput_).val(), 10) == 0)
                                return 0;
                            else return valor_maximo;
                        },
                    messages: { 
                        required   :  "Digite un valor.",
                        esEntero: "El N&uacute;mero no es v&aacute;lido",
                        menorQue:"Digite un valor mayor o igual a " + agregarPuntosMiles(valor_minimo) + ", o igual a cero", 
                        mayorQue:"Digite un valor menor o igual a " + agregarPuntosMiles(valor_maximo) + ", o igual a cero"                        
                    }
                });
            }*/
        }
    });

    //$( "input[type=text]" ).on("blur", function() {
    //    // Validaciones
    //    if($(this).attr("name") && !$(this).prop("disabled") && $(this).attr("id").indexOf("mask_") != -1 ){
    //        var idHidden = $(this).attr("id");
    //        idHidden = idHidden.replace("mask_","txt_");
    //        $("#" + idHidden).trigger("blur");
    //    }
    //});
    
    // Poner punto de miles a los valores estimados
    $( "input[type=text]" ).on( "keyup blur", function() {
        // Validaciones
        if($(this).attr("name") && !$(this).prop("disabled")) {
            var numero = $(this).val().replace(/\./g, '');
            var numConMiles = agregarPuntosMiles(numero);
            $(this).val(numConMiles);
            //var idIpt = $(this).attr("id");
            //$("#" + idIpt.replace("mask_","txt_")).val(numero);
        }
    });

    // Se se hace clic en el checkbox se inhabilita el input de texto
    $( "input[type=checkbox]" ).on( "change", function(){

        var idChb = $(this).attr("id");
        idInput = "#" + idChb.replace("chb_","txt_");
        //idInputMask = "#" + idChb.replace("chb_","mask_");

        if($(this).prop("checked")) {
            $(idInput).prop("disabled",true);
            $(idInput).val("");
            //$(idInputMask).prop("disabled",true);
            //$(idInputMask).val("");
            $(idInput + '-error').remove();
        }
        else {
            $(idInput).prop("disabled",false);
            $(idInput).val("");
            //$(idInputMask).prop("disabled",false);
            //$(idInputMask).val("");
        }
        
        //var inputs = $(".activo").length, condicion = 1;

        //for(var i = 1; i <= inputs; i++) {
        //    if($(".valor_"+i+"_input").val() || $(".valor_"+i+"_input").prop("checked") )
        //        condicion++;
        //}

        //if(condicion == i)
        //  $("#env_form_4").prop('disabled', false);
        //else $("#env_form_4").prop('disabled', true);
        
    });

    /*$( "input[type=text]" ).on( "blur", function(){
        var inputs = $(".activo").length, condicion = 1;

        for(var i = 1; i <= inputs; i++) {
        //while($(".valor_"+i+"_input")) {
            if($(".valor_"+i+"_input").val() || $(".valor_"+i+"_input").prop("checked") )
                condicion++;
        }

        //if(condicion == i)
        //  $("#env_form_4").prop('disabled', false);
        //else $("#env_form_4").prop('disabled', true);
    });*/

    $("#form_4").submit(function(e){
        e.preventDefault();
    });

    // boton enviar
    $("#env_form_4").on("click", function () {
        if ($("#form_4").valid()){
            //var confirmacion = confirm("¿Está usted seguro de querer continuar? Una vez haga clic en Continuar NO podrá cambiar la información proporcionada y NO podrá regresar a esta pantalla. Si quiere editar información de estas respuestas haga clic en Cancelar.");
            //if(confirmacion) {
            bootbox.confirm({
                title: 'Confirmación',
                message: '¿Está seguro de querer continuar? Una vez haga clic en Continuar NO podrá cambiar la información proporcionada y NO podrá regresar a esta pantalla. Si quiere editar información de estas respuestas haga clic en Cancelar.',
                buttons: {
                    'cancel': {
                    label: 'Cancelar',
                    className: 'btn btn-primary btn-success'
                },
                'confirm': {
                    label: 'Continuar',
                    className: 'btn btn-primary btn-success'
                }
            }, callback: function(result) {
                if(result) {
                    var myf = $('#form_4');
                    var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
                    $.ajax({
                        type: 'POST',
                        url: location.href + '/guardar_form4',
                        cache: false,
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        data: args,
                        beforeSend: function (objeto) {
                            $('#mensaje_').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando informaci&oacute;n</div>');
                        },
                        success: function (respuesta) {
                            var arrRespuesta = eval(respuesta);
                            if(arrRespuesta[0].length == 0) {
                                $("input[type=text]").css('border', '');
                                $('#mensaje_').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>' + arrRespuesta[1][0] + '</div>');
                                setTimeout(function () {
                                    location.href = location.href
                                }, 2000);
                            }
                            else {
                                $("input[type=text]").css('border', '');
                                for(var i in arrRespuesta[0]) {
                                    $("#" + arrRespuesta[0][i]).css('border', '1px solid #FF0000');
                                }
                                var mensaje = '<div id="reslogin" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>';
                                mensaje += 'Error Hay inconsistencias en algunos de los campos:<br>';
                                for(var m in arrRespuesta[1]) {
                                    mensaje += arrRespuesta[1][m] + '<br>';
                                }
                                mensaje += '</div>';

                                $('#mensaje_').html(mensaje);
                            }
                        },
                        error: function (respuesta) {
                            $('#mensaje_').html('<div id="reslogin" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Error guardando informaci&oacute;n</div>');
             
                        }
                    });
                }
            }});
            //}
        }
        else {
            bootbox.alert({message:'Respuesta obligatoria. Por favor, seleccione una opción para continuar.', 
                buttons: {
                    'ok': {
                    label: 'Aceptar',
                    className: 'btn btn-primary btn-success'
                }
            }});
        }
    });
});