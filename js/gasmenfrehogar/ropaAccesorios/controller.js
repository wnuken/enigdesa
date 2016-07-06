
var appGHogar = angular.module('appGHogar',['LocalStorageModule']);

appGHogar.config(function(localStorageServiceProvider){
	localStorageServiceProvider
	.setPrefix('app-hogar');
  // .setStorageType('sessionStorage');
});


appGHogar.service('dataService', function($http) {
// delete $http.defaults.headers.common['X-Requested-With'];

this.getCurrentSession = function(callbackFunc) {
	$http({
		method: 'GET',
		url: baseUrl + 'response/getcaratula',
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

	$scope.validateForm = function(){
		console.log($scope.FormulariorHombre);
	};


}]);