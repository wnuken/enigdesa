<div ng-controller="seccionsController">
	<div class="ff">
		<input type="hidden" name="idSection" id="idSection" value="<?php echo $idSection; ?>">
		<input type="hidden" name="idFormulario" id="idFormulario" value="<?php echo $this->session->userdata("id_formulario"); ?>">
		<div ng-init="pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="Formulario.pagesection = <?php echo $pageSection; ?>"></div>
		<div ng-init="Formulario.idSection = '<?php echo $idSection; ?>'"></div>
		<div ng-init="Formulario.idFormulario = <?php echo $this->session->userdata("id_formulario"); ?>"></div>
		<div ng-init="Formulario.idVariable = '<?php echo $idVariable; ?>'"></div>
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
	<div ng-if="pagesection == 0">
		<div class="row">
			<div class="col-sm-12 col-md-offset-1">
				<fieldset>
					<form class="form-enph" id="Page0" name="Page0" class="Page0">
						<div class="row">
							<div class="form-group has-feedback" id="div-P10260D11">
								<div class="col-sm-12">
									<label class="control-label"><?php echo $TITULO4; ?></label>
								</div>
								<div class="col-sm-8" id="page0">
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
				<div class="col-sm-12" id="mensaje_" ng-if="continue[0] == 1">
					<div class="col-sm-8">
						<div class="alert alert-warning" role="alert">
							<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
							Debe elegir una opción para continuar.
						</div>
					</div>
				</div>
				<div class="row text-center" ng-if="Page0.$valid">
					<button class="btn btn-success"  ng-click="validateForm1(1)" id="ENV_2_2">Guardar y Continuar <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span></button>
				</div>
				<div class="row text-center" ng-if="!Page0.$valid">
					<button class="btn btn-success" ng-click="validateContinue(0)" id="ENV_2_2">Guardar y Continuar
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
					</button>
				</div>

			</div>
		</div>
	</div>
	<div ng-if="pagesection == 1">
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-8">
					<label class="control-label"><?php echo $TITULO5; ?></label>
				</div>
			</div>
			<div class="col-sm-12">
				<form class="form-enph" id="Page1" name="Page1" class="Page1">
					<div class="row">
						<div ng-repeat="rhom in Formulario.rh">
							<div class="form-group has-feedback" id="div-{{rhom.id}}">
								<div class="col-sm-8" id="page1">
									<div class="checkbox">
										<input type="checkbox" 
										class="form-control" 
										name="{{rhom.id}}" id="{{rhom.id}}" 
										ng-model="Formulario.rh[$index].value" ng-change="validateBtnS1($index)">										
										<label><b>{{ rhom.name }}</b></label>										
									</div>
								</div>

								<div class="row">
									<div class="col-sm-8" id="RESP_02110100" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">

										<hr>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="col-sm-12" id="mensaje_" ng-if="continue[1] == 1">
					<div class="col-sm-8">
						<div class="alert alert-warning" role="alert">
							<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
							Debe elegir al menos una de las opciones para continuar.
						</div>
					</div>
				</div>
				<div class="row text-center" ng-if="activeBtnS1">
					<button class="btn btn-success" id="ENV_2_2" data-toggle="modal" data-target="#modalPage1">Guardar y Continuar
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
					</button>
				</div>
				<div class="row text-center" ng-if="!activeBtnS1">
					<button class="btn btn-success" ng-click="validateContinue(1)" id="ENV_2_2">Guardar y Continuar
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
					</button>
				</div>
			</div>
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
						<button type="button" class="btn btn-success" ng-click="validateForm2(2)">Continuar</button>
					</div>
				</div>
			</div>
		</div> 
		<!-- Modal -->
	</div>
	<div ng-if="pagesection == 2">
		<div class="col-sm-12">
			<div class="col-sm-8">
				<label class="control-label"><?php echo $TITULO6; ?>?</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<form class="form-enph" id="Page2" name="Page2" class="Page2">
					<div class="row">
						<div ng-repeat="rhom in Formulario.rh">
							<div ng-if="rhom.value == true">
								<div class="form-group has-feedback" id="div-{{rhom.id}}">
									<div class="col-sm-12">
										<div class="col-sm-12">
											<label><h3 class="control-label" for="{{rhom.id}}">{{ rhom.name }}</h3></label>
											<br>
											<label>¿Cómo lo obtuvieron?</label>
										</div>
										<div class="col-sm-2"></div>
										<div class="col-sm-10" id="itemGroup{{rhom.id}}">
											<div class="checkbox">
												<input type="hidden" name="{{rhom.id}}" id="{{rhom.id}}" ng-model="validateGroup[$index]" required>
												
												<input type="checkbox" class="form-control" name="compra{{rhom.id}}" class="ops_1" id="compra{{rhom.id}}" ng-true-value="1" ng-false-value="0"
												ng-model="Formulario.rh[$index].ot.COMPRA" ng-change="validateBtnS2($index, rhom.id)">
												<label><b>Compra o pago</b></label>
											</div>

											<div class="checkbox">
												
												<input type="checkbox" class="form-control" name="recibo{{rhom.id}}" id="recibo{{rhom.id}}" ng-true-value="1" ng-false-value="0"
												ng-model="Formulario.rh[$index].ot.RECIBIDO_PAGO" ng-change="validateBtnS2($index, rhom.id)">
												<label><b>
													Recibido como pago por trabajo
													<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip[$index] = true" ng-mouseleave="showTooltip[$index] = false">(?)
													</a></b>
													<tooltip  ng-show="showTooltip[$index]"
													style="position: absolute;
													max-width: 300px;
													background: #fff;
													left: 236px;
													top: -6px;
													padding: 10px;
													background: rgb(255, 255, 255);
													border: solid #ccc; z-index: 10;">
													Los bienes y servicios adquiridos por el hogar que cubren una parte o el total del pago por su trabajo.
												</tooltip>
											</label>
										</div>
										<div class="checkbox">
											<input type="checkbox" class="form-control" name="regalo{{rhom.id}}" id="regalo{{rhom.id}}" ng-true-value="1" ng-false-value="0"
											ng-model="Formulario.rh[$index].ot.REGALO" ng-change="validateBtnS2($index, rhom.id)">
											<label><b>Regalo o donación</b>
											</label>
										</div>

										<div class="checkbox">
											<input type="checkbox" class="form-control" name="intercambio{{rhom.id}}" id="intercambio{{rhom.id}}" ng-true-value="1" ng-false-value="0"
											ng-model="Formulario.rh[$index].ot.INTERCAMBIO" ng-change="validateBtnS2($index, rhom.id)">
											<label><b>Intercambio</b>
											</label>
										</div>

										<div class="checkbox">
											<input type="checkbox" class="form-control" name="producido{{rhom.id}}" id="producido{{rhom.id}}" ng-true-value="1" ng-false-value="0"
											ng-model="Formulario.rh[$index].ot.PRODUCIDO" ng-change="validateBtnS2($index, rhom.id)">
											<label><b>Producido por el hogar
												<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip1[$index] = true" ng-mouseleave="showTooltip1[$index] = false">(?)
												</a></b>
												<tooltip  ng-show="showTooltip1[$index]"
												style="position: absolute;
												max-width: 300px;
												background: #fff;
												left: 181px;
												top: -6px;
												padding: 10px;
												background: rgb(255, 255, 255);
												border: solid #ccc; z-index: 10;">
												Se refiere a los bienes y servicios adquiridos por el hogar y que fueron producidos en la propia explotación agraria, fábrica o taller por alguno de los miembros del hogar y consumida por ellos mismos.
											</tooltip>
										</label>
									</div>
									<div class="checkbox">
										<input type="checkbox" class="form-control" name="propio{{rhom.id}}" id="propio{{rhom.id}}" ng-true-value="1" ng-false-value="0"
										ng-model="Formulario.rh[$index].ot.NEGOCIO_PROPIO" ng-change="validateBtnS2($index, rhom.id)">
										<label><b>Tomado de un negocio propio
											<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip2[$index] = true" ng-mouseleave="showTooltip2[$index] = false">(?)
											</a></b>
											<tooltip  ng-show="showTooltip2[$index]"
											style="position: absolute;
											max-width: 300px;
											background: #fff;
											left: 225px;
											top: -6px;
											padding: 10px;
											background: rgb(255, 255, 255);
											border: solid #ccc; z-index: 10;">
											Cuando el hogar tiene un negocio propio en el que adquiere artículos para venderlos y obtener así ingresos, y toma parte de esos artículos para su propio consumo.
										</tooltip>
									</label>
								</div>
								<div class="checkbox">									
									<input type="checkbox" class="form-control" name="otra{{rhom.id}}" id="otra{{rhom.id}}" ng-true-value="1" ng-false-value="0"
									ng-model="Formulario.rh[$index].ot.OTRA" ng-change="validateBtnS2($index, rhom.id)">
									<label><b>Otra forma
										<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip3[$index] = true" ng-mouseleave="showTooltip3[$index] = false">(?)
										</a></b>
										<tooltip  ng-show="showTooltip3[$index]"
										style="position: absolute;
										max-width: 300px;
										background: #fff;
										left: 110px;
										top: -6px;
										padding: 10px;
										background: rgb(255, 255, 255);
										border: solid #ccc; z-index: 10;">
										Se refiere a otras formas distintas a las mencionadas; por ejemplo: un jabón fiado en una tienda de barrio.
									</tooltip>					
								</label>
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
<div class="col-sm-12" id="mensaje_" ng-if="continue[2] == 1">
	<div class="col-sm-8">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
			Por cada item debe elegir almenos una opción.
		</div>
	</div>
