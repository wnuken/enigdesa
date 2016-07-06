<?php
 /**
     * Vista para diligenciar sección 3 - Articulos Comprados
     * @author hhchavezv	
     * @since 2016jun30
 **/
?>
<div class="row">
	<div class="col-sm-2"><img title="Icono de Gastos" src="<?php //echo base_url("images/form_icon-gastos.png"); ?>" /></div>
	<div class="col-sm-8">
		<h2><?=$secc[0]['DESCR_SECCION'] . "(" . $secc[0]['TEMPORALIDAD'] . ")"; ?></h2>
		</div>
</div>
<div class="row">
	<div class="col-sm-2">&nbsp;</div>
	<div class="col-sm-8">
		<h4><?php echo $subtitulo; ?></h4>
		</div>
</div>

<form id="form_sec3" name="form_sec3?>" class="form-horizontal" role="form">
		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
		<input type="hidden" name="_INI_<?echo "prueba"//$secc['ID_SECCION'] .'_'. $secc['PAGINA']?>" id="_INI_<?="prueba"//echo $secc['ID_SECCION'] .'_'. $secc['PAGINA']?>"/>
		<input type="hidden" id="P6040" value="<?="prueba"//echo $persona['P6040']; ?>" />

	<?php /* ** Tabla con div		
	<div class="row">
    <div class="col-md-5">Nombre del artículo o servicio COMPRADO o PAGADO</div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">¿Cuánto fue el valor TOTAL pagado por el artículo o servicio?</div>
        </div>
        <div class="row">
            <div class="col-md-8">Valor Pagado</div>
			<div class="col-md-4">Compró o pagó el artículo o servicio pero no recuerda el valor</div>
        </div>
    </div>
    

	</div>
	*/?>
		
	<div class="table-responsive">
	<table class="table table-hover table-bordered">
    <thead >
        <tr class="warning"  align="center">
            <th rowspan="2" width="28%">Nombre del artículo o servicio COMPRADO o PAGADO</th>
            <th colspan="2" width="32%">¿Cuánto fue el valor TOTAL pagado por el artículo o servicio?</th>
            <th rowspan="2" width="20%" >¿En qué LUGAR compró o pagó el artículo o servicio?</th>
            <th rowspan="2" width="20%">¿Con qué FRECUENCIA compra o paga HABITUALMENTE el artículo o servicio?</th>
        </tr>
		<tr class="warning" align="center">
            <th>Valor Pagado</th>
            <th width="12%">Compró o pagó el artículo o servicio pero no recuerda el valor</th>
            
        </tr>
    </thead>
    <tbody>
		<?php 
		$i=0;
		foreach ($arrArticulos as $articulo) 
		{
		?>
        <tr align="center">
            <td><?php echo $articulo["ETIQUETA"];?>
			<input type="hidden" id="hdd_articulo_<?php echo $i;?>" name="hdd_articulo_<?php echo $i;?>" value="<?php echo $articulo["ID_ARTICULO3"];?>" />
			</td>
            <td> <input class="form-control" type="text" name="txt_valor_<?php echo $i;?>" id="txt_valor_<?php echo $i;?>" />  </td>
            <td> <input name="chk_no_recuerda_<?php echo $i;?>" id="chk_no_recuerda_<?php echo $i;?>" type="checkbox"> </td>
            <td>
				<select name="sel_lugar_<?php echo $i;?>" id="sel_lugar_<?php echo $i;?>" class="form-control" >
				<option value="-">...</option>
				<?php 
				foreach ($arrLugarCompra as $lugar)
				{
				echo "<option value='".$lugar["VALOR_PARAM"]."'>".$lugar["DESC_PARAM"]."</option>";
				}
				?>
				</select>
			</td>
			 <td>
				<select name="sel_frec_<?php echo $i;?>" id="sel_frec_<?php echo $i;?>" class="form-control" >
				<option value="-">...</option>
				<?php 
				foreach ($arrFrecCompra as $frec)
				{
				echo "<option value='".$frec["VALOR_PARAM"]."'>".$frec["DESC_PARAM"]."</option>";
				}
				?>
				</select>
			</td>
		</tr>
		<?php 
		$i++;
		}?>
		 <tr align="center" class="active">
            <td>SUBTOTAL</td>
			<td> <input class="form-control" type="text" name="txt_total" id="txt_total" />  </td>
			<td colspan="3">&nbsp;</td>
		</tr>	
	
    </tbody>
	</table>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">El medio de pago usado PRINCIPALMENTE para comprar los art&iacute;culos y servicios enunciados en este m&oacute;dulo fue:</div>
		<div class="col-md-2">
			<select name="<?php echo $medio_pago["nom_var"];?>" id="<?php echo $medio_pago["nom_var"];?>" class="form-control" >
					<option value="-">...</option>
					<?php 
					foreach ($arrMediosPago as $medio)
					{
					echo "<option value='".$medio["id"]."'>".$medio["nombre"]."</option>";
					}
					?>
			</select>		
		</div>
		<div class="col-md-1">C&uacute;al:</div>
		<div class="col-md-3">
			<input type="text" name="<?php echo $medio_pago["nom_otro"];?>" id="<?php echo $medio_pago["nom_otro"];?>" class="form-control" >				
		</div>
		
	</div>
	<br>
	<div class="row">
		<div class="col-md-12"> <button type="button" class="btn btn-success btn-sm pull-right">Siguiente</button> </div>
	</div>
</form>			

<?php //print_r($arrLugarCompra); exit; ?>