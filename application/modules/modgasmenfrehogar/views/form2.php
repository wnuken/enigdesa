<hr />
		<div class="row">
			<div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
			<div class="col-sm-8">
				<h2><?=$secc[0]['DESCR_SECCION'] . "(" . $secc[0]['TEMPORALIDAD'] . ")"; ?></h2>
				<h4><?//echo $persona['P521A'] ." ". $persona['P521C'] ." (". $persona['P6040'] .")"; ?></h4>
			</div>
		</div>
		<br />
<?php
	if (!empty($secc[0]['ENCABEZADO']))
		echo "			<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
?>
			<form id="form_" name="form_<?echo $secc[0]['ID_SECCION3'] /*.'_'. $secc['PAGINA']*/?>" class="form-horizontal" role="form">
				<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
				<input type="hidden" name="_INI_<?echo "prueba"//$secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?="prueba"//echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
				<input type="hidden" id="P6040" value="<?="prueba"//echo $persona['P6040']; ?>" />
				<div>
					<div>
						<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	$i = 1;
	foreach ( $preg['var'] as $v3 ) {
		//if ($v3['GRUPO'] != $nuevogrupo) {
			echo "					</div>\n";
			echo "				</div>\n";
			// Inicio Grupo de preguntas...
			/*if (!empty($preg['grv'])) {
				foreach ($preg['grv'] as $grv) {
					if ($grv['PRI_VARIABLE'] == $v3['ID_VARIABLE']) {
						echo "	<div id='". $grv['IDGRUPO'] ."'>\n";
						echo "		<h5>". $grv['ETIQUETA'] ."";
						if (!empty($grv['AYUDA']))
							echo "&nbsp;&nbsp;<a href='#' data-toggle='tooltip' title='". $grv['AYUDA'] ."'>(?)</a>";
						echo "</h5>\n";
						if (!empty($grv['DESCRIPCION']))
							echo "		". $grv['DESCRIPCION'] ."<br/>\n";
						if (!empty($grv['TEXTO_AUXILIAR']))
							echo "		<i>". $grv['TEXTO_AUXILIAR'] ."</i><br/>\n";
						echo "		<br/>\n";
						$vargrupo = true;
					}
				}
			}
			else
				$vargrupo = false;
			// Esta opcion oculta el grupo y los campos asociados cuando el tipo de campo este definido como oculto.
			if ($v3['TIPO_CAMPO'] == "OCULTO")
				echo "				<div class='form-group has-feedback' style='display: none'>\n";
			else*/
			
				echo "				<div class='form-group has-feedback' id='div-". $v3['ID_ARTICULO3'] ."'>\n";
			//echo "<input type='checkbox' name='articulos[]' value='" . $v3['ID_ARTICULO3'] . "' id='articulo_". $v3['ID_ARTICULO3'] ."' />";
			
			// mayandarl - Texto de la pregunta.
			echo "<h5 class='control-label articulo' for='" . $v3['ID_ARTICULO3'] . "'  >(". $v3['ID_ARTICULO3'] .") " . $v3['ETIQUETA'];
			// mayandarl - Ayuda asociada a la pregunta.
			//if (!empty($v3['AYUDA']))
			//	echo "&nbsp;<a href='#' data-toggle='tooltip' title='". $v3['AYUDA'] ."'>(?)</a>";
			echo "</h5>\n";
			// mayandarl - Asigna ID para la seccion de opciones de respuesta. Se utiliza en la verificacion de consistencias.
			echo "					<div class='col-sm-8' id='RESP_". $v3['ID_ARTICULO3'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";

			echo "<table>";
			echo "<tr>";
			echo "<td>";
			echo "<h5 class='control-label' for='art_" . $v3['ID_ARTICULO3'] . "'  >¿Como lo obtuvieron?";
			echo "</h5>\n";
			echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='compra_" . $v3['ID_ARTICULO3'] . "'  >Compra o pago";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[compra]' value='" . $v3['ID_ARTICULO3'] . "_1' id='art_". $v3['ID_ARTICULO3'] ."_1' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Recibido por trabajo";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[trabajo]' value=' value='" . $v3['ID_ARTICULO3'] . "_2' id='articulo_". $v3['ID_ARTICULO3'] ."_2' class='ops_" . $i . "' />";
			echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Regalo o donaci&oacute;n";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[regalo]' value='" . $v3['ID_ARTICULO3'] . "_3' id='articulo_". $v3['ID_ARTICULO3'] ."_3' class='ops_" . $i . "' />";
			echo "</td>";			
			echo "</tr>";

			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Intercambio";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[intercambio]' value='" . $v3['ID_ARTICULO3'] . "_4' id='articulo_". $v3['ID_ARTICULO3'] ."_4' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Producido por el hogar";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[hogar]' value='" . $v3['ID_ARTICULO3'] . "_5' id='articulo_". $v3['ID_ARTICULO3'] ."_5' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Tomado de un negocio propio";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[negocio]' value='" . $v3['ID_ARTICULO3'] . "_6' id='articulo_". $v3['ID_ARTICULO3'] ."_6' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Otra forma";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='art_" . $v3['ID_ARTICULO3'] . "[otra]' value='" . $v3['ID_ARTICULO3'] . "_7' id='articulo_". $v3['ID_ARTICULO3'] ."_7' class='ops_" . $i . "' />";
			echo "</td>";			
			echo "</tr>";

			echo "</table>";
			
			//if ($v3['TEXTO_AUXILIAR'] != '')
			//	echo "<small><i>". $v3['TEXTO_AUXILIAR']. "</i></small><br/>\n";
		/*} else {
			echo "&nbsp;&nbsp;";
		}*/
		/*if ($v3['TIPO_CAMPO'] == "SELUNICA") {
			echo mostrar_select($v3, $preg['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SELUNICA_RAD") {
			echo mostrar_radios($v3, $preg['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SINO") {
			echo mostrar_sino($v3, $preg['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "NUMNOSABE") {
			echo mostrar_numnosabe($v3);
		}
		else if ($v3['TIPO_CAMPO'] == "NUMNOINFO") {
			echo mostrar_numnoinfo($v3);
		}
		else {
			echo mostrar_input_text($v3);
		}*/
		//if (!$vargrupo)
			echo "<hr>\n";
		//$nuevogrupo = $v3['GRUPO'];
		// Fin grupo de preguntas.
		/*if (!empty($preg['grv'])) {
			foreach ($preg['grv'] as $grv) {
				if ($grv['ULT_VARIABLE'] == $v3['ID_VARIABLE'])
					echo "		<hr></div><!-- ". $grv['IDGRUPO'] ."-->\n";
			}
		}*/
		$i++;
	}
?>
					</div>
				</div>
			</form>
		<div class="row">
			<div class="col-sm-12" id="mensaje_<?//echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"></div>
		</div>
		<div class="row text-center">
<?php
	//if ($secc['ANTERIOR'] == 'SI') {
	//	echo "		<button class='btn btn-info' onClick='window.location.replace(\"". site_url("modinggasper/Personas/antgenerales") ."\");'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true' title='Volver'></span>Regresar y Modificar</button>\n";
	//}
	// mayandarl - incorpora los botones de anterior y siguiente 
	//if ($secc['SIGUIENTE'] == 'SI') {
		//if ($secc['ACCION'] == 'CONTINUAR')
			echo "	<button disabled=disabled class='btn btn-success' id='ENV_2_2'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>\n";
		//elseif ($secc['ACCION'] == 'FINALIZAR')
		//	echo "	<button class='btn btn-success' id='ENV_". $secc['ID_SECCION'] .'_'. $secc['PAGINA'] ."'>Guardar y Finalizar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Fin'></span></button>\n";
	//}
?>

		</div>
<script>
<?php
	/*echo "\t var regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ." = new Array();\n";
	foreach ($preg['reg'] as $k2=>$v2) {
		echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
	}*/
?>
$(function() {
	$( document ).ready(function() {
	  // Handler for .ready() called.
	});
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

	$(".btn-success").on("click",function(){
		var myf = $('#form_');
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
				//location.reload();
			},
			error: function (respuesta) {
				$('#mensaje_').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
				//$('#CHK_'+ capitulo).removeClass();
				//$('#CHK_'+ capitulo).addClass('ui-icon ui-icon-cancel');
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