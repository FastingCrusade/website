angular.module('fc.home.welcome', [
   'fc.services.fastService',
   'slickCarousel',
   'ui.bootstrap'
])
.controller('WelcomeCtrl', ['$rootScope', '$scope', '$state', '$timeout', 'fastService', 
   function($rootScope, $scope, $state, $timeout, fastService) {

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

   fastService.getFasts($rootScope.user.name)
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
