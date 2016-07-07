/**
 * Funciones JavaScript para seccion 3 de ALQUILER DE VIVIENDA, COMBUSTIBLES Y CONEXIÓN DE SERVICIOS PARA LA VIVIENDA 
 * @author hhchavezv	
 * @since  2016jul06
 */
 
	$(function(){
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
						{   alert('Error al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.');
							$("#pag3_cargando").css("display", "none");
							$("#pag3_error").css("display", "inline");
							$("#"+nom_boton_form3).removeAttr('disabled');
						}	
						
					},
						error: function(result) {
							alert('Error al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.');
							$("#pag3_cargando").css("display", "none");
							$("#pag3_error").css("display", "inline");
							$("#"+nom_boton_form3).removeAttr('disabled');
							
						}
					
					});
			}		
		}//if			
		/*else
		{
			alert("El formulario tiene errores. Revise y corrija.");
		}*/
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
		
});//EOC

// Construye las validaciones de la tabla de articulos
function pag3_valida_articulos_pagados()
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
    },"");