</div>

<div class="row text-center" ng-if="Page2.$valid">
	<button class="btn btn-success" id="ENV_2_2" data-toggle="modal" data-target="#modalPage2">Guardar y Continuar
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
	</button>
</div>
<div class="row text-center" ng-if="!Page2.$valid">
	<button class="btn btn-success" ng-click="validateContinue(2)" id="ENV_2_2">Guardar y Continuar
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
	</button>
</div>

</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalPage2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
				<button type="button" class="btn btn-success" ng-click="validateForm3(3)">Continuar</button>
			</div>
		</div>
	</div>
</div> 
<!-- Modal -->
</div>
<div ng-if="pagesection == 3">

	<form class="form-enph" id="Page3" name="Page3" class="Page3">
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
				<tr align="center" ng-repeat="rhom in Formulario.rh" ng-if="rhom.ot.COMPRA === 1 && rhom.value == true">
					<td align="left">
						{{rhom.name}}
					</td>
					<td>
						<div class="form-group">
							<div ng-if="!Formulario.rh[$index].pa.VALOR_PAGADO1">
								<input class="form-control" type="text" name="pagado{{rhom.id}}" id="pagado{{rhom.id}}"
								ng-model="VALOR_PAGADO[$index]"
								ng-disabled="Formulario.rh[$index].pa.VALOR_PAGADO1" 
								ng-change="sumValor($index, rhom.id); removeAlert('pagado{{rhom.id}}')" required>
								<input type="hidden" name="valorp{{$index}}" ng-model="Formulario.rh[$index].pa.VALOR_PAGADO" required>
								<label ng-show="Formulario.rh[$index].pa.VALOR_PAGADO < minPage3"
								style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
								Digite un valor mayor de {{minPage3}}.
							</label>
							<label ng-show="Formulario.rh[$index].pa.VALOR_PAGADO > maxPage3"
								style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
								Digite un valor menor de {{maxPage3}}.
							</label>
							<label id="pagado{{rhom.id}}Error" class="hide" 
							style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
							El campo es obligatorio.
						</label>
					</div>
					<div ng-if="Formulario.rh[$index].pa.VALOR_PAGADO1">
						<input 	class="form-control isnumeric" type="text" name="pagado1{{rhom.id}}" id="pagado1{{rhom.id}}" 
						disabled>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group">
					<input name="pagado{{rhom.id}}1" id="pagado{{rhom.id}}1" type="checkbox" class="form-control"
					ng-model="Formulario.rh[$index].pa.VALOR_PAGADO1"
					ng-change="resValor($index)"> 
				</div>
			</td>
			<td>
				<div ng-if="rhom.DEFINE_LUGAR_COMPRA == 1">
					<select name="sellugar{{rhom.id}}" id="sellugar{{rhom.id}}" class="form-control" ng-model="Formulario.rh[$index].pa.LUGAR_COMPRA" required ng-change="removeAlert('sellugar{{rhom.id}}')">
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
						<option value="21"> Feria especializada: artesanal, del libro , del hogar, de computadores, etc.</option>
						<option value="22">A través de Internet</option>
						<option value="23">Televentas y ventas por catálogo</option>
						<option value="24">Otro</option>
						<option value="26">En el exterior (fuera del país)</option>
					</select>
					<label id="sellugar{{rhom.id}}Error" class="hide"
					style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
					Selecione una opción
				</label>
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
				ng-model="Formulario.rh[$index].pa.FRECUENCIA_COMPRA"
				ng-change="removeAlert('selfre{{rhom.id}}')" required>
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
			<label id="selfre{{rhom.id}}Error" class="hide" 
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Selecione una opción.
		</label>
	</div>
