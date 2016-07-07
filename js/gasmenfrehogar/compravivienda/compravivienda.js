/**
 * Funciones JavaScript Para el Módulo de Compra de Vivienda
 * @author dmdiazf  / @author hhchavezv
 * @since  06/07/2016
 */

$(function(){
	
	ocultarDivsAdicionales([0]); //Ocultar todos los div adicionales
	
	//Ocultar / Mostrar Adicionales Pregunta 1
	$("#p10305[name=p10305]").bind("click",function(){
		if ($(this).val()==1 || $(this).val()==2){
			ocultarDivsAdicionales([1]);
			mostrarDivsAdicionales([1]);
		}	
		else{
			ocultarDivsAdicionales([1]);
		}	
	});
	
	//Ocultar / Mostrar Adicionales Pregunta 2
	$("#p10306s1, #p10306s2").bind("click",function(){
		if ($(this).val()==1){
			mostrarDivsAdicionales([2]);
			ocultarDivsAdicionales([3]);
		}
		else if ($(this).val()==2){ 
			ocultarDivsAdicionales([2]);
			mostrarDivsAdicionales([3]);
		}
	});
	
	//Ocultar / Mostrar Adicionales Pregunta 4
	$("#p10309s1, #p10309s2, #p10309s3, #p10309s4, #p10309s5, #p10309s6").bind("click",function(){		
		if (parseInt($(this).val())==2){
			mostrarDivsAdicionales([4]);
			ocultarDivsAdicionales([5,6]);						
		}
		else if (parseInt($(this).val())==3){
			ocultarDivsAdicionales([4,6]);
			mostrarDivsAdicionales([5]);			
		}
		else if (parseInt($(this).val())==6){
			ocultarDivsAdicionales([4,5]);			
			mostrarDivsAdicionales([6]);
		}
		else{
			ocultarDivsAdicionales([4,5,6]);
		}
	});
	
	//Ocultar / Mostrar Adicionales Pregunta 5
	$("#p5161s1c14[name=p5161s1c14]").bind("click",function(){
		if(parseInt($(this).val())==1){
			mostrarDivsAdicionales([7]);
		}
		else{
			ocultarDivsAdicionales([7]);
		}		
	});
	
	//Ocultar / Mostrar Adicionales Pregunta 5 (Parte 2)
	$("#p5161s2c14[name=p5161s2c14]").bind("click",function(){
		if(parseInt($(this).val())==1){
			mostrarDivsAdicionales([8]);
		}
		else{
			ocultarDivsAdicionales([8]);
		}		
	});
	
	
	
	/***** ********/
	//Ocultar / Mostrar divCV9
	$("#p10312_1, #p10312_2").bind("click",function(){
		if (parseInt($(this).val())==1){
			$("#divCV9").show();
		}
		else{
			$("#divCV9").hide();
		}
	});
	
	//Ocultar / Mostrar divCV10
	$("#p8697s1, #p8697s2, #p8697s3, #p8697s4, #p8697s5, #p8697s6").bind("click",function(){
		if (parseInt($(this).val())==2){			
			$("#divCV11").show();
			$("#divCV12").hide();
			$("#divCV13").hide();
			$("#divCV14").hide();
		}
		else if (parseInt($(this).val())==3){
			$("#divCV11").hide();
			$("#divCV12").show();
			$("#divCV13").hide();
			$("#divCV14").hide();
		}
		else if (parseInt($(this).val())==4){
			$("#divCV11").hide();
			$("#divCV12").hide();
			$("#divCV13").show();
			$("#divCV14").hide();
		}
		else if (parseInt($(this).val())==6){
			$("#divCV11").hide();
			$("#divCV12").hide();
			$("#divCV13").hide();
			$("#divCV14").show();
		}
		else{
			$("#divCV11").hide();
			$("#divCV12").hide();
			$("#divCV13").hide();
			$("#divCV14").hide();
		}
	});
	
	
	
});



//Oculta todos los divs de las preguntas del formulario
//@author dmdiazf / @author hhchavez
//@since  06/07/2016
function ocultarDivsPreguntas(preguntas){
	for (var i=0; i<preguntas.length; i++){		
		switch(parseInt(preguntas[i])){
			case 0: //Ocultar todos los divs
					$("#pregP10305").hide();
					$("#pregP10306").hide();
					$("#pregP10307").hide();
					$("#pregP10309").hide();
					$("#pregP5161").hide();
					$("#pregP10312").hide();
					$("#pregP8697").hide();
					break;
					
			case 1: //Ocultar div pregunta P10305
					$("#pregP10305").hide();
					break;
			
			case 2: //Ocultar div pregunta P10306
					$("#pregP10306").hide();
					break;
			
			case 3: //Ocultar div pregunta P10307
					$("#pregP10307").hide();
					break;
			
			case 4: //Ocultar div pregunta P10309
					$("#pregP10309").hide();
					break;
			
			case 5: //Ocultar div pregunta P5161
					$("#pregP5161").hide();
					break;
			
			case 6: //Ocultar div pregunta P10312
					$("#pregP10312").hide();
					break;
			
			case 7: //Ocultar div pregunta P8697
					$("#pregP8697").hide();
					break;
		}		
	}	
}


