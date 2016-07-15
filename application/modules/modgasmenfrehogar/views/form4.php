
<hr />
<div class="row secondHead themeHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" alt="Imagen sección hogar"></div>
    <!--<div class="col-sm-4 col-md-3 col-lg-2 col-xs-12">
        
    </div>-->
    <!--<div class="col-sm-5 ">-->
    <h2><?= $secc[0]['TITULO1'] ?></h2>
    <h4><?= $secc[0]['TITULO2'] ?></h4>
    <h5><?= $secc[0]['TITULO3'] ?></h5>
    <!--</div>-->
</div>
<!--<div class="row">
    <div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
    <div class="col-sm-8">
        <h2><?= $secc[0]['TITULO1'] ?></h2>
        <h4><?= $secc[0]['TITULO2'] ?></h4>
        <h5><?= $secc[0]['TITULO3'] ?></h5>

    </div>
</div>-->
<?php
	if (!empty($secc[0]['ENCABEZADO']))
		echo "			<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
?>
			<form id="form_4" name="form_4" class="form-horizontal" role="form">
				<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
				<div>
					<div>
						<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	$i = 1;
	//foreach ( $preg['var'] as $v3 ) {
		//if ($v3['GRUPO'] != $nuevogrupo) {
?>
				</div>
			</div>
			
			
			<table border=1>
				<tr>
					<td border=0><td>
					<td colspan='12' align='center'>Si lo hubiera tenido que comprar, ¿cuánto habría pagado por el bien o servicio</td>
				</tr>
				<tr>
					<td rowspan='2'>
						<h5 class='control-label' for='art_'  >Nombre del artículo o servicio ADQUIRIDO por otras formas diferentes a la compra</h5>
			</td><td></td>
			<td colspan='2'>adquirido como pago por TRABAJO?</td>
			<td colspan='2'>adquirido como REGALO o DONACIÓN?</td>
			<td colspan='2'>adquirido como INTERCAMBIO?</td>
			<td colspan='2'>PRODUCIDO por el HOGAR?</td>
			<td colspan='2'>tomado de un NEGOCIO PROPIO?</td>
			<td colspan='2'>adquirido de OTRA FORMA?</td>
			</tr><tr>
			<td></td>
			<td>Valor estimado</td>
			<td>No sabe el valor estimado</td>
			<td>Valor estimado</td>
			<td>No sabe el valor estimado</td>
			<td>Valor estimado</td>
			<td>No sabe el valor estimado</td>
			<td>Valor estimado</td>
			<td>No sabe el valor estimado</td>
			<td>Valor estimado</td>
			<td>No sabe el valor estimado</td>
			<td>Valor estimado</td>
			<td>No sabe el valor estimado</td>
			</tr>
<?php
			$j = 1;
			foreach ( $preg['var'] as $v3 ):
?>
				<tr>
				<td colspan='2'>(<?=$v3['ID_ARTICULO3']?>) <?=$v3['ETIQUETA']?>
					</td>

<?php
				$i = 1;pr($v3);
				foreach ( $preg['variables'] as $v4 ):
					$input_atr = "class='valor_" . $j . "_input'";
					$forma_obt = array("recibido_pago", "regalo", "intercambio", "producido", "negocio_propio", "otra");

					if( ($i == 1 && $v3['RECIBIDO_PAGO'] != "1") || ($i == 2 && $v3['REGALO'] != "1") || ($i == 3 && $v3['INTERCAMBIO'] != "1") || 
						($i == 4 && $v3['PRODUCIDO'] != "1") || ($i == 5 && $v3['NEGOCIO_PROPIO'] != "1") || ($i == 6 && $v3['OTRA'] != "1")  ):
						$input_atr = "disabled";
						?>
						<td>
					<?php
					else:
					?>
						<td class='activo'>
					<?php
						$j++;
					endif;
?>
					<input <?=$input_atr?> type='text' name='val_<?=$v3['ID_ARTICULO3']?>[<?=$forma_obt[$i-1]?>]' value='' id='art_<?=$v3['ID_ARTICULO3']?>_1' />
					</td>
					<?php
					$input_atr = str_replace("_input", "", $input_atr);
					?>
					<td>(99) 
					<input <?=$input_atr?> type='checkbox' name='chb_<?=$v3['ID_ARTICULO3']?>[<?=$forma_obt[$i-1]?>]' value='' id='art_<?=$v3['ID_ARTICULO3'] ?>_1' />
					</td>
<?php
					$i++;
					endforeach;
?>
					

				</tr>
<?php
			endforeach;
?>
			</table>
			
	<?php
		$i++;
?>
					</div>
				</div>
				<div class="row">
                            <div class="col-sm-12" id="mensaje_"></div>
                        </div>
                        <div class="row text-center">
                            <button disabled class='btn btn-success' id='env_form_4'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
                        </div>
			</form>
<script>

