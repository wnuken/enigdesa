/**
 * Funciones JavaScript Para el Módulo de Compra de Vivienda
 * @author dmdiazf  / @author hhchavezv
 * @since  06/07/2016
 */

$(function(){
	$("#frmCompraVivienda").validate({
		rules : {
			p10305s1 : {required   :  false,
							menorQue: 100000
			},
			p10306s1a1 : {	required : false,
							menorQue: 100000
			}, 
			p10306s2a1 : {	required : false,
							menorQue : 100000
			},
			p5161s1a3c14 : {	required : false,
							mayorQue : 35000000,
							menorQue : 500000
							
			},
			p5161s1a4c14 : {	required : false,
							mayorQue : 35000000,
							menorQue : 500000
			},
			p5161s2a3c14 : {	required : false,
							mayorQue : 35000000,
							menorQue : 500000
			},
			p5161s2a4c14 : {	required : false,
							mayorQue : 35000000,
							menorQue : 500000
			},
			p10312s1 : {	required : false,
							mayorQue : 35000000,
							menorQue : 500000
			},
			p8697s4a1 : {	required : false,
							mayorQue : 35000000,
							menorQue : 500000
			}
			
		},
		messages : {
			p10305s1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.l.",
							menorQue:"Digite un valor menor o igual a 100.000",
			},
			p10306s1a1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							menorQue:"Digite un valor menor o igual a 100.000",
			},
			p10306s2a1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							menorQue:"Digite un valor menor o igual de 100.000",
			},
			p5161s1a3c14 : {	required:"Respuesta obligatoria. Por favor, digite un valor o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 35.000.000",
							menorQue:"Digite un valor mayor de 500.000"
							
			},
			p5161s1a4c14 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 35.000.000",
							menorQue:"Digite un valor mayor de 500.000" 
			},
			p5161s2a3c14 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 35.000.000",
							menorQue:"Digite un valor mayor de 500.000" 
			},
			p5161s2a4c14 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 35.000.000",
							menorQue:"Digite un valor mayor de 500.000" 
			},
			p10312s1 : {	required:"Respuesta obligatoria. Por favor, digite un n&uacute;mero o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 35.000.000",
							menorQue:"Digite un valor mayor de 500.000" 
			},
			p8697s4a1 : {	required:"Respuesta obligatoria. Por favor, digite un valor o seleccione una opci&oacute;n para continuar.",
							mayorQue:"Digite un valor menor o igual de 35.000.000",
							menorQue:"Digite un valor mayor de 500.000" 
			}
					
		},
        //Mensajes de error
        errorPlacement: function(error, element) {
            element.after(error);            
            error.css('display','inline');
            error.css('margin-left','10px');                
            error.css('color',"#FF0000");
        },
        submitHandler: function(form) {
            return true;
            
        }
    });
	$("#p10305s1, #p10306s1a1, #p10306s2a1").largo(15);
	$("#p5161s1a3c14, #p5161s1a4c14, #p5161s2a3c14, #p5161s2a4c14, #p10312s1, #p8697s4a1").largo(8);
	$("#p10309s5a1, #p8697s7a1").largo(500);

    
	var agregarPuntosMiles = function(numero){
        return String(numero).split(/(?=(?:\d{3})+$)/).join(".");
    }
    var hallarAncestroMasCercano = function(elem,idsarr){
        for(i in idsarr) {
        	j = 1;
        	elem = elem.parent();
        	var id = elem.attr("id");
        	//console.log("id="+id);
        	while(id != idsarr[i] && !elem.is('body')){
        		console.log(id +" != "+ idsarr[i]);
        		//console.log(id);
        		elem = elem.parent();
        		id = elem.attr("id");
        		console.log(id);
        		j++;    		
        	}
        	console.log(idsarr[i]+" tiene un numero de saltos de "+j);
        }

    }
    var revalidarPreguntas = function(id){
    	if(id.indexOf('p10305') != -1) {
    		//console.log("revalida pregunta 1");
    		//console.log($.contains( $("#ops_pregunta1"), $(this)) );
    		///console.log($.contains( $(this), $("#divCV1") ) );
    		//console.log($(this).parents("#main-ops_pregunta1"));
    		//console.log($(this).parents("#main-divCV1"));
    		//$("#ops_pregunta1").removeClass("alert alert-danger");
			//$("#divCV1").removeClass("alert alert-danger");
			//console.log("-----"+$('#'+id).attr('id'));
			hallarAncestroMasCercano($('#'+id),['ops_pregunta1','divCV1']);
    		var preg1 = validarPregunta1(null);
    	}
    	if(id.indexOf('p10306') != -1) {
    		console.log("revalida pregunta 2");
    		var preg2 = validarPregunta2();
    	}
    	if(id.indexOf('p10307') != -1) {
    		console.log("revalida pregunta 3");
			var preg3 = validarPregunta3();
		}
		if(id.indexOf('p10309s') != -1) {
			console.log("revalida pregunta 4");
			var preg4 = validarPregunta4();
		}
		if(id.indexOf('p5161s') != -1) {
			console.log("revalida pregunta 5");
			var preg51 = validarPregunta51();
			//var preg52 = validarPregunta52();
		}
		if(id.indexOf('p10312') != -1) {
			console.log("revalida pregunta 6");
			var preg6 = validarPregunta6();
		}
		if(id.indexOf('p8697s') != -1) {
			console.log("revalida pregunta 7");
			var preg7 = validarPregunta7();
		}
    };
    $("input:checkbox,input:radio").on("change", function () {
    	console.log("tooltip is:" + $("#ops_pregunta1").data('ui-tooltip'));
    	revalidarPreguntas($(this).attr('id'));
    });
	ocultarDivsAdicionales([0]); //Ocultar todos los div adicionales
	//ocultarDivsPreguntas([0]);// 

	//Ocultar / Mostrar Adicionales Pregunta 1
	$("input[name=p10305]").bind("change",function(){
		if ($(this).val()==1 || $(this).val()==2){
			ocultarDivsAdicionales([1]);
			mostrarDivsAdicionales([1]);
		}	
		else{
			ocultarDivsAdicionales([1]);
		}	
	});
	
	//Ocultar / Mostrar Adicionales Pregunta 2
	/*$("#p10306s1, #p10306s2").bind("click",function(){
		if ($(this).val()==1){
			mostrarDivsAdicionales([2]);
			ocultarDivsAdicionales([3]);
		}
		else if ($(this).val()==2){ 
			ocultarDivsAdicionales([2]);
			mostrarDivsAdicionales([3]);
		}
	});*/
	$("#p10306s1, #p10306s2").bind("change",function(){
		if ($(this).prop("checked") && $(this).attr("id") == "p10306s1"){
			mostrarDivsAdicionales([2]);
			$("#p10309s2, #p10309s3").prop('checked', false);
			$("#p10309s2, #p10309s3").prop('disabled', true);
			ocultarDivsAdicionales([4]);
			ocultarDivsAdicionales([5]);
			//mostrarDivsPreguntas([4]);
		} else if (!$(this).prop("checked") && $(this).attr("id") == "p10306s1") {
			ocultarDivsAdicionales([2]);
			$("#p10309s2, #p10309s3").prop('checked', false);
			$("#p10309s2, #p10309s3").prop('disabled', false);
			ocultarDivsAdicionales([4]);
			ocultarDivsAdicionales([5]);
			//ocultarDivsPreguntas([4]);
		}
		else if ($(this).prop("checked") && $(this).attr("id") == "p10306s2"){
			mostrarDivsAdicionales([3]);
			//mostrarDivsPreguntas([3]);
		} else if (!$(this).prop("checked") && $(this).attr("id") == "p10306s2") {
			ocultarDivsAdicionales([3]);
			//ocultarDivsPreguntas([3]);
		}

	});
	
	//Ocultar / Mostrar Adicionales Pregunta 4
	$("#p10309s1, #p10309s2, #p10309s3, #p10309s4, #p10309s5, #p10309s6").bind("change",function(){
		if ($(this).prop("checked") && $(this).attr("id") == "p10309s2"){
			mostrarDivsAdicionales([4]);
			//ocultarDivsAdicionales([5,6]);						
		}
		else if (!$(this).prop("checked") && $(this).attr("id") == "p10309s2"){
			ocultarDivsAdicionales([4]);
		}
		if ($(this).prop("checked") && $(this).attr("id") == "p10309s3"){
			mostrarDivsAdicionales([5]);
		}
		else if (!$(this).prop("checked") && $(this).attr("id") == "p10309s3"){
			ocultarDivsAdicionales([5]);
		}
		if ($(this).prop("checked") && $(this).attr("id") == "p10309s6"){
			//ocultarDivsAdicionales([4,5]);			
			mostrarDivsAdicionales([6]);
		}
		else if (!$(this).prop("checked") && $(this).attr("id") == "p10309s6"){
			ocultarDivsAdicionales([6]);
		}
		/*else{
			ocultarDivsAdicionales([4,5,6]);
		}*/
	});
	
	//Mostrar Adicionales Pregunta 5
	$("#p5161s1c14_1").bind("click",function(){
			mostrarDivsAdicionales([7]);	
	});

	//Ocultar Adicionales Pregunta 5
	$("#p5161s1c14_2").bind("click",function(){
		ocultarDivsAdicionales([7]);	
	});
	
	//Mostrar Adicionales Pregunta 5 (Parte 2)
	$("#p5161s2c14_1").bind("click",function(){
		mostrarDivsAdicionales([8]);
	});

	//Ocultar Adicionales Pregunta 5 (Parte 2)
	$("#p5161s2c14_2").bind("click",function(){
		ocultarDivsAdicionales([8]);
	});
	
	//Ocultar Adicionales Pregunta 6
	$("#p10312_1").bind("click",function(){
		mostrarDivsAdicionales([9]);
	});

	//Ocultar Adicionales Pregunta 6
	$("#p10312_2").bind("click",function(){
		ocultarDivsAdicionales([9]);
	});
	
	//Ocultar / Mostrar Adicionales Pregunta 7
	$("#p8697s1, #p8697s2, #p8697s3, #p8697s4, #p8697s5, #p8697s6").bind("change",function(){		
		if ($(this).is(':checked') && $(this).attr('id') == "p8697s2"){ //Prestamo Hipotecario
			mostrarDivsAdicionales([10]);			
		}
		else if (!$(this).is(':checked') && $(this).attr('id') == "p8697s2"){
			ocultarDivsAdicionales([10]);
		}
		if ($(this).is(':checked') && $(this).attr('id') == "p8697s3"){ //Prestamo Bancario de libre inversion
			mostrarDivsAdicionales([11]);
		}
		else if(!$(this).is(':checked') && $(this).attr('id') == "p8697s3") {
			ocultarDivsAdicionales([11]);
		}

		if ($(this).is(':checked') && $(this).attr('id') == "p8697s4"){ //Subsidios
			mostrarDivsAdicionales([12]);
		}
		else if (!$(this).is(':checked') && $(this).attr('id') == "p8697s4"){
			ocultarDivsAdicionales([12]);
		}

		if ($(this).is(':checked') && $(this).attr('id') == "p8697s6"){ //Otra
			mostrarDivsAdicionales([13]);
		}
		else if (!$(this).is(':checked') && $(this).attr('id') == "p8697s6"){
			ocultarDivsAdicionales([13]);
		}
	});	
	
	
	//Botón para realizar validaciones y envio del formulario
	$("#btnCompraVivienda").bind("click",function(){		
		
		var preg1 = validarPregunta1(null);
		var preg2 = validarPregunta2();
		var preg3 = validarPregunta3();
		var preg4 = validarPregunta4();
		var preg51 = validarPregunta51();
		//var preg52 = validarPregunta52();
		var preg6 = validarPregunta6();
		var preg7 = validarPregunta7();
		
// temporal pruebas	

		//enviarFormulario();//pruebas
		//return false;//prebas
		$('#mensaje_').html('');	
		if (preg1 && preg2 && preg3 && preg4 && preg51 && preg52 && preg6 && preg7 && $("#frmCompraVivienda").valid() ){		
			enviarFormulario();
		}
		else{
			$('#mensaje_').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
		}		
	});
	
	
	
	
	
});


