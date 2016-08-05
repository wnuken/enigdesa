/**
 * Funciones JavaScript para formulario 1
 * @author cemedinaa	
 * @since  08-07-2016
 */
$(function () {
    $("#variable_uso_1").on("click", function () {
        $(".cont_articulo").css('display', 'block');
        //$("#env_form_1").prop('disabled', true);
        $("#variable_uso_2").prop("disabled", true);
        if($('#ops_variable_uso').attr("class") && $('#ops_variable_uso').attr("class").indexOf("alert alert-danger") != -1) {
            $("#ops_variable_uso").tooltip('destroy');
            $("#ops_variable_uso").popover('destroy');
        }
        $('#ops_variable_uso').removeClass( "alert alert-danger" );
        $('#mensaje_').html('');
    });

    $("#variable_uso_2").on("click", function () {
        $(".cont_articulo").css('display', 'none');
        //$("#env_form_1").prop('disabled', false);
        $("#variable_uso_1").prop("disabled", true);
        if($('#ops_variable_uso').attr("class") && $('#ops_variable_uso').attr("class").indexOf("alert alert-danger") != -1) {
            $("#ops_variable_uso").tooltip('destroy');
            $("#ops_variable_uso").popover('destroy');
        }
        $('#ops_variable_uso').removeClass( "alert alert-danger" );
        $('#mensaje_').html('');
    });

    $("input[type=checkbox]").on("change", function () {
        var checked = $("input:checked[type=checkbox]").length;
        //activar o desactivar boton
        //if (checked > 0)
        //    $("#env_form_1").prop('disabled', false);
        //else
        //    $("#env_form_1").prop('disabled', true);

        // Activar o desactivar inputs según la selección
        if ($(this).attr("id") == "99999999" && $(this).prop("checked")) {
            $("input[type=checkbox]").each(function () {
                if ($(this).attr("id") != "99999999")
                    $(this).prop("disabled", true);
            });
        } else if ($(this).attr("id") == "99999999" && !$(this).prop("checked")) {
            $("input[type=checkbox]").each(function () {
                if ($(this).attr("id") != "99999999")
                    $(this).prop("disabled", false);
            });
        } else if ($(this).attr("id") != "99999999" && $(this).prop("checked")) {
            $("#99999999").prop("disabled", true);
        } else if ($(this).attr("id") != "99999999" && !$(this).prop("checked")) {
            var checkedElems = 0;
            $("input[type=checkbox]").each(function () {
                if ($(this).attr("id") != "99999999" && $(this).prop("checked"))
                    checkedElems++;
            });
            if (checkedElems == 0)
                $("#99999999").prop("disabled", false);
        }

        if(checked > 0) {
            if($("#ops_articulos").length) {
                if($('#ops_articulos').attr("class") && $('#ops_articulos').attr("class").indexOf("alert alert-danger") != -1) {
                    $(".cont_articulo").tooltip('destroy');
                    $(".cont_articulo").popover('destroy');
                }
                $("#ops_articulos").removeClass( "alert alert-danger" );
            }
            $('#mensaje_').html('');
        }
    });
    
    $("#form_1").submit(function(e){
        e.preventDefault();
    });

    $("#env_form_1").on("click", function () {        
        if($("input:checked[type=checkbox]").length > 0 || ($("input:checked[type=radio]").length == 1 && $("input:checked[type=radio]").val() == 2) ) {
            //var confirmacion = confirm("¿Está usted seguro de querer continuar? Una vez haga clic en Continuar NO podrá cambiar la información proporcionada y NO podrá regresar a esta pantalla. Si quiere editar información de estas respuestas haga clic en Cancelar.");
            //if(confirmacion) {
            if($('#variable_uso_1')) {
                $('#variable_uso_1').parent().removeClass( "alert alert-danger" );
            }
            if($("#ops_articulos").length) {
                $("#ops_articulos").removeClass( "alert alert-danger" );
            }
            $('#mensaje_').html('');
            $('[data-toggle="tooltip"]').tooltip('destroy');
            $('[data-toggle="popover"]').popover('destroy');
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
                    var myf = $('#form_1');
                    var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
                    $(this).attr('disabled', true);
                    $.ajax({
                        type: 'POST',
                        url: location.href + '/guardar_form1',
                        cache: false,
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        data: args,
                        beforeSend: function (objeto) {
                            $('#mensaje_').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando informaci&oacute;n</div>');
                        },
                        success: function (respuesta) {
                            var arrRespuesta = respuesta.split(":");
                            if(arrRespuesta[0] == 'S') {
                                $('#mensaje_').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>' + arrRespuesta[1] + '</div>');
                                setTimeout(function () {
                                    location.href = location.href
                                }, 2000);
                            }
                            else if(arrRespuesta[0] == 'W') {
                                $('#mensaje_').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>' + arrRespuesta[1] + '</div>');
                            }
                            else if(arrRespuesta[0] == 'E') {
                                $('#mensaje_').html('<div id="reslogin" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> ' + arrRespuesta[1] + '</div>');
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
            //bootbox.alert({message:'Respuesta obligatoria. Por favor, seleccione una opción para continuar.', 
            //    buttons: {
            //        'ok': {
            //        label: 'Aceptar',
            //        className: 'btn btn-primary btn-success'
            //    }
            //}});
            //alert("Respuesta obligatoria. Por favor, seleccione una opción para continuar.");
            $('#mensaje_').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
            var marca_articulos = true;
            if($('#variable_uso_1').length) {
                $('#variable_uso_1').parent().removeClass( "alert alert-danger" );
                if(!$('#variable_uso_1').prop("checked") && !$('#variable_uso_2').prop("checked")) {
                    $('#variable_uso_1').parent().addClass( "alert alert-danger" );
                    $("#ops_variable_uso").tooltip();
                    $("#ops_variable_uso").popover();
                    marca_articulos = false;
                }
            }
            if(marca_articulos) {
                if($("#ops_articulos").length) {
                    $("#ops_articulos").removeClass( "alert alert-danger" );
                    $("#ops_articulos").addClass( "alert alert-danger" );
                    $(".cont_articulo").tooltip();
                    $(".cont_articulo").popover();
                }
            }
        }
    });
});