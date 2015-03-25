var list = angular.module('Liste', []);


list.controller('listeController', function listeController($scope, $http) {
	$scope.listRefresh = function () {
		console.log(baseUrl+'/Lists/listAjax/');
		$http.get(baseUrl+'/Lists/listAjax/')
			.success(function (data, status, headers, config) {
				console.log('l\'ajax a repondu avec comme data : ' + data);
				$scope.lists = data;
			})
			.error(function (data, status, header, config) {
				console.log('l\'ajax a repondu avec erreur');
			});
	};
});
