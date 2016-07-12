/**
 * Funciones JavaScript para seccion Recreacion
 * @author cemedinaa	
 * @since  08-07-2016
 */
 $(function() {
	$("#variable_uso_1").on("click", function(){
		$(".cont_articulo").css('display','block');
		$("#env_form_1").prop('disabled', true);
		$("#variable_uso_2").prop("disabled", true); 			
	});

	$("#variable_uso_2").on("click", function(){
		$(".cont_articulo").css('display','none');
		$("#env_form_1").prop('disabled', false);
		$("#variable_uso_1").prop("disabled", true);
	});

	$( "input[type=checkbox]" ).on( "change", function(){
		var checked = $( "input:checked" ).length;
		//activar o desactivar boton
		if(checked>0)
			$("#env_form_1").prop('disabled', false);
		else $("#env_form_1").prop('disabled', true);

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

	// boton enviar
	$("#env_form_1").on("click",function(){
		var myf = $('#form_1');
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
	});
});