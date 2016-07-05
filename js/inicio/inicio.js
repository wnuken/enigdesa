/**
 * Funciones JavaScript Para el Módulo de Inicio
 * @author Daniel M. Díaz
 * @since  23/09/2015
 */


$(function(){
	
	//Si el navegador es Internet Explorer, se redirecciona al módulo de Internet Explorer
	redirectBrowser();
	
	//Lanzar AJAX para averiguar el estado de avance del formulario. Cada módulo da avance del 25%.
	actualizarAvance();
		
});



/**
 * Ejecuta una función AJAX que consulta el estado de avance del diligenciamiento del formulario y actualiza la barra de progreso
 * @author dmdiazf	
 * @since  21/10/2015  
 **/
function actualizarAvance(){	
	
	$.ajax({
		type: "POST",
		url: base_url + "inicio/inicio/actualizarAvance",
		data: {},					
		dataType: "json",
		contentType: "application/x-www-form-urlencoded;charset=UTF-8",
		cache: false,
		success: function(data){
			
			var avance = data.avance;
			var porcent = data.avance.toString() + "%";
			$("#progressbar").css("width",porcent);
			
			//var hoy = obtenerFecha(); //obtener fecha actual con javascript			
			//var hoy = new Date("2016-03-02"); //!!! ELIMINAR ESTA LINEA Y QUITAR EL COMENTARIO DE LA ANTERIOR !!! POR FAVOR !!!
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth(); //January is 0!
			var yyyy = today.getFullYear();
			var hoy = new Date(yyyy,mm,dd);
						
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth(); //January is 0!
			var yyyy = today.getFullYear();
			var hoy = new Date(yyyy,mm,dd);
			
			var ini = new Date(data.fec_ini); //fecha de inicio de la inscripcion
			var fin = new Date(data.fec_fin); //fecha de fin de la inscripcion
			var inid = new Date(data.fec_inid); //Fecha de inicio del diligenciamiento
			var find = new Date(data.fec_find); //Fecha de fin del diligenciamiento
			
			if ((hoy >= ini)&&(hoy <= fin)){			
				habilitarRegistro(data.campo0); 	//Activar el panel del Registro
				bloquearVivienda(data.campo1);  	//Bloqueo panel de vivienda
				bloquearHogar(data.campo2); 	 	//Bloqueo panel de hogar
				bloquearPersonas(data.campo3);  	//Bloqueo panel de personas
			}
			else if ((hoy >= inid)&&(hoy <= find)&&(parseInt(data.campo0)==2)){				
				
				if ((parseInt(data.campo0)==2)&&(parseInt(data.campo1)!=2)&&(parseInt(data.campo2)!=2)&&(parseInt(data.campo3)!=2)){				
					bloquearRegistro(data.campo0);  //Bloqueo panel de registro
					habilitarVivienda(data.campo1); //Activar el panel de vivienda
					bloquearHogar(data.campo2);     //Bloqueo panel de hogar
					bloquearPersonas(data.campo3);  //Bloqueo panel de personas
				}
				
				if ((parseInt(data.campo0)==2)&&(parseInt(data.campo1)==2)&&(parseInt(data.campo2)!=2)&&(parseInt(data.campo3)!=2)){
					bloquearRegistro(data.campo0);  //Bloqueo panel de registro
					bloquearVivienda(data.campo1);  //Activar el panel de vivienda
					habilitarHogar(data.campo2);    //Bloqueo panel de hogar
					bloquearPersonas(data.campo3);  //Bloqueo panel de personas
				}
				
				if ((parseInt(data.campo0)==2)&&(parseInt(data.campo1)==2)&&(parseInt(data.campo2)==2)&&(parseInt(data.campo3)!=2)){
					bloquearRegistro(data.campo0);  //Bloqueo panel de registro
					bloquearVivienda(data.campo1);  //Bloqueo panel de vivienda
					bloquearHogar(data.campo2);     //Bloqueo panel de hogar
					habilitarPersonas(data.campo3); //Activar panel de personas
				}
				
				if ((parseInt(data.campo0)==2)&&(parseInt(data.campo1)==2)&&(parseInt(data.campo2)==2)&&(parseInt(data.campo3)==2)){
					bloquearRegistro(data.campo0);	//Bloqueo panel de registro	 
					habilitarVivienda(data.campo1);	//Bloqueo panel de vivienda
					habilitarHogar(data.campo2);     //Bloqueo panel de hogar  
					habilitarPersonas(data.campo3);  //Bloqueo panel de personas
				}	
				
				//Mostrar ó esconder la barra de desplazamiento y el botón de envío del formulario (con base en los estados de los modulos y el estado general del formulario)
				if ((parseInt(data.campo0)==2)&&(parseInt(data.campo1)==2)&&(parseInt(data.campo2)==2)&&(parseInt(data.campo3)==2)){ //Valida el estado de cada uno de los módulos
					if (data.campo4>=11){ //Valida el estado general del formulario
						mostrarEnvioFormulario();								
					}
				}
					
			}
			else if ((hoy >= inid)&&(hoy <= find) && (parseInt(data.campo0)!=2)){				
				habilitarRegistro(data.campo0);		//Activar panel de registro
				bloquearVivienda(data.campo1);		//Bloqueo panel de vivienda
				bloquearHogar(data.campo2);			//Bloqueo panel de hogar	
				bloquearPersonas(data.campo3);		//Bloqueo panel de personas
				
				//Mostrar ó esconder la barra de desplazamiento y el botón de envío del formulario (con base en los estados de los modulos y el estado general del formulario)
				if ((parseInt(data.campo0)==2)&&(parseInt(data.campo1)==2)&&(parseInt(data.campo2)==2)&&(parseInt(data.campo3)==2)){ //Valida el estado de cada uno de los módulos
					if (data.campo4>=11){ //Valida el estado general del formulario
						mostrarEnvioFormulario();								
					}
				}
			}
			else {
				//alert("ES UN ERROR !!! NO estoy dentro de ninguna fecha. Bloqueo todo !!!");				
				bloquearRegistro(data.campo0);		//Bloqueo panel de registro
				bloquearVivienda(data.campo1);		//Bloqueo panel de vivienda
				bloquearHogar(data.campo2);		//Bloqueo panel de hogar
				bloquearPersonas(data.campo3);		//Bloqueo panel de personas			
			}
		},
		error: function(data){
			if (data.status!=200){
				alert("ERROR: " + data.status + "\n" + data.statusText + "\n" + data.responseText.trim());
			}
		}		
	});	
	
}


