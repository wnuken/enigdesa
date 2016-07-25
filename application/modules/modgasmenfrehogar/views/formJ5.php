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
.caja {
font-family: sans-serif;
font-size: 10px;
font-weight: 400;
color: #070707;
background:#E9EFCA
}
</style>
<script src="<?= $js_dir ?>"></script>
<hr />
<div class="row secondHead themeHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" alt="Imagen sección hogar"></div>
    <!--<div class="col-sm-4 col-md-3 col-lg-2 col-xs-12">
        
    </div>-->
    <!--<div class="col-sm-5 ">-->
    <h2><?= $secc[0]['TITULO1'] ?></h2>
    <h4><?= $secc[0]['TITULO2'] ?></h4>
    <h5><?= $secc[0]['TITULO3'] ?></h5>
    <!--</div>-->
</div>
<!--<div class="row">
    <div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
    <div class="col-sm-8">
        <h2><?= $secc[0]['TITULO1'] ?></h2>
        <h4><?= $secc[0]['TITULO2'] ?></h4>
        <h5><?= $secc[0]['TITULO3'] ?></h5>

    </div>
</div>-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" align="justify">
            <div id="contenido">
                <fieldset class="">
                    <?php
                    if (!empty($secc[0]['ENCABEZADO']))
                        //echo "<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
                    ?>

					<form id="form_5" name="form_5" class="form-horizontal" role="form">
						<input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?=$id_formulario?>" />
								<br />
<?php
	//$i = 1;
	//foreach ( $preg['var'] as $v3 ):