$(function() {
	

	$( "input[type=text]" ).bloquearTexto();

	$( "input[type=checkbox]" ).on( "change", function(){
		//var articulos = $( ".articulo" ).length;
		//var cont  = 0;
		var claseInput = $(this).attr("class") + "_input";
		if($(this).prop("checked")) {
			$("."+claseInput).prop("readonly",true);
			$("."+claseInput).val("99");
		}
		else {
			$("."+claseInput).prop("readonly",false);
			$("."+claseInput).val("");
		}
		
		var inputs = $(".activo").length, condicion = 1;

		for(var i = 1; i <= inputs; i++) {
		//while($(".valor_"+i+"_input")) {
			if($(".valor_"+i+"_input").val() || $(".valor_"+i+"_input").prop("checked") )
				condicion++;
		}

		if(condicion == i)
			$("#env_form_4").prop('disabled', false);
		else $("#env_form_4").prop('disabled', true);
		
	});

	$( "input[type=text]" ).on( "blur", function(){
		//var articulos = $( ".articulo" ).length;
		//var cont  = 0;
		//var claseInput = $(this).attr("class") + "_input";

		var inputs = $(".activo").length, condicion = 1;

		for(var i = 1; i <= inputs; i++) {
		//while($(".valor_"+i+"_input")) {
			if($(".valor_"+i+"_input").val() || $(".valor_"+i+"_input").prop("checked") )
				condicion++;
		}

		if(condicion == i)
			$("#env_form_4").prop('disabled', false);
		else $("#env_form_4").prop('disabled', true);
		/*for(var i=0; i < articulos; i++) {
			var sel = $(":input.ops_" + (i+1) + ":checked").length;
			if(sel > 0) 
				cont++;
		}

		if(articulos == cont)
			$("#ENV_2_2").prop('disabled', false);
		else $("#ENV_2_2").prop('disabled', true);*/
		
	});

	$("#form_4").submit(function(e){
        e.preventDefault();
    });

	// boton enviar
    $("#env_form_4").on("click", function () {
        var myf = $('#form_4');
        var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
        $(this).attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: location.href + '/guardar_form4',
            cache: false,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: args,
            beforeSend: function (objeto) {
                $('#mensaje_').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando informaci&oacute;n</div>');
            },
            success: function (respuesta) {
                /*var arrRespuesta = respuesta.split(":");
                if(arrRespuesta[0] == 'S') {
                    $('#mensaje_').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>' + arrRespuesta[1] + '</div>');
                    setTimeout(function () {
                        location.href = location.href
                    }, 2000);
                }
                else if(arrRespuesta[0] == 'W') {
                    $('#mensaje_').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>' + arrRespuesta[1] + '</div>');
                }
                else if(arrRespuesta[0] == 'E') {
                    $('#mensaje_').html('<div id="reslogin" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> ' + arrRespuesta[1] + '</div>');
                }*/
                $('#mensaje_').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>' + respuesta + '</div>');
                
            },
            error: function (respuesta) {
                $('#mensaje_').html('<div id="reslogin" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Error guardando informaci&oacute;n</div>');
 
            }
        });
    });

});
/*
$(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	// control de las fechas de jquery
	// Envio del formulario.
<?php
	// 2016-04-05 - mayandarl - Asignacion de valores iniciales
	foreach ( $resp as $k => $v ) {
		echo "	asignarValor('$k','$v');\n";
	}
	// 2016-04-05 - mayandarl - Incluye las reglas de validacion
	foreach ($preg['reg'] as $k2=>$v2) {
		$f = explode("__", $k2);
		if ($f[1] == '1') {
			if ($v2['TIPO_CAMPO'] == "SELUNICA_RAD" || $v2['TIPO_CAMPO'] == "SINO")
				$id = "[name=". $f[0] ."]";
			else
				$id = "#". $f[0];
			echo "\t\$('$id').consistencia('". $f[0] ."', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
		}
	}
	// 2016-04-30 - mayandarl - Incluye las reglas de dependencia
	foreach ($preg['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
	if ($secc['ACCION'] == 'CONFIRMAR')
		echo "$('#ENV_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."').verificar_confirmar_enviar('". $secc['ID_SECCION']."_". $secc['PAGINA'] ."','". 
			site_url("modinggasper/Personas/guardar/". $secc['ID_SECCION']."/". $secc['PAGINA']). "', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	else
		echo "$('#ENV_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."').verificar_enviar('". $secc['ID_SECCION']."_". $secc['PAGINA'] ."','". 
			site_url("modinggasper/Personas/guardar/". $secc['ID_SECCION']."/". $secc['PAGINA']). "', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	// 2016-04-05 - mayandarl - Asignacion de tipos de datos
	foreach ( $preg['var'] as $v3 ) {
		if ($v3['TIPO_CAMPO'] == 'NUMERICO' || $v3['TIPO_CAMPO'] == 'NUMNOSABE' || $v3['TIPO_CAMPO'] == 'NUMNOINFO')
			echo "	$('#". $v3['ID_VARIABLE'] ."').number(true, 0, ',', '.');\n";
		if ($v3['TIPO_CAMPO'] == 'MAYUSC')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').mayusculas();\n";
	}
?>
	// Casos especiales
	$("#P548").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", yearRange: '1900:2016', onSelect: function (dateText, inst) {
		chk_cons('P548', regla_01CARACTERISTICAS_1);
    }});*/
	//autocompletar etnias indigenas
	/*$('#P5667').autocomplete({
		source: function (val) {
			$.getJSON("<?php echo site_url("modinggasper/Personas/buscaretnias/") ?>/" + val['term'],
				function (data) {
				console.log(data);
					$('#P5667').val(data.NOMBRE_RESGUARDO);
				});
		}, minLength: 3
	});*/

	/*$('#P5667').autocomplete({
		source: function(request, response) { 
			jQuery.ajax({
				url: "<?php echo site_url("modinggasper/Personas/buscaretnias/") ?>/" + $('#P5667').val(),
				dataType: "json",
				success: function(data) {
					response(data);
				}
			})
		},
		select:  function(e, ui) {
			//var keyvalue = ui.item.value;
			//alert("valor es: " + keyvalue); 
		}
	});
	

	$('#P6040').dependencias3('P6040', 'P5170', '5'); //
	$('#P6040').dependencias3('P6040', 'P1650', '10'); //
	$('[name=P8610]').dependencias('P8610', 'GRP_P6207', [1]);
	$('[name=P8612]').dependencias('P8612', 'GRP_P6236', [1]);
});*/
</script>