//Muestra los divs de las preguntas que se encuentren ocultas
//@author dmdiazf / @author hhchavez
//@since 06/07/2016
function mostrarDivsPreguntas(preguntas){
	for (var i=0; i<preguntas.length; i++){
		switch(parseInt(preguntas[i])){
			case 0: //Mostrar todos los divs
					$("#pregP10305").show();
					$("#pregP10306").show();
					$("#pregP10307").show();
					$("#pregP10309").show();
					$("#pregP5161").show();
					$("#pregP10312").show();
					$("#pregP8697").show();
					break;
			
			case 1: //Mostrar div pregunta P10305
					if ($("#pregP10305").is(":hidden")){
						$("#pregP10305").show();
					}
					break;
	
			case 2: //Mostrar div pregunta P10306
					if ($("#pregP10306").is(":hidden")){
						$("#pregP10306").show();
					}
					break;
	
			case 3: //Mostrar div pregunta P10307
					if ($("#pregP10307").is(":hidden")){
						$("#pregP10307").show();
					}
					break;
	
			case 4: //Mostrar div pregunta P10309
					if ($("#pregP10309").is(":hidden")){
						$("#pregP10309").show();
					}
					break;
	
			case 5: //Mostrar div pregunta P5161
					if ($("#pregP5161").is(":hidden")){
						$("#pregP5161").show();
					}
					break;
	
			case 6: //Mostrar div pregunta P10312
					if ($("#pregP10312").is(":hidden")){
						$("#pregP10312").show();
					}					
					break;
	
			case 7: //Mostrar div pregunta P8697
					if ($("#pregP8697").is(":hidden")){
						$("#pregP8697").show();
					}
					break;		
		}
	}
}


//Oculta todos los divs de preguntas adicionales del formulario
//@author dmdiazf / @author hhchavez
//@since  07/07/2016
function ocultarDivsAdicionales(adiciones){	
	for (var i=0; i<adiciones.length; i++){
		switch(parseInt(adiciones[i])){
			case 0: //Ocultar todos los divs adicionales					
					$("#divCV1").hide();
					$("#divCV2").hide();
					$("#divCV3").hide();
					$("#divCV4").hide();
					$("#divCV5").hide();
					$("#divCV6").hide();
					$("#divCV7").hide();
					$("#divCV8").hide();
					$("#divCV9").hide();
					$("#divCV10").hide();
					$("#divCV11").hide();
					$("#divCV12").hide();
					$("#divCV13").hide();
					$("#divCV14").hide();
					break;
					
			case 1: //Ocultar divCV1
					if (!$("#divCV1").is(":hidden")){
						$("#p10305s1").val("");
						$("#radp10305s1").attr("checked",false);
						$("#radp10305s1").unbind();
						$("#divCV1").hide();
					}
					break;
					
			case 2: //Ocultar divCV2
					if (!$("#divCV2").is(":hidden")){
						$("#p10306s1a1").val("");
						$("#radp10306s1a1").attr("checked",false);
						$("#divCV2").hide();
					}
					break;
					
			case 3: //Ocultar divCV3
					if (!$("#divCV3").is(":hidden")){
						$("#p10306s2a1").val("");
						$("#radp10306s2a1").attr("checked",false);
						$("#divCV3").hide();
					}
					break;
					
			case 4: //Ocultar divCV4
					if (!$("#divCV4").is(":hidden")){
						$("#p10309s2a1 option[value='1']").prop('selected', true);						
						$("#p10309s2a1").attr("disabled",true);
						$("#divCV4").hide();
					}
					break;
					
			case 5: //Ocultar divCV5
					if (!$("#divCV5").is(":hidden")){
						$("#p10309s3a1 option[value='1']").prop('selected', true);
						$("#p10309s3a1").attr("disabled",true);						
						$("#divCV5").hide();
					}
					break;
					
			case 6: //Ocultar divCV6
					if (!$("#divCV6").is(":hidden")){
						$("#p10309s5a1").val("");
						$("#p10309s5a1").attr("disabled",true);
						$("#divCV6").hide();
					}
					break;
					
			case 7: //Ocultar divCV7
					if (!$("#divCV7").is(":hidden")){
						$("#opcion71").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion72").hide(); //Ocultar los divs dentro del div adicional						
						$("#divCV7").hide();
					}
					break;
					
			case 8: //Ocultar divCV8
					if (!$("#divCV8").is(":hidden")){
						$("#opcion81").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion82").hide(); //Ocultar los divs dentro del div adicional
						$("#divCV8").hide();
					}
					break;
					
			case 9: //Ocultar divCV9
					if (!$("#divCV9").is(":hidden")){
						$("#divCV9").hide();
					}
					break;
					
			case 10: //Ocultar divCV10
					if (!$("#divCV10").is(":hidden")){
						$("#divCV10").hide();
					}
					break;
					
			case 11: //Ocultar divCV11
					if (!$("#divCV11").is(":hidden")){
						$("#divCV11").hide();
					}
					break;
					
			case 12: //Ocultar divCV12
					if (!$("#divCV12").is(":hidden")){
						$("#divCV12").hide();
					}
					break;		
					
			case 13: //Ocultar divCV13
					if (!$("#divCV13").is(":hidden")){
						$("#divCV13").hide();
					}
					break;
					
			case 14: //Ocultar divCV13
					if (!$("#divCV14").is(":hidden")){
						$("#divCV14").hide();
					}
					break;
		}		
	}	
}