/**
* Bloquea el panel de registro
* @author dmdiazf
* @since  01/03/2016
*/
function bloquearRegistro(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod0").attr("src",img);
	}	
	$("#panelRegistro").removeClass("panel panel-yellow");
	$("#panelRegistro").addClass("panel panel-disabled");			
	$("#panelRegistro").bind("click",function(){
		return false;					
	});	
}

/**
* Habilita el panel de registro
* @author dmdiazf
* @since  01/03/2016
*/
function habilitarRegistro(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod0").attr("src",img);
	}	
	$("#panelRegistro").removeClass("panel panel-disabled");
	$("#panelRegistro").addClass("panel panel-yellow");	
	$("#panelRegistro").bind("click",function(){
		$("html, body").scrollTop(0); //OJO
		var url = base_url + "registro";    
		$(location).attr("href",url);					
	});
}

/**
* Bloquea el panel de vivienda
* @author dmdiazf
* @since  01/03/2016
*/
function bloquearVivienda(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod1").attr("src",img);
	}
	$("#panelVivienda").removeClass("panel panel-red");
	$("#panelVivienda").addClass("panel panel-disabled");
	$("#panelVivienda").bind("click",function(){
		return false;
	});
}

/**
* Habilita el panel de vivienda
* @author dmdiazf
* @since  01/03/2016
*/
function habilitarVivienda(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod1").attr("src",img);
	}	
	$("#panelVivienda").removeClass("panel panel-disabled");
	$("#panelVivienda").addClass("panel panel-red");				
	$("#panelVivienda").bind("click",function(){
		$("html, body").scrollTop(0); //OJO
		var url = base_url + "vivienda";    
		$(location).attr("href",url);					
	});
}