</td>
</tr>
<tr align="center" class="">
	<td><b>SUBTOTAL</b></td>
	<td>
		<input class="form-control" readonly type="text" name="txt_total" id="txt_total" ng-model="subtotal">
	</td>
	<td colspan="3">&nbsp;</td>
</tr>
<tr align="center" class="">
	<td colspan="2">El medio de pago usado PRINCIPALMENTE para comprar los articulos y servicios enunciados en este módulo fue:</td>
	<td colspan="2"> 
		<div class="form-group">
			<select name="mediopago" id="mediopago" class="form-control" 
			ng-model="Formulario.mp['<?php echo $MEDIO_PAGO; ?>']" 
			ng-change="removeAlert('mediopago')" required>
			<option value="" disabled>Seleccione...</option>
			<option value="1">Tarjeta débito</option>
			<option value="2">Tarjeta crédito</option>
			<option value="3">Efectivo</option>
			<option value="4">Bonos</option>
			<option value="5">Cheques</option>
			<option value="6">Otro</option>
		</select>
		<label id="mediopagoError" class="hide" 
		style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
		Selecione una opción	.
	</label>
</div>
</td>
<td >
	<div class="form-group" ng-if="Formulario.mp['<?php echo $MEDIO_PAGO; ?>'] == 6">
		<input class="form-control" name="cual" id="cual" type="text" placeholder="¿Cual?" 
		ng-model="Formulario.mp['<?php echo $MEDIO_CUAL ; ?>']" 
		ng-change="removeAlert('cual{{rhom.id}}')" required>
		<label id="cual{{rhom.id}}Error" class="hide" 
		style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
		El campo es obligatorio.
	</label>