//Ejecuta función AJAX y guarda la informacion diligenciada en el formulario
//@author dmdiazf / @author hhchavez
//@since  12/07/2016
function enviarFormulario(){	
	if ($("#frmCompraVivienda").valid() == true){
		bootbox.confirm({
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
                }
            }, callback: function(result) {
                if(result) {
                    //Activa icono guardando
					$("#pagCompraViv_error").css("display", "none");
					$("#pagCompraViv_cargando").css("display", "inline");
					$("#btnCompraVivienda").attr('disabled','-1');
					$.ajax({  
						url: base_url + "modgasmenfrehogar/ViviendaCompra/guardaGrillaCompraViv",
						type: "POST",
						dataType: "html",
						data: $("#frmCompraVivienda").serialize(),
						success: function(data){
							if(data ==="-ok-")
							{	
								alert('Guardado correctamente !!!');
								$("#pagCompraViv_cargando").css("display", "none");
								location.reload();
							}	
							else
							{   alert('ERROR al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.');
								$("#pagCompraViv_cargando").css("display", "none");
								$("#pagCompraViv_error").css("display", "inline");
								$("#btnCompraVivienda").removeAttr('disabled');
							}	
							
						},
							error: function(result) {
								alert('ERROR al guardar la secci\u00f3n. Intente nuevamente o recargue la p\u00e1gina.');
								$("#pagCompraViv_cargando").css("display", "none");
								$("#pagCompraViv_error").css("display", "inline");
								$("#btnCompraVivienda").removeAttr('disabled');
								
							}
						
						});
                }
            }});	
		}//if			
		
	
	
	
}

