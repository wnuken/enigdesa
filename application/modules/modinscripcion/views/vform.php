<h1>Inscripci&oacute;n</h1>
<br />
<ul class="nav nav-tabs" style="display: none">
	<li class="<?=$tab1;?>"><a href="#tab1" data-toggle="tab">Datos Personales</a></li>
	<li class="<?=$tab2;?>"><a href="#tab2" data-toggle="tab">Conformaci&oacute;n del hogar</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane <?echo $tab1;?>" id="tab1">
		<h2>Datos Personales</h2>
		<i>Los campos que están marcados con un asterisco (*) son de diligenciamiento obligatorio</i><br/>
		<form id="form_DATPERSONAL_1" name="form_DATPERSONAL_1" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<? echo $id_formulario; ?>" />
			<input type="hidden" name="_INI_DATPERSONAL_1" id="_INI_DATPERSONAL_1" value="<? echo $datpersonal_ini; ?>" />
			<div>
				<div>
					<br />
<?php
	$nuevogrupo = "";
	foreach ($datpersonal_var as $k => $v) {
		if ($v ['GRUPO'] != $nuevogrupo) {
			echo "  </div>\n";
			echo "</div>\n";
			// Esta opcion oculta el grupo y los campos asociados cuando el tipo de campo este definido como oculto.
			if ($v ['TIPO_CAMPO'] == "OCULTO")
				echo "<div class='form-group has-feedback' style='display: none'>\n";
			else
				echo "<div class='form-group has-feedback' id='div-". $v['ID_VARIABLE'] ."'>\n";
			echo "  <h5 class='control-label' for='" . $v['ID_VARIABLE'] . "'>" . $v['DESCRIPCION'];
			// mayandarl - Ayuda asociada a la pregunta.
			if (!empty($v['AYUDA']))
				echo "&nbsp;<a href='#' data-toggle='tooltip' title='". $v['AYUDA'] ."'>(?)</a>";
			echo "</h5>\n";
			echo "  <div id='RESP_" . $v['ID_VARIABLE'] . "' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
		} else {
			echo "&nbsp;&nbsp;";
		}
		if ($v['TIPO_CAMPO'] == "SELUNICA") {
			echo mostrar_select($v, $datpersonal_opc);
		} 
		else if ($v['TIPO_CAMPO'] == "SELUNICA_RAD") {
			echo mostrar_radios($v, $datpersonal_opc);
		}
		else if ($v['TIPO_CAMPO'] == "SINO") {
			echo mostrar_sino($v, $datpersonal_opc);
		}
		else {
			echo mostrar_input_text($v);
		}
		$nuevogrupo = $v ['GRUPO'];
	}
?>
				</div>
			</div>
			<!--<input type="button" id="enviar1" value="Guardar y continuar" />-->
		</form>
		<div class="row">
			<div class="col-sm-12" id="mensaje_DATPERSONAL_1"></div>
		</div>
		<div class="row text-center">
			<button class='btn btn-success' id='ENV_DATPERSONAL_1'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
		</div>
	</div>
	<div class="tab-pane <?echo $tab2;?>" id="tab2">
		<br />
		<h2>Datos de Conformaci&oacute;n del Hogar</h2>
		<blockquote>Para el diligenciamiento de la encuesta tenga en cuenta que:
			<div class="row">
			<div class="alert alert-info col-sm-4" role="alert">
				<strong>HOGAR</strong> es una persona o grupo de personas, parientes o no, que: <br>
				1. Ocupan la totalidad o parte de una vivienda.<br>
				2. Atienden necesidades básicas con cargo a un presupuesto común.<br>
				3. Generalmente, comparten las comidas.
			</div>
			<div class="col-sm-1"></div>
			<div class="alert alert-info col-sm-4" role="alert">
			Las personas que componen un hogar deben ser 
			<strong>RESIDENTES HABITUALES</strong>, es decir, personas (familiares o no) que viven (residen) permanentemente o 
			la mayor parte del tiempo en la vivienda, aunque en el momento del diligenciamiento se encuentren ausentes temporalmente.
			</div>
			</div>
			De acuerdo con las definiciones previamente descritas y las siguientes <a href='#' onclick='$("#AYUDA").dialog("open");'>consideraciones</a>, responda las siguientes preguntas:
		</blockquote>
		<br/>
		<form id="form_FAMILIA_1" name="form_FAMILIA_1" class="form-horizontal" role="form">
			<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<? echo $id_formulario; ?>" />
			<input type="hidden" name="_ID_PERSONA" id="_ID_PERSONA" />
			<input type="hidden" name="_INI_FAMILIA_1" id="_INI_FAMILIA_1" value="<? echo $datpersonal_ini; ?>" />
			<input type="hidden" name="_ACC_FAMILIA_1" id="_ACC_FAMILIA_1" value="INSERT" />
			<input type="hidden" id="_RGASTOS" value="NO" />
			<input type="hidden" id="_JEFEHOG" value="NO" />
			<div>
				<div>
					<br />
