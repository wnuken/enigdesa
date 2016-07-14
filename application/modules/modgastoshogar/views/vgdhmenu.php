<div id="formulario">
  <ul>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/01DIA1";?>">Día 1</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/02DIA2";?>">Día 2</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/03DIA3";?>">Día 3</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/04DIA4";?>">Día 4</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/05DIA5";?>">Día 5</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/06DIA6";?>">Día 6</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/07DIA7";?>">Día 7</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/08DIA8";?>">Día 8</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/09DIA9";?>">Día 9</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/10DIA10";?>">Día 10</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/11DIA11";?>">Día 11</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/12DIA12";?>">Día 12</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/13DIA13";?>">Día 13</a></li>
	<li><a href="<?php echo base_url("modgastoshogar/Gastoshog/cargaDia") ."/". $id_persona ."/14DIA14";?>">Día 14</a></li>
  </ul>
</div>
<div id="formulario_confirm" title="Confirmar Cambiar">¿Está seguro(a) que ha registrado TODOS los gastos durante este día?. 
Recuerde que una vez acepte la información NO podrá ser modificada.</div>
<script>
	$("#formulario").tabs({
		disabled: [1,2,3,4,5,6,7,8,9,10,11,12,13],
		beforeLoad: function( event, ui ) {
			ui.jqXHR.fail(function() {
				ui.panel.html("Opción no disponible por el momento.");
			});
		},
		beforeActivate: function(event, ui) {
			if (!$("#formulario_confirm").data("confirmed")) {
				event.preventDefault();
				$("#formulario_confirm").dialog("open").data("ui", ui);
			}
		},
		activate: function(event, ui) {
			$("#formulario_confirm").data("confirmed", false);
		}
	});
	$("#formulario_confirm").dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Aceptar: function() {
				var ui = $(this).data("ui");
				$(this).dialog('close').data("confirmed", true);
				$("#formulario").tabs("option", "active", ui.newTab.index());
			},
			Cancelar: function() {
				$(this).dialog('close').data("confirmed", false);
			}
		}
	});
</script>