//Validar la pregunta Nro. 1 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta1(secc){
	if(typeof $("#ops_pregunta1").data('ui-tooltip') != 'undefined'){
		$("#ops_pregunta1").tooltip('destroy');
		$("#ops_pregunta1").popover('destroy');
	}
	if(typeof $("#divCV1").data('ui-tooltip') != 'undefined'){
		$("#divCV1").tooltip('destroy');
		$("#divCV1").popover('destroy');
	}
	$("#ops_pregunta1").removeClass("alert alert-danger");
	$("#divCV1").removeClass("alert alert-danger");
	var preg1 = true;
	if( (secc == null || secc == 'ops_pregunta1') && !$("#p10305_1").prop("checked") && !$("#p10305_2").prop("checked") && !$("#p10305_3").prop("checked") ) {
		$("#ops_pregunta1").addClass("alert alert-danger");
		$("#ops_pregunta1").tooltip();
		$("#ops_pregunta1").popover();
		preg1 = false;
	}	
    // Valor opcion 1 o 2
    else if( (secc == null || secc == 'divCV1') && ($("#p10305_1").prop("checked") || $("#p10305_2").prop("checked") ) && ( ($("#p10305s1").val() == "" && !$("#radp10305s1").is(':checked'))
    	|| ($("#p10305s1").val() != "" && $("#radp10305s1").is(':checked')) ) )  {
    	$("#divCV1").addClass("alert alert-danger");
    	$("#divCV1").tooltip();
		$("#divCV1").popover();
    	preg1 = false;
    }
	
	return preg1;
}

//Validar la pregunta Nro. 2 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta2(){
	if(typeof $("#ops_pregunta2").data('ui-tooltip') != 'undefined'){
		$("#ops_pregunta2").tooltip('destroy');
		$("#ops_pregunta2").popover('destroy');
	}
	if(typeof $("#divCV3").data('ui-tooltip') != 'undefined'){
		$("#divCV3").tooltip('destroy');
		$("#divCV3").popover('destroy');
	}
	if(typeof $("#divCV2").data('ui-tooltip') != 'undefined'){
		$("#divCV2").tooltip('destroy');
		$("#divCV2").popover('destroy');
	}
	$("#ops_pregunta2").removeClass("alert alert-danger");
	$("#divCV3").removeClass("alert alert-danger");
	$("#divCV2").removeClass("alert alert-danger");

	var preg2 = true;

	//de contado o a credito
	if(!$("#p10306s1").is(":checked") && !$("#p10306s2").is(":checked") && ($("#p10305_1").prop("checked") || $("#p10305_2").prop("checked") ) ) {
		$("#ops_pregunta2").removeClass("alert alert-danger").addClass("alert alert-danger");
		$("#ops_pregunta2").tooltip();
		$("#ops_pregunta2").popover();
		preg2 = false;
	}

    // valor de credito 
    else if(!$("#radp10306s1a1").is(':checked') && $("#p10306s1a1").val() == "" && $("#p10306s1").prop("checked") ) {
		$("#divCV2").addClass("alert alert-danger");
		$("#divCV2").tooltip();
		$("#divCV2").popover();
		preg2 = false;
	}
	//valor de contado
	else if(!$("#radp10306s2a1").is(':checked') && $("#p10306s2a1").val() == "" && $("#p10306s2").prop("checked") ) {
		$("#divCV3").addClass("alert alert-danger");
		$("#divCV3").tooltip();
		$("#divCV3").popover();
		preg2 = false;
	}

	return preg2;
}


//Validar la pregunta Nro. 3 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta3(){
	//Validar que todos los radios se encuentren marcados
	if(typeof $("#ops_pregunta3").data('ui-tooltip') != 'undefined'){
		$("#ops_pregunta3").tooltip('destroy');
		$("#ops_pregunta3").popover('destroy');
	}
	$("#ops_pregunta3").removeClass("alert alert-danger");
	var preg3 = true;
	// pregunta 3
    if(!$("#p10307_1").prop("checked") && !$("#p10307_2").prop("checked") && $("#p10306s1").prop("checked") ) {
    	$("#ops_pregunta3").addClass("alert alert-danger");
    	$("#ops_pregunta3").tooltip();
		$("#ops_pregunta3").popover();
		preg2 = false;
    }

	return preg3;
}


