angular.module('fc.home.welcome', [
   'fc.services.fastService',
   'slick'
])
.controller('WelcomeCtrl', ['$rootScope', '$scope', '$state', 'fastService', 
   function($rootScope, $scope, $state, fastService) {

   $scope.state = $state;
   $scope.fasts = fastService.getFasts($rootScope.user.name);
}]);
