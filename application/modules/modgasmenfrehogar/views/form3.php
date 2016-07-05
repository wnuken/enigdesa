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

<form id="form_" name="form_<?echo $secc[0]['ID_SECCION3'] /*.'_'. $secc['PAGINA']*/?>" class="form-horizontal" role="form">
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
            <th rowspan="2">Nombre del artículo o servicio COMPRADO o PAGADO</th>
            <th colspan="2">¿Cuánto fue el valor TOTAL pagado por el artículo o servicio?</th>
            <th rowspan="2">¿En qué LUGAR compró o pagó el artículo o servicio?</th>
            <th rowspan="2">¿Con qué FRECUENCIA compra o paga HABITUALMENTE el artículo o servicio?</th>
        </tr>
		<tr class="warning" align="center">
            <th>Valor Pagado</th>
            <th width="12%">Compró o pagó el artículo o servicio pero no recuerda el valor</th>
            
        </tr>
    </thead>
    <tbody>
        <tr align="center">
            <td>1</td>
            <td> <input class="form-control" type="text" name="txt_valor1" id="txt_valor1" value="" />  </td>
            <td> <input name="chk_no_recuerda1" id="chk_no_recuerda1" type="checkbox"> </td>
            <td>
				<select name="sel_lugar1" id="sel_lugar1" >
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
				<select name="sel_lugar1" id="sel_lugar1" >
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
    
    </tbody>
	</table>
	</div>
	
	
</form>			

<?php //print_r($arrLugarCompra); exit; ?>