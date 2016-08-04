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
<script src="<?php echo base_url("/js/modgasmenfrehogar/compravivienda/compravivienda.js"); ?>"></script>
<!--<div class="page-header">
	<h1>Gastos en el &uacute;ltimo a&ntilde;o</h1>
    <p class="lead">Alquiler, Combustibles, Mantenimiento y Servicios de la vivienda.</p>
</div>-->

<div class="row secondHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/ico_gmf_07.png"); ?>" alt="Imagen sección hogar"></div>
    <!--<div class="col-sm-4 col-md-3 col-lg-2 col-xs-12">
        
    </div>-->
    <!--<div class="col-sm-5 ">-->
    <h2>Gastos en el &uacute;ltimo a&ntilde;o</h2>
    <h4>Alquiler, Combustibles, Mantenimiento y Servicios de la vivienda.</h4>
    <h5>COMPRA Y ADECUACIÓN DE VIVIENDA</h5>
    <!--</div>-->
</div>


<form id="frmCompraVivienda" name="frmCompraVivienda" method="post" action="">
<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?php echo $id_formulario;?>" />

<div id="pregP10305" class="row">
	<div class="col-md-12" class="has-feedback">
		<label class="control-label">De P10304 del 2015 a P10304S1 del 2016, &iquest; usted o alg&uacute;n miembro del hogar realiz&oacute; la compra de vivienda nueva o usada diferente a la que habitan?</label>
	</div>
	<div id="ops_pregunta1" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="radio">
			<input type="radio" id="p10305_1" name="p10305" value="1">
        	<label for="p10305_1"><span><span></span></span>S&iacute;. Adquirieron una vivienda nueva</label>
        </div>
        <div class="radio">
        	<input type="radio" id="p10305_2" name="p10305" value="2"/>
        	<label for="p10305_2"><span><span></span></span>S&iacute;. Adquirieron una vivienda usada</label>
        </div>
        <div class="radio">
        	<input type="radio" id="p10305_3" name="p10305" value="3"/>
        	<label for="p10305_3"><span><span></span></span>No adquirieron vivienda</label>
        </div>
	</div>	
	<div id="divCV1" class="col-md-12 jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;l fue el valor de la vivienda ?<input type="text" id="p10305s1" name="p10305s1" value="" placeholder="$" class="form-control" /></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<input type="checkbox" id="radp10305s1" name="radp10305s1" value="99"/>
			<label for="radp10305s1"><span><span></span></span>No sabe o no informa</label>
		</div>
	</div>	
</div>

<br/>

<div id="pregP10306" class="row">
	<div class="col-md-12">
		<label>El pago por adquisici&oacute;n de la vivienda, fue: (Seleccione la(s) opciones que desee)</label>
	</div>
	<div id="ops_pregunta2" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="radio">
			<input type="checkbox" id="p10306s1" name="p10306s1" value="1"/>
			<label for="p10306s1"><span><span></span></span>De contado</label>
		</div>
		<div id="divCV2" class="jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
			<div class="radio form-group">
				<label>&iquest; Cu&aacute;nto pag&oacute; por la vivienda ?<input type="text" id="p10306s1a1" name="p10306s1a1" value="" placeholder="$" class="form-control"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 0px;">
				<input type="checkbox" id="radp10306s1a1" name="radp10306s1a1" value="99"/>
				<label for="radp10306s1a1"><span><span></span></span>No sabe o no informa</label>
			</div>
		</div>
		<div class="radio">
			<input type="checkbox" id="p10306s2" name="p10306s2" value="1"/>
			<label for="p10306s2"><span><span></span></span>A Cr&eacute;dito</label>
		</div>
		<div id="divCV3" class=" jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
			<div class="radio form-group">
				<label>&iquest; Cu&aacute;nto pag&oacute; por la vivienda ?<input type="text" id="p10306s2a1" name="p10306s2a1" value="" placeholder="$" class="form-control"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<input type="checkbox" id="radp10306s2a1" name="radp10306s2a1" value="99"/>
				<label for="radp10306s2a1"><span><span></span></span>No sabe o no informa</label>
			</div>
		</div>
	</div>
	
	<!--div id="divCV4" class="col-md-12 jumbotron" style="padding: 0px;">		
		<div class="radio form-group">
			<label>&iquest; Cu&aacute;nto pag&oacute; de cuota inicial ?<input type="text" id="p10306s2a1" name="p10306s2a1" value="" placeholder="$" class="form-control"/></label>
		</div>
		<div class="radio form-group" style="padding-left: 23px;">
			<label><input type="radio" id="radp10306s2a1_" name="radp10306s2a1_" value="99"/>No sabe o no informa</label>
		</div>
	</div-->
