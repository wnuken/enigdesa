
var appGHogar = angular.module('appGHogar',[]);

/*appGHogar.config(function(localStorageServiceProvider){
	localStorageServiceProvider
	.setPrefix('app-hogar');
	  // .setStorageType('sessionStorage');
	});*/


	appGHogar.service('dataService', function($http) {
	// delete $http.defaults.headers.common['X-Requested-With'];

	this.saveSection = function(params, callbackFunc) {
		$http({
			method: 'GET',
			url: params.path,
			params: params.elements,
			headers: {'Content-Type': 'application/json'},
	        /// headers: {'Authorization': 'Token token=xxxxYYYYZzzz'}
	    }).success(function(response){
	    	callbackFunc(response);
	    }).error(function(){
	    	console.log("error");
	    });
	};


	this.saveElements = function(params, callbackFunc) {
		$http({
			method: 'GET',
			url: params.path,
			params: params,
			headers: {'Content-Type': 'application/json'},
	        /// headers: {'Authorization': 'Token token=xxxxYYYYZzzz'}
	    }).success(function(response){
	    	// var res = JSON.parse(fixedResponse);
	    	callbackFunc(response);
	    }).error(function(){
	    	console.log("error");
	    });
	};


	this.getElements = function(params, callbackFunc) {
		$http({
			method: 'GET',
			url: params.path,
			params: params.elements,
			headers: {'Content-Type': 'application/json'},
	        /// headers: {'Authorization': 'Token token=xxxxYYYYZzzz'}
	    }).success(function(response){
	    	callbackFunc(response);
	    }).error(function(){
	    	console.log("error");
	    });
	};
});

	appGHogar.directive("isNumber", function() {
		return {
			require: "ngModel",
			scope: {
				isNumber: '='
			},
			link: function(scope, element, attrs, ctrl) {
				$("input.isnumeric").numeric();
			}
		};
	});

	appGHogar.directive("isCurrency", function() {
		return {
			require: "ngModel",
			scope: {
				isCurrency: '='
			},
			link: function(scope, element, attrs, ctrl) {
				$('.currency').maskMoney({precision:0, prefix:'$'});
			}
		};
	});

	/*** / filter to convert number in currency 
	*** Params:
	*** input => orginal number
	*** separator => thousands separator
	*** prefix => character to represent money
	*** return currency and orginal numbers, in the parameters mask and unmask.
	***/
	appGHogar.filter('currency', function() { 
		return function(params) {
			var numberArray = [];
			var realValue = '';
			var currencyNumber = '';
			var pountArray = [];
			var init = 0;
			var result = {
				"mask": '',
				"unmask": ''
			};

			if(typeof params.separator == 'undefined'){
				params.separator = '.';
			};

			if(typeof params.prefix == 'undefined'){
				params.prefix = '$';
			};

			if(typeof params.input != 'undefined' && params.input != ''){
				var ValueString = new String(params.input);
				angular.forEach(ValueString, function(element, key){
					if(!isNaN(key) && !isNaN(element)){
						realValue = realValue + element;
						numberArray[init] = element;
						init++;
					};		
				});
				numberArray.reverse();

				angular.forEach(numberArray, function(element, key){

					if(key != 0 && key % 3 == 0){
						pountArray[key] = element + params.separator;
					}else{
						pountArray[key] = element;
					};
				});

				pountArray.reverse();

				angular.forEach(pountArray, function(element, key){
					currencyNumber = currencyNumber + element;
				});

				currencyNumber = params.prefix + currencyNumber;
				result = {
					"mask": currencyNumber,
					"unmask": realValue
				};
			}
			return result;
		}
	});


	$idSection = $("input#idSection");
	$idFormulario = $("input#idFormulario");

	appGHogar.controller('seccionsController', ['$scope', 'dataService', '$window', '$filter', '$timeout', function($scope, dataService, $window, $filter, $timeout) {
		
		$scope.Formulario = {};
		$scope.validateGroup = [];
		$scope.validateCompra = [];
		$scope.subtotal = 0;
		$scope.continue = [];
		$scope.VALOR_PAGADO = [];
		$scope.otraforma = [];
		$scope.noValida = false;
		$scope.errorVcomprado = false;
		$scope.errorVcomprado1 = false;

		$timeout(function () {

			var paramsInit = {
				"elements" : {
					"ID_SECCION3": $idSection.val(),
					"ID_FORMULARIO": $idFormulario.val()
				},				
				"path": $scope.baseurl + "modgasmenfrehogar/ropaaccesorios/getelements"
			};

			dataService.getElements(paramsInit, function(dataResponse){
				$scope.Formulario.rh = dataResponse;
				console.log(dataResponse);
			});
			

			console.log($scope.Formulario.rh, ' ', $idSection.val());

			if($scope.Formulario.idSection == 'D1' || $scope.Formulario.idSection == 'D3' || $scope.Formulario.idSection == 'D4'){
				$scope.minPage3 = 1000;
				$scope.maxPage3 = 5000000;
			};
			if($scope.Formulario.idSection == 'D2'){
				$scope.minPage3 = 1000;
				$scope.maxPage3 = 15000000;
			};
			if($scope.Formulario.idSection == 'D5'){
				$scope.minPage3 = 1000;
				$scope.maxPage3 = 30000000;
			};
			if($scope.Formulario.idSection == 'D6' || $scope.Formulario.idSection == 'E1'){
				$scope.minPage3 = 500;
				$scope.maxPage3 = 10000000;
			};
			if($scope.Formulario.idSection == 'E2'){
				$scope.minPage3 = 500;
				$scope.maxPage3 = 30000000;
			};
			if($scope.Formulario.idSection == 'F1'){
				$scope.minPage3 = 500;
				$scope.maxPage3 = 5000000;
			};
			if($scope.Formulario.idSection == 'F2'){
				$scope.minPage3 = 1000;
				$scope.maxPage3 = 20000000;
			};
			if($scope.Formulario.idSection == 'F3'){
				$scope.minPage3 = 6000;
				$scope.maxPage3 = 30000000;
			};
		}, 500);


$scope.pagesection = '';

$scope.validateContinue = function(page){
	$scope.continue[page] = 1;

	if(page == 0){
		$("div#page0").addClass('alert alert-danger');
	}else if(page == 1){
		$("div#page1").addClass('alert alert-danger');
	}else if(page == 2){
		$elele = $("#tooltip").tooltip();
		console.log($elele);

		angular.forEach($scope.Formulario.rh, function(element, key){
			var prueba = false;
			if(element.value == true){
				angular.forEach(element.ot, function(element1, key1){
					console.log(element1);
					if(element1 == true){
						prueba = true;
					}
				});

				if(prueba == false){
					$("div#itemGroup" + element.id).addClass('alert alert-danger');
				}
			}
		});

				// $("div#itemGroup" + idItems).addClass('alert alert-danger');
			}else if(page == 3){
				$scope.errorVcomprado = false;
				$scope.errorVcomprado1 = false;
				angular.forEach($scope.Formulario.rh, function(element, key){
					if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
						vapagado = parseInt(element.pa.VALOR_PAGADO);
						if(!isNaN(vapagado) && vapagado < $scope.minPage3){
							$scope.errorVcomprado = true;
						};
						if(!isNaN(vapagado) && vapagado > $scope.maxPage3){
							$scope.errorVcomprado1 = true;
						}

					}

					if(element.value == true){
						$('input#pagado' + element.id).removeClass('alert alert-danger');
						var pagadoEmpty = $('input#pagado' + element.id).val();
						if(pagadoEmpty == '' || pagadoEmpty == null){
							$('input#pagado' + element.id).addClass('alert alert-danger');
							$('label#pagado' + element.id + 'Error').removeClass('hide');
						}

						$('select#sellugar' + element.id).removeClass('alert alert-danger');
						var sellugarEmpty = $('select#sellugar' + element.id).val();
						if(sellugarEmpty == '' || sellugarEmpty == null){
							$('select#sellugar' + element.id).addClass('alert alert-danger');
							$('label#sellugar' + element.id + 'Error').removeClass('hide');
						}

						$('select#selfre' + element.id).removeClass('alert alert-danger');
						var selfreEmpty = $('select#selfre' + element.id).val();
						if(selfreEmpty == '' || selfreEmpty == null){
							$('select#selfre' + element.id).addClass('alert alert-danger');
							$('label#selfre' + element.id + 'Error').removeClass('hide');
						}
					}
				});

				$('select#mediopago').removeClass('alert alert-danger');
				var mediopagoEmpty = $('select#mediopago').val();
				if(mediopagoEmpty == '' || mediopagoEmpty == null){
					$('select#mediopago').addClass('alert alert-danger');
					$('label#mediopagoError').removeClass('hide');
				}

				$('input#cual').removeClass('alert alert-danger');
				var mediopagoEmpty = $('input#cual').val();
				if(mediopagoEmpty == '' || mediopagoEmpty == null){
					$('input#cual').addClass('alert alert-danger');
					$('label#cualError').removeClass('hide');
				}

			}else if(page == 4){
				angular.forEach($scope.Formulario.rh, function(element, key){
					$('input#recibidopago' + element.id).removeClass('alert alert-danger');
					var recibidopagoEmpty = $('input#recibidopago' + element.id).val();
					if(recibidopagoEmpty == '' || recibidopagoEmpty == null)
						$('input#recibidopago' + element.id).addClass('alert alert-danger');

					$('input#regalo' + element.id).removeClass('alert alert-danger');
					var regaloEmpty = $('input#regalo' + element.id).val();
					if(regaloEmpty == '' || regaloEmpty == null)
						$('input#regalo' + element.id).addClass('alert alert-danger');

					$('input#intercambio' + element.id).removeClass('alert alert-danger');
					var intercambioEmpty = $('input#intercambio' + element.id).val();
					if(intercambioEmpty == '' || intercambioEmpty == null)
						$('input#intercambio' + element.id).addClass('alert alert-danger');

					$('input#producido' + element.id).removeClass('alert alert-danger');
					var producidoEmpty = $('input#producido' + element.id).val();
					if(producidoEmpty == '' || producidoEmpty == null)
						$('input#producido' + element.id).addClass('alert alert-danger');

					$('input#negocio' + element.id).removeClass('alert alert-danger');
					var negocioEmpty = $('input#negocio' + element.id).val();
					if(negocioEmpty == '' || negocioEmpty == null)
						$('input#negocio' + element.id).addClass('alert alert-danger');

					$('input#otra' + element.id).removeClass('alert alert-danger');
					var otraEmpty = $('input#otra' + element.id).val();
					if(otraEmpty == '' || otraEmpty == null)
						$('input#otra' + element.id).addClass('alert alert-danger');


				});

			};
		};

		$scope.removeAlert = function(id){
			console.log(id);
			$("#" + id).removeClass('alert alert-danger');
			$("#" + id + 'Error').addClass('hide');
		};

		$scope.validateForm1 = function(params){
			var paramssec0 = {
				"elements" : {
					"ID_FORMULARIO": $scope.Formulario.idFormulario,
					"ID_VARIABLE": $scope.Formulario.idVariable,
					"VALOR_VARIABLE": $scope.Formulario.valorVariable,
					"ID_SECCION3": $scope.Formulario.idSection
				},				
				"path": $scope.baseurl + "modgasmenfrehogar/ropaaccesorios/validateinitsection"
			};

			dataService.saveSection(paramssec0, function(dataResponse){
				if($scope.Formulario.valorVariable == '1' && dataResponse.status == true){
					// $scope.pagesection = params;
					$window.location.reload();
				}else{
					console.log('regarga pagina');
					$window.location.reload();
				}
			});	
		};

		$scope.validateForm2 = function(params){

			var paramssec1 = {
				"ID_FORMULARIO": $scope.Formulario.idFormulario,
				"ID_SECCION3": $scope.Formulario.idSection,
				"path": $scope.baseurl + "modgasmenfrehogar/ropaaccesorios/savesetarticulos"
			};

			angular.forEach($scope.Formulario.rh, function(element, key){
				if(element.value == true){
					paramssec1[key] = element.id;
				}
			});
			dataService.saveElements(paramssec1, function(dataResponse){
				if(dataResponse.result == true && dataResponse.control == true){
					// $scope.pagesection = params;
					$window.location.reload();
				}else{
					console.log(dataResponse);
				}
			});
			
		};

		$scope.validateForm3 = function(params){
			var secccion4 = 1;

			angular.forEach($scope.validateCompra, function(element, key){
				if(element == true)
					secccion4 = 0;
			});

			var paramssec2 = {
				"ID_FORMULARIO": $scope.Formulario.idFormulario,
				"ID_SECCION3": $scope.Formulario.idSection,
				"PAG_SECCION3": (params + secccion4),
				"path": $scope.baseurl + "modgasmenfrehogar/ropaaccesorios/updatearticulos"
			};

			angular.forEach($scope.Formulario.rh, function(element, key){
				if(element.value == true){
					paramssec2[element.id] = element.ot;
				}
			});

			dataService.saveElements(paramssec2, function(dataResponse){
				if(dataResponse.result == true){
					// $scope.pagesection = (params + secccion4);
					$window.location.reload();
				}else{
					console.log(dataResponse);
				}
			});
		};

		$scope.validateForm4 = function(params){
			
			$scope.errorVcomprado = false;
			angular.forEach($scope.Formulario.rh, function(element, key){
				if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
					vapagado = parseInt(element.pa.VALOR_PAGADO);
					if(!isNaN(vapagado) && vapagado < $scope.minPage3){
						$scope.errorVcomprado = true;
					}
				}
			});

			if($scope.errorVcomprado == true){
				console.log('mensaje de error');
			}else{
				$scope.errorVcomprado = false;
				console.log('se valida');

				var paramssec3 = {
					"ID_FORMULARIO": $scope.Formulario.idFormulario,
					"ID_SECCION3": $scope.Formulario.idSection,
					"MEDIO_PAGO": $scope.Formulario.mp,
					"path": $scope.baseurl + "modgasmenfrehogar/ropaaccesorios/updatecompra"
				};

				angular.forEach($scope.Formulario.rh, function(element, key){
					if(element.value == true){
						paramssec3[element.id] = element.pa;
					}
				});

				dataService.saveElements(paramssec3, function(dataResponse){
					console.log(dataResponse);
					if(dataResponse.result == true){
					// $scope.pagesection = params;
					$window.location.reload();
				}else{
					console.log(dataResponse);
				};
			});


			}

		};

		$scope.validateForm5 = function(params){

			otraPago = angular.fromJson($scope.Formulario.otraforma);


			var paramssec4 = {
				"ID_FORMULARIO": $scope.Formulario.idFormulario,
				"ID_SECCION3": $scope.Formulario.idSection,
				"OTRA_PAGO": otraPago,
				"path": $scope.baseurl + "modgasmenfrehogar/ropaaccesorios/updateotros"
			};

			console.log(paramssec4);

			dataService.saveElements(paramssec4, function(dataResponse){
				if(dataResponse.result == true){
					$window.location.reload();
				}else{
					console.log(dataResponse);
				};
			});
		};

		$scope.validateBtnS1 = function(index){
			console.log($scope.Formulario);
			$scope.activeBtnS1 = false;
			angular.forEach($scope.Formulario.rh, function(element, key){
				if(element.value == true){
					$scope.activeBtnS1 = element.value
					$("div#page1").removeClass('alert alert-danger');
				}
			});
			console.log($scope.activeBtnS1);
		};

		$scope.validateBtnS2 = function(index, idGroup){
			console.log($scope.Formulario.rh, ' ', index);

			$("div#itemGroup" + idGroup).removeClass('alert alert-danger');		
			$scope.validateGroup[index] = '';
			angular.forEach($scope.Formulario.rh[index].ot, function(element, key){
				if(element == true)
					$scope.validateGroup[index] = true;

				if(key == "COMPRA")
					$scope.validateCompra[index] = element;
			});

			//console.log($scope.elid);
		};

		$scope.sumValor = function(index, id){
			var subt = 0;
			var vapagado = 0; 

			var paramsCurrency = {
				"input": $scope.VALOR_PAGADO[index],
				"separator": '.',
				"prefix": '$'
			};

			var resultCurrency = $filter('currency')(paramsCurrency);
			$scope.VALOR_PAGADO[index] = resultCurrency.mask;
			var pagadoReal = resultCurrency.unmask;

			/*if(pagadoReal > $scope.maxPage3){
				

				var paramsCurrencyMax = {
				"input": $scope.maxPage3,
				"separator": '.',
				"prefix": '$'
			};

			var resultCurrencyMax = $filter('currency')(paramsCurrencyMax);

				pagadoReal = resultCurrencyMax.unmask;

				$scope.VALOR_PAGADO[index] = resultCurrencyMax.mask;
			};*/

			if(typeof $scope.Formulario.rh[index] == 'undefined' )
				$scope.Formulario.rh[index] = [];

			if(typeof $scope.Formulario.rh[index].pa == 'undefined' )
				$scope.Formulario.rh[index].pa = {};

			if(typeof $scope.Formulario.rh[index].pa.VALOR_PAGADO == 'undefined' )
				$scope.Formulario.rh[index].pa.VALOR_PAGADO = '';

			$scope.Formulario.rh[index].pa.VALOR_PAGADO = pagadoReal;

			angular.forEach($scope.Formulario.rh, function(element, key){
				if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
					vapagado = parseInt(element.pa.VALOR_PAGADO);
					if(!isNaN(vapagado))
						subt = subt + vapagado;
				}
			});

			var paramsCurrencySub = {
				"input": subt,
				"separator": '.',
				"prefix": '$'
			};

			var resultCurrencySub = $filter('currency')(paramsCurrencySub);

			$scope.subtotal = resultCurrencySub.mask;
		};

		$scope.compValor = function(id, idElement){
			console.log($scope.Formulario.otraforma);
			var paramsCurrency = {
				"input": $scope.otraforma[id][idElement],
				"separator": '.',
				"prefix": '$'
			};

			var resultCurrency = $filter('currency')(paramsCurrency);

			/*if(resultCurrency.unmask > $scope.maxPage3){
				resultCurrency.mask = '$5.000.000';
				resultCurrency.unmask = $scope.maxPage3;
			};*/

			$scope.otraforma[id][idElement] = resultCurrency.mask;

			if(typeof $scope.Formulario.otraforma == 'undefined')
				$scope.Formulario.otraforma = {};

			if(typeof $scope.Formulario.otraforma[id] == 'undefined')
				$scope.Formulario.otraforma[id] = {};

			if(typeof $scope.Formulario.otraforma[id][idElement] == 'undefined')
				$scope.Formulario.otraforma[id][idElement] = '';

			$scope.Formulario.otraforma[id][idElement] = resultCurrency.unmask;

			// console.log($scope.Formulario.otraforma);
		};

		$scope.resValor = function(index){
			if($scope.Formulario.rh[index].pa.VALOR_PAGADO1 == true && !isNaN($scope.Formulario.rh[index].pa.VALOR_PAGADO)){
				var pagado = parseInt($scope.Formulario.rh[index].pa.VALOR_PAGADO);

				var paramsCurrency = {
					"input": $scope.subtotal,
					"separator": '.',
					"prefix": '$'
				};

				var resultCurrency = $filter('currency')(paramsCurrency);

				var subtotal = parseInt(resultCurrency.unmask);
				if(!isNaN(pagado)){
					var totalC2 = subtotal - pagado;
					var paramsCurrency1 = {
						"input": totalC2,
						"separator": '.',
						"prefix": '$'
					};
					var resultCurrency1 = $filter('currency')(paramsCurrency1);
					$scope.subtotal = resultCurrency1.mask;
				};

				$scope.Formulario.rh[index].pa.VALOR_PAGADO = '';
				$scope.VALOR_PAGADO[index] = '';

				
			}
		}

		$scope.changeValueOT = function(idElement, nameElement){
			if(typeof $scope.Formulario.otraforma == 'undefined'){
				$scope.Formulario.otraforma = [];
			};

			if(typeof $scope.Formulario.otraforma[idElement] == 'undefined'){
				$scope.Formulario.otraforma[idElement] = [];
			};

			if(typeof $scope.Formulario.otraforma[idElement][nameElement] == 'undefined' || 
				$scope.Formulario.otraforma[idElement][nameElement] !== false){
				$scope.Formulario.otraforma[idElement][nameElement] = false;
		}else if($scope.Formulario.otraforma[idElement][nameElement] === false){
			$scope.Formulario.otraforma[idElement][nameElement] = '';
		};

		console.log($scope.Formulario);
	};


}]);


