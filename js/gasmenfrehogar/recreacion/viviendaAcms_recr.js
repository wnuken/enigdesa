/**
 * Funciones JavaScript para seccion 3 de ALQUILER DE VIVIENDA, COMBUSTIBLES Y CONEXIÓN DE SERVICIOS PARA LA VIVIENDA 
 * @author hhchavezv	
 * @since  2016jul06
 */


 $(function() {

 	// formulario 1
 	if($( "#form_1" )) {
		$( "input[type=checkbox]" ).on( "change", function(){
			var checked = $( "input:checked" ).length;
			//activar o desactivar boton
			if(checked>0)
				$("#ENV_2_2").prop('disabled', false);
			else $("#ENV_2_2").prop('disabled', true);

			// Activar o desactivar inputs según la selección
			if($(this).attr("id") == "99999999" && $(this).prop("checked")){
				
				$( "input[type=checkbox]" ).each(function(){
					if($(this).attr("id") != "99999999")
						$(this).prop("disabled",true);
				});
			}
			else if ($(this).attr("id") == "99999999" && !$(this).prop("checked")){
				$( "input[type=checkbox]" ).each(function(){
					if($(this).attr("id") != "99999999")
						$(this).prop("disabled",false);
				});
			}
			else if ($(this).attr("id") != "99999999" && $(this).prop("checked")){
				$("#99999999").prop("disabled",true);
			}
			else if ($(this).attr("id") != "99999999" && !$(this).prop("checked")){
				var checkedElems = 0;
				$( "input[type=checkbox]" ).each(function(){
					if($(this).attr("id") != "99999999" && $(this).prop("checked"))
						checkedElems++;
				});
				if(checkedElems == 0)
					$("#99999999").prop("disabled",false);
			}
		});
	}


	// valida formulario 2
	if($( "#form_2" )) {
		$( "input[type=checkbox]" ).on( "change", function(){
			var articulos = $( ".articulo" ).length;
			var cont  = 0;
			for(var i=0; i < articulos; i++) {
				var sel = $(":input.ops_" + (i+1) + ":checked").length;
				if(sel > 0) 
					cont++;
			}

			if(articulos == cont)
				$("#ENV_2_2").prop('disabled', false);
			else $("#ENV_2_2").prop('disabled', true);
			
		});
	}

	// boton enviar
	$(".btn-success").on("click",function(){
		var myf = $('#form_1');
		var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
		$(this).attr('disabled', true);
		$.ajax({
			type: 'POST',
			url: '<?=site_url("modgasmenfrehogar/Recreacion/guardar/")?>',
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
				setTimeout(function(){location.reload()}, 2000);
			},
			error: function (respuesta) {
				$('#mensaje_').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
				//$('#CHK_'+ capitulo).removeClass();
				//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-cancel');
			}
		});
	});
});
 
	/*$(function(){
	$("#div_otro_pago").hide();
	//$("#txt_total").numerico().largo(15);
	
	$("#form_sec3_C1").validate({
		//Reglas de Validacion
		rules : {
			txt_total    		: {	required        :  true},
			sel_medio_pago    	: {	comboBox        :  '-'},
			txt_otro_medio_pago : {	required        :  true, maxlength: 100}
					
		},
		//Mensajes de validacion
		messages : {
			txt_total    		: {	required        :  "Verifique el subtotal."},
			sel_medio_pago    	: {	comboBox        :  "Seleccione una opci&oacute;n."},
			txt_otro_medio_pago : {	required        :  "Diligencie c&uacute;al otro medio de pago. ", maxlength		:  "Máximo 100 caracteres"},
			
						
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
	
	// VAlidaciones de la tabla de articulos
	pag3_valida_articulos_pagados();
	var nom_boton_form3="btn_form3_C1";
	$("#"+nom_boton_form3).click(function()
	{
		// Vuelve a realizar suma total de pago de tabla articulos
		pag3_suma_articulos();
		
		if ($("#form_sec3_C1").valid() == true){
		
			if(window.confirm('Haga clic en Aceptar si realmente quiere guardar y continuar a la siguiente secci\u00f3n.'))
			{
				//Activa icono guardando
				$("#pag3_error").css("display", "none");
				$("#pag3_cargando").css("display", "inline");
				$("#"+nom_boton_form3).attr('disabled','-1');
				$.ajax({  
					url: base_url + "modgasmenfrehogar/ViviendaAcms/guardaGrillaCompra",
					type: "POST",
					dataType: "html",
					data: $("#form_sec3_C1").serialize(),
					success: function(data){
						if(data ==="-ok-")
						{	
							alert('Guardado correctamente !!!');
							$("#pag3_cargando").css("display", "none");
							location.reload();
						}	
						else
						{   alert('ERROR al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.');
							$("#pag3_cargando").css("display", "none");
							$("#pag3_error").css("display", "inline");
							$("#"+nom_boton_form3).removeAttr('disabled');
						}	
						
					},
						error: function(result) {
							alert('ERROR al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.');
							$("#pag3_cargando").css("display", "none");
							$("#pag3_error").css("display", "inline");
							$("#"+nom_boton_form3).removeAttr('disabled');
							
						}
					
					});
			}		
		}//if			
		//else
		//{
		//	alert("El formulario tiene errores. Revise y corrija.");
		//}
	});
	
	
	$("#sel_medio_pago").blur(function()
	{
		if( $(this).val() == 6){
			$("#div_otro_pago").show();
			$("#txt_otro_medio_pago").attr("disabled",false);			
		}
		else
		{
			$("#div_otro_pago").hide();
			$("#txt_otro_medio_pago").val("");
			$("#txt_otro_medio_pago").attr("disabled",true);
		}
	});
		
});*///EOC

