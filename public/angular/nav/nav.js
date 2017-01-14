angular.module('fc.nav', [
   'ui.bootstrap',
   'fc.services.userService',
   'fc.directives.ng-enter'
])
.controller('NavCtrl', ['$rootScope', '$scope', '$state', 'userService', 
   function($rootScope, $scope, $state, userService) {
   
   $scope.login = login;
   $scope.logout = logout;
   $scope.user = $rootScope.user;
   $scope.isLoggedIn = $rootScope.isLoggedIn;

   function login() {
      userService.login($scope.email, $scope.password, $scope.rememberMe)
         .then(function(response) {
            $rootScope.user = JSON.parse(response.data.data);
            $rootScope.isLoggedIn = true;
            $scope.isLoggedIn = true;
            $state.go('root.home.welcome');
            $scope.loginFailure = false;
         }, function(error) {
            $scope.loginFailure = true;
            console.error('Error logging in: ' + error.statusText);
         });
   }

   function logout() {
      userService.logout()
      .then(function(response) {
         $rootScope.user = null;
         $rootScope.isLoggedIn = false;
         $scope.isLoggedIn = false;
         $state.go('root.soon');
      });
   }

}]);
