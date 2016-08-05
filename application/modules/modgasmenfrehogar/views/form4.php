<style type="text/css">
/***estilos radio botones y chekbox**************/

input[type=checkbox]:not(old), input[type=radio ]:not(old) {
	width : 2em;
	margin : 0;
	padding : 0;
	font-size : 1em;
	opacity : 0;
}
input[type=checkbox]:not(old) + label, input[type=radio ]:not(old) + label {
	display : inline-block;
	margin-left : -2em;
	line-height : 1.5em;
	font-weight: normal;
}
input[type=checkbox]:not(old) + label > span, input[type=radio ]:not(old) + label > span {
	display : inline-block;
	width : 1.5em;
	height : 1.5em;
	margin : 0.25em 0.25em 0.25em 0.25em;
	border : 0.0625em solid rgb(192,192,192);
	border-radius : 0.25em;
	background : rgb(224,224,224);
	background-image : -moz-linear-gradient(rgb(240,240,240), rgb(224,224,224));
	background-image : -ms-linear-gradient(rgb(240,240,240), rgb(224,224,224));
	background-image : -o-linear-gradient(rgb(240,240,240), rgb(224,224,224));
	background-image : -webkit-linear-gradient(rgb(240,240,240), rgb(224,224,224));
	background-image : linear-gradient(rgb(240,240,240), rgb(224,224,224));
	vertical-align : bottom;
	margin-right: 10px;
}
input[type=checkbox]:not(old):checked + label > span, input[type=radio ]:not(old):checked + label > span {
	background-image : -moz-linear-gradient(rgb(224,224,224), rgb(240,240,240));
	background-image : -ms-linear-gradient(rgb(224,224,224), rgb(240,240,240));
	background-image : -o-linear-gradient(rgb(224,224,224), rgb(240,240,240));
	background-image : -webkit-linear-gradient(rgb(224,224,224), rgb(240,240,240));
	background-image : linear-gradient(rgb(224,224,224), rgb(240,240,240));
	margin-right: 10px;
}
input[type=checkbox]:not(old):checked + label > span:before {
content: '✓';
display: block;
width: 1.4em;
color: rgba(85,85,85,1.00);
font-size: 1em;
line-height: 1em;
text-align: center;
text-shadow: 0 0 0.0714em rgb(85,85,85);
font-weight: bold;
padding: 2px;
}
input[type=radio]:not(old):checked + label > span > span {
	display : block;
	width : 1em;
	height : 1em;
	margin : 0.2em;
	border : 0.0625em solid rgb(85,85,85);
	border-radius : 0.25em;
	background : rgba(85,85,85,1.00);
	background-image : -moz-linear-gradient(rgb(85,85,85), rgb(136,136,136));
	background-image : -ms-linear-gradient(rgb(85,85,85), rgb(136,136,136));
	background-image : -o-linear-gradient(rgb(85,85,85), rgb(136,136,136));
	background-image : -webkit-linear-gradient(rgb(85,85,85), rgb(136,136,136));
	background-image : linear-gradient(rgb(85,85,85), rgb(136,136,136));
}
h2 {
    font-size: 24px;
}
</style>
<hr />
<div class="row secondHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/".$secc[0]['LOGO']); ?>" alt="Imagen sección hogar"></div>
    <h2><?= $secc[0]['TITULO1'] ?></h2>
    <h4><?= $secc[0]['TITULO2'] ?></h4>
    <h5><?= $secc[0]['TITULO3'] ?></h5>
</div>
<!--<div class="row">
    <div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
    <div class="col-sm-8">
        <h2><?= $secc[0]['TITULO1'] ?></h2>
        <h4><?= $secc[0]['TITULO2'] ?></h4>
        <h5><?= $secc[0]['TITULO3'] ?></h5>

    </div>
</div>-->
<?php
	if (!empty($secc[0]['ENCABEZADO']))
		echo "			<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
?>
			<form id="form_4" name="form_4" class="form-horizontal" role="form">
				<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
				<input type="hidden" name="VALOR_MAXIMO" id="VALOR_MAXIMO" value="<?= $secc[0]['VALOR_MAXIMO'] ?>" />
				<input type="hidden" name="VALOR_MINIMO" id="VALOR_MINIMO" value="<?= $secc[0]['VALOR_MINIMO'] ?>" />
				<input type="hidden" name="ID_SECCION3" id="ID_SECCION3" value="<?= $secc[0]['ID_SECCION3'] ?>" />
				<div>
					<div>
						<br />
