<hr />
	<div class="row">
		<div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-hogar.png");?>" /></div>
		<div class="col-sm-8"><h3><?echo $secc['DESCR_SECCION']; ?></h3></div>
	</div>
		<br />
		<form id="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" name="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
			<input type="hidden" name="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
<?
	if (!empty($secc['ENCABEZADO']))
		echo "			<blockquote>". $secc['ENCABEZADO'] ."</blockquote>\n";
	foreach ( $preg['opc'] as $v ) {
		if ($v['ID_VARIABLE'] == 'NC2_CC_P1') {
			echo "<div class='row'>\n";
			echo "	<div class='col-sm-3' id='RESP_NC2_CC_P2___". $v['ID_VALOR'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''><h4>". 
				$v['ETIQUETA'] ."</h4></div>\n";
			foreach ( $preg['opc'] as $v2 ) {
				if ($v2['ID_VARIABLE'] == 'NC2_CC_P2') {
					echo "	<div class='col-sm-1 text-center'><input type='radio' name='". $v2['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."' id='". 
						$v2['ID_VARIABLE'] ."___". $v['ID_VALOR'] .".". $v2['ID_VALOR'] ."' value='" .
						$v2['ID_VALOR'] ."'/><br/><label for='". $v2['ID_VARIABLE'] ."___". $v['ID_VALOR'] .".". $v2['ID_VALOR'] ."'>". $v2['ETIQUETA'] ."</label></div>\n";
				}
			}
			echo "</div>\n";
			echo "	<div class='row'><div class='col-sm-7'></div>\n";
			echo "		<div class='col-sm-5'>\n";
			foreach ($preg['var'] as $v3) {
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1' || $v3['ID_VARIABLE'] == 'NC2_CC_P3_S2') {
					echo "<div class='form-group has-feedback' id='div-". $v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."'><h5 class='control-label'>". $v3['DESCRIPCION'] ."</h5>";
					echo "<div class='col-sm-8' id='RESP_". $v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
				}
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1') {
					echo "<input type='text' id='". $v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."' name='". $v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."' size='". $v3['LONG_TEXTO'] .
					"' maxlength='". $v3['LONGITUD'] ."' placeholder='". $v3['ETIQUETA'] ."' onBlur=\"if(\$(this).val()!='99') document.getElementById('". 
					$v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] .".99').checked=false;\" />&nbsp;&nbsp;<input type='radio' id='". 
					$v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] .".99' name='_". $v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."' onClick=\"$('#". 
					$v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."').val('99');$('#". $v3['ID_VARIABLE'] ."___". $v['ID_VALOR'] ."').focus();\"/> Obtuvo el alimento, pero no sabe el valor.\n";
				}
				elseif ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S2') {
					foreach ($preg['opc'] as $v4) {
						if ($v4['ID_VARIABLE'] == $v3['ID_VARIABLE']) {
							echo "<input type='radio' name='". $v4['ID_VARIABLE'] ."___". $v['ID_VALOR']."' id='". $v4['ID_VARIABLE'] ."___". $v['ID_VALOR'] .".". $v4['ID_VALOR'] .
								"' value='". $v4['ID_VALOR'] . "'" . " /> ";
							echo "<label for='". $v4['ID_VARIABLE'] ."___". $v['ID_VALOR'] .".". $v4['ID_VALOR'] ."'> ". $v4['ETIQUETA'] ."</label>&nbsp;&nbsp;\n";
						}
					}
				}
				if ($v3['ID_VARIABLE'] == 'NC2_CC_P3_S1' || $v3['ID_VARIABLE'] == 'NC2_CC_P3_S2')
					echo "</div></div>\n";
			}
			echo "</div></div>\n";
		}
	}
?>
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
	foreach ( $preg['opc'] as $v2 ) {
		if ($v2['ID_VARIABLE'] == 'NC2_CC_P1') {
			echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['NC2_CC_P2___". $v2['ID_VALOR'] ."__1']= new Array('$(\"[name=NC2_CC_P2___". $v2['ID_VALOR'] ."]:checked\").val()==undefined','Respuesta obligatoria. Por favor, seleccione una opción para continuar.','Corrija',0);\n";
		}
	}
	//foreach ($preg['reg'] as $k2=>$v2)
	//	echo "\t regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
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
	foreach ( $preg['opc'] as $v2 ) {
		if ($v2['ID_VARIABLE'] == 'NC2_CC_P1') {
			// 2016-04-05 - mayandarl - Incluye las reglas de validacion
			echo "\t\$('[name=NC2_CC_P2___". $v2['ID_VALOR'] ."]').consistencia('NC2_CC_P2___". $v2['ID_VALOR'] ."', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
			/*foreach ($preg['reg'] as $k4=>$v4) {
				$f = explode("__", $k4);
				if ($f[1] == '1') {
					if ($v4['TIPO_CAMPO'] == "SELUNICA_RAD" || $v4['TIPO_CAMPO'] == "SINO")
						$id = "[name=". $f[0] ."]";
					else
						$id = "#". $f[0];
					echo "\t\$('$id').consistencia('". $f[0] ."', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
				}
			}*/
			// 2016-04-30 - mayandarl - Incluye las reglas de dependencia
			foreach ($preg['dep'] as $v) {
				if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
					$id = "[name=". $v['VAR_ORIGEN'] ."___". $v2['ID_VALOR'] ."]";
				else
					$id = "#". $v['VAR_ORIGEN'] ."___". $v2['ID_VALOR'];
				echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."___". $v2['ID_VALOR'] ."','". $v['VAR_DESTINO'] ."___". $v2['ID_VALOR'] ."',". $v['DEPENDENCIA'] .", true);\n";
			}
			// 2016-04-05 - mayandarl - Asignacion de tipos de datos
			foreach ( $preg['var'] as $v3 ) {
				if ($v3['TIPO_DATO'] == 'NUMERICO' || $v3['TIPO_CAMPO'] == 'NUMNOSABE' )
					echo "	$('#" . $v3 ['ID_VARIABLE'] ."___". $v2['ID_VALOR'] ."').number(true, 0, ',', '.');\n";
			}
		}
	}
	echo "$('#ENV_". $secc['ID_SECCION']."_". $secc['PAGINA'] ."').verificar_enviar('". $secc['ID_SECCION']."_". $secc['PAGINA'] ."','". 
		site_url("modgastoshogar/Gastoshog/guardar/". $secc['ID_SECCION']."/". $secc['PAGINA']). "', regla_". $secc['ID_SECCION']."_". $secc['PAGINA'] .");\n";
?>
});
</script>
