var list = angular.module('Liste', []);


list.config(function ($httpProvider) {
  // because you did not explicitly state the Content-Type for POST, the default is application/json
  $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  $httpProvider.defaults.headers.common['Accept'] = 'application/json';
  $httpProvider.defaults.transformRequest = function(data) {
      if (data === undefined) {
          return data;
      }
      //return $.param(data);
      return JSON.stringify(data);
  }
});


list.controller('listeController', function listeController($scope, $http, $timeout) {

	function refresh(){
		$timeout(
			function(){
				console.log(baseUrl+'/todos/');
				$http.get(baseUrl+'/todos/')
					.success(function (data, status, headers, config) {
						console.log('l\'ajax a repondu avec comme data : ' + data);
						$scope.tasks = data;
					})
					.error(function (data, status, header, config) {
						console.log('l\'ajax a repondu avec erreur');
					});

				refresh();
			},
			10000
			);
	}
	refresh();

	
	$scope.dateHelper = function(date){
		return frDate(date);
	};

});
