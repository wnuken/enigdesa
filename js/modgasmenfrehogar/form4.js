/**
 * Funciones JavaScript para formulario 4
 * @author cemedinaa	
 * @since  15-07-2016
 */
$(function () {
    $("#form_4").validate({
        //Reglas de Validacion
        /*rules : {
            //txt_total         : { required        :  true, expresion: '$("#hdd_nro_articulos").val() ==0' },
            //sel_medio_pago        : { comboBox        :  '-'},
            //txt_otro_medio_pago : {   required        :  true, maxlength: 100}
                    
        },
        //Mensajes de validacion
        messages : {
            //txt_total         : { required        :  "Verifique el subtotal.", expresion :  "No hay artículos o servicios comprados o pagados."},
            //sel_medio_pago        : { comboBox        :  "Seleccione una opci&oacute;n."},
            //txt_otro_medio_pago : {   required        :  "Diligencie c&uacute;al otro medio de pago. ", maxlength     :  "Máximo 100 caracteres"},
            
                        
        },*/
        //Mensajes de error
        errorPlacement: function(error, element) {
            element.after(error);               
            error.css('display','inline');
            error.css('margin-left','10px');                
            error.css('color',"#FF0000");
            
        //$(element).focus();//si se coloca no muestra todos los errores, va mostrando de uno en uno
        },
        submitHandler: function(form) {
            return true;
            
        }
    });
    
    $( "input[type=text]" ).numerico().largo(15);
    //$( "input[type=text]" ).bloquearTexto();

    $( "input[type=text]" ).each(function() {
            // Validaciones
            if($(this).attr("name") && !$(this).prop("disabled")) {
                $(this).rules("add", { required   :   true,  menorIgualQue:500,
                    messages: { required   :  "Digite un valor.", menorIgualQue:"Digite un valor mayor de 500"}
                });
            }
        });


    $( "input[type=checkbox]" ).on( "change", function(){

        var idInput = $(this).attr("id");
        idInput = "#" + idInput.replace("chb_","txt_");

        if($(this).prop("checked")) {
            $(idInput).prop("disabled",true);
            $(idInput).val("");
        }
        else {
            $(idInput).prop("disabled",false);
            $(idInput).val("");
        }
        
        var inputs = $(".activo").length, condicion = 1;

        for(var i = 1; i <= inputs; i++) {
            if($(".valor_"+i+"_input").val() || $(".valor_"+i+"_input").prop("checked") )
                condicion++;
        }

        //if(condicion == i)
        //  $("#env_form_4").prop('disabled', false);
        //else $("#env_form_4").prop('disabled', true);
        
    });

    $( "input[type=text]" ).on( "blur", function(){


        var inputs = $(".activo").length, condicion = 1;

        for(var i = 1; i <= inputs; i++) {
        //while($(".valor_"+i+"_input")) {
            if($(".valor_"+i+"_input").val() || $(".valor_"+i+"_input").prop("checked") )
                condicion++;
        }

        //if(condicion == i)
        //  $("#env_form_4").prop('disabled', false);
        //else $("#env_form_4").prop('disabled', true);
    });

    $("#form_4").submit(function(e){
        e.preventDefault();
    });

    // boton enviar
    $("#env_form_4").on("click", function () {
        if ($("#form_4").valid()){
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
                            mensaje += arrRespuesta[1][m];
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
    });
});