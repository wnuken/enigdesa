/**
 * Funciones JavaScript Para el Módulo de Compra de Vivienda
 * @author dmdiazf  / @author hhchavezv
 * @since  06/07/2016
 */

$(function(){
	
	ocultarDivsInicio(); //Ocultar todos los divs al inicio del formulario
	
	//Ocultar / Mostrar divCV1
	$("#p10305[name=p10305]").bind("click",function(){
		if ($(this).val()==1 || $(this).val()==2){
			$("#p10305s1").val("");
			$("#divCV1").show();			
		}	
		else{
			$("#p10305s1").val("");
			$("#divCV1").hide();
		}	
	});
	
	//Ocultar / Mostrar divCV2 y divCV3
	$("#p10306s1, #p10306s2").bind("click",function(){
		if ($(this).val()==1){
			$("#divCV2").show();
			$("#divCV3").hide();
		}
		else if ($(this).val()==2){
			$("#divCV2").hide();
			$("#divCV3").show();
		}
	});
	
	//Ocultar / Mostrar divCV4, divCV5, divCV6
	$("#p10309s1, #p10309s2, #p10309s3, #p10309s4, #p10309s5, #p10309s6").bind("click",function(){		
		if (parseInt($(this).val())==2){			
			$('#p10309s2a1 option[value="1"]').attr("selected",true);
			$("#divCV4").show();
			$('#p10309s3a1 option[value="1"]').attr("selected",true);
			$("#divCV5").hide();
			$("#p10309s5a1").val("");
			$("#divCV6").hide();
		}
		else if (parseInt($(this).val())==3){
			$('#p10309s2a1 option[value="1"]').attr("selected",true);
			$("#divCV4").hide();
			$('#p10309s3a1 option[value="1"]').attr("selected",true);
			$("#divCV5").show();
			$("#p10309s5a1").val("");
			$("#divCV6").hide();
		}
		else if (parseInt($(this).val())==6){
			$('#p10309s2a1 option[value="1"]').attr("selected",true);
			$("#divCV4").hide();
			$('#p10309s3a1 option[value="1"]').attr("selected",true);
			$("#divCV5").hide();
			$("#p10309s5a1").val("");
			$("#divCV6").show();
		}
		else{
			$('#p10309s2a1 option[value="1"]').attr("selected",true);
			$("#divCV4").hide();
			$('#p10309s3a1 option[value="1"]').attr("selected",true);
			$("#divCV5").hide();
			$("#p10309s5a1").val("");
			$("#divCV6").hide();
		}
	});
	
	//Ocultar / Mostrar divCV7
	$("#p5161s1c14_1, #p5161s1c14_2").bind("click",function(){
		if(parseInt($(this).val())==1){
			$("#divCV7").show();
		}
		else{
			$("#divCV7").hide();
		}
	});
	
	//Ocultar / Mostrar divCV8
	$("#p5161s2c14_1, #p5161s2c14_2").bind("click",function(){
		if(parseInt($(this).val())==1){
			$("#divCV8").show();
		}
		else{
			$("#divCV8").hide();
		}
	});
	
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


//Oculta los divs adicionales al iniciar por primera vez el formulario
//@author dmdiazf / @author hhchavez
//@since  06/07/2016
function ocultarDivsInicio(){	
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
	
	$("#p10305s1").bloquearTexto();
	
}

