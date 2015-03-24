var list = angular.module('Liste', []);


list.controller('listeController', function listeController($scope) {
	$scope.remaining = 4;
	console.log($scope.lists);
});
