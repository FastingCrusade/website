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

   function login() {
      userService.login($scope.email, $scope.password, $scope.rememberMe)
         .then(function(response) {
            $rootScope.user = {
               'user': $scope.email,
               'loggedIn': true
               // TODO: set cookie for rememberMe?
            };
            $state.go('home');
         }, function(error) {
            console.error('Error logging in: ' + error.statusText);
         });
   }

   function logout() {
      // TODO: Make rest call
      $rootScope.user = null;
      $state.go('soon');
   }

}]);
