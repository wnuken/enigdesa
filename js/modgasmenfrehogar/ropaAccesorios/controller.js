
var appGHogar = angular.module('appGHogar',['LocalStorageModule']);

appGHogar.config(function(localStorageServiceProvider){
	localStorageServiceProvider
	.setPrefix('app-hogar');
  // .setStorageType('sessionStorage');
});


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

appGHogar.controller('ropaHombre', ['$scope', 'dataService', 'localStorageService', '$window', '$filter', function($scope, dataService, localStorageService, $window, $filter) {
	
	$scope.FormulariorHombre = {};
	$scope.validateGroup = [];
	$scope.validateCompra = [];
	$scope.subtotal = 0;
	$scope.continue = [];
	$scope.VALOR_PAGADO = [];
	$scope.otraforma = [];


	var gg = {
		"ID_SECCION3": $idSection.val()
	};


	var paramsInit = {
		"elements" : {
			"ID_SECCION3": $idSection.val(),
			"ID_FORMULARIO": $idFormulario.val()
		},				
		"path": "ropaaccesorios/getelements"
	};

	dataService.getElements(paramsInit, function(dataResponse){
		$scope.FormulariorHombre.rh = dataResponse;
	});

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
			
			angular.forEach($scope.FormulariorHombre.rh, function(element, key){
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
			angular.forEach($scope.FormulariorHombre.rh, function(element, key){
				if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
					vapagado = parseInt(element.pa.VALOR_PAGADO);
					if(!isNaN(vapagado) && vapagado < 1000){
						$scope.errorVcomprado = true;
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

		}else if(page == 4){
			angular.forEach($scope.FormulariorHombre.rh, function(element, key){
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
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_VARIABLE": $scope.FormulariorHombre.idVariable,
				"VALOR_VARIABLE": $scope.FormulariorHombre.valorVariable,
				"ID_SECCION3": $scope.FormulariorHombre.idSection
			},				
			"path": "ropaaccesorios/validateinitsection"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			if($scope.FormulariorHombre.valorVariable == '1' && dataResponse.status == true){
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
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"path": "ropaaccesorios/savesetarticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
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
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"PAG_SECCION3": (params + secccion4),
			"path": "ropaaccesorios/updatearticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
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
		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
				vapagado = parseInt(element.pa.VALOR_PAGADO);
				if(!isNaN(vapagado) && vapagado < 1000){
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
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_SECCION3": $scope.FormulariorHombre.idSection,
				"MEDIO_PAGO": $scope.FormulariorHombre.mp,
				"path": "ropaaccesorios/updatecompra"
			};

			angular.forEach($scope.FormulariorHombre.rh, function(element, key){
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
			
		// var prggr = '';
		prggr = angular.fromJson($scope.FormulariorHombre.otraforma);


		var paramssec4 = {
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"OTRA_PAGO": prggr,
			"path": "ropaaccesorios/updateotros"
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
		console.log($scope.FormulariorHombre);
		$scope.activeBtnS1 = false;
		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				$scope.activeBtnS1 = element.value
				$("div#page1").removeClass('alert alert-danger');
			}
		});
		console.log($scope.activeBtnS1);
	};

	$scope.validateBtnS2 = function(index, idGroup){
		console.log($scope.FormulariorHombre.rh, ' ', index);

		$("div#itemGroup" + idGroup).removeClass('alert alert-danger');		
		$scope.validateGroup[index] = '';
		angular.forEach($scope.FormulariorHombre.rh[index].ot, function(element, key){
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

		if(pagadoReal > 5000000){
			pagadoReal = 5000000;
			$scope.VALOR_PAGADO[index] = '$5.000.000';
		}

		if(typeof $scope.FormulariorHombre.rh[index] == 'undefined' )
			$scope.FormulariorHombre.rh[index] = [];

		if(typeof $scope.FormulariorHombre.rh[index].pa == 'undefined' )
			$scope.FormulariorHombre.rh[index].pa = {};

		if(typeof $scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO == 'undefined' )
			$scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO = '';

		$scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO = pagadoReal;

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
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
			console.log($scope.FormulariorHombre.otraforma);
		var paramsCurrency = {
			"input": $scope.otraforma[id][idElement],
			"separator": '.',
			"prefix": '$'
		};

		var resultCurrency = $filter('currency')(paramsCurrency);

		if(resultCurrency.unmask > 5000000){
			resultCurrency.mask = '$5.000.000';
			resultCurrency.unmask = 5000000;
		};

		$scope.otraforma[id][idElement] = resultCurrency.mask;

		if(typeof $scope.FormulariorHombre.otraforma == 'undefined')
			$scope.FormulariorHombre.otraforma = {};

		if(typeof $scope.FormulariorHombre.otraforma[id] == 'undefined')
			$scope.FormulariorHombre.otraforma[id] = {};

		if(typeof $scope.FormulariorHombre.otraforma[id][idElement] == 'undefined')
			$scope.FormulariorHombre.otraforma[id][idElement] = '';

		$scope.FormulariorHombre.otraforma[id][idElement] = resultCurrency.unmask;

		// console.log($scope.FormulariorHombre.otraforma);
	};

	$scope.resValor = function(index){
		if($scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO1 == true && !isNaN($scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO)){
			var pagado = parseInt($scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO);
			var subtotal = parseInt($scope.subtotal);
			if(subtotal >= pagado){
				$scope.subtotal = subtotal - pagado;
			}
			$scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO = '';
			
		}
	}

	$scope.changeValueOT = function(idElement, nameElement){
		if(typeof $scope.FormulariorHombre.otraforma == 'undefined'){
			$scope.FormulariorHombre.otraforma = [];
		};

		if(typeof $scope.FormulariorHombre.otraforma[idElement] == 'undefined'){
			$scope.FormulariorHombre.otraforma[idElement] = [];
		};

		if(typeof $scope.FormulariorHombre.otraforma[idElement][nameElement] == 'undefined' || 
			$scope.FormulariorHombre.otraforma[idElement][nameElement] !== false){
			$scope.FormulariorHombre.otraforma[idElement][nameElement] = false;
	}else if($scope.FormulariorHombre.otraforma[idElement][nameElement] === false){
		$scope.FormulariorHombre.otraforma[idElement][nameElement] = '';
	};

	console.log($scope.FormulariorHombre);
};


}]);


appGHogar.controller('Educacion', ['$scope', 'dataService', 'localStorageService', '$window', function($scope, dataService, localStorageService, $window) {
	
	$scope.FormulariorHombre = {};
	$scope.validateGroup = [];
	$scope.validateCompra = [];
	$scope.subtotal = 0;

	var gg = {
		"ID_SECCION3": $idSection.val()
	};

	var paramsInit = {
		"elements" : {
			"ID_SECCION3": $idSection.val(),
			"ID_FORMULARIO": $idFormulario.val()
		},				
		"path": "Educacion/getelements"
	};

	dataService.getElements(paramsInit, function(dataResponse){
		$scope.FormulariorHombre.rh = dataResponse;
		console.log(dataResponse);
	});

	$scope.pagesection = '';

	$scope.validateForm1 = function(params){
		var paramssec0 = {
			"elements" : {
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_VARIABLE": $scope.FormulariorHombre.idVariable,
				"VALOR_VARIABLE": $scope.FormulariorHombre.valorVariable,
				"ID_SECCION3": $scope.FormulariorHombre.idSection
			},				
			"path": "Educacion/validateinitsection"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			if($scope.FormulariorHombre.valorVariable == '1' && dataResponse.status == true){
				$scope.pagesection = params;
			}else{
				console.log('regarga pagina');
				$window.location.reload();
			}
		});	
	};

	$scope.validateForm2 = function(params){
		var paramssec1 = {
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"path": "Educacion/savesetarticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				paramssec1[key] = element.id;
			}
		});
		dataService.saveElements(paramssec1, function(dataResponse){
			if(dataResponse.result == true && dataResponse.control == true){
				$scope.pagesection = params;
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
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"PAG_SECCION3": (params + secccion4),
			"path": "Educacion/updatearticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				paramssec2[element.id] = element.ot;
			}
		});

		dataService.saveElements(paramssec2, function(dataResponse){
			if(dataResponse.result == true){
				$scope.pagesection = (params + secccion4);
			}else{
				console.log(dataResponse);
			}
		});

	};

	$scope.validateForm4 = function(params){
		$scope.errorVcomprado = false;
		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
				vapagado = parseInt(element.pa.VALOR_PAGADO);
				if(!isNaN(vapagado) && vapagado < 500){
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
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_SECCION3": $scope.FormulariorHombre.idSection,
				"MEDIO_PAGO": $scope.FormulariorHombre.mp,
				"path": "Educacion/updatecompra"
			};

			angular.forEach($scope.FormulariorHombre.rh, function(element, key){
				if(element.value == true){
					paramssec3[element.id] = element.pa;
				}
			});

			dataService.saveElements(paramssec3, function(dataResponse){
				console.log(dataResponse);
				if(dataResponse.result == true){
					$scope.pagesection = params;
				}else{
					console.log(dataResponse);
				};
			});


		}

	};

	$scope.validateForm5 = function(params){
		var paramssec4 = {};
		if($scope.FormulariorHombre.idSection == 'D6'){
			var paramssec4 = {
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_SECCION3": $scope.FormulariorHombre.idSection,
				"OTRA_PAGO": $scope.FormulariorHombre.otraforma,
				"path": "ropaaccesorios/updateotros"
			};
		}else{
			var paramssec4 = {
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_SECCION3": $scope.FormulariorHombre.idSection,
				"OTRA_PAGO": $scope.FormulariorHombre.otraforma,
				"path": "Educacion/updateotros"
			};
		};

		dataService.saveElements(paramssec4, function(dataResponse){
			if(dataResponse.result == true){
				$window.location.reload();
			}else{
				console.log(dataResponse);
			};
		});
	};

	

	$scope.validateBtnS1 = function(index){
		console.log($scope.FormulariorHombre);
		$scope.activeBtnS1 = false;
		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				$scope.activeBtnS1 = element.value;
			}
		});
		// console.log($scope.activeBtnS1);
	};

	$scope.validateBtnS2 = function(index){
		
		$scope.validateGroup[index] = '';
		angular.forEach($scope.FormulariorHombre.rh[index].ot, function(element, key){
			console.log(element);
			if(element == true)
				$scope.validateGroup[index] = true;

			if(key == "COMPRA")
				$scope.validateCompra[index] = element;
		});

		//console.log($scope.elid);
	};

	$scope.sumValor = function(index){
		console.log($scope.FormulariorHombre);
		var subt = 0;
		var vapagado = 0; 
		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if( typeof element.pa != 'undefined' && !isNaN(element.pa.VALOR_PAGADO)){
				vapagado = parseInt(element.pa.VALOR_PAGADO);
				if(!isNaN(vapagado))
					subt = subt + vapagado;
			}
		});
		$scope.subtotal = subt;
	};

	$scope.resValor = function(index){
		if($scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO1 == true && !isNaN($scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO)){
			var pagado = parseInt($scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO);
			var subtotal = parseInt($scope.subtotal);
			if(subtotal >= pagado){
				$scope.subtotal = subtotal - pagado;
			}
			$scope.FormulariorHombre.rh[index].pa.VALOR_PAGADO = '';
			
		}
	}

	$scope.changeValueOT = function(idElement, nameElement){
		if(typeof $scope.FormulariorHombre.otraforma == 'undefined'){
			$scope.FormulariorHombre.otraforma = [];
		};

		if(typeof $scope.FormulariorHombre.otraforma[idElement] == 'undefined'){
			$scope.FormulariorHombre.otraforma[idElement] = [];
		};

		if(typeof $scope.FormulariorHombre.otraforma[idElement][nameElement] == 'undefined' || 
			$scope.FormulariorHombre.otraforma[idElement][nameElement] !== false){
			$scope.FormulariorHombre.otraforma[idElement][nameElement] = false;
	}else if($scope.FormulariorHombre.otraforma[idElement][nameElement] === false){
		$scope.FormulariorHombre.otraforma[idElement][nameElement] = '';
	};

	console.log($scope.FormulariorHombre);
};


}]);

