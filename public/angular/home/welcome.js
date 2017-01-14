angular.module('fc.home.welcome', [
   'fc.services.fastService',
   'slick',
   'ui.bootstrap'
])
.controller('WelcomeCtrl', ['$rootScope', '$scope', '$state', 'fastService', 
   function($rootScope, $scope, $state, fastService) {

   $scope.state = $state;
   $scope.fasts = fastService.fasts;

   fastService.getFasts($rootScope.user.name)
      .then(function(response) {
         fastService.getFasts = response.data.data.data;
      }, function(error) {
         console.log("Error retrieving fasts!");
      });
   var i = 0;
}]);