/**
 * Bloquear el panel de hogar
 * @author dmdiazf
 * @since  01/03/2016
 */
function bloquearHogar(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod2").attr("src",img);
	}
	$("#panelHogar").removeClass("panel panel-green");
	$("#panelHogar").addClass("panel panel-disabled");
	$("#panelHogar").bind("click",function(){
		return false;
	});
}

/**
 * Habilitar el panel de hogar
 * @author dmdiazf
 * @since  01/03/2016
 */
function habilitarHogar(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod2").attr("src",img);
	}
	$("#panelHogar").removeClass("panel panel-disabled");
	$("#panelHogar").addClass("panel panel-green");
	$("#panelHogar").bind("click",function(){
		$("html, body").scrollTop(0);
		var url = base_url + "hogar";    
		$(location).attr("href",url);
	});
}

/**
 * Bloquear el panel de personas
 * @author dmdiazf
 * @since  01/03/2016
 */
function bloquearPersonas(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod3").attr("src",img);
	}
	$("#panelPersonas").removeClass("panel panel-blue");
	$("#panelPersonas").addClass("panel panel-disabled");
	$("#panelPersonas").bind("click",function(){
		return false;
	});
}

/**
 * Habilitar el panel de personas
 * @author dmdiazf
 * @since  01/03/2016
 */
function habilitarPersonas(campo){
	if (campo==2){
		var img = base_url + "/images/tick.png"; 
		$("#imgmod3").attr("src",img);
	}
	$("#panelPersonas").removeClass("panel panel-disabled");
	$("#panelPersonas").addClass("panel panel-blue");
	$("#panelPersonas").bind("click",function(){
		$("html, body").scrollTop(0);
		var url = base_url + "persona";    
		$(location).attr("href",url);
	});	
}




/**
 * Obtiene la fecha actual desde javascript en formato yyyy-mm-dd
 * @author dmdiazf
 * @since  20/01/2016
 */
function obtenerFecha(){
	var fecha = new Date();
	var ano = fecha.getFullYear();
	var mes = (parseInt(fecha.getMonth()+1) < 9)?"0"+parseInt(fecha.getMonth()+1):parseInt(fecha.getMonth()+1);
	var dia = fecha.getDate();
	var strFecha = ano + "-" + mes + "-" + dia;
	return new Date(strFecha);
}



/**
 * Muestra el boton de envio de formulario cuando el formulario ha sido diligenciado completamente
 * @author dmdiazf
 * @since  29/10/2015
 **/
function mostrarEnvioFormulario(){	
	$("#barfinal").html('<div style="text-align: center;"><button type="button" id="btnSatisfaccion" class="btn btn-lg btn-primary">Enviar Formulario</button></div>');
	$("#btnSatisfaccion").bind("click",function(){		
		var url = base_url + "encuesta/";
		$(location).attr("href",url);
	});
}




/**
 * Pruebas crono - Cronometrar el tiempo que demora cada usuario respondiendo una pregunta.
 * Cuando el usuario acceda al javascript de inicio se debe crear la primera entrada de hora de inicio del JS
 * @author dmdiazf
 * @since  14/01/2016
 **/
function marcaCrono(item){
	//Que pasa si dos usuarios distintos responden ???
	//Que pasa con el array crono ???
	//Se cruzan las respuestas ???
	var tiempo = new Date();
	crono.push(tiempo.getHours() + ":" + tiempo.getMinutes() + ":" + tiempo.getSeconds());
}