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

member.directive( 'compileData', function ( $compile ) {
  return {
    scope: true,
    link: function ( scope, element, attrs ) {

      var elmnt;

      attrs.$observe( 'template', function ( myTemplate ) {
        if ( angular.isDefined( myTemplate ) ) {
          // compile the provided template against the current scope
          elmnt = $compile( myTemplate )( scope );

            element.html(""); // dummy "clear"

          element.append( elmnt );
        }
      });
    }
  };
});

member.directive('bindUnsafeHtml', ['$compile', function ($compile) {
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


member.controller('memberController', function tasksController($scope, $http, $sce) {

  function requete(param) {
    console.log(param);

    $http.get('/Members/modif_droit_ajax/'+param)
      .success(function (data, status, headers, config) {
      })
      .error(function (data, status, headers, config) {
        console.log("ca marche pas battard!");
      })
  }

  $scope.itemClick = function (idUtil, idToDo) {
    var param = idUtil+'/'+idToDo+'/3/'+'update';
    requete(param);
  }

  $scope.userClick = function (idUtil, idToDo) {
    var param = idUtil+'/'+idToDo+'/4/'+'update';
    requete(param);
  }

});

member.controller('addMemberController', function addMemberController($scope, $http, $timeout) {
  $scope.pageTest = '';
  $scope.ajouterMembre = function(list_id){
    console.log(list_id);
    $http.get(baseUrl+'/Members/add_member/'+ /*$scope.*/list_id)
      .success(function (data, status, headers, config) {
        $scope.pageTest = data;
      });
  };
});