//Validar la pregunta Nro. 4 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta4(){
	//Validar que todos los radios se encuentren marcados
	if(typeof $("#ops_pregunta4").data('ui-tooltip') != 'undefined'){
		$("#ops_pregunta4").tooltip('destroy');
		$("#ops_pregunta4").popover('destroy');
	}
	if(typeof $("#divCV4").data('ui-tooltip') != 'undefined'){
		$("#divCV4").tooltip('destroy');
		$("#divCV4").popover('destroy');
	}
	if(typeof $("#divCV5").data('ui-tooltip') != 'undefined'){
		$("#divCV5").tooltip('destroy');
		$("#divCV5").popover('destroy');
	}
	if(typeof $("#divCV6").data('ui-tooltip') != 'undefined'){
		$("#divCV6").tooltip('destroy');
		$("#divCV6").popover('destroy');
	}
	$("#ops_pregunta4").removeClass("alert alert-danger");
	$("#divCV4").removeClass("alert alert-danger");
	$("#divCV5").removeClass("alert alert-danger");
	$("#divCV6").removeClass("alert alert-danger");
	var preg4 = true;
	if(!$("#p10309s1").prop("checked") && !$("#p10309s2").prop("checked") && !$("#p10309s3").prop("checked") && !$("#p10309s4").prop("checked") &&  
		!$("#p10309s5").prop("checked") && !$("#p10309s6").prop("checked") && ($("#p10305_1").prop("checked") || $("#p10305_2").prop("checked") ) ) {
		$("#ops_pregunta4").addClass("alert alert-danger");
		$("#ops_pregunta4").tooltip();
		$("#ops_pregunta4").popover();
		preg2 = false;
	}
	else if($("#p10309s2").prop("checked") && $("#p10309s2a1").val()=='-'){
		$("#divCV4").addClass("alert alert-danger");
		$("#divCV4").tooltip();
		$("#divCV4").popover();
		preg2 = false;	
	}
	else if($("#p10309s3").prop("checked") && $("#p10309s3a1").val()=='-'){
		$("#divCV5").addClass("alert alert-danger");
		$("#divCV5").tooltip();
		$("#divCV5").popover();
		preg2 = false;	
	}
	else if($("#p10309s6").prop("checked") && $("#p10309s5a1").val()==''){
		$("#divCV6").addClass("alert alert-danger");
		$("#divCV6").tooltip();
		$("#divCV6").popover();
		preg2 = false;	
	}
	return preg4;
}


//Validar la pregunta Nro. 5 parte 1 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta51(){
	if(typeof $("#ops_pregunta5").data('ui-tooltip') != 'undefined'){
		$("#ops_pregunta5").tooltip('destroy');
		$("#ops_pregunta5").popover('destroy');
	}
	if(typeof $("#divCV7").data('ui-tooltip') != 'undefined'){
		$("#divCV7").tooltip('destroy');
		$("#divCV7").popover('destroy');
	}
	if(typeof $("#opcion71").data('ui-tooltip') != 'undefined'){
		$("#opcion71").tooltip('destroy');
		$("#opcion71").popover('destroy');
	}
	if(typeof $("#opcion72").data('ui-tooltip') != 'undefined'){
		$("#opcion72").tooltip('destroy');
		$("#opcion72").popover('destroy');
	}
	if(typeof $("#divCV8").data('ui-tooltip') != 'undefined'){
		$("#divCV8").tooltip('destroy');
		$("#divCV8").popover('destroy');
	}
	if(typeof $("#opcion81").data('ui-tooltip') != 'undefined'){
		$("#opcion81").tooltip('destroy');
		$("#opcion81").popover('destroy');
	}
	if(typeof $("#opcion82").data('ui-tooltip') != 'undefined'){
		$("#opcion82").tooltip('destroy');
		$("#opcion82").popover('destroy');
	}
	$("#ops_pregunta5").removeClass("alert alert-danger");
	$("#divCV7").removeClass("alert alert-danger");
	$("#opcion71").removeClass("alert alert-danger");
	$("#opcion72").removeClass("alert alert-danger");

	$("#divCV8").removeClass("alert alert-danger");
	$("#opcion81").removeClass("alert alert-danger");
	$("#opcion82").removeClass("alert alert-danger");
	
	//Validar que todos los radios se encuentren marcados
	var preg51 = false;

	// 5.1
	if( ( $("#p10309s4").prop("checked") && !$("#p5161s1c14_1").prop("checked") && !$("#p5161s1c14_2").prop("checked") ) || 
		( ( $("#p10309s1").prop("checked") || $("#p10309s2").prop("checked") || $("#p10309s3").prop("checked") || $("#p10309s4").prop("checked") || $("#p10309s5").prop("checked") || $("#p10309s6").prop("checked") ) 
			&& !$("#p5161s2c14_1").prop("checked") && !$("#p5161s2c14_2").prop("checked") ) ) {
		$("#ops_pregunta5").addClass("alert alert-danger");
		$("#ops_pregunta5").tooltip();
		$("#ops_pregunta5").popover();
		preg51 = false;
	}
	else if($("#p5161s1c14_1").prop("checked") && !$("#p5161s1a1c14_1").prop("checked") && !$("#p5161s1a1c14_2").prop("checked") && !$("#p5161s1a2c14_1").prop("checked") && !$("#p5161s1a2c14_2").prop("checked")) {
		$("#divCV7").addClass("alert alert-danger");
		$("#divCV7").tooltip();
		$("#divCV7").popover();
		preg51 = false;
	}
	else if( ($("#p5161s1a1c14_1").prop("checked") && !$("#radp5161s1a3c14").is(":checked") && $("#p5161s1a3c14").val() == "") || 
		($("#p5161s1a1c14_2").prop("checked") && $("#radp5161s1a3c14").is(":checked") && $("#p5161s1a3c14").val() != "" ) ){
		$("#opcion71").addClass("alert alert-danger");
		$("#opcion71").tooltip();
		$("#opcion71").popover();
		preg51 = false;
	}
	else if( ($("#p5161s1a2c14_1").prop("checked") && !$("#radp5161s1a4c14").is(":checked") && $("#p5161s1a4c14").val() == "") || 
		($("#p5161s1a2c14_2").prop("checked") && $("#radp5161s1a4c14").is(":checked") && $("#p5161s1a4c14").val() != "")  ){
		$("#opcion72").addClass("alert alert-danger");
		$("#opcion72").tooltip();
		$("#opcion72").popover();
		preg51 = false;
	}

	// 5.2
	else if($("#p5161s2c14_1").prop("checked") && !$("#p5161s2a1c14_1").prop("checked") && !$("#p5161s2a1c14_2").prop("checked") && !$("#p5161s2a2c14_1").prop("checked") && !$("#p5161s2a2c14_1").prop("checked")) {
		$("#divCV8").addClass("alert alert-danger");
		preg52 = false;
	}
	else if( ($("#p5161s2a1c14_1").prop("checked") && !$("#radp5161s2a3c14").is(":checked") && $("#p5161s2a3c14").val() == "") || 
		($("#p5161s1a1c14_2").prop("checked") && ($("#radp5161s2a3c14").is(":checked") && $("#p5161s2a3c14").val() != "") ) ){
		$("#opcion81").addClass("alert alert-danger");
		$("#opcion81").tooltip();
		$("#opcion81").popover();
		preg52 = false;
	}
	else if( ($("#p5161s2a2c14_1").prop("checked") && !$("#radp5161s2a4c14").is(":checked") && $("#p5161s2a4c14").val() == "") || 
		($("#p5161s1a2c14_2").prop("checked") && ($("#radp5161s2a4c14").is(":checked") && $("#p5161s2a4c14").val() != "") ) ){
		$("#opcion82").addClass("alert alert-danger");
		$("#opcion82").tooltip();
		$("#opcion82").popover();
		preg52 = false;
	}
	

	return preg51;
}


