var tasks = angular.module('Tasks', []);

tasks.config(function ($httpProvider) {
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

tasks.controller('tasksController', function tasksController($scope, $http, $timeout) {


	function refresh(){
		$timeout(
			function(){
				console.log(baseUrl+'/toDos/tasks/'+ $scope.list_id);
				$http.get(baseUrl+'/toDos/tasks/'+ $scope.list_id)
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

/*
	$scope.refresh = function (list) {
		console.log(baseUrl+'/toDos/tasks/'+list);
		$http.get(baseUrl+'/toDos/tasks/'+list)
			.success(function (data, status, headers, config) {
				console.log('l\'ajax a repondu avec comme data : ' + data);
				$scope.tasks = data;
			})
			.error(function (data, status, header, config) {
				console.log('l\'ajax a repondu avec erreur');
			});
	};
*/

});