<?php
	$nuevogrupo = "";
	foreach ($familia_var as $k => $v) {
		if ($v ['GRUPO'] != $nuevogrupo) {
			echo "  </div>\n";
			echo "</div>\n";
			// Esta opcion oculta el grupo y los campos asociados cuando el tipo de campo este definido como oculto.
			if ($v ['TIPO_CAMPO'] == "OCULTO")
				echo "<div class='form-group has-feedback' style='display: none'>\n";
			else
				echo "<div class='form-group has-feedback' id='div-". $v['ID_VARIABLE'] ."'>\n";
			echo "  <h5 class='control-label' for='" . $v['ID_VARIABLE'] . "'>" . $v['DESCRIPCION'];
			// mayandarl - Ayuda asociada a la pregunta.
			if (!empty($v['AYUDA']))
				echo "&nbsp;<a href='#' data-toggle='tooltip' title='". $v['AYUDA'] ."'>(?)</a>";
			echo "</h5>\n";
			echo "  <div id='RESP_". $v['ID_VARIABLE'] ."' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>\n";
		} else {
			echo "&nbsp;&nbsp;";
		}
		if ($v['TIPO_CAMPO'] == "SELUNICA") {
			echo mostrar_select($v, $familia_opc);
		} 
		else if ($v['TIPO_CAMPO'] == "SELUNICA_RAD") {
			echo mostrar_radios($v, $familia_opc);
		}
		else if ($v['TIPO_CAMPO'] == "SINO") {
			echo mostrar_sino($v, $familia_opc);
		}
		else {
			echo mostrar_input_text($v);
		}
		$nuevogrupo = $v['GRUPO'];
	}
?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" id="mensaje_FAMILIA_1"></div>
			</div>
			<div class="row">
				<div class="col-sm-6"></div>
				<div class="col-sm-6"><a id="ENV_FAMILIA_1"><img class="boton" src="<?php echo base_url("images/form_icon-guardar.png"); ?>" /></a></div>
			</div>
			<br />
			<table class="table table-striped table-bordered table-reflow">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nombres y Apellidos</th>
						<th>Sexo</th>
						<th>Edad</th>
						<th>Parentesco con el Jefe(a) de Hogar</th>
						<th>Gastos?</th>
						<th>Actualizar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody id="tablapersonas">
				</tbody>
			</table>
		</form>
		<div class="row text-center">
			<button class='btn btn-success' id='INSC_FINALIZAR'>Guardar y Finalizar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Finalizar'></span></button>
		</div>
	</div>
