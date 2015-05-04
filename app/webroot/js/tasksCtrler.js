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

tasks.directive('bindUnsafeHtml', ['$compile', function ($compile) {
      return function(scope, element, attrs) {
          scope.$watch(
            function(scope) {
              // watch the 'bindUnsafeHtml' expression for changes
              return scope.$eval(attrs.bindUnsafeHtml);
            },
            function(value) {
              // when the 'bindUnsafeHtml' expression changes
              // assign it into the current DOM
              element.html(value);

              // compile the new DOM and link it to the current
              // scope.
              // NOTE: we only compile .childNodes so that
              // we don't get into infinite loop compiling ourselves
              $compile(element.contents())(scope);
            }
        );
    };
}]);

tasks.controller('tasksController', function tasksController($scope, $http, $timeout) {

	function refresh(){
		$timeout(
			function(){
				console.log(baseUrl+'/ToDos/tasks/'+ $scope.list_id);
				$http.get(baseUrl+'/ToDos/tasks/'+ $scope.list_id)
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
		if(action == 'add' && !$scope.tasks[key].Task.quantitatif){
			qte = 1;
		}
		else if(action == 'add')
			if(typeof $scope.tasks[key].quantity !== 'undefined')
				qte = $scope.tasks[key].quantity;
			else {
				qte = $scope.tasks[key].Task.quantity - $scope.tasks[key].Task.qteCompleted ;
			}




		var param = userId + '/' + $scope.tasks[key].Task.id + '/' + qte;

		var url = baseUrl+'/checkeds/' + action + '/' + param;

		$http.get(url)
			.success(function (data, status, header, config) {
				//console.log('Ajax success! : \n');
				$scope.tasks = data;
			})
			.error(function (data, status, header, config) {
				//console.log('l\'ajax de coche/decoche a repondu avec une error : ' + status);
			});

	};
});

tasks.controller('addMemberController', function addMemberController($scope, $http, $timeout) {
	$scope.pageTest = '';
	$scope.ajouterMembre = function(list_id){
		console.log(list_id);
		$http.get(baseUrl+'/Members/add_member/'+ /*$scope.*/list_id)
			.success(function (data, status, headers, config) {
				$scope.pageTest = data;
			});
	};
});
