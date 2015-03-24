var tasks = angular.module('Tasks', []);

tasks.controller('tasksController', function tasksController($scope) {
	$scope.remaining = 4;
	console.log($scope.lists);
});