</div>

<br/>

<div id="pregP10307" class="row">
	<div class="col-md-12">
		<label>&iquest; La cuota a cr&eacute;dito  o de amortizaci&oacute;n que est&aacute; pagando es subsidiada ?</label>
	</div>
	<div id="ops_pregunta3" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="radio">
			<input type="radio" id="p10307_1" name="p10307" value="1"/>
        	<label for="p10307_1"><span><span></span></span>S&iacute;</label>
        </div>
        <div class="radio">
        	<input type="radio" id="p10307_2" name="p10307" value="2"/>
        	<label for="p10307_2"><span><span></span></span>No</label>
        </div>
    </div>    
</div>

<br/>

<div id="pregP10309" class="row">
	<div class="col-md-12">
		<label>&iquest; Cu&aacute;les de las siguientes fuentes utilizaron para la compra de esa vivienda ? (Seleccione la(s) opci&oacute;n que desee)</label>
	</div>
	<div id="ops_pregunta4" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="radio">
			<input type="checkbox" id="p10309s1" name="p10309s1" value="1"/>
        	<label for="p10309s1"><span><span></span></span>Recursos propios (Ahorros, cesant&iacute;as, fiducias, ingresos por venta de otros bienes)</label>
        </div>
        <div class="radio">
        	<input type="checkbox" id="p10309s2" name="p10309s2" value="1"/>
        	<label for="p10309s2"><span><span></span></span>Pr&eacute;stamo hipotecario</label>
        </div>
        <div id="divCV4" class="jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
			<div class="radio form-group">
				<label>&iquest; A cu&aacute;ntos a&ntilde;os ?
					<select id="p10309s2a1" name="p10309s2a1" class="form-control">
					<option value="-" selected="selected">Seleccione...</option>
					<?php for ($i=1; $i<=30; $i++){ ?>
						<option value="<?php echo $i; ?>"><?php echo ($i==1)?"$i a&ntilde;o":"$i a&ntilde;os"; ?></option>	 
					<?php } ?>
					</select>
				</label>
			</div>		
		</div>
        <div class="radio">
        	<input type="checkbox" id="p10309s3" name="p10309s3" value="1"/>
        	<label for="p10309s3"><span><span></span></span>Pr&eacute;stamo bancario de libre inversi&oacute;n</label>
        </div>
        <div id="divCV5" class="jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
			<div class="radio form-group">
				<label>&iquest; A cu&aacute;ntos a&ntilde;os ?
					<select id="p10309s3a1" name="p10309s3a1" class="form-control">
					<option value="-" selected="selected">Seleccione...</option>
					<?php for ($i=1; $i<=30; $i++){ ?>
						<option value="<?php echo $i; ?>"><?php echo ($i==1)?"$i a&ntilde;o":"$i a&ntilde;os"; ?></option>	 
					<?php } ?>
					</select>
				</label>
			</div>		
		</div>
        <div class="radio">
        	<input type="checkbox" id="p10309s4" name="p10309s4" value="1"/>
        	<label for="p10309s4"><span><span></span></span>Subsidios</label>
        </div>
        <div class="radio">
        	<input type="checkbox" id="p10309s5" name="p10309s5" value="1"/>
        	<label for="p10309s5"><span><span></span></span>Fondos (Fondo Nacional del Ahorro, fondo de empleados) o cooperativas</label> 
        </div>
        <div class="radio">
        	<input type="checkbox" id="p10309s6" name="p10309s6" value="1"/>
        	<label for="p10309s6"><span><span></span></span>Otra</label> 
        </div>
        <div id="divCV6" class="col-md-12 jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
			<div class="radio form-group">
				<label>&iquest; Cu&aacute;l ?<input type="text" id="p10309s5a1" name="p10309s5a1" value="" placeholder="Especifique" class="form-control" size="70"/></label>
			</div>		
		</div>
    </div>
    
	
	
</div>

<br/>