</div>
</td>
</tr>
</tbody>
</table>
</form>
<div class="col-sm-12" id="mensaje_" ng-if="continue[3] == 1">
	<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
		Debe llenar los campos requeridos para continuar.
	</div>
</div>
<div class="col-sm-12" id="mensaje_" ng-if="errorVcomprado">
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
		los campos <strong>Valor Pagado</strong> deben ser iguales o mayores a<strong> 1000!</strong>
	</div>
</div>
<div class="row text-center" ng-if="Page3.$valid">
	<button class="btn btn-success" id="ENV_2_2" data-toggle="modal" data-target="#modalPage3">Guardar y Continuar
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
	</button>
</div>
<div class="row text-center" ng-if="!Page3.$valid">
	<button class="btn btn-success" ng-click="validateContinue(3)" id="ENV_2_2">Guardar y Continuar
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
	</button>
</div>
<!-- Modal -->
<div class="modal fade" id="modalPage3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
				<button type="button" class="btn btn-success" ng-click="validateForm4(4)">Continuar</button>
			</div>
		</div>
	</div>
</div> 
<!-- Modal -->
</div>
<div ng-if="pagesection == 4">
	<div class="col-sm-12">
		<form id="Page4" name="Page4">
			<div class="table-responsive">
				<table class="table">
					<tr class="active">
						<th colspan="13"><div class="text-center">Si lo hubiera tenido que comprar, ¿cuánto habría pagado por el bien o servicio?</div></th>
					</tr>
					<tr>
						<th rowspan="2">Nombre del artículo o servicio ADQUIRIDO por otras formas diferentes a la compra</th>
						<th colspan="2">adquirido como pago por TRABAJO</th>
						<th colspan="2">adquirido como REGALO o DONACIÓN</th>
						<th colspan="2">adquirido como INTERCAMBIO</th>
						<th colspan="2">PRODUCIDO por el HOGAR</th>
						<th colspan="2">tomado de un NEGOCIO PROPIO</th>
						<th colspan="2">adquirido de OTRA FORMA?</th>
					</tr>
					<tr>
						<th>Valor estimado
							<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip4[$index] = true" ng-mouseleave="showTooltip4[$index] = false">(?)
							</a>
							<tooltip  ng-show="showTooltip4[$index]"
							style="position: absolute;
							max-width: 300px;
							background: #fff;
							left: 125px;
							top: 185px;
							padding: 10px;
							background: rgb(255, 255, 255);
							border: solid #ccc; z-index: 10;">
							Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado.
						</tooltip>
					</th>
					<th>No sabe el valor estimado</th>
					<th>Valor estimado
						<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip5[$index] = true" ng-mouseleave="showTooltip5[$index] = false">(?)
						</a>
						<tooltip  ng-show="showTooltip5[$index]"
						style="position: absolute;
						max-width: 300px;
						background: #fff;
						left: 260px;
						top: 185px;
						padding: 10px;
						background: rgb(255, 255, 255);
						border: solid #ccc; z-index: 10;">
						Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado.
					</tooltip>
				</th>
				<th>No sabe el valor estimado</th>
				<th>Valor estimado
					<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip6[$index] = true" ng-mouseleave="showTooltip6[$index] = false">(?)
					</a>
					<tooltip  ng-show="showTooltip6[$index]"
					style="position: absolute;
					max-width: 300px;
					background: #fff;
					left: 404px;
					top: 185px;
					padding: 10px;
					background: rgb(255, 255, 255);
					border: solid #ccc; z-index: 10;">
					Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado.
				</tooltip>
			</th>
			<th>No sabe el valor estimado</th>
			<th>Valor estimado
				<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip7[$index] = true" ng-mouseleave="showTooltip7[$index] = false">(?)
				</a>
				<tooltip  ng-show="showTooltip7[$index]"
				style="position: absolute;
				max-width: 300px;
				background: #fff;
				left: 550px;
				top: 185px;
				padding: 10px;
				background: rgb(255, 255, 255);
				border: solid #ccc; z-index: 10;">
				Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado.
			</tooltip>
		</th>
		<th>No sabe el valor estimado</th>
		<th>Valor estimado
			<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip8[$index] = true" ng-mouseleave="showTooltip8[$index] = false">(?)
			</a>
			<tooltip  ng-show="showTooltip8[$index]"
			style="position: absolute;
			max-width: 300px;
			background: #fff;
			left: 698px;
			top: 185px;
			padding: 10px;
			background: rgb(255, 255, 255);
			border: solid #ccc; z-index: 10;">
			Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado.
		</tooltip>

	</th>
	<th>No sabe el valor estimado</th>
	<th>Valor estimado
		<a class="ayuda" href="javascript:void(0);" ng-mouseover="showTooltip9[$index] = true" ng-mouseleave="showTooltip9[$index] = false">(?)
		</a>
		<tooltip  ng-show="showTooltip9[$index]"
		style="position: absolute;
		max-width: 300px;
		background: #fff;
		left: 847px;
		top: 185px;
		padding: 10px;
		background: rgb(255, 255, 255);
		border: solid #ccc; z-index: 10;">
		Registre el valor estimado a precios de mercado que pudo haber pagado si lo hubiera comprado.
	</tooltip>
