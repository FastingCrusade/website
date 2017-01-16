angular.module('fc.home.welcome', [
   'fc.services.userService',
   'fc.services.fastService',
   'slickCarousel',
   'ui.bootstrap'
])
.controller('WelcomeCtrl', ['$scope', '$state', '$timeout', 'userService', 'fastService', 
   function($scope, $state, $timeout, userService, fastService) {

   $scope.state = $state;
   $scope.fasts = [];
   $scope.fastsLoaded = true;
   $scope.slickConfig = {
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      touchMove: false,
      slidesToScroll: 1,
      centerMode: false
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