//Muestra los divs adicionales de las preguntas del formulario
//@author dmdiazf / @author hhchavez
//@since  07/07/2016
function mostrarDivsAdicionales(adiciones){
	for (var i=0; i<adiciones.length; i++){
		switch(parseInt(adiciones[i])){
			case 0: //Mostrar todos los divs adicionales
					$("#divCV1").show();
					$("#divCV2").show();
					$("#divCV3").show();
					$("#divCV4").show();
					$("#divCV5").show();
					$("#divCV6").show();
					$("#divCV7").show();
					$("#divCV8").show();
					$("#divCV9").show();
					$("#divCV10").show();
					$("#divCV11").show();
					$("#divCV12").show();
					$("#divCV13").show();
					$("#divCV14").show();
					break;
					
			case 1: //Mostrar divCV1
					if ($("#divCV1").is(":hidden")){
						if ($("#p10305s1").is(":disabled")){
							$("#p10305s1").attr("disabled",false);
						}
						$("#p10305s1").val("");
						$("#radp10305s1").attr("checked",false);
						$("#radp10305s1").bind("click",function(){
							$("#p10305s1").val("");
							if ($("#p10305s1").is(":enabled")){
								$("#p10305s1").attr("disabled",true);
							}
						});
						$("#divCV1").show();
					}
					break;
					
			case 2: //Mostrar divCV2
					if ($("#divCV2").is(":hidden")){
						if ($("#p10306s1a1").is(":disabled")){
							$("#p10306s1a1").val("");
							$("#p10306s1a1").attr("disabled",false);
						}						
						$("#radp10306s1a1").attr("checked",false);
						$("#radp10306s1a1").bind("click",function(){							
							if ($("#p10306s1a1").is(":enabled")){
								$("#p10306s1a1").val("");
								$("#p10306s1a1").attr("disabled",true);
							}
						});
						$("#divCV2").show();
					}
					break;
					
			case 3: //Mostrar divCV3
					if ($("#divCV3").is(":hidden")){
						if ($("#p10306s2a1").is(":disabled")){
							$("#p10306s2a1").val("");
							$("#p10306s2a1").attr("disabled",false);
						}						
						$("#radp10306s2a1").attr("checked",false);
						$("#radp10306s2a1").bind("click",function(){							
							if ($("#p10306s2a1").is(":enabled")){
								$("#p10306s2a1").val("");
								$("#p10306s2a1").attr("disabled",true);
							}
						});
						$("#divCV3").show();
					}
					break;
					
			case 4: //Mostrar divCV4
					if ($("#divCV4").is(":hidden")){
						$("#p10309s2a1 option[value='1']").prop('selected', true);
						$("#p10309s2a1").attr("disabled",false);
						$("#divCV4").show();
					}
					break;
					
			case 5: //Mostrar divCV5
					if ($("#divCV5").is(":hidden")){
						$("#p10309s3a1 option[value='1']").prop('selected', true);
						$("#p10309s3a1").attr("disabled",false);
						$("#divCV5").show();
					}
					break;
					
			case 6: //Mostrar divCV6					
					if ($("#divCV6").is(":hidden")){
						$("#p10309s5a1").val("");
						$("#p10309s5a1").attr("disabled",false);
						$("#divCV6").show();						
					}					
					break;
					
			case 7: //Mostrar divCV7
					if ($("#divCV7").is(":hidden")){
						$("#opcion71").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion72").hide(); //Ocultar los divs dentro del div adicional
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en dinero?
						$("#p5161s1a1c14[name=p5161s1a1c14]").bind("click",function(){
							if(parseInt($(this).val())==1){								
								$("#p5161s1a3c14").val("");
								$("#radp5161s1a3c14").attr("checked",false);
								if ($("#p5161s1a3c14").is(":disabled")){
									$("#p5161s1a3c14").val("");
									$("#p5161s1a3c14").attr("disabled",false);
								}
								$("#radp5161s1a3c14").bind("click",function(){
									$("#p5161s1a3c14").val("");
									$("#p5161s1a3c14").attr("disabled",true);
								});								
								$("#opcion71").show();								
							}
							else{
								$("#p5161s1a3c14").val("");
								$("#p5161s1a3c14").attr("disabled",true);
								$("#radp5161s1a3c14").attr("checked",false);								
								$("#opcion71").hide();								
							}
						});
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en especie?
						$("#p5161s1a2c14[name=p5161s1a2c14]").bind("click",function(){
							if (parseInt($(this).val())==1){
								$("#p5161s1a4c14").val("");
								$("#radp5161s1a4c14").attr("checked",false);
								if ($("#p5161s1a4c14").is(":disabled")){
									$("#p5161s1a4c14").val("");
									$("#p5161s1a4c14").attr("disabled",false);
								}
								$("#radp5161s1a4c14").bind("click",function(){
									$("#p5161s1a4c14").val("");
									$("#p5161s1a4c14").attr("disabled",true);
								});
								$("#opcion72").show();
							}
							else{
								$("#p5161s1a4c14").val("");
								$("#p5161s1a4c14").attr("disabled",true);
								$("#radp5161s1a4c14").attr("checked",false);
								$("#opcion72").hide();
							}							
						});						
						
						$("#divCV7").show();
					}
					break;
					
			case 8: //Ocultar divCV8
					if ($("#divCV8").is(":hidden")){
						$("#opcion81").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion82").hide(); //Ocultar los divs dentro del div adicional
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en dinero?
						$("#p5161s2a1c14[name=p5161s2a1c14]").bind("click",function(){
							if(parseInt($(this).val())==1){								
								$("#p5161s2a3c14").val("");
								$("#radp5161s2a3c14").attr("checked",false);
								if ($("#p5161s2a3c14").is(":disabled")){
									$("#p5161s2a3c14").val("");
									$("#p5161s2a3c14").attr("disabled",false);
								}
								$("#radp5161s2a3c14").bind("click",function(){
									$("#p5161s2a3c14").val("");
									$("#p5161s2a3c14").attr("disabled",true);
								});								
								$("#opcion81").show();								
							}
							else{
								$("#p5161s2a3c14").val("");
								$("#p5161s2a3c14").attr("disabled",true);
								$("#radp5161s2a3c14").attr("checked",false);								
								$("#opcion81").hide();								
							}
						});
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en especie?
						$("#p5161s2a2c14[name=p5161s2a2c14]").bind("click",function(){
							if (parseInt($(this).val())==1){
								$("#p5161s2a4c14").val("");
								$("#radp5161s2a4c14").attr("checked",false);
								if ($("#p5161s2a4c14").is(":disabled")){
									$("#p5161s2a4c14").val("");
									$("#p5161s2a4c14").attr("disabled",false);
								}
								$("#radp5161s2a4c14").bind("click",function(){
									$("#p5161s2a4c14").val("");
									$("#p5161s2a2c14").attr("disabled",true);
								});
								$("#opcion72").show();
							}
							else{
								$("#p5161s1a4c14").val("");
								$("#p5161s1a4c14").attr("disabled",true);
								$("#radp5161s1a4c14").attr("checked",false);
								$("#opcion72").hide();
							}							
						});						
						
						$("#divCV8").show();
					}
					break;
					
			case 9: //Ocultar divCV9
					if ($("#divCV9").is(":hidden")){
						$("#divCV9").show();
					}
					break;
					
			case 10: //Ocultar divCV10
					if ($("#divCV10").is(":hidden")){
						$("#divCV10").show();
					}
					break;
					
			case 11: //Ocultar divCV11
					if ($("#divCV11").is(":hidden")){
						$("#divCV11").show();
					}
					break;
					
			case 12: //Ocultar divCV12
					if ($("#divCV12").is(":hidden")){
						$("#divCV12").show();
					}
					break;		
					
			case 13: //Ocultar divCV13
					if ($("#divCV13").is(":hidden")){
						$("#divCV13").show();
					}
					break;
					
			case 14: //Ocultar divCV13
					if ($("#divCV14").is(":hidden")){
						$("#divCV14").show();
					}
					break;
		}
	}
}