	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<h1><?echo $secc['DESCR_SECCION']; ?></h1>
			<h2><?echo $dia; ?></h2>
		</div>
	</div>
	<hr />
	<h3>Registre sus gastos de hoy:</h3>
	<blockquote>Registre  los gastos diarios del hogar en alimentos y bebidas adquiridos y las LAS MESADAS ENTREGADAS durante el día de hoy <a href='#'>(?)</a>. 
	Además incluya los gastos 
	personales y adquisiciones realizadas por NOM_SIMP y los miembros del hogar menores de 10 años y con limitaciones cognitivas en  servicios en pasajes en bus, colectivo,
	entre otros; pago de parqueadero; llamadas locales desde cabinas telefónicas, teléfonos monederos, teléfonos públicos y llamadas por minutos desde celular a cualquier 
	destino; gastos en juegos electrónicos, de azar y de mesa; café internet; bebidas alchohólicas, estupefacientes, entre otros.</blockquote>
	<table class="table table-striped table-bordered table-reflow">
		<thead>
			<tr>
				<th>Nombre del artículo o servicio</th>
				<th>¿A quién entregó la mesada?</th>
				<th>Cantidad adquirida</th>
				<th>Unidad de Medida</th>
				<th>Equivalencia</th>
				<th>Forma de Adquisición</th>
				<th>Lugar de compra</th>
				<th>¿Cuánto pagó o cuánto tendría que pagar?</th>
				<th>Frecuencia de compra</th>
				<th>Este gasto fue:</th>
				<th>Actualizar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody id="tablaarticulos">
		</tbody>
	</table>
	<div class="row">
		<div class="col-sm-6 text-right"><button type='button' id='btn_articulos' onclick="$('#GDH_ARTICULOS').dialog('open');">A&ntilde;adir</button></div>
		<div class="col-sm-1"></div><div class="col-sm-1" id="mensaje_ARTICULOS"></div></div>
	<hr />
	<h3>Registre los gastos y adquisiciones realizadas el día de hoy en comidas preparadas fuera del hogar:</h3>
	<blockquote>Registre los gastos del hogar y personales de NOM_SIMP en comidas preparadas fuera del hogar como en restaurantes, tiendas, 
	fondas ruralres y al aire libre. <a href='#'>(?)</a></blockquote>
	<table class="table table-striped table-bordered table-reflow">
		<thead>
			<tr>
				<th>Comida o alimento adquirido</th>
				<th>Tipo de comida</th>
				<th>Cantidad adquirida</th>
				<th>Forma de Adquisición</th>
				<th>Lugar de compra</th>
				<th>¿Cuánto pagó o cuánto tendría que pagar?</th>
				<th>Frecuencia de Compra</th>
				<th>Este gasto fue:</th>
				<th>¿Lo adquirio a domicilio?</th>
				<th>Actualizar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody id="tablacomidas">
		</tbody>
	</table>
	<div class="row">
		<div class="col-sm-6 text-right"><button type='button' id='btn_comidas'>A&ntilde;adir</button></div>
		<div class="col-sm-1"></div><div class="col-sm-1" id="mensaje_COMIDAS"></div></div>
	<br/>
	<form id="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" name="form_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" class="form-horizontal" role="form">
		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
		<input type="hidden" name="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
		
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
	<div id="GDH_ARTICULOS" title="Gastos de Hoy">
		<form id="form_ARTICULOS" name="form_ARTICULOS" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?echo $id_formulario; ?>" />
			<input type="hidden" name="_DIA" id="_DIA" value="<?echo $dia; ?>" />
			<input type="hidden" name="_ID_ARTICULO" id="_ID_ARTICULO"/>
			<input type="hidden" name="_INI_ARTICULOS" id="_INI_ARTICULOS"/>
			<input type="hidden" name="_ACC_ARTICULOS" id="_ACC_ARTICULOS" value='INSERT'/>
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
			echo mostrar_select($v3, $preg_art['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SELUNICA_RAD") {
			echo mostrar_radios($v3, $preg_art['opc']);
		}
		else if ($v3['TIPO_CAMPO'] == "SINO") {
			echo mostrar_sino($v3, $preg_art['opc']);
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
		if (!empty($preg_art['grv'])) {
			foreach ($preg_art['grv'] as $grv)
				if ($grv['ULT_VARIABLE'] == $v3['ID_VARIABLE'])
					echo "		<hr></div><!-- ". $grv['IDGRUPO'] ."-->\n";
		}
	}
?>
				</div>
			</div>
		</form>
	</div>
<script>
<?php
	echo "\t var regla_art = new Array();\n";
	foreach ($preg_art['reg'] as $k2=>$v2) {
		echo "\t regla_art['$k2']= new Array('". $v2['CONDICION'] ."','". $v2['MENSAJE_ERROR'] ."','". $v2['TIPO_ERROR'] ."',0);\n";
	}
?>
    function cargaformArt(url) {
		$("#GDH_ARTICULOS").dialog('open');
		$('#mensaje_ARTICULOS').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Un momento por favor..</div>');
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
				$('#mensaje_ARTICULOS').html('');
			}
		});
    }
    function eliminaformArt(url) {
        $.ajax({
            type: 'POST',
            url: url,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            cache: false,
            success: function (respuesta) {
				$("#mensaje_ARTICULOS").html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Registro eliminado</div>');
                recargatablaArt();
				$("#mensaje_ARTICULOS").html('');
			}
        });
    }
    function recargatablaArt() {
		$('#_ACC_ARTICULOS').val('INSERT');
		asignarValor('P521A', '');
		asignarValor('P521B', '');
		asignarValor('P521C', '');
		asignarValor('P521D', '');
		asignarValor('P6020', '');
		asignarValor('P6040', '');
		asignarValor('P6050', '');
		asignarValor('P10250S1C2', '');
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("modgastoshogar/Gastoshog/articulos") ."/". $id_formulario ."/". $dia; ?>",
			cache: false,
			success: function (response) {
				var datos = $.parseJSON($.trim(response));
				var trHTML = "";
				$.each(datos, function (i, item) {
					trHTML += "<tr><td>"+ "" +"</td><td>" + item.P521 +"</td><td>" + item.P6020 + "</td><td>" + item.P6040 + 
						"</td><td>" + item.P6050 + "</td>" + "</td><td>" + item.P10250S1C2 + "</td>" +
						"<td align='center'><a onclick=\"cargaformArt('<?php echo base_url("modgastoshogar/Gastoshog/articulo") ."/". $id_formulario ."/";?>" + 
					   item.ID_ARTICULO +"');\"><img src='<?php echo base_url("images/form_icon-editar.png"); ?>'/></a></td>" +
					   "<td align='center'><a onclick=\"eliminaformArt('<?php echo base_url("modgastoshogar/Gastoshog/noarticulo") ."/". $id_formulario ."/";?>" + 
					   item.ID_ARTICULO +"');\"><img src='<?php echo base_url("images/form_icon-eliminar.png"); ?>'/></a></td></tr>";
				});
				$('#tablaarticulos').html(trHTML);
			}
		});
    }

