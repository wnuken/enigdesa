<hr />
	<div class="row secondHead themeHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" alt="Imagen secciÃ³n hogar"></div>
    <!--<div class="col-sm-4 col-md-3 col-lg-2 col-xs-12">
        
    </div>-->
    <!--<div class="col-sm-5 ">-->
    <h2><?= $secc[0]['TITULO1'] ?></h2>
    <h4><?= $secc[0]['TITULO2'] ?></h4>
    <h5><?= $secc[0]['TITULO3'] ?></h5>
    <!--</div>-->
</div>
	<br />
<?php
	if (!empty($secc[0]['ENCABEZADO'])):
?>
	<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>
<?php 
	endif;
?>

	<form id="form_5" name="form_5" class="form-horizontal" role="form">
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
		<div class='form-group has-feedback' id='div'>
			<h5 class='control-label articulo'</h5>

			<div class='col-sm-10' id='mmm' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>

				<table>
					<tr>
						<td>
							<h5 class='control-label' for=''>P10395</h5>
						</td>
					</tr>
					<tr>
						
						<td colspan='2'>
							<h5 class='control-label' for=''>¿De P10303 del 2015 a P10303S1 del 2016 usted o alg&uacute;n miembro del hogar realiz&oacute; viajes a destinos nacionales e internacionales?</h5>
						</td>
					</tr>
					<tr>
						<td>
							<input type='checkbox' name='P10396S1' value='P10395S1' id='art_P10395S1' class='ops_1'/>
							<label for="art_P10395S1" id="art_P10395S1"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='P10395S1'>Nacional</h5>
						</td>
					</tr>
				    <tr id="mostrar_P10395S1" style="display: none">
						<td>
						</td>	
						<td>
							<h5 class='control-label' for='P10395S1A1'>P10395S1A1 Cu&aacute;ntos viajes</h5>
							<br>
							<input type="text" name="P10395S1A1" id="P10395S1A1" class="form-control"  maxlength="25" >	
						</td>
					</tr>
						
					<tr>
					<tr>
						<td>
							<input type='checkbox' name='P10395S2' value='P10395S2' id='art_P10395S2' class='ops_2'/>
							<label for="art_P10395S2" id="art_P10395S2"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='P10395S2'>Internacional</h5>
						</td>
					</tr>
				    <tr id="mostrar_P10395S2" style="display: none">
						<td>
						</td>	
						<td>
							<h5 class='control-label' for='P10395S2A1'>P10395S2A1 Cu&aacute;ntos viajes</h5>
							<br>
							<input type="text" name="P10395S2A1" id="P10395S2A1" class="form-control"  maxlength="25" >	
						</td>
					</tr>
						
					<tr>
						<td>
							<input type='checkbox' name='99999999' value='99999999' id='art_99999999' class='ops_3'/>
							<label for="art_P10395S2" id="art_P10395S2"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='99999999'>No viaj&oacute;</h5>
						</td>
						
					</tr>
					<tr>
						<td colspan='2'>
						<hr>
						</td>
					</tr>
					<tr>
						<td>
						
							<h5 class='control-label' for=''>P10396</h5>
						</td>
					</tr>
					</tr>	
						<td colspan='2'>
							<h5 class='control-label' for=''>¿Para realizar el &uacute;timo viaje adquiri&oacute; paquete tur&iacute;stico completo? (Incluye tiquetes, alojamiento, alimentaci&oacute;n y otros) </h5>
						</td>
					</tr>
					<tr>
						<td>
							<input type='checkbox' name='si_P10396' value='si_P10396' id='si_P10396' class='ops_1'/>
						</td>
						<td>
							<h5 class='control-label' for='Si_P10396'>Si</h5>
						</td>
					</tr>
					<tr id="mostrar_P10396" style="display: none">
						<td>
						</td>	
						<td>
							<h5 class='control-label' for='P10396S1'>P10396S1 Cu&aacute;ntos paquetes?</h5>
							<br>
							<input type="text" name="P10396S1" id="P10396S1" class="form-control"  maxlength="25" >
							<br>
							<h5 class='control-label' for='P10395S2A1'>99 No sabe no informa</h5>
							<br>
							<input type="text" name="99" id="99" class="form-control"  maxlength="25" >	
						</td>
					</tr>			
					<tr>
						<td>
							<input type='checkbox' name='no_P10396' value='no_Si_P10396' id='no_Si_P10396' class='ops_2'/>
						</td>	
						<td>
							<h5 class='control-label' for=''>No</h5>
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
	
		<script src="<?= $js_dir ?>"></script>
	