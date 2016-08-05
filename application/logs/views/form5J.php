<hr />
	<div class="row">
		<div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png")?>" /></div>
		<div class="col-sm-8">
			<h2><?=$secc[0]['DESCR_SECCION'] . "(" . $secc[0]['TEMPORALIDAD'] . ")"?></h2>
			<h4><?//echo $persona['P521A'] ." ". $persona['P521C'] ." (". $persona['P6040'] .")"; ?></h4>
		</div>
	</div>
	<br />
<?php
	if (!empty($secc[0]['ENCABEZADO'])):
?>
	<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>
<?php 
	endif;
?>

	<form id="form_2" name="form_2" class="form-horizontal" role="form">
		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
		<div>
			<div>
				<br />
<?php
	//$i = 1;
	//foreach ( $preg['var'] as $v3 ):
?>
			</div>
		</div>			
		<div class='form-group has-feedback' id='div-<?=$v3['ID_ARTICULO3']?>'>
			<h5 class='control-label articulo' for='<?=$v3['ID_ARTICULO3']?>'>(<?=$v3['ID_ARTICULO3'] .") " . $v3['ETIQUETA']?></h5>

			<div class='col-sm-8' id='RESP_<?=$v3['ID_ARTICULO3']?>' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>

				<table>
					<tr>
						<td>
							<h5 class='control-label' for=''>P10395</h5>
						</td>
						<td>
							<h5 class='control-label' for=''>¿De P10303 del 2015 a P10303S1 del 2016 usted o alg&uacute;n miembro del hogar realizó viajes a destinos nacionales e internacionales?</h5>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='P10395S1'>Nacional</h5>
						</td>
						<td>
							<input type='checkbox' name='P10396S1[Nacional]' value='P10395S1' id='art_P10395S1' class='ops_1'/>
						</td>		
					</tr>			
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='P10395S2'>Internacional</h5>
						</td>
						<td>
							<input type='checkbox' name='P10395S2[Nacional]' value='P10395S2' id='art_P10395S2' class='ops_2'/>
						</td>		
					</tr>	
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='99999999'>No viaj&oacute;</h5>
						</td>
						<td>
							<input type='checkbox' name='99999999' value='99999999' id='art_99999999' class='ops_3'/>
						</td>
					</tr>
					
					
					<tr>
						<td>
							<h5 class='control-label' for=''>P10396</h5>
						</td>
						<td>
							<h5 class='control-label' for=''>¿Para realizar el &uacute;timo viaje adquiri&oacute; paquete tur&iacute;stico completo? (Incluye tiquetes, alojamiento, alimentaci&oacute;n y otros) </h5>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for=''>Si</h5>
						</td>
						<td>
							<input type='checkbox' name='Si' value='Si' id='Si' class='ops_1'/>
						</td>		
					</tr>			
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for=''>No</h5>
						</td>
						<td>
							<input type='checkbox' name='No' value='No' id='No' class='ops_2'/>
						</td>		
					</tr>	
					
					
				<tr>
						<td>
							<h5 class='control-label' for=''></h5>
						</td>
						<td>
							<h5 class='control-label' for=''>¿Cuáles alojamientos empleó para pernoctar durante el último viaje?</h5>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='P10397S1'>Hotel, hostal, centro vacacional</h5>
						</td>
						<td>
							<input type='checkbox' name='P10397S1[]' value='P10397S1' id='art_P10397S1' class='ops_1'/>
						</td>		
					</tr>			
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='P10397S3'>Campamento o camping</h5>
						</td>
						<td>
							<input type='checkbox' name='P10397S3[]' value='P10397S3' id='art_P10397S3' class='ops_2'/>
						</td>		
					</tr>	
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='P10397S4'>Alojamiento rural</h5>
						</td>
						<td>
							<input type='checkbox' name='P10397S4[]' value='P10397S4' id='art_P10397S4' class='ops_3'/>
						</td>		
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='P10397S5'>Casa, apartamento, finca, en propiedad, de familiares o amigos</h5>
						</td>
						<td>
							<input type='checkbox' name='P10397S5[]' value='P10397S5' id='art_P10397S5' class='ops_3'/>
						</td>		
					</tr>	
					
					
					
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='<?=$v3['ID_ARTICULO3']?>'>Intercambio</h5>
						</td>
						<td>
							<input type='checkbox' name='<?=$v3['ID_ARTICULO3']?>[intercambio]' value='<?=$v3['ID_ARTICULO3']?>_4' id='articulo_<?=$v3['ID_ARTICULO3']?>_4' class='ops_<?=$i?>'/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='<?=$v3['ID_ARTICULO3']?>'>Producido por el hogar</h5>
						</td>
						<td>
							<input type='checkbox' name='<?=$v3['ID_ARTICULO3']?>[producido]' value='<?=$v3['ID_ARTICULO3']?>_5' id='articulo_<?=$v3['ID_ARTICULO3']?>_5' class='ops_<?=$i?>'/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='<?=$v3['ID_ARTICULO3']?>'>Tomado de un negocio propio</h5>
						</td>
						<td>
							<input type='checkbox' name='<?=$v3['ID_ARTICULO3']?>[negocio_propio]' value='<?=$v3['ID_ARTICULO3']?>_6' id='articulo_<?=$v3['ID_ARTICULO3']?>_6' class='ops_<?=$i?>'/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<h5 class='control-label' for='<?=$v3['ID_ARTICULO3']?>'>Otra forma</h5>
						</td>
						<td>
							<input type='checkbox' name='<?=$v3['ID_ARTICULO3']?>[otra]' value='<?=$v3['ID_ARTICULO3']?>_7' id='articulo_<?=$v3['ID_ARTICULO3']?>_7' class='ops_<?=$i?>' />
						</td>
					</tr>
				</table>
<hr>		
<?php 
	//$i++;
	//endforeach;
?>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-sm-12" id="mensaje_"></div>
	</div>
	<div class="row text-center">
		<button disabled  class='btn btn-success' id='env_form_2'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
	</div>