</th>
<th>No sabe el valor estimado</th>
</tr>
<tr ng-repeat="rhom in Formulario.rh" ng-if="rhom.value === true && 
(rhom.ot.RECIBIDO_PAGO === 1 || rhom.ot.REGALO === 1 || rhom.ot.INTERCAMBIO === 1 || rhom.ot.PRODUCIDO === 1 || rhom.ot.NEGOCIO_PROPIO === 1 || rhom.ot.OTRA === 1)">
<td>{{rhom.name}}</td>
<td>
	<div class="form-group" ng-if="rhom.ot.RECIBIDO_PAGO && Formulario.otraforma[rhom.id]['<?php echo $RECIBIDO_PAGO ?>'] !== false">
		<input name="recibidopago{{rhom.id}}" id="recibidopago{{rhom.id}}" type="text" class="form-control" 
		ng-model="otraforma[rhom.id]['<?php echo $RECIBIDO_PAGO ?>']" 
		ng-change="compValor(rhom.id, '<?php echo $RECIBIDO_PAGO ?>')" required>
		<input name="recibidopago1{{rhom.id}}" id="recibidopago1{{rhom.id}}" type="hidden" class="form-control isnumeric" 
		ng-model="Formulario.otraforma[rhom.id]['<?php echo $RECIBIDO_PAGO ?>']" required is-number>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $RECIBIDO_PAGO ?>'] < minPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor mayor de {{minPage3}}.
		</label>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $RECIBIDO_PAGO ?>'] > maxPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor menor de {{maxPage3}}.
		</label>
	</div>
	<div class="form-group" ng-if="!rhom.ot.RECIBIDO_PAGO || Formulario.otraforma[rhom.id]['<?php echo $RECIBIDO_PAGO ?>'] === false">
		<input name="{{rhom.id}}" id="{{rhom.id}}" type="text" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.RECIBIDO_PAGO">
		<input name="{{rhom.id}}1" id="{{rhom.id}}1" type="checkbox" class="form-control"
		value="false" ng-click="changeValueOT(rhom.id, '<?php echo $RECIBIDO_PAGO ?>')"> 
	</div>
	<div class="form-group" ng-if="!rhom.ot.RECIBIDO_PAGO">
		<input name="value2" id="value2" type="checkbox" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.REGALO && Formulario.otraforma[rhom.id]['<?php echo $REGALO ?>'] !== false">
		<input name="regalo{{rhom.id}}" id="regalo{{rhom.id}}" type="text" class="form-control" 
		ng-model="otraforma[rhom.id]['<?php echo $REGALO ?>']" 
		ng-change="compValor(rhom.id, '<?php echo $REGALO ?>')" required>
		<input name="regalo1{{rhom.id}}" id="regalo1{{rhom.id}}" type="hidden" class="form-control isnumeric" 
		ng-model="Formulario.otraforma[rhom.id]['<?php echo $REGALO ?>']" required is-number>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $REGALO ?>'] < minPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor mayor de {{minPage3}}.
		</label>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $REGALO ?>'] > maxPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor menor de {{maxPage3}}.
		</label>
	</div>
	<div class="form-group" ng-if="!rhom.ot.REGALO || Formulario.otraforma[rhom.id]['<?php echo $REGALO ?>'] === false">
		<input name="{{rhom.id}}" id="{{rhom.id}}" type="text" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.REGALO">
		<input name="{{rhom.id}}1" id="{{rhom.id}}1" type="checkbox" class="form-control"
		value="false" ng-click="changeValueOT(rhom.id, '<?php echo $REGALO ?>')"> 
	</div>
	<div class="form-group" ng-if="!rhom.ot.REGALO">
		<input name="value2" id="value2" type="checkbox" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.INTERCAMBIO && Formulario.otraforma[rhom.id]['<?php echo $INTERCAMBIO ?>'] !== false">
		<input name="intercambio{{rhom.id}}" id="intercambio{{rhom.id}}" type="text" class="form-control" 
		ng-model="otraforma[rhom.id]['<?php echo $INTERCAMBIO ?>']" 
		ng-change="compValor(rhom.id, '<?php echo $INTERCAMBIO ?>')" required>
		<input name="intercambio1{{rhom.id}}" id="intercambio1{{rhom.id}}" type="hidden" class="form-control isnumeric" 
		ng-model="Formulario.otraforma[rhom.id]['<?php echo $INTERCAMBIO ?>']" required is-number>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $INTERCAMBIO ?>'] < minPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor mayor de {{minPage3}}.
		</label>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $INTERCAMBIO ?>'] > maxPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor menor de {{maxPage3}}.
		</label>
	</div>
	<div class="form-group" ng-if="!rhom.ot.INTERCAMBIO || Formulario.otraforma[rhom.id]['<?php echo $INTERCAMBIO ?>'] === false">
		<input name="{{rhom.id}}" id="{{rhom.id}}" type="text" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.INTERCAMBIO">
		<input name="{{rhom.id}}1" id="{{rhom.id}}1" type="checkbox" class="form-control"
		value="false" ng-click="changeValueOT(rhom.id, '<?php echo $INTERCAMBIO ?>')"> 
	</div>
	<div class="form-group" ng-if="!rhom.ot.INTERCAMBIO">
		<input name="value2" id="value2" type="checkbox" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.PRODUCIDO && Formulario.otraforma[rhom.id]['<?php echo $PRODUCIDO ?>'] !== false">
		<input name="producido{{rhom.id}}" id="producido{{rhom.id}}" type="text" class="form-control" 
		ng-model="otraforma[rhom.id]['<?php echo $PRODUCIDO ?>']"
		ng-change="compValor(rhom.id, '<?php echo $PRODUCIDO ?>')" required>
		<input name="producido1{{rhom.id}}" id="producido1{{rhom.id}}" type="hidden" class="form-control isnumeric" 
		ng-model="Formulario.otraforma[rhom.id]['<?php echo $PRODUCIDO ?>']" required is-number>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $PRODUCIDO ?>'] < minPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor mayor de {{minPage3}}.
		</label>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $PRODUCIDO ?>'] > maxPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor menor de {{maxPage3}}.
		</label>
	</div>
	<div class="form-group" ng-if="!rhom.ot.PRODUCIDO || Formulario.otraforma[rhom.id]['<?php echo $PRODUCIDO ?>'] === false">
		<input name="{{rhom.id}}" id="{{rhom.id}}" type="text" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.PRODUCIDO">
		<input name="{{rhom.id}}1" id="{{rhom.id}}1" type="checkbox" class="form-control"
		value="false" ng-click="changeValueOT(rhom.id, '<?php echo $PRODUCIDO ?>')"> 
	</div>
	<div class="form-group" ng-if="!rhom.ot.PRODUCIDO">
		<input name="value2" id="value2" type="checkbox" class="form-control" disabled> 
	</div>