<?php
	$nuevogrupo = "";
	$vargrupo = false;
	$i = 1;
?>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
	              <h3 class="panel-title" align="center">Si lo hubiera tenido que comprar, ¿cuánto habría pagado por el bien o servicio?</h3>
	            </div>
	            <div class="panel-body table-responsive">
					<table  class="table">
						<thead>
							<tr>
								<th rowspan='2'>
									Nombre del artículo o servicio ADQUIRIDO por otras formas diferentes a la compra
								</th><th></th>
								<th colspan='2'>adquirido como pago por TRABAJO?</th>
								<th colspan='2'>adquirido como REGALO o DONACIÓN?</th>
								<th colspan='2'>adquirido como INTERCAMBIO?</th>
								<th colspan='2'>PRODUCIDO por el HOGAR?</th>
								<th colspan='2'>tomado de un NEGOCIO PROPIO?</th>
								<th colspan='2'>adquirido de OTRA FORMA?</th>
								</tr>
								<tr>
							<th></th>
							<th>Valor estimado<a title="Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado." data-toggle="tooltip" href="#">(?)</a></th>
							<th>No sabe el valor estimado</th>
							<th>Valor estimado<a title="Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado." data-toggle="tooltip" href="#">(?)</a></th>
							<th>No sabe el valor estimado</th>
							<th>Valor estimado<a title="Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado." data-toggle="tooltip" href="#">(?)</a></th>
							<th>No sabe el valor estimado</th>
							<th>Valor estimado<a title="Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado." data-toggle="tooltip" href="#">(?)</a></th>
							<th>No sabe el valor estimado</th>
							<th>Valor estimado<a title="Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado." data-toggle="tooltip" href="#">(?)</a></th>
							<th>No sabe el valor estimado</th>
							<th>Valor estimado<a title="Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado." data-toggle="tooltip" href="#">(?)</a></th>
							<th>No sabe el valor estimado</th>
						</tr>
					</thead>
					<tbody>
		<?php
					$j = 1;
					foreach ( $preg['var'] as $v3 ):
		?>
						<tr>
							<td colspan='2'>(<?=$v3['ID_ARTICULO3']?>) <?=$v3['ETIQUETA']?>
							</td>

		<?php
						$i = 1;
						foreach ( $preg['variables'] as $v4 ):
							$input_atr = "class='form-control'";
							$forma_obt = array("recibido_pago", "regalo", "intercambio", "producido", "negocio_propio", "otra");

							if( ($i == 1 && $v3['RECIBIDO_PAGO'] != "1") || ($i == 2 && $v3['REGALO'] != "1") || ($i == 3 && $v3['INTERCAMBIO'] != "1") || 
								($i == 4 && $v3['PRODUCIDO'] != "1") || ($i == 5 && $v3['NEGOCIO_PROPIO'] != "1") || ($i == 6 && $v3['OTRA'] != "1")  ):
								$input_atr = "disabled";
								?>
							<td>
							<?php
							else:
							?>
							<td class='activo'>
							<?php
								$j++;
							endif;
		?>						<input <?=$input_atr?> type='text' name='val_<?=$v3['ID_ARTICULO3']?>[<?=$forma_obt[$i-1]?>]' value='' id='txt_<?=$v3['ID_ARTICULO3']?>_<?=$i?>' style="width:80px" autocomplete="off"/>
							</td>
							<?php
							$input_atr = str_replace("_input", "", $input_atr);
							?>
							<td>
								<input <?=$input_atr?> type='checkbox' name='chb_<?=$v3['ID_ARTICULO3']?>[<?=$forma_obt[$i-1]?>]' value='' id='chb_<?=$v3['ID_ARTICULO3'] ?>_<?=$i?>' style='display:inline-block' />
								<label id="lbl_chb_<?=$v3['ID_ARTICULO3'] ?>_<?=$i?>" for="chb_<?=$v3['ID_ARTICULO3'] ?>_<?=$i?>"><span><span></span></span></label>
							</td>
		<?php
							$i++;
							endforeach;
		?>
							

						</tr>
		<?php
					endforeach;
		?>
					</tbody>
				</table>
			</div>
		</div>
			
	<?php
		$i++;
?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12" id="mensaje_"></div>
</div>
<div class="row text-center">
	<button class='btn btn-success' id='env_form_4'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
</div>
</form>
<script src="<?= $js_dir ?>"></script>