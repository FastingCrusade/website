angular.module('fc.account.register', [
   'fc.services.userService'
])
.controller('RegisterCtrl', ['$scope', '$state', 'userService', 
   function($scope, $state, userService) {
   
   $scope.submitRegistration = submitRegistration;
   $scope.returnHome = returnHome;

   function submitRegistration(event) {
      userService.register($scope.email, $scope.password, $scope.name)
         .then(function(response) {
            $scope.registrationSuccess = true;
         }, function(error) {
            $scope.registrationError = true;
            console.error('Error during registration! ' + error.statusText);
         });
   }

   // TODO: Eventually figure out what the "main" state is, when you first hit the app
   function returnHome() {
      $state.go('soon');
   }
}]);