appGHogar.controller('SeccionC', ['$scope', 'dataService', '$window', '$filter', '$timeout', function($scope, dataService, $window, $filter, $timeout) {

	$scope.meses = [];
	$scope.servicios = [];
	$scope.Formulario = {};
	$scope.serviciosValor = [];
	$scope.validateGroup = [];
	$scope.subtotal = '';
	$scope.minPage3 = 100;
	$scope.maxPage3 = 5000000;

	$scope.continue = [];

	$timeout(function () {
		console.log($scope.baseurl);

		var paramsMonth = {
			"elements" : { 'value': ''},				
			"path": $scope.baseurl + "modgasmenfrehogar/ViviendaServicios/listMonth"
		};

		dataService.getElements(paramsMonth, function(dataResponse){
			$scope.meses = dataResponse;					
			if(typeof $scope.meses == 'undefined' || $scope.meses == null)
				$scope.meses = [];
		});

		var paramsServicios = {
			"elements" : { 'value': ''},				
			"path": $scope.baseurl + "modgasmenfrehogar/ViviendaServicios/listServices"
		};

		dataService.getElements(paramsServicios, function(dataResponse){
			$scope.servicios = dataResponse;					
			if(typeof $scope.servicios == 'undefined' || $scope.servicios == null)
				$scope.servicios = [];
		});

		$('div#pagesection' + $scope.pagesection).removeClass('hide');
	}, 500);

	$scope.validateContinue = function(params){
		$scope.continue[0] = 1;
		if(params == 0){
			$("div#page0").addClass('alert alert-danger');
		};
		if(params == 1){
			angular.forEach($scope.servicios, function(element, key){
				console.log(element.idValor);

				var valueElement = $("input#valor" + element.id).val();
				if(typeof valueElement !== 'undefined' && valueElement == ''){
					$("input#valor" + element.id).addClass("alert alert-danger");
					$("label#valor" + element.id + "Error").removeClass("hide");
				};

				var valueSelect = $("select#meses" + element.id).val();
				if(typeof valueSelect !== 'undefined' && valueElement == ''){
					$("select#meses" + element.id).addClass("alert alert-danger");
					$("label#meses" + element.id + "Error").removeClass("hide");
				};

				if(typeof $scope.Formulario.servicios == 'undefined')
					$scope.Formulario.servicios = {};

				if(typeof $scope.Formulario.servicios[element.idVerifica] == 'undefined'){
					$("div#verifica" + element.id).addClass("alert alert-danger");
					$("label#verifica" + element.id + "Error").removeClass("hide");
				};

			});

		};
	};

	$scope.validateValor = function(index, id){
		var paramsCurrency = {
			"input": $scope.serviciosValor[index],
			"separator": '.',
			"prefix": '$'
		};

		var resultCurrency = $filter('currency')(paramsCurrency);

		$scope.serviciosValor[index] = resultCurrency.mask;

		if(typeof $scope.Formulario.servicios == 'undefined')
			$scope.Formulario.servicios = {};

		$scope.Formulario.servicios[index] = resultCurrency.unmask;

		$scope.subtotal = 0;
		angular.forEach($scope.Formulario.servicios, function(element, key){
			console.log(element, ' ', key);
			var valueServicios = parseInt(element);
			if(!isNaN(valueServicios))
				$scope.subtotal = $scope.subtotal + valueServicios;
		});

		var paramsCurrencySubt = {
			"input": $scope.subtotal,
			"separator": '.',
			"prefix": '$'
		};

		var resultCurrencySubt = $filter('currency')(paramsCurrencySubt);
		$scope.subtotal = resultCurrencySubt.mask;



		if(resultCurrency.unmask < $scope.minPage3){
			$("label#valor" + id + "Warning").removeClass("hide");
		}else{
			$("label#valor" + id + "Warning").addClass("hide");
		};

		if(resultCurrency.unmask > $scope.maxPage3){
			$("label#valor" + id + "Warning1").removeClass("hide");
		}else{
			$("label#valor" + id + "Warning1").addClass("hide");
		};


	};

	$scope.removeAlert = function(id){
		$("#" + id).removeClass('alert alert-danger');
		$("#" + id + 'Error').addClass('hide');
	};

	$scope.validateBtnS1 = function(){

	};


	$scope.validateForm1 = function(params){
		var paramssec0 = {
			"elements" : {
				"ID_FORMULARIO": $scope.Formulario.idFormulario,
				"ID_VARIABLE": $scope.Formulario.idVariable,
				"VALOR_VARIABLE": $scope.Formulario.valorVariable,
				"ID_SECCION3": $scope.Formulario.idSection
			},				
			"path": $scope.baseurl + "modgasmenfrehogar/ViviendaServicios/validateinitsection"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			console.log(dataResponse);
			if(dataResponse.status == true){
				$window.location.reload();
			}else{
				console.log('regarga pagina');
					// $window.location.reload();
				}
			});	
	};

	$scope.validateForm2 = function(params){
		var paramssec0 = {
			"elements" : {
				"form": $scope.Formulario
			},				
			"path": $scope.baseurl + "modgasmenfrehogar/ViviendaServicios/saveseccionc"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			console.log(dataResponse);
			if(dataResponse.status == true){
					//$scope.pagesection = params;
					$window.location.reload();
				}else{
					console.log('error');
				}
			});	
	};

	$scope.activeValor = function(idServicio, idValor){
		$scope.Formulario.valor[idServicio] = false;
		$scope.Formulario.servicios[idValor] = '';
	};

	$scope.changeValor = function(idValor, value){

		var valueField = parseInt($scope.Formulario.servicios[idValor]);

		console.log(valueField);
		if(!isNaN(valueField) && valueField != 99 && valueField != 98 && valueField != 0){
			var paramsCurrencySubt = {
			"input": $scope.subtotal,
			"separator": '.',
			"prefix": '$'
		};

		var resultCurrencySubt = $filter('currency')(paramsCurrencySubt);
			var subtotal = resultCurrencySubt.unmask - valueField;

			var paramsCurrencySubt = {
			"input": subtotal,
			"separator": '.',
			"prefix": '$'
		};

		var resultCurrencySubt = $filter('currency')(paramsCurrencySubt);
			$scope.subtotal = resultCurrencySubt.mask;

		};

		$scope.Formulario.servicios[idValor] = value;
		$scope.serviciosValor[idValor] = '';
	}
}]);