</td>

<td>
	<div class="form-group" ng-if="rhom.ot.NEGOCIO_PROPIO && Formulario.otraforma[rhom.id]['<?php echo $NEGOCIO_PROPIO ?>'] !== false">
		<input name="negocio{{rhom.id}}" id="negocio{{rhom.id}}" type="text" class="form-control" 
		ng-model="otraforma[rhom.id]['<?php echo $NEGOCIO_PROPIO ?>']" 
		ng-change="compValor(rhom.id, '<?php echo $NEGOCIO_PROPIO ?>')" required>
		<input name="negocio1{{rhom.id}}" id="negocio1{{rhom.id}}" type="hidden" class="form-control isnumeric" 
		ng-model="Formulario.otraforma[rhom.id]['<?php echo $NEGOCIO_PROPIO ?>']" required is-number>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $NEGOCIO_PROPIO ?>'] < minPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor mayor de {{minPage3}}.
		</label>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $NEGOCIO_PROPIO ?>'] > maxPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor menor de {{maxPage3}}.
		</label>
	</div>
	<div class="form-group" ng-if="!rhom.ot.NEGOCIO_PROPIO || Formulario.otraforma[rhom.id]['<?php echo $NEGOCIO_PROPIO ?>'] === false">
		<input name="{{rhom.id}}" id="{{rhom.id}}" type="text" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.NEGOCIO_PROPIO">
		<input name="{{rhom.id}}1" id="{{rhom.id}}1" type="checkbox" class="form-control"
		value="false" ng-click="changeValueOT(rhom.id, '<?php echo $NEGOCIO_PROPIO ?>')"> 
	</div>
	<div class="form-group" ng-if="!rhom.ot.NEGOCIO_PROPIO">
		<input name="value2" id="value2" type="checkbox" class="form-control" disabled> 
	</div>
