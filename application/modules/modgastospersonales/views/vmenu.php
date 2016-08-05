<h2>PERSONA(S) DEL HOGAR</h2>
<hr/>
<?php
foreach ($personas as $k=>$v) {
	echo "<div class='row'>\n";
	echo " <div class='col-sm-5'><h4>". $v['P521A'] ." ". $v['P521B'] ." ". $v['P521C'] ." ". $v['P521D'] ." (". $v['P6040'] .")</h4></div>\n";
	echo " <div class='col-sm-3 text-center'>\n";
	if ($v['FIN_CARAC'] == 'SI')
		$car = 'disabled';
	else
		$car = '';
	echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modinggasper/Personas/generales") ."/$k".
			"\");' class='btn btn-info' $car>Caracteristicas Generales</button>";
	echo " </div>\n";
	echo " <div class='col-sm-2 text-center'>\n";
	if ($v['P6040'] >= 10) {
		if ($v['FIN_CARAC'] == 'NO' || $v['FIN_INGRE'] == 'SI')
			$ing = 'disabled';
		else
			$ing = '';
		echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modinggasper/Personas/ingresos") ."/$k". 
				"\");' class='btn btn-info' $ing>Ingresos</button>";
	}
	echo " </div>\n";
	echo " <div class='col-sm-2 text-center'>\n";
	if ($v['P6040'] >= 10) {
		echo "  <button type='button' name='btnReminder' onClick='window.location.replace(\"". site_url("modinggasper/Personas/gastos") ."/$k". 
				"\");' class='btn btn-info' disabled>Gastos</button>";
	}
	echo " </div>\n";
	echo "</div>\n";
}

?>
