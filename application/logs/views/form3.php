<?php
 /**
     * Vista para diligenciar sección 3 - Articulos Comprados
     * @author hhchavezv	
     * @since 2016jun30
 **/
?>
 <script type="text/javascript" src="<?php echo $js_dir; ?>"></script>
<div class="row">
	<div class="col-sm-2"><img title="Icono de Gastos" src="<?php //echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
	<div class="col-sm-10">
		<h2><?php echo $titulo_1; ?></h2>
		</div>
</div>
<div class="row">
	<div class="col-sm-2">&nbsp;</div>
	<div class="col-sm-10">
		<h4><?=$subtitulo_2;// . "(" . $secc[0]['TEMPORALIDAD'] . ")"; ?></h4>
		<h5><?php echo $subtitulo_3; ?></h5>
		</div>
</div>

<form id="form_sec3" name="form_sec3" class="form-horizontal" role="form">

		<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?php echo $id_formulario;?>" />
		<input type="hidden" name="hdd_sec" id="hdd_sec" value="<? echo $secc[0]['ID_SECCION3']?>" />
		

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
	<input type="hidden" id="hdd_nro_articulos" name="hdd_nro_articulos" value="<?php echo count($arrArticulos);?>" />
	<table class="table table-hover table-bordered">
    <thead>
        <tr class="warning">
            <th style="text-align:center;" rowspan="2" width="28%">Nombre del artículo o servicio COMPRADO o PAGADO</th>
            <th style="text-align:center;" colspan="2" width="32%">¿Cuánto fue el valor TOTAL pagado por el artículo o servicio?</th>
            <th style="text-align:center;" rowspan="2" width="20%" >¿En qué LUGAR compró o pagó el artículo o servicio?</th>
            <th style="text-align:center;" rowspan="2" width="20%">¿Con qué FRECUENCIA compra o paga HABITUALMENTE el artículo o servicio?</th>
        </tr>
		<tr class="warning" align="center">
            <th style="text-align:center;">Valor Pagado</th>
            <th style="text-align:center;" width="12%">Compró o pagó el artículo o servicio pero no recuerda el valor</th>
            
        </tr>
    </thead>
    <tbody>
	
		<?php 
		$i=0;
		foreach ($arrArticulos as $articulo) 
		{
		?>
        <tr align="center">
            <td align="left"><?php echo $articulo["ETIQUETA"];?>
			<input type="hidden" id="hdd_articulo_<?php echo $i;?>" name="hdd_articulo_<?php echo $i;?>" value="<?php echo $articulo["ID_ARTICULO3"];?>" />
			</td>
            <td> <input class="form-control" onBlur="pag3_suma_articulos();" type="text" name="txt_valor_<?php echo $i;?>" id="txt_valor_<?php echo $i;?>"  />  </td>
            <td> <input name="chk_no_recuerda_<?php echo $i;?>" id="chk_no_recuerda_<?php echo $i;?>" value=1 type="checkbox" onClick="pag3_deshabilita_pago(<?php echo $i;?>)"> </td>
            <td>
				<select name="sel_lugar_<?php echo $i;?>" id="sel_lugar_<?php echo $i;?>" class="form-control" <?php echo ($articulo["DEFINE_LUGAR_COMPRA"] !=1)?"disabled=disabled":"";?>  >
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
				<select name="sel_frec_<?php echo $i;?>" id="sel_frec_<?php echo $i;?>" class="form-control" <?php echo ($articulo["DEFINE_FRECU_COMPRA"] !=1)?"disabled=disabled":"";?> >
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
            <td><b>SUBTOTAL</b></td>
			<td> <input class="form-control" readonly="readonly" type="text" name="txt_total" id="txt_total" />  </td>
			<td colspan="3">&nbsp;</td>
		</tr>	
	
    </tbody>
	</table>
	</div>
	<?php if($habilita_medio_pago) { // se debe habilitar ?>
	<br>
	<div class="row" id="div_medio_pago" name="div_medio_pago">
		<div class="col-md-6">El medio de pago usado PRINCIPALMENTE para comprar los art&iacute;culos y servicios enunciados en este m&oacute;dulo fue:</div>
		<div class="col-md-2">
			<!-- <select name="<?php echo $medio_pago["nom_var"];?>" id="<?php echo $medio_pago["nom_var"];?>" class="form-control" >-->
			<select name="sel_medio_pago" id="sel_medio_pago" class="form-control" >
					<option value="-">...</option>
					<?php 
					foreach ($arrMediosPago as $medio)
					{
					echo "<option value='".$medio["id"]."'>".$medio["nombre"]."</option>";
					}
					?>
			</select>		
		</div>
		<div class="col-md-4">		
			<div class="row" id="div_otro_pago" name="div_otro_pago"> 		
				<div class="col-md-3">C&uacute;al:</div>
				<div class="col-md-9">
					<!-- <input type="text" name="<?php echo $medio_pago["nom_otro"];?>" id="<?php echo $medio_pago["nom_otro"];?>" class="form-control" >-->
					<input type="text" name="txt_otro_medio_pago" id="txt_otro_medio_pago" class="form-control" maxlength="98" >				
				</div>
			</div>
		</div>
		
	</div>
	<?php }?>
	<br>
	<div class="row">		
		<div class="col-md-11" align="right">
		<div id="pag3_cargando" class="msj_guarda" style="display:none; color: green;">Guardando ... <img src="<?php echo base_url("images/ajax-loader.gif")?>" title="Guardando" /></div>
		<div id="pag3_error" class="msj_error" style="display:none; color: red;" >Error: Secci&oacute;n no guardada.</div>
		</div>
		<div class="col-md-1"> <button id="btn_form3" name="btn_form3" type="button" class="btn btn-success btn-md pull-right">Siguiente</button> </div>
	</div>
</form>