</div>
<div id="AYUDA" title="Consideraciones Residentes">
Recuerde incluir como parte de su hogar a los siguientes RESIDENTES HABITUALES, porque no tienen residencia habitual en otro hogar:
<br/><br/>
<ol>
<li> Personas que están ausentes por 6 meses o menos por motivos especiales como: vacaciones, cursos de capacitación, viajes de negocio, comisiones de trabajo, entre otros; y además, cuentan con la seguridad de que van a regresar al hogar después de estos 6 meses o menos.</li>
<li> Agentes viajeros, marinos mercantes.</li>
<li> Secuestrados y desaparecidos, sin importar el tiempo de ausencia.</li>
<li> Enfermos internados en hospitales o clínicas, sin importar el tiempo de ausencia.</li>
<li> Desplazados, sin importar el tiempo de permanencia en el hogar encuestado.</li>
<li> Detenidos temporalmente en inspecciones de policía.</li>
<li> Empleados internos del servicio doméstico.</li>
<li> Personas que están prestando el servicio militar en la policía pero duermen en sus respectivos hogares.</li>
<li> Pensionistas.</li>
<li> Residentes de casas fiscales al interior de guarniciones militares.</li>
</ol>
NO incluya como RESIDENTES HABITUALES:
<ol>
<li> Personas que aunque sean consideradas como el principal soporte económico del hogar y estén presentes en el hogar cada fin de semana o cada 15 días, lleven 6 meses o más ausentes y tengan residencia en otro hogar porque permanecen la mayor parte del tiempo en un sitio diferente.</li>
<li> Personas que en el momento de la encuesta están pagando condenas en cárceles, prestando servicio militar en cuarteles del ejército, la fuerza aérea o en la amada nacional; están internos en instituciones educativas, asilos, conventos o monasterios.</a></li>
</ol>
</div>
<div id="msj_numpers" title="Personas del Hogar">
  <p>¿Está seguro(a) que los residentes registrados son TODOS los residentes habituales de su hogar? Recuerde que una vez acepte esta información NO podrá ser modificada.</p>
</div>
<script>
    // aplicar reglas de consistencia
    // regla[ID__#] = NEW ARRAY{0=REGLA, 1=MENSAJE, 2=TIPOERROR, 3=ESTADO}
    var regla_cap1 = new Array();
<?php
foreach ($datpersonal_reg as $k => $v) {
    echo "\tregla_cap1['$k']= new Array('". $v['CONDICION'] ."','". $v['MENSAJE_ERROR'] ."','". $v['TIPO_ERROR'] ."',0);\n";
}
?>
    var regla_cap2 = new Array();
