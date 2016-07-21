<div ng-controller="SeecionC">
	<div class="hide">
		<input type="hidden" name="idSection" id="idSection" value="<?php echo $idSection; ?>">
		<input type="hidden" name="idFormulario" id="idFormulario" value="<?php echo $this->session->userdata("id_formulario"); ?>">
		<div ng-init="pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="Formulario.pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="Formulario.idSection = '<?php echo $idSection; ?>'"></div>
		<div ng-init="Formulario.idFormulario = <?php echo $this->session->userdata("id_formulario"); ?>"></div>
		<div ng-init="Formulario.idVariable = '<?php echo $idVariable; ?>'"></div>
		<div ng-init="Formulario.valorVariable = '<?php echo $variable; ?>'"></div>
	</div>
	<div class="title">
		<div class="row">
			<hr>
			<div class="col-sm-2">
				<img src="<?php echo base_url('images/' . $LOGO); ?>" alt="logo">
			</div>
			<div class="col-sm-8">
				<h2><?php echo $TITULO1; ?> {{ Formulario.idSection }}</h2>

				<blockquote>
					<small><?php echo $TITULO2; ?></small>
					<?php echo $TITULO3; ?>
				</blockquote>
			</div>



		</div>
	</div>
	<div ng-if="pagesection == 1">
		<div class="row">
			<div class="col-sm-12 col-md-offset-1">
				<fieldset>
					<form class="form-enph" id="FormAlumbrado" name="FormAlumbrado" class="FormAlumbrado">
						<div class="row">
							<div class="form-group has-feedback" id="div-P10260D11">
								<div class="col-sm-12">
									<label class="control-label">¿Su vivienda cuenta con el servicio de alumbrado público?</label>
								</div>
								<div class="col-sm-12">
									<div>
										<input type="radio" name="inititalvalue" value="1" id="inititalvalue1" ng-model="Formulario.valorVariable" required>
										<span></span><label>Si</label>
									</div>

									<br>
									<div>
										<input type="radio" name="inititalvalue" value="2" id="inititalvalue2" ng-model="Formulario.valorVariable">
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
					<button class="btn btn-success" ng-disabled="!FormAlumbrado.$valid" ng-click="validateForm1(2)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 2">
		<div class="row">
			<div class="col-sm-12">
				<form class="form-enph" id="FormServicios" name="FormServicios" class="FormServicios">
					<div class="row">
						<div class="col-sm-12">
							<h4></h4>
							<div class="table-responsive">
								<table class="table">
									<tr class="active">
										<th>Servicio Público Domiciliario</th>
										<th><div class="text-center">
										¿Cuánto pagó este hogar la última vez por cada uno de los siguientes servicios públicos domiciliarios?
										</div></th>
										<th>¿A cuántos meses correspondió ese pago?</th>
										<th>Para dar estos datos, ¿verificó el valor con la factura del servicio?</th>
									</tr>

									<tr ng-if="Formulario.valorVariable == 1" ng-repeat="servicio in alumbrado">
										<th>{{servicio.servicio}}</th>
										<td>
										<div style="max-width: 900px;">
											<div class="col-sm-12">
												<div class="form-group" ng-if="!Formulario.valor[servicio.id]">
												<div class="input-group">
													<span class="input-group-addon">Valor</span>
													<input type="text" name="valor{{servicio.id}}" id="valor{{servicio.id}}" required 
													ng-model="Formulario.servicios[servicio.idValor]" class="form-control">
													</div>
												</div>
												<div class="form-group" ng-if="Formulario.valor[servicio.id]">
												<div class="input-group">
													<span class="input-group-addon">Valor</span>
													<input type="text" name="valor{{servicio.id}}" id="valor{{servicio.id}}" readonly class="form-control" 
													ng-click="activeValor(servicio.id, servicio.idValor)">
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<label >Nada Este hogar no paga</label>
												<div class="form-group">
													<input type="radio" name="valorotro{{servicio.id}}" value="001" 
													ng-model="Formulario.valor[servicio.id]" ng-click="changeValor(servicio.idValor, '00')">
												</div>
											</div>
											<div class="col-sm-3">
												<label >No recuerda el valor</label>
												<div class="form-group">
													<input type="radio" name="valorotro{{servicio.id}}" value="98" 
													ng-model="Formulario.valor[servicio.id]" ng-click="changeValor(servicio.idValor, '98')">
												</div>
											</div>
											<div class="col-sm-6">
												<label >El valor ya fue reportado o incluido en otro servicio o valor</label>
												<div class="form-group">
													<input type="radio" name="valorotro{{servicio.id}}" value="99" 
													ng-model="Formulario.valor[servicio.id]" ng-click="changeValor(servicio.idValor, '99')">
												</div>
											</div>
											</div>
										</td>
										<td>
										<div class="form-group">
											<select class="form-control" name="meses" id="meses" required ng-model="Formulario.servicios[servicio.idMes]">
												<option value="" selected disabled>Seleccione</option>
												<option ng-repeat="mes in meses" value="{{mes.id}}">{{mes.value}}</option>
											</select>
											</div>
										</td>
										<td>
											<div class="col-sm-3">
												<label >Si</label>
												<div class="form-group">
													<input type="radio" name="verifica{{servicio.id}}" value="1" 
													ng-model="Formulario.servicios[servicio.idVerifica]" required>
												</div>
											</div>
											<div class="col-sm-3">
												<label >No</label>
												<div class="form-group">
													<input type="radio" name="verifica{{servicio.id}}" value="2" 
													ng-model="Formulario.servicios[servicio.idVerifica]">
												</div>
											</div>
										</td>
									</tr>
									<tr ng-repeat="servicio in servicios">
										<th>{{servicio.servicio}}</th>
										<td>
										<div style="max-width: 900px;">
											<div class="col-sm-12">
												<div class="form-group" ng-if="!Formulario.valor[servicio.id]">
												<div class="input-group">
													<span class="input-group-addon">Valor</span>
													<input type="text" name="valor{{servicio.id}}" id="valor{{servicio.id}}" required 
													ng-model="Formulario.servicios[servicio.idValor]" class="form-control">
													</div>
												</div>
												<div class="form-group" ng-if="Formulario.valor[servicio.id]">
												<div class="input-group">
													<span class="input-group-addon">Valor</span>
													<input type="text" name="valor{{servicio.id}}" id="valor{{servicio.id}}" readonly class="form-control" 
													ng-click="activeValor(servicio.id, servicio.idValor)">
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<label >Nada Este hogar no paga</label>
												<div class="form-group">
													<input type="radio" name="valorotro{{servicio.id}}" value="001" 
													ng-model="Formulario.valor[servicio.id]" ng-click="changeValor(servicio.idValor, '00')">
												</div>
											</div>
											<div class="col-sm-3">
												<label >No recuerda el valor</label>
												<div class="form-group">
													<input type="radio" name="valorotro{{servicio.id}}" value="98" 
													ng-model="Formulario.valor[servicio.id]" ng-click="changeValor(servicio.idValor, '98')">
												</div>
											</div>
											<div class="col-sm-6">
												<label >El valor ya fue reportado o incluido en otro servicio o valor</label>
												<div class="form-group">
													<input type="radio" name="valorotro{{servicio.id}}" value="99" 
													ng-model="Formulario.valor[servicio.id]" ng-click="changeValor(servicio.idValor, '99')">
												</div>
											</div>
											</div>
										</td>
										<td>
										<div class="form-group">
											<select class="form-control" name="meses" id="meses" required ng-model="Formulario.servicios[servicio.idMes]">
												<option value="" selected disabled>Seleccione</option>
												<option ng-repeat="mes in meses" value="{{mes.id}}">{{mes.value}}</option>
											</select>
											</div>
										</td>
										<td>
											<div class="col-sm-3">
												<label >Si</label>
												<div class="form-group">
													<input type="radio" name="verifica{{servicio.id}}" value="1" 
													ng-model="Formulario.servicios[servicio.idVerifica]" required>
												</div>
											</div>
											<div class="col-sm-3">
												<label >No</label>
												<div class="form-group">
													<input type="radio" name="verifica{{servicio.id}}" value="2" 
													ng-model="Formulario.servicios[servicio.idVerifica]">
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</form>
				<div class="row text-center">
					<button class="btn btn-success" ng-disabled="!FormServicios.$valid" ng-click="validateForm2(3)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 3"></div>
</div>
