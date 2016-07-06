<div ng-app="appGHogar">
<div ng-controller="ropaHombre">
<div class="row">
	<hr>
	<div class="col-sm-2">
		<img src="http://192.168.1.200/dimpe/enigdesa/images/form_icon-ingresospersonales.png">
	</div>
	<div class="col-sm-8">
		<h2>GASTOS EN PRENDAS DE VESTIR Y ACCESORIOS PERSONALES</h2>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<form class="form-enph" id="rHombre" class="rHombre">
			<div class="row">
				<div class="form-group has-feedback" id="div-P10260D11">
					<label><h4>De P10260D11 a P10260S1D11 del 2016, ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para HOMBRE?</h4></label>
					<input type="radio" name="adquiere" value="1" id="P10260D11" ng-model="FormulariorHombre.adquiere">
					<label><h5 class="control-label" for="P10260D11">Si</h5></label>
					<br>
					<input type="radio" name="adquiere" value="2" id="P10260D11" ng-model="FormulariorHombre.adquiere">
					<label><h5 class="control-label" for="P10260D11">No</h5></label>
				</div>
				<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
					<hr>
				</div>
			</div>
			<div class="row text-center">
				<button class="btn btn-success" ng-disabled="!FormulariorHombre.adquiere" ng-click="validateForm()" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
			</div>

		</form>
	</div>
</div>
</div>
</div>

<script src="<?php echo base_url("/js/angular/angular.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-local-storage.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/gasmenfrehogar/ropaAccesorios/controller.js"); ?>"></script>