<?php
foreach ($familia_reg as $k => $v) {
    echo "\tregla_cap2['$k']= new Array('". $v['CONDICION'] ."','". $v['MENSAJE_ERROR'] ."','". $v['TIPO_ERROR'] ."',0);\n";
}
echo "\t var filas = '". count($familia_personas) ."';\n";
?>
	regla_cap2['P10250S1C2__1']= new Array('($("[name=P10250S1C2]:checked").val()=="")','Respuesta obligatoria. Por favor, seleccione alguna opción para continuar','Corrija',0);
	regla_cap2['P10250S1C2__2']= new Array('($("[name=P10250S1C2]:checked").val()=="1" && $("#P6040").val() <=10)','Responsable de gastos debe ser mayor de 10 años.','Corrija',0);
	regla_cap2['P10250S1C2__3']= new Array('($("[name=P10250S1C2]:checked").val()=="1" && $("#_RGASTOS").val()=="SI")','Ya existe un Responsable de gastos.','Corrija',0);
	regla_cap2['P6050__3']= new Array('($("#P6050").val()=="1" && $("#_JEFEHOG").val()=="SI")','Ya existe un jefe(a) del hogar.','Corrija',0);
	var autz = true;
    function cargaform(url) {
		$('#mensaje_FAMILIA_1').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Un momento por favor..</div>');
		$.ajax({
			type: 'POST',
			url: url,
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			cache: false,
			success: function (respuesta) {
				$('#form_FAMILIA_1').find('input, select').attr('disabled',false);
				$('#_ACC_FAMILIA_1').val('UPDATE');
				var data = $.parseJSON($.trim(respuesta));
				$.each(data, function (key, value) {
					asignarValor(key, value);
					if (key == "P10250S1C2" && value == "1")
						$("#_RGASTOS").val("NO");
					if (key == "P6050" && value == "1")
						$("#_JEFEHOG").val("NO");
					chk_cons(key, regla_cap2);
				});
				$('#mensaje_FAMILIA_1').html('');
			}
		});
    }
    function eliminaform(url) {
        $.ajax({
            type: 'POST',
            url: url,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            cache: false,
            success: function (respuesta) {
				$("#mensaje_FAMILIA_1").html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Registro eliminado</div>');
                recargatabla();
				$("#mensaje_FAMILIA_1").html('');
			}
        });
    }
    function recargatabla() {
		$('#_ACC_FAMILIA_1').val('INSERT');
		asignarValor('P521A', '');
		asignarValor('P521B', '');
		asignarValor('P521C', '');
		asignarValor('P521D', '');
		asignarValor('P6020', '');
		asignarValor('P6040', '');
		asignarValor('P6050', '');
		asignarValor('P10250S1C2', '');
		$("#_RGASTOS").val("NO");
		$("#_JEFEHOG").val("NO");
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("modinscripcion/Form/personas") . "/" . $id_formulario; ?>",
			cache: false,
			success: function (response) {
				var datos = $.parseJSON($.trim(response));
				var trHTML = "";
				filas = 0;
				$.each(datos, function (i, item) {
					filas++;
					if (item.P10250S1C2 == "Si")
						$("#_RGASTOS").val("SI");
					if (item._P6050 == "1")
						$("#_JEFEHOG").val("SI");
					trHTML += "<tr><td>"+ filas +"</td><td>" + item.P521 +"</td><td>" + item.P6020 + "</td><td>" + item.P6040 + 
						"</td><td>" + item.P6050 + "</td>" + "</td><td>" + item.P10250S1C2 + "</td>" +
						"<td align='center'><a onclick=\"cargaform('<?php echo base_url("modinscripcion/Form/persona") . "/" . $id_formulario . "/";?>" + 
					   item.ID_PERSONA + "');\"><img src='<?php echo base_url("images/form_icon-editar.png"); ?>'/></a></td>" +
					   "<td align='center'><a onclick=\"eliminaform('<?php echo base_url("modinscripcion/Form/nopersona") . "/" . $id_formulario . "/";?>" + 
					   item.ID_PERSONA + "');\"><img src='<?php echo base_url("images/form_icon-eliminar.png"); ?>'/></a></td></tr>";
				});
				$('#tablapersonas').html(trHTML);
				if (filas == 20) {
					$('#mensaje_FAMILIA_1').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ha alcanzado el máximo de personas permitidas</div>');
					$('#form_FAMILIA_1').find('input, select').attr('disabled',true);
				}
				else {
					$('#mensaje_FAMILIA_1').html('');
					$('#form_FAMILIA_1').find('input, select').attr('disabled',false);
				}
			}
		});
    }
	$(function () {
		$("#msj_numpers").dialog({
			autoOpen: false,
			resizable: true,
			height:250,
			position: { my: 'top', at: 'top+150' },
			modal: true,
			buttons: {
				"Aceptar": function() {
					document.location = "Form/finfamilia";
					$( this ).dialog( "close" );
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$("#AYUDA").dialog({
			autoOpen: false,
			position: { my: 'top', at: 'top+150' },
			height:550,
			width:800,
			modal: true
		});
		$('#P6040').attr('readonly', true);
		// FAMILIA :: Control de dependencias entre variables...
		$("#P548").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", yearRange: '1900:2016',
			onSelect: function (dateText) {
				// Calcular edad
				var today = new Date();
				var birthDate = new Date(dateText);
				var age = today.getFullYear() - birthDate.getFullYear();
				var m = today.getMonth() - birthDate.getMonth();
				if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
					age--;
				}
				$("#P6040").val(age);
				chk_cons('P548', regla_cap2);
				chk_cons('P6040', regla_cap2);
			}
		});
		recargatabla();
		$("#ENV_FAMILIA_1").click(function () {
			var estado = 1;
			var txt = "";
			var id;
			for (var id_i in regla_cap2) {
				id = id_i.split('__');
				chk_cons(id[0], regla_cap2);
				estado = estado * regla_cap2[id_i][3];
				txt += id_i + ":" + regla_cap2[id_i][3] + " | \n";
			}
			if (estado) {
				var myf = $('#form_FAMILIA_1');
				var args = myf.serialize().replace(/(%0D%0A|%0D|%0A|%22|%5C|')/g, " ");
				//$(this).attr('disabled', true);
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url("modinscripcion/Form/guardar/FAMILIA/1") ?>',
					cache: false,
					contentType: "application/x-www-form-urlencoded; charset=UTF-8",
					data: args,
					beforeSend: function (objeto) {
						$('#mensaje_FAMILIA_1').html('<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Enviando m&oacute;dulo</div>');
					},
					success: function (respuesta) {
						$('#mensaje_FAMILIA_1').html('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> '+ respuesta +'<span id="btn_seguir"><span></div>');
						recargatabla();
					},
					error: function (respuesta) {
						$('#mensaje_FAMILIA_1').html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error guardando m&oacute;dulo</div>');
					}
				});
				$(this).attr('disabled', false);
			} else {
				$('#mensaje_FAMILIA_1').html('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Hay campos que requieren correcciones, por favor verifique e intente nuevamente</div>');
			}
		});
		// control de las fechas de jquery
		// Envio del formulario.
		$('#ENV_DATPERSONAL_1').verificar_enviar('DATPERSONAL_1', '<?php echo site_url("modinscripcion/Form/guardar/DATPERSONAL/1") ?>', regla_cap1);
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
<?php
// 2016-03-31 - mayandarl - Asignacion de tipos de datos
foreach ($datpersonal_var as $k => $v) {
    if ($v ['TIPO_DATO'] == 'NUMERICO')
        echo "\t$('#" . $v ['ID_VARIABLE'] . "').numerico();\n";
    if ($v ['TIPO_CAMPO'] == 'MAYUSC') {
		echo "\t$('#" . $v ['ID_VARIABLE'] . "').mayusculas();\n";
		//echo "\t$('#" . $v ['ID_VARIABLE'] . "').texto();\n";
	}
}
// 2016-03-31 - mayandarl - Asignacion de valores iniciales
foreach ($datpersonal_val as $k => $v) {
    echo "\t asignarValor('$k', '$v');\n";
}
// 2016-03-31 - mayandarl - Incluye las reglas de validacion
foreach ($datpersonal_reg as $k => $v) {
    $f = explode("__", $k);
    if ($f [1] == '1')
        echo "\t\$('#" . $f [0] . "').consistencia('" . $f [0] . "', regla_cap1);\n";
}
?>
		// DAT_PERSONAL:: Control de dependencias entre variables...
		$('[name=P20_C]').dependencias('P20_C', 'P20', [2], true);
		$('[name=P10_C]').dependencias('P10_C', 'P10', [2], true);
		// VAR P6008_1
		//$('#P6008_1').numerico();
		//$('#P6008_1').consistencia('P6008_1', regla_cap2);
		//$('#TEL_INDICATIVO').dependencias('TEL_INDICATIVO', 'TEL_FIJO', [1, 2, 3, 4]);
		//
		$('[name=P10250S1C2]').consistencia('P10250S1C2', regla_cap2);
		///////////////////////////////////////////////////////////
<?php
// 2016-04-05 - mayandarl - Asignacion de tipos de datos
foreach ($familia_var as $k => $v) {
    if ($v ['TIPO_DATO'] == 'NUMERICO')
        echo "\t$('#" . $v ['ID_VARIABLE'] . "').numerico();\n";
    if ($v ['TIPO_CAMPO'] == 'MAYUSC') {
        echo "\t$('#" . $v ['ID_VARIABLE'] . "').mayusculas();\n";
        //echo "\t$('#" . $v ['ID_VARIABLE'] . "').texto();\n";
	}
}
// 2016-04-05 - mayandarl - Asignacion de valores iniciales
//foreach ($familia_val as $k=>$v) {
//	echo "\t$('#$k').val('$v');\n";
//}
// 2016-04-05 - mayandarl - Incluye las reglas de validacion
foreach ($familia_reg as $k => $v) {
    $f = explode("__", $k);
    if ($f[1] == '1')
        echo "\t\$('#" . $f[0] . "').consistencia('" . $f[0] . "', regla_cap2);\n";
}
?>
		// FAMILIA :: Control de dependencias entre variables...
		$('#INSC_FINALIZAR').click(function () {
			var fin = true;
			var html = '';
			if (filas == 0) {
				html += "<span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span> Debe existir al menos una persona en el hogar<br>\n";
				fin = false;
			}
			if ($('#_JEFEHOG').val() == "NO") {
				html += "<span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span> Debe existir UN Jefe(a) de Hogar.<br>\n";
				fin = false;
			}
			if ($('#_RGASTOS').val() == "NO") {
				html += "<span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span> Debe existir UN responsable de gastos del hogar<br>\n";
				fin = false;
			}
			if (fin) {
				$("#msj_numpers").dialog("open");
			}
			else {
				$('#mensaje_FAMILIA_1').html('<div class="alert alert-warning" role="alert">'+ html +'</div>');
			}
		});
    });
</script>