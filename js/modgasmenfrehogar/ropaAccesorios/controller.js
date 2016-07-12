
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
		headers: {'Content-Type': 'application/json'},
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
	$scope.validateGroup = [];

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
				"ID_SECCION3": $scope.FormulariorHombre.idSection
			},				
			"path": "ropaaccesorios/validateinitsection"
		};

		dataService.saveSection(paramssec0, function(dataResponse){
			if($scope.FormulariorHombre.valorVariable == '1' && dataResponse.status == true){
				// $scope.pagesection = params;
			}else{
				console.log('va al home');
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
		console.log($scope.FormulariorHombre);
		$scope.validateGroup[index] = '';
		angular.forEach($scope.FormulariorHombre.rh[index].ot, function(element, key){
			console.log(element);
			if(element == true)
				$scope.validateGroup[index] = true;
		});

		//console.log($scope.elid);
	};


}]);