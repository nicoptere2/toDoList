var friends = angular.module('Friend', []);

friends.config(function ($httpProvider) {
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

friends.controller('friendController', function tasksController($scope, $http, $timeout) {

});

friends.controller('addFriendController', function addFriendController($scope, $http, $timeout) {
  $scope.pageTest = '';
  $scope.ajouterAmi = function(){
    console.log("2");
    $http.get(baseUrl+'/Friends/add_friends')
      .success(function (data, status, headers, config) {
        $scope.pageTest = data;
      })
      .error(function (data, status, headers, config) {
        console.log('ca marche pas...');
      })
  };
});