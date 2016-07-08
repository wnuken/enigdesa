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
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[compra]' value='" . $v3['ID_ARTICULO3'] . "_1' id='art_". $v3['ID_ARTICULO3'] ."_1' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Recibido por trabajo";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[recibido_pago]' value=' value='" . $v3['ID_ARTICULO3'] . "_2' id='articulo_". $v3['ID_ARTICULO3'] ."_2' class='ops_" . $i . "' />";
			echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Regalo o donaci&oacute;n";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[regalo]' value='" . $v3['ID_ARTICULO3'] . "_3' id='articulo_". $v3['ID_ARTICULO3'] ."_3' class='ops_" . $i . "' />";
			echo "</td>";			
			echo "</tr>";

			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Intercambio";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[intercambio]' value='" . $v3['ID_ARTICULO3'] . "_4' id='articulo_". $v3['ID_ARTICULO3'] ."_4' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Producido por el hogar";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[producido]' value='" . $v3['ID_ARTICULO3'] . "_5' id='articulo_". $v3['ID_ARTICULO3'] ."_5' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Tomado de un negocio propio";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[negocio_propio]' value='" . $v3['ID_ARTICULO3'] . "_6' id='articulo_". $v3['ID_ARTICULO3'] ."_6' class='ops_" . $i . "' />";
			echo "</td>";
			
			echo "</tr>";
			echo "<tr>";
			echo "<td></td><td>";
			echo "<h5 class='control-label' for='" . $v3['ID_ARTICULO3'] . "'  >Otra forma";
			echo "</h5>\n";
			echo "</td>";
			echo "<td>";
			echo "<input type='checkbox' name='" . $v3['ID_ARTICULO3'] . "[otra]' value='" . $v3['ID_ARTICULO3'] . "_7' id='articulo_". $v3['ID_ARTICULO3'] ."_7' class='ops_" . $i . "' />";
			echo "</td>";			
			echo "</tr>";

			echo "</table>";

			echo "<hr>\n";

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
			echo "	<button disabled  class='btn btn-success' id='ENV_2_2'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>\n";
		//elseif ($secc['ACCION'] == 'FINALIZAR')
		//	echo "	<button class='btn btn-success' id='ENV_". $secc['ID_SECCION'] .'_'. $secc['PAGINA'] ."'>Guardar y Finalizar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Fin'></span></button>\n";
	//}
?>

		</div>