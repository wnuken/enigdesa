/**
 * Funciones JavaScript para seccion Recreacion
 * @author cemedinaa	
 * @since  08-07-2016
 */
$(function() {
	
	//VALIDACIONES PARA EL MODULO I
	$("#form_5").validate({
		rules : {
			P10395S1A1 : {required   :  true,
							mayorQue:365,
							menorQue:1
			},
			P10395S2A1 : {	required : true,
							mayorQue:365,
							menorQue:1
			}, 
			P10396S1 : {	required : true,
							mayorQue : 365,
							menorQue : 1
			},
			P10396S2 : {	required : true,
							mayorQue : 20000000,
							menorQue : 50000
			}
			
		},
		messages : {
			P10395S1A1 : {	required:"Falta cantidad de viajes nacional.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10395S2A1 : {	required:"Falta cantidad de viajes internacional.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10396S1 : {	required:"Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10396S2 : {	required:" Por favor, digite un valor o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 20.000.000",
							menorQue:"Digite un valor mayor de 50.000" 
			}
			
		},
		errorPlacement: function(error, element) {
			//Mostrar el error en la parte de abajo de la caja de texto.
			element.after(error);		        
			error.css('display','block');
			error.css('float','none');
			error.css('vertical-align','top');
			error.css('margin-left','10px');				
			error.css('color',"#FF0000");
		},
		submitHandler: function(form) {
			//No se ejecuta nada.
			//Solo se indica si el formulario fue valido o no.
		}
	});
	
	/*$("#form_5").validate({
        //Reglas de Validacion
        rules : {
        	//P10395S1A1         : { required        :  true
            //sel_medio_pago        : { comboBox        :  '-'},
            //txt_otro_medio_pago : {   required        :  true, maxlength: 100}
                    
        },
        //Mensajes de validacion
        messages : {
        	//P10395S1A1         : { required        :  "Verifique el subtotal."}
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
    });*/
	
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
		if(!$("#art_P10395S1").prop('checked')  && !$("#art_P10395S2").prop('checked') && !$("#art_99999999").prop('checked')){
			bootbox.alert({message:'Respuesta obligatoria. Por favor, seleccione una opción de la sección P10395 para continuar.', 
                buttons: {
                    'ok': {
                    label: 'Aceptar',
                    className: 'btn btn-primary btn-success'
                }
            }});
		}
		else if(!$("#si_P10396").prop('checked') && $("#si_P10396").is(':visible')  && !$("#no_P10396").prop('checked') && $("#no_P10396").is(':visible')){
			bootbox.alert({message:'Respuesta obligatoria. Por favor, seleccione una opción de la sección P10396 para continuar.', 
                buttons: {
                    'ok': {
                    label: 'Aceptar',
                    className: 'btn btn-primary btn-success'
                }
            }});
		}
		else{
			if ($("#form_5").valid()){
				
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
		            }});
				
			
			}
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
	    			$("#art_P10395S1").prop("checked",true);
	    			$("#art_P10395S2").prop("checked",true);
	    			$(".ocultarAlojamiento").hide();
	    			$("#mostrar_P10395S1").show();
	    			$("#mostrar_P10395S2").show();
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10396").hide();
	            	$("#no_P10396").prop("disabled",false);
	    			$("#no_P10396").prop("checked",false);
	    			$("#art_P10395S1").prop("checked",false);
	    			$("#art_P10395S2").prop("checked",false);
	    			$(".ocultarAlojamiento").show();
	    			//$("#mostrar_P10395S1").hide();
	    			//$("#mostrar_P10395S2").hide();
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
	    			$("#P10395S1A1").prop("disabled",true);
	    			$("#P10395S2A1").prop("disabled",true);
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$(".ocultar").show();
	            	$("#art_P10395S1").prop("disabled",false);
	    			$("#art_P10395S1").prop("checked",false);
	    			$("#art_P10395S2").prop("disabled",false);
	    			$("#art_P10395S2").prop("checked",false);
	    			$("#P10395S1A1").prop("disabled",false);
	    			$("#P10395S2A1").prop("disabled",true);
	             }
	       }) 
	       
	       $("#art_P10396S1_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P10396S1").val("");
	            	$("#P10396S1").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P10396S1").prop("disabled",false);
	            	
	    		 }
	       })
	       
	       $("#art_P10396S2_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P10396S2").val("");
	            	$("#P10396S2").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P10396S2").prop("disabled",false);
	            	
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