
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

$idSection = $("input#idSection");
$idFormulario = $("input#idFormulario");

appGHogar.controller('ropaHombre', ['$scope', 'dataService', 'localStorageService', '$window', function($scope, dataService, localStorageService, $window) {
	
	$scope.FormulariorHombre = {};
	$scope.validateGroup = [];
	$scope.subtotal = 0;

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
			"path": "ropaaccesorios/savesetarticulos"
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
		var paramssec2 = {
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"path": "ropaaccesorios/updatearticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				paramssec2[element.id] = element.ot;
			}
		});

		dataService.saveElements(paramssec2, function(dataResponse){
			if(dataResponse.result == true){
				$scope.pagesection = params;
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
				$scope.pagesection = params;
			}else{
				console.log(dataResponse);
			};
		});


		}

	};

	$scope.validateForm5 = function(params){
		
			var paramssec4 = {
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_SECCION3": $scope.FormulariorHombre.idSection,
				"path": "ropaaccesorios/updateotros"
			};

			dataService.saveElements(paramssec4, function(dataResponse){
				console.log(dataResponse);
				console.log('Se guarda control');
				$window.location.reload();
			/*if(dataResponse.result == true){
				$scope.pagesection = params;
			}else{
				console.log(dataResponse);
			};*/
			});
	};

	$scope.validateBtnS1 = function(index){
		console.log($scope.FormulariorHombre);
		$scope.activeBtnS1 = false;
		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				$scope.activeBtnS1 = element.value
			}
		});
		console.log($scope.activeBtnS1);
	};

	$scope.validateBtnS2 = function(index){
		
		$scope.validateGroup[index] = '';
		angular.forEach($scope.FormulariorHombre.rh[index].ot, function(element, key){
			console.log(element);
			if(element == true)
				$scope.validateGroup[index] = true;
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


appGHogar.controller('Educacion', ['$scope', 'dataService', 'localStorageService', '$window', function($scope, dataService, localStorageService, $window) {
	
	$scope.FormulariorHombre = {};
	$scope.validateGroup = [];
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
		var paramssec2 = {
			"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"ID_SECCION3": $scope.FormulariorHombre.idSection,
			"path": "Educacion/updatearticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				paramssec2[element.id] = element.ot;
			}
		});

		dataService.saveElements(paramssec2, function(dataResponse){
			if(dataResponse.result == true){
				$scope.pagesection = params;
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
				"path": "ropaaccesorios/updateotros"
				};
			}else{
				var paramssec4 = {
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
				"ID_SECCION3": $scope.FormulariorHombre.idSection,
				"path": "Educacion/updateotros"
				};
			};
			

			dataService.saveElements(paramssec4, function(dataResponse){
				console.log(dataResponse);
				console.log('Se guarda control');
				$window.location.reload();
			/*if(dataResponse.result == true){
				$scope.pagesection = params;
			}else{
				console.log(dataResponse);
			};*/
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