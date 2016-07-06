<?php ?>

<div class="page-header">
	<h1>Gastos en el &uacute;ltimo a&ntilde;o</h1>
    <p class="lead">Alquiler, Combustibles, Mantenimiento y Servicios de la vivienda.</p>
</div>


<form id="frmCompraVivienda" name="frmCompraVivienda" method="post" action="">

<div class="row">
	<div class="col-md-12">
		<label>De P10304 del 2015 a P10304S1 del 2016, &iquest; usted o alg&uacute;n miembro del hogar realiz&oacute; la compra de vivienda nueva o usada diferente a la que habitan?</label>
	</div>
	<div class="col-md-12">
		<div class="radio">
        	<label><input type="radio" id="" name="" value=""/>S&iacute;. Adquirieron una vivienda nueva</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>S&iacute;. Adquirieron una vivienda usada</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>No adquirieron vivienda</label>
        </div>        
	</div>	
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;l fue el valor de la vivienda ?<input type="text" id="" name="" value="$" class="form-control"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
		</div>
	</div>	
</div>


<br/>

<div class="row">
	<div class="col-md-12">
		<label>El pago por adquisici&oacute;n de la vivienda, fue: (Seleccione la(s) opciones que desee)</label>
	</div>
	<div class="col-md-12">
		<div class="radio">
			<label><input type="radio" id="" name="" value=""/>De contado</label>
		</div>
		<div class="radio">
			<label><input type="radio" id="" name="" value=""/>A Cr&eacute;dito</label>
		</div>
	</div>
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;nto pag&oacute; por la vivienda ?<input type="text" id="" name="" value="$" class="form-control"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
		</div>
	</div>
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;nto pag&oacute; de cuota inicial ?<input type="text" id="" name="" value="$" class="form-control"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
		</div>
	</div>
</div>

<br/>

<div class="row">
	<div class="col-md-12">
		<label>&iquest; La cuota a cr&eacute;dito  o de amortizaci&oacute;n que est&aacute; pagando es subsidiada ?</label>
	</div>
	<div class="col-md-12">
		<div class="radio">
        	<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>No</label>
        </div>
    </div>    
</div>

<br/>

<div class="row">
	<div class="col-md-12">
		<label>&iquest; Cu&aacute;les de las siguientes fuentes utilizaron para la compra de esa vivienda ? (Seleccione la(s) opci&oacute;n que desee)</label>
	</div>
	<div class="col-md-12">
		<div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Recursos propios (Ahorros, cesant&iacute;as, fiducias, ingresos por venta de otros bienes)</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Pr&eacute;stamo hipotecario</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Pr&eacute;stamo bancario de libre inversi&oacute;n</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Subsidios</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Fondos (Fondo Nacional del Ahorro, fondo de empleados) o cooperativas</label> 
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Otra</label> 
        </div>
    </div>
    <div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; A cu&aacute;ntos a&ntilde;os ?
				<select id="" name="" class="form-control">
				<?php for ($i=1; $i<=30; $i++){ ?>
					<option value="<?php echo $i; ?>"><?php echo ($i==1)?"$i a&ntilde;o":"$i a&ntilde;os"; ?></option>	 
				<?php } ?>
				</select>
			</label>
		</div>		
	</div>
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; A cu&aacute;ntos a&ntilde;os ?
				<select id="" name="" class="form-control">
				<?php for ($i=1; $i<=30; $i++){ ?>
					<option value="<?php echo $i; ?>"><?php echo ($i==1)?"$i a&ntilde;o":"$i a&ntilde;os"; ?></option>	 
				<?php } ?>
				</select>
			</label>
		</div>		
	</div>
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;l ?<input type="text" id="" name="" value="$" class="form-control"/></label>
		</div>		
	</div>
</div>


	
</form>