<div id="pregP5161" class="row">
	<div class="col-md-12">
		<label>&iquest; De cu&aacute;l entidad recibi&oacute; el subsidio ?</label>
	</div>
	<div id="ops_pregunta5" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="col-md-12 form-inline">
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; Del Gobierno?</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<input type="radio" id="p5161s1c14_1" name="p5161s1c14" value="1"/>
	        		<label for="p5161s1c14_1"><span><span></span></span>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<input type="radio" id="p5161s1c14_2" name="p5161s1c14" value="2"/>
	        		<label for="p5161s1c14_2"><span><span></span></span>No</label>
	        	</div>
	        		<div id="divCV7" class="col-md-12 form-inline" style="padding: 23px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
						<div class="row">
							<div class="col-md-4 radio">
				        		<label>&iquest; Lo recibi&oacute; en dinero?</label>
				        	</div>        	
				        	<div id="ops_pregunta511">
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s1a1c14_1" name="p5161s1a1c14" value="1"/>
					        		<label for="p5161s1a1c14_1"><span><span></span></span>S&iacute;</label>
					        	</div>
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s1a1c14_2" name="p5161s1a1c14" value="2"/>
					        		<label for="p5161s1a1c14_2"><span><span></span></span>No</label>
					        	</div>
					        </div>
				        		<div id="opcion71" class="col-md-12" style="padding: 46px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
									<div class="radio form-group">
										<label>&iquest; Cu&aacute;nto recibi&oacute; ?</label>
										<input type="text" id="p5161s1a3c14" name="p5161s1a3c14" value="" placeholder="$" class="form-control"/>
									</div>
									<div class="radio form-group" style="padding-left: 23px;">
										<input type="checkbox" id="radp5161s1a3c14" name="radp5161s1a3c14" value="99"/>
										<label for="radp5161s1a3c14"><span><span></span></span>No sabe o no informa</label>
									</div>
								</div>
				        	
						</div>
						<div class="row">
							<div class="col-md-4 radio">
				        		<label>&iquest; Lo recibi&oacute; en especie?</label>
				        	</div>
				        	<div id="ops_pregunta512">      	
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s1a2c14_1" name="p5161s1a2c14" value="1"/>
					        		<label for="p5161s1a2c14_1"><span><span></span></span>S&iacute;</label>
					        	</div>
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s1a2c14_2" name="p5161s1a2c14" value="2"/>
					        		<label for="p5161s1a2c14_2"><span><span></span></span>No</label>
					        	</div>
					        </div>
				        		<div id="opcion72" class="col-md-12" style="padding: 23px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
									<div class="radio form-group">
										<label>&iquest; Si tuviera que pagar por lo que recibi&oacute;, &iquest; en cu&aacute;nto estima lo recibido ?<input type="text" id="p5161s1a4c14" name="p5161s1a4c14" value="" placeholder="$" class="form-control" style="width:50%;"/></label>
									</div>
									<div class="radio form-group" style="padding-left: 23px;">
										<input type="checkbox" id="radp5161s1a4c14" name="radp5161s1a4c14" value="99"/>
										<label for="radp5161s1a4c14"><span><span></span></span>No sabe o no informa</label>
									</div>
								</div>
				        	
						</div>			
					</div> 

	        	
			</div>    
		</div>
		<div class="col-md-12 form-inline">
			<div class="row">
				<div class="col-md-4 radio">
	        		<label>&iquest; De otra instituci&oacute;n (ONGS, Fundaci&oacute;n o Empresa privada)?</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<input type="radio" id="p5161s2c14_1" name="p5161s2c14" value="1"/>
	        		<label for="p5161s2c14_1"><span><span></span></span>S&iacute;</label>
	        	</div>
	        	<div class="col-md-1 radio">
	        		<input type="radio" id="p5161s2c14_2" name="p5161s2c14" value="2"/>
	        		<label for="p5161s2c14_2"><span><span></span></span>No</label>
	        	</div>
	        		<div id="divCV8" class="col-md-12 form-inline" style="padding-left: 23px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
						<div class="row">
							<div class="col-md-4 radio">
				        		<label>&iquest; Lo recibi&oacute; en dinero?</label>
				        	</div>        	
				        	<div id="ops_pregunta521">
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s2a1c14_1" name="p5161s2a1c14" value="1"/>
					        		<label for="p5161s2a1c14_1"><span><span></span></span>S&iacute;</label>
					        	</div>
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s2a1c14_2" name="p5161s2a1c14" value="2"/>
					        		<label for="p5161s2a1c14_2"><span><span></span></span>No</label>
					        	</div>
					        </div>
				        		<div id="opcion81" class="col-md-12" style="padding: 46px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
									<div class="radio form-group">
										<label>&iquest; Cu&aacute;nto recibi&oacute; ?</label>
										<input type="text" id="p5161s2a3c14" name="p5161s2a3c14" value="" placeholder="$" class="form-control"/>
									</div>
									<div class="radio form-group" style="padding-left: 23px;">
										<input type="checkbox" id="radp5161s2a3c14" name="radp5161s2a3c14" value="99"/>
										<label for="radp5161s2a3c14"><span><span></span></span>No sabe o no informa</label>
									</div>
								</div>
						</div>
						<div class="row">
							<div class="col-md-4 radio">
				        		<label>&iquest; Lo recibi&oacute; en especie?</label>
				        	</div>
				        	<div id="ops_pregunta521">   	
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s2a2c14_1" name="p5161s2a2c14" value="1"/>
					        		<label for="p5161s2a2c14_1"><span><span></span></span>S&iacute;</label>
					        	</div>
					        	<div class="col-md-1 radio">
					        		<input type="radio" id="p5161s2a2c14_2" name="p5161s2a2c14" value="2"/>
					        		<label for="p5161s2a2c14_2"><span><span></span></span>No</label>
					        	</div>
					        </div>
				        		<div id="opcion82" class="col-md-12" style="padding: 23px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
									<div class="radio form-group">
										<label>&iquest; Si tuviera que pagar por lo que recibi&oacute;, &iquest; en cu&aacute;nto estima lo recibido ?<input type="text" id="p5161s2a4c14" name="p5161s2a4c14" value="" placeholder="$" class="form-control" style="width:50%;"/></label>
									</div>
									<div class="radio form-group" style="padding-left: 23px;">
										<input type="checkbox" id="radp5161s2a4c14" name="radp5161s2a4c14" value="99"/>
										<label for="radp5161s2a4c14"><span><span></span></span>No sabe o no informa</label>
									</div>
								</div>
						</div>			
					</div>
	        		       	
			</div>    
		</div>
	</div>
	<!--div id="divCV7" class="col-md-12 jumbotron" style="padding: 15px;">
		
		
		
	</div-->
	<!--div id="divCV8" class="col-md-12 jumbotron" style="padding: 15px;">

		
		
	</div-->
