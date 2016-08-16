<div ng-controller="SeccionC">
	<div class="hide">
		<div ng-init="baseurl = '<?php echo base_url(); ?>'"></div>
		<input type="hidden" name="idSection" id="idSection" value="<?php echo $idSection; ?>">
		<input type="hidden" name="idFormulario" id="idFormulario" value="<?php echo $this->session->userdata("id_formulario"); ?>">
		<div ng-init="pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="Formulario.pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="Formulario.idSection = '<?php echo $idSection; ?>'"></div>
		<div ng-init="Formulario.idFormulario = <?php echo $this->session->userdata("id_formulario"); ?>"></div>
		<div ng-init="Formulario.idVariable = '<?php echo $idVariable; ?>'"></div>
		<div ng-init="servicios[4].value = '<?php echo $variable; ?>'"></div>
	</div>
	<div class="title">
		<div class="row">
			<hr>
			<div class="col-sm-2">
				<img src="<?php echo base_url('images/' . $LOGO); ?>" alt="logo">
			</div>
			<div class="col-sm-8">
				<h3><font color="#ec971f"><?php echo $TITULO1; ?></font></h3>
				<h4><?php echo $TITULO2; ?></h4>
				<h4><?php echo $TITULO3; ?></h4>
			</div>
		</div>
	</div>
	<div ng-if="pagesection == 1" id="pagesection1" class="hide">
		<div class="row">
			<div class="col-sm-12 col-md-offset-1">
				<fieldset>
					<form class="form-enph" id="FormServicios" name="FormServicios" class="FormServicios">
						<div class="row">
							<div class="form-group has-feedback" id="div-P10260D11">
								<div class="col-sm-12">
									<label class="control-label">¿Su vivienda cuenta con el servicio de alumbrado público?</label>
								</div>
								<div class="col-sm-12" id="page0">
									<div>
										<label><input type="radio" name="inititalvalue" ng-value="1" id="inititalvalue1" 
											ng-model="Formulario.valorVariable" 
											ng-change="removeAlert('page0')" required>
											Si</label>
										</div>
										<br>
										<div>
											<label><input type="radio" name="inititalvalue" ng-value="0" id="inititalvalue2" 
												ng-model="Formulario.valorVariable"
												ng-change="removeAlert('page0')">
												No</label>
											</div>
										</div>
									</div>
									<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
										<hr>
									</div>
								</div>
							</form>
						</fieldset>
						<div class="col-sm-12" id="mensaje_" ng-if="continue[0] == 1">
							<div class="col-sm-8">
								<div class="alert alert-warning" role="alert">
									<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									Debe elegir una opción para continuar.
								</div>
							</div>
						</div>
						<div class="row text-center" ng-if="FormServicios.$valid">
							<button class="btn btn-success"  ng-click="validateForm1(2)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
						</div>
						<div class="row text-center" ng-if="!FormServicios.$valid">
							<button class="btn btn-success" ng-click="validateContinue(0)" id="ENV_2_2">Guardar y Continuar
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div ng-if="pagesection == 2" id="pagesection2" class="hide">
				<div class="row">
					<div class="col-sm-12">
						<form class="form-enph" id="FormServicios1" name="FormServicios1" class="FormServicios1">
							<div class="row">
								<div class="col-sm-12">
									<h4></h4>
									<div class="table-responsive">
										<table class="table">
											<tr class="active">
												<th>Servicio Público Domiciliario</th>
												<th><div class="text-center">
													¿Cuánto pagó este hogar la última vez por cada uno de los siguientes servicios públicos domiciliarios?
													<small>*</small>
												</div></th>
												<th>
													¿A cuántos meses correspondió ese pago?
													<small>*</small>
												</th>
												<th>
													Para dar estos datos, ¿verificó el valor con la factura del servicio?
													<small>*</small>
												</th>
											</tr>
											<tr ng-repeat="servicio in servicios track by $index" ng-if="servicio.value == 1">
												<th>{{servicio.servicio}}</th>
												<td>
													<div style="max-width: 900px;">
														<div class="col-sm-12">
															<div class="form-group" ng-if="!Formulario.valor[servicio.id]">
																<div class="input-group">
																	<span class="input-group-addon">Valor</span>
																	<input type="text" name="valor{{servicio.id}}" id="valor{{servicio.id}}" 
																	ng-change="validateValor(servicio.idValor, servicio.id); removeAlert('valor{{servicio.id}}')" 
																	ng-model="serviciosValor[servicio.idValor]" class="form-control" required>
																</div>
																<input type="hidden" name="valor{{servicio.id}}1" id="valor{{servicio.id}}1" 
																ng-model="Formulario.servicios[servicio.idValor]" class="form-control" ng-minleght="3" required>
																<label id="valor{{servicio.id}}Error" class="hide text-center" style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
																	El campo es obligatorio.
																</label>
																<label id="valor{{servicio.id}}Warning" class="hide text-center" style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
																	El valor debe ser igual o mayor a $100
																</label>
																<label id="valor{{servicio.id}}Warning1" class="hide text-center" style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
																	El valor debe ser menor o igual a $5.000.000
																</label>								
																
															</div>
															<div class="form-group" ng-if="Formulario.valor[servicio.id]">
																<div class="input-group">
																	<span class="input-group-addon">Valor</span>
																	<input type="text" name="valor{{servicio.id}}2" id="valor{{servicio.id}}2" readonly class="form-control" 
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
														<select class="form-control" name="meses" id="meses{{servicio.id}}" 
														ng-model="Formulario.servicios[servicio.idMes]"
														ng-change="removeAlert('meses{{servicio.id}}')" required>
														<option value="" selected disabled>Seleccione</option>
														<option ng-repeat="mes in meses" value="{{mes.id}}">{{mes.value}}</option>
													</select>
													<label id="meses{{servicio.id}}Error" class="hide text-center" style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
														Debe escoger un valor
													</label>													
												</div>
											</td>
											<td>
												<div id="verifica{{servicio.id}}">
													<div class="col-sm-3">
														<label >Si</label>
														<div class="form-group">
															<input type="radio" name="verifica{{servicio.id}}" value="1" 
															ng-model="Formulario.servicios[servicio.idVerifica]" 
															ng-change="removeAlert('verifica{{servicio.id}}')" required>
														</div>
													</div>
													<div class="col-sm-3">
														<label >No</label>
														<div class="form-group">
															<input type="radio" name="verifica{{servicio.id}}" value="2" 
															ng-model="Formulario.servicios[servicio.idVerifica]"
															ng-change="removeAlert('verifica{{servicio.id}}')">
														</div>
													</div>
													<label id="verifica{{servicio.id}}Error" class="hide text-center" style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
														Debe seleccionar una opción
													</label>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<b>Subtotal:</b>
											</td>
											<td colspan="3"><b>{{subtotal}}</b></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</form>
					<div class="row text-center" ng-if="FormServicios1.$valid">
						<button class="btn btn-success" id="ENV_2_2" data-toggle="modal" data-target="#modalPage1">Guardar y Continuar
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
						</button>
					</div>
					<div class="row text-center" ng-if="!FormServicios1.$valid">
						<button class="btn btn-success" ng-click="validateContinue(1)" id="ENV_2_2">Guardar y Continuar
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
						</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="modalPage1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Confirmación</h4>
								</div>
								<div class="modal-body">
									¿Está seguro de querer continuar? Una vez haga clic en Continuar NO podrá cambiar la información proporcionada y NO podrá regresar a esta pantalla. Si quiere editar información de estas respuestas haga clic en Cancelar.
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									<button type="button" class="btn btn-success" ng-click="validateForm2(3)">Continuar</button>
								</div>
							</div>
						</div>
					</div> 
					<!-- Modal -->

				</div>
			</div>
		</div>
		<div ng-if="pagesection == 3"></div>
	</div>
