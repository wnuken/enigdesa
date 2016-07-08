<hr />
	<div class="row">
		<div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
		<div class="col-sm-8">
			<h2><?=$secc[0]['DESCR_SECCION'] . "(" . $secc[0]['TEMPORALIDAD'] . ")"; ?></h2>
			<h4><?//echo $persona['P521A'] ." ". $persona['P521C'] ." (". $persona['P6040'] .")"; ?></h4>
		</div>
	</div>
	<br />
<? 
	if (!empty($secc[0]['ENCABEZADO']))
		echo "			<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
?>
	<form id="form_1" name="form_1" class="form-horizontal" role="form">
		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
		<input type="hidden" name="_INI_<?echo "prueba"//$secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?="prueba"//echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
		<input type="hidden" id="P6040" value="<?="prueba"//echo $persona['P6040']; ?>" />
		<!--input type="hidden" id="controller" name="controller" value="<?=$this->router->fetch_class()?>" /-->
		<div>
			<div>
				<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;

	foreach ( $preg['var'] as $v3 ):
?>


			</div>
		</div>
		<div class='form-group has-feedback' id='div-<?=$v3['ID_ARTICULO3']?>'>
			<input type='checkbox' name='articulos[]' value='" . $v3['ID_ARTICULO3'] . "' id='<?=$v3['ID_ARTICULO3']?>' />
			<h5 class='control-label' for='<?=$v3['ID_ARTICULO3']?>'><?="(". $v3['ID_ARTICULO3'] .") " . $v3['ETIQUETA']?></h5>
			<div class='col-sm-8' id='RESP_<?=$v3['ID_ARTICULO3']?>' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
				<hr>

<?php
	endforeach;
?>
			</div>
		</div>
		<div class='form-group has-feedback' id='div-99999999'>
			<input type='checkbox' name='articulos[]' value='99999999' id='99999999' />			
			<h5 class='control-label' for='99999999'  >(99999999) Ninguna de las anteriores</h5>
			
			<div class='col-sm-8' id='RESP_99999999' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-sm-12" id="mensaje_<?//echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"></div>
		</div>
	<div class="row text-center">
<?php
	<button disabled=disabled class='btn btn-success' id='env_form_1'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
?>
	</div>