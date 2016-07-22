/**
 * Funciones JavaScript para seccion Recreacion
 * @author cemedinaa	
 * @since  08-07-2016
 */
$(function() {
	$("#form_5").validate({
        //Reglas de Validacion
        rules : {
            //txt_total         : { required        :  true, expresion: '$("#hdd_nro_articulos").val() ==0' },
            //sel_medio_pago        : { comboBox        :  '-'},
            //txt_otro_medio_pago : {   required        :  true, maxlength: 100}
                    
        },
        //Mensajes de validacion
        messages : {
            //txt_total         : { required        :  "Verifique el subtotal.", expresion :  "No hay artículos o servicios comprados o pagados."},
            //sel_medio_pago        : { comboBox        :  "Seleccione una opci&oacute;n."},
            //txt_otro_medio_pago : {   required        :  "Diligencie c&uacute;al otro medio de pago. ", maxlength     :  "Máximo 100 caracteres"},
            
                        
        },
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
	
	$("#P10395S1A1").rules("add", { required   :   true,  menorQue:1,
		                                                  mayorQue:365,	
        messages: { required   :  "Digite un valor.", menorQue:"Digite un valor mayor de 0",
        												mayorQue:"Digite un valor menor o igual de 365"                  
        	}
    });
	
	/*$( "input[type=checkbox]" ).on( "change", function(){
		var articulos = $( ".articulo" ).length;
		var cont  = 0;
		for(var i=0; i < articulos; i++) {
			var sel = $(":input.ops_" + (i+1) + ":checked").length;
			if(sel > 0) 
				cont++;
		}

		if(articulos == cont)
			$("#env_form_2").prop('disabled', false);
		else $("#env_form_2").prop('disabled', true);
		
	});*/

	// boton enviar
	$("#env_form_5").on("click",function(){
		if ($("#form_5").valid()){
			var myf = $('#form_5');
			var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
			$(this).attr('disabled', true);
			$.ajax({
				type: 'POST',
				url: 'Recreacion/guardar',
				cache: false,
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: args,
				beforeSend: function (objeto) {
					$('#mensaje_').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando m&oacute;dulo</div>');
					//$('#CHK_'+ capitulo).removeClass();
					//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-clock');
				},
				success: function (respuesta) {
					$('#mensaje_').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> '+ respuesta +'</div>');
					//$('#CHK_'+ capitulo).removeClass();
					//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-check');
					//$('.nav-tabs > .active').next('li').find('a').trigger('click');
					//$('#btn_seguir').html('<span id="btn_seguir"><span> <button type="button" name="btnReminder" class="btn btn-success" onClick="location.reload();">Continuar</button>');
					setTimeout(function(){location.href = location.href}, 2000);
				},
				error: function (respuesta) {
					$('#mensaje_').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
					//$('#CHK_'+ capitulo).removeClass();
					//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-cancel');
				}
			});
		}
	});
	
	//Muestra el cuadro texto, dependiendo de la respuesta del cuadro lista
    $(document).ready(function(){ 
    	  //$( "input[type=checkbox]" ).on( "change", function(){
	       $("#art_P10395S1").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10395S1").show();
	            	$("#art_99999999").prop("disabled",true);
	    			$("#art_99999999").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10395S1").hide();
	            	$("#art_99999999").prop("disabled",false);
	    			$("#art_99999999").prop("checked",false);
	             }
	       })
           
           $("#art_P10395S2").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10395S2").show();
	            	$("#art_99999999").prop("disabled",true);
	    			$("#art_99999999").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10395S2").hide();
	            	$("#art_99999999").prop("disabled",false);
	    			$("#art_99999999").prop("checked",false);
	             }
	       })
	       
	       $("#si_P10396").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10396").show();
	            	$("#no_P10396").prop("disabled",true);
	    			$("#no_P10396").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10396").hide();
	            	$("#no_P10396").prop("disabled",false);
	    			$("#no_P10396").prop("checked",false);
	             }
	       })
	       
	       $("#si_P10397S1").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10397S1A1").show();
	            	$("#no_P10397S1").prop("disabled",true);
	    			$("#no_P10397S1").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10397S1A1").hide();
	            	$("#no_P10397S1").prop("disabled",false);
	    			$("#no_P10397S1").prop("checked",false);
	             }
	       })
	       
	       $("#si_P10397S3").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10397S3A1").show();
	            	$("#no_P10397S3").prop("disabled",true);
	    			$("#no_P10397S3").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10397S3A1").hide();
	            	$("#no_P10397S3").prop("disabled",false);
	    			$("#no_P10397S3").prop("checked",false);
	             }
	       })
	       
	       $("#si_P10397S4").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10397S4A1").show();
	            	$("#no_P10397S4").prop("disabled",true);
	    			$("#no_P10397S4").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10397S4A1").hide();
	            	$("#no_P10397S4").prop("disabled",false);
	    			$("#no_P10397S4").prop("checked",false);
	             }
	       })
	       
	       $("#si_P10397S5").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#mostrar_P10397S5A1").show();
	            	$("#no_P10397S5").prop("disabled",true);
	    			$("#no_P10397S5").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10397S5A1").hide();
	            	$("#no_P10397S5").prop("disabled",false);
	    			$("#no_P10397S5").prop("checked",false);
	             }
	       })
	       
	       $("#art_99999999").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$(".ocultar").hide();
	            	$("#art_P10395S1").prop("disabled",true);
	    			$("#art_P10395S1").prop("checked",false);
	    			$("#art_P10395S2").prop("disabled",true);
	    			$("#art_P10395S2").prop("checked",false);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$(".ocultar").show();
	            	$("#art_P10395S1").prop("disabled",false);
	    			$("#art_P10395S1").prop("checked",false);
	    			$("#art_P10395S2").prop("disabled",false);
	    			$("#art_P10395S2").prop("checked",false);
	             }
	       })
       });
    
    $("#si_P10396").click(function(){
    	//alert('mmm');
    	if ($("#si_P10396").prop("checked")){
    		
			$("#no_P10396").prop("disabled",true);
			$("#no_P10396").prop("checked",false);
		}
		/*else{
			$('[name^=chkCategoria]').attr("disabled",false);
			$('[name^=chkServicios]').attr("disabled",false);
			$('[name^=chkServicios]').attr("checked",false);
		}*/
	});
    	
	   
//});	
});