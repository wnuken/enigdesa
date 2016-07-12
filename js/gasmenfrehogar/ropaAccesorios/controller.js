
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
        /// headers: {'Authorization': 'Token token=xxxxYYYYZzzz'}
    }).success(function(response){
    	callbackFunc(response);
    }).error(function(){
    	console.log("error");
    });
};



});


appGHogar.controller('ropaHombre', ['$scope', 'dataService', 'localStorageService', function($scope, dataService, localStorageService) {
	
	$scope.FormulariorHombre = {};
	$scope.elid = [];

	var gg = {
		"ID_SECCION3": "D1"
	};

	var paramsInit = {
		"elements" : {
			"ID_SECCION3": "D1"
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
			},				
			"path": "validateinitsection"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			if($scope.FormulariorHombre.valorVariable == '1' && dataResponse.status == true){
				$scope.pagesection = params;
			}else{
				console.log('va al home');
			}


		});

		
		
	};

	$scope.validateForm2 = function(params){
		///console.log($scope.FormulariorHombre.rh);

		var paramssec1 = {
				"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
			"path": "ropaaccesorios/savesetarticulos"
		};

		angular.forEach($scope.FormulariorHombre.rh, function(element, key){
			if(element.value == true){
				 paramssec1[key] = element.id;
				}
		});

		console.log(paramssec1);	


		dataService.saveElements(paramssec1, function(dataResponse){
						 console.log(dataResponse);
				});

		
		
		$scope.pagesection = params;

		
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

	$scope.validateBtnS2 = function(idelement){
		console.log(idelement);
		console.log($scope.FormulariorHombre.compra);
		angular.forEach($scope.FormulariorHombre.compra, function(element, key){
			console.log(element);
			if(element == true){
				$scope.elid[idelement] = true;
			}else{
				$scope.elid[idelement] = false;
			}
		});

		angular.forEach($scope.FormulariorHombre.recibo, function(element, key){
			console.log(element);
			if(element == true){
				$scope.elid[idelement] = true;
			}else{
				$scope.elid[idelement] = false;
			}
		});

		angular.forEach($scope.FormulariorHombre.regalo, function(element, key){
			console.log(element);
			if(element == true){
				$scope.elid[idelement] = true;
			}else{
				$scope.elid[idelement] = false;
			}
		});

		angular.forEach($scope.FormulariorHombre.intercambio, function(element, key){
			console.log(element);
			if(element == true){
				$scope.elid[idelement] = true;
			}else{
				$scope.elid[idelement] = false;
			}
		});

		angular.forEach($scope.FormulariorHombre.propio, function(element, key){
			console.log(element);
			if(element == true){
				$scope.elid[idelement] = true;
			}else{
				$scope.elid[idelement] = false;
			}
		});

		angular.forEach($scope.FormulariorHombre.otro, function(element, key){
			console.log(element);
			if(element == true){
				$scope.elid[idelement] = true;
			}else{
				$scope.elid[idelement] = false;
			}
		});


		

		//console.log($scope.elid);
	};


}]);