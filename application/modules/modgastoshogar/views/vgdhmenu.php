<div id="formulario">
  <ul>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/01DIA1";?>" id="DIA1">Día 1</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/02DIA2";?>" id="DIA2">Día 2</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/03DIA3";?>" id="DIA3">Día 3</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/04DIA4";?>" id="DIA4">Día 4</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/05DIA5";?>" id="DIA5">Día 5</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/06DIA6";?>" id="DIA6">Día 6</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/07DIA7";?>" id="DIA7">Día 7</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/08DIA8";?>" id="DIA8">Día 8</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/09DIA9";?>" id="DIA9">Día 9</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/10DIA10";?>" id="DIA10">Día 10</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/11DIA11";?>" id="DIA11">Día 11</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/12DIA12";?>" id="DIA12">Día 12</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/13DIA13";?>" id="DIA13">Día 13</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/14DIA14";?>" id="DIA14">Día 14</a></li>
  </ul>
  <div id='MSGDIA' style='display:none'></div>
</div>
<script>
<?
	$disab = "";
	$sindia = true;
	foreach ($dias as $k=>$v) {
		if ($v['E'] == "HOY") {
			$activo = "			active: $k,\n";
			$id = $k + 1;
			if ($v['F'] == "NO") {
				$sindia = false;
			}
		}
		if ($v['E'] == "OFF" || $v['F'] == "SI")
			$disab .= "$k,";
	}
	$disab = "		disabled: [". substr($disab, 0, -1) ."]\n";
	// Tiempo expirado para el formulario. Devuelve al menu anterior
	if ($sindia) {
		echo "$('#DIA". $id ."').attr('href', '#MSGDIA');\n";
		echo "$('#MSGDIA').html('<h3>Este dia ya no se encuentra disponible para reportar gastos.</h3>');\n";
		echo "$('#MSGDIA').show();\n";
	}
?>
	$("#formulario").tabs({
		spinner: 'Loading...',
		cache: false,
		ajaxOptions: {cache: false},	
		itemOptions: [{ cache: false }],
		activate: function(event, ui) {
			$('#MSGDIA').show();
			//var tabID = "#DIA" + (ui.newTab.index() + 1);
			$('#MSGDIA').html("<h3>Cargando informaci&oacute;n del dia...</h3>");
		},
		load: function( event, ui ) {
			$('#MSGDIA').hide();
		},
		beforeLoad: function (event, ui) {
			ui.ajaxSettings.cache = false;
		},
		/*select: function(event, ui) {
			var tabID = "#DIA" + (ui.index + 1);
			console.log(ui);
			$(tabID).html("<h3>Cargando informaci&oacute;n del dia...</h3>");
		},*/
<?
	echo $activo . $disab;
?>
	});
</script>