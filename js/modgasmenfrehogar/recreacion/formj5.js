/**
 * Funciones JavaScript para seccion Recreacion
 * @author cemedinaa	
 * @since  08-07-2016
 */
$(function() {
	
	var agregarPuntosMiles = function(numero){
        return String(numero).split(/(?=(?:\d{3})+$)/).join(".");
    }
	
	//VALIDACIONES PARA EL MODULO I
	$("#form_5").validate({
		//ignore:"",
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
							
			},
			P10397S1A1 : {	required : true,
							mayorQue : 365,
							menorQue : 1
			},
			P10397S3A1 : {	required : true,
							mayorQue : 365,
							menorQue : 1
			},
			P10397S4A1 : {	required : true,
							mayorQue : 365,
							menorQue : 1
			},
			P10397S5A1 : {	required : true,
							mayorQue : 365,
							menorQue : 1
			},
			P3J1324 : {	required : true,
							mayorQue : 20000000,
							menorQue : 50000
			}
			
		},
		messages : {
			P10395S1A1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.l.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10395S2A1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10396S1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10396S2 : {	required:"Respuesta obligatoria. Por favor, digite un valor o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 20.000.000",
							menorQue:"Digite un valor mayor de 50.000"
							
			},
			P10397S1A1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10397S3A1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10397S4A1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P10397S5A1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 365",
							menorQue:"Digite un valor mayor de 0" 
			},
			P3J1324 : {	required:"Respuesta obligatoria. Por favor, digite un valor o seleccione una opci&oacute;n para continuar.",
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
	
		// boton enviar
	$("#env_form_5").on("click",function(){
		$("#art_P10395S1").on("change",function(){
			if($(this).prop('checked')){
			$("#art_P10395S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#art_P10395S2").on("change",function(){
			if($(this).prop('checked')){
			$("#art_P10395S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#art_99999999").on("change",function(){
			if($(this).prop('checked')){
			$("#art_P10395S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#si_P10396").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10396").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#no_P10396").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10396").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#si_P10397S1").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#no_P10397S1").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#si_P10397S3").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S3").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#no_P10397S3").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S3").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#si_P10397S4").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S4").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#no_P10397S4").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S4").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#si_P10397S5").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S5").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#no_P10397S5").on("change",function(){
			if($(this).prop('checked')){
			$("#si_P10397S5").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#P10398S1").on("change",function(){
			if($(this).prop('checked')){
			$("#P10398S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#P10398S2").on("change",function(){
			if($(this).prop('checked')){
			$("#P10398S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#P10398S3").on("change",function(){
			if($(this).prop('checked')){
			$("#P10398S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		$("#P10398S4").on("change",function(){
			if($(this).prop('checked')){
			$("#P10398S1").parent().parent().removeClass("alert alert-danger");
			$('#mensaje').html('');
			}
		});
		if(!$("#art_P10395S1").prop('checked')  && !$("#art_P10395S2").prop('checked') && !$("#art_99999999").prop('checked')){
			/*bootbox.alert({message:'Respuesta obligatoria. Por favor, seleccione una opción de la sección P10395 para continuar.', 
                buttons: {
                    'ok': {
                    label: 'Aceptar',
                    className: 'btn btn-primary btn-success'
                }
            }});*/
			$("#art_P10395S1").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
		}
		else if(!$("#si_P10396").prop('checked') && $("#si_P10396").is(':visible')  && !$("#no_P10396").prop('checked') && $("#no_P10396").is(':visible')){
			$("#si_P10396").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
		}
		else if(!$("#si_P10397S1").prop('checked')  && $("#si_P10397S1").is(':visible') && !$("#no_P10397S1").prop('checked')  && $("#no_P10397S1").is(':visible')){
			$("#si_P10397S1").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
        }
		else if(!$("#si_P10397S3").prop('checked')  && $("#si_P10397S3").is(':visible') && !$("#no_P10397S3").prop('checked')  && $("#no_P10397S3").is(':visible')){
			$("#si_P10397S3").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
        }
		else if(!$("#si_P10397S4").prop('checked')  && $("#si_P10397S4").is(':visible') && !$("#no_P10397S4").prop('checked')  && $("#no_P10397S4").is(':visible')){
			$("#si_P10397S4").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
        }
		else if(!$("#si_P10397S5").prop('checked')  && $("#si_P10397S5").is(':visible') && !$("#no_P10397S5").prop('checked')  && $("#no_P10397S5").is(':visible')){
			$("#si_P10397S5").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
        }
		else if(!$("#P10398S1").prop('checked') && $("#P10398S1").is(':visible') && !$("#P10398S2").prop('checked') && $("#P10398S2").is(':visible') && !$("#P10398S3").prop('checked') && $("#P10398S3").is(':visible') && !$("#P10398S4").prop('checked') && $("#P10398S4").is(':visible')){
			$("#P10398S1").parent().parent().addClass("alert alert-danger");
			$('#mensaje').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true">Respuesta obligatoria. Por favor, seleccione una opción para continuar.</span></div>');
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
		    					url: 'Recreacion/guardar_formJ5',
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
	    			//$("#art_P10395S1").prop("checked",true);
	    			//$("#art_P10395S2").prop("checked",true);
	    			$(".ocultarAlojamiento").hide();
	    			//$("#mostrar_P10395S1").show();
	    			//$("#mostrar_P10395S2").show();
	            }else{
	                //$("#formularioRubros").css("display", "none");
	            	$("#mostrar_P10396").hide();
	            	$("#no_P10396").prop("disabled",false);
	    			$("#no_P10396").prop("checked",false);
	    			//$("#art_P10395S1").prop("checked",false);
	    			//$("#art_P10395S2").prop("checked",false);
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
	       
	       $("#art_P10397S1A1_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P10397S1A1").val("");
	            	$("#P10397S1A1").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P10397S1A1").prop("disabled",false);
	            	
	    		 }
	       })
	       
	        $("#art_P10397S3A1_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P10397S3A1").val("");
	            	$("#P10397S3A1").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P10397S3A1").prop("disabled",false);
	            	
	    		 }
	       })
	       
	       $("#art_P10397S4A1_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P10397S4A1").val("");
	            	$("#P10397S4A1").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P10397S4A1").prop("disabled",false);
	            	
	    		 }
	       })
	       
	       $("#art_P10397S5A1_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P10397S5A1").val("");
	            	$("#P10397S5A1").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P10397S5A1").prop("disabled",false);
	            	
	    		 }
	       })
	       
	       $("#art_P3J1324_99").change(function () {
	   			opcion=$(this).val();
	            if($(this).prop('checked')){
	               // $("#formularioRubros").css("display", "block");
	            	$("#P3J1324").val("");
	            	$("#P3J1324").prop("disabled",true);
	    		}else{
	                //$("#formularioRubros").css("display", "none");
	    			$("#P3J1324").prop("disabled",false);
	            	
	    		 }
	       })
	       
       });
    
 // Poner punto de miles a los valores estimados
    $( "#P10396S2" ).on( "keyup blur", function() {
        // Validaciones
        //if($(this).attr("name") && !$(this).prop("disabled")) {
            var numero = $(this).val().replace(/\./g, '');
            var numConMiles = agregarPuntosMiles(numero);
            $(this).val(numConMiles);
            //var idIpt = $(this).attr("id");
            //$("#" + idIpt.replace("mask_","")).val(numero);
        //}
    });
    
    $( "#P3J1324" ).on( "keyup blur", function() {
        // Validaciones
        //if($(this).attr("name") && !$(this).prop("disabled")) {
            var numero = $(this).val().replace(/\./g, '');
            var numConMiles = agregarPuntosMiles(numero);
            $(this).val(numConMiles);
            //var idIpt = $(this).attr("id");
            //$("#" + idIpt.replace("mask_","")).val(numero);
        //}
    });
    
    
    //
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