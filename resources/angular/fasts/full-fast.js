angular.module('fc.home.fullFast', [
   'ui.bootstrap',
   'fc.common.constants',
   'fc.common.directives',
   'fc.services.fastService'
])
.controller('FullFastCtrl', ['$scope', '$state', '$stateParams', 'constants', 'fastService',
   function($scope, $state, $stateParams, constants, fastService) {
   
   $scope.fastCategories = fastService.fastCategories;
   $scope.fast = $stateParams.fast;

   $scope.longComment = {
      contents: "This is a comment used for testing the overall look and feel of how things should work.  It is a long comment because I want to see how the thing looks when it has a lot to display.  Eventually we will display a small comment too to make sure the spacing is still good."
   };
   $scope.shortComment = {
      contents: "Not much to say here."
   };
  
   function createFast() {
      
   }

}]);