</td>

<td>
	<div class="form-group" ng-if="rhom.ot.OTRA && Formulario.otraforma[rhom.id]['<?php echo $OTRA ?>'] !== false">
		<input name="otra{{rhom.id}}" id="otra{{rhom.id}}" type="text" class="form-control" 
		ng-model="otraforma[rhom.id]['<?php echo $OTRA ?>']" 
		ng-change="compValor(rhom.id, '<?php echo $OTRA ?>')" required>
		<input name="otra{{rhom.id}}" id="otra{{rhom.id}}" type="hidden" class="form-control isnumeric" 
		ng-model="Formulario.otraforma[rhom.id]['<?php echo $OTRA ?>']" required is-number>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $OTRA ?>'] < minPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor mayor de {{minPage3}}.
		</label>
		<label ng-show="Formulario.otraforma[rhom.id]['<?php echo $OTRA ?>'] > maxPage3"
			style="display: inline; margin-left: 10px; color: rgb(255, 0, 0);">
			Digite un valor menor de {{maxPage3}}.
		</label>
	</div>
	<div class="form-group" ng-if="!rhom.ot.OTRA || Formulario.otraforma[rhom.id]['<?php echo $OTRA ?>'] === false">
		<input name="{{rhom.id}}" id="{{rhom.id}}" type="text" class="form-control" disabled> 
	</div>
