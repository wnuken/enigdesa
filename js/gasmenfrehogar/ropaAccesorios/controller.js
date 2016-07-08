
var appGHogar = angular.module('appGHogar',['LocalStorageModule']);

appGHogar.config(function(localStorageServiceProvider){
	localStorageServiceProvider
	.setPrefix('app-hogar');
  // .setStorageType('sessionStorage');
});


appGHogar.service('dataService', function($http) {
// delete $http.defaults.headers.common['X-Requested-With'];

this.setInitSession = function(params, callbackFunc) {
	$http({
		method: 'GET',
		url: params.path,
		params: params.elements
        /// headers: {'Authorization': 'Token token=xxxxYYYYZzzz'}
    }).success(function(response){
    	callbackFunc(response);
    }).error(function(){
    	console.log("error");
    });
};

});


appGHogar.controller('ropaHombre', ['$scope', 'dataService', 'localStorageService', function($scope, dataService, localStorageService) {
	$scope.FormulariorHombre = {
		'rh' : [{
			'name' : "Camisas",
			"id" : "03120101",
			"value": false
		},{
			'name' : "Camisetas, franelas, esqueletos, polos",
			"id" : "03120102",
			"value": false
		},{
			'name' : "Calzoncillos, pantaloncillos, boxer",
			"id" : "03120103",
			"value": false
		},{
			'name' : "Medias y calcetines",
			"id" : "03120104",
			"value": false
		},{
			'name' : "Pantalones",
			"id" : "03120105",
			"value": false
		},{
			'name' : "Jeans",
			"id" : "03120106",
			"value": false
		},{
			'name' : "Bermudas, pantalonetas y pantalón corto",
			"id" : "03120107",
			"value": false
		},{
			'name' : "Vestido completo (sólo pantalón, chaqueta y/o chaleco)  para hombre",
			"id" : "03120108",
			"value": false
		},{
			'name' : "Blazers, chaquetas, chaquetones, chompas y sacos de sport en paño, cuero, gamuza y otros materiales",
			"id" : "03120109",
			"value": false
		},{
			'name' : "Buzos, chalecos, sacos de lana y similares ",
			"id" : "03120110",
			"value": false
		},{
			'name' : "Gabardinas, gabanes, abrigos y sobretodos ",
			"id" : "03120111",
			"value": false
		},{
			'name' : "Capas e impermeables",
			"id" : "03120112",
			"value": false
		},{
			'name' : "Sudaderas, trusas y bicicleteros para hombre",
			"id" : "03120113",
			"value": false
		},{
			'name' : "Pantalonetas de baño para hombre",
			"id" : "03120114",
			"value": false
		},{
			'name' : "Pijamas y batas para hombre",
			"id" : "03120115",
			"value": false
		},{
			'name' : "Otros artículos de vestir para hombre (depotivos y formales)",
			"id" : "03120116",
			"value": false
		},{
			'name' : "Corbatas y corbatines para hombre",
			"id" : "03130101",
			"value": false
		},{
			'name' : "Correas, tirantas y calzonarias",
			"id" : "03130102",
			"value": false
		},{
			'name' : "Pañuelos y pañoletas para hombre",
			"id" : "03130103",
			"value": false
		},{
			'name' : "Ruanas y ponchos",
			"id" : "03130104",
			"value": false
		},{
			'name' : "Bufandas, pashiminas y guantes para hombre",
			"id" : "03130105",
			"value": false
		},{
			'name' : "Sombreros, gorros, cachuchas, boinas, viseras",
			"id" : "03130106",
			"value": false
		},{
			'name' : "Zapatos en cuero, caucho, goma y similares para hombre",
			"id" : "03210101",
			"value": false
		},{
			'name' : "Botas en cuero, caucho, goma y similares",
			"id" : "03130102",
			"value": false
		},{
			'name' : "Tenis, zapatillas y otros zapatos deportivos para hombre (excluyendo zapatos para deportes específicos equipados con cuchillas, ruedas, clavos, tacos, taches)",
			"id" : "03130103",
			"value": false
		},{
			'name' : "Pantuflas, sandalias, abuelitas, chanclas, cotizas y alpargatas",
			"id" : "03130104",
			"value": false
		}]
	};

	$scope.pagesection = '';

	$scope.validateForm1 = function(params){
		console.log(params);

		var paramssec0 = {
				"elements" : {
					"ID_FORMULARIO": $scope.FormulariorHombre.idFormulario,
					"ID_VARIABLE": $scope.FormulariorHombre.idVariable,
					"VALOR_VARIABLE": $scope.FormulariorHombre.valorVariable,
				},				
				"path": "validateinitsection"
			}

			dataService.setInitSession(paramssec0, function(dataResponse){
				console.log(dataResponse);
					if($scope.FormulariorHombre.valorVariable == '1' && dataResponse.status == true){
						$scope.pagesection = params;
					}else{
						console.log('va al home');
					}


			});

		
		
	};

	$scope.validateForm2 = function(params){
		console.log($scope.FormulariorHombre);
		
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


}]);