$(function() {
	$("#GDH_ARTICULOS").dialog({
		autoOpen: false,
		resizable: true,
		width:800,
		height:500,
		modal: true,
		buttons: {
			"Guardar": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	recargatablaArt();
	$("#ENV_ARTICULOS").click(function () {
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
				url: '<?php echo site_url("modgastoshogar/Gastoshog/guardar/ARTICULOS") ?>',
				cache: false,
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				data: args,
				beforeSend: function (objeto) {
					$('#mensaje_ARTICULOS').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando m&oacute;dulo</div>');
				},
				success: function (respuesta) {
					$('#mensaje_ARTICULOS').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> '+ respuesta +'<span id="btn_seguir"><span></div>');
					recargatablaArt();
				},
				error: function (respuesta) {
					$('#mensaje_ARTICULOS').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
				}
			});
			$(this).attr('disabled', false);
		} else {
			$('#mensaje_ARTICULOS').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
		}
	});
	// control de las fechas de jquery
	// Envio del formulario.
<?php
	// 2016-04-05 - mayandarl - Asignacion de valores iniciales
	foreach ( $resp_art as $k => $v ) {
		echo "	asignarValor('$k','$v');\n";
	}
	// 2016-04-05 - mayandarl - Incluye las reglas de validacion
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
	// 2016-04-30 - mayandarl - Incluye las reglas de dependencia
	foreach ($preg_art['dep'] as $v) {
		if ($v['VO_TIPOCAMPO'] == "SELUNICA_RAD" || $v['VO_TIPOCAMPO'] == "SINO")
			$id = "[name=". $v['VAR_ORIGEN'] ."]";
		else
			$id = "#". $v['VAR_ORIGEN'];
		echo "\t\$('$id').dependencias('". $v['VAR_ORIGEN'] ."','". $v['VAR_DESTINO'] ."',". $v['DEPENDENCIA'] .", true);\n";
	}
	// 2016-04-05 - mayandarl - Asignacion de tipos de datos
	foreach ( $preg_art['var'] as $v3 ) {
		if ($v3['TIPO_DATO'] == 'NUMERICO')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').numerico();\n";
		if ($v3['TIPO_CAMPO'] == 'MAYUSC')
			echo "	$('#" . $v3 ['ID_VARIABLE'] . "').mayusculas();\n";
	}
?>
});
</script>