?>
						<div class='form-group has-feedback cont_articulo' id='div-P10395'>
                            <label class="control-label" for="P10395">P10395</label>

                            <div title="" data-original-title="" id="RESP_P10395" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                ¿De P10303 del 2015 a P10303S1 del 2016 usted o alg&uacute;n miembro del hogar realiz&oacute; viajes a destinos nacionales e internacionales?
                            </div>
                        <br>
                        
			<!--/div>
		</div-->

            <div class="example">
            	<div>
					<input type='checkbox' name='P10395S1' value='P10395S1' id='art_P10395S1' class='ops_1'/>
					<label for="art_P10395S1" id="art_P10395S1"><span></span>Nacional</label>
				</div>
				<div id="mostrar_P10395S1" style="display: none; margin-left: 4em">
					<div class='form-group has-feedback cont_articulo' id='div-P10395S1A1'>
                        <label class="control-label" for="P10395S1A1">P10395S1A1 Cu&aacute;ntos viajes</label>

                        <div title="" data-original-title="" id="RESP_P10395S1A1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                            
                        </div>
                        <br>
						<div class="example">
                        	<div style="width: 200px">
								<input type="text" name="P10395S1A1" id="P10395S1A1" class="form-control"  maxlength="25" >	
							</div>

						</div>
                    </div>
				</div>
				<div>
					<input type='checkbox' name='P10395S2' value='P10395S2' id='art_P10395S2' class='ops_2'/>
					<label for="art_P10395S2" id="art_P10395S2"><span></span>Internacional</label>
				</div>
                <div id="mostrar_P10395S2" style="display: none; margin-left: 4em">
					<div class='form-group has-feedback cont_articulo' id='div-P10395S2A1'>
                        <label class="control-label" for="P10395S2A1">P10395S1A1 Cu&aacute;ntos viajes</label>

                        <div title="" data-original-title="" id="RESP_P10395S2A1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                            
                        </div>
                        <br><br>

                        <div class="example">
                        	<div style="width: 200px">
								<input type="text" name="P10395S2A1" id="P10395S2A1" class="form-control"  maxlength="25" >	
							</div>

						</div>
                    </div>
				</div>
				<div>
					<input type='checkbox' name='99999999' value='99999999' id='art_99999999' class='ops_3'/>
					<label for="art_99999999" id="art_99999999"><span></span>No viaj&oacute;</label>
				</div>
            </div>
        	<hr></hr>
        	<div class='ocultar'>
	            <div class='example'>
		        	<label class="control-label" for="P10395">P10396</label>
		        	<div title="" data-original-title="" id="RESP_P10396" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		             	¿Para realizar el &uacute;timo viaje adquiri&oacute; paquete tur&iacute;stico completo? (Incluye tiquetes, alojamiento, alimentaci&oacute;n y otros).
		             </div>
		             <br>
		        </div>
	            <div class='example'>
	            	<input type='checkbox' name='si_P10396' value='1' id='si_P10396' class='ops_1'/>
					<label for="si_P10396" id="si_P10396"><span></span>Si</label>
				</div>
				<div id="mostrar_P10396" style="display: none; margin-left: 4em" >
					<div class='form-group has-feedback cont_articulo' id='div-P10396'>
	                	<label class="control-label" for="P10396S1">P10396S1 ¿Cu&aacute;ntos paquetes</label>
	                    <div title="" data-original-title="" id="RESP_P10396S1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
	                	</div>
		                <div class="example">
		                	<div style="width: 200px">
								<input type="text" name="P10396S1" id="P10396S1" class="form-control"  maxlength="25">	
							</div>
						</div>
						<div>
							<input type='checkbox' name='P10396S1_99' value='99' id='art_P10396S1_99' class='ops_2'/>
							<label for="art_P10396S1_99" id="art_P10396S1_99"><span></span>No sabe o no informa</label>
						</div>
	            	</div>
			
					<div class='form-group has-feedback cont_articulo' id='div-P10396'>
	                	<label class="control-label" for="P10396S2">P10396S2 ¿Cu&aacute;nto gasto en esos paquetes?</label>
	                    <div title="" data-original-title="" id="RESP_P10396S2" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
	                	</div>
		                <div class="example">
		                	<div style="width: 200px">
								<input type="text" name="P10396S2" id="P10396S2" class="form-control"  maxlength="25" >	
							</div>
						</div>
						<div>
							<input type='checkbox' name='P10396S2_99' value='99' id='art_P10396S2_99' class='ops_2'/>
							<label for="art_P10396S2_99" id="art_P10396S2_99"><span></span>No sabe o no informa</label>
						</div>
	            	</div>
	            </div>	
				<div class='example ocultar'>
	            	<input type='checkbox' name='no_P10396' value='1' id='no_P10396' class='ops_1'/>
					<label for="no_P10396" id="no_P10396"><span></span>No</label>
				</div>	
			</div>
			<div class='ocultar'>
				<div>
					<hr></hr>
				</div>
				<div class='ocultarAlojamiento'>
					<div class='example' title="" data-original-title="" id="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
						¿Cu&aacute;les alojamientos emple&oacute; para pernoctar durante el &uacute;ltimo viaje?
					</div>
					<br>
					 <div class='example'>
			        	<div title="" data-original-title="" id="RESP_P10397S1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
			             	<label class="control-label" for="P10397S1">P10397S1</label>
			             	 Hotel, hostal, centro vacacional.
			             </div>
			        </div>
			        <div class='example'>
		            	<input type='checkbox' name='si_P10397S1' value='1' id='si_P10397S1' class='ops_1'/>
						<label for="si_P10397S1" id="si_P10397S1"><span></span>Si</label>
					</div>
					<div id="mostrar_P10397S1A1" style="display: none; margin-left: 4em">
						<div class='form-group has-feedback cont_articulo' id='div-P10397S1A1'>
		                	<label class="control-label" for="P10397S1A1">P10397S1A1 ¿Cu&aacute;ntos noches?</label>
		                    <div title="" data-original-title="" id="RESP_P10397S1A1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		                	</div>
			                <div class="example">
			                	<div style="width: 200px">
									<input type="text" name="P10397S1A1" id="P10397S1A1" class="form-control"  maxlength="25" >	
								</div>
							</div>
							<div>
								<input type='checkbox' name='P10397S1A1_99' value='99' id='art_P10397S1A1_99' class='ops_2'/>
								<label for="art_P10397S1A1_99" id="art_P10397S1A1_99"><span></span>No sabe o no informa</label>
							</div>
		            	</div>
					</div>
					 <div class='example'>
		            	<input type='checkbox' name='no_P10397S1' value='2' id='no_P10397S1' class='ops_2'/>
						<label for="no_P10397S1" id="no_P10397S1"><span></span>No</label>
					</div>
					<div class='example'>
			        	<div title="" data-original-title="" id="RESP_P10397S1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
			             	<label class="control-label" for="P10397S3">P10397S3</label>
			             	 Campamento o camping.
			             </div>
			        </div>
			        <div class='example'>
		            	<input type='checkbox' name='si_P10397S3' value='1' id='si_P10397S3' class='ops_1'/>
						<label for="si_P10397S3" id="si_P10397S3"><span></span>Si</label>
					</div>
					<div id="mostrar_P10397S3A1" style="display: none; margin-left: 4em">
						<div class='form-group has-feedback cont_articulo' id='div-P10397S3A1'>
		                	<label class="control-label" for="P10397S3A1">P10397S3A1 ¿Cu&aacute;ntos noches?</label>
		                    <div title="" data-original-title="" id="RESP_P10397S3A1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		                	</div>
			                <div class="example">
			                	<div style="width: 200px">
									<input type="text" name="P10397S3A1" id="P10397S3A1" class="form-control"  maxlength="25" >	
								</div>
							</div>
							<div>
								<input type='checkbox' name='P10397S3A1_99' value='99' id='art_P10397S3A1_99' class='ops_2'/>
								<label for="art_P10397S1A1_99" id="art_P10397S1A1_99"><span></span>No sabe o no informa</label>
							</div>
		            	</div>
					</div>
					 <div class='example'>
		            	<input type='checkbox' name='no_P10397S3' value='2' id='no_P10397S3' class='ops_2'/>
						<label for="no_P10397S3" id="no_P10397S3"><span></span>No</label>
					</div>
					<div class='example'>
			        	<div title="" data-original-title="" id="RESP_P10397S4" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
			             	<label class="control-label" for="P10397S4">P10397S4</label>
			             	 Alojamiento rural
			             </div>
			        </div>
			        <div class='example'>
		            	<input type='checkbox' name='si_P10397S4' value='1' id='si_P10397S4' class='ops_1'/>
						<label for="si_P10397S4" id="si_P10397S4"><span></span>Si</label>
					</div>
					<div id="mostrar_P10397S4A1" style="display: none; margin-left: 4em">
						<div class='form-group has-feedback cont_articulo' id='div-P10397S4A1'>
		                	<label class="control-label" for="P10397S4A1">P10397S4A1 ¿Cu&aacute;ntos noches?</label>
		                    <div title="" data-original-title="" id="RESP_P10397S4A1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		                	</div>
			                <div class="example">
			                	<div style="width: 200px">
									<input type="text" name="P10397S4A1" id="P10397S4A1" class="form-control"  maxlength="25" >	
								</div>
							</div>
							<div>
								<input type='checkbox' name='P10397S4A1_99' value='99' id='art_P10397S4A1_99' class='ops_2'/>
								<label for="art_P10397S4A1_99" id="art_P10397S4A1_99"><span></span>No sabe o no informa</label>
							</div>
		            	</div>
					</div>
					 <div class='example'>
		            	<input type='checkbox' name='no_P10397S4' value='2' id='no_P10397S4' class='ops_2'/>
						<label for="no_P10397S4" id="no_P10397S4"><span></span>No</label>
					</div>
					<div class='example'>
			        	<div title="" data-original-title="" id="RESP_P10397S5" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
			             	<label class="control-label" for="P10397S5">P10397S5</label>
			             	 Casa, apartamento, finca, en propiedad, de familiares o amigos
			             </div>
			        </div>
			        <div class='example'>
		            	<input type='checkbox' name='si_P10397S5' value='1' id='si_P10397S5' class='ops_1'/>
						<label for="si_P10397S5" id="si_P10397S5"><span></span>Si</label>
					</div>
					<div id="mostrar_P10397S5A1" style="display: none; margin-left: 4em">
						<div class='form-group has-feedback cont_articulo' id='div-P10397S5A1'>
		                	<label class="control-label" for="P10397S5A1">P10397S4A1 ¿Cu&aacute;ntos noches?</label>
		                    <div title="" data-original-title="" id="RESP_P10397S5A1" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		                	</div>
			                <div class="example">
			                	<div style="width: 200px">
									<input type="text" name="P10397S5A1" id="P10397S5A1" class="form-control"  maxlength="25" >	
								</div>
							</div>
							<div>
								<input type='checkbox' name='P10397S5A1_99' value='99' id='art_P10397S5A1_99' class='ops_2'/>
								<label for="art_P10397S5A1_99" id="art_P10397S5A1_99"><span></span>No sabe o no informa</label>
							</div>
		            	</div>
					</div>
					 <div class='example'>
		            	<input type='checkbox' name='no_P10397S5' value='2' id='no_P10397S5' class='ops_2'/>
						<label for="no_P10397S5" id="no_P10397S5"><span></span>No</label>
					</div>
					
			        <div class=''>
						<hr></hr>
					</div>
					<div class='example'>
			        	<label class="control-label" for="P3J1324">P3J1324</label>
			        	<div title="" data-original-title="" id="RESP_P3J1324" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
			             	¿Cu&aacute;l fue el monto total pagado por su &uacute;ltimo viaje?
			             </div>
			             <div class='caja'>
			             	 Incluya alojamiento, transporte, alimentaci&oacute;n, bienes de uso personal, servicios culturales y de recreaci&oacute;n, souvenirs, artesan&iacute;as y regalos.
			             </div>
			             <br>
			        </div>
			        <div class=''>
						<div class='form-group has-feedback cont_articulo' id='div-P3J1324'>
		                	<div title="" data-original-title="" id="RESP_P3J1324" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		                	</div>
		                	<div style="margin-left: 4em">
				                <div class="example">
				                	<div style="width: 200px">
										<input type="text" name="P3J1324" id="P3J1324" class="form-control"  maxlength="25" >	
									</div>
								</div>
								<div>
									<input type='checkbox' name='P3J1324_99' value='99' id='art_P3J1324_99' class='ops_4'/>
									<label for="art_P3J1324_99" id="art_P3J1324_99"><span></span>No sabe o no informa</label>
								</div>
							</div>
		            	</div>
					</div>
					<div class=''>
						<hr></hr>
					</div>
				</div>	
				<div class='example'>
		        	<label class="control-label" for="P10398">P10398</label>
		        	<div title="" data-original-title="" id="RESP_P10398" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
		             	¿Cu&aacute;les de las siguientes fuentes utiliz&oacute; para realizar el &uacute;ltimo viaje?
		             </div>
		             <br>
		        </div>
		        <div class='example'>
	            	<input type='checkbox' name='P10398S1' value='P10398S1' id='P10398S1' class='ops_1'/>
					<label for="P10398S1" id="P10398S1"><span></span>Pr&eacute;stamo</label>
				</div>
				<div class='example'>
	            	<input type='checkbox' name='P10398S2' value='P10398S2' id='P10398S2' class='ops_2'/>
					<label for="P10398S2" id="P10398S2"><span></span>Vi&aacute;ticos</label>
				</div>
				<div class='example'>
	            	<input type='checkbox' name='P10398S3' value='P10398S3' id='P10398S3' class='ops_2'/>
					<label for=P10398S3 id="P10398S3"><span></span>Recursos propios no reembolsables</label>
				</div>
				<div class='example'>
	            	<input type='checkbox' name='P10398S4' value='P10398S4' id='P10398S4' class='ops_2'/>
					<label for=P10398S4 id="P10398S4"><span></span>Recursos propios reembolsables por empleador</label>
				</div>
			</div>				
    </div>			
		<div class='form-group has-feedback' id='div'>
			<h5 class='control-label articulo'</h5>

			<div class='col-sm-10' id='mmm' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
				<!--  table>
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
							<input type='checkbox' name='99999999' value='2' id='art_99999999' class='ops_3'/>
							<label for="art_P10395S2" id="art_P10395S2"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='99999999'>No viaj&oacute;</h5>
						</td>
						
					</tr>
					<tr class='ocultar'>
						<td colspan='2'>
						<hr>
						</td>
					</tr >
					<tr class='ocultar'>
						<td>
						
							<h5 class='control-label' for=''>P10396</h5>
						</td>
					</tr>
					<tr class='ocultar'>	
						<td colspan='2'>
							<h5 class='control-label' for=''>¿Para realizar el &uacute;timo viaje adquiri&oacute; paquete tur&iacute;stico completo? (Incluye tiquetes, alojamiento, alimentaci&oacute;n y otros) </h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='si_P10396' value='1' id='si_P10396' class='ops_1'/>
						</td>
						<td>
							<h5 class='control-label' for='Si_P10396'>Si</h5>
						</td>
					</tr >
					<tr id="mostrar_P10396" style="display: none" class='ocultar'>
						<td>
						</td>	
						<td>
							<h5 class='control-label' for='P10396S1'>P10396S1 Cu&aacute;ntos paquetes?</h5>
							<br>
							<input type="text" name="P10396S1" id="P10396S1" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P10396S1_99' value='99' id='P10396S1_99' class='ops_1'/>	
							No sabe o no informa
							<br>
							<h5 class='control-label' for='P10396S1'>P10396S1 Cu&aacute;nto gasto en esos paquetes?</h5>
							<br>
							<input type="text" name="P10396S2" id="P10396S2" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P10396S2_99' value='99' id='P10396S2_99' class='ops_1'/>
							No sabe o no informa
						</td>
					</tr>			
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='no_P10396' value='2' id='no_P10396' class='ops_2'/>
						</td>	
						<td>
							<h5 class='control-label' for=''>No</h5>
						</td>
							
					</tr>	
					
					<tr class='ocultar'>
						<td colspan='2'>
						<hr>
						</td>
					</tr>	
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for=''>Cu&aacute;les alojamientos emple&oacute; para pernoctar durante el &uacute;ltimo viaje?</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for='P10397S1'>P10397S1 Hotel, hostal, centro vacacional</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='si_P10397S1' value='1' id='si_P10397S1' class='ops_1'/>
							Si
						</td>		
					</tr>
					<tr id="mostrar_P10397S1A1" style="display: none" class='ocultar'>
						<td>
						</td>
						<td>
							<h5 class='control-label' for='P10397S1A1'>P10397S1A1 Cu&aacute;ntos noches?</h5>
							<br>
							<input type="text" name="P10397S1A1" id="P10397S1A1" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P10397S1A1_99' value='99' id='P10397S1A1_99' class='ops_1'/>	
							No sabe o no informa
						</td>
					</tr >
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='no_P10397S1' value='2' id='no_P10397S1' class='ops_2'/>
							No
						</td>		
					</tr >
					
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for='P10397S3'>P10397S3 Campamento o camping</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='si_P10397S3' value='1' id='si_P10397S3' class='ops_1'/>
							Si
						</td>		
					</tr>
					<tr id="mostrar_P10397S3A1" style="display: none" class='ocultar'>
						<td>
						</td>
						<td>
							<h5 class='control-label' for='P10397S3A1'>P10397S3A1 Cu&aacute;ntos noches?</h5>
							<br>
							<input type="text" name="P10397S3A1" id="P10397S3A1" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P10397S3A1_99' value='99' id='P10397S3A1_99' class='ops_1'/>	
							No sabe o no informa
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='no_P10397S3' value='2' id='no_P10397S3' class='ops_2'/>
							No
						</td>		
					</tr>
					
					
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for='P10397S4'>P10397S4 Alojamiento rural</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='si_P10397S4' value='1' id='si_P10397S4' class='ops_1'/>
							Si
						</td>		
					</tr>
					<tr id="mostrar_P10397S4A1" style="display: none" class='ocultar'>
						<td>
						</td>
						<td>
							<h5 class='control-label' for='P10397S4A1'>P10397S4A1 Cu&aacute;ntos noches?</h5>
							<br>
							<input type="text" name="P10397S4A1" id="P10397S4A1" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P10397S4A1_99' value='99' id='P10397S4A1_99' class='ops_1'/>	
							No sabe o no informa
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='no_P10397S4' value='2' id='no_P10397S4' class='ops_2'/>
							No
						</td>		
					</tr >			
					
					
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for='P10397S5'>P10397S5 Casa, apartamento, finca, en propiedad, de familiares o amigos</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='si_P10397S5' value='1' id='si_P10397S5' class='ops_1'/>
							Si
						</td>		
					</tr>
					<tr id="mostrar_P10397S5A1" style="display: none" class='ocultar'>
						<td>
						</td>
						<td>
							<h5 class='control-label' for='P10397S5A1'>P10397S5A1 Cu&aacute;ntos noches?</h5>
							<br>
							<input type="text" name="P10397S5A1" id="P10397S5A1" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P10397S5A1_99' value='99' id='P10397S5A1_99' class='ops_1'/>	
							No sabe o no informa
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='no_P10397S5' value='2' id='no_P10397S5' class='ops_2'/>
							No
						</td>		
					</tr>
					<tr class='ocultar'>
						<td colspan='2'>
						<hr>
						</td>
					</tr >
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for=''>P3J1324 Cu&aacute;l fue el monto total pagado por su &uacute;ltimo viaje?</h5>
							<h6 class='control-label'> Incluya alojamiento, transporte, alimentaci&oacute;n, bienes de uso personal, servicios culturales y de recreaci&oacute;n, souvenirs, artesan&iacute;as y regalos.</h6>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type="text" name="P3J1324" id="P3J1324" class="form-control"  maxlength="25" >
							<br>
							<input type='checkbox' name='P3J1324_99' value='99' id='P3J1324_99' class='ops_1'/>	
							No sabe o no informa
						</td>
					</tr>
					<tr class='ocultar'>
						<td colspan='2'>
						<hr>
						</td>
					</tr >
					<tr class='ocultar'>
						<td colspan='2'>
							<h5 class='control-label' for=''>P10398 Cu&aacute;les de las siguientes fuentes utiliz&oacute; para realizar el &uacute;ltimo viaje?</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='P10398S1' value='P10398S1' id='art_P10398S1' class='ops_1'/>
							<label for="art_P10398S1" id="art_P10398S1"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='P10398S1'>Pr&eacute;stamo</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='P10398S2' value='P10398S2' id='art_P10398S2' class='ops_1'/>
							<label for="art_P10398S2" id="art_P10398S2"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='P10398S2'>Vi&aacute;ticos</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='P10398S3' value='P10398S3' id='art_P10398S3' class='ops_1'/>
							<label for="art_P10398S3" id="art_P10398S3"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='P10398S3'>Recursos propios no reembolsables</h5>
						</td>
					</tr>
					<tr class='ocultar'>
						<td>
							<input type='checkbox' name='P10398S4' value='P10398S4' id='art_P10398S4' class='ops_1'/>
							<label for="art_P10398S4" id="art_P10398S4"><span><span></span></span></label>
						</td>
						<td>
							<h5 class='control-label' for='P10398S4'>Recursos propios reembolsables por empleador</h5>
						</td>
					</tr>
				</table-->
		
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
		<button class='btn btn-success' id='env_form_5'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
	</div>
	
		
	