//Validar la pregunta Nro. 5 parte 2 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta52(){
	$("#ops_pregunta5").removeClass("alert alert-danger");
	$("#divCV8").removeClass("alert alert-danger");
	$("#opcion81").removeClass("alert alert-danger");
	$("#opcion82").removeClass("alert alert-danger");
	var preg52 = false;

	// 5.2
	if($("#p5161s2c14_1").prop("checked") && !$("#p5161s2a1c14_1").prop("checked") && !$("#p5161s2a1c14_2").prop("checked") && !$("#p5161s2a2c14_1").prop("checked") && !$("#p5161s2a2c14_1").prop("checked")) {
		$("#divCV8").addClass("alert alert-danger");
		$("#divCV8").tooltip();
		$("#divCV8").popover();
		preg52 = false;
	}
	else if( ($("#p5161s2a1c14_1").prop("checked") && !$("#radp5161s2a3c14").is(":checked") && $("#p5161s2a3c14").val() == "") || 
		($("#p5161s1a1c14_2").prop("checked") && ($("#radp5161s2a3c14").is(":checked") && $("#p5161s2a3c14").val() != "") ) ){
		$("#opcion81").addClass("alert alert-danger");
		$("#opcion81").tooltip();
		$("#opcion81").popover();
		preg52 = false;
	}
	else if( ($("#p5161s2a2c14_1").prop("checked") && !$("#radp5161s2a4c14").is(":checked") && $("#p5161s2a4c14").val() == "") || 
		($("#p5161s1a2c14_2").prop("checked") && ($("#radp5161s2a4c14").is(":checked") && $("#p5161s2a4c14").val() != "") ) ){
		$("#opcion82").addClass("alert alert-danger");
		$("#opcion82").tooltip();
		$("#opcion82").popover();
		preg52 = false;
	}
	
	return preg52;
}


//Validar la pregunta Nro. 6 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta6(){
	if(typeof $("#ops_p10312").data('ui-tooltip') != 'undefined'){
		$("#ops_p10312").tooltip('destroy');
		$("#ops_p10312").popover('destroy');
	}
	if(typeof $("#divCV9").data('ui-tooltip') != 'undefined'){
		$("#divCV9").tooltip('destroy');
		$("#divCV9").popover('destroy');
	}
	$("#ops_p10312").removeClass("alert alert-danger");
	$("#divCV9").removeClass("alert alert-danger");
	var preg6 = true;

	if( ( $("#p10305_3").is(':checked') || $("#p10309s1").prop("checked") || $("#p10309s2").prop("checked") || $("#p10309s3").prop("checked") || $("#p10309s4").prop("checked") || 
		$("#p10309s5").prop("checked") || $("#p10309s6").prop("checked") ) && !$("#p10312_1").is(':checked') && !$("#p10312_2").is(':checked')) {
		$("#ops_p10312").addClass("alert alert-danger");
		$("#ops_p10312").tooltip();
		$("#ops_p10312").popover();
		preg6 = false;
	}
	else if($("#p10312_1").is(':checked') && ( ($("#p10312s1").val() == "" && !$("#radp10312s1").is(':checked') ) || 
	 	($("#p10312s1").val() != "" && $("#radp10312s1").is(':checked') ) ) ) {
		$("#divCV9").addClass("alert alert-danger");
		$("#divCV9").tooltip();
		$("#divCV9").popover();
		preg6 = false;

	}
	return preg6;
}

//Validar la pregunta Nro. 7 del formulario para realizar el envío del formulario
//@author dmdiazf / @author hhchavez
//@since  11/07/2016
function validarPregunta7(){
	if(typeof $("#ops_pregunta7").data('ui-tooltip') != 'undefined'){
		$("#ops_pregunta7").tooltip('destroy');
		$("#ops_pregunta7").popover('destroy');
	}
	if(typeof $("#divCV10").data('ui-tooltip') != 'undefined'){
		$("#divCV10").tooltip('destroy');
		$("#divCV10").popover('destroy');
	}
	if(typeof $("#divCV11").data('ui-tooltip') != 'undefined'){
		$("#divCV11").tooltip('destroy');
		$("#divCV11").popover('destroy');
	}
	if(typeof $("#divCV12").data('ui-tooltip') != 'undefined'){
		$("#divCV12").tooltip('destroy');
		$("#divCV12").popover('destroy');
	}
	if(typeof $("#divCV13").data('ui-tooltip') != 'undefined'){
		$("#divCV13").tooltip('destroy');
		$("#divCV13").popover('destroy');
	}
	$("#ops_pregunta7").removeClass("alert alert-danger");
	$("#divCV10").removeClass("alert alert-danger");	
	$("#divCV11").removeClass("alert alert-danger");
	$("#divCV12").removeClass("alert alert-danger");
	$("#divCV13").removeClass("alert alert-danger");
	var preg7 = true;
	//var preg71 = false;
	//var preg72 = false;

	if( ($("#p10312_1").is(':checked') || $("#p10312_2").is(':checked')) && !$("#p8697s1").is(':checked') && !$("#p8697s2").is(':checked') && !$("#p8697s3").is(':checked')
		 && !$("#p8697s4").is(':checked') && !$("#p8697s5").is(':checked') && !$("#p8697s6").is(':checked')) {
		$("#ops_pregunta7").addClass("alert alert-danger");
		$("#ops_pregunta7").tooltip();
		$("#ops_pregunta7").popover();
		preg7 = false;
	}

	if( $("#p8697s2a1").val() == "-" && $("#p8697s2").is(':checked') ){
		$("#divCV10").addClass("alert alert-danger");
		$("#divCV10").tooltip();
		$("#divCV10").popover();
		preg7 = false;
	}

	if( $("#p8697s3a1").val() == "-" && $("#p8697s3").is(':checked') ){
		$("#divCV11").addClass("alert alert-danger");
		$("#divCV11").tooltip();
		$("#divCV11").popover();
		preg7 = false;
	}
	if( $("#p8697s4").is(':checked') && ( ( $("#p8697s4a1").val() == "" && !$("#radp8697s4a1").is(':checked')) || ( !$("#p8697s4a2").is(':checked') && !$("#p8697s4a3").is(':checked') )  ) ){
		$("#divCV12").addClass("alert alert-danger");
		$("#divCV12").tooltip();
		$("#divCV12").popover();
		preg7 = false;
	}
	if( $("#p8697s6").is(':checked') && $("#p8697s6a1").val() == "" ){
		$("#divCV13").addClass("alert alert-danger");
		$("#divCV13").tooltip();
		$("#divCV13").popover();
		preg7 = false;
	}
	return preg7;
}



