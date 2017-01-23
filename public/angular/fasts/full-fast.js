angular.module('fc.home.fullFast', [
   'ui.bootstrap',
   'fc.common.constants',
   'fc.services.fastService'
])
.controller('FullFastCtrl', ['$scope', '$state', '$stateParams', 'constants', 'fastService',
   function($scope, $state, $stateParams, constants, fastService) {
   
   $scope.fastCategories = fastService.fastCategories;
   $scope.fast = $stateParams.fast;
  
   function createFast() {
      
   }

}]);
