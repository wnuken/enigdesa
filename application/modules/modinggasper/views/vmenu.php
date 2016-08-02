<h2>PERSONA(S) DEL HOGAR</h2>
<hr/>
<div class="row text-center">
<div class="col-sm-4"></div>
<div class="col-sm-2"><img src="<?php echo base_url("images/icoPerTabla_03.png"); ?>" width="52" height="42" alt=""/></div>
<div class="col-sm-2"><img src="<?php echo base_url("images/icoPerTabla_05.png"); ?>" width="52" height="42" alt=""/></div>
<div class="col-sm-4"><img src="<?php echo base_url("images/icoPerTabla_07.png"); ?>" width="52" height="42" alt=""/></div>
</div>
<br/>
<?php
foreach ($personas as $k=>$v) {
	echo "<div class='row bgTable'>\n";
	echo " <div class='col-sm-4'><h4>". $v['P521A'] ." ". $v['P521B'] ." ". $v['P521C'] ." ". $v['P521D'] ." (". $v['P6040'] .")</h4></div>\n";
	echo " <div class='col-sm-2 text-center'>\n";
	if ($v['FIN_CARAC'] == 'SI')
		$car = 'disabled';
	else
		$car = '';
	echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modinggasper/Personas/generales") ."/$k".
			"\");' class='btn btn-warning' $car>Caracteristicas Generales</button>\n";
	echo " </div>\n";
	echo " <div class='col-sm-2 text-center'>\n";
	if ($v['P6040'] >= 10) {
		if ($v['FIN_CARAC'] == 'NO' || $v['FIN_INGRE'] == 'SI')
			$ing = 'disabled';
		else
			$ing = '';
		echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modinggasper/Personas/ingresos") ."/$k". 
				"\");' class='btn btn-warning' $ing>Ingresos</button>\n";
	}
	echo " </div>\n";
	echo " <div class='col-sm-4 text-center'>\n";
	// 2016-06-22 - mayandarl - Persona responsable de los gastos del hogar...
	if ($v['P6040'] >= 10) {
		if ($v['P10250S1C2'] == "1") {
			echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modgastoshogar/Gastoshog/index") ."/$k". 
					"\");' class='btn btn-warning'>Gastos diarios hogar</button>&nbsp;&nbsp;\n";
			echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modgasmenfrehogar/index") ."/$k". 
					"\");' class='btn btn-warning'>Gastos menos frecuentes</button>\n";
		}
		else {
			echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modgastospersonales/Gastosper/index") ."/$k". 
					"\");' class='btn btn-warning'>Gastos personales</button>\n";
		}
	}
	echo " </div>\n";
	echo "</div>\n";
}

?>
