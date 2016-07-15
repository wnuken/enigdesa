/**
 * Funciones JavaScript para formulario 2
 * @author cemedinaa	
 * @since  08-07-2016
 */
$(function () {
    $("input[type=checkbox]").on("change", function () {
        var articulos = $(".articulo").length;
        var cont = 0;
        for (var i = 0; i < articulos; i++) {
            var sel = $(":input.ops_" + (i + 1) + ":checked").length;
            if (sel > 0)
                cont++;
        }
        if (articulos == cont)
            $("#env_form_2").prop('disabled', false);
        else
            $("#env_form_2").prop('disabled', true);

    });

    $("#form_2").submit(function(e){
        e.preventDefault();
    });
    
    // boton enviar
    $("#env_form_2").on("click", function () {
        var myf = $('#form_2');
        var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
        $(this).attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: location.href + '/guardar_form2',
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
                setTimeout(function () {
                    location.href = location.href
                }, 2000);
            }
        });
    });
});