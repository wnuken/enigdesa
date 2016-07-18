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
        alert($("input:checked[type=radio]").val());
        if($("input:checked[type=checkbox]").length > 0 || ($("input:checked[type=radio]") && $("input:checked[type=radio]").val() == 2) ) {
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
        else {
            alert("Respuesta obligatoria. Por favor, seleccione una opción para continuar.");
        }
    });
});