// Construye las validaciones de la tabla de articulos
/*function pag3_valida_articulos_pagados()
{	
	var nro_articulos=parseInt ($("#hdd_nro_articulos").val() );
	
	//Genera validaciones 
	
	for (x=0; x<nro_articulos; x=x+1) 
	{ 	
		var valor="#txt_valor_"+x;
		var no_recuerda="#chk_no_recuerda_"+x;
		var lugar="#sel_lugar_"+x;
		var frec="#sel_frec_"+x;
		
		//Formato
		$(valor).numerico().largo(8);
		
		// Validaciones
		$(valor).rules("add", { required   :   true,  menorIgualQue:500,
					 messages: { required   :  "Digite un valor.", menorIgualQue:"Digite un valor mayor de 500"}
					});
		/*$(no_recuerda).rules("add", { required   :   true, 
					 messages: { required   :  "Digite un valor."}
					});*/
		$(lugar).rules("add", { comboBox   :   '-', 
					 messages: { comboBox   :  "seleccione una opci\u00f3n."}
					});
		$(frec).rules("add", { comboBox   :   '-', 
					 messages: { comboBox   :  "seleccione una opci\u00f3n."}
					});
	}
}//func

// Suma automatica de valor pagado en tabla articulos
function pag3_suma_articulos()
{
	var nro_articulos=parseInt ($("#hdd_nro_articulos").val() );
	var suma=0;
		
	for (x=0; x<nro_articulos; x=x+1) 
	{
		var valor="#txt_valor_"+x;
		if(parseInt( $(valor).val() ) >=0)
			suma= suma+parseInt( $(valor).val() );
	}
	$("#txt_total").attr("value",suma);
}//func

// Deshabilita pago, si hizo clic en check de no recuerda valor
function pag3_deshabilita_pago(fila)
{
		if($("#chk_no_recuerda_"+fila).is(':checked')) {
			$("#txt_valor_"+fila).val("");
			$("#txt_valor_"+fila).attr("disabled",true);			
		}
		else
		{
			$("#txt_valor_"+fila).attr("disabled",false);	
		}	
		// Vuelve a realizar suma total
		pag3_suma_articulos();
	
}//func



// NOTA: lo siguiente para adicionar en danevalidator
		//**************************************************************************************************
	//** Funciones adicionales utilizadas por las reglas de validacion adicionales del jQuery Validator
	//**************************************************************************************************
	
	//1) Evalua una cadena de texto recibida como parametro y retorna el resultado 
	function convertirOperacion(cadena){
		var result = 0;
		if ((typeof cadena)=='string')
			result = eval(cadena);	
		else if((typeof cadena)=='number')
			result = cadena;
		return parseInt(result);
	}
	//*****************************************************************************************************************
	//** Compara y valida que el valor de una caja de texto sea menor o igual que el valor que se recibe por parametro
	//*****************************************************************************************************************
	$.validator.addMethod("menorIgualQue",function(value, element, param){
		var comp = convertirOperacion(param); 
		var valor = parseInt($(element).val());
        if (valor <= comp){			                            	  
      	  return false;
        }
        else{
      	  return true;
        }
    },"");*/