<hr />
	<div class="row">
		<div class="col-sm-2"><img src="<?php 
if ($secc['ID_SECCION'] == "1VIVIENDA") echo base_url("images/form_icon-vivienda.png"); elseif ($secc['ID_SECCION'] == "2HOGAR") echo base_url("images/form_icon-hogar.png");?>" /></div>
		<div class="col-sm-8">
			<h1><?echo $secc['DESCR_SECCION']; ?></h1>
		</div>
	</div>
		<br />
<?
	if (!empty($secc['ENCABEZADO']))
		echo "			<blockquote>". $secc['ENCABEZADO'] ."</blockquote>\n";
?>
		<form id="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" name="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
			<input type="hidden" name="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
<?
	if (!empty($vardep))
		foreach ($vardep as $m=>$n)
			echo "			<input type='hidden' id='$m' value='$n' />\n";
?>
			<div>
				<div>
					<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	foreach ( $preg['var'] as $v3 ) {
		if ($v3['GRUPO'] != $nuevogrupo) {
			echo "					</div>\n";
			echo "				</div>\n";
			// Inicio Grupo de preguntas...
			if (!empty($preg['grv'])) {
				foreach ($preg['grv'] as $grv) {
					if ($grv['PRI_VARIABLE'] == $v3['ID_VARIABLE']) {
						echo "	<div id='". $grv['IDGRUPO'] ."'>\n"; // class='col-sm-12'
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
			else
				echo "				<div class='form-group has-feedback' id='div-". $v3['ID_VARIABLE'] ."'>\n";
			// mayandarl - Texto de la pregunta.
			echo "<h5 class='control-label' id='lbl-". $v3['ID_VARIABLE'] ."' for='". $v3['ID_VARIABLE'] ."'>(". $v3['ID_VARIABLE'] .") ". $v3['DESCRIPCION'];
			// mayandarl - Ayuda asociada a la pregunta.
			if (!empty($v3['AYUDA']))
				echo "&nbsp;<a href='#' data-toggle='tooltip' title='". $v3['AYUDA'] ."'>(?)</a>";
			echo "</h5>\n";
			// mayandarl - Asigna ID para la seccion de opciones de respuesta. Se utiliza en la verificacion de consistencias.
			echo "					<div class='col-sm-8' id='RESP_". $v3['ID_VARIABLE'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
			if ($v3['TEXTO_AUXILIAR'] != '')
				echo "<small><i>". $v3['TEXTO_AUXILIAR']. "</i></small><br/>\n";
		} else {
			echo "&nbsp;&nbsp;";
		}
		if ($v3['TIPO_CAMPO'] == "SELUNICA") {
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
		}
		if (!$vargrupo)
			echo "<hr>\n";
		$nuevogrupo = $v3['GRUPO'];
		// Fin grupo de preguntas.
		if (!empty($preg['grv'])) {
			foreach ($preg['grv'] as $grv)
				if ($grv['ULT_VARIABLE'] == $v3['ID_VARIABLE'])
					echo "		<hr></div><!-- ". $grv['IDGRUPO'] ."-->\n";
		}
	}
?>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-sm-12" id="mensaje_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"></div>
		</div>
		<div class="row text-center">
<?php
	if ($secc['ANTERIOR'] == 'SI') {
		echo "		<button class='btn btn-info' onClick='window.location.replace(\"". site_url("modvivhogar/Vivhogar/anterior") ."\");'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true' title='Volver'></span>Regresar y Modificar</button>\n";
	}
	// mayandarl - incorpora los botones de anterior y siguiente 
	if ($secc['SIGUIENTE'] == 'SI') {
		if ($secc['ACCION'] == 'CONTINUAR')
			echo "	<button class='btn btn-success' id='ENV_". $secc['ID_SECCION'] .'_'. $secc['PAGINA'] ."'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>\n";
		elseif ($secc['ACCION'] == 'FINALIZAR')
			echo "	<button class='btn btn-success' id='ENV_". $secc['ID_SECCION'] .'_'. $secc['PAGINA'] ."'>Guardar y Finalizar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>\n";
	}
?>
		</div>
<script>
<?php
	echo "\t var regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ." = new Array();\n";
	foreach ($preg['reg'] as $k2=>$v2) {
		echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
	}
?>

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
			site_url("modvivhogar/Vivhogar/guardar/". $secc['ID_SECCION']."/". $secc['PAGINA']). "', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	else
		echo "$('#ENV_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."').verificar_enviar('". $secc['ID_SECCION']."_". $secc['PAGINA'] ."','". 
			site_url("modvivhogar/Vivhogar/guardar/". $secc['ID_SECCION']."/". $secc['PAGINA']). "', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	// 2016-04-05 - mayandarl - Asignacion de tipos de datos
	foreach ( $preg['var'] as $v3 ) {
		if ($v3['TIPO_DATO'] == 'NUMERICO')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').numerico();\n";
		if ($v3['TIPO_CAMPO'] == 'MAYUSC')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').mayusculas();\n";
	}
?>
///// casos especiales
	/*$('#P1647').blur(function () {
		$('#P1647').reemplazarValorLabel('P1647', 'P1647S1');
	});*/
	$('#P1647S1').change(function () {
		$('#P1647').reemplazarValorLabel('P1647', 'P5010');
	});
	$('#P5100S1').blur(function() {
		if($("#P5100S1").val().length > 0 && $("#P5100S2").val().length > 0 && $("#P5100S3").val().length > 0) {
			var P5100S4 = parseInt($("#P5100S1").val()) + parseInt($("#P5100S2").val()) + parseInt($("#P5100S3").val());
			$("#P5100S4").val(P5100S4);
		} else {
			$("#P5100S4").val('');
		}
	});
	$('#P5100S2').blur(function() {
		if($("#P5100S1").val().length > 0 && $("#P5100S2").val().length > 0 && $("#P5100S3").val().length > 0) {
			var P5100S4 = parseInt($("#P5100S1").val()) + parseInt($("#P5100S2").val()) + parseInt($("#P5100S3").val());
			$("#P5100S4").val(P5100S4);
		} else {
			$("#P5100S4").val('');
		}
	});
	$('#P5100S3').blur(function() {
		if($("#P5100S1").val().length > 0 && $("#P5100S2").val().length > 0 && $("#P5100S3").val().length > 0) {
			var P5100S4 = parseInt($("#P5100S1").val()) + parseInt($("#P5100S2").val()) + parseInt($("#P5100S3").val());
			$("#P5100S4").val(P5100S4);
		} else {
			$("#P5100S4").val('');
		}
	});
	$('#P5103').blur(function () {
		$('#P5103A').reemplazarValorLabel('P5103A', 'P5103');
	});
	$('#P5180S1').blur(function () {
		if($(this).attr('placeholder') == '$$$') {
			var P5180S1 = $('#P5180S1').val();
			var num = P5180S1.replace(/\./g,'');
			console.log(num);
		}
	});
});
</script>