appGHogar.controller('SeecionC', ['$scope', 'dataService', 'localStorageService', '$window', function($scope, dataService, localStorageService, $window) {

	console.log('hola');
	$scope.meses = [
	{
		"id": "97",
		"value": "Menos de un mes"
	},
	{
		"id": "2",
		"value": "2"
	},
	{
		"id": "3",
		"value": "3"
	}
	];

	$scope.servicios = [
	{
		"id": "P852055",
		"servicio": "Acueducto",
		'idValor': "P10272S1A1",
		"idMes": "P10272S1A2_1",
		"idVerifica": "P10272S1A3_1"
	},
	{
		"id": "P852054",
		"servicio": "Recolección de basuras y aseo",
		'idValor': "P10272S2A1",
		"idMes": "P10272S1A2_2",
		"idVerifica": "P10272S1A3_2"
	},
	{
		"id": "P852053",
		"servicio": "Alcantarillado",
		'idValor': "P10272S3A1",
		"idMes": "P10272S1A2_3",
		"idVerifica": "P10272S1A3_3"
	},
	{
		"id": "P852051",
		"servicio": "Energía eléctrica",
		'idValor': "P10272S4A1",
		"idMes": "P10272S1A2_4",
		"idVerifica": "P10272S1A3_4"
	},
	{
		"id": "P852052",
		"servicio": "Gas natural por tubería",
		'idValor': "P10272S6A1",
		"idMes": "P10272S1A2_6",
		"idVerifica": "P10272S1A3_6"
	},
	{
		"id": "P164651",
		"servicio": "Teléfono residencial (local y larga distancia)",
		'idValor': "P10272S7A1",
		"idMes": "P10272S1A2_7",
		"idVerifica": "P10272S1A3_7"
	},
	{
		"id": "P164653",
		"servicio": "Internet fijo (banda ancha, acceso inalámbrico)",
		'idValor': "P10272S8A1",
		"idMes": "P10272S1A2_8",
		"idVerifica": "P10272S1A3_8"
	},
	{
		"id": "P164652",
		"servicio": "Televisión (cable, satelital, digitalizada, IPTV, antena parabólica)",
		'idValor': "P10272S9A1",
		"idMes": "P10272S1A2_9",
		"idVerifica": "P10272S1A3_9"
	}
	];

	$scope.alumbrado = [
	{
		"id": "P1027255",
		"servicio": "Alumbrado público",
		'idValor': "P10272S5A1",
		"idMes": "P10272S1A2_5",
		"idVerifica": "P10272S1A3_5"
	}
	];

	$scope.Formulario = {};
	$scope.validateGroup = [];
	$scope.subtotal = 0;

	var gg = {
		"ID_SECCION3": $idSection.val()
	};

	/*var paramsInit = {
		"elements" : {
			"ID_SECCION3": "D3"
		},				
		"path": "ViviendaServicios/getelements"
	};

	dataService.getElements(paramsInit, function(dataResponse){
		$scope.Formulario.rh = dataResponse;
	});*/


	$scope.validateForm1 = function(params){
		var paramssec0 = {
			"elements" : {
				"ID_FORMULARIO": $scope.Formulario.idFormulario,
				"ID_VARIABLE": $scope.Formulario.idVariable,
				"VALOR_VARIABLE": $scope.Formulario.valorVariable,
				"ID_SECCION3": $scope.Formulario.idSection
			},				
			"path": "ViviendaServicios/validateinitsection"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			console.log(dataResponse);
			if($scope.Formulario.valorVariable == '1' && dataResponse.status == true){
				$scope.pagesection = params;
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
			"path": "ViviendaServicios/saveseccionc"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			console.log(dataResponse);
			if(dataResponse.status == true){
				$scope.pagesection = params;
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
		$scope.Formulario.servicios[idValor] = value;
	}


}]);