angular.module('fc.nav', [
   'ui.bootstrap',
   'fc.services.userService'
])
.controller('NavCtrl', ['$rootScope', '$scope', '$state', 'userService', 
   function($rootScope, $scope, $state, userService) {
   
   $scope.login = login;
   $scope.logout = logout;
   $scope.isLoggedIn = userService.isLoggedIn();

   function login() {
      userService.login($scope.email, $scope.password, $scope.rememberMe)
         .then(function(response) {
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
         $scope.isLoggedIn = false;
         $state.go('root.soon');
      });
   }

}]);