</div>

<br/>

<div id="pregP10312" class="row">
	<div class="col-md-12">
		<label>De P10311 del 2015 a  P10311S1 del 2016, &iquest;usted o alg&uacute;n miembro del hogar realiz&oacute; alguna adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n de la vivienda?</label>
	</div>
	<div id="ops_p10312" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="radio">
			<input type="radio" id="p10312_1" name="p10312" value="1"/>
        	<label for="p10312_1"><span><span></span></span>S&iacute;</label>
        </div>
        <div class="radio">
        	<input type="radio" id="p10312_2" name="p10312" value="2"/>
        	<label for="p10312_2"><span><span></span></span>No</label>
        </div>        
	</div>	
		<div id="divCV9" class="col-md-12 jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
			<div class="radio form-group">
				<label>&iquest;Cu&aacute;nto fue el valor de esta adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n?<input type="text" id="p10312s1" name="p10312s1" value="" placeholder="$" class="form-control" style="width: 50%;"/></label>
			</div>
			<div class="radio form-group" style="padding-left: 23px;">
				<input type="checkbox" id="radp10312s1" name="radp10312s1" value="99"/>
				<label for="radp10312s1"><span><span></span></span>No sabe o no informa</label>
			</div>
		</div>	
</div>

<br/>

<div id="pregP8697" class="row">
	<div class="col-md-12">
		<label>De las siguiente fuentes indique cu&aacute;les utilizaron para la adecuaci&oacute;n, ampliaci&oacute;n o subdivisi&oacute;n de la vivienda?</label>
	</div>
	<div id="ops_pregunta7" class="col-md-12" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
		<div class="radio">
			<input type="checkbox" id="p8697s1" name="p8697s1" value="1"/>
        	<label for="p8697s1"><span><span></span></span>Recursos propios (Ahorros, cesant&iacute;as, fiducias, ingresos por venta de otros bienes)</label>
        </div>
        <div class="radio">
        	<input type="checkbox" id="p8697s2" name="p8697s2" value="1"/>
        	<label for="p8697s2"><span><span></span></span>Pr&eacute;stamo hipotecario</label>
        </div>
        	<div id="divCV10" class="jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
				<div class="radio form-group">
					<label>&iquest; A cu&aacute;ntos a&ntilde;os ?
						<select id="p8697s2a1" name="p8697s2a1" class="form-control">
						<option value="-">Seleccione...</option>
						<?php for ($i=1; $i<=30; $i++){ ?>
							<option value="<?php echo $i; ?>"><?php echo ($i==1)?"$i a&ntilde;o":"$i a&ntilde;os"; ?></option>	 
						<?php } ?>
						</select>
					</label>
				</div>		
			</div>
        <div class="radio">
        	<input type="checkbox" id="p8697s3" name="p8697s3" value="1"/>
        	<label for="p8697s3"><span></span></span>Pr&eacute;stamo bancario de libre inversi&oacute;n</label>
        </div>
        	<div id="divCV11" class="jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
				<div class="radio form-group">
					<label>&iquest; A cu&aacute;ntos a&ntilde;os ?
						<select id="p8697s3a1" name="p8697s3a1" class="form-control">
						<option value="-">Seleccione...</option>
						<?php for ($i=1; $i<=30; $i++){ ?>
							<option value="<?php echo $i; ?>"><?php echo ($i==1)?"$i a&ntilde;o":"$i a&ntilde;os"; ?></option>	 
						<?php } ?>
						</select>
					</label>
				</div>		
			</div>
        <div class="radio">
        	<input type="checkbox" id="p8697s4" name="p8697s4" value="1"/>
        	<label for="p8697s4"><span><span></span></span>Subsidios</label>
        </div>
        	<!--<div id="divCV12" <!--class="col-md-12 jumbotron" style="padding: 15px;">-->
        	<div id="divCV12" class="jumbotron" style="padding: 23px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">
				<!--<div class="col-md-12 form-inline">-->
					<div class="form-inline">
						<div class="row">
							<div id="opcion121" class="col-md-12" style="padding: 23px;">		
								<div class="radio form-group">
									<label>&iquest; Cu&aacute;nto recibi&oacute; en total?<input type="text" id="p8697s4a1" name="p8697s4a1" value="" placeholder="$" class="form-control"/></label>
								</div>
								<div class="radio form-group" style="padding-left: 23px;">
									<input type="checkbox" id="radp8697s4a1" name="radp8697s4a1" value=""/>
									<label for="radp8697s4a1"><span><span></span></span>No sabe o no informa</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 radio">
				        		<label>El subsidio lo recibi&oacute;:</label>
				        	</div>

						</div>
						<div class="row">
							<div class="col-md-2 radio">
				        		<input type="checkbox" id="p8697s4a2" name="p8697s4a2" value="1"/>
				        		<label for="p8697s4a2"><span><span></span></span>En dinero</label>
				        	</div>
				        	<div class="col-md-2 radio">
				        		<input type="checkbox" id="p8697s4a3" name="p8697s4a3" value="1"/>
				        		<label for="p8697s4a3"><span><span></span></span>en Especie</label>
				        	</div>
				        </div>
						<div class="row">
							<div id="opcion122" class="col-md-12" style="padding: 23px;">		
								<div class="radio form-group">
									<label>&iquest; Si tuviera que pagar por lo que recibi&oacute;, &iquest; en cu&aacute;nto estima lo recibido ?<input type="text" id="p8697s4a5" name="p8697s4a5" value="" placeholder="$" class="form-control"/></label>
								</div>
								<div class="radio form-group" style="padding-left: 23px;">
									<input type="checkbox" id="radp8697s4a5" name="radp8697s4a5" value=""/>
									<label for="radp8697s4a5"><span><span></span></span>No sabe o no informa</label>
								</div>
							</div>
						</div>
				</div>
			</div>
        <div class="radio">
        	<input type="checkbox" id="p8697s5" name="p8697s5" value="1"/>
        	<label for="p8697s5"><span><span></span></span>Fondos (Fondo Nacional del Ahorro, fondo de empleados) o cooperativas </label>
        </div>
        <div class="radio">
        	<input type="checkbox" id="p8697s6" name="p8697s6" value="1"/>
        	<label for="p8697s6"><span><span></span></span>Otra</label>
        </div>
        	<div id="divCV13" class="col-md-12 jumbotron" style="padding: 0px;" title="" data-original-title=""  data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Respuesta obligatoria. Por favor, seleccione una opci&oacute;n para continuar">		
				<div class="radio form-group">
					<label>&iquest; Cu&aacute;l ?<input type="text" id="p8697s6a1" name="p8697s6a1" value="" placeholder="Especifique" class="form-control" size="70"/></label>
				</div>		
			</div>
	</div>
	
</div>


<br>
	<div class="row">
	    <div class="col-sm-12" id="mensaje_"></div>
	</div>
	<div class="row">		
		<div class="col-md-11" align="right">
		<div id="pagCompraViv_cargando" class="msj_guarda" style="display:none; color: green;">Guardando ... <img src="<?php echo base_url("images/ajax-loader.gif")?>" title="Guardando" /></div>
		<div id="pagCompraViv_error" class="msj_error" style="display:none; color: red;" >Error: Secci&oacute;n no guardada.</div>
		</div>
		<div class="col-md-1"> <button id="btnCompraVivienda" name="btnCompraVivienda" type="button" class="btn btn-success btn-md pull-right">Siguiente</button> </div>
	</div>

	
</form>


