var tasksApp = angular.module('Tasks', []);

tasksApp.config(function ($httpProvider) {
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

tasksApp.controller('tasksController', function tasksController($scope, $http, $timeout) {


	function refresh(){
		$timeout(
			function(){
				console.log(baseUrl+'/todos/tasks/'+ $scope.list_id);
				$http.get(baseUrl+'/todos/tasks/'+ $scope.list_id)
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
	//refresh();

	$scope.dateHelper = function(date){
		return frDate(date);
	};

	$scope.boxClick = function(key) {
		//console.log($scope.tasks[key]);

		console.log($scope.tasks[key].Task.completed);
		console.log($scope.tasks[key].value);

		var action = '';


		$scope.tasks[key].Checked.some(function (element, index, array){
			if(element.User.id == userId){
				action = 'remove';
				return true;
			}

		});

		if(action == '')
			action = 'add';


		var qte;
		if(action == 'add' && !$scope.tasks[key].Task.quantitatif)
			qte = 1;
		else if(action == 'add')
			if(typeof $scope.tasks[key].quantity !== 'undefined')
				qte = $scope.tasks[key].quantity;
			else
				return false;


		console.log(qte);


		var param = userId + '/' + $scope.tasks[key].Task.id + '/' + qte;

		var url = baseUrl+'/checkeds/' + action + '/' + param;

		$http.get(url)
			.success(function (data, status, header, config) {
				console.log('Ajax success! : \n'+data);
				$scope.tasks = data;
			})
			.error(function (data, status, header, config) {
				console.log('l\'ajax de coche/decoche a repondu avec une error : ' + status);
			});

	};
});
