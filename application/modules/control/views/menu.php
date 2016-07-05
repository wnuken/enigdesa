<div class="row">
<br><br><br><p>A continuación, encontrará las 3 secciones en las cuales está dividido el cuestionario.</p> 
<h7>"Es necesario que diligencie todas las preguntas de cada sección para poder avanzar"</h7>
<br><br><br><br>
</div>

<div class="row">
<div class="col-sm-3 sectionHome">
<? if ($avanc_insc < 100) {
		echo '<a href="'. base_url("modinscripcion/Form").'" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'icoIncripcion\',\'\',\''. 
		base_url("images") .'/icoInscripcion_on.png\',1)"><img src="'. base_url("images") .'/icoInscripcion.png" alt="Inscripción" width="248" height="225" id="icoIncripcion"></a><hr>';
	}
	else {
		echo '<img src="'. base_url("images") .'/icoInscripcion_off.png" alt="Inscripción" id="icoIncripcion"><hr>';
	}
?>
	<h8>Inscripción</h8>
	<p>Aquí encontrará preguntas sobre la ubicación e identificación de su hogar.</p>
	<div class="progress">
		<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?echo $avanc_insc; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?echo $avanc_insc; ?>%">
			<span class="sr-only"><?echo $avanc_insc; ?>%</span>
		</div>
	</div>
</div>
<div class="col-sm-3 col-sm-offset-1 sectionHome">
<? if ($avanc_insc == 100 && $avanc_vivh < 100) {
		echo '<a href="'. base_url("modvivhogar/Vivhogar").'" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'icoVivienda\',\'\',\''. 
		base_url("images") .'/icoVivienda_on.png\',1)"><img src="'. base_url("images") .'/icoVivienda.png" alt="Vivienda y Hogar" width="248" height="225" id="icoVivienda"></a><hr>';
	}
	else {
		echo '<img src="'. base_url("images") .'/icoVivienda_off.png" alt="Vivienda y Hogar" id="icoVivienda"><hr>';
	}
?>
	<h8>Vivienda y hogar</h8>
	<p>Aquí podrá especificar las características de vivienda y las particularidades económicas, sociales y demográficas de su hogar.</p>
	<div class="progress">
		<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?echo $avanc_vivh; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?echo $avanc_vivh; ?>%">
			<span class="sr-only"><?echo $avanc_vivh; ?>%</span>
		</div>
	</div>
</div>
<div class="col-sm-3 col-sm-offset-1 sectionHomeOff">
<? if ($avanc_insc == 100 && $avanc_vivh == 100 && $avanc_igpe < 100) {
		echo '<a href="'. base_url("modinggasper/Personas").'" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'icoPersonas\',\'\',\''. 
		base_url("images") .'/icoPersonas_on.png\',1)"><img src="'. base_url("images") .'/icoPersonas.png" alt="Ingresos y Gastos personales" width="248" height="225" id="icoPersonas"></a><hr>';
	}
	else {
		echo '<img src="'. base_url("images") .'/icoPersonas_off.png" alt="Ingresos y Gastos personales" id="icoPersonas"><hr>';
	}
?>
	<h8>Personas</h8>
	<p>Aquí podrá diligenciar información general sobre su hogar y cada uno de los integrantes, así como sobre sus ingresos y gastos.</p>
	<div class="progress">
		<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?echo $avanc_igpe; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?echo $avanc_igpe; ?>%">
			<span class="sr-only"><?echo $avanc_igpe; ?>%</span>
		</div>
	</div>
</div>
</div>
<!--
<p>A continuación, encontrará las 3 secciones en las cuales está dividido el cuestionario. Es necesario que diligencie todas las preguntas de cada sección para poder avanzar</p>
<br/>
<table border=0 width="80%" align="center">
	<tr>
		<td align="center">
		<a href="<?php if ($avanc_insc=='100') echo '#'; else echo base_url("modinscripcion/Form"); ?>">
			<img  src="<?php echo base_url("images/"); ?>/menu_inscripcion_on.png" alt="Inscripcion"></a>
		<p style="width: 250px">Aquí encontrará preguntas sobre la ubicación e identificación de su hogar.</p>
		<div class="progress" style="width: 250px">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?echo $avanc_insc; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?echo $avanc_insc; ?>%">
				<span class="sr-only"><?echo $avanc_insc; ?>%</span>
			</div>
		</div>
		</td>
		<td align="center">
		<a href="<?php if ($avanc_insc=='100') echo base_url("modvivhogar/Vivhogar"); else echo '#';?>">
			<img src="<?php echo base_url("images/menu_vivienda_") .$menu_viv; ?>.png" alt="Vivienda y Hogar"></a>
		<p style="width: 250px">Aquí podrá especificar las características de vivienda y las particularidades económicas, sociales y demográficas de su hogar.</p>
		<div class="progress" style="width: 250px">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?echo $avanc_vivh; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?echo $avanc_vivh; ?>%">
				<span class="sr-only"><?echo $avanc_vivh; ?>%</span>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td align="center" colspan='2'>
		<a href="<?php if ($avanc_vivh=='100') echo base_url("modinggasper/Personas"); else echo '#';?>">
			<img src="<?php echo base_url("images/menu_igpersonales_") . $menu_igp; ?>.png" alt="Ingresos y Gastos personales"></a>
		<p style="width: 250px">Aquí podrá diligenciar información general sobre su hogar y cada uno de los integrantes, así como sobre sus ingresos y gastos.</p>
		<div class="progress" style="width: 250px">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?echo $avanc_igpe; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?echo $avanc_igpe; ?>%">
				<span class="sr-only"><?echo $avanc_igpe; ?>%</span>
			</div>
		</div>
		</td>
	</tr>
</table>
-->