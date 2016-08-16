/**
 * Funciones JavaScript para seccion 3 de ALQUILER DE VIVIENDA, COMBUSTIBLES Y CONEXIÓN DE SERVICIOS PARA LA VIVIENDA 
 * @author hhchavezv	
 * @since  2016jul06
 */
 
	$(function(){ 
	
	$("#div_otro_pago").hide();
	$("#txt_total").numerico().largo(15);
	$("#txt_total_credito").numerico().largo(15);
	
	$("#form_sec3").validate({
		//Reglas de Validacion
		rules : {
			txt_total    		: {	required        :  true, expresion: '$("#hdd_nro_articulos").val() ==0' },
			txt_total_credito    		: {	required        :  true, expresion: '$("#hdd_nro_articulos").val() ==0' },
			sel_medio_pago    	: {	comboBox        :  '-'},
			txt_otro_medio_pago : {	required        :  true, minlength:5 ,maxlength: 100}
					
		},
		//Mensajes de validacion
		messages : {
			txt_total    		: {	required        :  "Verifique el subtotal.", expresion :  "No hay artículos o servicios comprados o pagados."},
			txt_total_credito    		: {	required        :  "Verifique el subtotal.", expresion :  "No hay artículos o servicios comprados o pagados."},
			sel_medio_pago    	: {	comboBox        :  "Seleccione una opci&oacute;n."},
			txt_otro_medio_pago : {	required        :  "Diligencie cu&aacute;l otro medio de pago. ", 
														minlength		:  "Mínimo 5 caracteres",
														maxlength	:  "Máximo 100 caracteres"},
			
						
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
	var nom_boton_form3="btn_form3";
	$("#"+nom_boton_form3).click(function()
	{
		// Vuelve a realizar suma total de pago de tabla articulos
		pag3_suma_articulos(1);
		if($("#txt_total_credito").length >0){
			pag3_suma_articulos(2);
		}
		if ($("#form_sec3").valid() == true){
		
			//if(window.confirm('Haga clic en Aceptar si realmente quiere guardar y continuar a la siguiente secci\u00f3n.'))
			bootbox.confirm({ // o dialog 
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
						/*,callback: function() {
							alert("great success");
						}*/
					}
					
				}
				,onEscape: false
				,closeButton: false				
			, callback: function(result) {
				if(result) {// Si dio clic en continuar
				//Activa icono guardando
				$("#pag3_error").css("display", "none");
				$("#pag3_cargando").css("display", "inline");
				$("#"+nom_boton_form3).attr('disabled','-1');
				$.ajax({  
					url: base_url + "modgasmenfrehogar/ViviendaAcms/guardaGrillaCompra",
					type: "POST",
					dataType: "html",
					data: $("#form_sec3").serialize(),
					success: function(data){
						if(data ==="-ok-")
						{								
						/*	bootbox.alert({message:'Guardado correctamente !!!', 
							buttons: {
								'ok': {
								label: 'Aceptar',
								className: 'btn btn-primary btn-success'
							}
							}
							,onEscape: false
							,closeButton: false
							});*/
							$("#pag3_cargando").html("<b>Guardado correctamente !!!</b>");
							//$("#pag3_cargando").css("display", "none");
							 setTimeout(function () {
                                    location.href = location.href
                                }, 2000);
							//location.reload();	
						}	
						else
						{  
							bootbox.alert({message:'ERROR al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.', 
							buttons: {
								'ok': {
								label: 'Aceptar',
								className: 'btn btn-primary btn-success'
							}
							}
							,closeButton: false
							});
							$("#pag3_cargando").css("display", "none");
							$("#pag3_error").css("display", "inline");
							$("#"+nom_boton_form3).removeAttr('disabled');
						}	
						
					},
						error: function(result) {
							bootbox.alert({message:'ERROR al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.', 
							buttons: {
								'ok': {
								label: 'Aceptar',
								className: 'btn btn-primary btn-success'
							}
							}
							,closeButton: false
							});
							$("#pag3_cargando").css("display", "none");
							$("#pag3_error").css("display", "inline");
							$("#"+nom_boton_form3).removeAttr('disabled');							
						}
					
					});
				}	
			}});		
		}//if			
		
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
	
	
	// Poner punto de miles a los valores estimados
    $( "input[type=text]" ).on( "keyup blur", function() {
		// Validaciones
		var id_campo=this.id;
			if(id_campo != "txt_otro_medio_pago"){// campo de texto			
				var numero = $(this).val().replace(/\./g, '');			
				var numConMiles = agregarPuntosMiles(numero);
				$(this).val(numConMiles);  			
			}
			
			
    });
	
	
	
});//EOC

// Construye las validaciones de la tabla de articulos
function pag3_valida_articulos_pagados()
{	
	var nro_articulos=parseInt ($("#hdd_nro_articulos").val() );
	// Mascara para miles
	
	//Genera validaciones 
	
	for (x=0; x<nro_articulos; x=x+1) 
	{ 	
		
		var valor="#txt_valor_"+x;
		var no_recuerda="#chk_no_recuerda_"+x;
		var valor_credito="#txt_valor_credito_"+x;
		var no_recuerda_credito="#chk_credito_no_recuerda_"+x;
		
		var lugar="#sel_lugar_"+x;
		var frec="#sel_frec_"+x;
		
		var rango_min= parseInt( $("#hdd_rango_min").val(), 10);
		var rango_max= parseInt( $("#hdd_rango_max").val(), 10);
		
		
		//Formato
	/*	$(valor).numerico().largo(11);
		$(valor_credito).numerico().largo(11);
		*/
		if(!isNaN(rango_max)) {
			$( valor ).numerico().largo(agregarPuntosMiles(rango_max).length);
			$( valor_credito ).numerico().largo(agregarPuntosMiles(rango_max).length);
		}
		
		// Elige validacion para valor pagado, dependiendo de si esta presente columna credito en cuyo caso se permite el cero.
		if($(valor_credito).length >0){// si existe
					
			$(valor_credito).rules("add", { required   :   true,  
										//menorQue_puntoMiles:rango_min,  										
										expresion: '( quitarPuntoMiles($("'+valor_credito+'").val()) > 0 && quitarPuntoMiles($("'+valor_credito+'").val()) < '+rango_min+')',
										mayorQue_puntoMiles:rango_max,
										esEntero_puntoMiles : true, 
							 messages: { required   :  "Digite un valor.", 
										//menorQue_puntoMiles:"Digite un valor mayor de "+agregarPuntosMiles(rango_min), 
										expresion:"Digite un valor mayor de "+agregarPuntosMiles(rango_min)+", o digite cero" , 
										mayorQue_puntoMiles:"Digite un valor menor de "+agregarPuntosMiles(rango_max)+", o digite cero",
										esEntero_puntoMiles: "Digite solo números."}
					});
					
			$(valor).rules("add", { required   :   true,  
								//menorQue_puntoMiles:rango_min,
								expresion: '( quitarPuntoMiles($("'+valor+'").val()) > 0 && quitarPuntoMiles($("'+valor+'").val()) < '+rango_min+')',	
								mayorQue_puntoMiles:rango_max,
								esEntero_puntoMiles : true, 
					 messages: { required   :  "Digite un valor.", 
								 expresion:"Digite un valor mayor de "+agregarPuntosMiles(rango_min)+", o digite cero", 
								 mayorQue_puntoMiles:"Digite un valor menor de "+agregarPuntosMiles(rango_max)+", o digite cero",
								 esEntero_puntoMiles: "Digite solo números."
							   }
					});		
										
		}else{// Sin columna credito
			$(valor).rules("add", { required   :   true,  
								menorQue_puntoMiles:rango_min, 
								mayorQue_puntoMiles:rango_max,
								esEntero_puntoMiles : true, 
					 messages: { required   :  "Digite un valor.", 
								 menorQue_puntoMiles:"Digite un valor mayor de "+agregarPuntosMiles(rango_min), 
								 mayorQue_puntoMiles:"Digite un valor menor de "+agregarPuntosMiles(rango_max),
								 esEntero_puntoMiles: "Digite solo números."
							   }
					});
		}			
		$(lugar).rules("add", { comboBox   :   '-', 
					 messages: { comboBox   :  "seleccione una opci\u00f3n."}
					});
		$(frec).rules("add", { comboBox   :   '-', 
					 messages: { comboBox   :  "seleccione una opci\u00f3n."}
					});
	}
}//func

// Suma automatica de valor pagado en tabla articulos
function pag3_suma_articulos(tipo)
{
	var nro_articulos=parseInt ($("#hdd_nro_articulos").val() );
	var suma=0;
	
	for (x=0; x<nro_articulos; x=x+1) 
	{
		if(tipo ==1){
			var valor="#txt_valor_"+x;
			
		}else if(tipo ==2){
			var valor="#txt_valor_credito_"+x;
		}
		
		
		var cifra=	quitarPuntoMiles( $(valor).val() );
		if( cifra  >=0){
			suma= suma+ cifra;			
			}
	}
	suma=agregarPuntosMiles(suma);
	
	if(tipo ==1){	
		$("#txt_total").val(suma);	
	}else if(tipo ==2){ 
		$("#txt_total_credito").val(suma);	
	}
}//func

// Deshabilita pago, si hizo clic en check de no recuerda valor
function pag3_deshabilita_pago(fila, tipo)
{
	if(tipo ==1){
	var check="#chk_no_recuerda_"+fila;
	var valor="#txt_valor_"+fila;
	}else if(tipo ==2){
	var check="#chk_credito_no_recuerda_"+fila;
	var valor="#txt_valor_credito_"+fila;
	}
	
		if($(check).is(':checked')) {
			$(valor).val("");
			$(valor).attr("disabled",true);			
		}
		else
		{
			$(valor).attr("disabled",false);	
		}	
		// Vuelve a realizar suma total
		pag3_suma_articulos(tipo);
	
	
}//func

/**
 * Función que coloca punto separador de miles
 */
var agregarPuntosMiles = function(numero){
        return String(numero).split(/(?=(?:\d{3})+$)/).join(".");// nota: en BD la coma es el separador de miles
    }

/**
 * Función que quita punto separador de miles
 */
function quitarPuntoMiles(campo)
{
	//var cifra=campo.replace(".", ""); //solo reemplaza la primer ocurrencia
	var cifra=replaceAll(campo, ".", "" );// con funcion para reemplazar todas las ocurrencias
	cifra=parseInt(cifra ,10);
	
	return cifra;
}

/**
 * Función que permite reemplazar TODAS las subcadenas encontradas
 * en un string por otra nueva subcadena.
 */
function replaceAll(text, search, newstring ){
    while (text.toString().indexOf(search) != -1)
        text = text.toString().replace(search,newstring);
    return text;
}

	//****************************************************************************************************************
	//** Compara y valida que el valor de una caja de texto sea menor que el valor que se recibe por parametro
	//****************************************************************************************************************
	$.validator.addMethod("menorQue_puntoMiles",function(value, element, param){
		var comp = convertirOperacion(param);
		var valor = quitarPuntoMiles($(element).val());
	    if (valor < comp)			                            	  
	        return false;
		else
		    return true;		    
	},"");
	
	//****************************************************************************************************************
	//** Compara y valida que el valor de una caja de texto sea mayor que el valor que se recibe por parametro
	//****************************************************************************************************************
	$.validator.addMethod("mayorQue_puntoMiles", function(value, element, param) {
		var comp = convertirOperacion(param);
		var valor = quitarPuntoMiles($(element).val());
		if (valor > comp)
			return false;
		else
			return true;
	}, "");
	
	//*****************************************************************************************************************
    //** Verifica si el valor de un input es un entero
    //*****************************************************************************************************************
    $.validator.addMethod("esEntero_puntoMiles", function(value, element, param){
        var valor = replaceAll($(element).val(), ".", "" );
		//var expNumerica = /^[+-]?\d+([,.]\d+)?$/;
		//var expNumerica = /^[+-]?\d+([,.]\d+([,.]\d+))?$/;
		//var expNumerica = /^\d+|[,.]|\d+?$/;// valida cifra con punto de separacion de miles
		
		valor=String(valor);// funcion match requiere q sea string
		var expNumerica = /^[0-9]+$/;
        if(valor.match(expNumerica))
            return true;
        else
            return false;
    },"");