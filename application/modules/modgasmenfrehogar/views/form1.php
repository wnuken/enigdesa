<hr />
	<div class="row">
		<div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
		<div class="col-sm-8">
			<h2><?=$secc[0]['DESCR_SECCION'] . "(" . $secc[0]['TEMPORALIDAD'] . ")"; ?></h2>
			<h4><?//echo $persona['P521A'] ." ". $persona['P521C'] ." (". $persona['P6040'] .")"; ?></h4>
		</div>
	</div><?=site_url("modgasmenfrehogar/Recreacion/guardar/")?>
	<br />
<? 
	if (!empty($secc[0]['ENCABEZADO']))
		echo "			<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
?>
	<form id="form_1" name="form_1" class="form-horizontal" role="form">
		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
		<div>
			<div>
<?php 
	if(isset($secc[0]['ID_VARIABLE_USO']) ):
?>
		<div class='form-group has-feedback' id='div-variable_uso'>
			<h5 class='control-label' for='99999999'  >Ha usado</h5>
			<input type='radio' name='variable_uso' value='1' id='variable_uso_1'/><lable>Si</lable>
			<input type='radio' name='variable_uso' value='2' id='variable_uso_2'/><lable>No</lable>
		</div>
<?php 
	endif;
?>
				<br />
<?php
	foreach ( $preg['var'] as $v3 ):
?>


			</div>
		</div>
		<div class='form-group has-feedback cont_articulo' id='div-<?=$v3['ID_ARTICULO3']?>' <?=isset($secc[0]['ID_VARIABLE_USO'])?" style='display:none;'":""?> >
			<input type='checkbox' name='articulos[]' value='<?=$v3['ID_ARTICULO3']?>' id='<?=$v3['ID_ARTICULO3']?>' />
			<h5 class='control-label' for='<?=$v3['ID_ARTICULO3']?>'><?="(". $v3['ID_ARTICULO3'] .") " . $v3['ETIQUETA']?></h5>
			<div class='col-sm-8' id='RESP_<?=$v3['ID_ARTICULO3']?>' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
				<hr>

<?php
	endforeach;
?>
			</div>
		</div>
<?php 
	if(!isset($secc[0]['ID_VARIABLE_USO']) ):
?>
		<div class='form-group has-feedback' id='div-99999999'>
			<input type='checkbox' name='articulos[]' value='99999999' id='99999999' />			
			<h5 class='control-label' for='99999999'  >(99999999) Ninguna de las anteriores</h5>			
			<div class='col-sm-8' id='RESP_99999999' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
			</div>
		</div>
<?php 
	endif;
?>
<?php 
	if(isset($secc[0]['ID_VARIABLE_USO']) ):
?>
		<!--/div-->
<?php 
	endif;
?>
	</form>
	<div class="row">
		<div class="col-sm-12" id="mensaje_"></div>
	</div>
	<div class="row text-center">
		<button disabled=disabled class='btn btn-success' id='env_form_1'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
	</div>
<script src="<?=$js_dir?>"></script>