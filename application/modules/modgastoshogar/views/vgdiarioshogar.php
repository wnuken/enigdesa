	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<h3><?echo $fecha; ?></h3>
		</div>
	</div>
	<h3>Registre sus gastos de hoy:</h3>
	<blockquote>Registre  los gastos diarios del hogar en alimentos y bebidas adquiridos y las LAS MESADAS ENTREGADAS durante el día de hoy <a href='#' data-toggle='tooltip' title='Para el registro de sus gastos de hoy tenga en cuenta: *El diligenciamientos de sus gastos personales debe hacerlo solo durante 7 días.  *El registro de las mesadas entregadas debe hacerce el mismo día en que efectúe la entrega.  *Incluir los artículos y servicios que sin ser comprados los obtuvo de un negocio propio, como regalo, intercambio o como pago por su trabajo. '>(?)</a>. 
	Además incluya los gastos personales y adquisiciones realizadas por <i><? echo $persona['P521A'] ." ". $persona['P521C']; ?></i> y los miembros del hogar menores 
	de 10 años y con limitaciones cognitivas en  servicios en pasajes en bus, colectivo, entre otros; pago de parqueadero; llamadas locales desde cabinas 
	telefónicas, teléfonos monederos, teléfonos públicos y llamadas por minutos desde celular a cualquier destino; gastos en juegos electrónicos, de azar y 
	de mesa; café internet; bebidas alchohólicas, estupefacientes, entre otros.</blockquote>
	<table class="table table-striped table-bordered table-reflow">
		<thead>
			<tr>
				<th align="center">Nombre del artículo o servicio</th>
				<th align="center">¿A quién entregó la mesada?</th>
				<th align="center">Cantidad adquirida</th>
				<th align="center">Unidad de Medida</th>
				<th align="center">Equivalencia</th>
				<th align="center">Forma de Adquisición</th>
				<th align="center">Lugar de compra</th>
				<th align="center">¿Cuánto pagó o cuánto tendría que pagar?</th>
				<th align="center">Frecuencia de compra</th>
				<th align="center">Este gasto fue:</th>
				<th align="center">Actualizar</th>
				<th align="center">Eliminar</th>
			</tr>
		</thead>
		<tbody id="tablaarticulos_<?echo $seccion;?>">
		</tbody>
	</table>
	<div class="row">
		<div class="col-sm-6 text-right"><button type='button' onclick="recargatablaArt();$('#GDH_<?echo $seccion;?>_ARTICULOS').dialog('open');">A&ntilde;adir</button></div>
		<div class="col-sm-1"></div><div class="col-sm-5" id="mensaje_ARTICULOS_<?echo $seccion;?>"></div>
	</div>
	<hr />
	<h3>Registre los gastos y adquisiciones realizadas el día de hoy en comidas preparadas fuera del hogar:</h3>
	<blockquote>Registre los gastos del hogar y personales de <i><? echo $persona['P521A'] ." ". $persona['P521C']; ?></i> en comidas preparadas fuera del hogar como en restaurantes, tiendas, 
	fondas ruralres y al aire libre. <a href='#' data-toggle='tooltip' title='Tenga en cuenta el conjunto de alimentos y bebidas no alcohólicas que son adquiridos para usted y los miembros del hogar menores de 10 años en los principales momentos de alimentación (desayuno, almuerzo, comida, merienda), incluyendo aquellos que se piden para llevar o a domicilio. Por ejemplo: Si compró para usted o su familia una pizza en un restaurante o si pidió a domicilio hamburguesas para almorzar en su lugar de trabajo.'>(?)</a></blockquote>
	<table class="table table-striped table-bordered table-reflow">
		<thead>
			<tr>
				<th align="center">Comida o alimento adquirido</th>
				<th align="center">Tipo de comida</th>
				<th align="center">Cantidad adquirida</th>
				<th align="center">Forma de Adquisición</th>
				<th align="center">Lugar de compra</th>
				<th align="center">¿Cuánto pagó o cuánto tendría que pagar?</th>
				<th align="center">Frecuencia de Compra</th>
				<th align="center">Este gasto fue:</th>
				<th align="center">¿Lo adquirio a domicilio?</th>
				<th align="center">Actualizar</th>
				<th align="center">Eliminar</th>
			</tr>
		</thead>
		<tbody id="tablacomidas_<?echo $seccion;?>">
		</tbody>
	</table>
	<div class="row">
		<div class="col-sm-6 text-right"><button type='button' id='btn_comidas' onclick="recargatablaCom();$('#GDH_<?echo $seccion;?>_COMIDAS').dialog('open');">A&ntilde;adir</button></div>
		<div class="col-sm-1"></div><div class="col-sm-5" id="mensaje_COMIDAS_<?echo $seccion;?>"></div>
	</div>
	<br/>
