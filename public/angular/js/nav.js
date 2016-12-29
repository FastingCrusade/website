angular.module('fc.nav', [
   'ui.bootstrap'
])
.controller('NavCtrl', function($scope, $http) {
   
   $scope.login = login;

   function login() {
      console.log("Username: " + $scope.username);
      console.log("Password: " + $scope.password);
      console.log("Remember: " + $scope.rememberMe);
   }

});
