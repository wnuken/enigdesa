<hr />
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8"><h3><?echo $secc['DESCR_SECCION']; ?></h3></div>
	</div>
		<br />
		<h4>¿Con qué frecuencia compran generalmente los siguientes alimentos o grupos de alimentos en el hogar? <a href='#' data-toggle='tooltip' title='Si la frecuencia en un grupo de alimentos es combinada registre solo una frecuencia en el siguiente orden de prioridad: diario, varias veces por semana, semanal, quincenal, mensual, bimestral y trimestral. Ejemplo: Si en el hogar compran pan diariamente (Diaria), y arepas de manera semanal (Semanal), se registra todo el grupo de alimentos con la opción Diario.'>(?)</a></h4>
		<form id="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" name="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
			<input type="hidden" name="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
<?
	if (!empty($secc['ENCABEZADO']))
		echo "			<blockquote>". $secc['ENCABEZADO'] ."</blockquote>\n";
	foreach ( $preg['opc'] as $v ) {
		if ($v['ID_VARIABLE'] == 'NC2_CC_P1') {
			echo "<div class='row'>\n";
			echo "	<div class='col-sm-3' id='RESP_NC2_CC_P2_-_". $v['ID_VALOR'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''><h4>". 
				"(". $v['ID_VALOR'] .") ". $v['ETIQUETA'] ."</h4></div>\n";
			foreach ( $preg['opc'] as $v2 ) {
				if ($v2['ID_VARIABLE'] == 'NC2_CC_P2') {
					echo "	<div class='col-sm-1 text-center'><input type='radio' name='". $v2['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."' id='". 
						$v2['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] .".". $v2['ID_VALOR'] ."' value='" .
						$v2['ID_VALOR'] ."'/><br/><label for='". $v2['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] .".". $v2['ID_VALOR'] ."'>". $v2['ETIQUETA'] ."</label></div>\n";
				}
			}
			echo "</div>\n";
			echo "	<div class='row'><div class='col-sm-5'></div>\n";
			echo "		<div class='col-sm-7'>\n";
			foreach ($preg['var'] as $v3) {
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1' || $v3['ID_VARIABLE'] == 'NC2_CC_P3_S2') {
					echo "<div class='form-group has-feedback' id='div-". $v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."'><h5 class='control-label'>". $v3['DESCRIPCION'] ."</h5>";
					echo "<div id='RESP_". $v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
				}
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1') {
					echo "<input type='text' id='". $v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."' name='". $v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."' size='". $v3['LONG_TEXTO'] .
					"' maxlength='". $v3['LONGITUD'] ."' placeholder='". $v3['ETIQUETA'] ."' onBlur=\"if(\$(this).val()!='99') document.getElementById('". 
					$v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."_99').checked=false;\" />&nbsp;&nbsp;<input type='radio' id='". 
					$v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."_99' name='_". $v3['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] ."'/> Obtuvo el alimento, pero no sabe el valor.\n";
				}
				elseif ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S2') {
					foreach ($preg['opc'] as $v4) {
						if ($v4['ID_VARIABLE'] == $v3['ID_VARIABLE']) {
							echo "<input type='radio' name='". $v4['ID_VARIABLE'] ."_-_". $v['ID_VALOR']."' id='". $v4['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] .".". $v4['ID_VALOR'] .
								"' value='". $v4['ID_VALOR'] . "'" . " /> ";
							echo "<label for='". $v4['ID_VARIABLE'] ."_-_". $v['ID_VALOR'] .".". $v4['ID_VALOR'] ."'> ". $v4['ETIQUETA'] ."</label>&nbsp;&nbsp;\n";
						}
					}
				}
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1' || $v3['ID_VARIABLE'] == 'NC2_CC_P3_S2')
					echo "</div></div>\n";
			}
			echo "		</div>\n";
			echo "	</div>\n";
		}
	}
	echo "<div>
			<div><br />\n";
	$nuevogrupo = "";
	$vargrupo = false;
	foreach ($preg['var'] as $v3) {
		if (substr($v3['ID_VARIABLE'],0,9) == 'NC2_CC_P4') {
			if ($v3['GRUPO'] != $nuevogrupo) {
				echo "					</div>\n";
				echo "				</div>\n";
				// Inicio Grupo de preguntas...
				if (!empty($preg['grv'])) {
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
			if ($v3['TIPO_CAMPO'] == "SINO") {
				echo mostrar_sino($v3, $preg['opc']);
			}
			else if ($v3['TIPO_CAMPO'] == "NUMNOSABE") {
				echo "<input type='text' id='". $v3['ID_VARIABLE'] ."' name='". $v3['ID_VARIABLE'] ."' size='". $v3['LONG_TEXTO'] .
				"' maxlength='". $v3['LONGITUD'] ."' placeholder='". $v3['ETIQUETA'] ."' onBlur=\"if(\$(this).val()!='99') document.getElementById('". 
				$v3['ID_VARIABLE'] .".99').checked=false;\" />&nbsp;&nbsp;<input type='radio' id='". 
				$v3['ID_VARIABLE'] .".99' name='_". $v3['ID_VARIABLE'] ."' onClick=\"$('#". 
				$v3['ID_VARIABLE'] ."').val('99');$('#". $v3['ID_VARIABLE'] ."').focus();\"/> Obtuvo el alimento, pero no sabe el valor.\n";
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
	}
	echo "		\n";
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
		echo "		<button class='btn btn-info' onClick='window.location.replace(\"". site_url("modgastoshogar/Gastoshog/anterior") ."\");'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true' title='Volver'></span>Regresar y Modificar</button>\n";
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
	$min = 0;
	$max = 0;
	foreach ( $preg['opc'] as $v2 ) {
		if ($v2['ID_VARIABLE'] == 'NC2_CC_P1') {
			echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P2_-_". $v2['ID_VALOR'] ."__1']= new Array('$(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val()==undefined','Respuesta obligatoria. Por favor, seleccione una opción para continuar.','Corrija',0);\n";
			echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."__1']= new Array('($(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"5\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"6\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"7\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"9\") && $(\"#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."\").val().length==0','Respuesta obligatoria. Por favor, digite un valor o seleccione una opción para continuar.','Corrija',0);\n";
			switch($v2['ID_VALOR']) {
				case "01":	$min = 500;		$max = 100000;	break;
				case "02":	$min = 500;		$max = 100000;	break;
				case "03":	$min = 1000;	$max = 500000;	break;
				case "04":	$min = 1000;	$max = 500000;	break;
				case "05":	$min = 1000;	$max = 500000;	break;
				case "06":	$min = 1000;	$max = 500000;	break;
				case "07":	$min = 1000;	$max = 500000;	break;
				case "08":	$min = 1000;	$max = 200000;	break;
				case "09":	$min = 1000;	$max = 200000;	break;
				case "10":	$min = 1000;	$max = 500000;	break;
				case "11":	$min = 1000;	$max = 200000;	break;
				case "12":	$min = 1000;	$max = 200000;	break;
				case "13":	$min = 1000;	$max = 200000;	break;
				case "14":	$min = 1000;	$max = 200000;	break;
				case "15":	$min = 1000;	$max = 100000;	break;
				case "16":	$min = 1000;	$max = 200000;	break;
				case "17":	$min = 1000;	$max = 100000;	break;
				case "18":	$min = 1000;	$max = 200000;	break;
				case "19":	$min = 1000;	$max = 200000;	break;
				case "20":	$min = 1000;	$max = 200000;	break;
				case "21":	$min = 1000;	$max = 100000;	break;
				case "22":	$min = 1000;	$max = 200000;	break;
				case "23":	$min = 1000;	$max = 200000;	break;
				case "24":	$min = 1000;	$max = 200000;	break;
				case "25":	$min = 1000;	$max = 5000000;	break;
			}
			echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."__2']= new Array('($(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"5\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"6\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"7\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"9\") && $(\"#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."\").val().length != 0 && !(($(\"#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."\").val() >$min && $(\"#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."\").val() <$max) || $(\"#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."\").val()==99)','Por favor, verifique su respuesta. El valor que registró no es válido.','Corrija',0);\n";
			echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P3_S2_-_". $v2['ID_VALOR'] ."__1']= new Array('($(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"5\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"6\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"7\" || $(\"[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]:checked\").val() == \"9\") && $(\"[name=NC2_CC_P3_S2_-_". $v2['ID_VALOR'] ."]:checked\").val()==undefined','Respuesta obligatoria. Por favor, digite un valor o seleccione una opción para continuar.','Corrija',0);\n";
		}
	}
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S1__1']= new Array('$(\"[name=NC2_CC_P4_A1]:checked\").val()==1 && $(\"#NC2_CC_P4_S1\").val().length==0','Respuesta obligatoria. Por favor, digite un valor o seleccione una opción para continuar.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S1__2']= new Array('$(\"[name=NC2_CC_P4_A1]:checked\").val()==1 && $(\"#NC2_CC_P4_S1\").val().length != 0 && !($(\"#NC2_CC_P4_S1\").val() >500 || $(\"#NC2_CC_P4_S1\").val()==99)','Por favor, verifique su respuesta. El valor que registró no es válido.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S2__1']= new Array('$(\"[name=NC2_CC_P4_A2]:checked\").val()==1 && $(\"#NC2_CC_P4_S2\").val().length==0','Respuesta obligatoria. Por favor, digite un valor o seleccione una opción para continuar.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S2__2']= new Array('$(\"[name=NC2_CC_P4_A2]:checked\").val()==1 && $(\"#NC2_CC_P4_S2\").val().length != 0 && !($(\"#NC2_CC_P4_S2\").val() >500 || $(\"#NC2_CC_P4_S2\").val()==99)','Por favor, verifique su respuesta. El valor que registró no es válido.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S3__1']= new Array('$(\"[name=NC2_CC_P4_A3]:checked\").val()==1 && $(\"#NC2_CC_P4_S3\").val().length==0','Respuesta obligatoria. Por favor, digite un valor o seleccione una opción para continuar.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S3__2']= new Array('$(\"[name=NC2_CC_P4_A3]:checked\").val()==1 && $(\"#NC2_CC_P4_S3\").val().length != 0 && !($(\"#NC2_CC_P4_S3\").val() >500 || $(\"#NC2_CC_P4_S3\").val()==99)','Por favor, verifique su respuesta. El valor que registró no es válido.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S4__1']= new Array('$(\"#NC2_CC_P4_S4\").val().length==0','Respuesta obligatoria. Por favor, digite un valor o seleccione una opción para continuar.','Corrija',0);\n";
	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P4_S4__2']= new Array('$(\"#NC2_CC_P4_S4\").val().length != 0 && !($(\"#NC2_CC_P4_S4\").val() >500 || $(\"#NC2_CC_P4_S4\").val()==99)','Por favor, verifique su respuesta. El valor que registró no es válido.','Corrija',0);\n";
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
	echo "\t\$('#NC2_CC_P4_S1').consistencia('NC2_CC_P4_S1', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	echo "\t\$('#NC2_CC_P4_S2').consistencia('NC2_CC_P4_S2', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	echo "\t\$('#NC2_CC_P4_S3').consistencia('NC2_CC_P4_S3', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
	foreach ( $preg['opc'] as $v2 ) {
		if ($v2['ID_VARIABLE'] == 'NC2_CC_P1') {
			// 2016-04-05 - mayandarl - Incluye las reglas de validacion
			echo "\t\$('[name=NC2_CC_P2_-_". $v2['ID_VALOR'] ."]').consistencia('NC2_CC_P2_-_". $v2['ID_VALOR'] ."', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
			echo "\t\$('#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."').consistencia('NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
			echo "\t\$('[name=NC2_CC_P3_S2_-_". $v2['ID_VALOR'] ."]').consistencia('NC2_CC_P3_S2_-_". $v2['ID_VALOR'] ."', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
			// 2016-04-30 - mayandarl - Incluye las reglas de dependencia
			foreach ($preg['dep'] as $v) {
				if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
					$id = "[name=". $v['VAR_ORIGEN'] ."_-_". $v2['ID_VALOR'] ."]";
				else
					$id = "#". $v['VAR_ORIGEN'] ."_-_". $v2['ID_VALOR'];
				if ($v['VAR_DESTINO'] == 'NC2_CC_P4_A1' || $v['VAR_DESTINO'] == 'NC2_CC_P4_A2' || $v['VAR_DESTINO'] == 'NC2_CC_P4_A3' || $v['VAR_DESTINO'] == 'NC2_CC_P4_S4')
					echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."_-_". $v2['ID_VALOR'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
				elseif ($v['VAR_ORIGEN'] == 'NC2_CC_P2')
					echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."_-_". $v2['ID_VALOR'] ."','". $v['VAR_DESTINO'] ."_-_". $v2['ID_VALOR'] ."',". $v['DEPENDENCIA'] .", true);\n";
			}
			// 2016-04-05 - mayandarl - Asignacion de tipos de datos
			foreach ( $preg['var'] as $v3 ) {
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1')
					echo "	$('#" . $v3 ['ID_VARIABLE'] ."_-_". $v2['ID_VALOR'] ."').number(true, 0, ',', '.');\n";
			}
			echo "\t\$('#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."_99').click(function () {
				$('#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."').val('99');
				$('#NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."').focus();
				chk_depend('NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."','NC2_CC_P4_A1',/[99]/, true);
				chk_depend('NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."','NC2_CC_P4_A2',/[99]/, true);
				chk_depend('NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."','NC2_CC_P4_A3',/[99]/, true);
				chk_depend('NC2_CC_P3_S1_-_". $v2['ID_VALOR'] ."','NC2_CC_P4_S4',/[99]/, true);
			});\n";
		}
	}
	foreach ($preg['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		if ($v['VAR_ORIGEN'] == 'NC2_CC_P4_A1' || $v['VAR_ORIGEN'] == 'NC2_CC_P4_A2' || $v['VAR_ORIGEN'] == 'NC2_CC_P4_A3')
			echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
	echo "\t\$('#NC2_CC_P4_S1').number(true, 0, ',', '.');\n";
	echo "\t\$('#NC2_CC_P4_S2').number(true, 0, ',', '.');\n";
	echo "\t\$('#NC2_CC_P4_S3').number(true, 0, ',', '.');\n";
	echo "\t\$('#NC2_CC_P4_S4').number(true, 0, ',', '.');\n";
	echo "$('#ENV_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."').verificar_enviar('". $secc['ID_SECCION']."_". $secc['PAGINA'] ."','". 
		site_url("modgastoshogar/Gastoshog/guardar/". $secc['ID_SECCION']."_". $secc['PAGINA']). "/NA', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
?>
});
</script>