</td>
<td>
	<div class="form-group" ng-if="rhom.ot.OTRA">
		<input name="{{rhom.id}}1" id="{{rhom.id}}1" type="checkbox" class="form-control"
		value="false" ng-click="changeValueOT(rhom.id, '<?php echo $OTRA ?>')"> 
	</div>
	<div class="form-group" ng-if="!rhom.ot.OTRA">
		<input name="value2" id="value2" type="checkbox" class="form-control" disabled> 
	</div>
</td>
</tr>

</table>
</div>
</form>
</div>

<div class="col-sm-12" id="mensaje_" ng-if="continue[4] == 1">
	<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
		Debe llenar o completar los campos requeridos para continuar.
	</div>
</div>
<div class="row text-center" ng-if="Page4.$valid">
	<button class="btn btn-success" id="ENV_2_2" data-toggle="modal" data-target="#modalPage4">Guardar y Continuar
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
	</button>
</div>
<div class="row text-center" ng-if="!Page4.$valid">
	<button class="btn btn-success" ng-click="validateContinue(4)" id="ENV_2_2">Guardar y Continuar
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" title="Continuar"></span>
	</button>
</div>


<!-- Modal -->
<div class="modal fade" id="modalPage4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
				<button type="button" class="btn btn-success" ng-click="validateForm5(5)">Continuar</button>
			</div>
		</div>
	</div>
</div> 
<!-- Modal -->

</div>

</div>