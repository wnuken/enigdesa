<script src="<?php echo base_url("/js/gasmenfrehogar/compravivienda/compravivienda.js"); ?>"></script>
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
        	<label><input type="radio" id="p10305s1" name="p10305" value=""/>S&iacute;. Adquirieron una vivienda nueva</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="p10305s2" name="p10305" value=""/>S&iacute;. Adquirieron una vivienda usada</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="p10305n" name="p10305" value=""/>No adquirieron vivienda</label>
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
			<label>&iquest; Cu&aacute;nto pag&oacute; por la vivienda ?<input type="text" id="" name="" value="" placeholder="$" class="form-control"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
		</div>
	</div>
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;nto pag&oacute; de cuota inicial ?<input type="text" id="" name="" value="" placeholder="$" class="form-control"/></label>
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
			<label>&iquest; Cu&aacute;l ?<input type="text" id="" name="" value="" placeholder="Especifique" class="form-control" size="70"/></label>
		</div>		
	</div>
</div>

<br/>

<div class="row">
	<div class="col-md-12">
		<label>&iquest; De cu&aacute;l entidad recibi&oacute; el subsidio ?</label>
	</div>
	<div class="col-md-12 form-inline">
		<div class="row">
			<div class="col-md-4 radio">
        		<label>&iquest; Del Gobierno?</label>
        	</div>	
        	<div class="col-md-1 radio">
        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
        	</div>
        	<div class="col-md-1 radio">
        		<label><input type="radio" id="" name="" value=""/>No</label>
        	</div>
		</div>    
	</div>
	<div class="col-md-12 form-inline">
		<div class="row">
			<div class="col-md-4 radio">
        		<label>&iquest; De otra instituci&oacute;n (ONGS, Fundaci&oacute;n o Empresa privada)?</label>
        	</div>	
        	<div class="col-md-1 radio">
        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
        	</div>
        	<div class="col-md-1 radio">
        		<label><input type="radio" id="" name="" value=""/>No</label>
        	</div>
		</div>    
	</div>
	<div class="col-md-12 jumbotron" style="padding: 15px;">
		<div class="col-md-12 form-inline">		
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Lo recibi&oacute; en dinero?</label>
	        	</div>        	
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>No</label>
	        	</div>
			</div>
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Lo recibi&oacute; en especie?</label>
	        	</div>        	
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>No</label>
	        	</div>
			</div>			
		</div>
		<div class="col-md-12" style="padding: 0px;">		
			<div class="radio form-group">
				<label>&iquest; Cu&aacute;nto recibi&oacute; ?<input type="text" id="" name="" value="" placeholder="$" class="form-control"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
			</div>
		</div>
		<div class="col-md-12" style="padding: 0px;">		
			<div class="radio form-group">
				<label>&iquest; Si tuviera que pagar por lo que recibi&oacute;, &iquest; en cu&aacute;nto estima lo recibido ?<input type="text" id="" name="" value="" placeholder="$" class="form-control" style="width:50%;"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
			</div>
		</div>
	</div>
	<div class="col-md-12 jumbotron" style="padding: 15px;">
		<div class="col-md-12 form-inline">		
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Lo recibi&oacute; en dinero?</label>
	        	</div>        	
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>No</label>
	        	</div>
			</div>
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Lo recibi&oacute; en especie?</label>
	        	</div>        	
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>No</label>
	        	</div>
			</div>			
		</div>
		<div class="col-md-12" style="padding: 0px;">		
			<div class="radio form-group">
				<label>&iquest; Cu&aacute;nto recibi&oacute; ?<input type="text" id="" name="" value="" placeholder="$" class="form-control"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
			</div>
		</div>
		<div class="col-md-12" style="padding: 0px;">		
			<div class="radio form-group">
				<label>&iquest; Si tuviera que pagar por lo que recibi&oacute;, &iquest; en cu&aacute;nto estima lo recibido ?<input type="text" id="" name="" value="" placeholder="$" class="form-control" style="width:50%;"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
			</div>
		</div>
	</div>
</div>

<br/>

<div class="row">
	<div class="col-md-12">
		<label>De P10311 del 2015 a  P10311S1 del 2016, &iquest;usted o alg&uacute;n miembro del hogar realiz&oacute; alguna adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n de la vivienda?</label>
	</div>
	<div class="col-md-12">
		<div class="radio">
        	<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>No</label>
        </div>        
	</div>	
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest;Cu&aacute;nto fue el valor de esta adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n?<input type="text" id="" name="" value="$" class="form-control" style="width: 50%;"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
		</div>
	</div>	
</div>

<br/>

<div class="row">
	<div class="col-md-12">
		<label>De las siguiente fuentes indique cu&aacute;les utilizaron para la adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n de la vivienda?</label>
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
        	<label><input type="radio" id="" name="" value=""/>Fondos (Fondo Nacional del Ahorro, fondo de empleados) o cooperativas </label>
        </div>
        <div class="radio">
        	<label><input type="radio" id="" name="" value=""/>Otra</label>
        </div>
	</div>	
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest;Cu&aacute;nto fue el valor de esta adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n?<input type="text" id="" name="" value="$" class="form-control" style="width: 50%;"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
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
	<div class="col-md-12 jumbotron" style="padding: 15px;">
		<div class="col-md-12 form-inline">		
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Lo recibi&oacute; en dinero?</label>
	        	</div>        	
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>No</label>
	        	</div>
			</div>
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Lo recibi&oacute; en especie?</label>
	        	</div>        	
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<label><input type="radio" id="" name="" value=""/>No</label>
	        	</div>
			</div>			
		</div>
		<div class="col-md-12" style="padding: 0px;">		
			<div class="radio form-group">
				<label>&iquest; Cu&aacute;nto recibi&oacute; ?<input type="text" id="" name="" value="" placeholder="$" class="form-control"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
			</div>
		</div>
		<div class="col-md-12" style="padding: 0px;">		
			<div class="radio form-group">
				<label>&iquest; Si tuviera que pagar por lo que recibi&oacute;, &iquest; en cu&aacute;nto estima lo recibido ?<input type="text" id="" name="" value="" placeholder="$" class="form-control" style="width:50%;"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<label><input type="radio" id="" name="" value=""/>No sabe o no informa</label>
			</div>
		</div>
	</div>
	<div class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;l ?<input type="text" id="" name="" value="" placeholder="Especifique" class="form-control" size="70"/></label>
		</div>		
	</div>	
</div>

</br>

<div class="row">
	<div class="col-md-12" style="text-align: right;">
		<button type="button" id="" name="" class="btn btn-success">Anterior</button>
		&nbsp;&nbsp;&nbsp;
        <button type="button" id="" name="" class="btn btn-success">Siguiente</button>
	</div>
</div>

	
</form>