//Oculta todos los divs de las preguntas del formulario
//@author dmdiazf / @author hhchavez
//@since  06/07/2016
function ocultarDivsPreguntas(preguntas){
	for (var i=0; i<preguntas.length; i++){		
		switch(parseInt(preguntas[i])){
			case 0: //Ocultar todos los divs
					//$("#pregP10305").hide();
					//$("#pregP10306").hide();
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
						$("#p10305s1").bloquearTexto();
						//$("#p10305s1").attr('disabled',true);
						$("#radp10305s1").attr("checked",false);
						$("#radp10305s1").unbind();
						$("#divCV1").hide();
					}
					break;
					
			case 2: //Ocultar divCV2
					if (!$("#divCV2").is(":hidden")){
						$("#p10306s1a1").val("");
						$("#p10306s1a1").bloquearTexto();
						//$("#p10306s1a1").attr('disabled',true);
						$("#radp10306s1a1").attr("checked",false);
						$("#divCV2").hide();
					}
					break;
					
			case 3: //Ocultar divCV3
					if (!$("#divCV3").is(":hidden")){
						$("#p10306s2a1").val("");
						$("#p10306s2a1").bloquearTexto();
						//$("#p10306s2a1").attr('disabled',true);
						$("#radp10306s2a1").attr("checked",false);
						$("#divCV3").hide();
					}
					break;
					
			case 4: //Ocultar divCV4
					if (!$("#divCV4").is(":hidden")){
						$("#p10309s2a1 option[value='-']").prop('selected', true);						
						$("#p10309s2a1").attr("disabled",true);
						$("#divCV4").hide();
					}
					break;
					
			case 5: //Ocultar divCV5
					if (!$("#divCV5").is(":hidden")){
						$("#p10309s3a1 option[value='-']").prop('selected', true);
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
						$("#p5161s1a3c14").bloquearTexto();
						$("#p5161s1a4c14").bloquearTexto();
						$("#p5161s1a3c14").val("");
						$("#p5161s1a4c14").val("");
						$("#p5161s1a3c14").attr("disabled",true);
						$("#p5161s1a4c14").attr("disabled",true);
						$("#radp5161s1a3c14").prop("checked",false);
						$("#radp5161s1a4c14").prop("checked",false);
						$("#p5161s1a1c14_1").prop("checked",false);
						$("#p5161s1a1c14_2").prop("checked",false);
						$("#p5161s1a2c14_1").prop("checked",false);
						$("#p5161s1a2c14_2").prop("checked",false);
						$("#opcion71").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion72").hide(); //Ocultar los divs dentro del div adicional						
						$("#divCV7").hide();
					}
					break;					
			case 8: //Ocultar divCV8
					if (!$("#divCV8").is(":hidden")){
						$("#p5161s2a3c14").bloquearTexto();
						$("#p5161s2a4c14").bloquearTexto();
						$("#p5161s2a3c14").val("");
						$("#p5161s2a4c14").val("");	
						$("#p5161s2a3c14").attr("disabled",true);
						$("#p5161s2a4c14").attr("disabled",true);
						$("#radp5161s2a3c14").prop("checked",false);
						$("#radp5161s2a4c14").prop("checked",false);
						$("#p5161s2a1c14_1").prop("checked",false);
						$("#p5161s2a1c14_2").prop("checked",false);
						$("#p5161s2a2c14_1").prop("checked",false);
						$("#p5161s2a2c14_2").prop("checked",false);
						$("#opcion81").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion82").hide(); //Ocultar los divs dentro del div adicional
						$("#divCV8").hide();
					}
					break;
					
			case 9: //Ocultar divCV9
					if (!$("#divCV9").is(":hidden")){
						$("#p10312s1").val('');
						$("#p10312s1").bloquearTexto();
						$("#radp10312s1").attr("checked",false);
						$("#divCV9").hide();
					}
					break;
					
			case 10: //Ocultar divCV10
					if (!$("#divCV10").is(":hidden")){
						$("#p8697s2a1 option[value='-']").prop('selected', true);						
						$("#p8697s2a1").attr("disabled",true);
						$("#divCV10").hide();
					}
					break;
					
			case 11: //Ocultar divCV11
					if (!$("#divCV11").is(":hidden")){
						$("#p8697s3a1 option[value='-']").prop('selected', true);						
						$("#p8697s3a1").attr("disabled",true);
						$("#divCV11").hide();
					}
					break;
					
			case 12: //Ocultar divCV12
					if (!$("#divCV12").is(":hidden")){
						$("#p8697s4a1").bloquearTexto();
						//$("#p8697s4a5").bloquearTexto();
						$("#p8697s4a1").val("");
						//$("#p8697s4a5").val("");
						$("#p8697s4a1").attr("disabled",true);
						//$("#p8697s4a5").attr("disabled",true);
						$("#p8697s4a3").attr('checked',false);
						$("#p8697s4a2").attr('checked',false);
						$("#opcion121").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion122").hide(); //Ocultar los divs dentro del div adicional	
						$("#divCV12").hide();
					}
					break;		
					
			case 13: //Ocultar divCV13
					if (!$("#divCV13").is(":hidden")){
						$("#p8697s6a1").val("");
						$("#p8697s6a1").attr("disabled",true);
						$("#divCV13").hide();
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
					$("#p10305s1").bloquearTexto();
					if ($("#divCV1").is(":hidden")){
						if ($("#p10305s1").is(":disabled")){
							$("#p10305s1").val("");							
							$("#p10305s1").attr("disabled",false);
						}
						$("#p10305s1").val("");
						$("#p10305s1").bloquearTexto();
						$("#radp10305s1").attr("checked",false);
						$("#radp10305s1").bind("click",function(){
							$("#p10305s1").val("");
							$("#p10305s1").bloquearTexto();
							if ($(this).prop("checked")){
								$("#p10305s1").attr("disabled",true);
								$('#p10305s1-error').remove();
							}
							else {
								$("#p10305s1").attr("disabled",false);	
							}
						});
						$("#divCV1").show();
					}
					break;
					
			case 2: //Mostrar divCV2
					$("#p10306s1a1").bloquearTexto();
					if ($("#divCV2").is(":hidden")){
						if ($("#p10306s1a1").is(":disabled")){
							$("#p10306s1a1").val("");							
							$("#p10306s1a1").attr("disabled",false);
						}						
						$("#radp10306s1a1").attr("checked",false);
						$("#radp10306s1a1").bind("change",function(){							
							if ( $("#radp10306s1a1").prop("checked") ){
								$("#p10306s1a1").val("");								
								$("#p10306s1a1").attr("disabled",true);
								$('#p10306s1a1-error').remove();
							}
							else {					
								$("#p10306s1a1").attr("disabled",false);	
							}
						
						});
						$("#divCV2").show();
					}
					break;
					
			case 3: //Mostrar divCV3
					$("#p10306s2a1").bloquearTexto();
					if ($("#divCV3").is(":hidden")){
						if ($("#p10306s2a1").is(":disabled")){
							$("#p10306s2a1").val("");							
							$("#p10306s2a1").attr("disabled",false);
						}						
						$("#radp10306s2a1").attr("checked",false);
						$("#radp10306s2a1").bind("change",function(){							
							if ($(this).prop("checked")){
								$("#p10306s2a1").val("");								
								$("#p10306s2a1").attr("disabled",true);
								$('#p10306s2a1-error').remove();
							}
							else {
								$("#p10306s2a1").attr("disabled",false);	
							}
						});
						$("#divCV3").show();
					}
					break;
					
			case 4: //Mostrar divCV4
					if ($("#divCV4").is(":hidden")){
						$("#p10309s2a1 option[value='-']").prop('selected', true);
						$("#p10309s2a1").attr("disabled",false);
						$("#divCV4").show();
					}
					break;
					
			case 5: //Mostrar divCV5
					if ($("#divCV5").is(":hidden")){
						$("#p10309s3a1 option[value='-']").prop('selected', true);
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
						$("#p5161s1a1c14_1").bind("click",function(){
							$("#p5161s1a3c14").bloquearTexto();//opcion71
								$("#p5161s1a3c14").val("");
								$("#radp5161s1a3c14").attr("checked",false);
								if ($("#p5161s1a3c14").is(":disabled")){
									$("#p5161s1a3c14").val("");
									$("#p5161s1a3c14").attr("disabled",false);
								}
								$("#radp5161s1a3c14").bind("change",function(){
									if($(this).prop("checked")) {
										$("#p5161s1a3c14").val("");
										$("#p5161s1a3c14").attr("disabled",true);
										$('#p5161s1a3c14-error').remove();
									}
									else {
										$("#p5161s1a3c14").val("");
										$("#p5161s1a3c14").attr("disabled",false);
									}
								});								
								$("#opcion71").show();								
						});

						//Asociar funcion de abrir detalles al radio "NO" de la opcion ¿Lo recibio en dinero?
						$("#p5161s1a1c14_2").bind("click",function(){
							$("#p5161s1a3c14").val("");
							$("#p5161s1a3c14").attr("disabled",true);
							$("#radp5161s1a3c14").attr("checked",false);								
							$("#opcion71").hide();
							$("#radp5161s1a3c14").unbind("change");
						});
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en especie?
						$("#p5161s1a2c14_1").bind("click",function(){
							$("#p5161s1a4c14").bloquearTexto();
							//if (parseInt($(this).val())==1){
								$("#p5161s1a4c14").val("");
								$("#radp5161s1a4c14").attr("checked",false);
								if ($("#p5161s1a4c14").is(":disabled")){
									$("#p5161s1a4c14").val("");
									$("#p5161s1a4c14").attr("disabled",false);
								}
								$("#radp5161s1a4c14").bind("change",function(){
									if($(this).prop("checked")) {
										$("#p5161s1a4c14").val("");
										$("#p5161s1a4c14").attr("disabled",true);
										$('#p5161s1a4c14-error').remove();
									}
									else {
										$("#p5161s1a4c14").val("");
										$("#p5161s1a4c14").attr("disabled",false);
									}
								});
								$("#opcion72").show();
							//}							
						});

						//Asociar funcion de abrir detalles al radio "NO" de la opcion ¿Lo recibio en especie?
						$("#p5161s1a2c14_2").bind("click",function(){
							$("#p5161s1a4c14").val("");
							$("#p5161s1a4c14").attr("disabled",true);
							$("#radp5161s1a4c14").attr("checked",false);
							$("#opcion72").hide();
							$("#radp5161s1a4c14").unbind("change");
						});				
						
						$("#divCV7").show();
					}
					break;

					
			case 8: //Mostrar divCV8
					if ($("#divCV8").is(":hidden")){
						$("#opcion81").hide(); //Ocultar los divs dentro del div adicional
						$("#opcion82").hide(); //Ocultar los divs dentro del div adicional
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en dinero?
						$("#p5161s2a1c14_1").bind("click",function(){
							$("#p5161s2a3c14").bloquearTexto();
							//if(parseInt($(this).val())==1){								
								$("#p5161s2a3c14").val("");
								$("#radp5161s2a3c14").attr("checked",false);
								if ($("#p5161s2a3c14").is(":disabled")){
									$("#p5161s2a3c14").val("");
									$("#p5161s2a3c14").attr("disabled",false);
								}
								$("#radp5161s2a3c14").bind("change",function(){
									if($(this).prop("checked")) {
										$("#p5161s2a3c14").val("");
										$("#p5161s2a3c14").attr("disabled",true);
										$('#p5161s2a3c14-error').remove();
									}
									else {
										$("#p5161s2a3c14").val("");
										$("#p5161s2a3c14").attr("disabled",false);
									}
								});								
								$("#opcion81").show();						
							//}
						});

						//Asociar funcion de abrir detalles al radio "NO" de la opcion ¿Lo recibio en dinero?
						$("#p5161s2a1c14_2").bind("click",function(){
							$("#p5161s2a3c14").val("");
							$("#p5161s2a3c14").attr("disabled",true);
							$("#radp5161s2a3c14").attr("checked",false);								
							$("#opcion81").hide();
							$("#radp5161s2a3c14").unbind("change");
						});
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en especie?
						$("#p5161s2a2c14_1").bind("click",function(){
							$("#p5161s2a4c14").bloquearTexto();
							//if (parseInt($(this).val())==1){
								$("#opcion82").show();
								$("#p5161s2a4c14").val("");
								$("#radp5161s2a4c14").attr("checked",false);
								if ($("#p5161s2a4c14").is(":disabled")){
									$("#p5161s2a4c14").val("");
									$("#p5161s2a4c14").attr("disabled",false);
								}
								$("#radp5161s2a4c14").bind("change",function(){
									if($(this).prop("checked")) {
										$("#p5161s2a4c14").val("");
										$("#p5161s2a4c14").attr("disabled",true);
										$('#p5161s2a4c14-error').remove();
									}
									else {
										$("#p5161s2a4c14").val("");
										$("#p5161s2a4c14").attr("disabled",false);
									}
								});
								$("#opcion82").show();								
							//}
																					
						});

						//Asociar funcion de abrir detalles al radio "NO" de la opcion ¿Lo recibio en especie?
						$("#p5161s2a2c14_2").bind("click",function(){
							$("#p5161s2a4c14").val("");
							$("#p5161s2a4c14").attr("disabled",true);
							$("#radp5161s2a4c14").attr("checked",false);
							$("#opcion82").hide();
							$("#radp5161s2a4c14").unbind("change");
						});

						
						$("#divCV8").show();
					}
					break;
					
			case 9: //Mostrar divCV9					
					$("#p10312s1").bloquearTexto();
					if ($("#divCV9").is(":hidden")){
						if ($("#p10312s1").is(":disabled")){
							$("#p10312s1").val("");
							$("#p10312s1").attr("disabled",false);
						}						
						$("#radp10312s1").attr("checked",false);
						$("#radp10312s1").bind("change",function(){							
							if ($(this).is(":checked")){
								$("#p10312s1").val("");
								$("#p10312s1").attr("disabled",true);
								$('#p10312s1-error').remove();
							}
							else {
								$("#p10312s1").val("");
								$("#p10312s1").attr("disabled",false);
							}
						});
						$("#divCV9").show();
					}
					break;
					
			case 10: //Mostrar divCV10
					if ($("#divCV10").is(":hidden")){						
						$("#p8697s2a1 option[value='-']").prop('selected', true);
						$("#p8697s2a1").attr("disabled",false);
						$("#divCV10").show();
					}
					break;
					
			case 11: //Mostrar divCV11
					if ($("#divCV11").is(":hidden")){
						$("#p8697s3a1 option[value='-']").prop('selected', true);
						$("#p8697s3a1").attr("disabled",false);
						$("#divCV11").show();
					}
					break;
					
			case 12: //Mostrar divCV12
					if ($("#divCV12").is(":hidden")){
						$("#opcion121").hide();
						$("#opcion122").hide();

						$("#p8697s4a1").bloquearTexto();
						$("#p8697s4a1").val("");
						$("#radp8697s4a1").attr("checked",false);
						if ($("#p8697s4a1").is(":disabled")){
							$("#p8697s4a1").val("");
							$("#p8697s4a1").attr("disabled",false);
						}
						$("#radp8697s4a1").bind("change",function(){
							if($(this).is(':checked')) {
								$("#p8697s4a1").val("");
								$("#p8697s4a1").attr("disabled",true);
								$('#p8697s4a1-error').remove();
							}
							else {
								$("#p8697s4a1").val("");
								$("#p8697s4a1").attr("disabled",false);
							}
						});								
						$("#opcion121").show();																
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en dinero?
						/*$("#p8697s4a2_1").bind("change",function(){
							$("#p8697s4a4").bloquearTexto();
							if($(this).is(':checked')){
								$("#p8697s4a4").val("");
								$("#radp8697s4a4").attr("checked",false);
								if ($("#p8697s4a4").is(":disabled")){
									$("#p8697s4a4").val("");
									$("#p8697s4a4").attr("disabled",false);
								}
								$("#radp8697s4a4").bind("change",function(){
									if($(this).is(':checked')) {
										$("#p8697s4a4").val("");
										$("#p8697s4a4").attr("disabled",true);
									}
									else {
										$("#p8697s4a4").val("");
										$("#p8697s4a4").attr("disabled",false);
									}
								});								
								$("#opcion121").show();																
							}						
						});

						//Asociar funcion de abrir detalles al radio "NO" de la opcion ¿Lo recibio en dinero?
						$("#p8697s4a2_2").bind("change",function(){
							$("#p8697s4a4").val("");
							$("#p8697s4a4").attr("disabled",true);
							$("#radp8697s4a4").attr("checked",false);								
							$("#opcion121").hide();	
						});
						
						//Asociar funcion de abrir detalles al radio "SI" de la opcion ¿Lo recibio en especie?
						$("#p8697s4a3_1").bind("change",function(){
							$("#p8697s4a5").bloquearTexto();
							if ($(this).is(':checked') ){
								//$("#opcion122").show();
								$("#p8697s4a5").val("");
								$("#radp8697s4a5").attr("checked",false);
								if ($("#p8697s4a5").is(":disabled")){
									$("#p8697s4a5").val("");
									$("#p8697s4a5").attr("disabled",false);
								}
								$("#radp8697s4a5").bind("change",function(){
									if($(this).is(':checked')) {
										$("#p8697s4a5").val("");
										$("#p8697s4a5").attr("disabled",true);
									}
									else {
										$("#p8697s4a5").val("");
										$("#p8697s4a5").attr("disabled",false);	
									}
								});
								$("#opcion122").show();								
							}																			
						});

						//Asociar funcion de abrir detalles al radio "NO" de la opcion ¿Lo recibio en especie?
						$("#p8697s4a3_2").bind("change",function(){
							$("#p8697s4a5").val("");
							$("#p8697s4a5").attr("disabled",true);
							$("#radp8697s4a5").attr("checked",false);
							$("#opcion122").hide();
						});*/
						$("#divCV12").show();
					}
					break;		
					
			case 13: //Mostrar divCV13
					if ($("#divCV13").is(":hidden")){
						$("#p8697s6a1").val("");
						$("#p8697s6a1").attr("disabled",false);						
						$("#divCV13").show();
					}
					break;
		}
	}
}