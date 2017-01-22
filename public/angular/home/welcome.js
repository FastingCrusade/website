angular.module('fc.home.welcome', [
   'fc.common.constants',
   'fc.services.userService',
   'fc.services.fastService',
   'slickCarousel',
   'ui.bootstrap'
])
.controller('WelcomeCtrl', ['$scope', '$state', '$timeout', 'constants', 'userService', 'fastService', 
   function($scope, $state, $timeout, constants, userService, fastService) {

   $scope.states = constants.states;
   $scope.state = $state;
   $scope.fasts = [];
   $scope.fastsLoaded = true;
   $scope.slickConfig = {
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      centerMode: true,
      variableWidth: true
   };

   fastService.getFasts()
      .then(function(response) {
         $scope.fastsLoaded = false;
         $scope.fasts = response.data.data.data;
         $timeout(function() {
            $scope.fastsLoaded = true;
         }, 5);
      }, function(error) {
         console.log("Error retrieving fasts!");
      });
}]);