<?
	if ($seccion == "14DIA14") {
?>
	<form id="form_14DIA14" name="form_14DIA14" class="form-horizontal" role="form">
		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario;?>" />
			<div>
				<div>
					<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	foreach ( $preg_d14['var'] as $v3 ) {
		if ($v3['GRUPO'] != $nuevogrupo) {
			echo "					</div>\n";
			echo "				</div>\n";
			// Inicio Grupo de preguntas...
			if (!empty($preg_d14['grv'])) {
				foreach ($preg_d14['grv'] as $grv) {
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
			echo "					<div class='col-sm-11' id='RESP_". $v3['ID_VARIABLE'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
			if ($v3['TEXTO_AUXILIAR'] != '')
				echo "<small><i>". $v3['TEXTO_AUXILIAR']. "</i></small><br/>\n";
		} else {
			echo "&nbsp;&nbsp;";
		}
		if ($v3['TIPO_CAMPO'] == "SELUNICA")
			echo mostrar_select($v3, $preg_d14['opc']);
		else if ($v3['TIPO_CAMPO'] == "SINO")
			echo mostrar_sino($v3, $preg_d14['opc']);
		else 
			echo mostrar_input_text($v3);
		if (!$vargrupo)
			echo "<!--<hr>-->\n";
		$nuevogrupo = $v3['GRUPO'];
		// Fin grupo de preguntas.
		if (!empty($preg_d14['grv'])) {
			foreach ($preg_d14['grv'] as $grv)
				if ($grv['ULT_VARIABLE'] == $v3['ID_VARIABLE'])
					echo "		<!--<hr>--></div><!-- ". $grv['IDGRUPO'] ."-->\n";
		}
	}
?>
				</div>
			</div>
	</form>
	<div class="row">
		<div class="col-sm-12" id="mensaje_14DIA14"></div>
	</div>
	<div class="row text-center">
		<div class="col-sm-12"><button class='btn btn-success' id='ENV_14DIA14' onclick="$('#<?echo $seccion;?>_confirm').dialog('open');">Guardar y Finalizar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button></div>
	</div>
<?
	}
	else {
?>
	<div class="row text-center">
		<div class="col-sm-12"><button class='btn btn-success' onclick="$('#<?echo $seccion;?>_confirm').dialog('open');">Guardar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Guardar'></span></button></div>
	</div>
<?
	}
?>
	<div id="GDH_<?echo $seccion;?>_ARTICULOS" title="Gastos de Hoy">
		<form id="form_ARTICULOS" name="form_ARTICULOS" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
			<input type="hidden" name="_<?echo $seccion;?>" id="_<?echo $seccion;?>" value="<?echo $dia; ?>" />
			<input type="hidden" name="_ID_ARTICULO_<?echo $seccion;?>" id="_ID_ARTICULO_<?echo $seccion;?>"/>
			<input type="hidden" name="_INI_ARTICULOS_<?echo $seccion;?>" id="_INI_ARTICULOS_<?echo $seccion;?>"/>
			<input type="hidden" name="_ACC_ARTICULOS_<?echo $seccion;?>" id="_ACC_ARTICULOS_<?echo $seccion;?>" value='INSERT'/>
			<input type="hidden" id="_RMED_<?echo $seccion;?>" value='SI'/>
			<input type="hidden" id="_RLUG_<?echo $seccion;?>" value='SI'/>
			<div>
				<div>
					<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	foreach ( $preg_art['var'] as $v3 ) {
		if ($v3['GRUPO'] != $nuevogrupo) {
			echo "					</div>\n";
			echo "				</div>\n";
			// Inicio Grupo de preguntas...
			if (!empty($preg_art['grv'])) {
				foreach ($preg_art['grv'] as $grv) {
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
				echo "				<div class='form-group has-feedback' id='div-". $v3['ID_VARIABLE'] ."_$seccion'>\n";
			// mayandarl - Texto de la pregunta.
			echo "<h5 class='control-label' id='lbl-". $v3['ID_VARIABLE'] ."' for='". $v3['ID_VARIABLE'] ."_$seccion'>(". $v3['ID_VARIABLE'] .") ". $v3['DESCRIPCION'];
			// mayandarl - Ayuda asociada a la pregunta.
			if (!empty($v3['AYUDA']))
				echo "&nbsp;<a href='#' data-toggle='tooltip' title='". $v3['AYUDA'] ."'>(?)</a>";
			echo "</h5>\n";
			// mayandarl - Asigna ID para la seccion de opciones de respuesta. Se utiliza en la verificacion de consistencias.
			echo "					<div class='col-sm-11' id='RESP_". $v3['ID_VARIABLE'] ."_$seccion' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
			if ($v3['TEXTO_AUXILIAR'] != '')
				echo "<small><i>". $v3['TEXTO_AUXILIAR']. "</i></small><br/>\n";
		} else {
			echo "&nbsp;&nbsp;";
		}
		if ($v3['TIPO_CAMPO'] == "SELUNICA") {
			echo mostrar_select($v3, $preg_art['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SELUNICA_RAD") {
			echo mostrar_radios($v3, $preg_art['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SINO") {
			echo mostrar_sino($v3, $preg_art['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "NUMNOSABE") {
			echo "<input type='text' id='". $v3['ID_VARIABLE'] ."_$seccion' name='". $v3['ID_VARIABLE'] ."_$seccion' size='". $v3['LONG_TEXTO'] ."' maxlength='". $v3['LONGITUD'] .
				"' placeholder='". $v3['ETIQUETA'] ."' onBlur=\"if(\$(this).val()!='98') document.getElementById('". $v3['ID_VARIABLE'] .
				"_$seccion.98').checked=false; if(\$(this).val()!='99') document.getElementById('". $v3['ID_VARIABLE'] ."_$seccion.99').checked=false;\" />&nbsp;&nbsp;\n". 
				"<input type='radio' id='". $v3['ID_VARIABLE'] ."_$seccion.98' name='_". $v3['ID_VARIABLE'] ."_$seccion' onClick=\"$('#". $v3['ID_VARIABLE'] ."_$seccion').val('98');$('#". 
				$v3['ID_VARIABLE'] ."_$seccion').focus();\"/> Este valor ya se reportó en otro gasto.&nbsp;&nbsp;\n".
				"<input type='radio' id='". $v3['ID_VARIABLE'] ."_$seccion.99' name='_". $v3['ID_VARIABLE'] ."_$seccion' onClick=\"$('#". $v3['ID_VARIABLE'] ."_$seccion').val('99');$('#". 
				$v3['ID_VARIABLE'] ."_$seccion').focus();\"/> No sabe, no informa.\n";
		}
		else {
			if ($v3['ID_VARIABLE'] == 'NH_CGDU_P1_1') {
				echo "<input type='text' size='". $v3['LONG_TEXTO'] ."' maxlength='". $v3['LONGITUD'] ."' placeholder='". $v3['ETIQUETA'] ."' id='_". 
					$v3['ID_VARIABLE'] ."_$seccion' name='_" . $v3['ID_VARIABLE'] . "_$seccion'/><input type='hidden' id='". $v3['ID_VARIABLE'] ."_$seccion' name='" . $v3['ID_VARIABLE'] . "_$seccion'/> \n".
					"<!--<input type='radio' id='". $v3['ID_VARIABLE'] .".98' onClick=\"$('#_". $v3['ID_VARIABLE'] ."').val('Otro');$('#". $v3['ID_VARIABLE'] ."').focus();\"/> Otro-->\n";
			}
			else 
				echo mostrar_input_text($v3);
		}
		if (!$vargrupo)
			echo "<!--<hr>-->\n";
		$nuevogrupo = $v3['GRUPO'];
		// Fin grupo de preguntas.
		if (!empty($preg_art['grv'])) {
			foreach ($preg_art['grv'] as $grv)
				if ($grv['ULT_VARIABLE'] == $v3['ID_VARIABLE'])
					echo "		<!--<hr>--></div><!-- ". $grv['IDGRUPO'] ."-->\n";
		}
	}
?>
				</div>
			</div>
		</form>
	</div><!-- articulos -->
	<div id="GDH_<?echo $seccion;?>_COMIDAS" title="Comidas preparadas fuera del hogar">
		<form id="form_COMIDAS" name="form_COMIDAS" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
			<input type="hidden" name="_<?echo $seccion;?>" id="_<?echo $seccion;?>" value="<?echo $dia; ?>" />
			<input type="hidden" name="_ID_COMIDA" id="_ID_COMIDA"/>
			<input type="hidden" name="_INI_COMIDAS" id="_INI_COMIDAS"/>
			<input type="hidden" name="_ACC_COMIDAS" id="_ACC_COMIDAS" value='INSERT'/>
			<div>
				<div>
					<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	foreach ( $preg_com['var'] as $v3 ) {
		if ($v3['GRUPO'] != $nuevogrupo) {
			echo "					</div>\n";
			echo "				</div>\n";
			// Inicio Grupo de preguntas...
			if (!empty($preg_com['grv'])) {
				foreach ($preg_com['grv'] as $grv) {
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
			echo "					<div class='col-sm-11' id='RESP_". $v3['ID_VARIABLE'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
			if ($v3['TEXTO_AUXILIAR'] != '')
				echo "<small><i>". $v3['TEXTO_AUXILIAR']. "</i></small><br/>\n";
		} else {
			echo "&nbsp;&nbsp;";
		}
		if ($v3['TIPO_CAMPO'] == "SELUNICA") {
			echo mostrar_select($v3, $preg_com['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SELUNICA_RAD") {
			echo mostrar_radios($v3, $preg_com['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SINO") {
			echo mostrar_sino($v3, $preg_com['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "NUMNOSABE") {
			echo mostrar_numnosabe($v3);
		}
		else {
			echo mostrar_input_text($v3);
		}
		if (!$vargrupo)
			echo "<!--<hr>-->\n";
		$nuevogrupo = $v3['GRUPO'];
		// Fin grupo de preguntas.
		if (!empty($preg_com['grv'])) {
			foreach ($preg_com['grv'] as $grv)
				if ($grv['ULT_VARIABLE'] == $v3['ID_VARIABLE'])
					echo "		<!--<hr>--></div><!-- ". $grv['IDGRUPO'] ."-->\n";
		}
	}
?>
				</div>
			</div>
		</form>
	</div><!-- comidas -->
	<!--<input type='hidden' id='<?echo $seccion;?>' value="<? echo $seccion; ?>"/>-->
	<div id="<?echo $seccion;?>_confirm" title="Confirmación">¿Está seguro(a) que ha registrado TODOS los gastos durante este día?. 
	Recuerde que una vez acepte la información NO podrá ser modificada.</div>
<script>
<?php
	echo "\t var regla_art = new Array();\n";
	foreach ($preg_art['reg'] as $k2=>$v2)
		echo "\t regla_art['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
	echo "\t var regla_com = new Array();\n";
	foreach ($preg_com['reg'] as $k2=>$v2)
		echo "\t regla_com['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
	if ($seccion == "14DIA14") {
		echo "\t var regla_d14 = new Array();\n";
		foreach ($preg_d14['reg'] as $k2=>$v2)
			echo "\t regla_d14['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
	}
?>
    function cargaformArt(url) {
		$('#mensaje_ARTICULOS_<?echo $seccion;?>').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Un momento por favor..</div>');
		$.ajax({
			type: 'POST',
			url: url,
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			cache: false,
			success: function (respuesta) {
				$('#form_ARTICULOS').find('input, select').attr('disabled',false);
				$('#_ACC_ARTICULOS').val('UPDATE');
				var data = $.parseJSON($.trim(respuesta));
				$.each(data, function (key, value) {
					asignarValor(key, value);
					chk_cons(key, regla_art);
				});
<?
	// 2016-06-30 - mayandarl - Incluye las reglas de dependencia
	foreach ($preg_art['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		echo "\t\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
?>
				$('#mensaje_ARTICULOS_<?echo $seccion;?>').html('');
			}
		});
		$("#GDH_<?echo $seccion;?>_ARTICULOS").dialog('open');
    }
    function eliminaformArt(url) {
        $.ajax({
            type: 'POST',
            url: url,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            cache: false,
            success: function (respuesta) {
				$("#mensaje_ARTICULOS_<?echo $seccion;?>").html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Registro eliminado</div>');
                recargatablaArt();
				$("#mensaje_ARTICULOS_<?echo $seccion;?>").html('');
			}
        });
    }
    function recargatablaArt() {
		$('#_ACC_ARTICULOS').val('INSERT');
		asignarValor('_NH_CGDU_P1_1', ''); asignarValor('NH_CGDU_P1_1', '');
		asignarValor('NH_CGDU_P1_1_S1', '');
		asignarValor('P10250S1C2M', '');
		asignarValor('NH_CGDU_P2', '');
		asignarValor('NH_CGDU_P3', '');
		asignarValor('NH_CGDU_P3_S1', '');
		asignarValor('NH_CGDU_P4_S1', '');
		asignarValor('NH_CGDU_P4_S2', '');
		asignarValor('NH_CGDU_P5', '');
		asignarValor('NH_CGDU_P6', '');
		asignarValor('NH_CGDU_P7B1379', '');
		asignarValor('NH_CGDU_P8', '');
		asignarValor('NH_CGDU_P9', '');
		asignarValor('NH_CGDU_P10', '');
		asignarValor('_ID_ARTICULO', '');
<?
	// 2016-06-30 - mayandarl - Incluye las reglas de dependencia
	foreach ($preg_art['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		echo "\t\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
?>
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("modgastoshogar/Gastoshog/articulos") ."/". $id_formulario ."/". $dia; ?>",
			cache: false,
			success: function (response) {
				var subtot = 0;
				var datos = $.parseJSON($.trim(response));
				var trHTML = "";
				$.each(datos, function (i, item) {
					if (item.NH_CGDU_P8 != "98" && item.NH_CGDU_P8 != "99")
						subtot += parseInt(item.NH_CGDU_P8);
					trHTML += "<tr><td>"+ item.NH_CGDU_P1_1 +"</td><td>" + item.P10250S1C2M + "</td><td>" + item.NH_CGDU_P2 + 
						"</td><td>" + item.NH_CGDU_P3 + "</td>" + "</td><td>" + item.NH_CGDU_P4_S1 +" "+ item.NH_CGDU_P4_S2 + "</td><td>"+ item.NH_CGDU_P5 + 
						"</td><td>" + item.NH_CGDU_P7B1379 +"</td><td>"+ item.NH_CGDU_P8 +"</td><td>"+ item.NH_CGDU_P9 +"</td><td>"+ item.NH_CGDU_P10 + "</td>" +
						"<td align='center'><a onclick=\"cargaformArt('<?php echo base_url("modgastoshogar/Gastoshog/articulo") ."/". $id_formulario ."/";?>" + 
					   item.ID_ARTICULO +"');\"><img src='<?php echo base_url("images/form_icon-editar.png"); ?>'/></a></td>" +
					   "<td align='center'><a onclick=\"eliminaformArt('<?php echo base_url("modgastoshogar/Gastoshog/noarticulo") ."/". $id_formulario ."/";?>" + 
					   item.ID_ARTICULO +"');\"><img src='<?php echo base_url("images/form_icon-eliminar.png"); ?>'/></a></td></tr>";
				});
				trHTML += "<tr><td colspan='6'></td><td colspan='3'><b>SUBTOTAL: $"+ subtot +"</b></td><td colspan='3'></td></tr>";
				$('#tablaarticulos_<?echo $seccion;?>').html(trHTML);
			}
		});
    }
	//////
    function cargaformCom(url) {
		$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Un momento por favor..</div>');
		$.ajax({
			type: 'POST',
			url: url,
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			cache: false,
			success: function (respuesta) {
				$('#form_COMIDAS').find('input, select').attr('disabled',false);
				$('#_ACC_COMIDAS').val('UPDATE');
				var data = $.parseJSON($.trim(respuesta));
				$.each(data, function (key, value) {
					asignarValor(key, value);
					chk_cons(key, regla_art);
				});
<?
	// 2016-06-30 - mayandarl - Incluye las reglas de dependencia
	foreach ($preg_com['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
?>				$('#mensaje_COMIDAS_<?echo $seccion;?>').html('');
			}
		});
		$("#GDH_<?echo $seccion;?>_COMIDAS").dialog('open');
    }
    function eliminaformCom(url) {
        $.ajax({
            type: 'POST',
            url: url,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            cache: false,
            success: function (respuesta) {
				$("#mensaje_COMIDAS_<?echo $seccion;?>").html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Registro eliminado</div>');
                recargatablaCom();
				$("#mensaje_COMIDAS_<?echo $seccion;?>").html('');
			}
        });
    }
    function recargatablaCom() {
		$('#_ACC_COMIDAS').val('INSERT');
		asignarValor('NH_CGDUCFH_P1', '');
		asignarValor('NH_CGDUCFH_P1_1', '');
		asignarValor('NH_CGDUCFH_P2', '');
		asignarValor('NH_CGDUCFH_P3', '');
		asignarValor('NH_CGDUCFH_P3_1', '');
		asignarValor('NH_CGDUCFH_P4', '');
		asignarValor('NH_CGDUCFH_P5', '');
		asignarValor('NH_CGDUCFH_P6', '');
		asignarValor('NH_CGDUCFH_P7', '');
		asignarValor('NH_CGDUCFH_P8', '');
		asignarValor('_ID_COMIDA', '');
<?
	// 2016-06-30 - mayandarl - Incluye las reglas de dependencia
	foreach ($preg_com['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
?>		$.ajax({
			type: "POST",
			url: "<?php echo site_url("modgastoshogar/Gastoshog/comidas") ."/". $id_formulario ."/". $dia; ?>",
			cache: false,
			success: function (response) {
				var subtot = 0;
				var datos = $.parseJSON($.trim(response));
				var trHTML = "";
				$.each(datos, function (i, item) {
					if (item.NH_CGDUCFH_P5 != '98' && item.NH_CGDUCFH_P5 != '99')
						subtot += parseInt(item.NH_CGDUCFH_P5);
					trHTML += "<tr><td>"+ item.NH_CGDUCFH_P1 +"</td><td>" + item.NH_CGDUCFH_P1_1 + "</td><td>" + item.NH_CGDUCFH_P2 + 
						"</td><td>" + item.NH_CGDUCFH_P3 + "</td>" + "</td><td>"+ item.NH_CGDUCFH_P4 + "</td><td>" + item.NH_CGDUCFH_P5 +
						"</td><td>"+ item.NH_CGDUCFH_P6 +"</td><td>"+ item.NH_CGDUCFH_P7 +"</td><td>"+ item.NH_CGDUCFH_P8 + "</td>" +
						"<td align='center'><a onclick=\"cargaformCom('<?php echo base_url("modgastoshogar/Gastoshog/comida") ."/". $id_formulario ."/";?>" + 
					   item.ID_COMIDA +"');\"><img src='<?php echo base_url("images/form_icon-editar.png"); ?>'/></a></td>" +
					   "<td align='center'><a onclick=\"eliminaformCom('<?php echo base_url("modgastoshogar/Gastoshog/nocomida") ."/". $id_formulario ."/";?>" + 
					   item.ID_COMIDA +"');\"><img src='<?php echo base_url("images/form_icon-eliminar.png"); ?>'/></a></td></tr>";
				});
				trHTML += "<tr><td colspan='5'></td><td colspan='3'><b>SUBTOTAL: $"+ subtot +"</b></td><td colspan='3'></td></tr>";
				$('#tablacomidas_<?echo $seccion;?>').html(trHTML);
			}
		});
    }

$(function() {
	$('#_NH_CGDU_P1_1').autocomplete({
		appendTo: "#GDH_ARTICULOS",
		source: function(request, response) { 
			jQuery.ajax({
				url: "<?php echo site_url("modgastoshogar/Gastoshog/autocart") ?>/" + $('#_NH_CGDU_P1_1').val(),
				dataType: "json",
				success: function(data) {
					response($.map(data, function(item) {
						return {
							label: item.nom,
							value: item.nom,
							code: item.cod,
							rmed: item.med,
							rlug: item.lug
						}
					}));
					if (jQuery.isEmptyObject(data))
						$('#_NH_CGDU_P1_1').val('');
					//response(data);
				}
			})
		},
		select: function(e, ui) {
			$('#NH_CGDU_P1_1').val(ui.item.code);
			$('#_RMED').val(ui.item.rmed);
			$('#_RLUG').val(ui.item.rlug);
			chk_depend('NH_CGDU_P1_1','NH_CGDU_P1_1_S1',[99999999], true);
			chk_depend('NH_CGDU_P1_1','P10250S1C2M',[12700700], true);
		}
	});
	$("#GDH_<?echo $seccion;?>_ARTICULOS").dialog({
		autoOpen: false,
		resizable: true,
		width:900,
		height:500,
		modal: true,
		buttons: {
			"Guardar": function() {
				var estado = 1;
				var txt = "";
				var id;
				for (var id_i in regla_art) {
					id = id_i.split('__');
					chk_cons(id[0], regla_art);
					estado = estado * regla_art[id_i][3];
					txt += id_i + ":" + regla_art[id_i][3] + " | \n";
				}
				if (estado) {
					var myf = $('#form_ARTICULOS');
					var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
					//$(this).attr('disabled', true);
					$.ajax({
						type: 'POST',
						url: '<?php echo site_url("modgastoshogar/Gastoshog/guardar/ARTICULOS") ."/". $dia; ?>',
						cache: false,
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						data: args,
						beforeSend: function (objeto) {
							$('#mensaje_ARTICULOS_<?echo $seccion;?>').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando m&oacute;dulo</div>');
						},
						success: function (respuesta) {
							$('#mensaje_ARTICULOS_<?echo $seccion;?>').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> '+ respuesta +'<span id="btn_seguir"><span></div>');
							recargatablaArt();
						},
						error: function (respuesta) {
							$('#mensaje_ARTICULOS_<?echo $seccion;?>').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
						}
					});
					$(this).attr('disabled', false);
					$( this ).dialog( "close" );
				} else {
					$('#mensaje_ARTICULOS_<?echo $seccion;?>').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
				}
			}
		}
	});
	$("#GDH_<?echo $seccion;?>_COMIDAS").dialog({
		autoOpen: false,
		resizable: true,
		width:900,
		height:500,
		modal: true,
		buttons: {
			"Guardar": function() {
				var estado = 1;
				var txt = "";
				var id;
				for (var id_i in regla_com) {
					id = id_i.split('__');
					chk_cons(id[0], regla_com);
					estado = estado * regla_com[id_i][3];
					txt += id_i + ":" + regla_com[id_i][3] + " | \n";
				}
				if (estado) {
					var myf = $('#form_COMIDAS');
					var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
					//$(this).attr('disabled', true);
					$.ajax({
						type: 'POST',
						url: '<?php echo site_url("modgastoshogar/Gastoshog/guardar/COMIDAS") ."/". $dia;?>',
						cache: false,
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						data: args,
						beforeSend: function (objeto) {
							$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando m&oacute;dulo</div>');
						},
						success: function (respuesta) {
							$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> '+ respuesta +'<span id="btn_seguir"><span></div>');
							recargatablaCom();
						},
						error: function (respuesta) {
							$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
						}
					});
					$(this).attr('disabled', false);
					$( this ).dialog( "close" );
				} else {
					$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
				}
			}
		}
	});
	$("#<?echo $seccion;?>_confirm").dialog({
		autoOpen: false,
		//resizable: true,
		width: 400,
		height: 200,
		modal: true,
		buttons: {
			Aceptar: function() {
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url("modgastoshogar/Gastoshog/findia") ."/". $seccion; ?>',
					cache: false,
					contentType: "application/x-www-form-urlencoded; charset=UTF-8",
					success: function (respuesta) {
<?
	if ($seccion == "14DIA14")
		echo "$('#ENV_14DIA14').verificar_enviar('14DIA14','". site_url("modgastoshogar/Gastoshog/guardar/14DIA14") ."/NA', regla_d14);\n";
	else
		echo "window.location = '". site_url("modgastoshogar/Gastoshog/index") ."/". $id_persona ."';\n";
?>
					//$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>'+respuesta+'<span id="btn_seguir"><span></div>');
					},
					error: function (respuesta) {
						$('#mensaje_COMIDAS_<?echo $seccion;?>').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando Dia.</div>');
					}
				});
				$( this ).dialog( "close" );
			},
			Cancelar: function() {
				$(this).dialog('close').data("confirmed", false);
			}
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	recargatablaArt();
	recargatablaCom();
<?php
	// 2016-07-05 - mayandarl - Incluye las reglas de validacion
	foreach ($preg_art['reg'] as $k2=>$v2) {
		$f = explode("__", $k2);
		if ($f[1] == '1') {
			if ($v2['TIPO_CAMPO'] == "SELUNICA_RAD" || $v2['TIPO_CAMPO'] == "SINO")
				$id = "[name=". $f[0] ."]";
			else
				$id = "#". $f[0];
			echo "\t\$('$id').consistencia('". $f[0] ."', regla_art);\n";
		}
	}
	// 2016-07-05 - mayandarl - Asignacion de tipos de datos
	foreach ( $preg_art['var'] as $v3 ) {
		if ($v3['TIPO_CAMPO'] == 'NUMERICO' || $v3['TIPO_CAMPO'] == 'NUMNOSABE' || $v3['TIPO_CAMPO'] == 'NUMNOINFO')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').number(true, 0, ',', '.');\n";
		if ($v3['TIPO_CAMPO'] == 'MAYUSC')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').mayusculas();\n";
	}
	// 2016-07-05 - mayandarl - Incluye las reglas de validacion
	foreach ($preg_com['reg'] as $k2=>$v2) {
		$f = explode("__", $k2);
		if ($f[1] == '1') {
			if ($v2['TIPO_CAMPO'] == "SELUNICA_RAD" || $v2['TIPO_CAMPO'] == "SINO")
				$id = "[name=". $f[0] ."]";
			else
				$id = "#". $f[0];
			echo "\t\$('$id').consistencia('". $f[0] ."', regla_com);\n";
		}
	}
	// 2016-07-05 - mayandarl - Asignacion de tipos de datos
	foreach ( $preg_com['var'] as $v3 ) {
		if ($v3['TIPO_CAMPO'] == 'NUMERICO' || $v3['TIPO_CAMPO'] == 'NUMNOSABE' || $v3['TIPO_CAMPO'] == 'NUMNOINFO')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').number(true, 0, ',', '.');\n";
		if ($v3['TIPO_CAMPO'] == 'MAYUSC')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').mayusculas();\n";
	}
	if ($seccion == "14DIA14") {
		//echo "$('#ENV_14DIA14').verificar_enviar('14DIA14','". site_url("modgastoshogar/Gastoshog/guardar/14DIA14") ."', regla_d14);\n";
		// 2016-07-12 - mayandarl - Incluye las reglas de validacion
		foreach ($preg_d14['reg'] as $k2=>$v2) {
			$f = explode("__", $k2);
			if ($f[1] == '1') {
				if ($v2['TIPO_CAMPO'] == "SELUNICA_RAD" || $v2['TIPO_CAMPO'] == "SINO")
					$id = "[name=". $f[0] ."]";
				else
					$id = "#". $f[0];
				echo "\t\$('$id').consistencia('". $f[0] ."', regla_d14);\n";
			}
		}
		// 2016-07-12 - mayandarl - Incluye las reglas de dependencia
		foreach ($preg_d14['dep'] as $v) {
			if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
				$id = "[name=". $v['VAR_ORIGEN'] ."]";
			else
				$id = "#". $v['VAR_ORIGEN'];
			echo "\t\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
		}
	}
?>
});
</script>