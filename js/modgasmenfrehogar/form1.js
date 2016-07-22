/**
 * Funciones JavaScript para formulario 1
 * @author cemedinaa	
 * @since  08-07-2016
 */
$(function () {
    //$("#myModal").on("show", function() {    // wire up the OK button to dismiss the modal when shown
    //    $("#myModal a.btn").on("click", function(e) {
    //        console.log("button pressed");   // just as an example...
    //        $("#myModal").modal('hide');     // dismiss the dialog
    //    });
    //});
    //$("#myModal").on("hide", function() {    // remove the event listeners when the dialog is dismissed
    //    $("#myModal a.btn").off("click");
    //});
    
    //$("#myModal").on("hidden", function() {  // remove the actual elements from the DOM when fully hidden
    //    $("#myModal").remove();
    //});
    
    //$("#myModal").modal({                    // wire up the actual modal functionality and show the dialog
    //  "backdrop"  : "static",
    //  "keyboard"  : true,
    //  "show"      : true                     // ensure the modal is shown immediately
    //});

    $("#variable_uso_1").on("click", function () {
        $(".cont_articulo").css('display', 'block');
        //$("#env_form_1").prop('disabled', true);
        $("#variable_uso_2").prop("disabled", true);
    });

    $("#variable_uso_2").on("click", function () {
        $(".cont_articulo").css('display', 'none');
        //$("#env_form_1").prop('disabled', false);
        $("#variable_uso_1").prop("disabled", true);
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
    });
    
    $("#form_1").submit(function(e){
        e.preventDefault();
    });
    // boton enviar
    $("#env_form_1").on("click", function () {        
        if($("input:checked[type=checkbox]").length > 0 || ($("input:checked[type=radio]").length == 1 && $("input:checked[type=radio]").val() == 2) ) {
            //var confirmacion = confirm("¿Está usted seguro de querer continuar? Una vez haga clic en Continuar NO podrá cambiar la información proporcionada y NO podrá regresar a esta pantalla. Si quiere editar información de estas respuestas haga clic en Cancelar.");
            //if(confirmacion) {
            bootbox.confirm({
                title: 'Confirmación',
                message: '¿Está usted seguro de querer continuar? Una vez haga clic en Continuar NO podrá cambiar la información proporcionada y NO podrá regresar a esta pantalla. Si quiere editar información de estas respuestas haga clic en Cancelar.',
                buttons: {
                    'cancel': {
                    label: 'Cancelar',
                    className: 'btn btn-primary btn-success'
                },
                'confirm': {
                    label: 'Aceptar',
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
            bootbox.alert({message:'Respuesta obligatoria. Por favor, seleccione una opción para continuar.', 
                buttons: {
                    'ok': {
                    label: 'Aceptar',
                    className: 'btn btn-primary btn-success'
                }
            }});
            //alert("Respuesta obligatoria. Por favor, seleccione una opción para continuar.");
        }
    });
});