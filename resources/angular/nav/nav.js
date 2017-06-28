angular.module('fc.nav', [
   'ui.bootstrap',
   'fc.common.constants',
   'fc.services.userService'
])
.controller('NavCtrl', ['$rootScope', '$scope', '$state', 'constants', 'userService', 
   function($rootScope, $scope, $state, constants, userService) {
   
   $scope.states = constants.states;
   $scope.login = login;
   $scope.logout = logout;
   $scope.isLoggedIn = userService.isLoggedIn();

   $scope.info = {};

   function login() {
      userService.login($scope.info.email, $scope.info.password, $scope.rememberMe)
         .then(function(response) {
            $scope.isLoggedIn = true;
            $state.go(constants.states.welcome);
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
         $state.go(constants.states.soon);
      });
   }

}]);
