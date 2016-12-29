angular.module('fc.nav', [
   'ui.bootstrap',
   'fc.services.userService'
])
.controller('NavCtrl', ['$scope', 'userService', function($scope, userService) {
   
   $scope.login = login;

   function login() {
      userService.login($scope.username, $scope.password, $scope.rememberMe);
   }

}]);
