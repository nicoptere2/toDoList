var member = angular.module('Member', []);

member.config(function ($httpProvider) {
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


member.controller('memberController', function tasksController($scope, $http, $sce) {

  $scope.rights = function (key){
    var ret = "";
    if($scope.members[key].Member.right_id==2) {
      ret = 'Proprietaire</td><td></td>';
    }
    else {
      ret = "<label><input type=\"checkbox\" name=\"owner\" ng-name=\"item{{$scope.members[key].User.id}}\" ng-checked=\"$scope.members[key].Member.right_id == 3\" ng-click=\"rightOwner(key)\">modification d'item</label></td><td><label><input type=\"checkbox\" name=\"user\" ng-name=\"users{{$scope.members[key].User.id}}\" ng-checked=\"$scope.members[key].Member.right_id == 4\" ng-click=\"rightUser(key)\">ajout utilisateur</label></td>";
    }


    return $sce.trustAsHtml(ret);
  };

  function changeRight(param){

    param = param.join('/');

    var url = baseUrl+'/Members/' + 'modif_droit_ajax' + '/' + param;

    console.log('url :' + url);

    $http.get(url)
      .success(function (data, status, header, config) {
        console.log('Ajax success! : \n');
      })
      .error(function (data, status, header, config) {
        console.log('l\'ajax de coche/decoche a repondu avec une error : ' + status + '\n' + data);
      });
  }

  $scope.rightOwner = function (key){

  };

  $scope.rightItem = function (key){
    var param = [$scope.members[key].User.id, $scope.members[key].ToDo.id, 3];
    changeRight(param);
  };

  $scope.rightUser = function (key){
    var param = [userId, $scope.members[key].ToDo.id, 4];
    changeRight(param);
  };

});