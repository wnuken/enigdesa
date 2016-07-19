<div ng-controller="Educacion">
	<div class="ff">
		<input type="hidden" name="idSection" id="idSection" value="<?php echo $idSection; ?>">
		<div ng-init="pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="FormulariorHombre.pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="FormulariorHombre.idSection = '<?php echo $idSection; ?>'"></div>
		<div ng-init="FormulariorHombre.idFormulario = <?php echo $this->session->userdata("id_formulario"); ?>"></div>
		<div ng-init="FormulariorHombre.idVariable = '<?php echo $idVariable; ?>'"></div>
	</div>
	<div class="title">
		<div class="row">
			<hr>
			<div class="col-sm-2">
				<img src="<?php echo base_url('images/' . $LOGO); ?>" alt="logo">
			</div>
			<div class="col-sm-8">
				<h2><?php echo $TITULO1; ?> {{ FormulariorHombre.idSection }}</h2>

				<blockquote>
				<small><?php echo $TITULO2; ?></small>
      <?php echo $TITULO3; ?>
      </blockquote>
			</div>



		</div>
	</div>
	<div ng-if="pagesection == 0">
		<div class="row">
			<div class="col-sm-12 col-md-offset-1">
				<fieldset>
					<form class="form-enph" id="rHombre" name="rHombre" class="rHombre">
						<div class="row">
							<div class="form-group has-feedback" id="div-P10260D11">
								<div class="col-sm-12">
									<label class="control-label">¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para <?php echo $TEMPORALIDAD; ?>?</label>
								</div>
								<div class="col-sm-12">
								<div>
      								<input type="radio" name="inititalvalue" value="1" id="inititalvalue1" ng-model="FormulariorHombre.valorVariable" required>
									<span></span><label>Si</label>
									</div>

									<br>
									<div>
									<input type="radio" name="inititalvalue" value="2" id="inititalvalue2" ng-model="FormulariorHombre.valorVariable">
									<label><span></span>No</label>
									</div>
								</div>
							</div>
							<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
								<hr>
							</div>
						</div>
					</form>
				</fieldset>
				<div class="row text-center">
					<button class="btn btn-success" ng-disabled="!rHombre.$valid" ng-click="validateForm1(1)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 1">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-enph" id="rHombre1" name="rHombre1" class="rHombre1">
					<div class="row">
						<div ng-repeat="rhom in FormulariorHombre.rh">
							<div class="form-group has-feedback" id="div-{{rhom.id}}">
								<div class="col-sm-12">
									<input type="checkbox" name="{{rhom.id}}" id="{{rhom.id}}" ng-model="FormulariorHombre.rh[$index].value" ng-change="validateBtnS1($index)">
									<label><h5 class="control-label" for="{{rhom.id}}">{{ rhom.name }}</h5></label>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
										<hr>
									</div>
								</div>
							</div>
						</div>
						<div class="select-nada">
							<div class="col-sm-12">
									<input type="checkbox" name="novalida" id="novalida" ng-model="FormulariorHombre.Novalida" ng-disabled="activeBtnS1">
									<label><h5 class="control-label" for="novalida">Ninguna de las anteriores</h5></label>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
										<hr>
									</div>
								</div>
						</div>
					</div>
				</form>
				<div ng-if="!FormulariorHombre.Novalida">
				<div class="row text-center">
					<button class="btn btn-success" ng-disabled="!activeBtnS1" ng-click="validateForm2(2)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
				</div>

				<div ng-if="FormulariorHombre.Novalida">
				<div class="row text-center">
					<button class="btn btn-success" ng-click="validateForm5(5)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
				</div>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 2">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-enph" id="rHombre2" name="rHombre2" class="rHombre2">
					<div class="row">
						<div ng-repeat="rhom in FormulariorHombre.rh">
							<div ng-if="rhom.value == true">
								<div class="form-group has-feedback" id="div-03120102">
									<div class="col-sm-12">
										<div class="col-sm-12">
											<label><h3 class="control-label" for="03120102">{{ rhom.name }}</h3></label>
											<br>
											<label>¿Cómo lo obtuvieron?</label>
										</div>
										<div class="col-sm-2"></div>
										<div class="col-sm-10">
											<div class="form-input">
												<input type="hidden" name="{{rhom.id}}" id="{{rhom.id}}" ng-model="validateGroup[$index]" required>
												<input type="checkbox" name="compra{{rhom.id}}" id="compra{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.COMPRA" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="555">Compra o pago</h5></label>
											</div>

											<div class="form-input">
												<input type="checkbox" name="recibo{{rhom.id}}" id="recibo{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.RECIBIDO_PAGO" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="03120102">Recibido por trabajo</h5></label>
											</div>

											<div class="form-input">
												<input type="checkbox" name="regalo{{rhom.id}}" id="regalo{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.REGALO" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="03120102">Regalo o donación</h5></label>
											</div>

											<div class="form-input">
												<input type="checkbox" name="intercambio{{rhom.id}}" id="intercambio{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.INTERCAMBIO" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="03120102">Intercambio</h5></label>
											</div>

											<div class="form-input">
												<input type="checkbox" name="producido{{rhom.id}}" id="producido{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.PRODUCIDO" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="03120102">Producido por el hogar</h5></label>
											</div>

											<div class="form-input">
												<input type="checkbox" name="propio{{rhom.id}}" id="propio{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.NEGOCIO_PROPIO" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="03120102">Tomado de un negocio propio</h5></label>
											</div>

											<div class="form-input">
												<input type="checkbox" name="otra{{rhom.id}}" id="otra{{rhom.id}}" 
												ng-model="FormulariorHombre.rh[$index].ot.OTRA" ng-change="validateBtnS2($index)">
												<label><h5 class="control-label" for="03120102">Otra forma</h5></label>
											</div>

										</div>
									</div>
									<div class="col-sm-12">
										<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
											<hr>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="row text-center">
					<button class="btn btn-success" ng-disabled="!rHombre2.$valid" ng-click="validateForm3(3)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>




	</div>
	<div ng-if="pagesection == 3">

		<form class="form-enph" id="rHombre3" name="rHombre3" class="rHombre3">
			<table class="table table-hover">
		<thead>
			<tr class="active">
				<th style="text-align:center;" rowspan="2" width="28%">Nombre del artículo o servicio COMPRADO o PAGADO</th>
				<th style="text-align:center;" colspan="2" width="32%">¿Cuánto fue el valor TOTAL pagado por el artículo o servicio?</th>
				<th style="text-align:center;" rowspan="2" width="20%">¿En qué LUGAR compró o pagó el artículo o servicio?</th>
				<th style="text-align:center;" rowspan="2" width="20%">¿Con qué FRECUENCIA compra o paga HABITUALMENTE el artículo o servicio?</th>
			</tr>
			<tr class="active" align="center">
				<th style="text-align:center;">Valor Pagado</th>
				<th style="text-align:center;" width="12%">Compró o pagó el artículo o servicio pero no recuerda el valor</th>

			</tr>
		</thead>
		<tbody>

			<tr align="center" ng-repeat="rhom in FormulariorHombre.rh" ng-if="rhom.ot.COMPRA === true && rhom.value === true">
				<td align="left">
					{{rhom.name}}
				</td>
				<td>
				<div class="form-group">
								<div ng-if="!FormulariorHombre.rh[$index].pa.VALOR_PAGADO1">
									<input class="form-control isnumeric" type="text" name="pagado{{rhom.id}}" id="pagado{{rhom.id}}" ng-model="FormulariorHombre.rh[$index].pa.VALOR_PAGADO" 
									ng-disabled="FormulariorHombre.rh[$index].pa.VALOR_PAGADO1" 
									ng-change="sumValor($index)" required>
									<label ng-show="FormulariorHombre.rh[$index].pa.VALOR_PAGADO < 500"
									style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">Valor mayor a 500.</label>
								</div>
								<div ng-if="FormulariorHombre.rh[$index].pa.VALOR_PAGADO1">
									<input 	class="form-control isnumeric" type="text" name="pagado{{rhom.id}}" id="pagado{{rhom.id}}" 
									disabled>
								</div>
								
							</div>
				</td>
				<td>
				<div class="form-group">
								<input name="pagado{{rhom.id}}1" id="pagado{{rhom.id}}1" type="checkbox" 
								ng-model="FormulariorHombre.rh[$index].pa.VALOR_PAGADO1"
								ng-change="resValor($index)"> 
							</div>
				</td>
				<td>
					<div ng-if="rhom.DEFINE_LUGAR_COMPRA == 1">
								<select name="sellugar{{rhom.id}}" id="sellugar{{rhom.id}}" class="form-control" ng-model="FormulariorHombre.rh[$index].pa.LUGAR_COMPRA" required>
									<option value="" disabled>Seleccione...</option>
									<option value="1">Almacenes, supermercado de cadena, tiendas por departamento o hipermercados</option>
									<option value="4">Supermercados de cajas de compesanción, cooperativas, fondos de empleados y comisariatos</option>
									<option value="6">Supermercado de barrio, tiendas de barrio, cigarrerías, salsamentarias y delicatessen</option>
									<option value="7">Misceláneas de barrio y cacharrerías</option>
									<option value="10">Plazas de mercado, galerías, mercados móviles, central mayorista de abastecimiento y graneros</option>
									<option value="13">Vendedores ambulantes</option>
									<option value="14">Sanandrecitos, bodegas y fábricas</option>
									<option value="16">Establecimiento especializado en la venta del artículo o la prestación del servicio</option>
									<option value="17">Farmacias y droguerías</option>
									<option value="20">Persona particular</option>
									<option value="21"> Ferias especializada: artesanal, del libro , del hogar, de computadores, etc.</option>
									<option value="22">A través de Internet</option>
									<option value="23">Televentas y ventas por catálogo</option>
									<option value="24">Otro</option>
									<option value="26">En el exterior (fuera del país)</option>
								</select>
							</div>
							<div ng-if="rhom.DEFINE_LUGAR_COMPRA != 1">
								<div class="form-group">
									<input class="form-control" name="sellugar{{rhom.id}}" id="sellugar{{rhom.id}}" type="text" disabled>
								</div>
							</div>
					</td>
					<td>
						<div ng-if="rhom.DEFINE_FRECU_COMPRA == 1">
								<select name="selfre{{rhom.id}}" id="selfre{{rhom.id}}" class="form-control" 
								ng-model="FormulariorHombre.rh[$index].pa.FRECUENCIA_COMPRA" required>
								<option value="" disabled>Seleccione...</option>
								<option value="3">Semanal</option>
								<option value="4">Quincenal</option>
								<option value="5">Mensual</option>
								<option value="6">Bimestral</option>
								<option value="7">Trimestral</option>
								<option value="8">Anual</option>
								<option value="9">Esporádica</option>
								<option value="10">Semestral</option>
							</select>
							<!-- !generalForm.PREDENUPA{{idupa}}{{idpredio}}.$pristine && generalForm.PREDENUPA{{idupa}}{{idpredio}}.$error.required -->
						</div>
					</td>
				</tr>


				<tr align="center" class="">
					<td><b>SUBTOTAL</b></td>
					<td> <input class="form-control" readonly="readonly" type="text" name="txt_total" id="txt_total" ng-model="subtotal">  </td>
					<td colspan="3">&nbsp;</td>
				</tr>

				<tr align="center" class="">
					<td colspan="2">El medio de pago usado PRINCIPALMENTE para comprar los articulos y servicios enunciados en este módulo fue:</td>
					<td colspan="2"> 
						<div class="form-group">
							<select name="mediopago" id="mediopago}" class="form-control" 
							ng-model="FormulariorHombre.mp['<?php echo $MEDIO_PAGO; ?>']" required>
							<option value="" disabled>Seleccione...</option>
							<option value="1">Tarjeta débito</option>
							<option value="2">Tarjeta crédito</option>
							<option value="3">Efectivo</option>
							<option value="4">Bonos</option>
							<option value="5">Cheques</option>
							<option value="6">Otro</option>
						</select>
					</div>
				</td>
				<td >
					<div class="form-group" ng-if="FormulariorHombre.mp['<?php echo $MEDIO_PAGO; ?>'] == 6">
						<input class="form-control" name="cual" id="cual" type="text" placeholder="¿Cual?" ng-model="FormulariorHombre.mp['<?php echo $MEDIO_CUAL ; ?>']" required>
					</div>
				</td>
			</tr>

				

			</tbody>
		</table>
	</form>
	<div class="row text-center">

		<div ng-show="errorVcomprado" class="alert alert-danger alert-dismissible fade in" role="alert">
			los campos <strong>Valor Pagado</strong> deben ser iguales o mayores a<strong> 500!</strong> </div>


			<button class="btn btn-success" ng-disabled="!rHombre3.$valid" ng-click="validateForm4(4)" id="ENV_2_2">
				Guardar y Continuar
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
			</button>
		</div>


	</div>

	<div ng-if="pagesection == 4">

		<div class="col-sm-12">

			<button class="btn btn-success" ng-click="validateForm5(5)" id="ENV_2_2">
				Guardar y Continuar
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
			</button>
		</div>
	</div>

</div>