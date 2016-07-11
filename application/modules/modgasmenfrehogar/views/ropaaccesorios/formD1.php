<div ng-controller="ropaHombre">
	<div class="hide">
		<div ng-init="pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="FormulariorHombre.idFormulario = <?php echo $this->session->userdata("id_formulario"); ?>"></div>
		<div ng-init="FormulariorHombre.idVariable = 'P3D11'"></div>
	</div>
	<div ng-if="pagesection == 0">
		<div class="row">
			<hr>
			<div class="col-sm-2">
				<img src="http://192.168.1.200/dimpe/enigdesa/images/form_icon-ingresospersonales.png">
			</div>
			<div class="col-sm-8">
				<h2>GASTOS EN PRENDAS DE VESTIR Y ACCESORIOS PERSONALES {{ FormulariorHombre.pagesection }}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<form class="form-enph" id="rHombre" name="rHombre" class="rHombre">
					<div class="row">
						<div class="form-group has-feedback" id="div-P10260D11">
							<label><h4>De P10260D11 a P10260S1D11 del 2016, ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para HOMBRE?</h4></label>
							<input type="radio" name="adquiere" value="1" id="adquiere1" ng-model="FormulariorHombre.valorVariable" required>
							<label><h5 class="control-label" for="P10260D11">Si</h5></label>
							<br>
							<input type="radio" name="adquiere" value="2" id="adquiere2" ng-model="FormulariorHombre.valorVariable">
							<label><h5 class="control-label" for="P10260D11">No</h5></label>
						</div>
						<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
							<hr>
						</div>
					</div>
				</form>
				<div class="row text-center">
					<button class="btn btn-success" ng-disabled="!rHombre.$valid" ng-click="validateForm1(1)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 1">
		<div class="row">
			<hr>
			<div class="col-sm-2">
				<img src="http://192.168.1.200/dimpe/enigdesa/images/form_icon-ingresospersonales.png">
			</div>
			<div class="col-sm-8">
				<h2>GASTOS EN PRENDAS DE VESTIR Y ACCESORIOS PERSONALES {{ FormulariorHombre.pagesection }}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<form class="form-enph" id="rHombre1" name="rHombre1" class="rHombre1">
					<div class="row">
						<div ng-repeat="rhom in FormulariorHombre.rh">
						<div class="form-group has-feedback" id="div-03120102">
							<div class="col-sm-12">
								<input type="checkbox" name="adquiere" ng-init="03120102" id="03120102" ng-model="FormulariorHombre.rh[$index].value" ng-change="validateBtnS1($index)">
								<label><h5 class="control-label" for="03120102">{{ rhom.name }}</h5></label>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
									<hr>
								</div>
							</div>
						</div>
						</div>
					</div>
				</form>
				<div class="row text-center">
					<button class="btn btn-success" ng-disabled="!activeBtnS1" ng-click="validateForm2(2)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 2">
		

	<div class="row">
			<hr>
			<div class="col-sm-2">
				<img src="http://192.168.1.200/dimpe/enigdesa/images/form_icon-ingresospersonales.png">
			</div>
			<div class="col-sm-8">
				<h2>GASTOS EN PRENDAS DE VESTIR Y ACCESORIOS PERSONALES {{ FormulariorHombre.pagesection }}</h2>
			</div>
		</div>
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
								<input type="{{rhom.id}}" name="{{rhom.id}}" ng-model="elid[rhom.id]" required>
								<input type="checkbox" name="adquiere" name="compra{{rhom.id}}" id="compra{{rhom.id}}" ng-model="FormulariorHombre.compra[rhom.id]" ng-change="validateBtnS2(rhom.id)">
								<label><h5 class="control-label" for="555">Compra o pago</h5></label>
								</div>

								<div class="form-input">
								<input type="checkbox" name="adquiere" name="recibo{{rhom.id}}" id="recibo{{rhom.id}}" ng-model="FormulariorHombre.recibo[rhom.id]" ng-change="validateBtnS2(rhom.id)">
								<label><h5 class="control-label" for="03120102">Recibido por trabajo</h5></label>
								</div>

								<div class="form-input">
								<input type="checkbox" name="adquiere" name="regalo{{rhom.id}}" id="regalo{{rhom.id}}" ng-model="FormulariorHombre.regalo[rhom.id]" ng-change="validateBtnS2(rhom.id)">
								<label><h5 class="control-label" for="03120102">Regalo o donación</h5></label>
								</div>

								<div class="form-input">
								<input type="checkbox" name="adquiere" name="intercambio{{rhom.id}}" id="intercambio{{rhom.id}}" ng-model="FormulariorHombre.intercambio[rhom.id]" ng-change="validateBtnS2(rhom.id)">
								<label><h5 class="control-label" for="03120102">Intercambio</h5></label>
								</div>

								<div class="form-input">
								<input type="checkbox" name="adquiere" name="producido{{rhom.id}}" id="producido{{rhom.id}}" ng-model="FormulariorHombre.producido[rhom.id]" ng-change="validateBtnS2(rhom.id)">
								<label><h5 class="control-label" for="03120102">Producido por el hogar</h5></label>
								</div>

								<div class="form-input">
								<input type="checkbox" name="adquiere" name="propio{{rhom.id}}" id="propio{{rhom.id}}" ng-model="FormulariorHombre.propio[rhom.id]" ng-change="validateBtnS2(rhom.id)">
								<label><h5 class="control-label" for="03120102">Tomado de un negocio propio</h5></label>
								</div>

								<div class="form-input">
								<input type="checkbox" name="adquiere" name="otra{{rhom.id}}" id="otra{{rhom.id}}" ng-model="FormulariorHombre.otra[rhom.id]" ng-change="validateBtnS2(rhom.id)">
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
					<button class="btn btn-success" ng-disabled="!activeBtnS2" ng-click="validateForm3(3)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>


		<!--div class="form-group has-feedback" id="div-09510105">
			<h5 class="control-label articulo" for="09510105">(09510105) Encuadernación de libros.</h5>
			<div class="col-sm-8" id="RESP_09510105" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
				<table><tbody><tr><td><h5 class="control-label" for="art_09510105">¿Como lo obtuvieron?</h5>
				</td></tr><tr><td></td><td><h5 class="control-label" for="compra_09510105">Compra o pago</h5>
			</td><td><input type="checkbox" name="09510105[compra]" value="09510105_1" id="art_09510105_1" class="ops_1"></td></tr><tr><td></td><td><h5 class="control-label" for="09510105">Recibido por trabajo</h5>
		</td><td><input type="checkbox" name="09510105[recibido_pago]" value=" value=" 09510105_2'="" id="articulo_09510105_2" class="ops_1"></td></tr><tr><td></td><td><h5 class="control-label" for="09510105">Regalo o donación</h5>
	</td><td><input type="checkbox" name="09510105[regalo]" value="09510105_3" id="articulo_09510105_3" class="ops_1"></td></tr><tr><td></td><td><h5 class="control-label" for="09510105">Intercambio</h5>
</td><td><input type="checkbox" name="09510105[intercambio]" value="09510105_4" id="articulo_09510105_4" class="ops_1"></td></tr><tr><td></td><td><h5 class="control-label" for="09510105">Producido por el hogar</h5>
</td><td><input type="checkbox" name="09510105[producido]" value="09510105_5" id="articulo_09510105_5" class="ops_1"></td></tr><tr><td></td><td><h5 class="control-label" for="09510105">Tomado de un negocio propio</h5>
</td><td><input type="checkbox" name="09510105[negocio_propio]" value="09510105_6" id="articulo_09510105_6" class="ops_1"></td></tr><tr><td></td><td><h5 class="control-label" for="09510105">Otra forma</h5>
</td><td><input type="checkbox" name="09510105[otra]" value="09510105_7" id="articulo_09510105_7" class="ops_1"></td></tr></tbody></table><hr>
</div>
</div-->

		
	</div>
</div>