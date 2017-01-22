angular.module('fc.home.fullFast', [
   'ui.bootstrap',
   'fc.common.constants',
   'fc.services.fastService'
])
.controller('NewFastCtrl', ['$scope', '$state', 'constants', 'fastService',
   function($scope, $state, constants, fastService) {
   
   $scope.fastCategories = fastService.fastCategories;
  
   function createFast() {

   }

}]);
